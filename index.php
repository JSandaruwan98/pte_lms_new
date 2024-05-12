<?php
$url = isset($_GET['url']) ? $_GET['url'] : '/';

session_start();
$student_id = isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '';

if(isset($student_id)){
    $routes = [
        '/' => 'pages/dashboard.php',
        '/Exams' => 'pteTest.html',
        '/Evaluation' => 'evaluationSheet.html',   
    ];
}else{
    header("Location: login/login.html");
}

echo "<script>";
echo "console.log('Student ID:', '$student_id');";
echo "</script>";

if (array_key_exists($url, $routes)) {
    include __DIR__ . '/' . $routes[$url];
} else { 
    echo "404 Not Found";
}
