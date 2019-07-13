<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php 
                if(isset($_GET['delid'])){
                	$delid = $_GET['delid'];
                	$sql = "DELETE FROM tbl_category WHERE id = $delid";
                	$result = $db->delete($sql);
                	if($result){
                		echo "<span class='success'>data deleted successfully</span>";
                	}else{
                		echo "<span class='error'>data not deleted </span>";
                	}
                }

                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = "SELECT * FROM tbl_category ORDER BY id DESC";
						$catlistquery = $db->select($sql);
						if($catlistquery){
							$i=0;
							while ($result = $catlistquery->fetch_assoc()) {
								$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['name']; ?></td>
							<td>
								<a href="editcat.php?catid=<?php echo $result['id'] ?>">Edit</a> 
								|| 
								<a onclick="return confirm('are you sure to Delete!');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr>
					<?php } }else { ?>
						<tr>
							<td>No data found</td>
						</tr>

					<?php } ?>
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
