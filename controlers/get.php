<?php
include '../config/connection.php';
include '../model/admin/class.php';
include '../model/admin/batch.php';
include '../model/admin/student.php';

$class = new ClassModel($conn);
$batch = new BatchModel($conn);
$student = new StudentModel($conn);

if (isset($_GET['data_type'])) {
    $data_type = $_GET['data_type'];

    if ($data_type === 'getClass') {
        $data = $class->getClass();
    }elseif ($data_type === 'getBatch') {
        $data = $batch->getBatch();
    }elseif ($data_type === 'getStudentId') {
        $data = $student->getStudentId();
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}else {
    echo "Specify data_type parameter (batch or class)";
}


$conn = null;
?>