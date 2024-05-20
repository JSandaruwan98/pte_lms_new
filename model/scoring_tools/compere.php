<?php

class SentenceCompareModel
{
    public function __construct(){}
    
//===============================================================================================================================================    

    public function compareSentences($sentence1, $sentence2){
        // Convert sentences to arrays of words
        $words1 = array_map('strtolower', explode(" ", $sentence1));
        $words2 = array_map('strtolower', explode(" ", $sentence2));
        
        $mismatchedWords = array();
        foreach ($words1 as $key => $word) {
            if (array_key_exists($key, $words2)) {
                if ($word !== $words2[$key]) {
                    $mismatchedWords[] = $word;
                }
            }
            else{
                continue;
            }
            
        }

    
        // Find additional words in sentence2
        $additionalWords = array_diff($words2, $words1);
    
        // Find missed words in sentence2
        $missedWords = array_diff($words1, $words2);
    
        $result = array_merge($mismatchedWords);

        #$count = count($additionalWords) + count($missedWords);
    
        return [
            'additional_words' => $additionalWords,
            'missed_words' => $mismatchedWords,
        ];
    }

//===============================================================================================================================================

   
//===============================================================================================================================================




    

}
?>
