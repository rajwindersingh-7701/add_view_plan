<?php include_once'header.php'; ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daily  Installment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Daily Installment</li>
                        <li class="breadcrumb-item active">Daily Installment </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">

            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Installment Amount</label>
                <select class="form-control" name="package_id">
                    <?php
                    foreach($packages as $key => $package){
                        echo'<option value="'.$package['roi_amount'].'">'.$package['title'].'</option>';
                    }
                    ?>
                </select>
            </div>
          
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
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