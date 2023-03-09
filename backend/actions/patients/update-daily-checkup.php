<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/patients/patientsHistory.php';

if (isset($_POST)) {
    $form_data__ = $_POST['form_data'];

    // print_r($form_data__);
    $form_data = array();
    foreach ($form_data__ as $data) {
        foreach ($data as $key => $value) {
            $form_data[$key] = $value;
        }
    }
    // print_r($form_data);

    $patient_weight = $form_data['patient_weight_up'];
    if (array_key_exists('patient_height_foot_up', $form_data) && array_key_exists('patient_height_inch_up', $form_data) && !empty($form_data['patient_height_inch_up'])) {
        $patient_height = $form_data['patient_height_foot_up'] . " Foot " . $form_data['patient_height_inch_up'] . " Inches";
    } else {
        $patient_height = $form_data['patient_height_foot_up'] . " Foot ";
    }
    $patient_diabetes = $form_data['patient_diabetes_up'];
    $patient_bp = $form_data['patient_bp_up'];
    $pid = $form_data['p_id'];

    $upRegular = new PatientHistory();
    if (!empty($patient_weight) && !empty($patient_height) && !empty($patient_diabetes) && !empty($patient_bp)) {
        $upRegular->get_patient_history($patient_weight, $patient_height, $patient_diabetes, $patient_bp, $pid);
        if ($upRegular->Update_His($pid) === true) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
