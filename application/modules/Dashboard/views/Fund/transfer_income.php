<?php //die(''); 
?>

<div class="main-content">
    <section class="page-content">
        <!-- BEGIN breadcrumb -->
        <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <section class="content-header">
            <spna style="">Wallet Request </spna> / Transfer Income
        </section>
      
        <!-- END page-header -->
        <!-- BEGIN wizard -->
        <div  class="card">
        <div id="rootwizard" class="card-body">
            <!-- BEGIN wizard-header -->
            <h4 class="page-header">
            Income Transfer (Rs.<?php echo ($wallet_amount['wallet_amount']> 0)? $wallet_amount['wallet_amount']:'' ?>)
            <!-- <small>You can see fund requests list and check fund request status.</small> -->
        </h4>
            <!-- END wizard-header -->
            <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">
                            <?php echo form_open(); ?>
                            <div class="row">
                                <span class="text-center">
                                    <h3><?php echo $this->session->flashdata('message'); ?></h3>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <?php
                                        echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <!-- <div class="form-group">
                                          <label>User ID:</label>
                                          <?php
                                            //   echo form_input(array('type' => 'text', 'name' => 'user_id', 'class' => 'form-control' , 'id' => 'user_id'));
                                            ?>
                                          <span class="text-danger" id="userName"></span>
                                      </div> -->
                                      <div class="form-group">
                                <label>Transaction Pin</label>
                                <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                                <span class="text-danger"><?php echo form_error('master_key')?></span>
                            </div>

                                    <!-- <div class="form-group">
                                          <label>Remark:</label>
                                          <?php
                                            echo form_input(array('type' => 'text', 'name' => 'remark', 'class' => 'form-control'));
                                            ?>
                                      </div> -->
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array('type' => 'submit', 'class' => 'btn btn-success', 'name' => 'fundbtn', 'value' => 'Transfer'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
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
<!-- </div> -->
        </div>
        <!-- END wizard -->
    </section>
</div>













<?php $this->load->view('footer'); ?>
<script>
    $(document).on('blur', '#user_id', function() {
        var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + $(this).val();
        $.get(url, function(res) {
            $('#userName').html(res)
        })
    })
</script>