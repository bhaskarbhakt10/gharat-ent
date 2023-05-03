<?php

class Database{

    private $db_host = "localhost";
    ##local
    private $db_name = "hospital-management";
    private $db_user = "root";
    private $db_pass = "";
    ##local
    ##stagging
    // private $db_name = "u595440997_hospital";
    // private $db_user = "u595440997_hospital";
    // private $db_pass = "f&L6ai|IJ";
    ##stagging
    ##live
    // private $db_name = "u595440997_avannah";
    // private $db_user = "u595440997_avannah";
    // private $db_pass = 'iqbCb$V34eu9i-P';

    ##live
    


    private $conn_string ;
    
    function __construct()
    {
        $this->conn_string = new mysqli($this->db_host, $this->db_user, $this->db_pass,$this->db_name);
    }

    function connect(){
        return $this->conn_string;
    }


}
