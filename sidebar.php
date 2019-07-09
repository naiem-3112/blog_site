
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
						<?php 
						$sql = "SELECT * FROM tbl_category";
						$category = $db->select($sql);
						if($category){
						while($result = $category->fetch_assoc()){

 				 ?>
						<li><a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>					<?php } }else { ?>
						<li>No category created</li>
						<?php } ?>
					</ul>
				
			</div>
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
			
				<?php 
				$sql = "SELECT * FROM tbl_post limit 5" ;
				$latestquery = $db->select($sql);
				if($latestquery){
					while($latestresult = $latestquery->fetch_assoc()){

				?>
				
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $latestresult['id']; ?>"><?php echo $latestresult['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $latestresult['id']; ?>"><img src="admin/<?php echo $latestresult['image'] ?>" alt="post image"/></a>
						<?php echo $fm->readShort($latestresult['body'], 120); ?>	
					</div>
					<?php } }else{header("Location: 404.php");} ?>
			</div>
		
			
		</div>