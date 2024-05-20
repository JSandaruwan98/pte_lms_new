<?php
function checkRole($requiredRole) {
    session_start();
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != $requiredRole) {
        echo '<script type="text/javascript">';
        echo 'alert("Access Denied: You do not have permission to access this page.");';
        echo 'window.location.href = "./";';
        echo '</script>';
        exit();
    }
}

function checkRoleOthers($requiredRole) {
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != $requiredRole) {
        echo '<script type="text/javascript">';
        echo 'alert("Access Denied: You do not have permission to access this page.");';
        echo 'window.location.href = "./";';
        echo '</script>';
        exit();
    }
}
?>