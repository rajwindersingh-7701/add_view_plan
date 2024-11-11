<?php include_once 'header.php';
$crf =  rand(1000000000, 9999999999);
$_SESSION["crf"] = $crf;
?>



<section style="background-color: #e57bff;">
    <div class="container py-1">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="img/img4.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <?php if (isset($_SESSION["register"])) if ($_SESSION["register"]["status"] == false) echo "<p style='color:red' class='false' >" . $_SESSION['register']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["register"])) if ($_SESSION["register"]["status"] == true) echo "<p id='response-msg' class='true' >" . $_SESSION['register']['msg'] . "</p>";
                                                                                                                                                                                                                unset($_SESSION["register"]); ?>
                                <form name="form1" id="registration" method="post" action="model/registercontroller.php" onsubmit="registerSubmit()" enctype="application/x-www-form-urlencoded">

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fa fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <img src="img/gm.png" width="50%">
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register Here</h5>
                                    <div class="form-results"></div>
                                    <div class="form-group">
                                        <div class="form-field form-m-bttm">

                                            <input type="text" onChange="checkSponsor()" onFocus="checkSponsor()" class="form-control" name="sponsor" <?php
                                                                                                                                                        if (isset($_GET['sp'])) {
                                                                                                                                                            echo 'value="' . $_GET['sp'] . '"';
                                                                                                                                                        }
                                                                                                                                                        ?> id="sponsor" placeholder="Sponser Id" />
                                            <div id="usernamechk">



                                                <p></p>



                                            </div>
                                        </div>
                                    </div>
                                    <!--                        <div class="form-group">
                            <div class="form-field form-m-bttm">
                                <input name="userId" class="form-control required email" onchange="checkSponsor11()" onfocus="checkSponsor11()" type="text" maxlength="20" id="userId" placeholder="Username">
                                <div id="usernamechk2"></div>

                            </div>
                        </div>-->
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input name="name" class="form-control required" type="text" maxlength="100" id="CPH1_txtName" placeholder="Name">
                                            <input name="crf" type="hidden" maxlength="100" value="<?php echo $crf; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">

                                            <input name="email" class="form-control required" type="text" maxlength="50" id="" placeholder="Email">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="form-field">

                                            <input name="mobile" class="form-control required" type="text" maxlength="10" id="mobile" placeholder="Mobile">
                                        </div>
                                    </div>

                                    <!--                        <div class="form-group">
                            <select name="position_user"  onchange="validSponsor()" id="position"  required="" class="form-control">
                                <option value="">-- Select Position --</option>
                                <option value="left" <?php
                                                        if (isset($_GET['position'])) {
                                                            if ($_GET['position'] == 'left') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> >Left (A)</option>
                                <option value="right" <?php
                                                        if (isset($_GET['position'])) {
                                                            if ($_GET['position'] == 'right') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> >Right (B)</option>
                            </select>
                            <span id="sponsor_error" style="color: red"></span>
                        </div>-->


                                    <div class="form-group">
                                        <div class="form-field">
                                            <input class="form-control required" name="password" type="password" onchange="check_form_Data()" onfocus="check_form_Data()" maxlength="20" id="passc" placeholder="password">

                                            <div id="pass-msg" style="color:red"></div>

                                            <input type="checkbox" name="signup-term"> <span> I accept and agree with the terms of the <a href="#">User Agreement</a>.</span>
                                        </div>
                                    </div>


                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-warning btn-lg btn-block" name="register" type="submit" value='true'>Register</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    validSponsor();



    function checkSponsor() {



        var uname = document.getElementById("sponsor").value;






        var params = "user_id=" + uname;



        var url = "model/ajax.php?request=sponser";



        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function() {



                document.getElementById("usernamechk").innerHTML = 'checking';



                $('#pay_sponsor').val(uname);



            },
            complete: function() {







            },
            success: function(html) {







                document.getElementById("usernamechk").innerHTML = html;



                $('#pay_sponsor').val(uname);



            }



        });



    }







    function checkSponsor11() {



        uname = document.getElementById("userId").value;



        var params = "user_id=" + uname;



        var url = "model/ajax.php?request=user_id_check";


        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function() {



                document.getElementById("usernamechk2").innerHTML = 'checking';



                $('#pay_sponsor').val(uname);



            },
            complete: function() {







            },
            success: function(html) {







                document.getElementById("usernamechk2").innerHTML = html;



                $('#pay_sponsor').val(uname);



            }



        });



    }







    function validSponsor() {



        var uname = document.getElementById("sponsor").value;



        var position = document.getElementById("position").value;



        var params = "user_id=" + uname + "&position=" + position;



        var url = "model/ajax.php?request=valid_sponsor";



        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function() {







                //                                                        document.getElementById("validSponsor").innerHTML = 'checking';



                //            $('#pay_sponsor').val(uname);



            },
            complete: function() {







            },
            success: function(html) {



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



        var url = "model/ajax.php?request=mobileCheck";

        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'html',
            data: params,
            beforeSend: function() {



                document.getElementById("mobileCheck").innerHTML = 'checking';



                //            $('#pay_sponsor').val(uname);



            },
            complete: function() {







            },
            success: function(html) {







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

        if (passw.length < 6 || !letter.test(passw) || !number.test(passw)) {
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
</script>
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