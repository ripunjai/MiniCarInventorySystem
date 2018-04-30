<?php
	ob_start();
	// session_start();
	require_once 'db.php';

	if(!$connection->is_logged_in())
	{
	   $connection->redirect('index.php');
	}

	$userQuery = $connection->OneRowCondition("*","admin","admin_id='{$_SESSION['user_session']}'");

	$_SESSION['menu'] = $userQuery['admin_menu'];
	$loggedId =  $_SESSION['user_session'];	
?>
 <!-- top navigation -->
 <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle">
            <i class="fa fa-bars"></i>
          </a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/img.jpg" alt=""><?php echo @$userQuery['admin_full_name']; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              
              <li>
                <a href="logout.php">
                  <i class="fa fa-sign-out pull-right"></i> Log Out</a>
              </li>
            </ul>
          </li>

         
        </ul>
      </nav>
    </div>
  </div>