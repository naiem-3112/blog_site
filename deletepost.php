<?php include '../lib/Session.php'; 
    Session::chkSession();
?>
<?php include '../helpers/Format.php'; ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php 
    $db = new Database();
 ?>

<?php 
if(!isset($_GET['postid']) || $_GET['postid'] == NULL){
    header("Location: postlist.php");
}else{
    $delid = $_GET['postid'];
   
            $sql = "SELECT * FROM tbl_post WHERE id = '$delid'";
            $getdata = $db->select($sql);
            if($getdata){
                while($result = $getdata->fetch_assoc()){
                	$unlinkimg = $result['image'];
                	unlink($unlinkimg);
                }
            }
      

    		$sql = "DELETE FROM tbl_post WHERE id = $delid";
        	$result = $db->delete($sql);
        	if($result){
        		echo "<span class='success'>data deleted succfully </span>";
        		header("Location: postlist.php");
        	}else{
        		echo "<span class='error'>data not deleted </span>";
        		header("Location: postlist.php");
        	}
}

?>