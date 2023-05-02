<?php
// require_once '../../database/config.database.php';
// require_once '../../constants/constants-static.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/hospital-management/backend/database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/hospital-management/backend/constants/constants-static.php';



class PatientHistory
{

    private $db;

    private $patient_height;
    private $patient_weight;
    private $patient_bp;
    private $patient_diabetes;
    private $pulse_rate;
    private $patient_SPOF;
    private $patient_oxygen;

    private $pID;

    function __construct()
    {
        $this->db = new Database();
    }

    function get_patient_history($patient_weight,$patient_height,$patient_diabetes,$patient_bp ,$pulse_rate,$patient_SPOF,$patient_oxygen,$pid)
    {
        $this->patient_height = $patient_height;
        $this->patient_weight = $patient_weight;
        $this->patient_bp = $patient_bp;
        $this->patient_diabetes = $patient_diabetes;
        $this->pulse_rate = $pulse_rate;
        $this->patient_SPOF = $patient_SPOF;
        $this->patient_oxygen = $patient_oxygen;
        $this->pID = $pid;
    }

    function regular_check_history_obj()
    {
        date_default_timezone_set(TIMEZONE_IN);
        $date =  new DateTime();
        $now_date = $date->format("d_m_y_h_m_s");
        $date_today =  $date->format("d_m_Y");
        $time_now =  $date->format("h_i_s_A");
        $regular_check[$now_date] = array('height' => '', 'weight' => '', 'bp' => '', 'diabetes' => '', 'pulse_rate'=>'','SPOF'=>'', 'oxygen'=>'');
        $regular_check[$now_date]['height'] = $this->patient_height;
        $regular_check[$now_date]['weight'] = $this->patient_weight;
        $regular_check[$now_date]['bp'] = $this->patient_bp;
        $regular_check[$now_date]['diabetes'] = $this->patient_diabetes;
        $regular_check[$now_date]['pulse_rate'] = $this->pulse_rate;
        $regular_check[$now_date]['SPOF'] = $this->patient_SPOF;
        $regular_check[$now_date]['oxygen'] = $this->patient_oxygen;
        $regular_check[$now_date]['date'] = $date_today;
        $regular_check[$now_date]['time'] = $time_now;
        $regular_checkup = json_encode($regular_check);
        return $regular_checkup;
    }



    function check_if_patientId_exist_in_history()
    {
        $p_id = $this->pID;
        $sql =  "SELECT * FROM " . PATIENTS_HIS . " WHERE hospital_pID='$p_id'";
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Insert_His()
    {
        $regular_check = $this->regular_check_history_obj();
        $p_id = $this->pID;
        $sql = "INSERT INTO " . PATIENTS_HIS . "(hospital_pID, hospital_phistory) VALUES ('" . $p_id . "','$regular_check')";
        $res = $this->db->connect()->query($sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    function Update_His($pid){
        $newjson = $this->regular_check_history_obj();
        $already_db_json = $this->get_checkupHis($pid);
        $new_arr = json_decode($newjson, true);
        $already_db_arr = json_decode($already_db_json, true);
        $merged_array = array_merge($new_arr,$already_db_arr);
        $merged_json = json_encode($merged_array);

        if(!empty($already_db_json)){
            $sql = "UPDATE ". PATIENTS_HIS . " SET hospital_phistory='".$merged_json."' WHERE hospital_pID='".$pid."'";
            // echo $sql;
            $this->db->connect()->query($sql);
            return true;
        }
        return false;

        


    }


    function send_to_DB()
    {
        if ($this->check_if_patientId_exist_in_history() === false) {
            $this->Insert_His();
            return true;
        } else {
            return false;
        }
    }

    function get_checkupHis($pid){
        $sql =  "SELECT * FROM " . PATIENTS_HIS . " WHERE hospital_pID='$pid'";
        $res = $this->db->connect()->query($sql);
        if($res->num_rows>0){
            while($row = $res->fetch_assoc()){
                return $row['hospital_phistory'];
            }
        }
    }
}
