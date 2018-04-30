<?php  include_once 'header.php'; ?>
  <div class="container body">
    <div class="main_container">
    <?php 
      $dashboard = "active";
      include_once 'side-menu.php';
      include_once 'top-menu.php';
      $modelQuery = $connection->tableData("id,manufacturer_id,name, created_date", "model WHERE deleted_flag=0 order by id DESC");
      if(isset($_REQUEST['subMitBtn'])){

        $ProductsCol = array(
          'name'=>$_REQUEST['name'],
          'manufacturer_id'=>$_REQUEST['manufacturer_id'],
        ); 

        $connection->InsertQuery("model", $ProductsCol); 
      }

      ?>
      <div class="right_col" role="main">
        <div class="">

          <div class="clearfix"></div>

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
                  
                    <form id="sign_up" method="POST" data-parsley-validate>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label for="heard">Modal Name *:</label>
                        <div class="form-line">
                          <input type="text" class="form-control" required data-parsley-trigger="change" name="name" placeholder="Add Model" autofocus="" aria-required="true">
                        </div>
                      </div>

                     
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <label for="heard">Manufacturer *:</label>
                          <select id="heard" class="form-control" name='manufacturer_id' required>
                            <option value=''>Select Manufacturer </option>
                            <?php
                              $getManufacture = $connection->tableDataCondition("id, name", "manufacturer", "deleted_flag=0");
                                  $strManLists = $getManufacture->fetchAll(PDO::FETCH_ASSOC);
                                  if( !empty( $strManLists ) ){
                                    foreach ($strManLists as $strManuList) {
                                      echo "<option value=". $strManuList['id'] ." > ". $strManuList['name'] ." </option>";
                                    }
                                  }
                            ?>
                          </select>
                      </div>

                      
                      <button type="submit"  name="subMitBtn" class="btn btn-success">Submit</button>
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
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    $count =1;
                    while ($row = $modelQuery->fetch()) {
                      $manufactureName = $connection->OneRowCondition("name", "manufacturer", "id='{$row['manufacturer_id']}'");
                      ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $manufactureName['name']; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo date('d-m-Y', strtotime($row['created_date'])) ?? '-'; ?></td>
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