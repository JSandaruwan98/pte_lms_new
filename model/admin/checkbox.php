<?php

class Checkbox
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================

    public function checkboc($table, $featureEnabled, $idName, $id){

        try {
            $sql = "UPDATE $table SET activation = :featureEnabled WHERE $idName = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':featureEnabled', $featureEnabled);
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

//===============================================================================================================================================

    public function testVideoAssign($batchId, $id, $isPresent, $table, $nameofid){
        try {

            $sqlCheck = "SELECT COUNT(*) AS row_count FROM $table WHERE batch_id = $batchId AND $nameofid = $id";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->execute();

            $records = $stmtCheck->fetch();
            $rowCount = $records['row_count'];


            if ($rowCount > 0) {
                $sqlUpdate = "UPDATE $table SET ispresent = 1, assigned_on = CURDATE() WHERE batch_id = $batchId AND $nameofid = $id";
                $stmtUpdate = $this->conn->prepare($sqlUpdate);
                if (!$stmtUpdate) {
                    throw new Exception("Error preparing statement: " . $this->conn->error);
                }
                if (!$stmtUpdate->execute()) {
                    throw new Exception("Error executing statement: " . $stmtUpdate->error);
                }
                $response['message'] = "Update Success";
            } else {
                $sql = "INSERT INTO $table (batch_id, $nameofid, assigned_on, ispresent) VALUES ($batchId, $id, CURDATE(), $isPresent) ON DUPLICATE KEY UPDATE ispresent = $isPresent";
                $stmt = $this->conn->prepare($sql);
                if (!$stmt) {
                    throw new Exception("Error preparing statement: " . $this->conn->error);
                }
                if (!$stmt->execute()) {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
                $response['message'] = "Insert Success";
            }    

        } catch (Exception $e) {
            $response['message'] = "Something went wrong: " . $e->getMessage();
        }
        return $response;  
    }

//===============================================================================================================================================

    public function testVideoRemove($batchId, $id, $featureEnabled, $table, $nameofid){

        try {

            $sqlUpdate = "UPDATE $table SET ispresent = $featureEnabled WHERE batch_id = $batchId AND $nameofid = $id";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute();

            $response['message'] = 'Update Success';

        } catch (Exception $e) {
            $response['message'] = "Something went wrong: " . $e->getMessage();
        }
        return $response;  
          
    }
    
}