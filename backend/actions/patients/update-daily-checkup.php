<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/php-classes/patients/patientsHistory.php';

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

    $patient_weight = $form_data['patient_weight'];
    if (array_key_exists('patient_height_foot', $form_data) && array_key_exists('patient_height_inch', $form_data) && !empty($form_data['patient_height_inch'])) {
        $patient_height = $form_data['patient_height_foot'] . " ft " . $form_data['patient_height_inch'] . " in";
    } else {
        $patient_height = $form_data['patient_height_foot'] . " ft ";
    }
    $patient_diabetes = $form_data['patient_diabetes'];
    $patient_bp = $form_data['patient_bp'];
    $pulse_rate = $form_data['pulse_rate'];
    $patient_SPOF = $form_data['patient_SPOF'];
    $patient_oxygen = $form_data['patient_oxygen'];

    $pid = $form_data['p_id'];

    $upRegular = new PatientHistory();
    if (!empty($patient_weight) && !empty($patient_height) && !empty($patient_diabetes) && !empty($patient_bp)) {
        $upRegular->get_patient_history($patient_weight,$patient_height,$patient_diabetes,$patient_bp ,$pulse_rate,$patient_SPOF,$patient_oxygen,$pid);
        if ($upRegular->Update_His($pid) === true) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
