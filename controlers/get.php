<?php
include '../config/connection.php';
include '../model/admin/class.php';
include '../model/admin/batch.php';
include '../model/admin/student.php';
include '../model/student/exam.php';

$class = new ClassModel($conn);
$batch = new BatchModel($conn);
$student = new StudentModel($conn);
$exam = new ExamModel($conn);

session_start();
$student_id = $_SESSION['u_id'];

if (isset($_GET['data_type'])) {
    $data_type = $_GET['data_type'];

    if ($data_type === 'getClass') {
        $data = $class->getClass();
    }elseif ($data_type === 'getBatch') {
        $data = $batch->getBatch();
    }elseif ($data_type === 'getStudentId') {
        $data = $student->getStudentId();
    }elseif ($data_type === 'getStudentPassword') {
        $data = $student->getStudentPassword();
    }elseif ($data_type === 'pendingExam') {
        $category = $_GET['category'];
        $data = $exam->pendingExam($category, $student_id);
    }elseif ($data_type === 'completeExam') {
        $category = $_GET['category'];
        $data = $exam->completeExam($category, $student_id);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}else {
    echo "Specify data_type parameter (batch or class)";
}


$conn = null;
?>