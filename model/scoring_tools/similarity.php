<?php

class SimilarityModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
//===============================================================================================================================================    

    public function wordSimilarity($word1, $word2){

        $text1 = urlencode($word1);
        $text2 = urlencode($word2);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://twinword-text-similarity-v1.p.rapidapi.com/similarity/?text1=$text1&text2=$text2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'X-RapidAPI-Key: 5793a5110emshfc64aa12775dd98p12393djsn5abdf6452fc7',
                'X-RapidAPI-Host: twinword-text-similarity-v1.p.rapidapi.com'
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo 'cURL Error #:' . $err;
        } else {
            return $response;
        }
        

    }

//===============================================================================================================================================

    
    

}
?>
