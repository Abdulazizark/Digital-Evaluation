<?php 
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
  <link rel="stylesheet" href="new.css">
  <title>Login</title>
  
</head>
<body>

  <section class="container-fluid pg">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-6 col-md-3">


        <form class="form-container info" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

          <center><h4>REGISTER</h4><img src="./bootstrap-4.6.0-dist/img/r1.png" alt="" height="50px"></center>

          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
            <label for="exampleInputEmail1">Usernames</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usename">
            <span class="help-block"><?php echo $username_err; ?></span>
            <small id="emailHelp" class="form-text">We'll never share your Username with anyone else.</small>
          </div>

          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password"  value="<?php echo $password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"placeholder="Password" id="exampleInputPassword1">
            <span class="help-block"><?php echo $password_err; ?></span>
          </div>

          <div class="form-group<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password"  value="<?php echo $confirm_password; ?>" placeholder="Confirm Password">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>

          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-block" value="Login">REGISTER</button>

          <div align="center">
                                <a class="txt2"  href="login.php">
                                 Already have an account?
                                </a>
                            </div>

        </form>
      </div>
    </div>
  </section>
  
</body>
</html>