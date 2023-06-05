# Foodee - A Food Recommendation System

Foodee :watermelon: is a food recommendation system which suggests users his next meal **(recipe name)** based on characteristics like:

1. Whether the user is Veg or Non-Veg.
2. Availability/popularity of that food in his region. Eg. If the users lives in North India, He'll get recommendations of recipe names popular in North India. But, items popular in any other region like South India will also get recommended but will be less frequent.
3. Whether the food is a regular meal or is cooked on weekends/special occassions.
4. Food time. E.g If a food is normally eaten as breakfast, it will be recommended as a breakfast only. Foods are categorised as breakfast, lunch or dinner. But can contain all three tags and can be recommend in all three times of the day.
5. On special days like weekends/holidays, it will recommend food items that are special and less frequent.

You can refer to the recommend.php file to know the process in detail.
This is currently a backend API to recommend recipe names and currently does not have any frontend. Read further for more details.

## Table of Contents

1. [Motivation behind the app and what problem does it solves?](#motivation-behind-the-app-and-what-problem-does-it-solves)
2. [How to set it up locally?]()
3. [What is the future vision of the project?]()
4. [How to contribute and what features are yet to be built?]()
5. [How to test the API?]()

### Motivation behind the app and what problem does it solves?

Lately, I have been bombarded with questions like _what would you like to eat_? _What should I cook for the next meal_? _I cannot think of what to cook for the next meal, please suggest me a recipe_ by my mother everyday. And most of the time I become blank and cannot answer the questions. Even if I give the answer, the answer is quite repititive. This can help home-makers to not waste time to think about what to eat rather focus on things that matter more.
So, I think you got the point.

### How to set it up locally? :desktop_computer:

You need to have a PHP enabled web server and mysql to test the API. If you are on windows you can use [Easy PHP](https://www.easyphp.org/easyphp-devserver.php) and if you are on Linux you can use lampp stack. After installing, you can open PHPMyAdmin and import the (foodee.sql)[./foodee.sql] file. In case you do not have access to PHPMyAdmin, you can open foodee.sql and copy and run the commands mentioned in it on the Mysql CLI.

Once done with above steps, you are required to open [testAPI.php](test/testAPI.php) file and click on submit after selecting all the required data and you get the response data _(recommendations)_ as JSON.

### What is the future vision of the project?

I have the vision to create a frontend Mobile Application that recommends 6 recipe names per meal of the day. So, 18 recipe names suggestions per day. The mobile app runs in the background as a service and automatically send a request to the API at 11 PM and gets the suggestions for the next day and show it on the app.

Currently, the recipe names that I have collected in DB are for Northern India and hope to expand to whole India and eventually more countries as well.

### How to contribute and what features are yet to be built?

If you want to contribute or have any cool idea regarding this project you can start a new discussion.
Mobile App, DB with recipe name for more Indian States and eventually more countries are required.
Read the [future vision]() for more details.

### How to test the API?

Once you are done with setting the project locally, you are required to open [testAPI.php](test/testAPI.php) file and click on submit after selecting all the required data and you get the response data _(recommendations)_ as JSON.
