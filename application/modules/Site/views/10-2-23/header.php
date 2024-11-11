<?php
    if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
        $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $redirect);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-X44DHSVNM0"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-X44DHSVNM0');
</script>
        <!-- meta tag -->
        <meta charset="utf-8">
        <title><?php echo title;?></title>
        <meta name="description" content="">
        <!-- responsive tag -->
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.html">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/images/fav.png">
        <!-- Bootstrap v4.4.1 css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <!-- font-awesome css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
        <!-- animate css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/animate.css">
        <!-- aos css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/aos.css">
        <!-- owl.carousel css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/owl.carousel.css">
        <!-- slick css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/slick.css">
        <!-- off canvas css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/off-canvas.css">
        <!-- linea-font css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/linea-fonts.css">
        <!-- flaticon css  -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/flaticon.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/magnific-popup.css">
        <!-- Main Menu css -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/rsmenu-main.css">
        <!-- nivo slider CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/inc/custom-slider/css/nivo-slider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/inc/custom-slider/css/preview.css">
        <!-- rsmenu transitions css -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/rsmenu-transitions.css">
        <!-- spacing css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/rs-spacing.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
        <!-- responsive css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <style>
        a.login-btn {
            background: #fd6f03;
            color: #fff !important;
            padding: 10px 12px !important;
            display: inline;
            border-radius: 3px;
        }
        .full-width-header .rs-header .menu-area .main-menu .rs-menu ul.nav-menu li {
            margin-right: 10px;
        }
        .menu-sticky {
            background: #fff;
        }
        .full-width-header .rs-header .menu-area.sticky{
               background: #fff !important;
        }
        @media screen and (max-width: 991px){
            a.login-btn{
                display: block;
            }
        }
        <script>
window.open("https://superdigitalcoins.com/uploads/plan.pdf", '_blank');

</script>
        </style>
    </head>
    <body class="home-three">

        <!-- Preloader area start here -->
        <div id="loader" class="loader">
            <div class="spinner"></div>
        </div>
        <!--End preloader here -->

        <!--Full width header Start-->
        <div class="full-width-header">
            <!-- Toolbar Start -->
            <div class="toolbar-area hidden-md">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="toolbar-contact">
                                <ul>
                                    <li> <i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?php echo email;?>"><?php echo email;?></a></li>
                                    <li style="font-weight: bold;background: #fd6f03;padding: 4px 12px;border-radius: 3px;"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Calling And whatsapp Number <a href="tel:<?php echo phone;?>"><?php echo phone;?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="toolbar-sl-share">
                                <ul>

                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Toolbar End -->

            <!--Header Start-->
            <header id="rs-header" class="rs-header">
                <!-- Menu Start -->
                <div class="menu-area menu-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo-area">
                                    <a href="#"><img src="<?php echo base_url(logo);?>" alt="logo" style="max-width:180px;"></a>
                                </div>
                            </div>
                            <div class="col-lg-9 text-right">
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                        <div class="mobile-menu">
                                            <a class="rs-menu-toggle">
                                                <i class="fa fa-bars"></i>
                                            </a>
                                        </div>
                                        <nav class="rs-menu">
                                            <ul class="nav-menu">
                                                <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item">
                                                    <a href="/" class="login-btn">Home</a>

                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Site/Main/about');?>" class="login-btn">About Us</a>
                                                </li>
                                                <li>
                                                    <a id="submit" href="<?php echo base_url('uploads/plan.pdf');?>" class="login-btn" target="_blank">Business Plan</a>

                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Site/Main/bank');?>" class="login-btn">Bank</a>
                                                </li>
                                               
                                                <li>
                                                    <a href="<?php echo base_url('Site/Main/contact'); ?>"  class="login-btn">Contact Us</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Dashboard/Register/'); ?>" class="login-btn">Register</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="login-btn">Login</a>
                                                </li>

                                            </ul> <!-- //.nav-menu -->
                                        </nav>
                                    </div> <!-- //.main-menu -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Menu End -->


            </header>
            <!--Header End-->
        </div>
        <!--Full width header End-->
