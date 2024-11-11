<?php
include "header.php";

if (isset($_SESSION['register_msg'])) {
    $user_id = $_SESSION['register_msg'];
//    unset($_SESSION['register_msg']);

    $query = mysqli_query($db, "SELECT * FROM `user` WHERE `user_id`='$user_id'");
    $userData = mysqli_fetch_array($query);
//   print_r($_SESSION);
} else {
    echo "<script type='text/javascript'> document.location = '/'; </script>";
    exit;
}
?>
<style>
    .banner video
    {
        display:none;
    }
    .login_page {
        background: linear-gradient(89deg, #dd20ed 0.1%, #7c20ed 51.5%, #9d20ec 100.2%);
        background-size: cover;
        padding: 20px 0px;
    }


    .form-fild {
        background: linear-gradient(89deg, #dd20ed 0.1%, #7c20ed 51.5%, #9d20ec 100.2%);
        padding: 21px 54px;
        border-radius: 15px;
        border: 1px solid #fff;
        color: #fff;
    }
    footer
    {
        display: none;
    }
</style>
<section class="page-feature py-5">
    <!--        <div class="container text-center">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class=" text-left">Signup</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb text-right">
                            <a href="home.html">Home</a>
                            <span>/ Signup</span>
                        </div>
                    </div>
                </div>
            </div>-->
</section>
<section class="banner login-registration" style="padding-top:10px;">
    <!--        <div class="vector-img">
                <img src="images/vector.png" alt="">
            </div>-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-sm-12 form-fild">
                <div class="rgister-part-main box-outer">
                    <div class="login-part main_box m-auto">


                        <div class="client-login text-white text-center"><h3>Congratulation your successfully register in Grow Money App</h3></div>

                        <script type="text/javascript">
                            //<![CDATA[
                            Sys.WebForms.PageRequestManager._initialize('ctl00$CPH1$SM1', 'form1', ['tctl00$CPH1$Up1', 'CPH1_Up1'], [], [], 90, 'ctl00');
                            //]]>
                        </script>
                        <style>
                            table
                            {
                                margin:20px auto !important;
                            }
                            table td
                            {
                                border:1px #FFF solid;
                                padding:10px;
                                color:#FFF;
                                font-weight: 800;
                            }
                        </style>

                        <div id="CPH1_Up1">

                            <div id="CPH1_updProgress" style="display:none;">

                                <div class="ProgressBg">
                                    <center><img alt="progress" src="assets/progress.gif" width="50px" /></center>
                                </div>

                            </div>
                            <div class="log-box">
                                <div id="CPH1_vs1" class="alert alert-warning toolErrorSummary" style="display:none;">

                                </div>
                                <div class="text-box" style="width:100%">
                                    <table style="width:100%" width="400" border="1" align="center" cellpadding="10" cellspacing="00">
                                        <tr>
                                            <td height="50" colspan="3" align="center"><strong>User Login Detail.</strong></td>
                                        </tr>
                                        <tr>
                                            <td width="45%">Name</td>
                                            <td align="center">:</td>
                                            <td width="45%"><?php echo $userData['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="45%">Affilate ID:</td>
                                            <td align="center">:</td>
                                            <td width="45%"><?php echo $userData['user_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="45%">Password:</td>
                                            <td align="center">:</td>
                                            <td width="45%"><?php echo $userData['password']; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="45%">Tran Password:</td>
                                            <td align="center">:</td>
                                            <td width="45%"><?php echo $userData['master_key']; ?></td>
                                        </tr>

                                    </table>
                                    <a href="login.php" class="btn btn-default">Login Now</a>
                                </div>
                                <br> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>





        </div>
    </div>
</section>


<!--Animated Cursor-->
<div id="animated-cursor">
    <div id="cursor">
        <div id="cursor-loader"></div>
    </div>
</div>
<!--Animated Cursor End-->

<!-- JavaScript -->
<script src="js/bundle.min.js"></script>

<!-- Plugin Js -->
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/jquery.cubeportfolio.min.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/parallaxie.min.js"></script>
<script src="js/wow.min.js"></script>
<!-- Owl Carousel JS File -->
<script src="js/owl.carousel.js"></script>
<!-- Slick JS File -->
<script src="js/slick.min.js"></script>
<!-- Tween Max Animation File -->
<script src="js/TweenMax.min.js"></script>
<!-- Morphtext File -->
<script src="js/morphext.min.js"></script>
<!-- REVOLUTION JS FILES -->
<script src="js/jquery.themepunch.tools.min.js"></script>
<script src="js/jquery.themepunch.revolution.min.js"></script>
<!-- SLIDER REVOLUTION EXTENSIONS -->
<script src="js/revolution.extension.actions.min.js"></script>
<script src="js/revolution.extension.carousel.min.js"></script>
<script src="js/revolution.extension.kenburn.min.js"></script>
<script src="js/revolution.extension.layeranimation.min.js"></script>
<script src="js/revolution.extension.migration.min.js"></script>
<script src="js/revolution.extension.navigation.min.js"></script>
<script src="js/revolution.extension.parallax.min.js"></script>
<script src="js/revolution.extension.slideanims.min.js"></script>
<script src="js/revolution.extension.video.min.js"></script>

<!-- Google Map Api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgIfLQi8KTxTJahilcem6qHusV-V6XXjw"></script>
<script src="maps.min.js"></script>

<!-- custom script -->
<script src="js/script.js"></script>

</body>

</html>
