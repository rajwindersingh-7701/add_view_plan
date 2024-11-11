<?php include_once'header.php'; ?>
<style>
#wrapper{
      width: 100%;
    position: relative;
}
</style>
<div class="page-content main-content">
  <div class="container-fluid">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title">Beneficiary List</h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Beneficiary List</li>
       </ol>
   </div>

   </div>

  <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Beneficiary List</div>
         <hr>
         <div class="col-md-12">
                <h3><?php echo $this->session->flashdata('message');?></h3>
                    <div id="some_div"></div>
                    <?php
                foreach($beneficiary as $ben){
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $ben['beneficiary_name'];?></h4>
                            <p class="card-text">
                                Account Number : <?php echo $ben['beneficiary_account_no'];?> <br>
                                IFSC Code : <?php echo $ben['beneficiary_ifsc'];?><br>
                                Bank : <?php echo $ben['beneficiary_bank'];?><br>
                                Bank Branch : <?php echo $ben['beneficiary_branch'];?> <br>
                                Benficiary ID : <?php echo $ben['account_ifsc'];?>
                            </p>
                            <a
                                href="<?php echo base_url('Dashboard/SecureWithdraw/withdrawAmount/'.$ben['account_ifsc']);?>">Send
                                Money</a>
                        </div>
                    </div>

                    <?php
                }
                if(empty($beneficiary)){
                    echo '<h4>Click here for Add new Beneficiary <a href="'.base_url('Dashboard/SecureWithdraw/addBeneficiary').'"> Click here</a></h4>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once'footer.php'; ?>