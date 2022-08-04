<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <span id="f"></span>

    <script>
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if(this.readyState==4 && this.status==200) {
                document.getElementById("f").innerHTML  = xml.responseText;
            }
        }
        var formdata = new FormData();
        formdata.append("name", "Shubham Vishwakarma");
        formdata.append("eater_type", "nongveg");
        formdata.append("age", "18");
        formdata.append("gender", "male");
        formdata.append("mobile", "8756516427");
        xml.open("POST", "http://localhost/foodee/register.php");
        xml.send(formdata);
    </script>
</body>
</html>