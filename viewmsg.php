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
		echo "<script>window.location = 'inbox.php' ;</script>";
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
            <label>Name</label>
        </td>
        <td>
            <input type="text" readonly="1" value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
        </td>
    </tr>
 	<tr>
        <td>
            <label>Email</label>
        </td>
        <td>
            <input type="text" readonly="1" value="<?php echo $result['email']; ?>" class="medium" />
        </td>
    </tr>
        <tr>
        <td>
            <label>Date</label>
        </td>
        <td>
            <input type="text" readonly="1" value="<?php echo $fm->formatdate($result['date']); ?>" class="medium" />
        </td>
    </tr>
    <tr>
        <td>
            <label>Message</label>
        </td>
        <td>
            <textarea class="tinymce">
            	<?php echo $result['body']; ?>
            </textarea>
        </td>
    </tr>
	<tr>
        <td></td>
        <td>
            <input type="submit"  Value="Ok" />
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

 