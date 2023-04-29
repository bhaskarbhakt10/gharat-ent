<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/patients/patients.php';
// require_once '../../php-classes/patients/patients.php';


if (isset($_POST)) {
    //extra fields
    $new_array = array();
    $extra_field = $_POST['extra_field'];
    foreach ($extra_field as $key => $value) {
        foreach ($value as $k => $v) {
            $new_array[$v['name']] = $v['value'];
        }
    }
    // print_r($new_array);
    $add_patient_same_number = $new_array['add_patient_same_number'];
    $parent = $new_array['parent'];
    $replationship = $new_array['replationship'];
    $other_relationship = $new_array['other_relationship'];



    
}