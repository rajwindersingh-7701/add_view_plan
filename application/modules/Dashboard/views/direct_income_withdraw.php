<?php 
    include_once 'header.php'; 
    date_default_timezone_set('Asia/Kolkata');
?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
@media (max-width:375px) {
    .card-body {
    overflow: scroll;
    margin-right: 10px;
}
}
</style>
<div class="main-content">
  <div class="page-content">
<div class="page-header">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
  <section class="content-header">
        <span style=""><?php echo $title; ?> </span>
    </section>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
          <div class="card-body">
      <h3 class="page-header">

        <small><?php //echo $des; ?></small>
    </h3>
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
                        <div class="col-md-6">
                            <?php 
                            $d_none = 1;
                                if($d_none > 0){
                             if (date('D') == "Sat" ) {
                                echo 'Time: '.date('h:i').'<br>';
                                // echo date('h:i:s a m/d/Y');
                                // if(date('H:i') >= '07:00' && date('H:i') <= '10:00' && date('D') != "Sun"){ 
                                    // if($user['upgrade_package'] > 0){
                                    //     $package = $user['upgrade_package'];
                                    // }else{
                                    //     $package = $user['package_amount'];
                                    // }
                                    // if($package > 100){
                            ?>
                            <div class="form-group">
                                <label style="font-size:20px; color:red">Available balance (<?php echo currency .''.number_format($balance['balance'],2);?>)</label><br>
                            </div>
                            <?php //if(withdraw_button == 1){ 

                                //if($directs['ids'] >=2){ ?>
                            <?php echo form_open('',array('id' => 'TopUpForm'));?>
                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            
                            <div class="form-group" style="display:none">
                                <label>Net Amount</label>
                                <span class="text-success" id="netAmount"></span>
                            </div>
                            <div class="form-group" style="display:none">
                                <label>100% E-wallet Transfer</label><br>
                                <!-- <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="1" checked>Yes &nbsp; -->
                                <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="0" checked >No
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Transfer Amount to Topup-wallet</label>
                                <?php echo currency ?><span class="text-success" id="bankAmount"></span>
                            </div>
                            <!-- <div class="form-group">
                                <label>TDS Charges 5%</label>
                                <span class="text-success" id="tds"></span>
                            </div> -->
                            <div class="form-group">
                                <label>Transaction Pin</label>
                                <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                                <span class="text-danger"><?php echo form_error('master_key')?></span>
                            </div>
                                <!-- <div class="form-group">
                                                    <label>OTP</label>
                                                    <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                                        value="" />
                                                    <span class="text-danger"><?php //echo form_error('otp') ?></span>
                                                    <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                                                </div>
                            <div class="form-group"> -->
                                <button type="subimt" name="save" class="btn btn-success" />Withdrawal Now</button>
                            </div>
                            <?php echo form_close();?>
                            <?php
                                // }else{
                                //     echo '<span class="btn-danger" >2 Directs Required </span>';
                                // }
                                }else{
                                    echo '<span class="badge badge-danger">Withdrawal Only  Saturday  !</span>';
                                }
                                // }else{
                                //     echo '<span class="badge badge-danger">This package is not elgible for Withdraw!</span>';
                                // } 
                            // }else{
                            //     echo '<span class="badge badge-danger">Withdraw Timing between 7AM to 11AM on Tuesday!</span>';
                            // }
                        }else{
                                echo '<span class="btn-danger" >Please wait we are working on it...</span>';
                            } 
                            ?>
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
    <!-- END wizard -->
</div>
</div>
</div>
</div>

<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }

    $(document).on('click','#otp',function(){
    var url = '<?php echo base_url('Dashboard/SecureWithdraw/getOtp');?>'
    $.get(url,function(res){
        if(res.status == 1){
            $("#otp").css("display", "none");
            alert('OTP send to registered mobile number');
        }else{
            alert('Network error,please try later');
        }
    },'JSON')
})

</script>
