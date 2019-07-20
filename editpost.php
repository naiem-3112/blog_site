<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
if(!isset($_GET['postid']) || $_GET['postid'] == NULL){
    header("Location: postlist.php");
}else{
    $eid = $_GET['postid'];
}

?>
<div class="grid_10">
<div class="box round first grid">
<h2>Update Post</h2>

      <?php 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $userid   = mysqli_real_escape_string($db->link, $_POST['userid']);
        $title    = mysqli_real_escape_string($db->link, $_POST['title']);
        $body     = mysqli_real_escape_string($db->link, $_POST['body']);
        $category = mysqli_real_escape_string($db->link, $_POST['cat']);
        $tag      = mysqli_real_escape_string($db->link, $_POST['tags']);
        $author   = mysqli_real_escape_string($db->link, $_POST['author']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div            = explode('.', $file_name);
        $file_ext       = strtolower(end($div));
        $unique_image   = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if($title =="" || $body=="" || $category =="" || $tag=="" || $author==""){
             echo "<span class='error'>field must not be empty</span>";
       
        }else{
        if(!empty($file_name)){

        
        if ($file_size >1048567) {
         echo "<span class='error'>Image Size should be less then 1MB!</span>";

        } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-"
         .implode(', ', $permited)."</span>";

        } else{
            move_uploaded_file($file_temp, $uploaded_image);

            $postup="UPDATE tbl_post
                    SET
                    userid ='$userid',
                    cat    ='$category',
                    title  ='$title',
                    body   ='$body',
                    image  ='$uploaded_image',
                    author ='$author',
                    tags   ='$tag' 
                    WHERE id = '$eid'";
            $uppost = $db->update($postup);
            if($uppost){
                echo "<span class='success'>post updated successfully</span>";
            }else{
                echo "<span class='error'>problem in updated post</span>";
            }
        }

    }else{
            $postup="UPDATE tbl_post
                    SET
                    userid ='$userid',
                    cat    ='$category',
                    title  ='$title',
                    body   ='$body',
                    author ='$author',
                    tags   ='$tag' 
                    WHERE id = '$eid'";
            $uppost = $db->update($postup);
            if($uppost){
                echo "<span class='success'>post updated successfully</span>";
            }else{
                echo "<span class='error'>problem in updated post</span>";
            }
        }



        }

      }
    ?>
<div class="block">

        <?php

            $sql = "SELECT * FROM tbl_post WHERE id = '$eid'";
            $getdata = $db->select($sql);
            if($getdata){
                while($result = $getdata->fetch_assoc()){

        ?>
<form action="" method="POST" enctype="multipart/form-data">
<table class="form">
   
<tr>
    <td>
        <label>Title</label>
    </td> 
    <td>
        <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
    </td>
</tr>

<tr>
    <td>
        <label>Category</label>
    </td>
      
    <td>
        <select id="select" name="cat">
            <option>Select Category</option>
        <?php 

            $sql = "SELECT * FROM tbl_category";
            $selectdata = $db->select($sql);
            if($selectdata){
                while ($selectresult = $selectdata->fetch_assoc()) {          
                
        ?>
    <option 
    <?php 
    if($result['cat'] == $selectresult['id']){?>
        selected ="selected";
     <?php } ?>

    value="<?php echo $selectresult['id']; ?>"><?php echo $selectresult['name'] ?></option>

    <?php } }  ?>


    </select>
    </td>
</tr>


<tr>
    <td>
        <label>Upload Image</label>
    </td>
    <td>
        <img src=" <?php echo $result['image']; ?>" height="100px" width="200px" ><br>
        <input type="file" name="image"/>
    </td>
</tr>
<tr>
    <td style="vertical-align: top; padding-top: 9px;">
        <label>Content</label>
    </td>
    <td>
        <textarea class="tinymce" name="body">
            <?php echo $result['body']; ?>
        </textarea>
    </td>
</tr>
<tr>
    <td>
        <label>Tags</label>
    </td>
    <td>
        <input type="text" name="tags" value="<?php echo $result['tags']; ?>" class="medium" />
    </td>
</tr>
<tr>
    <td>
        <label>Author</label>
    </td>
    <td>
        <input type="text" name="author" value="<?php echo $result['author']; ?>" class="medium" />
        <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />

    </td>
</tr>
<tr>
    <td></td>
    <td>
        <input type="submit" name="submit" Value="Save" />
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
