<?php include 'inc/header.php'; ?>
<?php 
    if(!isset($_GET['pageid']) || $_GET['pageid']== NULL){
        header("Location: 404.php");
    }else{
        $id = $_GET['pageid'];
    }


 ?>
 <?php 
        $sql = "SELECT * FROM tbl_page WHERE id = '$id' ";
        $get = $db->select($sql);
        if($get){
            while($result = $get->fetch_assoc()){

     ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
		
				<h2><?php echo $result['pagename']; ?></h2>
	
				<?php echo $result['pagebody']; ?>

			</div>

	</div>
	<?php } } else { header("Location: 404.php");} ?>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>
