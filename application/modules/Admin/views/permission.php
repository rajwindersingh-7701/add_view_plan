<?php include'header.php' ?>
 <div class="main-content">

                <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Permission</span>
            </section>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/Index') ?>">Home</a></li>
              <li class="breadcrumb-item active">Permission</li>
            </ol>
          </div>
        </div>     
      <div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                    <a class="btn btn-primary" href="<?php echo base_url('Admin/Permission/CreateSubAdmin');?>">Create Sub-Admin</a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Password</th>
                            <th>Email</th>
                            <!-- <th>Sub Admin</th> -->
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $key => $value):?>
                        <tr>
                            <td><?php echo ($key+1); ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['user_id']; ?></td>
                            <td><?php echo $value['password']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><a href="<?php echo base_url('Admin/Management/Sublogin/');?>" target="_blank">Login</a></td>

                            <td>
                              <a href="<?php echo base_url('Admin/Permission/ChangePermission/'.urlencode($value['user_id']));  ?>">Permission</a> |
                              <a href="<?php echo base_url('Admin/Permission/edit/'.$value['id']);  ?>">Edit</a> |
                              <a href="<?php echo base_url('Admin/Permission/deleteUser/'.$value['id']);  ?>">Delete</a>
                          </td>
                            
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                </table>
              </div>
              <!-- <div class="row">
                  <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                          Showing <?php echo ($segament + 1) .' to  '.($i -1);?> of
                          <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                          <?php
                          echo $this->pagination->create_links();
                          ?>
                      </div>
                  </div>
              </div> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
   </div>
<?php include 'footer.php' ?>