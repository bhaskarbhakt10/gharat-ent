<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/gharat-ent/hospital-management/backend/php-classes/patients/patientsTreatmentSymptom.php";

if (isset($_POST)) {
    $patient_id = $_POST['patient_id'];
    // $meds_id_val = explode('_',$_POST['select_value']);
    $meds_id = $_POST['select_value']; 

    $patientTreatSym = new PatientsTreatmentSymptom();
    $all_cols = $patientTreatSym->get_Db_cols($patient_id);
    if ($all_cols !== false) {
        if ($all_cols->num_rows > 0) {
            while ($row = $all_cols->fetch_assoc()) {
                $hospital_pMeds = $row['hospital_pMeds'];
            }
        }
    }

    $meds_arr = json_decode($hospital_pMeds, true);
    foreach ($meds_arr as $key => $value) {
        if($value['ID'] === $meds_id){
           $selected_arr = $meds_arr[$key];
        }
    }

    echo json_encode($selected_arr);

}
