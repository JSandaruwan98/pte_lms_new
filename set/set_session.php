<?php
session_start();

if(isset($_POST['page_name'])) {
    $_SESSION["page_name"] = $_POST['page_name'];


    echo 'asd' ;
} else {
    echo "Error: Page name not provided";
}
?>
