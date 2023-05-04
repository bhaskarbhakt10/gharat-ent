<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/constants/constants-static.php';



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
    private $medical_history;
    private $parent_data;

    function __construct()
    {
        $this->db = new Database();
    }


    function get_details($patient_suffix, $patient_first_name, $patient_last_name, $patient_gender, $patient_dob, $patient_contact_number, $patient_middle_name, $patient_email, $patient_address, $medical_history, $parent_data)
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
        $this->medical_history = $medical_history;
        $this->parent_data = $parent_data;
    }

    function gen_patientID()
    {
        $sql = "SELECT * FROM " . PATIENTS;
        $res = $this->db->connect()->query($sql);
        $no_rows = $res->num_rows + 1;
        date_default_timezone_set(TIMEZONE_IN);
        $date = new DateTime();
        $year = $date->format('Y');
        $patientID = "GEC_" . $year . "P_" . $no_rows;
        return $patientID;
    }

    function send_PID()
    {
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

        $sql = "INSERT INTO " . PATIENTS . " (hospital_PatientId, hospital_PatientSuffix, hospital_PatientFirstName, hospital_PatientMiddleName, hospital_PatientLastName, hospital_PatientGender, hospital_PatientDOB, hospital_PatientContactNumber, hospital_PatientParent, hospital_PatientEmail, hospital_PatientAddress, hospital_PatientMedicalHistory) VALUES ('" . $patient_ID . "','" . $this->patient_suffix . "','" . $this->patient_first_name . "','" . $this->patient_middle_name . "','" . $this->patient_last_name . "','" . $this->patient_gender . "','" . $this->patient_dob . "','" . $this->patient_contact_number . "','" . $this->parent_data . "','" . $this->patient_email . "','" . $this->patient_address . "','" . $this->medical_history . "')";
        // echo $sql;
        if ($check_pat_id === false) {
            $res = $this->db->connect()->query($sql);
            if ($res) {
                return $patient_ID;
            } else {
                return false;
            }
        }
    }

    function get_list_patients()
    {
        $sql = "SELECT * FROM " . PATIENTS . " ORDER BY hospital_PatientId DESC";
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    }

    function get_genral_detials($id)
    {
        $sql = "SELECT * FROM " . PATIENTS . " WHERE hospital_PatientId='$id'";
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    }

    function update_details($patient_update_id, $patient_suffix, $patient_first_name, $patient_middle_name, $patient_last_name, $patient_gender, $patient_dob, $patient_contact_number, $patient_email, $patient_address)
    {
        $sql = "SELECT * FROM " . PATIENTS . " WHERE hospital_PatientId='$patient_update_id'";
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            $update_sql = "UPDATE " . PATIENTS . " SET hospital_PatientSuffix= '" . $patient_suffix . "', hospital_PatientFirstName='" . $patient_first_name . "', hospital_PatientMiddleName='" . $patient_middle_name . "', hospital_PatientLastName='" . $patient_last_name . "', hospital_PatientGender='" . $patient_gender . "', hospital_PatientDOB='" . $patient_dob . "', hospital_PatientContactNumber='" . $patient_contact_number . "', hospital_PatientEmail='" . $patient_email . "', hospital_PatientAddress='" . $patient_address . "' WHERE hospital_PatientId='" . $patient_update_id . "'";
            // echo $update_sql;
            $update_res = $this->db->connect()->query($update_sql);
            if ($update_res) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDetailsByNumber($number, $first_name, $last_name)
    {
        $sql = "SELECT * FROM " . PATIENTS . " WHERE hospital_PatientContactNumber='" . $number . "'";
        // $sql = "SELECT * FROM " . PATIENTS . " WHERE hospital_PatientContactNumber='".$number."' AND hospital_PatientFirstName='".$first_name."' AND hospital_PatientLastName='".$last_name."'" ;
        // echo $sql;
        $res = $this->db->connect()->query($sql);
        if ($res->num_rows > 0) {
            $empty_arr = array();
            while ($row = $res->fetch_assoc()) {
                array_push($empty_arr, $row);
            }

            return $empty_arr;
        } else {
            return false;
        }
    }

}
