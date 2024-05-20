<?php
include '../config/connection.php';
include '../model/admin/class.php';
include '../model/admin/batch.php';
include '../model/admin/student.php';
include '../model/student/exam_model.php';
include '../model/student/questions.php';
include '../model/evaluation.php';

$class = new ClassModel($conn);
$batch = new BatchModel($conn);
$student = new StudentModel($conn);
$exam = new ExamModel($conn);
$question = new QuestionsModel($conn);
$evaluation = new EvaluationSheet($conn);
session_start();
$student_id = $_SESSION['user_id'];

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
    }elseif ($data_type === 'checkedExam') {
        $test_id = $_GET['test_id'];
        $data = $exam->checkedExam($test_id, $student_id);
    }elseif ($data_type === 'getQuestion') {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perPage = isset($_GET['per_page']) ? $_GET['per_page'] : 5;
        $offset = ($page - 1) * $perPage;
        $test_id = $_GET['test_id'];
        $type = $_GET['type'];

        $data = $question->getQuestions($perPage, $offset, $test_id, $type, $student_id);
    }elseif ($data_type === 'startPage') {
        $test_id = $_GET['test_id'];
        $data = $question->startPage($test_id, $student_id);
    }elseif ($data_type === 'evaluationSheet'){
        $test_id = $_GET['test_id'];
        $student_id = $_GET['student_id'];
            
        $data = $evaluation->evaluationSheet($test_id, $student_id);

    }elseif ($data_type === 'pendEvalSheet'){
        $test_id = $_GET['test_id'];
        $student_id = $_GET['student_id'];
            
        $data = $evaluation->pendingEvaluationSheet($test_id, $student_id);


    }

    header('Content-Type: application/json');
    echo json_encode($data);
}else {
    echo "Specify data_type parameter (batch or class)";
}


$conn = null;
?>