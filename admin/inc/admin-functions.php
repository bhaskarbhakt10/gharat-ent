<?php

session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['loggedin'] === true && array_key_exists('user', $_SESSION)) {
    $user_id = $_SESSION['user']['id'];
    print_r($user_id);
    // print_r(session_id());
} else {
    header('Location: ../404');
}

require_once '../backend/php-classes/admin/admin.php';
$admin = new Admin();
$admin ->get_user_id($user_id);

?>