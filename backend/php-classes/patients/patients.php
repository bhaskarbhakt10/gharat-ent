<?php
require_once '../backend/database/config.database.php';
require_once '../backend/constants/constants-static.php';


class Patients
{
    private $db;

    private $userId;

    function __construct()
    {
        $this->db = new Database();
    }
    
    
}