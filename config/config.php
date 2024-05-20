<?php
$servername = 'localhost';
$username = 'root';
$password = 'Admin@12345';
$dbname = 'pte_lms_admin';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
} catch (mysqli_sql_exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
