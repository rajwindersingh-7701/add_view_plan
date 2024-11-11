
<?php include_once'header.php'; ?>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid" style="display:<?php echo (in_array("Management/index", $accesshead)) ? 'block' : 'none'; ?>">


                       <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Starter Page</h1>
                </div><!-- /.col -->
                 <div class="col-sm-4">
                    <p class="m-0 text-danger">SMS Left: <?php echo sms_limit-$totalSms;?></p>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
                        <!-- end page title -->

                        <div class="row">
                            <!---<div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Withdraw/incomeLedgar');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Payout</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($total_payout,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div>-->
                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Withdraw/income/daily_roi_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Cashback Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($daily_roi_income,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Withdraw/income/direct_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Direct Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($direct_income,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Withdraw/income/level_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Level Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($level_income,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                             
                            
                             <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php //echo base_url('Admin/Withdraw/income/reward_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Reward Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php //echo currency.''.number_format($reward_income,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/03.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/matching_bonus');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Matching Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($matching_bonus,2);?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->

                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/pool_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Pool Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo currency.''.number_format($pool_income,2);?> </h4>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/single_leg');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Single Leg income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.''. number_format($single_leg,2);?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/booster_income1');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Booster income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.''. number_format($booster_income1,2);?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/booster_income2');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Double Booster income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.''. number_format($booster_income2,2);?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Withdraw/income/club_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Club income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.''. number_format($club_income,2);?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php //echo base_url('Admin/Withdraw/income/single_leg');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Upgrade income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.'0';?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--  <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php// echo base_url('Admin/Withdraw/income/single_leg');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Cashback income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.'0';?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->
                             <div class="col-xl-3 col-md-6 d-none">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php //echo base_url('Admin/Withdraw/income/single_leg');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Add View income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.'0';?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--  <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php// echo base_url('Admin/Withdraw/income/single_leg');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Upgrade Level income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php echo currency.'0';?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
 -->



                           <!--  <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="">
                                            </div>
                                             <a href="<?php //echo base_url('Admin/Withdraw/income/royalty_income');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Royalty Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total :  <?php //echo  currency.''.number_format($royalty_income,2);?> </h4>


                                        </div>

                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <a href="<?php //echo base_url('Admin/Withdraw/income/team_development');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Team Development Income</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php //echo currency.''.number_format($team_development,2);?> </h4>
                                        </div>

                                    </div>
                                </div>
                            </div> -->
                            




                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Management/users/');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Total Members</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo $total_users;?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <a href="<?php echo base_url('Admin/Management/paidUsers/');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Paid Members</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo $paid_users;?></h4>


                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Management/today_joinings/');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Today Joined Members</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo $today_joined_users;?></h4>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                             <a href="<?php echo base_url('Admin/Management/today_joinings/');?>"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">Today Paid Members</h5></a>
                                            <h4 class="font-weight-medium font-size-24">Total : <?php echo $today_paid_users;?></h4>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                                $incomes = $this->config->item('incomes');//$incomes = incomes();
                                foreach ($incomes as $key => $income) {
                                    if($income['table'] == 'tbl_coin_wallet'){
                                        $currency = 'Rs ';
                                    }else{
                                        $currency = currency;
                                    }
                                    if($income['table'] == 'tbl_hold_level_income'){
                                        $totalIncome[$key] = $this->Main_model->get_single_record($income['table'], ['type' => $income['type'], 'status' => 0], 'ifnull(sum(amount),0) as totalIncome');
                                    }else{
                                        $totalIncome[$key] = $this->Main_model->get_single_record($income['table'], ['type' => $income['type']], 'ifnull(sum(amount),0) as totalIncome');
                                    }
                                    
                                    echo '<div class="col-xl-3 col-md-6">
                                        <div class="card mini-stat bg-primary text-white">
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <div class="float-left mini-stat-img mr-4">
                                                        <img src="assets/images/services-icon/01.png" alt="">
                                                    </div>
                                                    <a href="'.base_url('Admin/Withdraw/income/'.$income['type']).'"><h5 class="font-size-16 text-uppercase mt-0 text-white-50">'.$income['name'].'</h5></a>
                                                    <h4 class="font-weight-medium font-size-24">Total : '.$currency.''.number_format($totalIncome[$key]['totalIncome'],2).' </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>';
                                }   
                            ?>



                            <!---<div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h3 class="font-size-16 text-uppercase mt-0 text-white-50">E-Wallet</h3>

                            <p class="mb-0">Wallet Bal.: <?php echo currency.''. $total_sent_fund;?></p>
                            <p class="mb-0">Used : <?php echo currency.''. $used_fund;?></p>
                            <p>Requested : <?php echo  currency.''.$requested_fund;?></p>
                           <a href="<?php echo base_url('Dashboard/Register/registerCron'); ?>">Auto Register</a> 

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h3 class="font-size-16 text-uppercase mt-0 text-white-50">Today E-Wallet</h3>

                            <!-- <p class="mb-0">Wallet Bal.: <?php echo currency.''. $total_sent_fund;?></p> -->
                           
                           <!-- <a href="<?php echo base_url('Dashboard/Register/registerCron'); ?>">Auto Register</a> 

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h3 class="font-size-16 text-uppercase mt-0 text-white-50">Withdrawl</h3>

                            <p class="mb-0"> Total: <?php echo currency.''. $total_withdrawl;?></p>
                            <p class="mb-0">Today Approved : <?php echo currency.''. $today_withdrawl_appr;?></p>
                            <p>Today Requested : <?php echo  currency.''.$today_withdrawl;?></p>
                           <!-- <a href="<?php echo base_url('Dashboard/Register/registerCron'); ?>">Auto Register</a> 

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h3 class="font-size-16 text-uppercase mt-0 text-white-50">E-Mail</h3>
                                                <p class="mb-0">Total : 0</p>
                                                <p class="mb-0">Read : 0</p>
                                                <p>Unread : 0</p>
                                        </div>

                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                       <div class="">
                    <div class="small-box">
                        <div class="inner">
                            <h3>Today Payout</h3>
                            <p class="mb-0">Today Matching : <?php echo currency.''. number_format($today_matchingIncome,2);?></p>
                            <p class="mb-0" style="display:none">Today Silver Income : <?php echo currency.''.number_format($today_silverIncome,2);?></p>
                            <p class="mb-0" style="display:none">Today Gold Income : <?php echo currency.''.number_format($today_goldIncome,2);?></p>
                            <p class="mb-0" style="display:none">Today Direct Sponsor Income : <?php echo currency.''. number_format($today_directSponsorIncome,2);?></p>
                            <p class="mb-0" style="display:none">Today Senior Support Income : <?php echo currency.''. number_format($today_seniorSupportIncome,2);?></p>
                            <p class="mb-0" style="display:none">Today Reward Income : <?php echo currency.''.number_format($today_rewardsIncome,2);?></p>
                            <p class="mb-0">Today Paid ID : <?php echo $today_paid_users;?></p>
                            <p class="mb-0">Today Business : <?php echo currency.''. $today_business;?></p>
                            <p class="mb-0" style="display:none">Today Pair Value : <?php echo $todayPair['amount'];?></p>
                            <p class="mb-0" style="display:none">All Pair : <?php if($todayPair['amount'] > 0) { echo floor($today_matchingIncome/$todayPair['amount']); }?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>

                    </div>
                </div>

                                    </div>
                                </div>
                            </div> -->



                        </div>

                        <!-- end row -->


                        <!-- end row -->


                        <!-- end row -->



                        <!-- end row -->




                <!-- End Page-content -->


<?php include_once'footer.php';  ?>

<!-- container-fluid --></div>
</div>
                </div>
<!--<script>


$(document).on('click', '#btnCopy', function () {

    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
$(document).on('click', '#btnCopy1', function () {

    var copyText = document.getElementById("linkTxt1");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>-->
