<!DOCTYPE html>
<?php require_once 'database/db.php'; ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="zxx">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $site ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta name="keywords" content="" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="newsite/assets/img/favicon.png">
        <!-- Site All Style Sheet Css -->
        <!-- Stylesheets -->
        <link href="assets/css/font-awesome-all.css" rel="stylesheet">
        <link href="assets/css/flaticon.css" rel="stylesheet">
        <link href="assets/css/owl.css" rel="stylesheet">
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/color.css" rel="stylesheet">
        <link href="assets/css/rtl.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/responsive.css" rel="stylesheet">
    </head>
    <style>
        .register_box
        {
            padding: 20px;
            border: 1px solid #fff;
            width: 100%;
            color: #fff;
        }
        .login_box {
            padding: 20px;
            border: 1px solid #000;
            width: 100%;
            margin-top: 26%;
            color: #fff;
            border-radius: 0px;
        }
        .bg-home {
            position: relative;
            background-image: url(../images/bg-home.png);
            background-color: #fff;
            background-size: cover;
            background-position: center center;
            height: 100vh;
        }
        .pt-55
        {
            padding-top: 25%;
        }
        .register_box.login_box label {
            margin: 4px;
        }

        .btn-info {
            color: #fff;
            background-color: #000;
            border-color: #000;
        }
        .btn-success {
            color: #fff;
            background-color: #000;
            border-color: #000;
        }
    </style>
    <body>
        <div class="bg-home">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 mx-auto">
                        <div class="register_box login_box">

                            <?php if (isset($_SESSION["forget"])) if ($_SESSION["forget"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['forget']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["forget"])) if ($_SESSION["forget"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['forget']['msg'] . "</p>";unset($_SESSION["forget"]); ?> 


                            <form name="form1" id='registration'  method="post" action="model/ajax.php"  onsubmit='registerSubmit()' enctype="application/x-www-form-urlencoded">
                                <p style="text-align:center"><a class="navbar-brand" href="#"><img src="logo.png" alt="elegance"> </a></p>
                                <h2 class="text-center">
                                    Forget Password 
                                </h2>
                                <div class="form-results"></div>

                                <label>User ID</label>

                                <input name="user_id"  class="form-control required email" type="text" maxlength="20"  id="userId" placeholder="user_id"  />

                                <br>

                                <div class="col-12 text-center pb-2 ">
                                    <button class="btn btn-alt thm-btn btn-success w-100" type="submit" name="forget" onclick="lsRememberMe()">Submit</button>
                                    <span class="gaps"></span>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-6"><a class="btn btn-info" href="login.php"> Login</a>  
                                    </div>   


                                    <div class="col-md-6 text-right">
                                        <a  class="text-right btn btn-info" href="index.php"> Home </a> </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>








            <!-- Site All Jquery Js -->
            <script src="assets/js/jquery-3.5.1.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/plugins.js"></script>
            <script src="assets/js/road-map.js"></script>
            <script src="assets/js/wow.min.js"></script>
            <!--Site Main js-->
            <script src="assets/js/main.js"></script>




            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">


            </script>





            <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>



            <script type="text/javascript">





                                        validSponsor();



                                        function checkSponsor() {



                                            var uname = document.getElementById("sponsor").value;







                                            var params = "user_id=" + uname;



                                            var url = "Controller/ajax.php?request=sponser";



                                            $.ajax({
                                                type: 'POST',
                                                url: url,
                                                dataType: 'html',
                                                data: params,
                                                beforeSend: function () {



                                                    document.getElementById("usernamechk").innerHTML = 'checking';



                                                    $('#pay_sponsor').val(uname);



                                                },
                                                complete: function () {







                                                },
                                                success: function (html) {







                                                    document.getElementById("usernamechk").innerHTML = html;



                                                    $('#pay_sponsor').val(uname);



                                                }



                                            });



                                        }







                                        function checkSponsor11() {



                                            uname = document.getElementById("userId").value;



                                            var params = "user_id=" + uname;



                                            var url = "Controller/ajax.php?request=user_id_check";



                                            $.ajax({
                                                type: 'POST',
                                                url: url,
                                                dataType: 'html',
                                                data: params,
                                                beforeSend: function () {



                                                    document.getElementById("usernamechk2").innerHTML = 'checking';



                                                    $('#pay_sponsor').val(uname);



                                                },
                                                complete: function () {







                                                },
                                                success: function (html) {







                                                    document.getElementById("usernamechk2").innerHTML = html;



                                                    $('#pay_sponsor').val(uname);



                                                }



                                            });



                                        }







                                        function validSponsor() {



                                            var uname = document.getElementById("sponsor").value;



                                            var position = document.getElementById("position").value;



                                            var params = "user_id=" + uname + "&position=" + position;



                                            var url = "Controller/ajax.php?request=valid_sponsor";



                                            $.ajax({
                                                type: 'GET',
                                                url: url,
                                                dataType: 'html',
                                                data: params,
                                                beforeSend: function () {







                                                    //                                                        document.getElementById("validSponsor").innerHTML = 'checking';



                                                    //            $('#pay_sponsor').val(uname);



                                                },
                                                complete: function () {







                                                },
                                                success: function (html) {



                                                    var data = JSON.parse(html);



                                                    document.getElementById("validSponsor").innerHTML = '';



                                                    if (data != 'undefined') {



                                                        var id = data['id'];



                                                        var msg = data['msg'];



                                                        document.getElementById("validSponsor").innerHTML = msg;



                                                        document.getElementById("validSponsorInput").value = id;



                                                    }



                                                    //            $('#pay_sponsor').val(uname);



                                                }



                                            });



                                        }







                                        function mobileCheck() {







                                            mobile = document.getElementById("mobile").value;



                                            var params = "mobile=" + mobile;



                                            var url = "Controller/ajax.php?request=mobileCheck";



                                            $.ajax({
                                                type: 'POST',
                                                url: url,
                                                dataType: 'html',
                                                data: params,
                                                beforeSend: function () {



                                                    document.getElementById("mobileCheck").innerHTML = 'checking';



                                                    //            $('#pay_sponsor').val(uname);



                                                },
                                                complete: function () {







                                                },
                                                success: function (html) {







                                                    document.getElementById("mobileCheck").innerHTML = html;



                                                    //            $('#pay_sponsor').val(uname);



                                                }



                                            });



                                        }



                                        function check_form_Data() {



                                            var passw = document.getElementById('passc').value;

                                            var letter = /[a-z]/;

                                            var upper = /[A-Z]/;

                                            var number = /[0-9]/;

                                            document.getElementById('pass-msg').innerHTML = "";

                                            if (passw.length < 6 || !letter.test(passw) || !number.test(passw) || !upper.test(passw)) {

                                                if (passw.length < 6) {
                                                    console.log(passw.length);

                                                    document.getElementById('pass-msg').innerHTML = "Please make sure password is longer than 6 characters.";

                                                    $("#registration").attr('onsubmit', 'return false');

                                                    return false;

                                                }

                                                if (!letter.test(passw)) {

                                                    document.getElementById('pass-msg').innerHTML = "Please make sure password includes a lowercase letter.";

                                                    $("#registration").attr('onsubmit', 'return false');

                                                    return false;

                                                }

                                                if (!number.test(passw)) {

                                                    document.getElementById('pass-msg').innerHTML = "Please make sure Password Includes a Digit";

                                                    $("#registration").attr('onsubmit', 'return false');

                                                    return false;

                                                }

                                                if (!upper.test(passw)) {

                                                    document.getElementById('pass-msg').innerHTML = "Please make sure password includes an uppercase letter.";

                                                    $("#registration").attr('onsubmit', 'return false');

                                                    return false;

                                                }





                                            }

                                            document.getElementById('pass-msg').innerHTML = "";

                                            $("#registration").attr('onsubmit', 'return true');

                                            return true;

                                        }
                                        const rmCheck = document.getElementById("rememberMe"),
                                                emailInput = document.getElementById("email");

                                        if (localStorage.checkbox && localStorage.checkbox !== "") {
                                            rmCheck.setAttribute("checked", "checked");
                                            emailInput.value = localStorage.username;
                                        } else {
                                            rmCheck.removeAttribute("checked");
                                            emailInput.value = "";
                                        }

                                        function lsRememberMe() {
                                            if (rmCheck.checked && emailInput.value !== "") {
                                                localStorage.username = emailInput.value;
                                                localStorage.checkbox = rmCheck.value;
                                            } else {
                                                localStorage.username = "";
                                                localStorage.checkbox = "";
                                            }
                                        }








            </script>





    </body>
</html>