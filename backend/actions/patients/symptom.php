<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php';

if (isset($_POST)) {
    $all_data = $_POST['merged_array'];
    $unique_names = $_POST['unique_names'];
    $patient_id = $_POST['patient_id'];
    $formid = $_POST['formid'];

    $symptom_array = array();
    foreach ($unique_names as $unique_name) {
        $symptom_array[$unique_name] = '';
    }
    // print_r($all_data);

    foreach ($all_data as $Data) {
        $value = '';
        if (array_key_exists($Data['name'], $symptom_array)) {

            foreach ($Data['value'] as $val) {
                if ($val !== '') {
                    $value .= $val . ',';
                } else {
                    $value .= "N/A" . ',';
                }
            }
            $symptom_array[$Data['name']] = rtrim($value, ',');
        }
    }
    // print_r($symptom_array);

    $symptom_name = $symptom_array['symptom_name'];
    $symptom_type = $symptom_array['symptom_type'];
    $symptom_days = $symptom_array['symptom_days'];

    if (!empty($symptom_name) && !empty($symptom_type) && !empty($symptom_days)) {
        $symptom = new PatientsTreatmentSymptom();
        $symptom->get_Details($symptom_array,$patient_id,$formid);
        if ($symptom->send_sym_to_DB($patient_id) === true) {
            echo "success";
        } else {
            echo "failure";
        }
    }
}
