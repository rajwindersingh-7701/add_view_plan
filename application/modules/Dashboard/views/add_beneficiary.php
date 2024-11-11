<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Beneficiary</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Add Beneficiary</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php
            // if($user['netbanking'] == 1){
                echo form_open('', array('id' => 'TopUpForm'));
            ?>
            <div class="form-group">
                <label>Your Bank Account No. :</label>
                <input type="text" class="form-control" name="beneficiary_account_no" value="<?php echo set_value('beneficiary_account_no'); ?>"
                    placeholder="Beneficiary Bank Account No." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_account_no') ?></span>
            </div>
            <div class="form-group">
                <label> IFSC Code :</label>
                <input type="text" class="form-control" name="beneficiary_ifsc" value="<?php echo set_value('beneficiary_ifsc'); ?>"
                    placeholder="Beneficiary Bank IFSC" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_ifsc') ?></span>
            </div>
            <div class="form-group">
                <label>Account Holder Name :</label>
                <input type="text" class="form-control" name="beneficiary_name" value="<?php echo set_value('beneficiary_name'); ?>"
                    placeholder="Beneficiary  Account Holder Name :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Add</button>
            </div>
            <?php echo form_close();
            // }else{
            //     echo'Please Activate your Banking';
            // }

            ?>
            <a style="padding:20px 40px; background:green; color:white; font-size:20px;" href="<?php echo base_url('Dashboard/Withdraw/ActivateBanking'); ?>" class="nav-link">

              Click Here to Activate Banking
            </a>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
