<?php

class Database{

    private $db_host = "localhost";
    private $db_name = "hospital-management";
    private $db_user = "root";
    private $db_pass = "";
    private $conn_string ;
    
    function __construct()
    {
        $this->conn_string = new mysqli($this->db_host, $this->db_user, $this->db_pass,$this->db_name);
    }

    function connect(){
        return $this->conn_string;
    }


}
