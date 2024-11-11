<?php include_once'header.php'; ?>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
  
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
            <?php 
            // echo $display;
              if($displays == 'franchise'):
            echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>User Id</label>
                <input type="text" id="userId" name="user_id" class="form-control" value="<?php echo set_value('user_id')?>" placeholder="User ID"/>
                <label class="text-danger" id="UserName"><?php echo form_error('user_id');?></label>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text"  name="name" class="form-control" value="<?php echo set_value('name')?>" placeholder=" EnterName"/>
                <label class="text-danger"id="UserName" ><?php echo form_error('name');?></label>
            </div>
            <div class="form-group">
                <label>Mobile No.</label>
                <input type="number"  name="phone" class="form-control" value="<?php echo set_value('phone')?>" placeholder="Enter Mobile No."/>
                <label class="text-danger"id="UserName" ><?php echo form_error('phone');?></label>
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text"  name="city" class="form-control" value="<?php echo set_value('city')?>" placeholder="Enter City"/>
                <label class="text-danger" id="UserName"><?php echo form_error('city');?></label>
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" id="" name="state" class="form-control" value="<?php echo set_value('state')?>" placeholder="Enter State"/>
                <label class="text-danger" id="UserName"><?php echo form_error('state');?></label>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Create</button>
            </div>
            <?php echo form_close();
            endif;
            ?>

            <?php 
            if($displays == 'number'):
            echo form_open('',array('id' => ''));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>First Number</label>
                <input type="text" id="" name="phone1" class="form-control" value="<?php  if(!empty($site['phone1'])){ echo $site['phone1']; } ?>" placeholder="Enter Phone NO."/>
                <label class="text-danger" id=""><?php echo form_error('phone1');?></label>
            </div>
            <div class="form-group">
                <label>Second Number</label>
                <input type="text"  name="phone2" class="form-control" value="<?php  if(!empty($site['phone2'])){ echo $site['phone2'];} ?>" placeholder=" Enter Phone NO."/>
                <label class="text-danger"id="UserName" ><?php echo form_error('phone2');?></label>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Update</button>
            </div>
            <?php echo form_close();
            endif;

            ?>
          </div>
        </div>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur','#userId',function (res){
        var user_id = $(this).val();
        var url = '<?php echo base_url("Dashboard/User/get_user/")?>' + user_id;
        $.get(url , function(res){
            $('#UserName').html(res)
        })
    })

  $(document).on('submit','#walletForm',function(){
      if (confirm('Are you sure for this action?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>