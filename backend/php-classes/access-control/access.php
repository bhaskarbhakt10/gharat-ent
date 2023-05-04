<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/gharat-ent/hospital-management/backend/constants/constants-static.php';

class Access
{
    private $db;

    private $id;
    private $special_access_obj ;

    function __construct()
    {
        $this->db = new Database();
    }

    function getUpdateDetails($id, $special_access_obj){
        $this->id = $id;
        $this->special_access_obj = $special_access_obj;
    }
}
