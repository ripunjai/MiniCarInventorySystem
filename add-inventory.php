<?php  include_once 'header.php'; ?>
  <div class="container body">
    <div class="main_container">
    <?php 
      $dashboard = "active";
      include_once 'side-menu.php';
      include_once 'top-menu.php';
      ?>
      <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Add Inventory</h2>
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
                    <form id="inventoryUploadForm" method="POST" enctype="multipart/form-data" onsubmit='return false' data-parsley-validate>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="manufacturer-id">Manufacturer *:</label>
                          <select id="manufacturer-id" class="validate[required] form-control" name='manufacturer_id'>
                            <option value=''>Select Manufacturer </option>
                            <?php
                              $getModel = $connection->tableDataCondition("id, name", "manufacturer", "deleted_flag=0");
                                  $strModelLists = $getModel->fetchAll(PDO::FETCH_ASSOC);
                                  if( !empty( $strModelLists ) ){
                                    foreach ($strModelLists as $strModelList) {
                                      echo "<option value=". $strModelList['id'] ." > ". $strModelList['name'] ." </option>";
                                    }
                                  }
                            ?>
                          </select>
                      </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="model-id">Model *:</label>
                          <select id="model-id" class="validate[required] form-control" name='model_id'>
                            <option value=''>Select Model </option>
                          </select>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="color">Color *:</label>
                          <div class="form-line">
                          <input type="text" class="validate[required] form-control"  data-parsley-trigger="change" name="color" placeholder="Add Color" autofocus="" aria-required="true">
                        </div>
                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="year">Manufacturing Year *:</label>
                          <div class="form-line">
                          <input type="text" class="validate[required] form-control"  data-parsley-trigger="change" name="manufacturing_year" placeholder="Add Year" autofocus="" aria-required="true">
                        </div>
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="reg-number">Registration Number *:</label>
                          <div class="form-line">
                          <input type="text" class="validate[required] form-control" data-parsley-trigger="change" name="registration_number" placeholder="Add Registration Number" autofocus="" aria-required="true">
                        </div>
                      </div>

                       <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="note">Note *:</label>
                          <div class="form-line">
                          <textarea id="message" name='note' class="validate[required] form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="1" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="heard">Main Image :</label>
                          <div class="form-line">
                          <input type="file" name="mainImg" id="mainImg" class="form-control">
                        </div>
                      </div>


                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="heard">Other Image :</label>
                          <div class="form-line">
                          <input type="file" name="otherImgs" id="otherImgs" class="form-control">
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <button type="submit"  id="submitInventoryBtn" class="btn btn-success">Submit</button>
                    </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php   include_once 'footer-link.php'; ?>
    </div>
  </div>
  <?php include_once 'footer.php'; ?>
  <script>
    
    $("#manufacturer-id").on('change',function(){
     
      data = {
        'manufacturer_id' : $(this).find('option:selected').val(),
        'type' : 'model'
      }
       $.ajax({
          type:'POST',
          url: 'ajaxRecordData.php',
          data: data,
          success:function(data){
            $('#model-id').html(data);
          },
          error: function(data){
             
          }
      });

    })


  $("#inventoryUploadForm").validationEngine();
  $('#inventoryUploadForm').on('submit',function(e){
    e.preventDefault();
      if(!$("#inventoryUploadForm").validationEngine('validate')){
        return false;
      }

      var formData = new FormData(this);
      
      $.ajax({
          type:'POST',
          url: 'inventory.php',
          data:formData,
          cache:false,
          contentType: false,
          processData: false,
          success:function(data){
            $('#inventoryUploadForm').find('input:text, select, textarea').val('');
            $("#mainImg").val(null);
            $("#otherImgs").val(null);

            alert('Data added successfully');
          },
          error: function(data){
              console.log("error");
              console.log(data);
          }
      });
  });
    </script>