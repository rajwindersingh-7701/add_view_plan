<?php include_once 'header.php'; ?>
  <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class=""><?php echo $header;?></span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $header;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <div>
        <div class="row">
          <div class="col-md-12 card">
            <div class="card-body">
          <div class="col-md-6">
            <?php 
                echo $this->session->flashdata('message');
                echo form_open('',array('id' => 'walletForm'));
                echo $form;
                echo form_close();
            ?>
          </div>
        </div>
      </div>
       </div>
      </div>
    </div>
  </div>
    </div>
<?php include_once 'footer.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
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