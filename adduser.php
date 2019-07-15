<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
       <?php 
       if(!Session:: get('userRole')== 0){
        echo "<script> window.location = 'index.php'; </script>";
       }


        ?>
        <div class="grid_10">
        <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
<?php 
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $username = mysqli_real_escape_string($db->link, $fm->validation($_POST['username']));
        $password = mysqli_real_escape_string($db->link, $fm->validation(md5($_POST['password'])));
        $role     = mysqli_real_escape_string($db->link, $fm->validation($_POST['role']));
        $email     = mysqli_real_escape_string($db->link, $fm->validation($_POST['email']));
        
        if(empty($username) || empty($password) || empty($role) || empty($email)){
            echo "<span class='error'>field must not be empty</span>";
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "<span class='error'>emial is not valid</span>";
        }else{
        $mailsql = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $mailget = $db->select($mailsql);
        if($mailget != false){
                echo "<span class='error'>Email already exist!</span>";
        }


        else{
            $sql = "INSERT INTO tbl_user(username, password, role, email) VALUES('$username', '$password', '$role', '$email')";
            $usercreate = $db->insert($sql);
            if($usercreate){
                echo "<span class='success'>User Created successfully</span>";
            }else{
                echo "<span class='error'>User not Created</span>";
            }

        }
    }
  }  

?>
 <form action="" method="POST">
    <table class="form">					
        <tr>
            <td>
                <label>Username</label>
            </td>
            <td>
                <input type="text" name="username" placeholder="Enter  Username..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Password</label>
            </td>
            <td>
                <input type="password" name="password" placeholder="Enter  Password..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Email</label>
            </td>
            <td>
                <input type="text" name="email" placeholder="Enter  valid email address..." class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>User Role</label>
            </td>
            <td>
                <select id="select" name="role">
                    <option>Select User Role</option>
                    <option value="0">Admin</option>
                    <option value="1">Author</option>
                    <option value="2">Editor</option>
                </select>
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

<?php include 'inc/footer.php'; ?>
