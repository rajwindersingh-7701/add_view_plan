<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Super Digital Coin </title>


<!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
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

<form method="POST" action="login_cs.php" class="md-float-material form-material" autocomplete="off">
    <input type="hidden" name="_token" value="EEel5YyoIQLq1FFDkxaYt9Vr0ubiF13M5KtzJpY0">
<div class="auth-box card">
<div class="card-block">
    <div class="text-center mb-2">
        <img src="website/img/logo.png" style="width:200px" alt="logo.png">
        </div>
<div class="row m-b-20">
<div class="col-md-12">
<h3 class="text-center">Sign In</h3>
</div>
</div>
<div class="form-group form-primary">
<input type="text" style='text-transform:uppercase' minlength="9" maxlength="9" name="user_id" class="form-control " required placeholder="Your User Id">
<span class="form-bar"></span>
</div>
<div class="form-group form-primary">
     <div class="toggle-input-container">
<input type="password" name="password" class="passwordToggle form-control " required placeholder="Password">
  <i class="fa fa-eye toggle-icon toggler"></i>
</div>
<span class="form-bar"></span>
</div>
<div class="row m-t-25 text-left">
<div class="col-12">
<div class="checkbox-fade fade-in-primary d-">
<label>
<input type="checkbox"  name="remember" id="remember" value="" >
<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
<span class="text-inverse">Remember me</span>
</label>
</div>
<div class="forgot-phone text-right f-right">
<a href="#!" class="text-right f-w-600"> Forgot Password?</a>
</div>
</div>
</div>
<div class="row m-t-30">
<div class="col-md-12">
<button type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
</div>
</div>
<hr />
<div class="row">
<div class="col-md-6">
<p class="text-inverse text-left m-b-0">Need an account ?</p>
<p class="text-inverse text-left"><a href="register.php"><b class="f-w-600">Register from here</b></a></p>
</div>

</div>
</div>
</div>
</form>

</div>

</div>

</div>

</section>

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
</html>
