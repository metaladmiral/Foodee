<?php

class db {
    public function connect() {
        
        try {
     
            $db = new PDO("mysql:host=localhost;dbname=foodee", "root", "");
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