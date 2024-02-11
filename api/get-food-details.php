<?php

include 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class getFoodDetails extends db {

    private function getFoodDetails($foodIds) {
        $foodIds = json_decode($foodIds, true);
        $foodIdsSql = (count($foodIds)) ? implode(',', $foodIds) : " '' ";

        try {
            $query = db::connect()->prepare("SELECT `food_id`, `name`, `image` FROM `commonnorth` WHERE `food_id` IN ($foodIdsSql) ");
        }
        catch(PDOException $e) {
            return 0;
        }
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $finalResult = array();

        foreach ($result as $key => $foodDetails) {
            $finalResult[$foodDetails["food_id"]] = array("name"=>$foodDetails["name"], "image"=>$foodDetails["image"]);
        }

        return $finalResult;
        
    }

    public function launchAPI() {
        $foodIds = (isset($_POST['food_ids'])) ? $_POST['food_ids'] : 0;
        if(!$foodIds) {
            return json_encode(array("status"=>"0", "msg"=>"Empty food ids!"));
        }

        $foodDetails = $this->getFoodDetails($foodIds); 
        
        if(!$foodDetails) {
            return json_encode(array("status"=>"0", "msg"=>"Error running query!"));
        }

        return json_encode(array("status"=>"1", "data"=>$foodDetails));
        
    }

}

$obj = new getFoodDetails;
echo $obj->launchAPI();