<?php require('partials/header.php'); ?>

<div class="container body">
    <div class="main_container">
    <?php 
      $dashboard = "active";
      require('partials/side-menu.php');
      require('partials/top-menu.php');
    ?>
    <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <h1> Dashboard </h1>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php  require('partials/footer-link.php'); ?>
    </div>
  </div>
  <?php  require('partials/footer.php'); ?>