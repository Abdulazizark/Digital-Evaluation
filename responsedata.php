<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">    
<style>
.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></link> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> defer</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"> defer</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"> defer</script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="./bootstrap-4.6.0-dist/img/logo.png" type="image/icon type">
    <title>QR | Data Structure</title>
</head>
<body>
<div class="container-fluid banner">
    <div class="row">
        <div class="col-md-12">
            <div class="navbar">
            <div class="nav-brand">
            <img src="./bootstrap-4.6.0-dist/img/logo2.png" height="100px" width="100px">
            </div>
                <ul class="nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link">Home</a>
                </li>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #75ff0057; border-color: #00c4ff00;">
                    Clasees 
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="web.php">Web Technologies</a>
                        <a class="dropdown-item" href="RDBMS.php">RDBMS</a>
                        <a class="dropdown-item" href="Data.php">Data Structure</a>
                        <a class="dropdown-item" href="java.php">JAVA</a>
                    </div>
                </div>
                    
                <li class="nav-item">
                    <a href="attendence.php" class="nav-link">Attendence</a>
                </li> 
                <li class="nav-item">
                    <a href="#" class="nav-link">About Us</a>
                </li>
            </ul>
        </div> 
    </div>
</div>

    <center> 

        <br><br><br><br>
        <h2>Response from Data Structure Class</h2>
 
        <br><br>
        <input type="text" value="https://forms.gle/gqMAyjZEMJ8Px1e3A" id="myInput">
        <button onclick="myFunction()" onmouseout="outFunc()" class="btn btn-primary"> Copy Link</button>
        
 
       
        <br><br><br>
        <iframe src='https://docs.google.com/spreadsheets/d/1LLC3lPqCGfB1ztFJKwPd5jW-NsYqmNdOUoV2ol4rh44/edit#gid=639905368 path here' width='100%' height='565px' frameborder='0'> </iframe>
    </center>

    <script>
        function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied: " + copyText.value;
        }

        function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = " ";
        }
   </script>

</body>
</html>

    