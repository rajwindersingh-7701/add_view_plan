<?php include'header.php' ?>
<div class="main-content">
      <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header; ?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/'); ?>"><?php echo $header; ?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
  
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                    <?php echo form_open();?>
                        <div class="form-group">
                            <label>User Id</label>
                            <input type="text" id="userId" name="user_id" class="form-control" value="<?php echo set_value('user_id')?>" placeholder="User ID"/>
                            <label class="text-danger" id="UserName"><?php echo form_error('user_id');?></label>
                        </div>
                        <div class="form-group">
                            <label>Pin Amount</label>
                            <select class="form-control" name="pin_amount">
                                <?php 
                                foreach($packages as $key => $package)
                                    echo'<option value="'.$package['price'].'">'.$package['price'].'</option>';
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('pin_amount');?></span>
                        </div>
                        <div class="form-group">
                            <label>No. of Epins</label>
                            <input type="number" name="pin_count" class="form-control" value="<?php echo set_value('epins')?>"/>
                            <label class="text-danger"><?php echo form_error('pin_count');?></label>
                        </div>
                        <div class="form-group">
                            <label>Txn Pin</label>
                            <input type="number" name="master_key" class="form-control" value="<?php echo set_value('master_key')?>"/>
                            <label class="text-danger"><?php echo form_error('master_key');?></label>
                        </div>
                        <!-- <div class="form-group">
                          <label>OTP</label>
                          <input type="password" class="form-control" name="otp" placeholder="Enter OTP" value="" required="">
                          <span class="text-danger"><?php //echo form_error('otp')?></span><br>
                          <a href="<?php //echo base_url('Admin/Settings/adminLoginOtp')?>" class="btn btn-success btn-sm">Get OTP</a>
                        </div> -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success pull-right">Create</button>
                        </div>
                    <?php echo form_close();?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>
<script>
    $(document).on('blur','#userId',function (res){
        var user_id = $(this).val();
        var url = '<?php echo base_url("Dashboard/User/get_user/")?>' + user_id;
        $.get(url , function(res){
            $('#UserName').html(res)
        })
    })
</script>