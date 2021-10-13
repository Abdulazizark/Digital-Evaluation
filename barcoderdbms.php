<?php 
 
include('libs/phpqrcode/qrlib.php'); 

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$email = $_POST['mail'];
	$subject =  $_POST['subject'];
	$filename = getUsernameFromEmail($email);
	$body =  $_POST['msg'];
	$codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body); 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="barcode.css">
    <link rel="icon" href="./bootstrap-4.6.0-dist/img/logo.png" type="image/icon type">
    <title>QR | Login</title>
  
</head>

<body>
<div class="myoutput">
    <section class="container-fluid">
        <div class="row content"> 
            <div class="col-sm-6 md-3">
                <img class="img-fluid" src="./bootstrap-4.6.0-dist/img/ar.png" alt="">
            </div>
            <div class="col-sm-6 ">
                <form class="form-container info" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <center>
                        <h3 style="font-family: 'poppins';">GENERATE BARCODE</h3>
                    </center>
                    <div class="form-group" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label for="exampleInputEmail1">Teacher Name</label>
                        <input type="text" class="form-control" name="mail"   value="<?php echo @$email; ?>" placeholder="Enter your name">
                        <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
                        <label for="exampleInputPassword1">Subject</label>
                        <input type="text" class="form-control" name="subject"value="<?php echo @$subject; ?>"  placeholder="Subject">
                    </div>
                    <div class="form-group" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label for="exampleInputPassword1">Link</label>
                        <input type="url" class="form-control"  name="msg" value="<?php echo @$body; ?>"  placeholder="Link">
                    </div>
 
                    <button type="submit" class="btn btn-primary btn-block" formaction="qrrdbms.php" name="submit">Generate</a>
                    </button>
                    
                    
                </form>
                <?php
                            if(!isset($filename)){
                                $filename = "author";
                            }
                            ?>
            </div>
        </div>
    </section>
</div>

</body>

</html>