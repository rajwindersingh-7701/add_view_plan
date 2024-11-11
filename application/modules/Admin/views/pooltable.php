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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
   


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
                <div class="card-header">
                  <form method="GET" action="<?php echo base_url('Admin/Management/poolMembers/'.$pool1.'/'.$rank1.'');?>">
                      <div class="row">
                          <div class="col-md-3">
                              <select class="form-control" name="type">
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                  <option value="name" <?php echo $type == 'name' ? 'selected' : '';?>>
                                      Name</option>
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
                          <div class="col-md-3">
                              <div class="input-group-append">
                                  <!-- <button type="button" class="btn btn-default" onclick="Export();">Export Excel<i class="fa fa-download"></i></button> -->
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
                <!-- <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Upline ID</th>
                            <th>Downline Count</th>
                            <th>Team</th>
                            <th>Status</th>
                            <th>Credit Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = ($segament) + 1;
                        foreach ($users as $key => $income) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $income['user_id']; ?></td>
                                <td><?php echo $income['upline_id']; ?></td>
                                <td><?php echo $income['username']['name']; ?></td>
                                <td><?php echo $income['down_count']; ?></td>
                                <td><?php echo $income['team']; ?></td>
                                <td><?php echo $income['status']; ?></td>
                                <td><?php echo $income['created_at']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                echo $this->pagination->create_links();
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             </div>
          </div>
        </div>
            <div>
      </div>
         </div><!-- /.container-fluid -->
    </div>
  </div>
<?php include'footer.php' ?>
