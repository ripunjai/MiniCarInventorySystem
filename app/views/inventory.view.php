<?php require('partials/header.php');
require('partials/modalPopUp.php');
use App\Core\App;
?>
  <div class="container body">
    <div class="main_container">
    <?php 
      $dashboard = "active";
      require('partials/side-menu.php');
      require('partials/top-menu.php');
      ?>
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
                          if( !empty( $inventorys ) ):
                            foreach ($inventorys as $key => $inventory) : 
                              $manufactureName = App::get('database')->OneRowCondition('name', 'manufacturer',"id='{$inventory->manufacturer_id}'");
                              $modelName = App::get('database')->OneRowCondition('name', 'model',"id='{$inventory->model_id}'");
                            ?>
                              <tr>
                                  <td> <?php echo $key+1 ?> </td>
                                  <td><?php echo $manufactureName['name'] ?></td>
                                  <td><?php echo $modelName['name'] ?></td>
                                  <td><?php echo $inventory->TotalByOrder ?? '0'; ?></td>
                                  <td> <button manufacturer_id='<?php echo $inventory->manufacturer_id ?>' model_id='<?php echo $inventory->model_id ?>' type="button" class="btn info viewMore" >View More</button> </td>
                              </tr>
                          <?php endforeach; 
                            endif;
                          ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

             
            </div>
          </div>
        </div>
      <?php  require('partials/footer-link.php'); ?>
    </div>
  </div>
  <?php  require('partials/footer.php'); ?>
  <script>
    
    $('.viewMore').on('click',function(e){
      data = {
        'manufacturer_id' : $(this).attr('manufacturer_id'),
        'model_id' : $(this).attr('model_id')
      }
        $.ajax({
            type:'POST',
            url: 'inventory/view-inventory',
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
        url: 'inventory/delete-inventory',
        data: data,
        success:function(data){
          This.parents('tr').remove();
        },
        error: function(data){
           
        }
    });
});
</script>