<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/database/config.database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hospital-management/backend/constants/constants-static.php';

class Access
{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }
}
