<?php include 'inc/header.php'; ?>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$firstname = mysqli_real_escape_string($db->link, $fm->validation($_POST['firstname']));
	$lastname = mysqli_real_escape_string($db->link, $fm->validation($_POST['lastname']));
	$email = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
	$body = mysqli_real_escape_string($db->link, $fm->validation($_POST['body']));

	$error;
	$msg;

	if($firstname=='' || $lastname=='' || $email=='' || $body==''){
		$error = "field must not be empty";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = "email is invalied";
	}else{
		$sql = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$firstname', '$lastname', '$email', '$body') ";
		$incontact = $db->insert($sql);
		if($incontact){
			$msg = "contact data inserted successfully";
		}else{
			$error = "contact data is not inserted";
		}
	}
}


 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
				if(isset($error)){
					echo "<span style=color:red>$error</span>";
				}
				if(isset($msg)){
					echo "<span style=color:green>$msg</span>";

				}

				 ?>
			<form action="" method="POST">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>