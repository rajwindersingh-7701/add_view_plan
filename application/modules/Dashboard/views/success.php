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
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/aos.css" id="app-style" rel="stylesheet" type="text/css" />

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
	height:100%;
	top: 0;
	content: '';
	opacity: .5;
}
h5.page-heading {
	font-size: 24px;
	text-transform: uppercase;
	color: #fff;
	font-weight: bold;
	padding: 7px 0 10px;
    background: #ad3eb7;
}
.card {
    border-radius: 10px;
}
.bg-black {
			background: #6041a8;
			border-radius: 8px 8px 0 0;
		}
        .account-pages {
            min-height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
	overflow: hidden;
    padding: 30px 0;
        }
         .logo-admin img{
         max-width:280px;
         margin-bottom:20px;
           

         }
         .page-title {
            color: #4caf50;
            font-size: 32px;
        }
        @media (max-width:425px) {
	.logo-admin img {
    max-width: 150px;
}
}
@media (max-width:375px) {
    .button a {
    font-size: 15px;
}
}
    </style>

</head>

<body>

    <div class="account-pages" data-aos="zoom-in">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-black">
                            <div class="text-primary text-center py-4">
                                <a href="#" class="logo logo-admin">
                                    <img src="<?php echo base_url(logo); ?>" alt="logo">
                                </a>
                                <h5 class="page-heading">Welcome Back !</h5>
                            </div>
                        </div>

                        <div class="card-body ">
                            <div class="">
                                <div class="form-wrapper">
                <div class="page-header text-center">

                    <h1 class="page-title">Registration Successfull !</h1>


                    <?php
                    echo'<h5 class="mainboxes" style="margin-top:15px; color:#46afd7">' . $message . '</h5>';
                    ?>
                    <div class="button" style="font-size:20px;font-weight: bold; color:#45aed7; margin-top:20px"><a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"   style="color: white;
                          background: #ad3eb7;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                        padding: 10px 30px;
                        width: 100%;
                        font-weight:normal;
                        border-radius: 4px;
                        display: block;
                        text-transform: uppercase;">Click Here To Login</a></div>

                </div>

            </div>
					</div>

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
    </script>
</body>
</html>
