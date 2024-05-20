<?php

class AnswerModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function save_audio($audio,$student_id){

        $audioFile1 = '.recording'.$student_id.'.wav';
           
        exec("ffmpeg -i $audio -vn -acodec pcm_s16le -ar 44100 -ac 2 $audioFile1 -y");
        
        $response['message'] = "success";
        $response['audioFile2'] = $audioFile1;

        return $response;
    }

//===============================================================================================================================================

    public function voiceToTest($student_id){
        function upload_file($api_token, $path) {
            $url = 'https://api.assemblyai.com/v2/upload';
            $data = file_get_contents($path);
        
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-type: application/octet-stream\r\nAuthorization: $api_token",
                    'content' => $data
                ]
            ];
        
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);
        
            if ($http_response_header[0] == 'HTTP/1.1 200 OK') {
                $json = json_decode($response, true);
                return $json['upload_url'];
            } else {
                echo "Error: " . $http_response_header[0] . " - $response";
                return null;
            }
        }
        
        // Function to create a transcript using AssemblyAI API
        function create_transcript($api_token, $audio_url) {
            $url = "https://api.assemblyai.com/v2/transcript";
        
            $headers = array(
                "authorization: " . $api_token,
                "content-type: application/json"
            );
        
            $data = array(
                "audio_url" => $audio_url
            );
        
            $curl = curl_init($url);
        
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
            $response = json_decode(curl_exec($curl), true);
        
            curl_close($curl);
        
            $transcript_id = $response['id'];
        
            $polling_endpoint = "https://api.assemblyai.com/v2/transcript/" . $transcript_id;
        
            while (true) {
                $polling_response = curl_init($polling_endpoint);
        
                curl_setopt($polling_response, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($polling_response, CURLOPT_RETURNTRANSFER, true);
        
                $transcription_result = json_decode(curl_exec($polling_response), true);
        
                if ($transcription_result['status'] === "completed") {
                    return $transcription_result;
                } else if ($transcription_result['status'] === "error") {
                    throw new Exception("Transcription failed: " . $transcription_result['error']);
                } else {
                    sleep(3);
                }
            }
        }


        try {
            // Your API token is already set in this variable
            $api_token = "7639cd33bc1f42adbef29b007f593780";
        
            $path = ".recording".$student_id.".wav";
            $upload_url = upload_file($api_token, $path);
        
            $transcript = create_transcript($api_token, $upload_url);
            $Question = $transcript['text']; 
        
            return $Question;
        
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


//===============================================================================================================================================

    public function setAnswer($test_id, $voice, $audioFile, $question_id, $student_id, $content, $pronun, $grammar, $vocabulary, $form, $word_set_1, $word_set_2, $json, $spell, $dsc, $glr, $total){
            
        try {
            $word_set_1 = htmlspecialchars($word_set_1);
            $word_set_2 = htmlspecialchars($word_set_2);
        
            $sql = "INSERT INTO answering (question_id, student_id, test_id, mp4File, userAnswer, content, pronunciation, grammar, vocabulary, form, totalScore, additional_words, missed_words, json_data, spelling, dsc, glr) 
                    VALUES ('$question_id', '$student_id', '$test_id', '$audioFile', '$voice', '$content', '$pronun', '$grammar', '$vocabulary', '$form', '$total', '$word_set_1', '$word_set_2', '$json', '$spell', '$dsc', '$glr')";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $response['success'] = true;
                $response['message'] = "data updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Error executing statement";
            }
        } catch (PDOException $e) {
            $response['success'] = false;
            $response['message'] = "Caught exception: " . $e->getMessage();
        }

        return $response;

    }

    public function get121($errorCount){
        $response['message'] = $errorCount;
        return $response;
    }
    

}
?>
