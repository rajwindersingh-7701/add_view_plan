<?php
require_once("../../database/db.php");
require_once("controller/functionalityClass.php");
if (empty($_SESSION["admin"])) {
echo "<script type='text/javascript'> document.location = '../'; </script>";
exit;
}
$fu = new functionalityClass();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <title>
      Welcome - 
      <?php echo $_SESSION['admin']['name']; ?>
    </title>
    <meta name="author" content="Srinu Basava" />
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
    <!--     <script src="js/html5-trunk.js"></script> -->
    <!--     <script src="js/html5-trunk.js"></script> -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- Bootstrap css -->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- fullcalendar css -->
    <link href="assets/css/fullcalendar.css" rel="stylesheet" />
    <link href="assets/css/fullcalendar.print.css" rel="stylesheet" media="print" />
    
    
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!--   <script src="js/jquery.min.js"></script>
<script src="Json/JsoN.js?v=1.3"></script> -->
    <script src="https://tradewidme.com/Dashboard/assets/js/jquery.min.js">
    </script>
    <script>
      window.onload = function () {
        var options = {
          animationEnabled: true,
          theme: "light2",
          title: {
            text: "Monthly Sales Data"
          }
          ,
          axisX: {
            valueFormatString: "MMM"
          }
          ,
          axisY: {
            prefix: "$",
            labelFormatter: addSymbols
          }
          ,
          toolTip: {
            shared: true
          }
          ,
          legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries
          }
          ,
          data: [
            {
              type: "column",
              name: "Actual Sales",
              showInLegend: true,
              xValueFormatString: "MMMM YYYY",
              yValueFormatString: "$#,##0",
              dataPoints: [
                {
                  x: new Date(2017, 0), y: 20000 }
                ,
                {
                  x: new Date(2017, 1), y: 25000 }
                ,
                {
                  x: new Date(2017, 2), y: 30000 }
                ,
                {
                  x: new Date(2017, 3), y: 70000, indexLabel: "High Renewals" }
                ,
                {
                  x: new Date(2017, 4), y: 40000 }
                ,
                {
                  x: new Date(2017, 5), y: 60000 }
                ,
                {
                  x: new Date(2017, 6), y: 55000 }
                ,
                {
                  x: new Date(2017, 7), y: 33000 }
                ,
                {
                  x: new Date(2017, 8), y: 45000 }
                ,
                {
                  x: new Date(2017, 9), y: 30000 }
                ,
                {
                  x: new Date(2017, 10), y: 50000 }
                ,
                {
                  x: new Date(2017, 11), y: 35000 }
              ]
            }
            ,
            {
              type: "line",
              name: "Expected Sales",
              showInLegend: true,
              yValueFormatString: "$#,##0",
              dataPoints: [
                {
                  x: new Date(2017, 0), y: 32000 }
                ,
                {
                  x: new Date(2017, 1), y: 37000 }
                ,
                {
                  x: new Date(2017, 2), y: 40000 }
                ,
                {
                  x: new Date(2017, 3), y: 52000 }
                ,
                {
                  x: new Date(2017, 4), y: 45000 }
                ,
                {
                  x: new Date(2017, 5), y: 47000 }
                ,
                {
                  x: new Date(2017, 6), y: 42000 }
                ,
                {
                  x: new Date(2017, 7), y: 43000 }
                ,
                {
                  x: new Date(2017, 8), y: 41000 }
                ,
                {
                  x: new Date(2017, 9), y: 42000 }
                ,
                {
                  x: new Date(2017, 10), y: 50000 }
                ,
                {
                  x: new Date(2017, 11), y: 45000 }
              ]
            }
            ,
            {
              type: "area",
              name: "Profit",
              markerBorderColor: "white",
              markerBorderThickness: 2,
              showInLegend: true,
              yValueFormatString: "$#,##0",
              dataPoints: [
                {
                  x: new Date(2017, 0), y: 4000 }
                ,
                {
                  x: new Date(2017, 1), y: 7000 }
                ,
                {
                  x: new Date(2017, 2), y: 12000 }
                ,
                {
                  x: new Date(2017, 3), y: 40000 }
                ,
                {
                  x: new Date(2017, 4), y: 20000 }
                ,
                {
                  x: new Date(2017, 5), y: 35000 }
                ,
                {
                  x: new Date(2017, 6), y: 33000 }
                ,
                {
                  x: new Date(2017, 7), y: 20000 }
                ,
                {
                  x: new Date(2017, 8), y: 25000 }
                ,
                {
                  x: new Date(2017, 9), y: 16000 }
                ,
                {
                  x: new Date(2017, 10), y: 29000 }
                ,
                {
                  x: new Date(2017, 11), y: 20000 }
              ]
            }
          ]
        };
        $("#chartContainer").CanvasJSChart(options);
        function addSymbols(e) {
          var suffixes = ["", "K", "M", "B"];
          var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);
          if (order > suffixes.length - 1)
            order = suffixes.length - 1;
          var suffix = suffixes[order];
          return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
        }
        function toggleDataSeries(e) {
          if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;
          }
          e.chart.render();
        }
      }
    </script>  
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js">
    </script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
    <script>
      jQuery(function () {
        jQuery("#datepicker").datepicker({
          changeYear: true,
          changeMonth: true,
          maxDate: new Date(),
          dateFormat: "yy-mm-dd "
          //        yearRange: "2017:2020"
        }
                                        );
        jQuery("#datepicker1").datepicker({
          changeYear: true,
          changeMonth: true,
          maxDate: new Date(),
          dateFormat: "yy-mm-dd "
          //        yearRange: "2017:2020"
        }
                                         );
        //jQuery( "#datepicker" ).datepicker();
      }
            );
    </script>   
    <!-- Calendar Js -->
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js">
    </script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    </style>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js">
  </script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js">
  </script>
  <style>.nav-collapse.navbar-responsive-collapse.in.collapse {
    background: white;
    padding: 10px;
    height:auto;
    margin-top: 87px !important;
    }
    .navbar-responsive-collapse i {
      margin-right: 10px !important;
    }
    .left-sidebar {
      top: 126px !important;
    }
    p#response-msg {
      background: green;
      color: white;
      text-align: center;
      font-size: 18px;
      padding: 10px 0px;
    }
    header {
      border-top: 3px solid #d00a15 !important;
      background-color: #e91f24 !important;
      background-image: none !important;
    }
    body {
      background: #013d6e !important;
    }
    @media only screen and (min-width: 480px) and (max-width: 767px) {
      .left-sidebar {
        top: auto !important;
      }
      .main-box {
        width: 37% !important;
      }
    }
    @media only screen and (max-width: 479px) {
      .left-sidebar {
        top: auto !important;
      }
      .main-box {
        width: 37% !important;
      }
      .hasDatepicker {
        margin-left: 21px !important;
      }
    }
    .fcpbox2 {
      width: 63% !important;
    }
    .dashboard-wrapper
    {
      margin-left:0px;
    }
    .color1
    {
      color:#fff;
      line-height:1;
      margin-left: 33px;
    }
    .color1 i
    {
      color:#fff;
      margin-right: 33px;
    }
    #main-nav ul li a span {
      font-size: 17px !important;
      color: #ff0000 !important;
    }
    header{
      padding:20px 0px;
    }
    header {
      border-top: 3px solid #f09912 !important;
      background-color: #10538e !important;
      background-image: none !important;
    }
    .dashboard-wrapper .main-container {
      background: #ece9e9;
    }
    .user-details i {
      font-size: 20px;
      color: #fff;
    }
    .fcpbox2 {
      background: #013158 none repeat scroll 0 0 !important;
      margin: 11px 5px 0 40px  !important;
    }
    .head1 {
      background: linear-gradient(135deg, #013158 0%, #e43c0f 30%, #614d29 32%, #b9d465 68%, #654f49 70%, #003fe6 100%) no-repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
      border-bottom: 4px solid #f3f3f3;
    }
    .fcpbox2 a {
      font-size: 22px !important;
      color: #ceff0c !important;
    }
    .fcpbox2 h1 {
      font-size: 23px !important;
      color: white !important;
    }
    .content {
      position: absolute;
      top: 21px;
      right: 132px;
      padding: 0px 23px;
      font-size: 16px;
      color: #fff;
      border: 1px solid #ccc;
    }
    .user-details i {
      font-size: 36px;
      color: #fff;
      position: absolute;
      right: 35px;
      top: 27px;
    }
    @media (max-width: 480px)
    {
      .content {
        position: absolute;
        top: 64px;
        right: 6px;
        padding: 0px 8px;
        height: 40px;
      }
      .user-details i {
        font-size: 36px;
        color: #fff;
        position: absolute;
        right: 35px;
        top: 27px;
      }
      .colo1 {
        margin-left: 0pc !important;
        margin-bottom: 0px !important;
        font-size: 12px !important;
        color: #0c589a !important;
        font-weight: 700!important;
      }
      .fcpbox2 {
        width: 64.8% !important;
      }
    }
  </style>
  </head>
<body>
  <header>
    <div class="user-details">
      <div class="welcome-text color1">
        <a href="#" class="logo">
          <img src="../../img/logo.png"  style="border-radius: 3px;width: 156px;">
        </a>
      </div>
      <a href="change_pass.php">
        <div class="content" style="background  :#3A86C8">
          Change Password 
          <h3 id="lblYeswallet">
          </h3>
        </div>
      </a>
      <ul class="hidden-phone">
        <li>
          <a href="controller/function.php?type=logout">
            <span class="fs1" aria-hidden="true" >
              <i class="fa fa-sign-out" aria-hidden="true">
              </i>
            </span>
          </a>
        </li>
      </ul>
    </div>
    <div class="navbar hidden-desktop">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse" data-original-title="">
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </a>
          <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul>
          <li>
            <a href="./">
              <span class="fa fa-desktop">
              </span>Dashboard 
            </a>
          </li>
          <li>                                               
            <a href="#">
              <span class="fa fa-group">
              </span>Users 
            </a>
            <ul>
              <li>  
                <a href="Users.php">ALL User
                </a>
              </li>
              <li>  
                <a href="Users_paid.php">ALL Paid User
                </a>
              </li>
              <li>  
                <a href="user_comety.php">Core Committee
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <span class="fa fa-sliders">
              </span>Rewards 
            </a>
            <ul>
             
              <li>  
                <a href="rewards.php"> List of Rewards
                </a>   
              </li>
                <li>  
                <a href="rewards_ach.php"> Pending Achiever List
                </a>   
              </li>
              <li>  
                <a href="rewards_list.php"> Confirm Achiever List
                </a>   
              </li>
            </ul>
          </li>
                <li>

                                                            <a href="#"><span class="fa fa-sliders"></span>Withdraw </a>

                                                            <ul>

                                                                <li> <a href="pending_request.php">Pending Request</a>   </li>

                                                                <li><a href="withdraw.php">Withdraw</a></li>



                                                            </ul>

          </li>
          <li>                                               
            <a href="#">
              <span class="fa fa-exchange">
              </span>Transactions 
            </a>
            <ul>
              <li>  
                <a href="wallet_transaction.php">wallet transaction
                </a>
              </li>
            </ul>
          </li>
          
          <li>                                               
            <a href="#">
              <span class="fa fa-gift">
              </span>Package 
            </a>
            <ul>
              <li> 
                <a href="add_package.php">Add package
                </a>   
              </li>
              <li>  
                <a href="view_package.php">View package
                </a>   
              </li>
            </ul>
          </li>
                <li>                                               
                                                                            <a href="view_gallery.php"><span class="fa fa-image"></span>Gallery </a>
                                                                           
                                                                        </li>
          
          <li>                                               
            <a href="#">
              <span class="fa fa-id">
              </span>Other 
            </a>
            <ul>
              <li>  
                <a href="view_news.php">Latest news
                </a>
              </li>
              <li>   
                <a href="view_testimonial.php">Testimonial
                </a>
              </li>
              <li>   
                <a href="view_archivers.php">Latest Archivers
                </a>
              </li>
              <li>   
                <a href="deduct_fund.php">Fund Deduct</a>
              </li>
            </ul>
          </li>
          
          
          <li>                                               
            <a href="#">
              <span class="fa fa-group">
              </span>E Wallet 
            </a>
            <ul>
              <li>  
                <a href="add_fund.php">E SEND
                </a>
              </li>
              <li>   
                <a href="BD2_detail.php">E Detail
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <span class="fa fa-group">
              </span>Support 
              <span style="background: black;color: #fff;padding: 3px 8px;border-radius: 46%;">
                <?php echo mysqli_num_rows(mysqli_query($db, "select * from support where status='pending'")); ?>
              </span>
            </a>
            <ul>
              <li>  
                <a href="query_list.php">Query pending
                </a>
              </li>
              <li>   
                <a href="query_list_done.php">Query Done
                </a>
              </li>
            </ul>
          </li>
        </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="dashboard-wrapper">
      <div id="main-nav" class="hidden-phone hidden-tablet">
        <ul>
          <li>
            <a href="./">
              <span class="fa fa-desktop">
              </span>Dashboard 
            </a>
          </li>
          <li>                                               
            <a href="#">
              <span class="fa fa-group">
              </span>Users 
            </a>
            <ul>
              <li>  
                <a href="Users.php">ALL User
                </a>
              </li>
              <li>  
                <a href="Users_paid.php">ALL Paid User
                </a>
              </li>
              <li>  
                <a href="user_comety.php">Core Committee
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">
              <span class="fa fa-sliders">
              </span>Rewards 
            </a>
            <ul>
              <li>  
                <a href="rewards.php">List of Rewards
                </a>   
              </li>
              <li>  
                <a href="rewards_ach.php"> Pending Achiever List
                </a>   
              </li>
              <li>  
                <a href="rewards_list.php"> Confirm Achiever List
                </a>   
              </li>
            </ul>
          </li>
            <li>

                                                            <a href="#"><span class="fa fa-sliders"></span>Withdraw </a>

                                                            <ul>

                                                                <li> <a href="pending_request.php">Pending Request</a>   </li>

                                                                <li><a href="withdraw.php">Withdraw</a></li>



                                                            </ul>

                                                        </li>
          <li>                                               
            <a href="#">
              <span class="fa fa-exchange">
              </span>Transactions 
            </a>
            <ul>
              <li>  
                <a href="wallet_transaction.php">wallet transaction
                </a>
              </li>
            </ul>
          </li>
          
          <li>                                               
            <a href="#">
              <span class="fa fa-gift">
              </span>Package 
            </a>
            <ul>
              <li> 
                <a href="add_package.php">Add package
                </a>   
              </li>
              <li>  
                <a href="view_package.php">View package
                </a>   
              </li>
            </ul>
          </li>
          
          <li>                                               
            <a href="#">
              <span class="fa fa-id">
              </span>Other 
            </a>
            <ul>
              <li>  
                <a href="view_news.php">Latest news
                </a>
              </li>
              <li>   
                <a href="view_testimonial.php">Testimonial
                </a>
              </li>
              <li>   
                <a href="view_archivers.php">Latest Archivers
                </a>
              </li>
                <li>   
                <a href="deduct_fund.php">Fund Deduct</a>
              </li>
            </ul>
          </li>
          
          
          <li>                                               
            <a href="#">
              <span class="fa fa-group">
              </span>E Wallet 
            </a>
            <ul>
              <li>  
                <a href="add_fund.php">E SEND
                </a>
              </li>
              <li>   
                <a href="BD2_detail.php">E Detail
                </a>
              </li>
            </ul>
          </li>
            <li>                                               
                                                                            <a href="view_gallery.php"><span class="fa fa-image"></span>Gallery </a>
                                                                           
                                                                        </li>
          <li>
            <a href="#">
              <span class="fa fa-group">
              </span>Support 
              <span style="background: black;color: #fff;padding: 3px 8px;border-radius: 46%;">
                <?php echo mysqli_num_rows(mysqli_query($db, "select * from support where status='pending'")); ?>
              </span>
            </a>
            <ul>
              <li>  
                <a href="query_list.php">Query pending
                </a>
              </li>
              <li>   
                <a href="query_list_done.php">Query Done
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <div class="clearfix">
        </div>
      </div>
