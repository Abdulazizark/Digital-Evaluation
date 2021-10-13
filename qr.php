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
    <link rel="stylesheet" href="./bootstrap-4.6.0-dist/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./main.css">
    <title>Document</title>

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

	<div class="col-md-6 offset-md-3 info" id="info1">
			<center> <b>
					<h1 style="font-family:Poppins">Please Sacn your QR Code</h1>
				</b></center>
		<center><?php echo '<img src="temp/'. @$filename.'.png" style="width:250px; height:250px;"><br>'; ?> 
				<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
			 
				<?php
					$conn = mysqli_connect("localhost", "root", "", "demo"); 
					// Check connection 
					if($conn === false){ 
						die("ERROR: Could not connect. "
							. mysqli_connect_error()); 
					} 
					// Taking all 5 values from the form data(input) 
					$mail = $_REQUEST['mail']; 
					$subject = $_REQUEST['subject']; 
					$msg = $_REQUEST['msg']; 
					$sql = "INSERT INTO barcode VALUES ('$mail','$subject','$msg')"; 
					echo"<br/><br/>";
					echo"<center>";
					if(mysqli_query($conn, $sql)){ 
						echo"<center>";
						echo nl2br("\n Mail: $mail\n Subject: $subject\n"
							.  "Messge: $msg"); 
						echo"</center>";
						echo"<br/>";	
					} else{ 
						echo "ERROR: Hush! Sorry $sql. "
							. mysqli_error($conn); 
					} 
					echo"<br>";
					// Close connection 
					mysqli_close($conn); 
					echo"</center>";
				?>
			<?php
				if(!isset($filename)){
					$filename = "author";
				}
			?>

		</center> 

    </div>
</body>
					
</html>
