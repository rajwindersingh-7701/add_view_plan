<?php include'header.php' ?>
<div class=" main-content">
    <div class="page-content" style="padding: 0px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Withdraw Money</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Withdraw Money</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php 
                    echo '<h5>'.$withdraw.'</h5>';
                ?>
            </div>
            <div class="row">
                <?php 
                    echo '<div class="form-group">
                            <label style="font-size:20px; color:red">Available balance ('.$balance['balance'].')</label>
                        </div>';
                ?>
            </div>
            <div>
                <?php

                 echo '<span class="text-danger">'.$this->session->flashdata('message').'</span>';
                ?>
            </div>
            <div class="row">
                <?php
                    echo '<div><p>'.$date = date('H:i').'</p><div>';
                    // if(date('D') != 'Sun'){
                        if($total_directs['total_directs'] >= 2){
                        if(withdraw_button == 1){
                            if($user['package_amount'] > 100){
                                // if($user['withdraw_status'] == 0){
                                    //if($directs['ids'] >= 2){
                                    // if(($date >= '10:00' && $date <= '23:00')){
                                        echo form_open('',array('id' => 'TopUpForm'));?>
                <div class="form-group">
                    <label>Benficiary ID</label>
                    <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID"
                        value="<?php echo $beneficiary_id;?>" />
                    <span class="text-danger"><?php echo form_error('beneficiary_id')?></span>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();"
                        placeholder="Amount" value="<?php echo set_value('amount');?>" />
                    <span class="text-danger"><?php echo form_error('amount')?></span>
                </div>
                <!--  <div class="form-group">
                                                <label>Transaction Pin</label>
                                                <input type="password" class="form-control" name="master_key" placeholder="Master Key"
                                                    value="" />
                                                <span class="text-danger"><?php echo form_error('master_key')?></span>
                                            </div> -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password" value="" />
                    <span class="text-danger"><?php echo form_error('password')?></span>
                </div>
                <!--  <div class="form-group">
                                                    <label>OTP</label>
                                                    <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                                        value="" />
                                                    <span class="text-danger"><?php //echo form_error('otp') ?></span>
                                                    <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                                                </div> -->
                <div class="form-group">
                    <button type="subimt" name="save" class="btn btn-success" />Withdraw Now</button>
                </div>
                <?php echo form_close();
                                        // }else{
                                        //     echo '<span class="text-danger">Withdraw Open 10:00AM to 04:00PM</span>';
                                        // }
                                    // }else{
                                    //     echo '<span class="text-danger">Two Directs Required for Withdraw!<br>  </span>';
                                    // }
                                // }else{
                                //     echo '<span class="text-danger">Withdraw closed!<br>  </span>';
                                // }
                            }else{
                                echo '<span class="text-danger">This Package is not eligible for Withdraw!</span>';
                            }
                        }else{
                            echo '<span class="text-danger">Withdraw closed!</span>';
                        }
                    }else{
                        echo '<div class="alert alert-info">2 Directs Compulsory!</div>';
                    }
                    // }else{
                    //     echo '<span class="text-danger">Sunday Withdraw Closed!</span>';
                    // }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
<script>
$(document).on('click', '#otp', function() {
    var url = '<?php echo base_url('Dashboard/SecureWithdraw/getOtp');?>'
    $.get(url, function(res) {
        if (res.status == 1) {
            $("#otp").css("display", "none");
            alert('OTP send to registered mobile number');
        } else {
            alert('Network error,please try later');
        }
    }, 'JSON')
})
</script>