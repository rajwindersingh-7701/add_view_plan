<?php require 'header.php'; ?>



<section class="" style="background-color: #e57bff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="img/img1.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="model/ajax.php" method="post" class="sl-form">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fa fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <img src="img/gm.png" width="50%">
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                  <?php if (isset($_SESSION["login"])) if ($_SESSION["login"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['login']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["login"])) if ($_SESSION["login"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['login']['msg'] . "</p>"; ?>
                  <div class="form-outline mb-4">
                    <label class="form-label text-dark" for="form2Example17">User ID</label>
                    <input type="text" name='user_id' class="form-control form-control-lg" required />

                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" required />
                    <input type="hidden" name="login_form" value="login" />
                  </div>
                  <div class="form-check d-flex justify-content-start mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                    <label class="form-check-label" for="form1Example3"> Remember password </label>
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-warning btn-lg btn-block" type="submit">Login</button>
                  </div>

                  <a class="text-dark h6" href="forget.php">Forgot password?</a>
                  <p class="mb-5 pb-lg-2 h6 mt-2" style="color: #393f81;">Don't have an account? <a href="register.php" style="color: #393f81;"><u>Register here</u></a></p>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
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