<?php
require_once '../backend/database/config.database.php';
require_once '../backend/constants/constants-static.php';
// require_once '';


class Admin
{
    private $db;

    private $userId;

    function __construct()
    {
        $this->db = new Database();
    }
    
    function get_user_id($userId){
        $this->userId = $userId;
    }
    
    function get_user_details(){
        $sql = "SELECT * FROM ". USERS ." WHERE hospital_UserId='".$this->userId."'";
        $res = $this->db->connect()->query($sql);
        if($res->num_rows > 0){
            return $res;
        }
        else{
            return "user does not exist";
        }
    }

    function get_user_name(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $full_name = $row['hospital_UserFirstName'] ." ". $row['hospital_UserLastName'];
                return $full_name;
            }
        }
    }

    function get_user_first_name(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $first_name = $row['hospital_UserFirstName'];
                return $first_name;
            }
        }
    }

    function get_user_email(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $email = $row['hospital_UserEmail'];
                return $email;
            }
        }
    }

    function get_user_image(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $image = $row['hospital_UserImage'];
                return $image;
            }
        }
    }

    function get_roles_json(){
        $json_file = file_get_contents('http://localhost/Hospital-management/admin/json/roles.json');
        $json_obj = json_decode($json_file);
        return $json_obj;
    }

    function get_user_rank(){
        $res = $this->get_user_details();
        $json = $this->get_roles_json();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $rank = $row['hospital_rank'];
            }
            foreach($json as $j){
                if((int)$rank === $j->rank){
                  return $j->role;
                }
            }
        }
    }

}
