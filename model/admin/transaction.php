<?php

class TransactionModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function insertTransaction($transaction_type, $amount, $date, $description, $type, $student_id)
    {
        $response = array();
        
        // Perform data validation
        if (empty($transaction_type) || empty($amount) || empty($date) || empty($description) || empty($type)) {
            $response['success'] = false;
            $response['message'] = "All fields are required.";
        } else {
        
            try {
                // Begin transaction
                $this->conn->beginTransaction();
            
                // Prepare SQL statement
                $sql = "INSERT INTO transaction (transactiontype, type, amount, date, description, student_id) 
                        VALUES ('$transaction_type', '$type', $amount, '$date', '$description', '$student_id')";
                $stmt = $this->conn->prepare($sql);
            
                // Execute the statement
                $stmt->execute();
            
                // Commit transaction
                $this->conn->commit();
            
                $response['success'] = true;
                $response['message'] = "Transaction created successfully!";
            } catch (PDOException $e) {
                // Rollback transaction if there's an error
                $this->conn->rollBack();
                $response['success'] = false;
                $response['message'] = "Error: " . $e->getMessage();
            }
            
        }
        
        return $response;
        
    }

//===============================================================================================================================================

    
//===============================================================================================================================================


}

?>
