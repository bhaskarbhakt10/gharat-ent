<?php
require_once '../../php-classes/users/class.users.php';
echo 'test';
function upload_image(){
if (!empty($_FILES['profile_picture']['name'])) {
    $target_dir = '../../../uploads';

    if (!file_exists($target_dir) && !is_dir($target_dir)) {
        $target_dir = mkdir('../../../uploads');
    }

    $image_name = basename($_FILES['profile_picture']['name']);

    $file_type = pathinfo($image_name, PATHINFO_EXTENSION);

    $allowed_type = array('jpg', 'png', 'jpeg');

    if (in_array($file_type, $allowed_type)) {
        $temporary_name = $_FILES['profile_picture']['tmp_name'];

        $image_name__ = explode(".", $image_name);

        date_default_timezone_set(TIMEZONE_IN);
        $datetime = new DateTime();
        $time = $datetime->format('Y_M') ."_".uniqid();

        $name_of_image = $_POST['first_name']."_".$time;
        $extension_of_image = end($image_name__);

        $image_new_name = $name_of_image . "." . $extension_of_image;

        mkdir($target_dir ."/". $name_of_image);
        $sub_folder = $target_dir .'/'. $name_of_image;
        // if (!file_exists($sub_folder)) {
        //     $sub_folder = mkdir($sub_folder);
        // }

        $new_file_path = $sub_folder . "/" . $image_new_name;
        move_uploaded_file($temporary_name, $new_file_path);
        
        $path_to_db = ltrim($new_file_path,'../');
        return $path_to_db;
    } else {
        return "Image type not allowed";
    }
}
}














if (isset($_POST['create-user'])) {
    $ref_url = $_SERVER['HTTP_REFERER'];
    // echo $ref_url;
    
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone_number']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['rank'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rank = $_POST['rank'];
        $image = upload_image();

        $create_user = new Users();
        $create_user->get_details($first_name, $last_name, $phone_number, $email, $username, $password , $rank,$image);
        if($create_user->send_to_db()){
            echo "User created sucessfully";
        }
        else{
            echo "Phone Number and Email already exists";
        }


    
    }
    
}
