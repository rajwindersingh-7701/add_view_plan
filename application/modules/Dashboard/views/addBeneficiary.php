<?php include_once'header.php'; ?>
<style>
@media only screen and (max-width: 1024px){
.footer {
    position: relative;
    left: 0px;
}
}
</style>

<div class="page-content main-content">
  <div class="container-fluid">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title">Add Beneficiary</h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Beneficiary</li>
       </ol>
   </div>

   </div>
    <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Add Beneficiary</div>
         <hr>
         <div class="col-md-12">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php 
            // if($status == 0){
            // if($user['netbanking'] == 1){                
                echo form_open('', array('id' => 'TopUpForm')); 
            ?>
             <div class="form-group">
                <label>Beneficiary Bank Name :</label>
                <input type="text" class="form-control" name="beneficiary_bank" value="<?php echo set_value('beneficiary_bank'); ?>"
                    placeholder="Beneficiary Bank Name." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_bank') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Account No. :</label>
                <input type="text" class="form-control" name="beneficiary_account_no" value="<?php echo set_value('beneficiary_account_no'); ?>"
                    placeholder="Beneficiary Bank Account No." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_account_no') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank IFSC :</label>
                <input type="text" class="form-control" name="beneficiary_ifsc" value="<?php echo set_value('beneficiary_ifsc'); ?>"
                    placeholder="Beneficiary Bank IFSC" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_ifsc') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Account Holder Name :</label>
                <input type="text" class="form-control" name="beneficiary_name" value="<?php echo set_value('beneficiary_name'); ?>"
                    placeholder="Beneficiary  Account Holder Name :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Branch :</label>
                <input type="text" class="form-control" name="beneficiary_branch" value="<?php echo set_value('beneficiary_branch'); ?>"
                    placeholder="Beneficiary Bank Branch" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_branch') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Mobile No. :</label>
                <input type="text" class="form-control" name="beneficiary_mobile" value="<?php echo $user['phone']; ?>"
                    placeholder="Beneficiary  Mobile No" style="max-width: 400px" readonly />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>

            <div class="form-group" id="block1" style="display: none;">
                <label>OTP :</label>
                <input type="text" class="form-control" name="verification_otp" value="<?php //echo set_value('verification_otp'); ?>"
                    placeholder="Enter OTP" style="max-width: 400px" />
                <span class="text-danger"><?php //echo form_error('verification_otp') ?></span>
            </div>

            <div class="form-group" id="block3">
                <button type="button" onclick="getOtp()" id="get_otp" name="save" class="btn btn-success" />GET OTP</button>
            </div>

            <div class="form-group" id="block2" >
                <button type="subimt" name="save" class="btn btn-success" />Add</button>
            </div>
            <?php echo form_close(); 
            // }else{
            //     echo 'Two Beneficiary already added!';
            // }
            
            ?>

        </div>
    </div>
</div>
</div></div></div></div></div>
<?php include_once'footer.php'; ?>

<script>
     function getOtp(){
    fetch("<?php echo base_url('Dashboard/SecureWithdraw/getOtp') ?>", {
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
              alert('Sorry Please Try Again Later!');
            }
        });
  }

</script>