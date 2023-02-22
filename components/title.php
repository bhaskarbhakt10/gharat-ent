<?php
if(!defined('BASE_URL')) define('BASE_URL','http://localhost/hospital-management/');

// function returns the title 
// that is the directory which makes the request
function get_title()
{
    $req_uri = $_SERVER['REQUEST_URI'];
    $array_uri = explode('/', $req_uri);
    array_pop($array_uri);
    $uncleaned_title = preg_replace('/-/', ' ', end($array_uri));
    $title = ucwords($uncleaned_title);
    return $title;
}

function enqueue_script_css(){
    $req_uri__ = $_SERVER['REQUEST_URI'];
    $array_uri__ = explode('/', $req_uri__);
    array_pop($array_uri__);
    $filename = end($array_uri__);
    return $filename;
}

