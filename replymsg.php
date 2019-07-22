<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
<?php 
 	if(!isset($_GET['msgid']) || $_GET['msgid']== NULL){
		echo "<script>window.location = 'inbox.php' ;</script>";
 		 		
 	}else{
 		$id = $_GET['msgid'];
 		
 	}

  ?>
<div class="box round first grid">
<h2>View Message</h2>
<?php 
	if($_SERVER["REQUEST_METHOD"]== 'POST'){
        $toemail   = $fm->validation($_POST['toemail']);
        $fromemail = $fm->validation($_POST['fromemail']);
        $subject   = $fm->validation($_POST['subject']);
		$message   = $fm->validation($_POST['message']);
        $sendemail = mail($toemail, $fromemail, $subject, $message);

        if($sendemail){
            echo "<span class='success'>mail send successfully</span>";
        }else{
            echo "<span class='error'>mail  not send </span>";

        }
	}

?>
<div class="block">

 <?php 
 	$sql = "SELECT * FROM tbl_contact WHERE id = $id";
 	$get = $db->select($sql);
 	if($get){
 	while($result = $get->fetch_assoc()){
  ?>
 <form action="" method="POST">
    <table class="form">
       
    
 	<tr>
        <td>
            <label>To</label>
        </td>
        <td>
            <input type="text" readonly="1" name="toemail" placeholder="To Email..." value="<?php echo $result['email']; ?>" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>From</label>
        </td>
        <td>
            <input type="text" name="fromemail" placeholder="From Email..." class="medium" />
        </td>
    </tr>
        <tr>
        <td>
            <label>Subject</label>
        </td>
        <td>
            <input type="text" name="subject" placeholder="Enter email subject..." class="medium" />
        </td>    </tr>
    <tr>
        <td>
            <label>Message</label>
        </td>
        <td>
            <textarea class="tinymce" name="message"></textarea>
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit"  Value="Send" />
        </td>
    </tr>
    </table>
    </form>
<?php } } ?>
</div>
</div>
</div>
  <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
     <!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>

 