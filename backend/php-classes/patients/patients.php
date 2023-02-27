<?php
require_once '../../../backend/database/config.database.php';
require_once '../../../backend/constants/constants-static.php';



class Patients
{
    private $db;

    public $patientId;
    private $patient_suffix;
    private $patient_first_name;
    private $patient_middle_name;
    private $patient_last_name;
    private $patient_gender;
    private $patient_dob;
    private $patient_contact_number;
    private $patient_email;
    private $patient_address;

    function __construct()
    {
        $this->db = new Database();
    }


    function get_details($patient_suffix, $patient_first_name, $patient_last_name, $patient_gender, $patient_dob, $patient_contact_number, $patient_middle_name, $patient_email, $patient_address)
    {
        $this->patient_suffix = $patient_suffix;
        $this->patient_first_name = $patient_first_name;
        $this->patient_middle_name = $patient_middle_name;
        $this->patient_last_name = $patient_last_name;
        $this->patient_gender = $patient_gender;
        $this->patient_dob = $patient_dob;
        $this->patient_contact_number = $patient_contact_number;
        $this->patient_email = $patient_email;
        $this->patient_address = $patient_address;
        
    }

    function gen_patientID()
    {
        $sql = "SELECT * FROM " . PATIENTS;
        $res = $this->db->connect()->query($sql);
        $no_rows = $res->num_rows + 1;
        date_default_timezone_set(TIMEZONE_IN);
        $date = new DateTime();
        $year = $date->format('Y');
        $patientID = "AVHSP_" . $year . "P_" . $no_rows;
        return $patientID;
    }

    function send_PID(){
        return $this->patientId = $this->gen_patientID();
    }

    function check_PatientId_exist($id)
    {
        $sql = "SELECT * FROM " . PATIENTS . " WHERE hospital_PatientId='$id'";
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function send_to_db()
    {
        $patient_ID = $this->send_PID();
        $this->patientId = $patient_ID;
        $check_pat_id = $this->check_PatientId_exist($patient_ID);

        $sql = "INSERT INTO " . PATIENTS . " (hospital_PatientId, hospital_PatientSuffix, hospital_PatientFirstName, hospital_PatientMiddleName, hospital_PatientLastName, hospital_PatientGender, hospital_PatientDOB, hospital_PatientContactNumber, hospital_PatientEmail, hospital_PatientAddress) VALUES ('" . $patient_ID . "','" . $this->patient_suffix . "','" . $this->patient_first_name . "','" . $this->patient_middle_name . "','" . $this->patient_last_name . "','" . $this->patient_gender . "','" . $this->patient_dob . "','" . $this->patient_contact_number . "','" . $this->patient_email . "','" . $this->patient_address . "')";
        if ($check_pat_id === false) {
            $res = $this->db->connect()->query($sql);
            if ($res) {
                return $patient_ID;
            } else {
                return false;
            }
        }
    }

}
