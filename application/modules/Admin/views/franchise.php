<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Franchise</span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Franchise users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
                <a href="<?php echo base_url('Admin/Settings/createfranchise');?>" class="btn btn-success">Create Franchise</a>   
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
                            <th>City</th>
                            <th>State</th>

                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($franchises as $key => $franchise) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $franchise['user_id']; ?></td>
                                <td><?php echo $franchise['name']; ?></td>
                                <td><?php echo $franchise['phone']; ?></td>
                                <td><?php echo $franchise['city']; ?></td>
                                <td><?php echo $franchise['state']; ?></td>

                                 <td><?php echo $franchise['created_at']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Settings/deletefranchise/'.$franchise['id']);?>" class="btn btn-danger btn-sm">Delete</a></td>
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
      </div>
   
<?php include'footer.php' ?>