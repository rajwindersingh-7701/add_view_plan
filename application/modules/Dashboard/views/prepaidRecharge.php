<?php include_once 'header.php'; ?>
<main>
<div class="main-content page-content pt-4">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Prepaid Recharge</h1>
                    Available Wallet (<?php echo $wallet_balance['wallet_balance']; ?>)
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Recharge Management</li>
                        <li class="breadcrumb-item active">Prepaid Recharge</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">

            <?php echo form_open(''); ?>
            <h3 class="text-success"><?php echo $this->session->flashdata('success'); ?></h3>
            <h3 class="text-danger"><?php echo $this->session->flashdata('error'); ?></h3>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Enter Phone Number" style="max-width: 400px" maxlength="10">
                <span class="text-danger" id="errorMessage"><?php echo form_error('mobile') ?></span>
            </div>
            <div class="form-group">
                <label>Choose Opreator</label>
                <select class="form-control" name="opreator" style="max-width: 400px">
                    <?php
                    foreach($opreators as $key => $opreator){
                        echo'<option value="'.$opreator['opreator'].'">'.$opreator['opreator_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount" style="max-width: 400px"/>
                <span class="text-danger" id="errorMessage"><?php echo form_error('amount') ?></span>
            </div>
            <div class="form-group">
                <label class="">Txn Pin<span style="color:red">(Don't have Txn Password <a href="<?php echo base_url('Dashboard/forgot_password'); ?>">Reset Now</a>)</span></label>
                 <input type="password" class="form-control" name="master_key" value="<?php echo set_value('master_key'); ?>" placeholder="Txn Pin" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('master_key') ?></span>
            </div>

            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success">Recharge Now</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
</main>
<?php include_once 'footer.php'; ?>
<script>
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Recharge This Number')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
