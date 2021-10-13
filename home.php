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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="./bootstrap-4.6.0-dist/img/logo.png" type="image/icon type">
    <title>QR | Classes</title>
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
   
        <div class="col-md-6 offset-md-3 info">
            <h1 class="text-center"><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
            <P class="text-center">
               you can take the attendance of all students who are present in your class
               
            </P>
           <center> 
                <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>  
            
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </center>
        </div>
      
    
</div>
</body>
</html>

    