<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">

<div class="box round first grid">
<h2>Add New Page</h2>
<div class="block">
  <?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pagename    = mysqli_real_escape_string($db->link, $_POST['pagename']);
    $pagebody     = mysqli_real_escape_string($db->link, $_POST['pagebody']);


    if($pagename =="" || $pagebody ==""){
         echo "<span class='error'>field must not be empty</span>";
   
    }else{
        $postinsert = "INSERT INTO tbl_page(pagename, pagebody) values('$pagename', '$pagebody') "; 
        $insertpost = $db->insert($postinsert);
        if($insertpost){
            echo "<span class='success'>page added successfully</span>";
        }else{
            echo "<span class='error'>problem in adding page</span>";
        }
    }

  }

   ?>
 <form action="addpage.php" method="POST">
    <table class="form">
       
    <tr>
        <td>
            <label>Page Name</label>
        </td>
        <td>
            <input type="text" name="pagename" placeholder="Enter Page Name..." class="medium" />
        </td>
    </tr>
 
    <tr>
        <td style="vertical-align: top; padding-top: 9px;">
            <label>Content</label>
        </td>
        <td>
            <textarea class="tinymce" name="pagebody"></textarea>
        </td>
    </tr>

	<tr>
        <td></td>
        <td>
            <input type="submit" name="submit" Value="Create" />
        </td>
    </tr>
    </table>
    </form>
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
