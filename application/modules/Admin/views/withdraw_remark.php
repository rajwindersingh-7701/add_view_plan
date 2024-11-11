<?php include_once'header.php'; ?>
  <div class="main-content">
      <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Submit Remark</span>
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
            <?php echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
          
            <div class="form-group">
                <label>Remark</label>
                <input type="text" class="form-control" name="remark" placeholder="Remark" value="<?php echo $remark['remark'];?>"/>
                <span class="text-danger"><?php echo form_error('remark')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once'footer.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Add Remark On This Account?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>