<style>
    section.content-header {
        background-color: #e0e0e0;
        padding: 10px;
        font-size: 20px;
        margin: 21px 0px;
        border-radius: 10px;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- BEGIN breadcrumb -->
            <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
            <!-- END breadcrumb -->
            <!-- BEGIN page-header -->
            <section class="content-header">
                <span style=""><?php echo $levelName; ?> Level Report</span>
            </section>

            <!-- END page-header -->
            <!-- BEGIN wizard -->


            <div class="card">
                <div class="card-body">
                    <h4 class="page-header" style="margin-top:20px">
                    </h4>
                    <div id="rootwizard" class="wizard wizard-full-width">
                        <!-- BEGIN wizard-header -->

                        <!-- END wizard-header -->
                        <!-- BEGIN wizard-form -->

                        <div class="wizard-content tab-content">
                            <!-- BEGIN tab-pane -->
                            <div class="tab-pane active show" id="tabFundRequestForm">
                                <!-- BEGIN row -->
                                <div class="box box-solid bg-black">

                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <!-- BEGIN col-6 -->
                                            <table class="table table-bordered table-striped dataTable" id="tableView">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Status</th>
                                                        <th>Task</th>
                                                        <th>Date</th>
                                                        <th>Joining Date</th>
                                                        <th>Activation Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($level as $key => $record) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo ($key + 1) ?></td>
                                                            <td><?php echo $record['downline_id']; ?></td>
                                                            <td><?php echo $record['user']['name']; ?></td>
                                                            <td><?php echo $record['user']['phone']; ?></td>
                                                            <td>
                                                                <?php if ($record['user']['paid_status'] == 1) {
                                                                    echo "<span class='text-success'>Paid</span>";
                                                                } else {
                                                                    echo "<span class='text-danger'>Free</span>";
                                                                } ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($record['task']['redeem'] == 1) {
                                                                    echo "<span class='text-success'>Task Achieved</span>";
                                                                } else {
                                                                    echo "<span class='text-danger'>Task Pending</span>";
                                                                } ?>
                                                            </td>
                                                            <td><?php echo $record['task']['updated_at']; ?></td>
                                                            <td><?php echo $record['user']['created_at']; ?></td>
                                                            <td><?php echo $record['user']['topup_date']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                            <!-- END col-6 -->
                                        </div>
                                    </div>
                                </div>
                                <!-- END row -->
                            </div>
                            <!-- END tab-pane -->
                            <!-- BEGIN tab-pane -->

                        </div>
                        <!-- END wizard-content -->

                        <!-- END wizard-form -->
                    </div>
                </div>
            </div>

            <!-- END wizard -->
        </div>
    </div>
</div>