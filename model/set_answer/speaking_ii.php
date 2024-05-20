<?php
    try {

        $Solution = $_POST['Solution'];
        $question_id = $_POST['question_id'];
        $key_words = $_POST['key_words'];
        $test_id = $_POST['test_id'];

    // voice to text converter
        $voice = $answer->voiceToTest($student_id);
        if(empty($voice)){
            throw new Exception("voice recording or any other input data not received");
        }

    // select the answer short Question
        if($_POST['type'] == 'Answer Short Question'){

            $Question ="Question : `".$key_words."`  and Answer: `".$voice."`  this answer is only give a correct or incorrect not any other";
            $result = $palmai->AiComparison($Question);
            if(empty($result)){
                throw new Exception("palm API not working");
            }
            if (stripos($result, 'incorrect') !== false) {
                $value = 0; // Set $value to 1
            } elseif (stripos($result, 'correct') !== false) {
                $value = 1; // Set $value to 0 if 'incorrect' is found
            }

            //************** Total Score **************/

            $total = $value;

            //************** Audio Save **************/

            $uploadDirectory = '../assets/audio/answer/speaking/';
            $audioFile = 'audio-asq-'.$student_id.'-'. date('YmdHis') . '.wav';
            $filename = $uploadDirectory . $audioFile;
            copy('.recording'.$student_id.'.wav', $filename);
            unlink(".recording".$student_id.".wav");
            
            $response = $answer->setAnswer($test_id, $voice, $filename, $question_id, $student_id, $value, 0, 0, 0, 0, NAN, NAN, NAN, 0, 0, 0, $total);
    //select the describe image and re-tell lecture
        }elseif($_POST['type'] == 'Describe Image' || $_POST['type'] == 'Re-tell Lecture'){

        // word similarity check
            $word_similarity_json = $similarity->wordSimilarity($voice, $Solution); 
            if(empty($word_similarity_json)){
                throw new Exception("word similarity API not working");
            }
        // set the content score
            $word_similarity_json = json_decode($word_similarity_json, true);
            $similarity_score = round($word_similarity_json['similarity']*100);
            if($similarity_score == 100){
                $content = 5;
            }elseif($similarity_score > 79){
                $content = 4;
            }elseif($similarity_score > 59){
                $content = 3;
            }elseif($similarity_score > 39){
                $content = 2;
            }elseif($similarity_score > 9){
                $content = 1;
            }else{
                $content = 0;
            }  
            
        // pronunciation checker
            $pronun_result = $pronunciation->pronunciationResult($voice, $student_id);
            if(empty($pronun_result)){
                throw new Exception("prnounciation API not working");
            }
            $pronun_result_json = json_decode($pronun_result, true);
            $overall_pronun_score = $pronun_result_json['overall_pronun_score'];
            $json_output_result = $pronun_result_json['json_output_string'];
            
        // set the overall fluency
            $confidence_score_json = json_decode($json_output_result , true);
            $total_confidence_score = 0;
            foreach ($confidence_score_json as $score_confidence) {
                $total_confidence_score += $score_confidence['confidence'];
            }
            $overall_fluency_score = ($total_confidence_score / 100);
            $json_output_result = addslashes($json_output_result);

        // set the total score
            $total = $content + $overall_pronun_score;

        // set the student answer voice file
            $uploadDirectory = '../assets/audio/answer/speaking/';
            $audioFile = 'audio-dirl-'.$student_id.'-'. date('YmdHis') . '.wav';
            $filename = $uploadDirectory . $audioFile;
            copy('.recording'.$student_id.'.wav', $filename);
            unlink(".recording".$student_id.".wav");
                
        // answer passing to the db    
            $response = $answer->setAnswer($test_id, $voice, $filename, $question_id, $student_id, $content, $overall_pronun_score, 0, 0, 0, NAN, NAN, $json_output_result, 0, 0, 0, $total);
        }


    }catch(Exception $e){
        unlink(".recording".$student_id.".wav");
        $response['message'] =  "Caught exception: " . $e->getMessage();
    }
?>