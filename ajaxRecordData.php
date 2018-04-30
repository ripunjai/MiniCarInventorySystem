<?php
require_once 'db.php';

if($_REQUEST['type']=="model"){
    $modelQuery = $connection->tableDataCondition("id,name", "model","manufacturer_id='{$_POST['manufacturer_id']}' AND deleted_flag=0 ");
    $result =$modelQuery->fetchAll(PDO::FETCH_ASSOC);
    
    $options = "<option value=''>Select State</option>";

    foreach($result as $key => $value ){
        $options .= "<option value='".$value['id']."'>".$value['name']."</option>";
    }
    echo $options;
}