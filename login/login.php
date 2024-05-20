<?php
include '../config/connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch student
    $studentQuery = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
    $studentQuery->execute([$username]); 
    $student = $studentQuery->fetch();

    // Fetch admin
    $adminQuery = $conn->prepare("SELECT * FROM user WHERE name = ?");
    $adminQuery->execute([$username]);
    $admin = $adminQuery->fetch();

    if ($student && $password === $student['password']) {
        $_SESSION['user_id'] = $student['student_id'];
        $_SESSION['username'] = $student['name'];
        $_SESSION['user_role'] = 'student';
        header("Location: ../");
        echo 'Student found';
    } elseif ($admin && $password === $admin['user_password']) {
        $_SESSION['user_id'] = 'admin';
        $_SESSION['username'] = $admin['name'];
        $_SESSION['user_role'] = 'admin';
        header("Location: ../");
        echo 'Admin found';
    } else {
        header("Location: login.html#1");
        echo 'Student or Admin not found';
    }
}
?>
