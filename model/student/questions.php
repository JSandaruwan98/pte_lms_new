<?php

class QuestionsModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function getQuestions($perPage, $offset, $test_id, $type, $student_id) {
            
        try {
            $sql = "SELECT type, question, solution, imageFile, question_id, mp4File, key_words FROM question WHERE question_id NOT IN (SELECT question_id FROM answering AS a WHERE a.student_id = '$student_id' AND a.test_id = '$test_id') AND test_id = '$test_id' LIMIT $offset, 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $sqlCount = "SELECT COUNT(*) AS Count FROM question WHERE test_id = '$test_id'";
            $stmtCount = $this->conn->prepare($sqlCount);
            $stmtCount->execute();
            $count = $stmtCount->fetch(PDO::FETCH_ASSOC);
        
            $response = [
                'data' => $data,
                'totalItems' => $count['Count'],
                'offset' => $offset,
                'perpage' => $perPage
            ];
        } catch (PDOException $e) {
            // Handle database connection or query errors here
            $response['success'] = false;
            $response['message'] = $sql;
        }
        
        return  $response;
    }

//===============================================================================================================================================

   
    public function startPage($test_id, $student_id) {

        $sqlDiff = "SELECT (COUNT(*) + 1) AS start_page FROM question WHERE question_id IN (SELECT question_id FROM answering AS a WHERE a.student_id = '$student_id' AND a.test_id =$test_id) AND test_id = $test_id";
        $stmt = $this->conn->prepare($sqlDiff);
        $stmt->execute();
        $diff = $stmt->fetch(PDO::FETCH_ASSOC);
        return  $diff;

    }


//===============================================================================================================================================




    

}
?>
