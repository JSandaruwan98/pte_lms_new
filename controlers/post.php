<?php
session_start();
include '../config/connection.php';
include '../model/admin/employee.php';
include '../model/admin/batch.php';
include '../model/admin/student.php';
include '../model/admin/checkbox.php';
include '../model/student/exam_model.php';
include '../model/student/answers.php';
include '../model/scoring_tools/pronunciation.php';
include '../model/scoring_tools/compere.php';
include '../model/scoring_tools/similarity.php';
include '../model/scoring_tools/palmai.php';
include '../model/scoring_tools/grammar.php';
include '../model/evaluation.php';
include '../model/admin/transaction.php';

$employee = new EmployeeModel($conn);
$batch = new BatchModel($conn);
$student = new StudentModel($conn);
$checkbox = new Checkbox($conn);
$exam = new ExamModel($conn);
$answer = new AnswerModel($conn);
$pronunciation = new PronunciationModel($conn);
$compere = new SentenceCompareModel();
$similarity = new SimilarityModel($conn);
$grammar = new GrammarModel($conn);
$palmai = new PalmAIModel();
$evaluation = new EvaluationSheet($conn);
$transaction = new TransactionModel($conn);
$student_id = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['task'])) {
        $task = $_POST['task'];  
    }

    if ($task === 'employeeAdd') {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $qualification = $_POST['qualification'];
        $uname = $_POST['uname'];
        $pass = $_POST['password'];
        $DOB = $_POST['dob']; 

        $response = $employee->insertEmployee($name, $email, $role, $phone, $address, $qualification, $uname, $pass, $DOB);

    }elseif ($task === 'batchAdd') {
        $program = $_POST['program'];
        $class = $_POST['class'];
        $batchname = $_POST['batchname'];
        $timefrom = $_POST['timefrom'];
        $timeto = $_POST['timeto'];

        $response = $batch->insertBatch($program, $class, $batchname, $timefrom, $timeto);
    
    }elseif ($task === 'studentAdd') {

        $studentid = $_POST['studentid'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $batchid = $_POST['batchid'];
        $starton = $_POST['starton'];
         
        $response = $student->insertStudent($studentid, $name, $password, $phone, $program, $batchid, $starton);

    }elseif ($task === 'checkbox') {

        $featureEnabled = ($_POST['isChecked'] === 'true') ? 1 : 0; // Convert to 1 or 0
        $id = $_POST['id'];
        $table = $_POST['table'];
        $idName = $_POST['nameofid'];

        $response = $checkbox->checkboc($table, $featureEnabled, $idName, $id);

    }elseif ($task === 'marked') {

        $featureEnabled = ($_POST['isChecked'] === 'true') ? 1 : 0; // Convert to 1 or 0
        $attendace_id = $_POST['attendace_id'];
        $employee_id = $_POST['employee_id'];
        $idName = $_POST['nameofid'];
        $date = $_POST['date'];

        if($featureEnabled === 1){
            $response = $checkbox->markAttendance($date, $employee_id, $idName);
        }else if($featureEnabled === 0){
            $response = $checkbox->removeAttendance($attendace_id);
        }


    }elseif($task === 'assign&remove'){

        $featureEnabled = ($_POST['isChecked'] === 'true') ? 1 : 0; // Convert to 1 or 0
        $id = $_POST['id'];
        $table = $_POST['table'];
        $idName = $_POST['nameofid'];
        $batchId = $_POST['batchId'];
        if($featureEnabled){
            $response = $checkbox->testVideoAssign($batchId, $id, $featureEnabled, $table, $idName);
        }else{
            $response = $checkbox->testVideoRemove($batchId, $id, $featureEnabled, $table, $idName);
        }

    }elseif($task === 'attempted_data'){

        $test_id = $_POST['test_id'];
        $attempted = $_POST['attempted'];
        $response = $exam->setAttempted($test_id, $student_id, $attempted);

    }elseif($task === 'incomplete_exam'){

        $test_id = $_POST['test_id'];
        $response = $exam->updateIncomplteExam($test_id, $student_id, 2);

    }elseif($task === 'complete_exam'){

        $test_id = $_POST['test_id'];
        $response = $exam->updateIncomplteExam($test_id, $student_id, 1);

    }elseif($task === 'audio_save'){

        $audio = $_FILES['audio']['tmp_name'];
        $response = $answer->save_audio($audio,$student_id);

    }elseif($_POST['task'] == 'speaking-i'){

        require '../model/set_answer/speaking_i.php'; // Read Aloud & Repeat Sentence

    }elseif($_POST['task'] == 'speaking-ii'){

        require '../model/set_answer/speaking_ii.php'; // Describe Image , Re-tell Lecture & Answer Short Question

    }elseif($_POST['task'] == 'writing-i'){

        require '../model/set_answer/writing_i.php'; // Summerize Spoken  & Summerize Written

    }elseif($_POST['task'] == 'writing-ii'){

        require '../model/set_answer/writing_ii.php'; // Write Essay

    }elseif($_POST['task'] == 'reading_marks'){
        $user_answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $test_id = $_POST['test_id'];
        $score = $_POST['score'];

        $response = $answer->setAnswer($test_id, $user_answer, NAN, $question_id, $student_id, $score, 0, 0, 0, 0, NAN, NAN, NAN, 0, 0, 0, $score);
    }elseif($_POST['task'] == 'dictation'){

        require '../model/set_answer/dictation.php';
        
    }elseif ($task === 'transactionAdd') {
        $transaction_type = $_POST['transaction'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $student_id = $_POST['stu_id'];

        $response = $transaction->insertTransaction($transaction_type, $amount, $date, $description, $type, $student_id);
    
    }elseif ($task === 'update_evaluated') {
        $test_id = $_POST['test_id'];
        $student_id = $_POST['student_id'];
        $response = $evaluation->update_evaluated($test_id, $student_id);
    }    

    
}

header('Content-Type: application/json');
echo json_encode($response);

$conn = null;
?>