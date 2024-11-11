<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?php echo title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="<?php echo title; ?>" name="description" />
	<meta content="<?php echo title; ?>" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('uploads/favicon.png'); ?>">

	<!-- Bootstrap Css -->
	<link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('NewDashboard/') ?>assets/css/aos.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	<style>
		body {
			background: url('https://martechseries.com/wp-content/uploads/2019/08/Why-Your-Digital-Marketing-Strategy-Needs-Instagram-guest-post.jpg');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}

		body::before {
			position: absolute;
			background: #000;
			width: 100%;
			height: 100%;
			top: 0;
			content: '';
			opacity: .5;
		}

		.bg-black {
			background: #A020F0;
		}

		.account-pages {
			position: absolute;
			right: 0;
			left: 0;
			top: 21%;
		}

		.logo-admin img {
			max-width: 280px;
			margin-bottom: 20px;
		}

		h5.page-heading {
			font-size: 24px;
			text-transform: uppercase;
			background: #fe6d03;
			color: #fff;
			font-weight: bold;
			padding: 7px 0 10px;
		}

		.accept {
			padding: 0px 5px 10px;
		}

		button.btn.btn-success {
			width: 100%;
			font-size: 20px;
			text-transform: uppercase;
			background: linear-gradient(197deg, #fe6d03, #a01ff0);
			border: 0;
		}

		input.form-control {
			border-radius: 30px;
		}
	</style>

</head>

<body>

	<!-- <div class="home-btn d-none d-sm-block">
            <a href="index-2.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->
		<?php $r_none = 0; ?>
	<div class="account-pages" data-aos="zoom-in">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-xl-5">
					<div class="card" style="border-radius: 30px;">
						<div class="bg-black">
							<div class="text-primary text-center py-4">
								<a href="#" class="logo logo-admin">
									<img src="<?php echo base_url(logo); ?>" alt="logo">
								</a>
								<h5 class="page-heading">Register</h5>
								<p class="text-white font-size-16">Get your free <?php echo title; ?> account now.</p>
							</div>
						</div>

						<div class="card-body">
							<div class="">
								<div class="form-element">
									<!-- <h5><?php //echo title;   
												?></h5> -->
									<span class="text-danger">
										<?php echo $this->session->flashdata('error'); ?>
									</span>
									<?php if($r_none == 0):?>
										<h3 class="text-danger">This page is on updating...</h3>
									<?php endif;?>

									<?php
									echo form_open('Dashboard/Register/index2?sponser_id=' . $sponser_id);
									//echo form_open('Dashboard/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); 
									?>
									<div class="form-group has-feedback mb-0">
										<label>Enter Sponser ID</label>
										<input type="text" class="form-control" id="sponser_id" value="<?php echo $sponser_id; ?>" name="sponser_id" required>
										<span class="ion ion-locked form-control-feedback "></span>
										<span class="text-danger"> <?php echo form_error('sponser_id'); ?></span>
										<span id="errorMessage" class="text-danger"> </span>
									</div>
									<div class="form-group has-feedback mb-0">
										<div class="form-field">
											<label>Enter Name</label>
											<input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" required>
											<span class="ion ion-locked form-control-feedback "></span>
										</div>
										<span class="text-danger"> <?php echo form_error('name'); ?></span>
									</div>

									<!-- <div class="form-group has-feedback mb-0">
								<div class="form-field">
									<label>PAN Card No.</label>
									<input type="text" class="form-control"  name="pan" value="<?php //echo set_value('pan'); 
																								?>" required>
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
								<span class="text-danger"> <?php //echo form_error('email'); 
															?></span>
							</div> -->

									<div class="form-group has-feedback mb-0">
										<div class="form-field">
											<label>Enter Email</label>
											<input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" required>
											<span class="ion ion-locked form-control-feedback "></span>
										</div>
										<span class="text-danger"> <?php echo form_error('email'); ?></span>
									</div>
									<!-- 	<div class="form-group has-feedback">
								<div class="form-field">
									<input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php //echo set_value('email'); 
																															?>">
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
								<span class="text-danger"> <? php // echo form_error('email'); 
															?></span>
							</div> -->
									<!-- <div class="form-group has-feedback">
								<label for="pwd">Position:</label>
								<div class="form-field">
									<select class="form-control" name="position">
											<?php //if($_GET['position'] == 'R'){ 
											?>
												<option value="R">RIGHT</option>
											<?php //}else if($_GET['position'] == 'L'){
											?>
												<option value="L">LEFT</option>
											<?php //}
											//else {
											// 	echo '<option value="L" selected>LEFT</option>
											// 	<option value="R">RIGHT</option>';
											// } 
											?>
									</select>
								</div>
							</div> -->
									<!-- 	<div class="form-group has-feedback">
								<label for="pwd">Country:</label>
								<div class="form-field">
									<select class="form-control" name="country">
										<?php
										//foreach($countries as $key => $country)
										//echo'<option>'.$country['name'].'</option>';
										?>
									</select>
								</div>
							</div> -->
									<div class="form-group has-feedback mb-0">
										<div class="row">

											<div class="col-md-12 col-xs-12">
												<label>Enter Phone</label>
												<div class="form-field"><input type="phone" class="form-control" name="phone" maxlength="10" value="<?php echo set_value('phone'); ?>" required>
													<span class="ion ion-locked form-control-feedback "></span>
												</div>
											</div>
											<span class="text-danger"> <?php echo form_error('phone'); ?></span>
										</div>
									</div>
									<div class="form-group has-feedback mb-0">
										<div class="row">

											<div class="col-md-12 col-xs-12">
												<label>Password</label>
												<div class="form-field"><input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" required>
													<span class="ion ion-locked form-control-feedback "></span>
												</div>
											</div>
											<span class="text-danger"> <?php echo form_error('password'); ?></span>
										</div>
									</div>
									<div class="accept">
										<span>
											<input id="chTerms" name="chTerms" type="checkbox" required="required">
										</span>&nbsp;
										I have read the <a style="cursor:pointer;color:red; font-size:16px" target="_blank" href="#" target="_blank">Terms &amp; Conditions</a>

									</div>
									<?php //if($r_none > 0):?>
									<div class="form-group has-feedback">
										<button type="submit" class="btn btn-success" onclick="submitCheck()" id="submit">Submit</button>
									</div>
									<?php //endif;?>

									<?php echo form_close(); ?>
									<p style="display:none"><a href="<?php echo base_url('Site/Main/Register'); ?>">REGISTER NOW!</a></p>
								</div>
							</div>
						</div>
						<div class="text-center">
							<p>Already have an account ? <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="font-weight-medium text-primary"> Login </a> </p>
							<!--   <p>© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by fortunesclub</p> -->
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
	<script src="<?php echo base_url('NewDashboard/') ?>assets/js/aos.js"></script>
	<script>
		function submitCheck() {
			//document.getElementById("submit").disabled = true; 
		}



		$(document).on('blur', '#sponser_id', function() {
			check_sponser();
		})

		function check_sponser() {
			var user_id = $('#sponser_id').val();
			if (user_id != '') {
				var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
				$.get(url, function(res) {
					$('#errorMessage').html(res);
				})
			}
		}
		check_sponser();
		// $(document).on('submit', '#RegisterForm', function () {
		// 		if (confirm('Please Check All The Fields Before Submit')) {
		// 				yourformelement.submit();
		// 		} else {
		// 				return false;
		// 		}
		// })
	</script>
	<script>
		AOS.init({
			duration: 900,
			easing: 'ease-in-out-sine'

		});
	</script>
</body>

</html>