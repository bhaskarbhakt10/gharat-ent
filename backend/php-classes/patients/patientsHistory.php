<?php
require_once '../../database/config.database.php';
require_once '../../constants/constants-static.php';

// require_once '.patients.php';

class PatientHistory extends Patients
{

    private $db;

    private $patient_height;
    private $patient_weight;
    private $patient_bp;
    private $patient_diabetes;

    function __construct()
    {
        $this->db = new Database();
    }

    function get_patient_history($patient_weight, $patient_height, $patient_diabetes, $patient_bp)
    {
        $this->patient_height = $patient_height;
        $this->patient_weight = $patient_weight;
        $this->patient_bp = $patient_bp;
        $this->patient_diabetes = $patient_diabetes;
        $this->send_to_DB();
    }

    function check_if_patientId_exist_in_history(){
        $p_id = $this->patientId;
        $sql =  "SELECT * FROM " . PATIENTS_HIS . " WHERE hospital_pID='$p_id'";
        $res = $this->db->connect()->query($sql);
        if($res->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function Insert_His(){
        $sql = "INSERT INTO " . PATIENTS_HIS . "(hospital_pID, hospital_phistory) VALUES ('".$this->patientId."','testttt')";
        $res = $this->db->connect()->query($sql);
        if($res){
            return true;
        }
        else{
            return false;
        }
    }


    // function update_His(){
    //     $sql = "UPDATE ". PATIENTS_HIS ."SET hospital_phistory='testt' WHERE hospital_pID='".$this->patientId."'";    
    // }

    function send_to_DB(){
        if($this->check_if_patientId_exist_in_history() === true ){
            $this->Insert_His();
        } 
        else{

        }
    }

}
