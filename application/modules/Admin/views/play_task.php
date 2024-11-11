<?php include'header.php' ?>
<div class="content-wrapper">
     <div class="main-content">
      <div class="page-content">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Play Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Play Task</li>
            </ol>
          </div><!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open_multipart();?>
                    <!-- <div class="form-group">
                        <label>Link</label>
                        <input type="text" name="link" class="form-control" value="<?php echo set_value('link')?>" placeholder="Paste Link Here"/>
                        <label class="text-danger"><?php// echo form_error('link');?></label>
                    </div> -->

                    <div class="form-group" id="image">
                    <label>User ID</label>
                    <input type="text" class="form-control" name="user_id" value="<?php echo set_value('user_id');?>" id="user_id" placeholder="User ID"/>
                    <span class="text-danger"><?php echo form_error('user_id')?></span>
                    <span id="errorMessage"></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Play</button>
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
  function selectType(type){
    if(type.value == 'youtube'){
      document.getElementById("image").style.display = "none";
      document.getElementById("youtube").style.display = "block"; 
    }
    if(type.value == 'image'){
      document.getElementById("image").style.display = "block";
      document.getElementById("youtube").style.display = "none"; 
    }
  }

  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
</script>