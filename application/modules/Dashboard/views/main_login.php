<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo title; ?>" name="description" />
    <meta content="<?php echo title; ?>" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('uploads/favicon.png');?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url('NewDashboard/') ?>assets/css/aos.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
            body {
	background: url('/uploads/img-15.jpg');
	background-size: cover;
	background-position: center;
	background-attachment: fixed;
}
            body::before {
	position: absolute;
    background: rgba(0,0,0,.2);
	width: 100%;
	height: 100%;
	top: 0;
	content: '';
	opacity: .5;
}
            .card {
    border-radius: 8px;
}
            .bg-black {
                background: #6041a8;
	border-radius: 8px 8px 0 0;
}
            button#loginBtn {
	width: 100%;
	font-size: 20px;
	text-transform: uppercase;
	border: 0;
    background: #ad3eb7;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	  font-weight: 500;
}
        .logo-admin img {
	max-width: 280px;
	margin-bottom: 20px;
	margin-top: 20px;
}
        h5.page-heading {
	font-size: 24px;
	text-transform: uppercase;
	color: #fff;
	font-weight: bold;
	padding: 7px 0 10px;
    background: #ad3eb7;
}
.form-group.has-feedback.mb-0 label {
	font-weight: 700;
}
        .forgot-pw a {
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 6px;
            display: inline-block;
        }
        input.form-control {
            border-radius: 30px;
        }
        #eyeIcon {
            color: #9239a6;
}

.toggle {
  background: none;
  border: none;
  color: #337ab7;
  /*display: none;*/
  /*font-size: .9em;*/
  font-weight: 600;
  /*padding: .5em;*/
  position: absolute;
  right: .75em;
  
  z-index: 9;
}
button#btnToggle {
    position: absolute;
    top: 35px;
}
   .account-pages.aos-init.aos-animate {
	min-height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
	overflow: hidden;
    padding: 30px 0;
}
.text-center.max {
	padding-top: 1rem;
	background: #6041a8;
	color: #fff;
	border-radius: 0 0 8px 8px;
	font-size:16px;
}
.forgot-pw.text-right {
	font-weight: 700;
}
.text-info {
    color: #ea00ff!important;
}
a.text-info:focus, a.text-info:hover {
    color: #ea00ff!important;
}
.button {
    color: #ea00ff;
}
.button:hover {
    color: #ea00ff;
}
@media (max-width:425px) {
	.logo-admin img {
    max-width: 150px;
}
}
    </style>

</head>


<body>

    <div class="account-pages" data-aos="zoom-in">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">
                        <div class="bg-black">
                            <div class="text-primary text-center">
                                <a href="#" class="logo logo-admin">
                                   <img src="<?php echo base_url(logo); ?>" alt="logo">
                                </a>
                                <h5 class="page-heading ">Welcome Back !</h5>
                                <p class="text-white font-size-16">Sign in to continue to <?php echo title; ?></p>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="">
                                <div class="panel panel-primary">

                <p style="color:red;text-align: center;"><?php echo $message; ?></p>
                <?php echo form_open(base_url('Dashboard/User/MainLogin'), array('id' => 'loginForm')); ?>
                <form id="loginForm" method="post" action="/login.asp?ReturnURL=">
                    <div class="panel-body">
                        <div class="details password-form">

                            <div class="form-group has-feedback mb-0">
                                <label>User ID</label>
                                <div class="row-holder">
                                    <?php
                                    echo form_input(array(
                                        'type' => 'text',
                                        'name' => 'user_id',
                                        'class' => 'form-control',
                                        'required' => 'true',
                                    ));
                                    ?>
                                    <span class="ion ion-log-in form-control-feedback "></span>
                                </div>
                            </div>
                            <div class="form-group has-feedback mb-0 position-relative">
                                <label>Password</label>
                                <div class="row-holder">
                                    <?php
                                    echo form_input(array(
                                        'type' => 'password',
                                        'name' => 'password',
                                        'class' => 'form-control',
                                        'required' => 'true',
                                        'id' => 'txtPassword',
                                    ));
                                    ?>
                                       <!-- <div class="input-group"> -->
                                        <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                                      <!-- </div> -->
                                    <span class="ion ion-log-in form-control-feedback "></span>
                                </div>
                            </div>
                            <div class="forgot-pw text-right">
                                <a href="<?php echo base_url('Dashboard/forgot_password'); ?>">Forgot Password</a>
                            </div>
                            <div class="form-group has-feedback mb-0">
                                <button id="loginBtn" type="submit" class="btn btn-info btn-block margin-top-10" name="Submit" value="Login">Sign in </button>
                            </div>
                           
                        </div>
                    </div>
                </form>
            </div>
					</div>

                            </div>
                          

              <div class="text-center max">
                        <p>Don't have an account?<a href="<?php echo base_url('Dashboard/Register');?>" class="font-weight-medium button m-l-5"> Sign up</a></p>
                    </div>

</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>
     <script src="<?php echo base_url('NewDashboard/') ?>assets/js/aos.js"></script>

    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>
    <script>
						$(document).on('blur', '#sponser_id', function () {
								check_sponser();
						})
						function check_sponser() {
								var user_id = $('#sponser_id').val();
								if (user_id != '') {
										var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
										$.get(url, function (res) {
												$('#errorMessage').html(res);
										})
								}
						}
						check_sponser();
						$(document).on('submit', '#RegisterForm', function () {
								if (confirm('Please Check All The Fields Before Submit')) {
										yourformelement.submit();
								} else {
										return false;
								}
						})
				</script>
                    <script>
      AOS.init({
        duration:1200,
        easing: 'ease-in-out-sine'

      });


      let passwordInput = document.getElementById('txtPassword'),
    toggle = document.getElementById('btnToggle'),
    icon =  document.getElementById('eyeIcon');

function togglePassword() {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    icon.classList.add("fa-eye-slash");
    //toggle.innerHTML = 'hide';
  } else {
    passwordInput.type = 'password';
    icon.classList.remove("fa-eye-slash");
    //toggle.innerHTML = 'show';
  }
}

function checkInput() {
}

toggle.addEventListener('click', togglePassword, false);
passwordInput.addEventListener('keyup', checkInput, false);
    </script>
</body>
</html>
