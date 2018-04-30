<?php
  require_once 'db.php';
  
  $filename = $filename1 = '';

  if( isset( $_FILES["mainImg"]["name"]) && ($_FILES["mainImg"]["name"] != '')){
    $folder = "images/inventory-images/"; 
    $file = explode(".", $_FILES["mainImg"]["name"]);
    $filename = round(microtime(true)*1000) . '.' . end($file);
    $full_path = $folder.$filename; 
    move_uploaded_file($_FILES['mainImg']['tmp_name'], $full_path);
  }

  if( isset( $_FILES["otherImgs"]["name"]) && ($_FILES["otherImgs"]["name"] != '')){
    $file1 = explode(".", $_FILES["otherImgs"]["name"]);
    $filename1 = round(microtime(true)*2000) . '.' . end($file1);
    $full_path1 = $folder.$filename1; 
    move_uploaded_file($_FILES['otherImgs']['tmp_name'], $full_path1);
  } 

 $ProductsCol = array(
  'model_id'=>$_REQUEST['model_id'],
  'manufacturer_id'=>$_REQUEST['manufacturer_id'],
  'color'=>$_REQUEST['color'],
  'manufacturing_year'=>$_REQUEST['manufacturing_year'],
  'registration_number'=>$_REQUEST['registration_number'],
  'note'=>$_REQUEST['note'],
  'img1' => $filename,
  'img2' => $filename1,
); 

$connection->InsertQuery("inventory", $ProductsCol);
?>