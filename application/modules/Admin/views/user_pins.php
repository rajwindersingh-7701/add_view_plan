<?php include'header.php' ?>
<div class="main-content">
      <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header; ?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/'); ?>"><?php echo $header; ?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
  
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Users Pins</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Pins</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($user_pins as $key => $pin) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $pin['user_id']; ?></td>
                                <td><?php echo $pin['user']['name']; ?></td>
                                <td><?php echo $pin['user']['phone']; ?></td>
                                <td><?php echo $pin['pin_count'] ; ?></td>
                                <td><a href="<?php echo base_url('Admin/Settings/userPinView/'.$pin['user_id']);?>">View</a></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>