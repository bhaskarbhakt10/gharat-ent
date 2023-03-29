<?php
if(!empty($_SESSION)){
    if(array_key_exists('user', $_SESSION)){
        $url = BASE_URL .'log-in/log-in/';
        // session_destroy();
        header('Location: '.$url);
        // print_r(headers_list());
        echo "test";
    }
}
