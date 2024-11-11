<?php
include_once 'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
date_default_timezone_set('asia/kolkata')
?>
<style>
    .card {
        border: 2px #fede02 solid;
    }

    .card.mini-stat {
        /*min-height: 120px;*/
        text-align: center;
        border-radius: 10px;
        /*overflow: hidden;*/
        /*background-image: url(https://dhanymoney.com/uploads/line.svg) !important;*/

    }

    .card {
        box-shadow: 0 0.1rem 0.7rem rgb(0 0 0 / 18%);
        /*border: 1px solid rgba(0, 0, 0, 0);*/
        margin-bottom: 30px;
        background-color: #fff;
    }

    .mini-stat .mini-stat-img {
        width: 50px;
        height: 50px;
        line-height: 48px;
        background: #ffffff;
        border-radius: 4px;
        z-index: 111;
        text-align: center;
        margin: auto;
        position: absolute;
        top: 0px;
        left: 12px;
    }

    .mini-stat .mini-stat-img img {
        max-width: 26px;
    }

    marquee {
        color: #fff;

    }

    .news {
        height: 223px;
    }

    .text-white-50 {
        color: #000 !important;
    }

    .footer {
        color: #f1f1f1;
        background: rgb(0 0 0 / 24%);
    }

    /*.card.mini-stat.text-white::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #000;
    top: 0;
    left: 0;
    opacity: .6;
}*/
    .breadcrumb-item.active {
        color: #00587c;
        font-weight: bold;
        font-size: 23px;
        text-transform: capitalize;
    }

    table.table.table-bordered {
        color: #fff;
        font-size: 18px;
    }

    h6.card-title.table-title {
        background: #fd6d03
    }

    thead {
        background: #00587c;
    }

    td {
        color: #000;
    }

    .dashboard-main-heading p {
        display: inline-block;
        padding: 0 3px;
        font-size: 18px;
        margin: 0px;
    }

    table.table.table-bordered.reward td {
        color: #fff;
    }

    table.table.table-bordered.reward td:nth-child(4) {
        background: #fff;
    }

    .table td,
    .table th {
        font-weight: bold;
    }

    img.share-whtsp.img-fluid {
        max-width: 250px;
    }

    .card.mini-stat.text-white.epin p {
        display: inline-block;
        padding: 1px 22px;
        font-size: 16px;
        margin: 0px;
    }

    /*tr:nth-child(even) {background-color: #f2f2f2;}*/

    @media screen and (max-width:421px) {
        .mini-stat .mini-stat-img {
            display: none;
        }
    }

    @media screen and (max-width:575px) {
        .news {
            height: 100px;
        }

        img.share-whtsp.img-fluid {
            max-width: 100%;
        }
    }


    .head-social img {
        max-width: 40px;
        margin-right: 20px;
        margin-top: 10px;
    }

    /*@media screen and (min-width: 1024px) and (max-width: 1368px){
    .card.mini-stat{
        min-height: 167px;
    }
}*/
    @media screen and (max-width: 992px) {
        body[data-sidebar=dark] .vertical-menu {
            background: rgb(0 0 0 / 100%);
        }
    }

   p.timer-bg {
    background: #01587c;
    text-align: center;
    padding: 12px 5px;
    border-radius: 10px;
    display: inline-block;
    border: 1px #fff6 solid;
    width: 100%;
    margin-bottom: 15px;
	margin-top: 15px;
}

    .head-social ul {
        margin-top: 20px;
        display: flex;
        padding: 0px;
        list-style: none;
        justify-content: space-between;
    }

    .head-social li {
        border-radius: 5px;

    }

    li.instagram-bg {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
    }

    li.facebook-bg {
        background: #3b5998;
    }

    li.telegram-bg {
        background: #0088cc;
    }

    li.twitter-bg {
        background: #1DA1F2;
    }

    li.linkedin-bg {
        background: #0072b1;
    }

    .head-social a {
        color: #fff;
        width: 40px;
        height: 40px;
        align-items: center;
        display: flex;
        justify-content: space-around;
        font-size: 20px;
    }

    .page-content {
        padding: calc(72px) calc(24px / 2) 60px calc(24px / 2);
    }

    .font-size-18 {
        font-size: 16px !important;
    }

    @media screen and (max-width:575px) {
        .f-13 {
            font-size: 13px !important;
        }
    }

    .top_details p {
        font-weight: bold;
    }

    /* .purple-text{
    color:#6e4ff6;
} */

.row.copyrefferal.box.box-body.pull-up.bg-hexagons-white {
    align-items: center;
}

.text-yellow {
    color: #fee200!important;
}


.complte-box {
	background:#33db9e;                                 
	  padding: 10px 0px;
	  font-size: 15px;
	  color: #fff;
	  font-weight: bold;
	  border-radius:10px;
	  border: navajowhite;
	  float: left;
	  width: 100%;
	  margin-bottom: 15px;
	  margin-top: 15px;
	  cursor: pointer;
	display: flex;
	justify-content: center;
	align-items: center;
	  letter-spacing:2px;
	  text-transform: uppercase;
	  letter-spacing: 2px;
	  font-size: 16px
	
	
}
</style>
<script>
    function countdown(element, seconds) {
        // Fetch the display element
        var el = document.getElementById(element).innerHTML;

        // Set the timer
        var interval = setInterval(function() {
            if (seconds <= 0) {
                //(el.innerHTML = "level lapsed");
                $('#' + element).text('Time Completed!')

                clearInterval(interval);
                return;
            }
            var time = secondsToHms(seconds)
            $('#' + element).text(time)

            seconds--;
        }, 1000);
    }

    function secondsToHms(d) {
        d = Number(d);
        var day = Math.floor(d / (3600 * 24));
        var h = Math.floor(d % (3600 * 24) / 3600);
        var m = Math.floor(d % 3600 / 60);
        var s = Math.floor(d % 3600 % 60);

        var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " Days, ") : "";
        var hDisplay = h > 0 ? h + (h == 1 ? " Hour, " : " hours, ") : "";
        var mDisplay = m > 0 ? m + (m == 1 ? " Minute, " : " Minutes, ") : "";
        var sDisplay = s > 0 ? s + (s == 1 ? " Second" : " Seconds") : "";
        var t = dDisplay + hDisplay + mDisplay + sDisplay;
        return t;
        // console.log(t)
    }
</script>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="">
            <!-- <div class="card" style="background: #f4516c;">
                <div class="card-body" style="padding:0px;">

                    <marquee direction="left" scrollamount="2"><?php echo $news['news']; ?></marquee>
                </div>
            </div> -->
        </div>
        <div class="page-header mt-5">
            <div class="card card-body" style="background:url(<?php echo base_url('uploads/user-bg.avif'); ?>);background-size:cover;">
                <div class="top_details">
                    <p class="font-size-18 mt-0 text-dark">User Name : <span class="purple-text"><?php echo ($userinfo->name) ?></span> </p>
                    <p class="font-size-18 mt-0 text-dark">User Id : <span class="purple-text"><?php echo ($userinfo->user_id) ?></span> </p>
                    <p class="font-size-18 mt-0 text-dark">Sponser : <span class="purple-text"><?php echo ($userinfo->sponser_id) ?></span> </p>

                    <p class="font-size-18 mt-0 ttext-dark">Status : <span class="purple-text"><?php echo ($userinfo->paid_status > 0) ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' ?></span> </p>
                    <!-- <p class="font-size-18 mt-0 text-dark">Rank : <span class="purple-text"><?php //echo ($userinfo->rank) ?></span> </p> -->
                    <p class="font-size-18 mt-0 text-dark">Joining Date : <span class="purple-text"><?php echo ($userinfo->created_at) ?></span> </p>
                    <!-- <p class="font-size-18 mt-0 text-white">Task : <span class="purple-text"></span> </p> -->
                </div>
            </div>

            <!-- start page title -->
            <div class="row align-items-center">
                <div class="col-sm-12">

                    <div class="card" style="background:url(<?php echo base_url('uploads/user-bg.avif'); ?>);background-size:100%;">
                        <div class="card-body">
                            <!-- <h4 class="text-white text-uppercase">Dashboard</h4> -->
                            <div class="row">
                                <div class="col-md-6 text-center dashboard-main-heading d-grid">
                                    <div class="col-md-12 complte-box">
                                        <?php if ($task['tasks'] == 10) {
                                            echo '<span class="">Completed</span>';
                                        } else { ?>
                                            <a style="color:white; " href="<?php echo base_url('Dashboard/Task/') ?>">Complete your Task</a>
                                        <?php  } ?>
                                    </div>
                                    <ol class="breadcrumb mb-0" style="background: #ffffff; display:none;">
                                        <li class="breadcrumb-item active" style="font-size: 18px;">Welcome To <span style="color: #ec761a;"><?php echo ($userinfo->name) ?></span> <br>
                                            <p><span>User-Id :-</span> <span style="color: #ec761a"><?php echo ($userinfo->user_id) ?></span></p>
                                            <p> <span>Joining Date :-</span> <span style="color: #ec761a"><?php echo ($userinfo->created_at) ?></span></p>
                                            <p><span>Activation Date:-</span> <span style="color: #ec761a;"><?php echo ($userinfo->topup_date) ?></span></p>
                                        </li>

                                    </ol>
                                </div>



                                <div class="col-md-6 d-grid">

                                    <?php
                                    //print_r($silver);
                                    // if($userinfo->package_amount == 0){
                                    //     $diff = strtotime('+50 hours', strtotime($userinfo->created_at)) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg" style="color: #fff;">Red ID Timer :- <span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo'<script> countdown("demo",'.$diff.') </script>';
                                    // }

                                    if (($userinfo->paid_status > 0 && $userinfo->package_amount > 0) || ($userinfo->paid_status > 0 && $userinfo->upgrade_package > 0)) {
                                        $diff = strtotime('+1 days', strtotime($userinfo->topup_date)) - strtotime(date('Y-m-d H:i:s'));
                                        if($diff > 0){
                                            echo '<p class="timer-bg" style="color: #fff;">Booster Timer<br><span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                            echo '<script> countdown("demo",' . $diff . ') </script>';
                                        }else{
                                            // echo '<p class="timer-bg" style="color: #fff;"> <br><span  style="color:#fff;font-weight:bold;">Retop-up your Account</span></p>';
                                        }
                                        
                                    // } elseif ($userinfo->package_amount > 0 && $userinfo->paid_status == 0) {
                                    //     $diff = strtotime('+30 days', strtotime($userinfo->topup_date)) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg" style="color: #fff;">Subscription ₹1000 :- <br><span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo '<script> countdown("demo",' . $diff . ') </script>';
                                    // }else{
                                    //     echo '<p class="timer-bg" style="color: #fff;"><span  style="color:#fff;font-weight:bold;">Please Activate or Retop-up your Account</span></p>';

                                    }

                                    // if($userinfo->upgrade_package == 4999){
                                    //     $diff = strtotime('+15 days', strtotime($userinfo->upgrade_at)) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg" style="color: #fff;">Retopup Timer :- <span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo'<script> countdown("demo",'.$diff.') </script>';
                                    // }

                                    // if(empty($gold)){
                                    //     $diff = strtotime('+30 days', strtotime($user['topup_date'])) - strtotime(date('Y-m-d H:i:s'));
                                    //     echo '<p class="timer-bg">GOLD CLUB Time Left :- <span id="demo1" style="color:#fff;font-weight:bold;"></span></p>';
                                    //     echo'<script> countdown("demo1",'.$diff.') </script>';
                                    // }

                                    ?>

                                    <script>
                                        // var countDownDate = new Date("<?php //echo date('Y-m-d H:i', strtotime('+168 hour', strtotime($userinfo->topup_date))); 
                                                                            ?>").getTime();

                                        // // Update the count down every 1 second
                                        // var x = setInterval(function () {

                                        //     // Get today's date and time
                                        //     var now = new Date().getTime();

                                        //     // Find the distance between now and the count down date
                                        //     var distance = countDownDate - now;

                                        //     // Time calculations for days, hours, minutes and seconds
                                        //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        //     // Output the result in an element with id="demo"
                                        //     document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                                        //             + minutes + "m " + seconds + "s ";

                                        //     // If the count down is over, write some text
                                        //     if (distance < 0) {
                                        //         clearInterval(x);
                                        //         document.getElementById("timer").innerHTML = "EXPIRED";
                                        //     }
                                        // }, 1000);
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6" style="display:none">
                    <div class="float-right d-none d-md-block">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-settings mr-2"></i> Settings
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- <div class="mb-4">
                <a href="https://t.me/growwithgrowmoney" class="btn btn-primary w-100 d-block  font-size-18 mt-0 text-white" style="background:#0088cc;font-weight:600;" target="_blank">Join Telegram</a>
            </div> -->

            <div class="row">
                <div class="col-xl-4 col-md-6 d-none">
                    <div class="card mini-stat text-white" style="background:#00587c">
                        <div class="card-body">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">USER ID</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php echo $userinfo->name . '(' . $userinfo->user_id . ')' ?></span> </h4>

                            </div>

                        </div>
                    </div>
                </div>

                
                <div class="col-6 col-md-6  d-grid ">
                    <div class="card mini-stat text-white">
                        <div class="card-body">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">E-WALLET</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><?php echo currency . '' . number_format($wallet_balance['wallet_balance'], 2); ?> </h4>
                                <a href="<?php echo base_url('Dashboard/fund/Request_fund'); ?>" target="_blank" class="btn btn-primary btn-set" style="background:#A020F0;">ADD FUND</a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- <div class="col-6 col-md-4 ">
                    <div class="card mini-stat text-white">
                        <div class="card-body">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">GMT-WALLET</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><?php echo currency . '' . number_format($gmt_wallet['gmt_wallet'], 2); ?> </h4>
                                <a href="<?php echo base_url('Dashboard/fund/gmtHistory'); ?>" target="_blank" class="btn btn-primary" style="background:#A020F0;">History</a>
                            </div>

                        </div>
                    </div>
                </div> -->

                <div class="col-6 col-md-6  d-grid">
                    <div class="card mini-stat text-white">
                        <div class="card-body">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">PAY WALLET</h5>
                                <?php 
                                    if($income_balance['income_balance'] > 0){
                                        $IncomeBalance = number_format($income_balance['income_balance'], 2);
                                    }else{
                                        $IncomeBalance = 0;
                                    }
                                
                                
                                ?>
                                <h4 class="font-weight-medium font-size-18 text-dark"><?php echo currency . '' . $IncomeBalance; ?></h4>
                                <a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw'); ?>" class="btn btn-primary btn-set" style="background:#A020F0;">WITHDRAW</a>
                            </div>

                        </div>
                    </div>
                </div>
				
				<div class="col-6 col-xl-3 col-md-6  d-grid  ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">Pending Limit</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><?php echo currency . '' . number_format($userinfo->totalLimit - $userinfo->pendingLimit , 2); ?> </h4>
                                <!-- <a href="<?php //echo base_url('Dashboard/fund/Request_fund'); ?>" target="_blank" class="btn btn-primary" style="background:#A020F0;">ADD FUND</a> -->
                            </div>

                        </div>
                    </div>
                </div>
				<div class="col-6 col-xl-3 col-md-6  d-grid  ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">Limit</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><?php echo currency . '' . number_format($userinfo->totalLimit, 2); ?> </h4>
                                <!-- <a href="<?php //echo base_url('Dashboard/fund/Request_fund'); ?>" target="_blank" class="btn btn-primary" style="background:#A020F0;">ADD FUND</a> -->
                            </div>

                        </div>
                    </div>
                </div>
				
				
				
           
                <?php $incomes = $this->config->item('incomes');
                foreach ($incomes as $inKey => $inc) {
                    $totalIncome = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $userinfo->user_id,'type' => $inc['type']],'ifnull(sum(amount),0)as total');  ?>
              
                <div class="col-6 col-xl-3 col-md-6   d-grid">
                    <div class="card mini-stat text-white">
                        <div class="card-body  p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50"><?php echo $inc['name'] ?></h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php echo currency . '' . $totalIncome['total'];; ?></span> </h4>

                            </div>

                        </div>
                    </div>
                </div>
                <?php   }
                ?> 


                <div class="col-xl-4 col-md-6 d-none">
                    <div class="card mini-stat text-white">
                        <div class="card-body">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 mt-0 text-white-50">Package Status</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php if ($userinfo->upgrade_id > 0) {
                                                                                                                    echo currency . '' . $userinfo->upgrade_package;
                                                                                                                } else {
                                                                                                                    echo currency . '' . $userinfo->package_amount;
                                                                                                                } ?></h4>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3 col-md-6  d-grid ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50">Today Income</h5>
                                <!-- +$Todaylevel_income['level_income'] -->
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php echo currency . '' . ($today_income['today_income']); ?> </span> </h4>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-6 col-xl-4 col-md-6  d-grid ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50">Total Income</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php echo currency . '' .round($total_income['total_income'], 2); ?> </span></h4>

                            </div>

                        </div>
                    </div>
                </div>


            
                <div class="col-6 col-xl-4 col-md-6 d-grid ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50">Total Withdraw</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray"><?php
                                $totalWithdraw = $this->User_model->get_single_record('tbl_withdraw', array('user_id' => $this->session->userdata['user_id'], 'status' => '1'), 'ifnull(sum(payable_amount),0) as totalWithdraw');

                                echo currency . '' . number_format($totalWithdraw['totalWithdraw'], 2); ?></span> </h4>

                            </div>

                        </div>
                    </div>
                </div>




           

                <div class="col-6 col-xl-4 col-md-6  d-grid ">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50">Direct Referral</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark">Active : <?php echo $paid_directs['paid_directs']; ?> , Inactive : <?php echo $free_directs['free_directs']; ?>
                                </h4>

                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col-6 col-xl-4 col-md-6  d-grid">
                    <div class="card mini-stat text-white">
                        <div class="card-body p-2">
                            <div class="" style="position: relative;">

                                <h5 class=" font-size-18 f-13 mt-0 text-white-50">Total Team</h5>
                                <h4 class="font-weight-medium font-size-18 text-dark">Active : <?php echo $active_team['team'] ?>, Total : <?php echo ($active_team['team'] + $inactive_team['team']); ?>
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>


      



                <?php
                // $incomes = $this->config->item('incomes');
                // foreach ($incomes as $key => $income) {
                //     if($income['table'] == 'tbl_coin_wallet'){
                //         $currency = 'SDC ';
                //     }else{
                //         $currency = currency;
                //     }
                //     if($income['table'] == 'tbl_hold_level_income'){
                //         $totalIncome[$key] = $this->User_model->get_single_record($income['table'], ['user_id' => $this->session->userdata['user_id'], 'type' => $income['type'], 'status' => 0], 'ifnull(sum(amount),0) as totalIncome');
                //     }else{
                //         $totalIncome[$key] = $this->User_model->get_single_record($income['table'], ['user_id' => $this->session->userdata['user_id'], 'type' => $income['type']], 'ifnull(sum(amount),0) as totalIncome');
                //     }

                //     echo '<div class="col-xl-4 col-md-6 ">
                //           <div class="card mini-stat text-white" style="background:#16a086" >
                //               <div class="card-body">
                //                   <div class="" style="position: relative;">
                //                       <div class="mini-stat-img" >
                //                           <img src="'.base_url('NewDashboard/').'assets/images/services-icon/04.png" alt="">
                //                       </div>
                //                       <h5 class=" font-size-18 mt-0 text-white-50">'.$income['name'].'</h5>
                //                       <h4 class="font-weight-medium font-size-18 text-dark"><span class="text-gray">'.$currency.' '.number_format($totalIncome[$key]['totalIncome'], 2).'</span></h4>

                //                   </div>

                //               </div>
                //           </div>
                //     </div>';

                // }
                ?>










            </div>

            <div class="">
                <div class="card bg-white">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-dark">Share Link</h4>
                        <div class="row copyrefferal box box-body pull-up bg-hexagons-white">
                            <input style="width:60%;  float:left" type="text" id="linkTxt" value="<?php echo base_url('Dashboard/Register/?sponser_id=' . $userinfo->user_id); ?>" class="form-control">
                            <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section" style="background:#33db9e;
             
              padding: 10px 0px;
              font-size: 15px;
              color: #fff;
              font-weight: bold;
              border-radius: 10px;
              border: navajowhite;
              float: left;
              width: 37%;
              cursor: pointer;
          
              letter-spacing:2px;
			  margin-left: 10px;
              ">
                                Copy link
                            </button>
                        </div>
                        <!-- <div class="head-social">
                            <ul>


                                <li class="instagram-bg">
                                    <a href="https://www.instagram.com/invites/contact/?i=1gqo49ca04o17&utm_content=q6egiyk" target="_blank"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li class="telegram-bg">
                                    <a href="https://telegram.me/growmoneyofficiall" target="_blank"><i class="fa fa-telegram"></i></a>
                                </li>
                                <li class="facebook-bg">
                                    <a href="https://www.facebook.com/profile.php?id=100089673351939&mibextid=ZbWKwL" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="twitter-bg">
                                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li class="linkedin-bg">
                                    <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div> -->
                        <!--  <div class="text-center mt-2">
            <a href="https://api.whatsapp.com/send?phone=whatsappphonenumber&text=urlencodedtext" ><img src="<?php echo base_url('uploads/whstap.png'); ?>" class="share-whtsp img-fluid"></a>
            </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-12 table-responsive p-0 ">
                <?php
                $awardsArr = $this->config->item('rewards');
                ?>
                <table class="table ">
                    <thead class="text-white">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Business</th>
                            <th>Reward</th>
                            <th>Bonus</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($awardsArr as $key => $inc) {
                            $activate_pool = $this->User_model->get_single_record('tbl_rewards', ['user_id' => $this->session->userdata['user_id'], 'award_id' => $key], '*');
                            if (!empty($activate_pool)) {
                                $art =  '<span class="badge badge-success"> Achieved</span>';
                            } else {
                                $art =  '<span class="badge badge-danger">Not Achieved</span>';
                            }
                        ?>
                            <tr>
                                <td><?php echo ($key); ?></td>
                                <td><?php echo currency . $inc['business']; ?></td>
                                <td><?php echo currency.  $inc['reward']; ?></td>
                                <td><?php echo  $inc['reward2']; ?></td>

                                <td><?php echo $art ; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include_once 'footer.php';  ?>
        <script>
            $(document).on('click', '#btnCopy', function() {
                //linkTxt
                var copyText = document.getElementById("linkTxt");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                alert("Copied the text: " + copyText.value);
            })
            $(document).on('click', '#btnCopy1', function() {
                //linkTxt
                var copyText = document.getElementById("linkTxt1");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                alert("Copied the text: " + copyText.value);
            })
        </script>
        <?php if ($popup['status'] == 0) : ?>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <!--   <h4 class="modal-title"><?php //echo $popup['caption'];
                                                            ?></h4>-->
                        </div>
                        <div class="modal-body">
                            <img style="max-width:100%" src="<?php echo base_url('uploads/' . $popup['media']) ?> ">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <script>
            // $(document).on('click', '#btnCopy', function() {
            // linkTxt
            // var copyText = document.getElementById("linkTxt");
            // copyText.select();
            // copyText.setSelectionRange(0, 99999)
            // document.execCommand("copy");
            // alert("Copied the text: " + copyText.value);
            // })
        </script>
        <script>
            $('#myModal').modal('show');
            // $.get('<?php echo base_url('Dashboard/User/get_coin_prices') ?>',function(res){
            //   console.log(res)
            //   // var html = '';
            //   // $.each(res.success,function(key,value){
            //   //   html += '<li><i class="cc BTC"></i> '+value.currency+' <span class="text-yellow"> $'+value.price+'</span></li>';
            //   // })
            //     console.log(res);
            //   // $('#webticker-1').html(res);
            // })
        </script>