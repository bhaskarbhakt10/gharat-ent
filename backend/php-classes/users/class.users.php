<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/database/config.database.php';
// require_once '../../database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/constants/constants-static.php';
// require_once '../../constants/constants-static.php';

class Users{

    private $db;

    private $firstname;
    private $lastname;
    private $phone;
    private $email;
    private $username;
    private $password;
    private $image;
    private $rank;
    private $specialization;

    function __construct()
    {   
        $this->db = new Database();
    }

    function get_details($first_name, $last_name, $phone_number, $email, $username, $password , $rank ,$image, $specialization){
        $this->firstname = $first_name;
        $this->lastname = $last_name;
        $this->phone = $phone_number;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->rank =  $rank;
        $this->image = $image;
        $this->specialization = $specialization;
    }

    function check_user_exists($phone, $email){
        $sql = "SELECT * FROM  ".USERS ." WHERE hospital_UserPhone = '$phone' AND hospital_UserEmail='$email'";
        // echo $sql;
        $res = $this->db->connect()->query($sql);
        // print_r($res);
        if($res->num_rows === 0){
            return true;
        }
        else{
            return false;
        }
    }

    function gen_hospitalUserID(){
        $sql = "SELECT * FROM  ".USERS ;
        // echo $sql;
        $res = $this->db->connect()->query($sql);
        $val = $res->num_rows + 1;
        $val_prefix = "AVHSP";
        $genrated_value = $val_prefix.$val;
        return $genrated_value; 
    }

    function current_time(){
        date_default_timezone_set(TIMEZONE_IN);
        $datetime = new DateTime();
        $current_dateTime = $datetime->format('Y-m-d H:i:s');
        return $current_dateTime;
    }

    function send_to_db(){
        $email = $this->email;
        $phone = $this->phone;
        $userId = $this->gen_hospitalUserID();
        $current_date_time = $this->current_time();
        if($this->check_user_exists($phone, $email) === true){
            $create_user = "INSERT INTO " .USERS." (hospital_UserId , hospital_UserFirstName, hospital_UserLastName, hospital_UserImage, hospital_UserPhone, hospital_UserEmail, hospital_UserName, hospital_UserPassword, hospital_rank, hospital_specialization, hospital_UserCreated, hospital_UserLoggedInAt) VALUES ('".$userId."','".$this->firstname."','".$this->lastname."','".$this->image."','".$this->phone."','".$this->email."','".$this->username."','".$this->password."','".$this->rank."', '".$this->specialization."','".$current_date_time."',NULL)";
            // echo $create_user;
            $res = $this->db->connect()->query($create_user);
            if($res === true){
                $insert_user_id = "INSERT INTO " .ACCESS." (hospital_AccessUserId) VALUES ('".$userId."')";
                $this->db->connect()->query($insert_user_id);
                return true;
            }
            else{
                return false;
            }
        
        }
        else{
            return false;
        }
       
    }

    function updateProfileInfo($user_id,$first_name,$last_name,$phone_number,$email,$other_info ){
        $sql ="UPDATE ". USERS ." SET hospital_UserFirstName='".$first_name."', hospital_UserLastName='".
        $last_name."', hospital_UserPhone='".$phone_number."', hospital_UserEmail='".$email."', hospital_UserOtherInfo='".$other_info."' WHERE hospital_UserId='".$user_id."'";
        echo $sql;
        $res = $this->db->connect()->query($sql);
        if($res === true){
            return true;
        }
        else{
            return false;
        }
    }

}