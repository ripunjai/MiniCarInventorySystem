<?php
  require_once 'db.php';
  $orderQuery = $connection->tableDataCondition("*", "inventory","manufacturer_id='{$_POST['manufacturer_id']}' AND model_id='{$_POST['model_id']}' AND deleted_flag=0   ");
?>

<table id="datatable-buttons" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Serial Number</th>
        <th>Color</th>
        <th>Manufacturing Year</th>
        <th>Registration Number</th>
        <th>Sold</th>
      </tr>
    </thead>

    <tbody>
    <?php
  $count =1;
  while ($row = $orderQuery->fetch()) {
    ?>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo  $row['color']; ?></td>
        <td><?php echo  $row['manufacturing_year'] ?? '-'; ?></td>
        <td><?php echo  $row['registration_number'] ?? '-'; ?></td>
        <td> <button inventory_id='<?php echo $row['id'] ?>' type="button" class="btn info sellInventory" >Sold</button> </td>
      </tr>
      <?php $count++; }?>
    </tbody>
  </table>