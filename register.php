<?php

/* Getting the required formdata */
$name = $_POST['name'];
$eater_type = $_POST['eater_type'];
$age = $_POST['age'];
$gender = $_POST['gender'];
/* ----------------------------- */ 


if(isset($_POST['mobile'])) {
    $mobile = $_POST['mobile'];
}
else {
    $mobile = NULL;
}

/* Generating a random profile id */
$prefix = md5($name.$eater_type.$age);
$profileid = uniqid($prefix, FALSE);
/* -------------------------------- */ 

/* connecting to the Database */
try {
     
    $db = new PDO("mysql:host=localhost;dbname=foodee", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
    echo "connfailed!";
}
/* -------------------------- */


/* Inserting the user in to profiles table */ 
try {
    $query = $db->prepare("INSERT INTO `profiles` VALUES('".$profileid."', '".$name."', '".$eater_type."', '".$age."', '".$gender."', '".$mobile."')");
    $query->execute();
}
catch(PDOException $e) {
    echo "query failed ".$e->getMessage();
}

/* Creating an extra table for the user data for future use. */ 
try {
    $query1 = $db->prepare("
    
        CREATE TABLE `".$profileid."_accepted` (
            food_id int(20)
        )

    ");
    $query1->execute();
    echo "Done!";
}
catch(PDOException $e) {
    echo "query failed ".$e->getMessage();
}