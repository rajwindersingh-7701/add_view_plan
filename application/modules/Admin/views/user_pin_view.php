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
                <h3 class="card-title"><?php echo $header; ?></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                      <!-- <a href="<?php echo base_url('Admin/Settings/DebitEpins/'.$pins[0]['user_id']);?>" class="btn btn-success">Debit Epins</a> -->
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
                            <th>Epin</th>
                            <th>Send by</th>
                            <th>Status</th>
                            <th>Used For</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($pins as $key => $pin) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $pin['user_id']; ?></td>
                                <td><?php echo $pin['epin']; ?></td>
                                <td><?php echo $pin['sender_id'] == '' ? 'Admin' : $pin['sender_id']; ?></td>
                                <td><?php 
                                if($pin['status'] == 0 ){
                                    echo'<span class="text-primary">Unused</span>';
                                }elseif($pin['status'] == 1 ){
                                    echo'<span class="text-success">Used</span>';
                                }elseif($pin['status'] == 2 ){
                                    echo'<span class="text-danger">Transferred</span>';
                                }
                                ?></td>
                                <td><?php echo $pin['used_for'] ; ?></td>
                                <td><?php echo $pin['created_at'] ; ?></td>
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