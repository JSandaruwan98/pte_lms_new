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

        $sql = "SELECT e.test_id, t.name, t.test_id, e.attempted_on, t.image_file, e.evaluated 
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


    public function checked_completed($test_id, $student_id){
        $sql = 'SELECT 
        CASE 
            WHEN (SELECT COUNT(*) FROM paidtest AS pt WHERE pt.test_id = '.$test_id.' AND pt.student_id = "'.$student_id.'")
            THEN 
                CASE 
                    WHEN (SELECT COUNT(*) FROM paidtest WHERE attempted = 2 AND test_id = '.$test_id.' AND student_id = "'.$student_id.'")
                    THEN 2
                    ELSE 1
                    END
            ELSE 0
            END AS complete';

        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['complete'];
    }
    

}
?>
