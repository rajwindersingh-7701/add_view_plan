<?php include 'header.php';?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
                    <h4 class="m-0 text-dark"> Bank Transation (Rs.<?php echo $bank_amount; ?>) </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Bank Transation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <div class="card-header">
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
                            <table class="table table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Beneficiary ID</th>
                                        <th>Amount</th>
                                        <th>Payable Amount</th>
                                        <th>TDS</th>
                                        <th>Admin Charges</th>
                                        <th>Status</th>
                                        <th>Order ID</th>
                                        <th>Jolo Order ID</th>
                                        <th>Operator Txn ID</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = ($segament) + 1;
                                    foreach ($transactions as $key => $request) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $request['user_id']; ?></td>
                                            <td><?php echo $request['beneficiaryid']; ?></td>
                                            <td>Rs.<?php echo $request['amount']; ?></td>
                                            <td>Rs.<?php echo $request['payable_amount']; ?></td>
                                            <td><?php echo $request['tds']; ?></td>
                                            <td><?php echo $request['admin_charges']; ?></td>
                                            <td><?php echo $request['status']; ?></td>
                                            <td><?php echo $request['orderid']; ?></td>
                                            <td><?php echo $request['joloorderid']; ?></td>
                                            <td><?php echo $request['operatortxnid']; ?></td>
                                            <td><?php echo $request['created_at']; ?></td>

                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                                        Showing <?php echo ($segament + 1) . ' to  ' . $i; ?> of
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

<?php include'footer.php' ?>