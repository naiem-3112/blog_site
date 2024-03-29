<?php include '../lib/Session.php'; 
    Session::chkSession();
?>
<?php include '../helpers/Format.php'; ?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php 
    $db = new Database();
    $fm = new Format();
 ?>
 <?php
  
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000"); 

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/lg.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Admin Panel</h1>
					<p>Md. Shahadat Hossain</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/5.jpg" alt="Profile Pic" /></div>
                        <?php 
                        if(isset($_GET['action']) && $_GET['action'] =="logout"){
                            Session::destroy();
                        }

                         ?>

                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('username'); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
    <div class="clear">
</div>

<div class="grid_12">
    <ul class="nav main">
        <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
        <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
		<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
		<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
            <?php 
            $sql = "SELECT * FROM tbl_contact WHERE status = '0' ";
            $get = $db->select($sql);
            if($get){
                $count = mysqli_num_rows($get);
                echo "(".$count.")";
            }else{
                echo '(0)';
            }
    
             ?>

        </span></a></li>

        <?php if(Session::get('userRole')== '0'){ ?>
            <li class="ic-charts"><a href="adduser.php"><span>Add User</span></a></li>
        <?php } ?>
        <li class="ic-charts"><a href="postlist.php"><span>Visit Website</span></a></li>
        
        <li class="ic-charts"><a href="userlist.php"><span>User List</span></a></li>
    </ul>
</div>
<div class="clear">
</div>