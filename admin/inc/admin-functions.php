<?php
ob_start();
session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['loggedin'] === true && array_key_exists('user', $_SESSION)) {
    $user_id = $_SESSION['user']['id'];
    // print_r( $_SESSION['user']);
    // print_r(session_id());
} else {
    header('Location: ../404');
}

require_once $_SERVER['DOCUMENT_ROOT']. '/hospital-management/backend/php-classes/admin/admin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patients.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php";


$admin = new Admin();
$admin->get_user_id($user_id);

?>