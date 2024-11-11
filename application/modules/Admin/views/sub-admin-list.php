<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header;?></span>
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     
    <div>
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
              <div class="card-header">
                  <!-- <form method="GET" action="<?php echo base_url('Admin/Management/users/');?>">
                      <div class="row">
                          <div class="col-md-3">
                              <select class="form-control" name="type">
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                  <option value="name" <?php echo $type == 'name' ? 'selected' : '';?>>
                                      Name</option>
                                  <option value="phone" <?php echo $type == 'phone' ? 'selected' : '';?>>Phone
                                  </option>
                                  <option value="sponser_id"
                                      <?php echo $type == 'sponser_id' ? 'selected' : '';?>>Sponser ID
                                  </option>
                                  <option value="area_code"
                                      <?php echo $type == 'area_code' ? 'selected' : '';?>>Team Code
                                  </option>
                              </select>
                          </div>
                          <div class="col-md-3">
                              <input type="text" name="value" class="form-control float-right"
                                  value="" placeholder="Search">
                          </div>

                          <div class="col-md-3">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              </div>
                          </div>
                      </div>
                  </form> -->
              </div>
              <!-- <div class="export-table">
                  <a href="<?php echo base_url('Admin/Management/users?export=xls'); ?>" class="export-btn btn-primary"><img src="<?php echo base_url('NewDashboard/');?>assets/images/xls.png">Export to xls</a>
                  <a href="<?php echo base_url('Admin/Management/users?export=csv'); ?>" class="export-btn btn-success"><img src="<?php echo base_url('NewDashboard/');?>assets/images/csv.png">Export to csv</a>
                  <a href="<?php echo base_url('Admin/Management/users?export=txt'); ?>" class="export-btn btn-info "><img src="<?php echo base_url('NewDashboard/');?>assets/images/txt.png">Export to txt</a>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <p id="demo"></p>
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1;
                        foreach ($users as $key => $user) {
                      ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><a href="<?php echo base_url('Admin/SubAdmin/permissionUser/'.$user['user_id']);?>">View</a></td>
                            </td>
                        </tr>
                      <?php
                        $i++;
                        }
                      ?>
                    </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
   </div>
<?php include'footer.php' ?>