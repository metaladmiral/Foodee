<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Food Recommendation API</title>
</head>
<body>
<center>
    <h2>Test Food Recommendation API</h2>
<form action="../recommend.php" method="POST">
    <!-- <input type="hidden" name="foodtype_user" value="veg"> -->
    <select name="foodtype_user" id="">
        <option value="" selected disabled>Select Food Preference</option>
        <option value="veg">Veg</option>
        <option value="nonveg">Non-Veg</option>
    </select>
    <br>
    <br>
    <select name="food_time_type" id="">
        <option value="" selected disabled>Select Time</option>
        <option value="breakfast">Breakfast</option>
        <option value="lunch">Lunch</option>
        <option value="dinner">Dinner</option>
    </select>
    <br>
    <br>
    <input type="hidden" name="declined_food_array" value='[]'>
    
    <label for="">Whether Weekend? (Special Day): </label><input type="checkbox" name="specialday">
    <br><br>
    <input type="submit" value='Submit'>

</form>
</center> 
</body>
</html>
