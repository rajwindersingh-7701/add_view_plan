<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
              <span class=""><?php echo $header;?> </span>
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> <?php echo $header;?> </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
                <div class="card-header">
                  <form method="GET" action="<?php echo base_url('Admin/Task/roiUser');?>">
                      <div class="row">
                          <div class="col-md-3">
                              <select class="form-control" name="type">
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
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
                            <th>Amount</th>
                            <th>Days</th>
                            <!-- <th>Status</th> -->
                            <!-- <th>Payment Method</th> -->
                            <!-- <th>Remark</th> -->
                            <th>Created At</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = ($segament) + 1;
                        foreach ($requests as $key => $request) {
                          // pr($request);
                            ?>
                            <tr>
                                <td><?php echo ($i) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['amount']; ?></td>
                                <!-- <td><img src="<?php// echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td> -->
                               <!--  <td><?php 
                                   // if($request['status'] == 0){
                                     //   echo'<span class="btn btn-primary">Pending</span>';
                                    //}elseif($request['status'] == 1){
                                      //  echo'<span class="btn btn-success">Approved</span>';
                                    //}elseif($request['status'] == 2){
                                      //  echo'<span class="btn btn-danger">Rejected</span>';
                                    //}
                                ?></td> -->
                                <td><?php echo $request['days']; ?></td>
                                <!-- <td><?php// echo $request['remarks']; ?></td> -->
                                <td><?php echo $request['created_at']; ?></td>
                                <!-- <td><a href="<?php //echo base_url('Admin/Management/update_fund_request/'.$request['id']);?>" class="btn btn-info">View</a></td> -->
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <div class="row">
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

<?php include 'footer.php' ?>