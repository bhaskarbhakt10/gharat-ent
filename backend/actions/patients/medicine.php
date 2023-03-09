<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php';

if (isset($_POST)) {
    $all_data = $_POST['merged_array'];
    $unique_names = $_POST['unique_names'];
    $patient_id = $_POST['patient_id'];

    $medicine_array = array();
    foreach ($unique_names as $unique_name) {
        $medicine_array[$unique_name] = '';
    }
    // print_r($all_data);

    foreach ($all_data as $Data) {
        $value = '';
        if (array_key_exists($Data['name'], $medicine_array)) {

            foreach ($Data['value'] as $val) {
                if($val !== ''){
                    $value .= $val . ',';
                }
                else{
                    $value .= "N/A". ',';
                }
            }
            $medicine_array[$Data['name']] = rtrim($value, ',');
        }
    }
    
    $medicine_name = $medicine_array['medicine_name'];
    $medicine_qty = $medicine_array['medicine_qty'];
    $medicine_volume = $medicine_array['medicine_volume'];
    $medicine_pattern = $medicine_array['medicine_pattern'];
    $medicine_notes = $medicine_array['medicine_notes'];


    if(!empty($medicine_name) && !empty($medicine_qty) && !empty($medicine_volume) && !empty($medicine_pattern) ){
        $medicine = new PatientsTreatmentSymptom();
        $medicine->get_Details($medicine_array);
        if($medicine->send_meds_to_DB($patient_id) === true){
            echo "Sucess";
        }
        else{
            echo "Failure";
        }
    }

}
