<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
	
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
    <?php 
    if($_SERVER['REQUEST_METHOD']== 'POST'){
    $note = mysqli_real_escape_string($db->link, $fm->validation($_POST['note']));

    if($note == ""){
    echo "<span class='error'>field must not be empty </span> ";

    }else{
    $upfot = "UPDATE tbl_footer
              SET
              note = '$note' WHERE id = '1'";
    $getup =$db->update($upfot);
              if($getup){
                 echo "<span class='success'>footer updated successfully </span> ";

              }else{
                 echo "<span class='error'>footer is not updated! </span> ";

              }
        }
    }

?>
                <div class="block copyblock"> 
                    <?php 
                    $sql = "SELECT * FROM tbl_footer WHERE id = '1' ";
                    $get = $db->select($sql);
                    if($get){
                        while($result= $get->fetch_assoc()){

                     ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>
