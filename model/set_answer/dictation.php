<?php

        $user_answer = $_POST['answer'];
        $Solution = $_POST['Solution'];
        $question_id = $_POST['question_id'];
        $test_id = $_POST['test_id'];
       
        
        $result = $compere->compareSentences($Solution, $user_answer);

        $serialized_additional_words = serialize($result['additional_words']);
        $serialized_missed_words = serialize($result['missed_words']);

        $word_set_1 = implode(', ', $result['additional_words']);
        $word_set_2 = implode(', ', $result['missed_words']);

        $count_1 =  count($result['additional_words']);
        $count_2 =  count($result['missed_words']);

        $solution_word_count = str_word_count($Solution);

        $count = ($solution_word_count - $count_2);


        $response = $answer->setAnswer($test_id, $user_answer, NAN, $question_id, $student_id, $count, 0, 0, 0, 0, $word_set_1, $word_set_2, NAN, 0, 0, 0, $count);


?>