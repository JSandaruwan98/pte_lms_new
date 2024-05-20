<?php
    try{
        $Solution = $_POST['Solution'];
        $question_id = $_POST['question_id'];
        $test_id = $_POST['test_id'];

    // voice to text converter
        $voice = $answer->voiceToTest($student_id);
        if(empty($voice)){
            throw new Exception("voice recording or any other input data not received");
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

    // compare the user answer and solution
        $result = $compere->compareSentences($Solution, $voice);

        if(empty($result)){
            throw new Exception("Some error of compareSentence");
        }

    // set the additional words
        $serialized_additional_words = serialize($result['additional_words']);
        $serialized_missed_words = serialize($result['missed_words']);

        $word_set_1 = implode(', ', $result['additional_words']);
        $word_set_2 = implode(', ', $result['missed_words']);

        $count_1 =  count($result['additional_words']);
        $count_2 =  count($result['missed_words']);

        $count = ($count_1 + $count_2)/2;

    // set the content score
        $content = 0;
        if($count > 9){
            $content = 0;
        }elseif($count >= 7){
            $content = 1;
        }elseif($count = 6){
            $content = 2;
        }elseif($count >= 4){
            $content = 3;
        }elseif($count >= 2){
            $content = 4;
        }elseif($count >= 0){
            $content = 5;
        }

    // set the total score
        $total = $content + $overall_pronun_score;

    // set the student answer voice file
        $uploadDirectory = '../assets/audio/answer/speaking/';
        $audioFile = 'audio-rdrs-'.$student_id.'-'. date('YmdHis') . '.wav';
        $filename = $uploadDirectory . $audioFile;
        copy('.recording'.$student_id.'.wav', $filename);
        unlink(".recording".$student_id.".wav");
        
    // answer passing to the db    
        $response = $answer->setAnswer($test_id, $voice, $filename, $question_id, $student_id, $content, $overall_pronun_score, 0, 0, 0, $word_set_1, $word_set_1, $json_output_result, 0, 0, 0, $total);

    } catch (Exception $e) {
        unlink(".recording".$student_id.".wav");
        $response['message'] =  "Caught exception: " . $e->getMessage();
    }
?>