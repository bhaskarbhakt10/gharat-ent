<?php
// require_once '../../database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/database/config.database.php';
// require_once '../../constants/constants-static.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/constants/constants-static.php';

class LogIn
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function checkUserExists($username , $password){
        $sql = "SELECT * FROM ". USERS ." WHERE (hospital_UserName='".$username."' OR hospital_UserEmail='".$username."' OR hospital_UserPhone='".$username."') AND hospital_UserPassword = '".$password."'";
        // echo $sql;
        $res = $this->db->connect()->query($sql);
        if($res->num_rows > 0){
            return $res;
        }
        else{
            return false;
        }
    }


}
