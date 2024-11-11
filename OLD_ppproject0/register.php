<?php include("connect.php");
if(isset($_POST['submit'])){
	$ld1 = rand(100000,999999);
	$nm='SDC';
    $loginid=$nm.$ld1;
	$name = mysqli_real_escape_string($con,$_POST['name']);
	$mob = mysqli_real_escape_string($con,$_POST['mob']);
	$password = mysqli_real_escape_string($con,$_POST['password']);
	$emails = mysqli_real_escape_string($con,$_POST['email']);
	$sponser_id = mysqli_real_escape_string($con,$_POST['sponser_id']);
	$c_pass=mysqli_real_escape_string($con,$_POST['c_pass']);
	
	$lvl1=$sponser_id;
	$lv2=mysqli_query($con,"select * from user where loginid='$lvl1'");
	$lv_r2=mysqli_fetch_array($lv2);
	$lvl2=$lv_r2['sponser_id'];
	$lv3=mysqli_query($con,"select * from user where loginid='$lvl2'");
	$lv_r3=mysqli_fetch_array($lv3);
	$lvl3=$lv_r3['sponser_id'];
	$lv4=mysqli_query($con,"select * from user where loginid='$lvl3'");
	$lv_r4=mysqli_fetch_array($lv4);
	$lvl4=$lv_r4['sponser_id'];
	$lv5=mysqli_query($con,"select * from user where loginid='$lvl4'");
	$lv_r5=mysqli_fetch_array($lv5);
	$lvl5=$lv_r5['sponser_id'];
	$lv6=mysqli_query($con,"select * from user where loginid='$lvl5'");
	$lv_r6=mysqli_fetch_array($lv6);
	$lvl6=$lv_r6['sponser_id'];
	$lv7=mysqli_query($con,"select * from user where loginid='$lvl6'");
	$lv_r7=mysqli_fetch_array($lv7);
	$lvl7=$lv_r7['sponser_id'];
	$lv8=mysqli_query($con,"select * from user where loginid='$lvl7'");
	$lv_r8=mysqli_fetch_array($lv8);
	$lvl8=$lv_r8['sponser_id'];
	$lv9=mysqli_query($con,"select * from user where loginid='$lvl8'");
	$lv_r9=mysqli_fetch_array($lv9);
	$lvl9=$lv_r9['sponser_id'];
	$lv10=mysqli_query($con,"select * from user where loginid='$lvl9'");
	$lv_r10=mysqli_fetch_array($lv10);
	$lvl10=$lv_r10['sponser_id'];
	
	if($password==$c_pass){
		mysqli_query($con,"INSERT INTO `user`(`loginid`, `name`, `mob`, `email`, `sponser_id`, `r_date`, `password`) VALUES ('$loginid','$name','$mob','$emails','$sponser_id',NOW(),'$password')");
		//mysqli_query($con,"INSERT INTO `sdc_income`(`userid`, `amount`,`r_date`) VALUES ('$loginid','1000',NOW())");
		 mysqli_query($con,"INSERT INTO `daily_pay`(`userid`,`name`) VALUES ('".$loginid."','".$name."')");
		if($lvl1!=''){
		mysqli_query($con,"INSERT INTO `lvl1`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl1','$sponser_id')");}
		if($lvl2!=''){
		mysqli_query($con,"INSERT INTO `lvl2`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl2','$sponser_id')");}
		if($lvl3!=''){
		mysqli_query($con,"INSERT INTO `lvl3`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl3','$sponser_id')");}
		if($lvl4!=''){
		mysqli_query($con,"INSERT INTO `lvl4`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl4','$sponser_id')");}
		if($lvl5!=''){
		mysqli_query($con,"INSERT INTO `lvl5`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl5','$sponser_id')");}
		if($lvl6!=''){
		mysqli_query($con,"INSERT INTO `lvl6`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl6','$sponser_id')");}
		if($lvl7!=''){
		mysqli_query($con,"INSERT INTO `lvl7`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl7','$sponser_id')");}
		if($lvl8!=''){
		mysqli_query($con,"INSERT INTO `lvl8`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl8','$sponser_id')");}
		if($lvl9!=''){
		mysqli_query($con,"INSERT INTO `lvl9`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl9','$sponser_id')");}
		if($lvl10!=''){
		mysqli_query($con,"INSERT INTO `lvl10`(`userid`, `lvl`, `sid`) VALUES ('$loginid','$lvl10','$sponser_id')");}
$to = $emails;
$subject = "SDC Registration";

$htmlContent = '
<html>
<body>
    <center><h3>Dear '.$name.' </h3><br>
	<b>Your are registred successfully.</b><br>
	<b>Your Login Detail:</b><br><br>
	<table border="1" width="50%" ><tr><th style="background: #157b8c;color: #fff;padding: 10px;font-size: 20px;font-family: -webkit-pictograph;"> Login Id:</th>
	 <th style="background: #f4973e;color: #fff;padding: 10px;font-size: 20px;font-family: -webkit-pictograph;">'.$loginid.'</th></tr>
	<tr><th style="background: #157b8c;color: #fff;padding: 10px;font-size: 20px;font-family: -webkit-pictograph;"> Password:</th>
	 <th style="background: #f4973e;color: #fff;padding: 10px;font-size: 20px;font-family: -webkit-pictograph;">'.$password.'</th></tr>
	</table><br><br>
	
    
	<b>For any query contact us on official mail as info@superdigitalcoin.com</b>
	<br></center>
	<h2>Thank You!</h2>
	<br><br>
	<h3>Regards</h3><br>
	<b>Super Ditial Coin Support Team</b><br>
	
</body>
</html>';

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= 'From: SDC<info@superdigitalcoin.com>' . "\r\n";
$headers .= 'Cc: info@superdigitalcoin.com' . "\r\n";
$headers .= 'Bcc: info@superdigitalcoin.com' . "\r\n";

// Send email
mail($to,$subject,$htmlContent,$headers);
       header('location:welcome.php?name='.$name.'&&loginid='.$loginid.'&&password='.$password.'');
		echo '<script>alert("Registration success.Dear '.$name.' Your Login ID:'.$loginid.' and Password:'.$password.'.");window.location.assign("login.php");</script>';
	}else{
		echo '<script>alert("Registration Error... Password Not Match. Try Again");window.location.assign("register.php");</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Super Digital Coin </title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />


<link rel="icon" href="web/assets/images/favicon.html" type="image/x-icon">
<link rel="stylesheet" href="../stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<link rel="stylesheet" type="text/css" href="web/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="web/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="web/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="web/assets/css/style.css">


<link rel="stylesheet" href="web/assets/pages/chart/radial/css/radial.css" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="web/assets/icon/feather/css/feather.css">

<link rel="stylesheet" type="text/css" href="web/assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" type="text/css" href="../cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link href="../cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.toggle-input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
  cursor: pointer;
}

.toggle-icon {
  padding: 10px;
  background: #f1e182;
  color: black;
  min-width: 50px;
  text-align: center;
}

.blink_me {
  animation: blinker 2s linear infinite;
}

@keyframes  blinker {
  50% {
    opacity: 0;
  }
}
.loading {
    background: url(../www.xiconeditor.com/image/icons/loading.gif) no-repeat right center;
}
    </style>
    <script language="javascript">
function usernamedetail(str)
{

var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
    document.getElementById("username").innerHTML=xmlhttp.responseText;
	
    }
  }
xmlhttp.open("GET","usernamedetail1.php?str="+str,true);
xmlhttp.send();

  }
  </script>
</head>
<body class="fix-menu">
<div class="theme-loader">
<div class="ball-scale">
<div class='contain'>
<div class="ring"><div class="frame"></div></div>
</div>
</div>
</div>

<section class="login-block">

<div class="container">
<div class="row">
<div class="col-sm-12">

    <form class="md-float-material form-material" autocomplete="off" aria-autocomplete="none" role="form" method="POST" action="" id="frmRegister">
        <input type="hidden" name="_token" value="EEel5YyoIQLq1FFDkxaYt9Vr0ubiF13M5KtzJpY0">
        <div class="auth-box card">
        <div class="card-block">
          <div class="text-center">
            <img src="website/img/logo.png" style="width:159px;" alt="logo.png">
            </div>
        <div class="row m-b-20">
        <div class="col-md-12">
        <h3 class="text-center txt-primary">Sign up</h3>
                  </div>
        </div>
                <div class="form-group">
        <label class="form-control-label" for="input-username">Sponsar ID :</label>
          <div class="">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
            </div><?php if($_GET['sponser']!=''){?>
            <input  style='text-transform:uppercase'  value="<?php echo $_GET['sponser'];?>" readonly  id="under_userid"  class="form-control "  value="" name="sponser_id" placeholder="Sponsar Id" required minlength="9" maxlength="9" type="text" style="color:black;font-weight: 600;">
            <?php }else{?>
            <input  style='text-transform:uppercase'  onblur="usernamedetail(this.value)"   id="under_userid"  class="form-control "  value="" name="sponser_id" placeholder="Sponsar Id" required minlength="9" maxlength="9" type="text" style="color:black;font-weight: 600;"><?php }?>
                      </div>

           <div id="username"></div>
        </div>

      <div class="form-group">
        <label class="form-control-label" for="input-username">Name :</label>
        <div class="">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
          </div>
          <input  class="form-control  " value="" placeholder="Name"  name="name" type="text" required style="text-transform:uppercase;color:black;font-weight: 600;" >
                </div>
      </div>
      <div class="form-group">
        <label class="form-control-label" for="input-username">Email :</label>
        <div class="">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
          </div>
          <input class="form-control  " value="" placeholder="Enter Email"  name="email" type="email" required style="color:black;font-weight: 600;" >
                </div>
      </div>
      
      <div class="form-group">
        <label class="form-control-label" for="input-username">Mobile :</label>
          <div class="">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-email-83"></i></span>
            </div>
            <input class="form-control  " value="" placeholder="Mobile" name="mob" required minlength="10" maxlength="10"  type="number" style="color:black;font-weight: 600;">
                      </div>
        </div>
        
      <div class="form-group">
        <label class="form-control-label" for="input-username">Password :</label>
        <div class="">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
          </div>
          <div class="toggle-input-container">
          <input class="passwordToggle form-control " value="" required minlength="6" maxlength="50" placeholder="Password" name="password" type="password" style="color:black;font-weight: 600;">
           <i class="fa fa-eye toggle-icon toggler"></i>
                </div>
      </div>
      </div>
      <div class="form-group">
        <label class="form-control-label" for="input-username">Confirm Password :</label>
          <div class="">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
           <div class="toggle-input-container">
            <input class="passwordToggle form-control " value="" required minlength="6" maxlength="50" placeholder="Confirm Password" name="c_pass" type="password" style="color:black;font-weight: 600;">
              <i class="fa fa-eye toggle-icon toggler"></i>
                  </div>
          </div>
        </div>
      <div class="row my-4">
        <div class="col-12">
          <div class="">
            <input required class="control " name="AgreeTerms" value="" id="customCheckRegister" type="checkbox">
                        <label class="" for="customCheckRegister">
              <span  class="text-muted">I agree with the <a href="javascipt:void(0)" >Privacy Policy</a></span>
            </label>
          </div>
        </div>
        </div>
        <div class="row m-t-1">
        <div class="col-md-12">
        <button type="submit" name="submit" id="btnSignup" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up now</button>
        </div>
        </div>
        <hr>
        <div class="row">
        <div class="col-md-10">
        <p class="text-inverse text-left m-b-0">Already have Account ?.</p>
        <p class="text-inverse text-left"><a href="login.html"><b class="f-w-600">Login Here</b></a></p>
        </div>
        <div class="col-md-2">

        </div>
        </div>
        </div>
        </div>
        </form>

</div>

</div>

</div>

</section>
<script>

    function getSponsar($sponsarid) {
      $('#spid').addClass('loading');
    if($sponsarid.length==8)
    {


       $.ajax({
        url     : 'https://visionmarket.us/sponsar/details',
    method  : 'post',
    data    : {
       sponsarid : $sponsarid,
       _token: "EEel5YyoIQLq1FFDkxaYt9Vr0ubiF13M5KtzJpY0"


    },
    success : function(res){
    if(res==false)
    {
        $('#spid').val("");
        alert('Invalid Sponsar ID');
        $('#spid').removeClass('loading');
         $("#SponsarId").hide();
    }
    else
    {
     $("#SponsarId").show();
        $("#SponsarId").text('Sponsar Name : '+res);
          $('#spid').removeClass('loading');
    }


    }
       });
       }
    }
 </script>

<script type="text/javascript" src="web/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="../cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script>
  $(document).ready(function() {
    $('.dataTable').DataTable( {
        dom: 'Bfrtip',
        pageLength:100,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
    
     $('select').select2();
} );

$(document).ready(function(){
  $("#bloodymodal").modal('toggle');
  
  
  
})

$(".toggler").click(function(e){
    var type = $(".passwordToggle").attr("type"); 
    // now test it's value
    if( type === 'password' ){
      $(".passwordToggle").attr("type", "text");
      $(".toggler").removeClass("fa-eye");
      $(".toggler").addClass("fa-eye-slash");
      
    }else{
      $(".passwordToggle").attr("type", "password");
       
      $(".toggler").removeClass("fa-eye-slash");
      $(".toggler").addClass("fa-eye");
    } 
})

</script>


<script type="text/javascript" src="web/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script src="../cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="web/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="web/bower_components/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="web/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="web/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="web/bower_components/modernizr/js/css-scrollbars.js"></script>

<script type="text/javascript" src="web/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="web/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="web/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="web/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="web/assets/js/common-pages.js"></script>


<script type="text/javascript" src="files/bower_components/chart.js/js/Chart.html"></script>


<script src="web/assets/pages/widget/gauge/gauge.min.js"></script>
<script src="web/assets/pages/widget/amchart/amcharts.js"></script>
<script src="web/assets/pages/widget/amchart/serial.js"></script>
<script src="web/assets/pages/widget/amchart/gauge.js"></script>
<script src="web/assets/pages/widget/amchart/pie.js"></script>
<script src="web/assets/pages/widget/amchart/light.js"></script>

<script src="web/assets/js/pcoded.min.js"></script>
<script src="web/assets/js/vartical-layout.min.js"></script>
<script src="web/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="web/assets/pages/dashboard/crm-dashboard.min.js"></script>
<script type="text/javascript" src="web/assets/js/script.js"></script>



</body>
<script>
$("#frmRegister").submit(function(e){
$("#btnSignup").hide();
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
 
 
    <script  src="function.js"></script>
</html>
