<?php include_once'header.php'; ?>
  <div class="main-content">
      <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Create News</span>
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
                <label>News Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo set_value('title');?>" placeholder="News Title"/>
                <span class="text-danger"><?php echo form_error('title')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>News</label>
                <input type="text" class="form-control" name="news" placeholder="News" value="<?php echo set_value('news');?>"/>
                <span class="text-danger"><?php echo form_error('news')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Create</button>
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
      if (confirm('Do you want to Upload This News?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>