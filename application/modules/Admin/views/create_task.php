<?php include'header.php' ?>
<div class="content-wrapper">
     <div class="main-content">
      <div class="page-content">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Task</li>
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
                        <label class="text-danger"><?php // echo form_error('link');?></label>
                    </div> -->

                    <!-- <div class="form-group" id="image">
                        <label>Uplaod Image</label>
                        <input type="file" name="img" class="form-control" value="<?php echo set_value('link')?>" placeholder="Paste Link Here"/>
                        <label class="text-danger"><?php echo form_error('link');?></label>
                    </div> -->
                    <div class="form-group" id="youtube" style="display:block;">
                        <label>Site Link</label>
                        <input type="text" name="youtube" class="form-control" value="<?php echo set_value('link')?>" placeholder="Enter Site Link"/>
                        <label class="text-danger"><?php echo form_error('link');?></label>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" onchange="selectType(this)" name="type">
                        <option value="site">Site Link</option>
                          <!-- <option value="image">Image</option> -->
                        </select>
                    </div>

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
</script>