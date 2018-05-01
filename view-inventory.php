<?php  include_once 'header.php'; ?>
    <?php include_once 'modalPopUp.php'; ?>
    <div class="container body">
      <div class="main_container">
         <?php 
          include_once 'side-menu.php';
          include_once 'top-menu.php';
          $inventoryQuery = $connection->tableData("id,manufacturer_id,model_id,  COUNT(*) TotalByOrder", "inventory WHERE deleted_flag=0 GROUP BY manufacturer_id,model_id order by id DESC");
          ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">

            <div class="row"> 
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Inventory </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Serial Number</th>
                          <th>Manufacturer Name</th>
                          <th>Model Name</th>
                          <th>Count</th>
                          <th>View</th>
                        </tr>
                      </thead>


                      <tbody>
                      <?php
                    $count =1;
                    while ($row = $inventoryQuery->fetch()) {
                      $manufactureName = $connection->OneRowCondition("name", "manufacturer", "id='{$row['manufacturer_id']}'");
                      $modelName = $connection->OneRowCondition("name", "model", "id='{$row['model_id']}'");
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $manufactureName['name']; ?></td>
                          <td><?php echo $modelName['name'] ?? '-'; ?></td>
                          <td><?php echo $row['TotalByOrder'] ?? '0'; ?></td>
                          <td> <button manufacturer_id='<?php echo $row['manufacturer_id'] ?>' model_id='<?php echo $row['model_id'] ?>' type="button" class="btn info viewMore" >View More</button> </td>
                        </tr>
                        <?php $count++; }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

             
            </div>
          </div>
        </div>
        <!-- /page content -->

      <?php  include_once 'footer-link.php'; ?>
      </div>
    </div>
    <?php include_once 'footer.php'; ?>


  <script type='text/javascript'>
$('.viewMore').on('click',function(e){
  data = {
    'manufacturer_id' : $(this).attr('manufacturer_id'),
    'model_id' : $(this).attr('model_id')
  }
    $.ajax({
        type:'POST',
        url: 'get-inventory-data.php',
        data: data,
        success:function(data){
          $('#myModal').find('.modal-body').html();
          $('#myModal').find('.modal-body').html(data);
        $('#myModal').modal('show');
        },
        error: function(data){
           
        }
    });
})
 $(document).on('click','.sellInventory',function(e){
   var This = $(this);
  data = {
    'inventory_id' : $(this).attr('inventory_id')
  }
    $.ajax({
        type:'POST',
        url: 'delete-inventory.php',
        data: data,
        success:function(data){
          This.parents('tr').remove();
        },
        error: function(data){
           
        }
    });
})
</script>