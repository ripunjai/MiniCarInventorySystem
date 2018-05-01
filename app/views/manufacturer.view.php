<?php require('partials/header.php'); ?>

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
                            <h2>Add Manufacturer.
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
                            <form id="manufacturerForm" method="POST" onsubmit='return false' >
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <label for="heard">Manufacturer Name *:</label>
                                <div class="form-line">
                                <input type="text" class="validate[required] form-control" name="name" placeholder="Manufacturer Name" autofocus="" aria-required="true">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit"  id="submitManufacturerBtn" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>View Manufacturer.
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
                                <th>Created Date</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($manufacturers as $key => $manufacturer) : ?>
                            <tr>
                                <td> <?php echo $key+1 ?> </td>
                                <td><?php echo $manufacturer->name ?></td>
                                <td><?php echo date('d-m-Y', strtotime($manufacturer->created_date)) ?? '-'; ?></td>
                                <td> <button manufacturer_id='<?php echo $manufacturer->id ?>' type="button" class="btn label-danger delete-manufacture-btn" >Delete</button> </td>
                            </tr>
                        <?php endforeach; ?>    
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

  $("#manufacturerForm").validationEngine();
  $('#manufacturerForm').on('submit',function(e){
    e.preventDefault();
      if(!$("#manufacturerForm").validationEngine('validate')){
        return false;
      }
      $.ajax({
            type:'POST',
            url: 'manufacturer/store',
            data: $("#manufacturerForm").serializeArray(),
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

  $(document).on('click','.delete-manufacture-btn',function(e){
   var This = $(this);
    data = {
        'manufacturer_id' : $(this).attr('manufacturer_id')
    }
        $.ajax({
            type:'POST',
            url: 'manufacturer/delete',
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