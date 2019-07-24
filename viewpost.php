<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
if(!isset($_GET['postid']) || $_GET['postid'] == NULL){
    header("Location: postlist.php");
}else{
    $id = $_GET['postid'];
}

?>
<div class="grid_10">
<div class="box round first grid">
<h2>Update Post</h2>

      <?php 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<script>window.location = 'postlist.php';</script>";
      }
    ?>
<div class="block">

        <?php

            $sql = "SELECT * FROM tbl_post WHERE id = '$id'";
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
        <input type="text" readonly value="<?php echo $result['title']; ?>" class="medium" />
    </td>
</tr>

<tr>
    <td>
        <label>Category</label>
    </td>
      
    <td>
        <select id="select">
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
        <label>Image</label>
    </td>
    <td>
        <img src=" <?php echo $result['image']; ?>" height="100px" width="250px" ><br>
    </td>
</tr>
<tr>
    <td style="vertical-align: top; padding-top: 9px;">
        <label>Content</label>
    </td>
    <td>
        <textarea class="tinymce">
            <?php echo $result['body']; ?>
        </textarea>
    </td>
</tr>
<tr>
    <td>
        <label>Tags</label>
    </td>
    <td>
        <input type="text" readonly value="<?php echo $result['tags']; ?>" class="medium" />
    </td>
</tr>
<tr>
    <td>
        <label>Author</label>
    </td>
    <td>
        <input type="text" readonly value="<?php echo $result['author']; ?>" class="medium" />
     

    </td>
</tr>
<tr>
    <td></td>
    <td>
        <input type="submit" name="submit" Value="Ok" />
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
