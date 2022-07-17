<?php

/* Database class */ 
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

/* Database class ends */

asdadasd
class recommend extends db {

    public $resarr;

    public function __construct() {
        $this->resarr = array();
    }

    public function runquery($foodtype_user, $foodtimetype, $foodfrequency, $declinedfoodarray, $limit=6) {
        
        /* Idealising declined_food array to use in foodid NOT IN clause */
        $decfoodarray = json_decode($declinedfoodarray, true);
        $notinfoodid = '';
        $len = sizeof($decfoodarray)-1;
        foreach($decfoodarray as $key => $value) {
            if($len==$key) {
                $notinfoodid .= $value;
            }
            else {
                $notinfoodid .= $value.",";
            }
        }
        /* ends ---------------------------------------------------------------- */

        try {
            if($foodtype_user=='nonveg') {
                /* not using food_type after the WHERE clause (selects food irrespective of its type) */
                $query = db::connect()->prepare("SELECT `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodfrequency."' AND `food_id` NOT IN(".$notinfoodid.") LIMIT ".$limit."");
            }
            else {
                $query = db::connect()->prepare("SELECT `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodfrequency."' AND `food_id` NOT IN(".$notinfoodid.") AND `food_type`='veg' LIMIT ".$limit."");
            }
            
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->resarr = $result; /* storing result in a public variable $this->resarr */

            return sizeof($result);

        }
        catch(Exception $e) {
            return $e->getMessage();
        }


    }


    public function action() {
     
        $foodtype_user = $_POST['foodtype_user'];
        $foodtimetype = $_POST['food_time_type'];
        $declinedfoodarray = $_POST['declined_food_array'];

        if($_POST['specialday']==true) {
            /* on specialday food_frequency_type will be special and lessfrequent_special */ 
        
            $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'special', $declinedfoodarray);
            if($sizeof_result<6 && gettype($sizeof_result)=='integer') {

                $old_res = $this->resarr;
                $newlim = 6-($sizeof_result);
                $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'lessfrequent_special', $declinedfoodarray, $newlim);
                $newressarr = array_merge($old_res, $this->resarr);

                if($sizeof_result<$newlim) {
                    $newlim = $newlim-($sizeof_result);
                    $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'lessfrequent', $declinedfoodarray, $newlim);
                    $newressarr = array_merge($newressarr, $this->resarr);

                    if($sizeof_result<$newlim) {
                        $newlim = $newlim-($sizeof_result);
                        $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'regular', $declinedfoodarray, $newlim);
                        $this->resarr = array_merge($newressarr, $this->resarr);
                        return json_encode($this->resarr);
                    
                    }else if(gettype($sizeof_result)=='string'){return $sizeof_result;/* in case of exception from runquery function */} else {return json_encode($newressarr);}

                }else if(gettype($sizeof_result)=='string'){return $sizeof_result;} else {return json_encode($newressarr);}

            }else if(gettype($sizeof_result)=='string'){return $sizeof_result;} else {return json_encode($this->resarr);}

        }
        
        /* $foodtype_user, $foodtimetype, $foodfrequency, $declinedfoodarray, limit */ 

        else {
            
            $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'regular', $declinedfoodarray);
            if($sizeof_result<6) {

                $old_res = $this->resarr;
                $newlim = 6-($sizeof_result);
                $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'lessfrequent', $declinedfoodarray, $newlim);
                $newressarr = array_merge($old_res, $this->resarr);

                if($sizeof_result<$newlim) {
                    $newlim = $newlim-($sizeof_result);
                    $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'lessfrequent_special', $declinedfoodarray, $newlim);
                    $newressarr = array_merge($newressarr, $this->resarr);

                    if($sizeof_result<$newlim) {
                        $newlim = $newlim-($sizeof_result);
                        $sizeof_result = $this->runquery($foodtype_user, $foodtimetype, 'special', $declinedfoodarray, $newlim);
                        $this->resarr = array_merge($newressarr, $this->resarr);
                        return json_encode($this->resarr);
                    
                    }else if(gettype($sizeof_result)=='string'){return $sizeof_result;} else {return json_encode($newressarr);}

                }else if(gettype($sizeof_result)=='string'){return $sizeof_result;} else {return json_encode($newressarr);}

            }else if(gettype($sizeof_result)=='string'){return $sizeof_result;/* in case of exception from runquery function */} else {return json_encode($this->resarr);}
        
        }

    }
}


$obj = new recommend();
echo $obj->action();

























