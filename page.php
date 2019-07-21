<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    if(!isset($_GET['pageid']) || $_GET['pageid']== NULL){
        header("Location: index.php");
    }else{
        $id = $_GET['pageid'];
    }


 ?>
 <style>
     .actiondel{margin-left: 10px;}
     .actiondel a{background:#DDDDDD;border:1px solid #DDDDDD;cursor:pointer;font-size:20px;font-weight:normal;padding:4px 10px;color:#444444;}
 </style>
<div class="grid_10">
<div class="box round first grid">
<h2>Edit Page</h2>
  <?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pagename    = mysqli_real_escape_string($db->link, $_POST['pagename']);
    $pagebody    = mysqli_real_escape_string($db->link, $_POST['pagebody']);


    if($pagename =="" || $pagebody ==""){
         echo "<span class='error'>field must not be empty</span>";
   
    }else{
        $pageup = "UPDATE tbl_page
                        SET
                        pagename = '$pagename',
                        pagebody = '$pagebody'
                        WHERE id = '$id'";
        $uppage = $db->update($pageup); 
        if($uppage){
            echo "<span class='success'>page updated successfully</span>";
        }else{
            echo "<span class='error'>problem in updating page</span>";
        }
    }

  }

   ?>
   <div class="block">
    <?php 
        $sql = "SELECT * FROM tbl_page WHERE id = '$id' ";
        $get = $db->select($sql);
        if($get){
            while($result = $get->fetch_assoc()){

     ?>
 <form action="" method="POST">
    <table class="form">
       
    <tr>
        <td>
            <label>Page Name</label>
        </td>
        <td>
            <input type="text" name="pagename" value="<?php echo $result['pagename']; ?>" class="medium" />
        </td>
    </tr>
 
    <tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
            <textarea class="tinymce" name="pagebody">
                <?php echo $result['pagebody']; ?>
            </textarea>
        </td>
    </tr>

	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Update" />
            <span class="actiondel"><a href="delpage.php?delpage=<?php echo $result['id']; ?>" onclick="return confirm('Are you sure to delete!');">Delete</a></span>
        </td>
    </tr>
    </table>
    </form>
<?php } } ?>
</div>
</div>
</div>
  <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
     <!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>
