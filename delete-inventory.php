<?php
  require_once 'db.php';
  $arrData = [
    'deleted_flag' => '1'
  ];
  $catCondition = "id=".$_REQUEST['inventory_id'];
  $orderQuery = $connection->UpdateQuery("inventory",$arrData,$catCondition);
?>