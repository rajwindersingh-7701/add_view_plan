<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
                    <h1 class="m-0 text-dark"> <?php echo $header; ?> </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> <?php echo $header; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->



            <div class="row d">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header  ">
                            <form action="" method="GET " action="<?php echo base_url('Admin/Settings/benificaryHistory/');?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-control" name="type">
                                             <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                            User ID</option>
                                    </div>
                                    <div class="col-md-3">
                                   <input type="text" name="value" class="form-control float-right"value="" placeholder="Search">
                               </div>
                                    <div class="col-md-3">
                                       <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Bank</th>
                                        <th>Account No.</th>
                                        <th>Branch</th>
                                        <th>IFSC</th>
                                        <th>Beneficiary ID</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                         <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $i = ($segament) + 1;
                                    foreach ($records as $key => $request) {
                                        ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $request['user_id']; ?></td>
                                        <td><?php echo $request['beneficiary_name']; ?></td>
                                        <td><?php echo $request['beneficiary_bank']; ?></td>
                                        <td><?php echo $request['beneficiary_account_no']; ?></td>
                                        <td><?php echo $request['beneficiary_branch']; ?></td>
                                        <td><?php echo $request['account_ifsc']; ?></td>
                                        <td><?php echo $request['beneficiary_ifsc']; ?></td>
                                        <td><?php echo $request['beneficiary_mobile']; ?></td>
                                       

                                        <td><?php echo $request['created_at']; ?></td>
                                          <td>
                                              <a class="btn btn-success" href="<?php echo base_url('Admin/Settings/Editbenificary/'.$request['user_id']) ?>">Edit</a> 
                                          </td>

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
                                        Showing <?php echo ($segament + 1) .' to  '.$i;?> of
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