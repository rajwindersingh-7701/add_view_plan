<?php require_once "header.php"; 
$query1p = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='".$userData['id']."' and type='national_id'");
$kycDatan = mysqli_fetch_array($query1p);
$query1n = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='".$userData['id']."' and type='photo_id'");
$kycDatap = mysqli_fetch_array($query1n);
$query1n1 = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='".$userData['id']."' and type='photo_id1'");
$kycDatap1 = mysqli_fetch_array($query1n1);
$query1pp = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='".$userData['id']."' and type='user_pic'");
$kycDatapp = mysqli_fetch_array($query1pp);
$query1ppp = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='".$userData['id']."' and type='photo'");
$kycDatappPhoto = mysqli_fetch_array($query1ppp);

$query1pp21 = mysqli_query($db, "SELECT * FROM `bankDetail` WHERE userId='".$userData['id']."'");
$bankDetail = mysqli_fetch_array($query1pp21);
$query1pp3 = mysqli_query($db, "SELECT * FROM `user` WHERE id='".$userData['id']."'");
$userData = mysqli_fetch_array($query1pp3);
?>

<style>
    p#response-msg {
        background: red;
        text-align: center;
        color: #fff;
        font-size: 17px;
        font-weight: bold;
    }
    p#response-msg.true {
        background: green;
    }
    section.content-header>h1 {
    color: #000;
}
.box-header.with-border>h3 {
    color: #000;
}
</style>
 <div class="col-lg-12">
    
    <div class='task-portion'>

        </div>
    
    <div class="profile-content">
        <div class="row">
       
      <div class="col-md-12">

		
		<div class="box-body padding" style="background:#FFFFFF; margin-top:-4%">
      
                   <form id="" action="controller/function.php" method="post" enctype="multipart/form-data">
                         <div class="col-md-6">
                            <?php if (isset($_SESSION["kyc"])) if ($_SESSION["kyc"]["status"] == false) echo "<p  class='false' id='response-msg' >" . $_SESSION['kyc']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["kyc"])) if ($_SESSION["kyc"]["status"] == true) echo "<p id='response-msg' class='true'>" . $_SESSION['kyc']['msg'] . "</p>";unset($_SESSION["kyc"]); ?> 
                                            <p id="response-msg-bitcoin" style="color:#000;"></p>
                                            <fieldset>
                                                <h1> Financial Information.</h1>
                                                <div class="control-group">
                                                    <label class="control-label">Bank Name</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="bankname"  type="text" maxlength="50" value="<?php echo $bankDetail["bankName"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Account Holder Name</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="holdername"  type="text" maxlength="50" value="<?php echo $bankDetail["accountName"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">IFSC Code</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="ifsc" required="" type="text" maxlength="50" value="<?php echo $bankDetail["Ifsc"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Account Number</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="accountnumber" type="text" maxlength="50" value="<?php echo $bankDetail["accountNumber"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Bank Branch</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="branch" type="text" maxlength="50" value="<?php echo $bankDetail["branch"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Pan Number</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="pan" type="text" maxlength="50" value="<?php echo $bankDetail["pan"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Nominee name</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="nname" type="text" maxlength="50" value="<?php echo $bankDetail["nname"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Nominee Relation</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="nrelation" type="text" maxlength="50" value="<?php echo $bankDetail["nrelation"] ?>">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            
                                            <fieldset>
                                                <h1> Documents.</h1>
                                               <?php  $kyc == 0;
                                                        if($kycDatap['status']=='done'){ 
                                                            $kyc = 1;
                                                            echo "<h3 style='color:green;'>NOTE:- KYC STATUS CONFIRMED</h3>";
                                                        }else if($kycDatap['status']=='pending'){
                                                            $kyc = 1;
                                                            echo "<h3 style='color:orange;'>NOTE:- KYC STATUS PENDING</h3>";
                                                        }else if($kycDatap['status']=='reject'){
                                                            echo "<h3 style='color:red;'>NOTE:- LAST KYC STATUS REJECTED</h3>";
                                                        }else {
                                                            echo "<h3 style='color:blue;'>NOTE:- Please upload your require document.</h3>";
                                                        } 
                                                        ?>

                                                <div class="control-group col-lg-6">
                                                    <label class="control-label">Pan card</label>
                                                    <div class="controls">
                                                        <?php // if($kyc==0){ ?>
                                                        <input  name="national_id"  type="file" value="">
                                                        <?php // } ?>
                                                        <img src="uploads/kyc/<?php echo $kycDatan['image_name'];?>" onerror="this.src='gal.png';" alt="005" title="005" style="
    width: 100px;
">  
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group col-lg-6">
                                                        <label class="control-label">Id Proof (Adhar Front)</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="photo_id1"  type="file" value="">
                                                        <img src="uploads/kyc/<?php echo $kycDatap1['image_name'];?>" onerror="this.src='gal.png';" alt="005" title="005" style="
    width: 100px;
">  
                                                    </div>
                                                </div>
                                                <div class="control-group col-lg-6">
                                                    <label class="control-label">Address Proof (Adhar Back)</label>
                                                    <div class="controls">
                                                          <?php // if($kyc==0){ ?>
                                                        <input class="form-control" name="photo_id"  type="file" value="">
                                                          <?php // } ?>
                                                        <img src="uploads/kyc/<?php echo $kycDatap['image_name'];?>" onerror="this.src='gal.png';" alt="005" title="005" style="
    width: 100px;
">  
                                                    </div>
                                                </div>
                                                <div class="control-group col-lg-6">
                                                        <label class="control-label">Bank Proof</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="user_pic"  type="file" value="">
                                                        <img src="uploads/kyc/<?php echo $kycDatapp['image_name'];?>" onerror="this.src='gal.png';" alt="005" title="005" style="
    width: 100px;
">  
                                                    </div>
                                                </div>
                                                <div class="control-group col-lg-6">
                                                        <label class="control-label">Photo</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="photo"  type="file" value="">
                                                        <img src="uploads/kyc/<?php echo $kycDatappPhoto['image_name'];?>" onerror="this.src='gal.png';" alt="005" title="005" style="
    width: 100px;
">  
                                                    </div>
                                                </div>


                                    


                                            </fieldset>
                                             </div>
                          <div class="col-md-6">
                                <fieldset>
                                    
                                   <h1> Personal Information.</h1>
                                    <div style='clear:both;height: 25px;'></div>
                              <div class="control-group">
                                                    <label class="control-label">Name</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="name"  type="text" maxlength="50" value="<?php echo $userData["name"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Father Name</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="father_name"  type="text" maxlength="50" value="<?php echo $userData["father_name"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Address</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="address" required="" type="text" maxlength="50" value="<?php echo $userData["address"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Adhar No.</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="adhar" type="text" maxlength="50" value="<?php echo $userData["adhar"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Mobile</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="mobile" type="text" maxlength="50" value="<?php echo $userData["phone"] ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">Email</label>
                                                    <div class="controls">
                                                        <input class="form-control" name="email" type="text" maxlength="50" value="<?php echo $userData["email"] ?>">
                                                    </div>
                                                </div>
                                                
                                        </fieldset>
                          </div>
                       
                          <div class="col-md-12">
                                          <div class="form-actions no-margin">

                                                    <button type="submit" name="kyc" class="btn btn-primary accountdata">Submit</button>
                                                    <button type="button" class="btn">Cancel</button>
                                                </div>
                          </div>
                       
                                        </form>
		</div>
 


	</div>
    
        <!-- Left col -->
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  </div>
<!-- Recent Activity End -->
</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
  <!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
    <script>
        jQuery( ".treeview-menu" ).hide();
        jQuery( ".treeview" ).removeClass( "active" );
        
        jQuery( ".menu1>ul" ).show();
        jQuery( ".menu1" ).addClass( "active" );
        
    </script>
    <style>
    div#preloader {
    display: none;
}
</style>
 <?php include "footer.php" ?>