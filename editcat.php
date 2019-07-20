<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
       <?php 
       if(!isset($_GET['catid']) || $_GET['catid']== NULL){
        header("Location: catlist.php");
        
        }else{
                $id = $_GET['catid'];
        }

       ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
        <?php 
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $name = $fm->validation($_POST['name']);
                $name = mysqli_real_escape_string($db->link, $name);
                if(empty($name)){
                    echo "<span class='error'>field must not be empty</span>";
                }else{
                    $updatesql = "UPDATE tbl_category SET name = '$name' WHERE id = $id";
                    $catupdate = $db->update($updatesql);
                    if($catupdate){
                        echo "<span class='success'>Category updated successfully</span>";
                    }else{
                        echo "<span class='error'>category not updated</span>";
                    }

                }
            }

        ?>

        <?php 
        $sql = "SELECT * FROM tbl_category WHERE id = $id limit 1";
        $upquery = $db->select($sql);
        if($upquery){
            while ($result = $upquery->fetch_assoc()) {
               

         ?>
        <form action="" method="POST">
        <table class="form">					
            <tr>
                <td>
                    <input type="text" name="name" class="medium" value="<?php echo $result['name']; ?>" />
                </td>
            </tr>

        	<tr> 
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
        </form>
             <?php } }else{ ?>
                <p>No such data found</p>
            <?php } ?>
     </div>
</div>
</div>

<?php include 'inc/footer.php'; ?>
