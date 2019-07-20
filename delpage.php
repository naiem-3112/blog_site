<?php include '../lib/Session.php'; 
    Session::chkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php 
    $db = new Database();

 ?>
 <?php 
 	if(!isset($_GET['delpage']) || $_GET['delpage']== NULL){
 		header("Location: page.php");

 	}else{
 		$id = $_GET['delpage'];
 		$sql ="DELETE FROM tbl_page WHERE id = '$id' ";
 		$getdel = $db->delete($sql);
 		if($getdel){
 			echo "<span class='success'>Page deleted successfully</span>";
 			header("Location: index.php");
 		}else{
 			echo "<span class='error'>Page not deleted </span>";
 			header("Location: page.php");

 		}
 	}



  ?>