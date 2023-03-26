<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patients.php";
if(isset($_POST)){
    $number = $_POST['number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $patients  = new Patients();
    print_r($patients->getDetailsByNumber($number, $first_name, $last_name));
}