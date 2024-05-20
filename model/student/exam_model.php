<?php

class ExamModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
//===============================================================================================================================================    

    public function completeExam($category, $student_id){

        $sql = "SELECT e.test_id, t.name, t.test_id, e.attempted_on, t.image_file, e.evaluated, e.student_id 
                FROM paidtest AS e
                JOIN test AS t ON t.test_id = e.test_id
                WHERE e.student_id = '$student_id' AND e.attempted = 1 AND t.category = '$category'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;

    }

//===============================================================================================================================================


    public function pendingExam($category, $student_id){
        try {
            $sql = "SELECT 
                        t.test_id, 
                        t.name, 
                        t.image_file,
                        CASE 
                            WHEN t.test_id IN (SELECT test_id FROM paidtest WHERE attempted = 2 AND student_id = '$student_id') THEN 1
                            ELSE 0
                        END AS paid    
                    FROM 
                        test AS t
                    JOIN 
                        testass AS tass ON t.test_id = tass.test_id
                    WHERE 
                        tass.batch_id = (SELECT batch_id FROM assignstudent AS ass WHERE ass.student_id = '$student_id') 
                        AND t.test_id NOT IN (SELECT test_id FROM paidtest WHERE attempted = 1 AND student_id = '$student_id') 
                        AND tass.assigned_on >= (SELECT enrollment_date FROM assignstudent WHERE student_id = '$student_id')
                        AND tass.ispresent = 1
                        AND t.category = '$category'";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $data;
        } catch (PDOException $e) {
            error_log("Exception occurred: " . $e->getMessage());
            return $sql;
        }
    }

//===============================================================================================================================================


    public function checkedExam($test_id, $student_id){
        $sql = "SELECT 
                CASE 
                    WHEN (SELECT COUNT(*) FROM paidtest AS pt WHERE pt.test_id = '$test_id' AND pt.student_id = '$student_id')
                    THEN 
                        CASE 
                            WHEN (SELECT COUNT(*) FROM paidtest WHERE attempted = 2 AND test_id = '$test_id' AND student_id = '$student_id')
                            THEN 2
                            ELSE 1
                            END
                    ELSE 0
                    END AS complete";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['complete'];
    }

//===============================================================================================================================================

    public function setAttempted($test_id, $student_id, $attempted){
        try {
            $sql = "INSERT INTO paidtest(`student_id`, `test_id`, `attempted_on`, `attempted`, `transaction_id`, `evaluation_on`, `evaluated`) VALUES ('$student_id', $test_id, CURDATE(), $attempted, NULL, NULL, 0)";
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Data updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Failed to update data!";
            }
        } catch (PDOException $e) {
            $response['success'] = false;
            $response['message'] = $sql;
        }
        return $response;
    }

//===============================================================================================================================================

    public function updateIncomplteExam($test_id, $student_id, $attempted){
        try {
            $sql_1 = "UPDATE paidtest SET attempted = '$attempted' WHERE test_id = '$test_id' AND student_id = '$student_id'";
            $stmt = $this->conn->prepare($sql_1);
        
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Data updated successfully!";
            } else {
                $response['success'] = false;
                $response['message'] = "Failed to update data";
            }
        } catch (PDOException $e) {
            $response['success'] = false;
            $response['message'] = $sql_1;
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = "Error: " . $e->getMessage();
        }
        return $response;
    }

}
?>
