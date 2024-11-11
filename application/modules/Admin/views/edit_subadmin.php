<?php include'header.php' ?>
 <div class="main-content">
      <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
              <span class="">Edit User</span>
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
          <div class="row">
          
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Password Manager
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>User ID</label>
                         <input type="text" name="user_id" class="form-control" value="<?php echo $user['user_id'];?>" readonly/>
                        <label class="text-danger"><?php echo form_error('user_id');?></label>
                    </div>
                    <div class="form-group">
                        <label>New Passowrd</label>
                         <input type="text" name="password" class="form-control" value="<?php  //echo $user['password'];?>"/>
                        <label class="text-danger"><?php echo form_error('password');?></label>                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>