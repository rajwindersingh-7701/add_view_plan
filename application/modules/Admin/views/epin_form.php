<?php include_once'header.php'; ?>
  <div class="main-content page-content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><?php echo $header;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="">
      <div class="container-fluid">
        <div class="row">
          <div class="card card-body">
          <div class="col-md-6">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php 
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
      if (confirm('Are you sure for this action on This Account?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>
<script>
     function getOtp(){
    fetch("<?php echo base_url('Admin/Epin/getOtp') ?>", {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            },
        })
        .then(response => response.json())
        .then(result => {
            // console.log(result);
            if(result.status == '1'){
               document.getElementById("block1").style.display = "block"; 
               document.getElementById("block3").style.display = "none"; 
               document.getElementById("block2").style.display = "block";
               alert('OTP send on your registred mobile no.!'); 
            }else{
              alert('Sorry Please try again!');
            }
        });
  }

</script>