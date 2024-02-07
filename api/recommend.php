<?php

include 'db.php';
define("FOOD_RECOMMENDATION_LIMIT", 6);

class Recommend extends db {

    private $tempRecommendationStorage, $specialDayFrequency, $normalDayFrequency;
    
    public function __construct($user_food_preference=true, $food_time_type='breakfast',$declined_food_array='[]', $specialDay='0') {
        // if(!isset($_POST['food_time_type']) || !isset($_POST['user_food_preference']) || !isset($_POST['declined_food_array']) || !isset($_POST['special_day']))  {
        //     $_POST['user_food_preference'] = $user_food_preference;
        //     $_POST['food_time_type'] = $food_time_type;
        //     $_POST['declined_food_array'] = $declined_food_array;
        //     $_POST['special_day'] = $specialDay;
        // }

        $this->tempRecommendationStorage = array();
        $this->normalDayFrequency = array("regular", "lessfrequent", "lessfrequent_special", "special");
        $this->special_dayFrequency = array_reverse($this->normalDayFrequency); // special becomes priority
    }

    private function getFoodRecommendation($user_food_preference, $foodtimetype, $specialDay, $alreadyShownFoodIDs, $foodFrequency, $limit=FOOD_RECOMMENDATION_LIMIT) {

        /* Idealising declined_food array to use in foodid NOT IN clause */
        $alreadyShownFoodArray = json_decode($alreadyShownFoodIDs, true);
        $excludedFoodIDs = (count($alreadyShownFoodArray)) ? implode(',', $alreadyShownFoodArray) : " '' ";
        
        $foodFrequencies = $foodFrequencies = $this->normalDayFrequency; 
        if($specialDay=='y') {
            $foodFrequencies = $this->special_dayFrequency;
        }

        try {
            if($user_food_preference!='veg') {
                $query = db::connect()->prepare("SELECT `food_id`, `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodFrequencies[$foodFrequency]."' AND `food_id` NOT IN (".$excludedFoodIDs.") LIMIT ".$limit." ");
            }
            else {
                $query = db::connect()->prepare("SELECT `food_id`, `name`, `image`, `food_type` FROM `commonnorth` WHERE MATCH(`food_time_type`) AGAINST ('".$foodtimetype."' IN NATURAL LANGUAGE MODE) AND `food_frequency_type`='".$foodFrequencies[$foodFrequency]."' AND `food_id` NOT IN (".$excludedFoodIDs.") AND `food_type`='veg' LIMIT ".$limit." ");
            }
        }
        catch(PDOException $e) {
            return 0;
        }

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) { array_push($this->tempRecommendationStorage, $value);  }

        $resultCount = $query->rowCount();
        
        if($resultCount<6) {
            if($foodFrequency+1 <= 3) { // 3 is the count of normalDayFrequency Array
                $this->getFoodRecommendation($user_food_preference, $foodtimetype, $specialDay, $alreadyShownFoodIDs, $foodFrequency+1, $limit-$resultCount);
            }
        }
        
        return $this->tempRecommendationStorage;
        
    }

    public function launchAPI() {
        $user_food_preference = (isset($_POST['user_food_preference'])) ? $_POST['user_food_preference'] : 0;
        $foodtimetype = (isset($_POST['food_time_type'])) ? $_POST['food_time_type'] : 0;
        $alreadyShownFoodIDs = (isset($_POST['declined_food_array'])) ? $_POST['declined_food_array'] : 0;
        $specialDay = (isset($_POST['special_day'])) ? $_POST['special_day'] : 0;

        if(!$foodtimetype || !$user_food_preference || !$alreadyShownFoodIDs || !$specialDay) {
            return json_encode(array("status"=>"2", "msg"=>"Food Properties data missing."));
        }
        
        $finalRecommendations = $this->getFoodRecommendation($user_food_preference, $foodtimetype, $specialDay, $alreadyShownFoodIDs, 0); 
        
        if(!$finalRecommendations) {
            return json_encode(array("status"=>"0", "msg"=>"Error running query!"));
        }   

        return json_encode(array("status"=>"1", "data"=>$finalRecommendations));
    
    }

}
