<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title><?php echo title;?></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('');?>NewAssets/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('');?>NewAssets/css/style.css">

    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('');?>NewAssets/css/responsive.css">
    <style>
        .navbar-nav .nav-item .nav-link {
            padding: 7px 12px;
            margin-top: 11px;
            margin-right: 20px;
            text-align: center;
        }
        .fixed-top {
            background: rgb(215, 223, 239);
        }
        a.nav-link {
            position: relative;
            z-index: 1;
            color: #fff;
            font-size: 12px !important;
            font-weight: 600;
            left: 16px;
            padding: 0 20px;
            min-width: 100px;
            color: #fff !important;
            background: #00587e;
            border-radius: 5px;
            border: 1px solid #fff;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 15px;
        }
        @media screen and (max-width: 991px){
            .navbar-nav .nav-item .nav-link {
             
                 margin-right: 0px; 
            }
        }
 
    </style>
</head>

<body class="light-version">
    <!-- Preloader -->
    <div id="preloader">
        <div class="preload-content">
            <div id="loader-load"></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <nav class="navbar navbar-expand-lg navbar-white fixed-top" id="banner">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="#"><span><img src="NewAssets/img/logo.png" alt="logo" style="max-width: 200px;"></span></a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" >Home</a>
                       
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" target="_blank">Business Plan</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="lh-55px"><a href="<?php echo base_url('Dashboard/Register/'); ?>" class="btn login-btn ml-20">Register</a></li>
                    <li class="lh-55px"><a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="btn login-btn ml-20">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ##### Header Area End ##### -->