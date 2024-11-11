<?php

require_once("database/db.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <!-- Author -->
    <meta name="author" content="Themes Industry">
    <!-- description -->
    <meta name="description" content="Grow money app is advertisment based platfrom. India best advertisment provider.">
    <!-- keywords -->
    <meta name="keywords" content="growmoney.me, growmoney, Grow Money App, Grow money me">
    <!-- Page Title --> 
    <title>GrowMoney</title>
    <!-- Favicon -->
    <link rel="icon" href="img/g.png">
    <!-- Bundle -->
    <link rel="stylesheet" href="css/bundle.min.css">
    <!-- Plugin Css -->
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/swiper.min.css">

    <link rel="stylesheet" href="css/cubeportfolio.min.css">
    <!-- Revolution Slider CSS Files -->
    <link rel="stylesheet" href="css/navigation.css">
    <link rel="stylesheet" href="css/settings.css">
    <!-- Slick CSS Files -->
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <!-- Style Sheet -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom Style CSS File -->
    <link rel="stylesheet" href="css/custom.css">

<!--fontawesome.com-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body data-spy="scroll" data-target=".navbar-nav" data-offset="90">

<!-- Loader -->
<!--<div class="loader" id="loader-fade">
    <div class="loader-container">
        <ul class="loader-box">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>-->
<!-- Loader ends -->

<!-- Header start -->
<header class="cursor-light">
    <nav class="navbar navbar-top-default navbar-expand-lg nav-three-circles black bottom-nav nav-box-shadow no-animation">
        <div class="container-fluid">
            <a class="logo ml-lg-1" href="index.php">
                <img src="img/gm.png" alt="logo" title="Logo" class="logo-default">
                <img src="img/gm.png" alt="logo" title="Logo" class="logo-scrolled">
            </a>
            <div class="collapse navbar-collapse d-none d-lg-block">
                <ul class="nav navbar-nav mx-auto">
                    <li class="nav-item"> <a href="index.php" class="nav-link">home</a></li>
                    <li class="nav-item"> <a href="index.php" class="nav-link">about</a></li>
                    <li class="nav-item"> <a href="index.php" class="nav-link">work</a></li>
                    <li class="nav-item"> <a href="index.php" class="nav-link">pricing</a></li>
                    <li class="nav-item"> <a href="index.php" class="nav-link">clients</a></li>
                    <li class="nav-item"> <a href="index.php" class=" nav-link">blog</a></li>
                    <li class="nav-item"> <a href="index.php" class=" nav-link">contact</a></li>
                    <li class="nav-item"> <a href="login.php" class=" nav-link">Login</a></li>
                    <li class="nav-item"> <a href="register.php" class=" nav-link">Register</a></li>
                    <!-- comment -->
                </ul>
            </div>
            <a href="javascript:void(0)" class="btn-setting btn-hvr-up btn-hvr-whatsapp color-black mr-lg-3 d-none d-lg-block">
                 growmoney.me@gmail.com</a>
            <!-- side menu open button -->
            <a class="menu_bars d-inline-block menu-bars-setting animated-wrap sidemenu_toggle d-block d-lg-none">
                <div class="menu-lines animated-element">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
            <!-- Side Menu -->
        </div>
    </nav>
    <!-- side menu open button -->
<!--    <a class="menu_bars menu-bars-setting animated-wrap sidemenu_toggle d-lg-inline-block d-none">
        <div class="menu-lines animated-element">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </a>-->
    <!-- Side Menu -->
    <div class="side-menu center">
        <div class="quarter-circle">
            <div class="menu_bars2 active" id="btn_sideNavClose">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="inner-wrapper justify-content-center">
            <div class="col-md-12 text-center">
                <!--<a href="javascript:void(0)" class="logo-full mb-4"><img src="https://megaone.acrothemes.com/creative-studio/img/logo-pure-white.png" alt=""></a>-->
            </div>
            <nav class="side-nav m-0">
                <ul class="navbar-nav flex-lg-row">
                    <li class="nav-item"> <a href="index.php" class=" nav-link">home</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">about</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">work</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">pricing</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">clients</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">blog</a></li>
                    <li class="nav-item"> <a href="index.php" class="scroll nav-link">contact</a></li>
                     <li class="nav-item"> <a href="login.php" class=" nav-link">Login</a></li>
                    <li class="nav-item"> <a href="register.php" class=" nav-link">Register</a></li>
                </ul>
            </nav>

            <div class="side-footer text-white w-100">
                <ul class="social-icons-simple">
                    <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fa fa-facebook color-white" aria-hidden="true"></i> </a> </li>
                    <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fa fa-instagram color-white"></i> </a> </li>
                    <li class="side-menu-icons"><a href="javascript:void(0)"><i class="fa fa-twitter color-white"></i> </a> </li>
                </ul>
                <p class="text-white">&copy; 2020 MegaOne. Made With Love by Themesindustry</p>
            </div>
        </div>
    </div>
    <a id="close_side_menu" href="javascript:void(0);"></a>
    <!--Side Menu-->
</header>
<!-- Header end -->
