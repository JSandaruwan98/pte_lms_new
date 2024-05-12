<?php

class EmployeeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

//===============================================================================================================================================

    //insert the employee
    public function insertEmployee($name, $email, $role, $phone, $address, $qualification, $uname, $pass, $DOB)
    {
        $response = array();

        // Define regular expressions for password strength, email, and phone number validation
        $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/";
        $emailRegex = "/^\S+@\S+\.\S+$/";
        $phoneRegex = "/^\d{10}$/"; // Assuming a 10-digit phone number format

        // Check if the username exists
        function usernameExists($username_to_check, $conn) {
            $sql = "SELECT * FROM employee WHERE username=:username_to_check";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username_to_check', $username_to_check, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }

        $username_to_check = $uname;

        // Perform data validation
        if (empty($name) || empty($email) || empty($role) || empty($phone) || empty($address) || empty($qualification) || empty($uname) || empty($pass)) {
            $response['success'] = false;
            $response['message'] = "All fields are required.";
        } elseif (!preg_match($passwordRegex, $pass)) {
            $response['success'] = false;
            $response['message'] = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        } elseif (!preg_match($emailRegex, $email)) {
            $response['success'] = false;
            $response['message'] = "Invalid email address.";
        } elseif (!preg_match($phoneRegex, $phone)) {
            $response['success'] = false;
            $response['message'] = "Invalid phone number. Please enter a 10-digit number.";
        } elseif (usernameExists($username_to_check, $this->conn)) {
            $response['success'] = false;
            $response['message'] = "Username already exists";
        } else {
            // Data is valid, proceed with database insertion

            // Hash the password before storing it in the database (for security)
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            // Insert the employee data into the database (assuming you have an "employees" table)
            $sql = "INSERT INTO employee (name, email, role, phone, address, qualification, username, password, date_of_birth, activation) 
                    VALUES (:name, :email, :role, :phone, :address, :qualification, :username, :password, :DOB, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':qualification', $qualification, PDO::PARAM_STR);
            $stmt->bindParam(':username', $uname, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':DOB', $DOB, PDO::PARAM_STR);

            // Insert notification data
            $sql1 = "INSERT INTO notification (type, message) 
                    VALUES ('New Employee Added', 'Admin Added a $name')";

            $stmt1 = $this->conn->prepare($sql1);

            try {
                $this->conn->beginTransaction();

                $stmt1->execute(); // Execute notification query first
                $stmt->execute(); // Execute employee insertion

                $this->conn->commit();

                $response['success'] = true;
                $response['message'] = "Employee '$name' created successfully!";
            } catch (PDOException $e) {
                $this->conn->rollBack();
                $response['success'] = false;
                $response['message'] = "Employee creation failed. Please try again.";
                // You can log or handle the exception as needed
            }
        }

        return $response;

    }


}
?>
