<?php include_once'header.php'; ?>
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
            <span>Activate your Account</span>
        </section>

    </div>


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
                                   <div class="card-body">
      <h4 class="page-header">
        <span style=""> Account Activation | Available Pins (<?php echo $available_pins['available_pins']; ?>)</span><br>


    </h4>

        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

        <div class="wizard-content tab-content">
            <!-- BEGIN tab-pane -->
            <div class="tab-pane active show" id="tabFundRequestForm">

            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Choose Package</label>
                <select class="form-control" name="package_id">
                    <?php
                    foreach($packages as $key => $package){
                        echo'<option value="'.$package['id'].'">'.$package['title'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo set_value('user_id'); ?>" placeholder="User ID" style="max-width: 400px"/>
                <span class="text-danger" id="errorMessage"><?php echo form_error('user_id') ?></span>
            </div>
            <div class="form-group">
                <label>Epin</label>
                <input type="text" class="form-control" name="epin" value="<?php echo $epin; ?>" placeholder="Epin" style="max-width: 400px"/>
                <span class="text-danger"><?php echo form_error('epin') ?></span>
            </div>
          <!--   <div class="form-group">
                <label class="">Txn Pin<span style="color:red">(Don't have Txn Password <a href="<?php //echo base_url('Dashboard/forgot_password'); ?>">Reset Now</a>)</span></label>
                <?php
                   // echo form_input(['type' => 'password', 'name' => 'master_key', 'class' => 'form-control' ,'placeholder' => 'Txn Pin']);
                ?>
                <span class="text-danger"><?php echo form_error('master_key') ?></span>
            </div> -->

            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Activate</button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur', '#user_id', function () {
        var user_id = $('#user_id').val();
        if (user_id != '') {
            var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
            $.get(url, function (res) {
                $('#errorMessage').html(res);
            })
        }
    })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Topup This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
