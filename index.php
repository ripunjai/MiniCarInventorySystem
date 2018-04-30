<?php
ob_start();
session_start();

require_once 'db.php';
if (isset($_REQUEST['er'])) {
	$error = $_REQUEST['er'];
} else {
	if ($connection->is_logged_in() != "") {
		$connection->redirect('dashboard.php');
	}
	if (isset($_POST['loginBtn'])) {
		$uname = $_POST['username'];
		$upass = $_POST['password'];

		if ($connection->login($uname, $upass, "admin", "admin_password", "admin_id", "admin_email")) {
			$connection->redirect('dashboard.php');
		} else {
			$error = "Wrong credentials provided";
		}

	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mini Car Inventory System | Login </title>

    <!-- Google Fonts -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap Core Css -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="style.css" rel="stylesheet">
  </head>
  <body class="login-page ls-closed" data-gr-c-s-loaded="true" cz-shortcut-listen="true">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Login<b> Page</b></a>
            <!-- <small>Admin BootStrap Based - Material Design</small> -->
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" novalidate="novalidate">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" aria-required="true">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" name='loginBtn' type="submit">SIGN IN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- jQuery -->
   <script src="vendors/jquery/dist/jquery.min.js"></script>
   <!-- Bootstrap -->
   <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- FastClick -->
   <script src="vendors/fastclick/lib/fastclick.js"></script>
   <!-- NProgress -->
   <script src="vendors/nprogress/nprogress.js"></script>
   <!-- iCheck -->
   <script src="vendors/iCheck/icheck.min.js"></script>

   <!-- Custom Theme Scripts -->
   <script src="build/js/custom.min.js"></script>

</body>
</html>
