<?php
include '../config/connection.php';
include '../model/admin/employee.php';
include '../model/admin/batch.php';
include '../model/admin/student.php';
include '../model/admin/checkbox.php';

$employee = new EmployeeModel($conn);
$batch = new BatchModel($conn);
$student = new StudentModel($conn);
$checkbox = new Checkbox($conn);

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
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $batchid = $_POST['batchid'];
        $starton = $_POST['starton'];
        $starton = $_POST['day'];
         

        $response = $student->insertStudent($studentid, $name, $phone, $program, $batchid, $starton);

    }elseif ($task === 'studentAdd') {

        $studentid = $_POST['studentid'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $program = $_POST['program'];
        $batchid = $_POST['batchid'];
        $starton = $_POST['starton'];
        $starton = $_POST['day'];
         

        $response = $student->insertStudent($studentid, $name, $phone, $program, $batchid, $starton);
    }elseif ($task === 'checkbox') {

        $featureEnabled = ($_POST['isChecked'] === 'true') ? 1 : 0; // Convert to 1 or 0
        $id = $_POST['id'];
        $table = $_POST['table'];
        $idName = $_POST['nameofid'];

        $response = $checkbox->checkboc($table, $featureEnabled, $idName, $id);

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
    }

    
}

header('Content-Type: application/json');
echo json_encode($response);

$conn = null;
?>