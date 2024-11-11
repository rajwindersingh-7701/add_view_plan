<?php include'header.php' ?>
<style>
.panel-heading {
    background: #e0e0e0;
    color: #000;
    padding: 8px 16px;
    border-radius: 10px;
}
</style>
<div class="main-content">
<div class="page-content">
<div class="container-fluid">
<div id="content" class="">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="panel-heading">
        <span style="">Withdraw Request  /   Withdraw summary</span>
    </h2>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card mt-4">
        <div class="card-body">
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Beneficiary ID</th>
                                    <th>Order ID</th>
                                    <th>Amount</th>
                                    <th>Deducted Amount</th>
                                    <th>IMPS Charges</th>
                                    <th>Bank Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>UTR</th>

                                    <th>Transfer Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $key => $transaction) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $transaction['user_id']; ?></td>
                                        <td><?php echo $transaction['beneficiaryid']; ?></td>
                                        <td><?php echo $transaction['orderid']; ?></td>
                                        <td>Rs.<?php echo $transaction['payable_amount']; ?></td>
                                        <td>Rs.<?php echo round(($transaction['payable_amount']*0.15),2); ?></td>
                                        <td><?php echo 'Rs.15'; ?></td>
                                        <td> Rs.<?php echo ((round($transaction['amount'],2))); ?></td>
                                        <td><?php echo $transaction['status']; ?></td>
                                        <td><?php echo $transaction['joloorderid']; ?></td>
                                        <td><?php echo $transaction['operatortxnid']; ?></td>

                                        <td><?php echo $transaction['created_at']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    </div>
                    <!-- END col-6 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END tab-pane -->
            <!-- BEGIN tab-pane -->

        </div>
        <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>
</div>
</div>



<?php include'footer.php' ?>
