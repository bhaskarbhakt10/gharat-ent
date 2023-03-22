<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/patients/patients.php';


if (isset($_POST)) {
    //get data via akax in an array
    $arr_post = $_POST['post'];
    // print_r($arr_post);


    //get data from array
    $patient_suffix = $arr_post['patient_suffix'];
    $patient_first_name = $arr_post['patient_first_name'];
    $patient_middle_name = $arr_post['patient_middle_name'];
    $patient_last_name = $arr_post['patient_last_name'];
    $patient_gender = $arr_post['patient_gender'];
    if (!empty($arr_post['patient_other_gender']) && array_key_exists('patient_other_gender', $arr_post)) {
        $patient_gender .= "-" . $arr_post['patient_other_gender'];
    }

    $patient_dob = $arr_post['patient_dob'];
    $patient_contact_number = $arr_post['patient_contact_number'];
    $patient_email = $arr_post['patient_email'];
    $patient_address = $arr_post['patient_address'];
    $patient_update_id = $arr_post['update_id'];

    if(!empty($patient_suffix) && !empty($patient_first_name) && !empty($patient_last_name) && !empty($patient_gender) && !empty($patient_dob) && !empty($patient_contact_number) && !empty($patient_update_id)){
        $add_patient = new Patients();
        if($add_patient->update_details($patient_update_id, $patient_suffix,$patient_first_name,$patient_middle_name,$patient_last_name,$patient_gender,$patient_dob,$patient_contact_number,$patient_email,$patient_address) === true){
            echo "success";
        }
        else{
            echo "false";
        }
    }

}
