<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
<div class="box round first grid">
    <h2>Inbox</h2>
    <?php 
    if(isset($_GET['seenid'])){
    	$seenid = $_GET['seenid'];

    	$sql ="UPDATE tbl_contact 
    			SET
    			status = '1'
    			WHERE id = $seenid ";
    	$get = $db->update($sql);
    	if($get){
    		echo "<span class = 'success'>Data send to seen box successfully</span>";
    	}else{
    		echo "<span class = 'error'>Something Wrong to send data to the seen box!</span>";
    		
    	}
    }


    ?>
    <div class="block">        
        <table class="data display datatable" id="example">
		<thead>
			<tr>
				<th>Serial No.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Message</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC ";
			$getcon = $db->select($sql);
			if($getcon){
				$i= 0;
				while($result = $getcon->fetch_assoc()){
					$i++;

			 ?>
			<tr class="odd gradeX">
				<td><?php echo $i; ?></td>
				<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td><?php echo $fm->readShort($result['body'], 30); ?></td>
				<td><?php echo $fm->formatdate($result['date']); ?></td>
				<td>
					<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
					<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
					<a href="?seenid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to send data to seen box?') " >Seen</a>

				</td>
			</tr>
		<?php } } ?>
		</tbody>
	</table>
   </div>
</div>


            <div class="box round first grid">
                <h2>Seen Messages</h2>
                <div class="block">        
    <?php 
    if(isset($_GET['delid'])){
    	$delid = $_GET['delid'];
    	$sql = "DELETE FROM tbl_contact WHERE id = $delid";
    	$del = $db->delete($sql);
    	if($del){
    		echo "<span class = 'success'>Data deleted successfully</span>";

    	}else{
    		echo "<span class = 'error'>Data not deleted</span>";

    	}
    }



     ?>
<table class="data display datatable" id="example">
	<thead>
		<tr>
			<th>Serial No.</th>
			<th>Name</th>
			<th>Email</th>
			<th>Message</th>
			<th>Date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC ";
		$getcon = $db->select($sql);
		if($getcon){
			$i= 0;
			while($result = $getcon->fetch_assoc()){
				$i++;

		 ?>
		<tr class="odd gradeX">
			<td><?php echo $i; ?></td>
			<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
			<td><?php echo $result['email']; ?></td>
			<td><?php echo $fm->readShort($result['body'], 30); ?></td>
			<td><?php echo $fm->formatdate($result['date']); ?></td>
			<td>
				<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
				<a href="?delid=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to delete!') " >Delete</a>
				

			</td>
		</tr>
	<?php } } ?>
	</tbody>
</table>
               </div>
            </div>



        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
 </script>
<?php include 'inc/footer.php'; ?>
