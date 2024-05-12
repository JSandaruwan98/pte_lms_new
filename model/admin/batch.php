<?php

class BatchModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function getBatch()
    {
        $sql = "SELECT *, CONCAT(DATE_FORMAT(time_from, '%h:%i %p'), ' - ', DATE_FORMAT(time_to, '%h:%i %p')) AS duration FROM batch WHERE activation = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;

    }

//===============================================================================================================================================

    public function insertBatch($program, $class, $batchname, $timefrom, $timeto) {
        $response = array();

        // Check if the batch name exists
        function batchnameExists($batchname_to_check, $conn) {
            $sql = "SELECT * FROM batch WHERE name=:name_to_check";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name_to_check', $batchname_to_check, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        $batchname_to_check = $batchname;

        // Perform data validation
        if (empty($program) || empty($class) || empty($batchname) || empty($timefrom) || empty($timeto)) {
            $response['success'] = false;
            $response['message'] = "All fields are required.";
        } elseif (batchnameExists($batchname_to_check, $this->conn)) {
            $response['success'] = false;
            $response['message'] = "Batch name already exists";
        } else {
            // Data is valid, proceed with database insertion

            // Insert the batch data into the database (assuming you have a "batch" table)
            $sql = "INSERT INTO batch (name, program, class_id, time_from, time_to) 
                    VALUES (:batchname, :program, :class, :timefrom, :timeto)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':batchname', $batchname, PDO::PARAM_STR);
            $stmt->bindParam(':program', $program, PDO::PARAM_STR);
            $stmt->bindParam(':class', $class, PDO::PARAM_STR);
            $stmt->bindParam(':timefrom', $timefrom, PDO::PARAM_STR);
            $stmt->bindParam(':timeto', $timeto, PDO::PARAM_STR);

            // Insert notification data
            $sql1 = "INSERT INTO notification (type, message) 
                    VALUES ('Added a new Batch', 'Admin Added a $batchname')"; 

            $stmt1 = $this->conn->prepare($sql1);

            try {
                $this->conn->beginTransaction();

                $stmt1->execute(); // Execute notification query first
                $stmt->execute(); // Execute batch insertion

                $this->conn->commit();

                $response['success'] = true;
                $response['message'] = "Batch '$batchname' created successfully!";
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $response['success'] = false;
                $response['message'] = "Batch creation failed. Please try again.";
                // You can log or handle the exception as needed
            }
        }

        return $response;

    }

}
?>
