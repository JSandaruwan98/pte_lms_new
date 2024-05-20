<?php
    try{

        //Assigned the variables
        $user_answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $test_id = $_POST['test_id'];


        //---------### Form & Content Score ###---------------------
        $numberOfWords = str_word_count($user_answer);

        //---------### Grammar Score ###---------------------
        $grammer_json_data = $grammar->grammarChecker($user_answer);

        if(empty($grammer_json_data)){
            throw new Exception("grammer error checking API not working");
        }

        $data = json_decode($grammer_json_data, true);
        $grammer_error_count = 0;
        foreach ($data as $item) {
            $grammer_error_count += isset($item['result']) ? count($item['result']) : 0;
        }

        $newString = str_replace("'", "\'", $user_answer);
        $Question = "'".$newString."' is this an obstacle to communication or not. not any comments";
        $value = $palmai->AiComparison($Question);
        if(empty($value)){
            throw new Exception("palm API not working");
        }




        //---------### Spelling Score ###---------------------

        $errorCount = 0;
        foreach ($data as $item) {
            foreach ($item['result'] as $result) {
                foreach($result['error_category'] as $error){
                    if ($error === 'Spellings & Typos' || $error === 'Spelling & Typos') {
                        $errorCount++; 
                    }
                }
            }
        }


        //------------### Vocabulary Score ###---------------------
        $wordCount = str_word_count($user_answer);
        $Question ="Question : `".$user_answer."`  how many vocabulary errors only integer count not any answers or suggessions";
        $vocabulary_errors = $palmai->AiComparison($Question);
        if(empty($vocabulary_errors)){
            throw new Exception("palm API not working");
        }
        $diff = $wordCount - $vocabulary_errors;


        if($numberOfWords > 119){

            if($numberOfWords > 279){
                $content = 3;
                $dsc = 2;
                $glr = 2;
            }else if($numberOfWords > 199){
                $content = 2;
                $dsc = 1;
                $glr = 1;
            }else{
                $content = 1;
                $dsc = 1;
                $glr = 1;
            }




            if($numberOfWords > 120 && $numberOfWords < 380){
                if($numberOfWords > 200 && $numberOfWords < 300){
                    $form = 2;
                }else{
                    $form = 1;
                }


                if($grammer_error_count === 0){
                    $grammar_score = 2;
                }else if(strpos($value, "no") !== false || strpos($value, "No") !== false) {
                    $grammar_score = 1;
                }else if(strpos($value, "Yes") !== false || strpos($value, "yes") !== false){
                    $grammar_score = 0;
                }

                if($errorCount == 0){
                    $vocab = 2;
                }else if($errorCount == 1){
                    $vocab = 1;
                }else{
                    $vocab = 0;
                }

                if($diff > 23){
                    $spell = 2;
                }else if($diff > 7){
                    $spell = 1;
                }else{
                    $spell = 0;
                }



            }else{
                $form = 0;
                $grammar_score = 0;
                $spell = 0;
                $dsc = 0;
                $glr = 0;
                $vocab = 0;
            }
        }else{
            $content = 0;
            $grammar_score = 0;
            $spell = 0;
            $vocab = 0;
            $form = 0;
            $dsc = 0;
            $glr = 0;
        }
        
        $total = $content + $grammar_score + $spell + $vocab + $form + $dsc + $glr;


        $response = $answer->setAnswer($test_id, $newString , NAN, $question_id, $student_id, $content, 0, $grammar_score, $vocab, $form, NAN, NAN, NAN, $spell, $dsc, $glr, $total);
        $response['grammar'] = $grammar->grammerResult($grammer_json_data);    
    }catch(Exception $e){
        $response['message'] =  "Caught exception: " . $e->getMessage();
    }
?>