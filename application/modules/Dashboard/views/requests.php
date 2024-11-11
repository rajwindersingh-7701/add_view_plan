<?php include'header.php' ?>
<div class="main-content">
<div class="page-content">
<section>
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <section class="content-header">
        <span style="">Wallet Request List /  Fund Request List</span>
    </section>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
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
                            <!-- <p class="desc m-b-20" style="margin-top:20px;font-size: 18px;">Make sure to use a valid input, you'll need to verify it before you can submit request.</p> -->
                            <div class="form-group m-b-10">

                            </div>
                            <div class="form-group m-b-10">
                               <div class="box box-solid bg-black">
                             
                               <div class="box-body">
                              <div class="table-responsive">
                              <table class="table table-bordered table-striped dataTable" id="tableView">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>User ID</th>
                                          <th>Amount</th>
                                          <th>Image</th>
                                          <th>Status</th>
                                          <th>Remark</th>
                                          <th>Date</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      foreach ($requests as $key => $request) {
                                          ?>
                                          <tr>
                                              <td><?php echo ($key + 1) ?></td>
                                              <td><?php echo $request['user_id']; ?></td>
                                              <td>Rs. <?php echo $request['amount']; ?></td>
                                              <td><img src="<?php echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td>
                                              <td><?php
                                                  if ($request['status'] == 0) {
                                                      echo'<span class="btn btn-primary">Pending</span>';
                                                  } elseif ($request['status'] == 1) {
                                                      echo'<span class="btn btn-success">Approved</span>';
                                                  } elseif ($request['status'] == 2) {
                                                      echo'<span class="btn btn-danger">Rejected</span>';
                                                  }
                                                  ?></td>
                                              <td><?php echo $request['remarks']; ?></td>
                                              <td><?php echo $request['created_at']; ?></td>
                                          </tr>
                                          <?php
                                      }
                                      ?>

                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

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
  </div>
  </div>
    <!-- END wizard -->

    </section>
</div>
</div>






<?php include'footer.php' ?>
