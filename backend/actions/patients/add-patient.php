<?php
require_once '../../php-classes/patients/patients.php';
require_once '../../php-classes/patients/patientsHistory.php';
if(isset($_POST)){
    //get data via akax in an array
    $arr_post = $_POST['post'];
    // print_r($arr_post);

    
    //get data from array
    $patient_suffix = $arr_post['patient_suffix'];
    $patient_first_name = $arr_post['patient_first_name'];
    $patient_middle_name = $arr_post['patient_middle_name'];
    $patient_last_name = $arr_post['patient_last_name'];
    $patient_gender = $arr_post['patient_gender'];
    if(!empty($arr_post['patient_other_gender']) && array_key_exists('patient_other_gender', $arr_post)){
        $patient_gender .= $arr_post['patient_other_gender'];
    }

    $patient_dob = $arr_post['patient_dob'];
    $patient_contact_number = $arr_post['patient_contact_number'];
    $patient_email = $arr_post['patient_email'];
    $patient_address = $arr_post['patient_address'];

    $patient_weight = $arr_post['patient_weight'];
    if(array_key_exists('patient_height_foot', $arr_post) && array_key_exists('patient_height_inch',$arr_post) && !empty($arr_post['patient_height_inch'])){
        $patient_height = $arr_post['patient_height_foot']."Foot " . $arr_post['patient_height_inch']."Inches";
    }
    else{
        $patient_height = $arr_post['patient_height_foot']."Foot ";
    }
    $patient_diabetes = $arr_post['patient_diabetes'];
    $patient_bp = $arr_post['patient_bp'];

    $medical_history = array('patient_addiction'=>'','patient_health_condition'=>'');
    $patient_addiction = $arr_post['patient_addiction'];
    $patient_health_condition = $arr_post['patient_health_condition'];

    $past_treatment_array = array_filter($arr_post, function($key) {
        return strpos($key, 'past_treatment') === 0;
    }, ARRAY_FILTER_USE_KEY);

    // print_r($past_treatment_array);
    
    if(!empty($past_treatment_array) ){
        array_push($medical_history, $past_treatment_array);
    }
    
    $past_surgeries_array = array_filter($arr_post, function($key) {
        return strpos($key, 'past_surgeries') === 0;
    }, ARRAY_FILTER_USE_KEY);
    
    if(!empty($past_surgeries_array) ){
        array_push($medical_history, $past_surgeries_array);
    }

    // array_push($medical_history, $patient_addiction);
    // array_push($medical_history, $patient_health_condition);
    $medical_history['patient_addiction'] = $patient_addiction;
    $medical_history['patient_health_condition'] = $patient_health_condition ;

    $medical_history_obj = json_encode($medical_history);
    // print_r($medical_history_obj);
    
     


    //check if not empty

    if(!empty($patient_suffix) && !empty($patient_first_name) && !empty($patient_last_name) && !empty($patient_gender) && !empty($patient_dob) && !empty($patient_contact_number)){
        $add_patient = new Patients();
        $added_sucess = $add_patient->get_details($patient_suffix,$patient_first_name,$patient_last_name,$patient_gender,$patient_dob,$patient_contact_number, $patient_middle_name, $patient_email,$patient_address ,$medical_history_obj);
        $send_to_DB = $add_patient->send_to_db();
        if( $send_to_DB !== false){
            $pid = $send_to_DB;
            $patientsHis = new PatientHistory();
            $patientsHis->get_patient_history($patient_weight,$patient_height,$patient_diabetes,$patient_bp,$pid);
            if($patientsHis->send_to_DB() === true){
                echo "success";
            }
            
        }
        else{
            echo "failure";
        }
    }
    else{

    }
}