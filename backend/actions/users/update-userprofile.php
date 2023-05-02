<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/php-classes/users/class.users.php';


if (isset($_POST['update-profile'])) {
    $ref_url = $_SERVER['HTTP_REFERER'];
   
    $first_name = $_POST['profile-first-name'];
    $last_name = $_POST['profile-last-name'];
    $phone_number = $_POST['profile-phone-number'];
    $email = $_POST['profile-email'];
    $user_id = $_POST['user_id'];
    
    $degree = $_POST['profile-degree'];
    $specilaization = $_POST['profile-specialization'];
    $reg_no = $_POST['profile-regno'];

    $other_info_arr = array();
    $other_info_arr['profile-degree'] = $degree;
    $other_info_arr['profile-specialization'] = $specilaization;
    $other_info_arr['profile-regno'] = $reg_no;

    $other_info = json_encode($other_info_arr);

    $user = new Users();
    if($user->updateProfileInfo($user_id,$first_name,$last_name,$phone_number,$email,$other_info )){
        header("Location: ".$ref_url);
    }
}

