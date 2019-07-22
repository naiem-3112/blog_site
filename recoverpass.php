<?php include '../lib/Session.php'; 
	Session::init();
?>
<?php include '../helpers/Format.php'; ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php 
	$db = new Database();
	$fm = new Format();
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$email = $fm->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link, $email);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			echo "<span class='error'>Invalid Email Address!</span>";
		}else{

		$emailsql = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1 ";
		$emailresult = $db->select($emailsql);

		
		if($emailresult !=false){
			while($result = $emailresult->fetch_assoc()){
				$userid = $result['id'];
				$username = $result['username'];
			}

			//generate pass
			$text = substr($email, 0,3);
			$random = rand(10000, 99999);
			$newpass = "$text$random";
			$password = md5($newpass);
			$upsql = "UPDATE tbl_user SET password = $password WHERE id = $userid";
			$getup = $db->update($upsql);

			$to = '$email';
			$from = 'naiem.3112@gmail.com';
			$headers[] = 'From: $from\n';
			$headers[] .= 'MIME-Version: 1.0';
			$headers[] .= 'Content-type: text/html; charset=iso-8859-1';
			$subject = 'Your Password';
			$message = 'Your user name is:'. $username.'and pass is'.$newpass;
			
			$sendmail = mail($to, $subject, $message, $headers);
			if($sendmail){
			echo "<span class='success'>Please check your email for new password</span>";

			}else{
			echo "<span class='error'>Email not send!</span>";

			}

		}else{
			echo "<span class='error'>Email not Exist!</span>";
		}
		
	}
}

	 ?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email..." required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>