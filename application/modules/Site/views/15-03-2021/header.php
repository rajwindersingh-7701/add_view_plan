
<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . $redirect);
exit();
}
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from corporx.themetags.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Mar 2021 10:36:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--favicon icon-->
    <link rel="icon" href="<?php echo (logo);?>" type="image/png" sizes="16x16">

    <!--title-->
    <title><?php echo title;?></title>

    <!--build:css-->
    <link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/main.css">
    <!-- endbuild -->
</head>

<body>

    <!--preloader start-->
    <div id="preloader">
        <div class="loader1">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!--preloader end-->
    <!--header section start-->
    <header class="header position-relative z-9">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark navbar-theme-primary fixed-top headroom">
            <div class="container position-relative">
                <a class="navbar-brand mr-lg-3" href="/">
                    <img class="navbar-brand-dark" style="max-width:200px;" src="<?php echo (logo);?>" alt="menuimage">
                    <img class="navbar-brand-light" src="<?php echo (logo);?>" alt="menuimage">
                </a>
                <div class="navbar-collapse collapse" id="navbar-default-primary">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-brand">
                                <a href="#">
                                    <img src="<?php echo (logo);?>" alt="menuimage">
                                </a>
                            </div>
                            <div class="col-6 collapse-close">
                                <i class="fas fa-times" data-toggle="collapse" role="button"
                                   data-target="#navbar-default-primary" aria-controls="navbar-default-primary"
                                   aria-expanded="false" aria-label="Toggle navigation"></i>
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav navbar-nav-hover ml-auto">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link">
                                <span class="nav-link-inner-text">Home</span>
                               </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/Register/'); ?>">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a></li>
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar-default-primary" aria-controls="navbar-default-primary" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>
    <!--header section end-->
