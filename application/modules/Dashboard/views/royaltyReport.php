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
        <span style="">Level Reports</span>
    </section>

    <!-- END page-header -->
    <!-- BEGIN wizard -->


     <div class="card">
          <div class="card-body">
             <h4 class="page-header" style="margin-top:20px">
    </h4>
    <div id="rootwizard" class="wizard wizard-full-width" >
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content" >
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
                                    <th>Level</th>
                                    <th>ID's</th>
                                    <th>Paid Members</th>
                                    <th>Free Members</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($level as $key => $record) {
                                       $paidTeam= $this->User_model->calculateLevelTeam($this->session->userdata['user_id'],1,$record['level']);
                                        $freeTeam = $this->User_model->calculateLevelTeam($this->session->userdata['user_id'],0,$record['level']);
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $record['level']; ?></td>
                                        <td><?php echo $record['total']; ?></td>
                                        <td><?php echo $paidTeam['team']; ?></td>
                                        <td><?php echo $freeTeam['team']; ?></td>
                                        <td><a href="<?php echo base_url('Dashboard/Fund/levelWise/'.$record['level']) ?>">View</a></td>
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
