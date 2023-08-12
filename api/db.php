<?php

class db {

    private $host = "YOUR_HOST_HERE";
    private $dbUser = "YOUR_USER_HERE";
    private $dbPass = "YOUR_PASS_HERE";

    public function connect() {
        
        try {
     
            $db = new PDO("mysql:host=".$this->host.";dbname=foodee", "$this->dbUser", "$this->dbPass");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            return $db;                
        
        }
        catch(PDOException $e)
        {
            throw new Exception("Connection to database failed! : ".$e->getMessage(), 1);
            
        }

    }
}


?>