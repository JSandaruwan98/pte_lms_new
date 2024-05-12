<?php

class StudentModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function insertStudent($studentid, $name, $phone, $program, $batchid, $starton)
    {
        $response = array();

        // Define regular expressions for phone number validation
        $phoneRegex = "/^\d{10}$/"; // Assuming a 10-digit phone number format
        
        // Perform data validation
        if (empty($name) || empty($phone) || empty($program) || empty($batchid) || empty($starton)) {
            $response['success'] = false;
            $response['message'] = "All fields are required.";
        } elseif (!preg_match($phoneRegex, $phone)) {
            $response['success'] = false;
            $response['message'] = "Invalid phone number. Please enter a 10-digit number.";
        } else {
            $numericPart = preg_replace('/[^0-9]/', '', $studentid);
            $stu_id = (int)$numericPart;
        
            // Insert the student data into the database (assuming you have a "student" table)
            $sql = "INSERT INTO student (name, phone) VALUES (:name, :phone)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        
            // Insert the student into the batch (assuming you have an "assignstudent" table)
            $sqlnext = "INSERT INTO assignstudent (batch_id, student_id, enrollment_date) 
                        VALUES (:batchid, :stu_id, :starton)";
            $stmtnext = $this->conn->prepare($sqlnext);
            $stmtnext->bindParam(':batchid', $batchid, PDO::PARAM_INT);
            $stmtnext->bindParam(':stu_id', $stu_id, PDO::PARAM_INT);
            $stmtnext->bindParam(':starton', $starton, PDO::PARAM_STR);
        
            // Insert notification data
            $sql1 = "INSERT INTO notification (type, message) 
                     VALUES ('Enrol a Student', 'Admin Enroll a new student of $name')";
            $stmt1 = $this->conn->prepare($sql1);
        
            try {
                $this->conn->beginTransaction();
        
                $stmt1->execute(); // Execute notification query first
                $stmt->execute(); // Execute student insertion
                $stmtnext->execute(); // Execute batch assignment
        
                $this->conn->commit();
        
                $response['success'] = true;
                $response['message'] = "Student '$name' created successfully!";
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $response['success'] = false;
                $response['message'] = "Student creation failed. Please try again.";
                // You can log or handle the exception as needed
            }
        }
        
        return $response;
        
    }

//===============================================================================================================================================

    public function getStudentId() {
        $query = "SELECT MAX(student_id) as max_id FROM student";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && isset($row["max_id"])) {
            $maxID = $row["max_id"];
            $nextID = "STU" . str_pad(($maxID + 1), 4, "0", STR_PAD_LEFT);
            return $nextID;
        } else {
            return "STU0001";
        }    
    }

}

?>
