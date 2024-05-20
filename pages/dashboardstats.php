<?php
require_once '../config/config.php';

$totalStudents = 0;
$totalEmployees = 0;

$sqlStudents = "SELECT COUNT(*) as total FROM student";
$resultStudents = $conn->query($sqlStudents);
if ($resultStudents) {
    $row = $resultStudents->fetch_assoc();
    $totalStudents = $row['total'];
}

$sqlEmployees = "SELECT COUNT(*) as total FROM employee";
$resultEmployees = $conn->query($sqlEmployees);
if ($resultEmployees) {
    $row = $resultEmployees->fetch_assoc();
    $totalEmployees = $row['total'];
}

$sqlTestsAssigned = "SELECT COUNT(*) as total FROM testass";
$resultTestsAssigned = $conn->query($sqlTestsAssigned);
if ($resultTestsAssigned) {
    $row = $resultTestsAssigned->fetch_assoc();
    $totalTestsAssigned = $row['total'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <h1 class="card-text"><?php echo $totalStudents; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Employees</h5>
                        <h1 class="card-text"><?php echo $totalEmployees; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assigned Tests</h5>
                        <h1 class="card-text"><?php echo $totalTestsAssigned; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // To be done AVI
        
    </script>
</body>
</html>
