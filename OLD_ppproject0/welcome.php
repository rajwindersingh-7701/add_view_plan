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

<form method="POST" action="#" class="md-float-material form-material" autocomplete="off">
   
<div class="auth-box card">
<div class="card-block">
    <div class="text-center mb-2">
        <img src="congr.png" style="width:100%" alt="congr.png">
        </div>
<div class="row m-b-20">
<div class="col-md-12">
<h3 class="text-center" style="font-style: italic;color: brown;font-size: 50px;">Mr./Mrs. <br><?php echo $_GET['name'];?></h3>
<p>Congratulation <?php echo $_GET['name'];?> your registration have been successfully with us.</p>
</div>
</div>
<table width="90%">
<tr><th>Member ID:</th>
<th style="color:#066"><?php echo $_GET['loginid'];?></th>
</tr>
<tr><th>Member ID Password:</th>
<th style="color:#066"><?php echo $_GET['password'];?></th>
</tr>
</table><br>
<div class="text-center mb-2">
        <img src="thanks.png" style="width:50%" alt="congr.png">
        </div>
	<div class="col-md-6">

<p class="text-inverse text-left"><a href="login.php"><b class="f-w-600">Login</b></a></p>
</div>
</div>
</div>

<hr />

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
