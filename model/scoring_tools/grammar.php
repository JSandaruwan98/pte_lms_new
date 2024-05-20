<?php

class GrammarModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function grammarChecker($answer) {

        $url = 'https://trinka-grammar-checker.p.rapidapi.com/v2/para-check/en';
        $headers = [
            'content-type: application/json',
            'X-RapidAPI-Key: 24c2caf12cmsh2931583209525f1p1e80b1jsn63d4d600054f',
            'X-RapidAPI-Host: trinka-grammar-checker.p.rapidapi.com',
        ];

        $data = [
            'paragraph' => $answer,
            'language'  => 'UK',
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;

    }

//===============================================================================================================================================

public function grammerResult($result_json){

    try {
        $data = json_decode($result_json, true);
        $sql = "SELECT MAX(answer_id) AS last_answer_id FROM answering";
        $sql_for_answer_id = $this->conn->query($sql);
        $result_array = $sql_for_answer_id->fetch(PDO::FETCH_ASSOC);
        $new_id = $result_array['last_answer_id'];

        if ($result_array) {
            $new_id = $result_array['last_answer_id'];
        } else {
            $new_id = 0;
        }
        
        foreach ($data as $item) {
            if (!empty($item['result'])) {
                foreach ($item['result'] as $result) {
                    $start_index = $result['start_index'];
                    $end_index = $result['end_index'];
                    $covered_text = $result['covered_text'];;
                    $output = json_encode($result['output']);
                    $comment = json_encode($result['comment']);
                    $error_category = json_encode($result['error_category']);

                    $set_sql = "INSERT INTO grammar_result (answer_id, start_index, end_index, covered_text, final_text, comment, error_category) 
                                VALUES ($new_id,$start_index,$end_index,'$covered_text','$output','$comment', '$error_category')";
                    $sql_insert_grammar_result = $this->conn->prepare($set_sql);
                    
                    if ($sql_insert_grammar_result->execute()) {
                        $response['message'] = "Grammar data updated successfully!";
                    } else {
                        $response['message'] = "Error inserting grammar data";
                    }
                }
            } else {
                $response['message'] = "No grammar errors found";
            }
        }

    } catch (PDOException $e) {
        $response['message'] = $set_sql;
    } catch (Exception $e) {
        $response['message'] = "Error: " . $e->getMessage();
    }
    

    return $response;

}


//===============================================================================================================================================




    

}
?>
