<?php require('partials/header.php'); 
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
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Model</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                    </li>

                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                    <form id="modelForm" method="POST" onsubmit='return false' >
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label for="heard">Modal Name *:</label>
                        <div class="form-line">
                          <input type="text" class="validate[required] form-control" name="name" placeholder="Add Model" autofocus="" aria-required="true">
                        </div>
                      </div>
                     
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="heard">Manufacturer *:</label>
                          <select id="heard" class="validate[required] form-control" name='manufacturer_id'>
                            <option value=''>Select Manufacturer </option>
                            <?php  foreach ($manufacturers as $key => $manufacturer) : ?>
                              <option value='<?php echo $manufacturer->id ?>' > <?php echo $manufacturer->name ?> </option>
                            <?php endforeach; ?> 
                          </select>
                      </div>
                      <button type="submit"  id="submitModelBtn" class="btn btn-success">Submit</button>
                    </form>

                </div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>View Model.
                    <small></small>
                  </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
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
                          <th>Created Date</th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          if( !empty( $models ) ):
                            foreach ($models as $key => $model) : 
                              $manufactureName = App::get('database')->OneRowCondition('name', 'manufacturer',"id='{$model->manufacturer_id}'");
                            ?>
                              <tr>
                                  <td> <?php echo $key+1 ?> </td>
                                  <td><?php echo $manufactureName['name'] ?></td>
                                  <td><?php echo $model->name ?></td>
                                  <td><?php echo date('d-m-Y', strtotime($model->created_date)) ?? '-'; ?></td>
                                  <td> <button model_id='<?php echo $model->id ?>' type="button" class="btn label-danger delete-model-btn" >Delete</button> </td>
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
        <?php  require('partials/footer-link.php'); ?>
    </div>
</div>
<?php  require('partials/footer.php'); ?>
<script>

  $("#modelForm").validationEngine();
  $('#modelForm').on('submit',function(e){
    e.preventDefault();
      if(!$("#modelForm").validationEngine('validate')){
        return false;
      }
      $.ajax({
            type:'POST',
            url: 'model/store',
            data: $("#modelForm").serializeArray(),
            success:function(data){
                alert('Data added successfully');
                location.reload();
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
      });
  });

  $(document).on('click','.delete-model-btn',function(e){
   var This = $(this);
    data = {
        'model_id' : $(this).attr('model_id')
    }
        $.ajax({
            type:'POST',
            url: 'model/delete',
            data: data,
            success:function(data){
                data = JSON.parse(data);
                if(data.status == 'failed'){
                    alert(data.msg);
                } else {
                    alert('Record delete successfully.');
                    location.reload();
                }
            },
            error: function(data){
            
            }
        });
    });

</script>