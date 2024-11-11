<?php include_once'header.php'; ?>
 <style>
   label {
    display: inline-block;
    margin-bottom: .5rem;
    padding-top: 18px;
    font-size: 18px;
}
.form-control {
    font-size: 18px;
}
.br-box {
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    padding: 0px 11px;
}
 </style>


 <div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Site Settings</span>
            
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
              <li class="breadcrumb-item">Site Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    
        <div class="card">
          <div class="card-body">
        <div class="row">

          <div class="col-md-12">
          <h3 class="text-danger"><?php echo $this->session->flashdata('message');?></h3>
            <?php echo form_open_multipart('',array('id' => 'walletForm'));

            // pr($info);
            // die('oop');
            ?>
            <!-- <div class="form-group"> -->
              <div class="row">
                <div class="col-xl-3 col-md-4">
                   <label>Company Name</label>
                   <input type="text" class="form-control" name="company_name" value="<?php echo $info['company_name'];?>" required=""/>
                </div>
                <div class="col-xl-3 col-md-4">   
              <label>Mobile</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $info['mobile'];?>"  />
              </div>
              <div class="col-xl-3 col-md-4">
                   <label>Email</label>
                   <input type="text" class="form-control" name="email" value="<?php echo $info['email'];?>" />
                </div>
                <!-- <div class="col-xl-3 col-md-4">   
               <label>Website</label>
                <input type="text" class="form-control" name="website" value="<?php// echo $info['website'];?>"  />
              </div> -->
         
               <!--  <div class="col-xl-3 col-md-4">
                   <label>User Name Text</label>
                   <input type="text" class="form-control" name="username" value="<?php //echo $info['username'];?>" />
                </div> -->
                          
                <div class="col-xl-3 col-md-4">
                   <label>Minimum Withdraw</label>
                   <input type="text" class="form-control" name="minimum_withdraw" value="<?php echo$info['minimum_withdraw'];?>" />
                </div>
                 <div class="col-xl-3 col-md-4">
                   <label>Maximum Withdraw</label>
                   <input type="text" class="form-control" name="maximum_withdraw" value="<?php echo$info['maximum_withdraw'];?>" />
                </div>
                 <div class="col-xl-3 col-md-4">
                   <label>Multiple Amount</label>
                   <input type="text" class="form-control" name="multiple_amount" value="<?php echo$info['multiple_amount'];?>" />
                </div>
               <!--  <div class="col-xl-3 col-md-4">   
            <label>Commission Minimum Transfer %</label>
                <input type="text" class="form-control" name="minimum_transfer" value="<?php// echo $info['minimum_transfer'];?>" />
              </div> -->
              <div class="col-xl-3 col-md-4 ">
                   <label> Admin Charge %</label>
                   <input type="text" class="form-control" name="admin_charges" value="<?php echo $info['admin_charges'];?>"/>
                </div>
              <div class="col-xl-3 col-md-4">   
             <label>TDS %</label> 
                <input type="text" class="form-control" name="tds_charges" value="<?php echo $info['tds_charges'];?>"/>
              </div>
            
                <div class="col-xl-3 col-md-4">
                   <label>Address</label>
                   <input type="text" class="form-control" name="address" value="<?php echo $info['address'];?>" />
                </div>
                
                
              <div class="col-xl-3 col-md-4">
                   <label>Popup Image</label>
                   <input type="file" class="form-control" name="image" value="<?php echo ('popup_image');?>" />
                    <?php if(!empty($info['popup_image'])):?>
                      <a target="_blank" href="<?php echo base_url('uploads/'.$info['popup_image']);?>">View</a>
                    <?php endif;?> 
              </div>
              <div class="col-xl-3 col-md-4"> 
                 <label for="off">Pop-up</label>
                 <div class="br-box">
                    <input type="checkbox"  name="popup_on" <?php echo ($info['popup'] == 1)? 'checked' : '';?>>
                     <label for="Popup" style="padding-top: 3px;position: relative;top: 1px;">ON/OFF</label>
                </div>
              </div>

                
                <div class="col-xl-3 col-md-4">
                  <label> Withdraw Button</label>
                  <div class="br-box">
                    <input type="checkbox"  name="withdraw_button" <?php echo ($info['withdraw_button'] == 1)? 'checked' : '';?>>
                    <label style="padding-top: 3px;position: relative;top: 1px;">Commision Wallet</label>
                </div>
                </div>
              <!-- <div class="col-xl-3 col-md-4 " >
                  <label> Transfer Button</label>
                  <div class="br-box">
                    <input type="checkbox"  name="transfer_button" <?php //echo ($info['transfer_button'] == 1)? 'checked' : '';?>>
                    <label style="padding-top: 3px;position: relative;top: 1px;">Commision Wallet</label>
                  </div>
              </div> -->
               
                <div class="col-xl-3 col-md-4">   
            <!-- <label>Direct Income %</label> -->
                <input type="hidden" class="form-control" name="direct_income" value="<?php echo $info['direct_income'];?>" />
              </div>
              <div class="col-xl-3 col-md-4">
                   <!-- <label>Matching Income %</label> -->
                   <input type="hidden" class="form-control" name="matching_income" value="<?php echo $info['matching_income'];?>"  />
                </div>
                <div class="col-xl-3 col-md-4">   
            <!-- <label>Overriding %</label> -->
                <input type="hidden" class="form-control" name="overriding" value="<?php echo $info['overriding'];?>" />
              </div>

                
            </div>  
             <div class="form-group mt-4">
                <button type="subimt" name="save" class="btn btn-success" />Save Changes</button>
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
