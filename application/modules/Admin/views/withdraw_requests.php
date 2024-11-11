<?php include 'header.php' ?>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <section class="content-header">
            <span class="">Withdraw Request(Payable Amount : <?php echo $total_withdraw['total_withdraw']; ?>) </span>
          </section>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Withdraw Request</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="export-table">
        <!-- <a href="<?php echo base_url('Admin/Withdraw/' . $url . '?export=xls'); ?>" class="export-btn btn-primary"><img src="<?php echo base_url('NewDashboard/'); ?>assets/images/xls.png">Export to xls</a> -->
        <a href="<?php echo base_url('Admin/Withdraw/' . $url . '?export=csv'); ?>" class="export-btn btn-success"><img src="<?php echo base_url('NewDashboard/'); ?>assets/images/csv.png">Export to csv</a>
        <!-- <a href="<?php echo base_url('Admin/Withdraw/index?export=txt'); ?>" class="export-btn btn-info "><img src="<?php echo base_url('NewDashboard/'); ?>assets/images/txt.png">Export to txt</a> -->
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="card-header">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <form action="" method="GET">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                    <!-- <select class="form-control" name="export">
                            <option value="">No Export</option>
                            <option value="csv">Export CSV</option>
                        </select> -->
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
                <form method="GET" action="<?php echo base_url('Admin/Withdraw/' . $url); ?>">
                  <div class="row">
                    <div class="col-md-3">
                      <select class="form-control" name="type">
                        <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : ''; ?>>
                          User ID</option>

                      </select>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="value" class="form-control float-right" value="" placeholder="Search">
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
              <!-- /.card-header -->
              <!-- <form method="POST" action="<?php echo base_url('Admin/Withdraw/approveAdminWithdraw') ?>"> -->
              <!-- <form form_open(base_url('Admin/Withdraw/approveAdminWithdraw'), array('id' => ''))> -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>#</th>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Amount</th>
                      <th>Charges</th>
                      <th>Payable Amount</th>
                      <th>Type</th>
                      <th>Status</th>
                      <th>Bank Name</th>
                      <th>A/C</th>
                      <th>A/C Holder Name</th>
                      <th>Ifsc</th>
                      <th>Kyc Status</th>
                      <th>Remark</th>
                      <th>Request Date</th>
                      <!-- <th>Credit IB</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = ($segament) + 1;

                    foreach ($requests as $key => $request) {
                      //                        pr($request);
                    ?>
                      <tr>

                        <td><?php echo ($request['status'] == 0 ? '<input name="data[]" type="checkbox" value="' . $request['id'] . '"/>' : ''); ?></td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $request['user_id']; ?></td>
                        <td><?php echo $request['user']['name']; ?></td>
                        <td><?php echo $request['user']['phone']; ?></td>
                        <td><?php echo $request['amount']; ?></td>
                        <td><?php echo 'TDS: ' . $request['tds'] . '<br>Admin: ' . $request['admin_charges'] . '<br>Repurchase: ' . $request['repurchase_charges']; ?></td>
                        <td><?php echo $request['payable_amount']; ?></td>
                        <td><?php echo ucwords(str_replace('_', ' ', $request['type'])); ?></td>
                        <td><?php
                            if ($request['status'] == 0)
                              echo 'Pending';
                            elseif ($request['status'] == 1)
                              echo 'Approved';
                            elseif ($request['status'] == 2)
                              echo 'Rejected';
                            ?></td>
                        <!-- <td> -->
                        <?php

                        // if($request['credit_type'] == 'BlockChain'){
                        //   echo $request['bank']['btc'].'<br>';

                        // }else{
                        if ($request['bank']['kyc_status'] == 0)
                          $kyc_status = 'Not Applied';
                        elseif ($request['bank']['kyc_status'] == 1)
                          $kyc_status = 'Pending';
                        elseif ($request['bank']['kyc_status'] == 2)
                          $kyc_status = 'Approved';
                        elseif ($request['bank']['kyc_status'] == 3)
                          $kyc_status =  'Rejected';
                        // echo 'Bank Name :'. $request['bank']['bank_name'].'<br>';
                        // echo 'Bank Account Number :'. $request['bank']['bank_account_number'].'<br>';
                        // echo 'Account Holder Name :'. $request['bank']['account_holder_name'].'<br>';
                        // echo 'Ifsc Code :'. $request['bank']['ifsc_code'].'<br>';
                        // echo 'Kyc Status :'. $kyc_status.'<br>';

                        echo '<td>' . $request['bank']['bank_name'] . '</td>';
                        echo '<td>' . $request['bank']['bank_account_number'] . '</td>';
                        echo '<td>' . $request['bank']['account_holder_name'] . '</td>';
                        echo '<td>' . $request['bank']['ifsc_code'] . '</td>';
                        echo '<td>' . $kyc_status . '</td>';

                        // echo 'BTC : '. $request['bank']['btc'].'<br>';
                        // echo 'Ethereum : '. $request['bank']['ethereum'].'<br>';
                        // echo 'Tron : '. $request['bank']['tron'].'<br>';
                        // echo 'Litecoin : '. $request['bank']['litecoin'].'<br>';

                        //}
                        ?>
                        <!-- </td> -->
                        <td><?php echo $request['remark']; ?></td>
                        <td><?php echo $request['created_at']; ?></td>
                        <!-- <td><?php //echo $request['credit_type']; 
                                  ?></td> -->
                        <!-- <td><a href="<?php echo base_url('Admin/Withdraw/request/' . $request['id']); ?>" target="_blank">View</a></td> -->
                        <td><a class="btn btn-success" href="<?php echo base_url('Admin/Withdraw/ApproveWithdraw/' . $request['id']); ?>">Approved</a> <a class="btn btn-danger" href="<?php echo base_url('Admin/Withdraw/RejectedWithdraw/' . $request['id']); ?>">Rejected</a></td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>


                  </tbody>

                </table>
                <?php
                echo form_open(base_url('Admin/Withdraw/approveAdminWithdraw'), array('id' => ''));

                if ($url == 'Pending') {
                  // if ($status == 0) {
                  echo '<div class="w-25"><select name="status" class="form-control" >
                                                <option value="1">Approve</option>
                                                <option value="2">Reject</option> 
                                            </select></div><br>';
                  echo '<button type="submit" class="btn btn-primary">Submit</button>';
                  // }
                  echo form_close();
                }
                ?>
                <!-- </form> -->
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                      Showing <?php echo ($segament + 1) . ' to  ' . ($i - 1); ?> of
                      <?php echo $total_records; ?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                      <?php
                      echo $this->pagination->create_links();
                      ?>
                    </div>
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