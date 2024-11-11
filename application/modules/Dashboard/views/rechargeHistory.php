<?php include'header.php' ?>
<main>
<div class="content-wrapper" style="min-height: 378px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $header; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive p-4 bg-white mb-4">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount </th>
                                    <th>Phone No. </th>
                                    <th>Opreator</th>
                                    <th>Opreator ID</th>
                                    <th>Transaction ID</th>
                                    <th>Status</th>
                                    <th>Recharge Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['amount']; ?></td>
                                        <td><?php echo $transaction['phone']; ?></td>
                                        <td><?php echo $transaction['opreator_name']; ?></td>
                                        <td><?php echo $transaction['operatorid']; ?></td>
                                        <td><?php echo $transaction['trasaction_id']; ?></td>
                                        <td><?php echo $transaction['status']; ?></td>
                                        <td><?php echo $transaction['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
</main>
<?php include'footer.php' ?>