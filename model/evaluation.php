<?php

class EvaluationSheet
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
//===============================================================================================================================================    

    public function evaluationSheet($test_id, $student_id){

        $sql = "SELECT a.*, q.solution, q.type, q.imageFile, q.mp4File AS Q_audio, q.key_words 
        FROM answering AS a 
        INNER JOIN question AS q ON q.question_id = a.question_id 
        WHERE a.test_id = '$test_id' AND a.student_id = '$student_id'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $data;

    }

//===============================================================================================================================================

    public function pendingEvaluationSheet($test_id, $student_id){

        $sql = "SELECT a.*, q.solution, q.type, q.imageFile, q.mp4File AS Q_audio, t.name, q.key_words 
        FROM answering AS a 
        INNER JOIN question AS q ON q.question_id = a.question_id 
        INNER JOIN test AS t ON t.test_id = a.test_id 
        WHERE a.test_id = '$test_id' AND a.student_id = '$student_id'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

//===============================================================================================================================================
    
    public function update_evaluated($test_id, $student_id){

        $sql = "UPDATE paidtest SET evaluation_on = CURRENT_TIMESTAMP, evaluated = 1 WHERE test_id = '$test_id' AND student_id = '$student_id'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $response['success'] = true;
            $response['message'] = "Evaluated Update Successful";
        } else {
            $response['success'] = false;
            $response['message'] = "No records were updated";
        }

        return $response;

    }

}
?>
