<?php
session_start();
 
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: home.php");
  exit;
}

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./bootstrap-4.6.0-dist/bootstrap-4.6.0-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>
<body>
  <section class="container-fluid pg">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-md-3">
 
      <form class="form-container info" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <center><h3>LOGIN</h3><a id="info1" href="new.php">If you don't have an account <br> create new account</a></center>
          
          
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">

            <label for="exampleInputEmail1">Email address</label>
            <input type="text" name="username"  value="<?php echo $username; ?>" class="form-control"  placeholder="Username">
            <span class="focus-input100"></span>
            <span class="help-block"><?php echo $username_err; ?></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i></span>
            <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>

          </div>
  

           

          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                             <span class="focus-input100"></span>
                            <span class="symbol-input100"> <i class="fa fa-lock" aria-hidden="true"></i></span>
                            <span class="help-block"><?php echo $password_err; ?></span>
                           </div>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary btn-block" value="Login"><a id="info2" href="home.php">LOGIN</a> </button>
          <label for="Homepage">Hoomepage</label>
        </form>
      </div>
    </div>
  </section>
  
</body>
</html>