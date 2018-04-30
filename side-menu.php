<?php
	ob_start();
	session_start();
	require_once 'db.php';

	if(!$connection->is_logged_in())
	{
	   $connection->redirect('index.php');
	}

	$userQuery = $connection->OneRowCondition("*","admin","admin_id='{$_SESSION['user_session']}'");
	$_SESSION['menu'] = $userQuery['admin_menu'];
	$loggedId =  $_SESSION['user_session'];	
?>

<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="index.php" class="site_title">
          <span>Inventory System </span>
        </a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="images/img.jpg" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Welcome,</span>
          <h2><?php echo @$userQuery['admin_full_name']; ?></h2>
        </div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          <ul class="nav side-menu">
          <li>
              <a href="dashboard.php">
                <i class="fa fa-user"></i> Dashboard </a>
            </li>
            <li>
              <a href="add-manufacturer.php">
                <i class="fa fa-user"></i> Add Manufacturer </a>
            </li>
            <li>
              <a href="add-model.php">
                <i class="fa fa-user"></i> Add Model </a>
            </li>
            <li>
              <a href="add-inventory.php">
                <i class="fa fa-user"></i> Add Inventory </a>
            </li>
            <li>
              <a href="view-inventory.php">
                <i class="fa fa-user"></i> View Inventory </a>
            </li>
           
          </ul>
        </div>

      </div>
      <!-- /sidebar menu -->
    </div>
  </div>