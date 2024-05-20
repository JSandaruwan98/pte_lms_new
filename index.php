<?php
$url = isset($_GET['url']) ? $_GET['url'] : '/';

session_start();

if(isset($_SESSION['user_role'])){
    $routes = [
        '/' => 'pages/dashboard.php',
        '/Exams' => 'pages/student/exam.php',
        '/Evaluation' => 'pages/evaluation_sheet/view.php',  
        '/PendingEvaluation' => 'pages/evaluation_sheet/submit.php',   
    ];
}else{
    header("Location: login/login.html");
}


if (array_key_exists($url, $routes)) {
    include __DIR__ . '/' . $routes[$url];
} else { 
    echo "404 Not Found";
}
