<?php
require_once '../backend/database/config.database.php';
require_once '../backend/constants/constants-static.php';


class Admin
{
    private $db;

    private $userId;

    function __construct()
    {
        $this->db = new Database();
    }

    function List_users(){
        $sql = "SELECT * FROM ". USERS ." WHERE hospital_rank != 0 ";
        $res = $this->db->connect()->query($sql);
        if($res->num_rows > 0){
            return $res;
        }
        else{
            return "user does not exist";
        }
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

    function get_userID(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $ID = $row['hospital_UserId'];
                return $ID;
            }
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

    function get_user_rank_number(){
        $res = $this->get_user_details();
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $rank = $row['hospital_rank'];
                return $rank;
            }
        }
    }


    function get_roles_json(){
        $json_file = file_get_contents('http://localhost/Hospital-management/admin/json/roles.json');
        $json_obj = json_decode($json_file);
        return $json_obj;
    }

    function get_default_user_image(){
        $json__ = $this->get_roles_json();
        $user_rank = $this->get_user_rank_number();
        foreach($json__ as $arr){
            if((int)$user_rank === $arr->rank){
                $default_image = $arr->default_image;
            }
        }
        return $default_image;
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
                else if($rank === '0'){
                    return "Super Admin";
                }
            }
        }
    }

    function get_user_count_by_role($rank){
        $sql = "SELECT * FROM ". USERS . " WHERE hospital_rank = $rank";
        $res = $this->db->connect()->query($sql);
        if($res-> num_rows > 0){
            return $res->num_rows;
        }
        else{
            return 0;
        } 
    }

    function details_by_role($rank){
        $sql = "SELECT * FROM ". USERS . " WHERE hospital_rank = $rank";
        $res = $this->db->connect()->query($sql);
        if($res){
            return $res;
        }
        else{
            return false;
        } 
    }


    function get_users_role_to_access($userId){
        $sql = "SELECT * FROM ". USERS ." WHERE hospital_UserId='".$userId."'";
        $res = $this->db->connect()->query($sql);
        if($res->num_rows > 0){
            $json = $this->get_roles_json();
            while($row = $res->fetch_assoc()){
                $rank = $row['hospital_rank'];
            }
            foreach($json as $j){
                if((int)$rank === $j->rank){
                  return $j->role;
                }
                else if($rank === '0'){
                    return "Super Admin";
                }
            }
            
        }
        else{
            return "user does not exist";
        }
    }
}
