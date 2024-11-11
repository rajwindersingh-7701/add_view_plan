<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Site Number</span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
             <!--  <div class="card-header">
                <a href="<?php echo base_url('Admin/Settings/changeNumber');?>" class="btn btn-success">Update NEW</a>   
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Number</th>
                            <th>Second Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($franchises as $key => $franchise) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $franchise['phone1']; ?></td>
                                <td><?php echo $franchise['phone2']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Settings/editnumber/'.$franchise['id']);?>" class="btn btn-danger btn-sm">Edit</a></td>
                               <!--  <td><a href="<?php echo base_url('Admin/Settings/deletefranchise/'.$franchise['id']);?>" class="btn btn-danger btn-sm">Delete</a></td> -->

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