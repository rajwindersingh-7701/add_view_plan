<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo title;?>" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('uploads/favicon.png');?>">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
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
      height: 100;
      top: 0;
      content: '';
      opacity: .5;
    }
    .card {
    border-radius: 8px;
}
.card-body {
    padding-bottom: 0;
}
    .logo-admin img{
      max-width: 280px;
      margin-bottom: 20px;
    }
    
    .bg-black {
        background: #6041a8;
	border-radius: 8px 8px 0 0;
}
    h5.page-heading {
	font-size: 24px;
	text-transform: uppercase;
	color: #fff;
	font-weight: bold;
	padding: 7px 0 10px;
	/* background-image: linear-gradient(#f45050, #b20909); */
    background: #ad3eb7;
}
    .account-pages {
        min-height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
	overflow: hidden;
    padding: 30px 0;
    }
    .bg-black {
        padding-top: 16px;
    }
    button#signupBtn {
        width: 100%;
	font-size: 20px;
	text-transform: uppercase;
	border: 0;
	
	border-radius: 8px;
	  font-weight: 500;
	  background: #ad3eb7;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}
     input.form-control {
            border-radius: 30px;
        }
        .text-center.max {
            border-radius: 0 0 8px 8px;
	padding-top: 1rem;
	font-size: 16px;
    background: #6041a8;
	color: #fff;
}
.form-group label {
	font-weight: 700;
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
@media (max-width:375px) {
    .password {
    padding: 02px;
}
}
@media (max-width:320px) {
    button#signupBtn {
    font-size: 16px;
    font-weight: 600;
}
}
    </style>
</head>

<body>


    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="bg-black">
                            <div class="text-primary text-center">
                                <a href="#" class="logo logo-admin">
                                    <img src="<?php echo base_url(logo); ?>" alt="logo">
                                </a>
                                <h5 class="page-heading ">Forgot  Password !</h5>
                                <p class="text-white font-size-16 password">Please Enter Your User Id To Reset Your Password!</p>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="">
                               <div class="details password-form">
              <?php echo form_open(base_url('Dashboard/forgot_password/')); ?>
                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
              <div class="panel-body">
                  <div class="details password-form">
                      <fieldset>
                          <div class="form-group">
                              <div class="label-area">
                                  <label>User ID Or Email:</label>
                              </div>
                              <div class="row-holder">
                                  <input id="SiteURL" type='text' name='user_id' maxlength='50' class="form-control"/>
                              </div>
                          </div>
                          <div class="form-group" style="text-align: right;">
                              <button id="signupBtn" type="submit" class="btn btn-primary w-100" name='Submit' value='Login'>Forgot Password  </button>
                          </div>

                      </fieldset>
                  </div>
              </div>
              <?php echo form_close(); ?>



                <!-- <div class="form-group text-center" style="color:#000">
                    Don't have an account? <a href="<?php //echo base_url(); ?>Dashboard/Register" style="color: red;font-weight: 600;">Click Here</a>
                </div> -->
                <!-- <div class="form-group" style="text-align:center;">
                    <center class="text-bold"><p><a style="background: #4CAF50;
color: white;
padding: 10px 20px;
border-radius: 10px;
width: 100%;" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Click Here to Login</a></p></center>
                </div> -->
            </div>
					</div>
                            </div>

                        <div class="text-center max">
                        <p>Already have an account?<a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="font-weight-medium button m-l-5"> Sign in</a></p>
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
</body>

</html>
