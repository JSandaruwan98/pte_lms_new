<?php
include '../config/config.php';

$sql = "SELECT student_id, name, password FROM student";

$result = $conn->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

function check_credentials($username, $password, $credentials) {
    foreach ($credentials as $credential) {
        $user = $credential['student_id']; 
        $pwd = $credential['password']; 
        if ($username === $user && $password === $pwd) {
            return $credential['student_id'];
        }
    }
    return false; 
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $student_id = check_credentials($username, $password, $data);
        if ($student_id !== false) {
            $_SESSION['u_id'] = $student_id;
            $_SESSION['name'] = $username;
            header("Location: ../");
        } else if($username == 'Admin' && $password == 'Admin') {
            $_SESSION['u_id'] = 'admin';
            header("Location: ../");
        }else{
            header("Location: login.html#1");
        }

    } else {
        echo 'Username and password are required.';
        exit;
    }
}


?>
