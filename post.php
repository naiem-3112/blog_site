<?php include 'inc/header.php'; ?>
<?php 
	if(!isset($_GET['id']) || $_GET['id']== NULL){
		header("Location: 404.php");
	}else{
		$id = $_GET['id'];
	}


 ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
				$sql = "SELECT * FROM tbl_post WHERE id=$id";
				$query = $db->select($sql);
				if($query){
					while($result = $query->fetch_assoc()){

				 ?>

				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatdate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<?php echo $result['body']; ?>
				


				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
					$catid = $result['cat'];
					$relatedsql = "SELECT * FROM tbl_post WHERE cat=$catid limit 6";
					$relatedquery = $db->select($relatedsql);
					if ($relatedsql) {
						while ($relatedresult= $relatedquery->fetch_assoc()) {
					 ?>
					<a href="index.php?id=<?php echo $relatedresult['id']; ?>">
						<img src="admin/<?php echo $relatedresult['image']; ?>" alt="post image"/></a>
				<?php } }else{echo "No related post available";} ?>
				</div>
				<?php } }else{header("Location:404.php");} ?>
	</div>

</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>