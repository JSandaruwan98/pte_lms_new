<?php

class StudentModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================    

    public function insertStudent($studentid, $name, $password, $phone, $program, $batchid, $starton)
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
            $sql = "INSERT INTO student (student_id, name, phone, password) VALUES (:id, :name, :phone, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $studentid, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            $currentDate = date("Y-m-d");
            // Insert the student into the batch (assuming you have an "assignstudent" table)
            $sqlnext = "INSERT INTO assignstudent (batch_id, student_id, enrollment_date) 
                        VALUES (:batchid, :stu_id, :starton)";
            $stmtnext = $this->conn->prepare($sqlnext);
            $stmtnext->bindParam(':batchid', $batchid, PDO::PARAM_INT);
            $stmtnext->bindParam(':stu_id', $studentid, PDO::PARAM_STR);
            $stmtnext->bindParam(':starton', $currentDate, PDO::PARAM_STR);
        
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
        $query = "SELECT CONCAT('STU', LPAD(MAX(CAST(SUBSTRING(student_id, 4) AS UNSIGNED)) + 1, 5, '0')) AS next_id FROM student";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nextID = $row["next_id"];
            return $nextID;
        } else {
            return "STU0001";
        }
    }

//===============================================================================================================================================

    // ExistingPassword
    function getExistingPasswords() {
        $existingPasswords = array();
        $query = "SELECT password FROM student";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $existingPasswords[] = $row['password'];
            }
            $stmt->closeCursor(); 
        } else {
            echo "Error: " . $this->conn->errorInfo()[2];
        }

        return $existingPasswords;

    }
    
    // Generate the Random String
    function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $randomString = '';
        $numCharacters = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $numCharacters - 1)];
        }
        return $randomString;
    }
    
    //Genarate the Passwords
    public function getStudentPassword() {
        $nameCharacters = $this->generateRandomString(5);
        $existingPasswords = $this->getExistingPasswords();
        
    
        $randomNumber = rand(100, 999);
        $password = $nameCharacters . $randomNumber; 
        
        while (in_array($password, $existingPasswords)) {
            $nameCharacters = $this->generateRandomString(6);
            $password = $nameCharacters . $randomNumber;
        }
        
        return $password;
    }

}

//===============================================================================================================================================




?>
