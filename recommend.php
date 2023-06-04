<?php

include 'db.php';
define("FOOD_RECOMMENDATION_LIMIT", 6);

class recommend extends db {

    private $tempRecommendationStorage;
    private $specialDayFrequency;
    private $normalDayFrequency;
    
    private function __construct() {
        $this->tempRecommendationStorage = array();
        $this->normalDayFrequency = array("regular", "lessfrequent", "lessfrequent_special", "special");
        $this->specialDayFrequency = array_reverse($normalDayFrequency); // special becomes priority
    }

    private function getFoodRecommendation($foodtype_user, $foodtimetype, $specialDay, $declinedfoodarray, $foodfrequency, $limit=FOOD_RECOMMENDATION_LIMIT) {

         /* Idealising declined_food array to use in foodid NOT IN clause */
         $decfoodarray = json_decode($declinedfoodarray, true);
         $notinfoodid = '';
         if(sizeof($decfoodarray)!=0) {
             $len = sizeof($decfoodarray)-1;
             foreach($decfoodarray as $key => $value) {
                 if($len==$key) {
                     $notinfoodid .= $value;
                 }
                 else {
                     $notinfoodid .= $value.",";
                 }
             }
         }
         else {
             $notinfoodid = "''";
         }

        $foodFrequencies = "";
        ($specialDay) ? $foodFrequencies = $this->specialDayFrequency : $foodFrequencies = $this->normalDayFrequency;

        try {
            if($foodtype_user=='nonveg') {
                $query = db::connect()->prepare("SELECT `food_id`, `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodFrequencies[$foodfrequency]."' AND `food_id` NOT IN (".$notinfoodid.") LIMIT ".$limit." ");
            }
            else {
                $query = db::connect()->prepare("SELECT `food_id`, `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodFrequencies[$foodfrequency]."' AND `food_id` NOT IN (".$notinfoodid.") AND `food_type`='veg' LIMIT ".$limit." ");
            }
        }
        catch(PDOException $e) {
            return 0;
        }

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        array_push($this->tempRecommendationStorage, $result); 

        $resultCount = $query->rowCount();
        
        if($resultCount<6) {
            if($foodFrequency+1 <= 3) { // 3 is the count of normalDayFrequency Array
                $this->getFoodRecommendation($foodtype_user, $foodtimetype, $specialDay, $declinedfoodarray, $foodFrequency+1, $limit-$resultCount);
            }
        }
        
        return $this->tempRecommendationStorage;
        
    }

    public function launchAPI() {
        $foodtype_user = (isset($_POST['foodtype_user'])) ? $_POST['foodtype_user'] : 0;
        $foodtimetype = (isset($_POST['food_time_type'])) ? $_POST['food_time_type'] : 0;
        $declinedfoodarray = (isset($_POST['declined_food_array'])) ? $_POST['declined_food_array'] : 0;

        if(!$foodtimetype || !$foodtimetype || !$declinedfoodarray) {
            return json_encode(array("status"=>"2", "msg"=>"Food Properties data missing."));
        }

        $finalRecommendations = "";
        (isset($_POST["specialday"])) ? $finalRecommendations = $this->getFoodRecommendation($foodtype_user, $foodtimetype, true, $declinedfoodarray, 0) : $finalRecommendations = $this->getFoodRecommendation($foodtype_user, $foodtimetype, false, $declinedfoodarray, 0); 
        
        if(!$finalRecommendations) {
            return json_encode(array("status"=>"0", "msg"=>"Error running query!"));
        }

        return json_encode(array("status"=>"1", "data"=>$finalRecommendations));
    
    }

}


$obj = new recommend();
echo $obj->launchAPI();

























