<?php

class PronunciationModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function pronunciationResult($voice, $student_id) {
            
        $url = 'https://pronunciation-assessment1.p.rapidapi.com/pronunciation';
        $headers = [
            'Content-Type: application/json',
            'X-RapidAPI-Key: 24c2caf12cmsh2931583209525f1p1e80b1jsn63d4d600054f',
            'X-RapidAPI-Host: pronunciation-assessment1.p.rapidapi.com',
        ];

        $audioFilePath = '.recording'.$student_id.'.wav';


        if (!file_exists($audioFilePath)) {
            die('Error: Audio file not found');
        }

        $audioData = file_get_contents($audioFilePath);

        if ($audioData === false) {
            die('Error: Unable to read the audio file');
        }

        if (empty($audioData)) {
            die('Error: Audio data is empty');
        }

        $data = [
            'audio_base64' => base64_encode($audioData),
            'audio_format' => 'wav',
            'text' => $voice,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);


        $pronun_result = json_decode($response, true);

        $words_data = $pronun_result['words'];
        $new_array = array();
        foreach ($words_data as $word) {
            $new_array[] = array(
                'label' => $word['label'],
                'score' => $word['score'],
                'confidence' => $word['phones'][0]['confidence']
            );
        }

        $string_representation = json_encode($new_array);

        $overall_score = $pronun_result['score_estimates']['pte_general'];

        $data = [
            'json_output_string'=> $string_representation,
            'overall_pronun_score' => $overall_score
        ];
        $data = json_encode($data);
        return  $data;

        
    }

//===============================================================================================================================================

   


//===============================================================================================================================================




    

}
?>
