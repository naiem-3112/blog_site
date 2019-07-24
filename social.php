<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fb  = $fm->validation($_POST['fb']);
        $lind= $fm->validation($_POST['lind']);
        $git = $fm->validation($_POST['git']);
        $tw  = $fm->validation($_POST['tw']);

        $fb  = mysqli_real_escape_string($db->link, $fb);
        $lind= mysqli_real_escape_string($db->link, $lind);
        $git = mysqli_real_escape_string($db->link, $git);
        $tw  = mysqli_real_escape_string($db->link, $tw);

        if($fb =="" ||$lind =="" ||$git =="" ||$tw ==""){
            echo "<span class='error'>field must not be empty!</span>";
        }else{
            $upsql = "UPDATE tbl_social
                          SET
                          fb   = '$fb',
                          lind = '$lind',
                          git  = '$git',
                          tw   = '$tw'
                          WHERE id = '1' ";
                $upget = $db->update($upsql);
                if($upget){
                         echo "<span class='success'>social media updated successfully </span>";
                }else{
                     echo "<span class='error'>social media not updated!</span>";
                }
        }
    }

         ?>
                
                <div class="block">    
                <?php 
                $sql = "SELECT * FROM tbl_social  WHERE id = '1' ";
                $get = $db->select($sql);
                if($get){
                    while($result = $get->fetch_assoc()){

                 ?>           
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Linkedin</label>
                            </td>
                            <td>
                                <input type="text" name="lind" value="<?php echo $result['lind']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Github</label>
                            </td>
                            <td>
                                <input type="text" name="git" value="<?php echo $result['git']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
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
