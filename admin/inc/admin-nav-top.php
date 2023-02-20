<?php

session_start();
if(isset($_SESSION['user']) && $_SESSION['user']['loggedin'] === true && array_key_exists('user', $_SESSION) ){
    print_r($_SESSION['user']);
    print_r(session_id());
}
else{
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die ("<h2>Access Denied!</h2>.");
}

