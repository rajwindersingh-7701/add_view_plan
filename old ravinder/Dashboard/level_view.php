<?php
require_once("header.php");
$user = $_SESSION["user"];
$userId = $user["id"];
$userId = $user["user_id"];

$checkdate = date("Y-m-d") . ' 00:00:01';

?>
<style>
   
    .col25p {
        width: 25% !important;
        max-width: 25% !important;
        float: left;
    }
    /*@media only screen and (max-width: 765px) {*/

    /*}*/
</style>
<!-- Container Panel  -->
<div class="col-lg-9">
    <h2 class="admin-heading bg-offwhite">Total Team</h2>
    <!-- Filter -->
    <!-- Filter End -->
    <!-- All Transactions  -->
    <div class="profile-content">
        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col col25p" ><span class="">level</span></div>
                    <div class="col col25p" ><span class="">Total team</span></div>
                    <div class="col col25p">Active Team</div>
                    <div class="col col25p">Level Income</div>
                    <div class="col col25p">Today Income</div>
                </div>
            </div>
        </div>
        <!-- Admin Heading Title End -->

        <!-- Transaction List -->
        <div class="transaction-area">

            <?php
            
            for($i=1;$i<9;$i++){
          
              
                $levelquery = mysqli_query($db, "SELECT count(*) as cnt FROM `level_downline` WHERE sponser_by='".$userData['user_id']."' and level='$i'");
                $levelData = mysqli_fetch_array($levelquery);
                $levelaquery = mysqli_query($db, "SELECT count(*) as cnt FROM `level_downline` WHERE sponser_by='".$userData['user_id']."' and level='$i' and package!='free'");
                $levelaData = mysqli_fetch_array($levelaquery);
                
                $walletQuery = mysqli_query($db, "SELECT sum(amount) as amt FROM `wallet` WHERE username='".$userData['user_id']."' and transaction_type='level_ad' and level='$i'");
                $walletDdd= mysqli_fetch_array($walletQuery);
                  
                $walletQuerya = mysqli_query($db, "SELECT sum(amount) as amt FROM `wallet` WHERE username='".$userData['user_id']."' and transaction_type='level_ad' and level='$i' and datetime>'$checkdate'");
                $walletDddd= mysqli_fetch_array($walletQuerya);
                ?>
                <div class="items">
                  
                        <div class="row">
                            <div class="col col25p" >
                                <span class="name"> <?php echo $i; ?></span>
                            </div>
                            <div class="col col25p">
                                <span class="name"> 
                                    
                                    <?php echo $levelData['cnt']; ?>  
                                    <br>
                                    <a href="refer_team_view.php?lvv=<?php echo $i; ?>"><i><u>Click here</u></i></a>
                                </span>
                                
                            </div>
                             <div class="col col25p">
                                <span class="name"><?php echo $levelaData['cnt']; ?></span>  <br>
                                <a href="refer_team_view_active.php?lvv=<?php echo $i; ?>"><i><u>Click here</u></i></a>
                            </div>
                            <div class="col col25p" >
                                <span class="payment-amaount"><?php echo $walletDdd['amt']; ?></span>
                            </div>
                              <div class="col col25p" >
                                <span class="payment-amaount"><?php echo $walletDddd['amt']; ?></span>
                            </div>
                        </div>
                   
                </div>
            <?php } ?>



        </div>
    </div>
   

    <!-- Paginations end -->

</div>
<!-- All Transactions End -->
</div>
<!-- Middle End -->
</div>
</div>
</div>
<!-- Content end -->

<!-- Call to action section end -->
<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>