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
        <span style=""><?php echo $header; ?></span>
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
                    <?php 
                            $reward = [
                                1 => ['direct' => 10,'level'=>0,'reward'=>'500','capping'=>1500,'rank'=>'star'],
                                2 => ['direct' => 15,'level'=>100,'reward'=>'1500','capping'=>3000,'rank'=>'silver'],
                                3 => ['direct' => 20,'level'=>500,'reward'=>'4500','capping'=>5000,'rank'=>'gold'],
                                4 => ['direct' => 25,'level'=>1500,'reward'=>'10000','capping'=>10000,'rank'=>'platinum'],
                                5 => ['direct' => 30,'level'=>7500,'reward'=>'30000','capping'=>15000,'rank'=>'ruby'],
                                6 => ['direct' => 50,'level'=>30000,'reward'=>'100000','capping'=>25000,'rank'=>'diamond'],
                                7 => ['direct' => 75,'level'=>60000,'reward'=>'500000','capping'=>50000,'rank'=>'crown'],
                                8 => ['direct' => 100,'level'=>100000,'reward'=>'1000000','capping'=>100000,'rank'=>'kohinoor']
                            ];
                        ?>
                        <!-- BEGIN col-6 -->
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                    <th>Rank</th>
                                    <th>Direct</th>
                                    <th>Level Team</th>
                                    <th>Pending Team</th>
                                    <th>Reward</th>
                                    <th>Capping</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($reward as $key => $rw) {
                                    //    $paidTeam= $this->User_model->calculateLevelTeam($this->session->userdata['user_id'],1,$record['level']);
                                    //     $freeTeam = $this->User_model->calculateLevelTeam($this->session->userdata['user_id'],0,$record['level']);
                                    ?>
                                    <tr>
                                        <td><?php echo ($key) ?></td>
                                        <td><?php echo $rw['rank']; ?></td>
                                        <td><?php echo $rw['direct']; ?></td>
                                        <td><?php echo $rw['level']; ?></td>
                                        <td><?php echo $rw['level']; ?></td>
                                        <td><?php echo $rw['reward']; ?></td>
                                        <td><?php echo $rw['capping']; ?></td>
                                        <td><?php echo 'pending'; ?></td>
                                        
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
