<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/log-in/log-in.php';
// require_once '../../php-classes/log-in/log-in.php';
session_start();



if(isset($_POST)){
    $post_data = $_POST['post'];
    $rec_data = array();
    foreach($post_data as $data){
        foreach($data as $k => $v){
            $rec_data[$k] = $v;
        }
    }
    // print_r($rec_data['username']);
    // print_r($rec_data['password']);
    $check_user = new LogIn();
    $userexists = $check_user->checkUserExists($rec_data['username'], $rec_data['password']);
    if($userexists !== false){
        echo true;
        if($userexists ->num_rows > 0){
            while($row = $userexists->fetch_assoc()){
                $_SESSION['user']['id'] = $row['hospital_UserId'];
                $_SESSION['user']['email'] = $row['hospital_UserEmail'];
                $_SESSION['user']['phone'] = $row['hospital_UserPhone'];
                $_SESSION['user']['rank'] = $row['hospital_rank'];
                $_SESSION['user']['specialization'] = $row['hospital_specialization'];
                $_SESSION['user']['loggedin'] = true;
            }
        }
    }
    else{
        echo false;
    }

}