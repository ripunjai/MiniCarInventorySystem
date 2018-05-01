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
        if( !empty( $viewInventorys ) ):
          foreach ($viewInventorys as $key => $viewInventory) : 
          ?>
            <tr>
                <td> <?php echo $key+1 ?> </td>
                <td><?php echo $viewInventory->color ?></td>
                <td><?php echo $viewInventory->manufacturing_year ?></td>
                <td><?php echo $viewInventory->registration_number ?></td>
                <td> <button inventory_id='<?php echo $viewInventory->id ?>' type="button" class="btn info sellInventory" >Sold</button> </td>
            </tr>
        <?php endforeach; 
          endif;
        ?>
    </tbody>
  </table>