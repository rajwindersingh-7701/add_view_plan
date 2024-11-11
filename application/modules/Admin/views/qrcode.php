<?php include_once'header.php'; ?>
 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">QR Code Update</span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
              <li class="breadcrumb-item">QR Code</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    
        <div class="card">
          <div class="card-body">
        <div class="row">

          <div class="col-md-6">
          <?php echo $this->session->flashdata('error');?>
            <?php echo form_open_multipart('',array('id' => ''));?>
            <h3 class="text-danger"><?php if(!empty($error)) {echo $error;}  ?></h3>
            <div class="form-group">
                <label>UPI Id</label>
                <input type="text" class="form-control" name="upi_id" value="<?php echo $qrcode['upi_id'] ? $qrcode['upi_id']: '';?>" id="" placeholder="UPI Id"/>
                <span class="text-danger"><?php echo form_error('upi_id')?></span>
                <!-- <span id="errorMessage"></span> -->
            </div>
            <div class="form-group" id="">
                <label>Bar Code</label>
                <?php echo form_input(array('class' => 'form-control', 'type' => 'file', 'name' => 'qrcode'));?>
                <span class="text-danger"><?php echo form_error('media')?></span>
            </div>
            <div class="form-group" id="">
                <label></label>
                <img src="<?php echo base_url('uploads/'.$qrcode['image'])?>"/>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Update</button>
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
  $(document).on('change','#selectType',function(){
        $('#imageField').toggle();
        $('#videoField').toggle();
  })
</script>
