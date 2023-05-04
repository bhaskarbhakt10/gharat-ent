<?php

class Database
{

    private $db_host = "localhost";
    
    ##local
    ##avannah##
    // private $db_name = "hospital-management";
    // private $db_user = "root";
    // private $db_pass = "";
    ##avannah##

    ##avannah##
    private $db_name = "gharat-ent";
    private $db_user = "root";
    private $db_pass = "";
    ##avannah##
    ##local
    
    ##stagging
    // private $db_name = "u595440997_hospital";
    // private $db_user = "u595440997_hospital";
    // private $db_pass = "f&L6ai|IJ";
    ##stagging

    ##live
    ##avannah## 
    // private $db_name = "u595440997_avannah";
    // private $db_user = "u595440997_avannah";
    // private $db_pass = 'iqbCb$V34eu9i-P';
    ##avannah## 
    ##gharat-ent## 
    // private $db_name = "u595440997_chetan";
    // private $db_user = "u595440997_chetan";
    // private $db_pass = 'iqbCb$V34eu9i-P';
    ##gharat-ent## 
    ##live

    private $conn_string;

    function __construct()
    {
        $this->conn_string = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }

    function connect()
    {  
        return $this->conn_string;
    }
}
