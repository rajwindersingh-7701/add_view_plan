
<?php include_once 'header.php'; ?>

<style>
.main-body{
	text-align: center;
	border: 2px #000 solid;
	padding: 40px 0;
    margin-top: 105px;
}
.main-body h2{
	border-bottom: 2px #000 solid;
	display: inline;
	font-weight: bold;

}

.letter-body {
    width:70%;
    text-align:left;
    margin: 0px auto;
    margin-top: 30px;
}
.letter-body span {
    display: block;
    margin-top: 20px;
    font-size: 18px;
}
.letter-body h5{
	font-size: 20px;
	font-weight: 600;
	margin-top: 25px;
}
.letter-body p{
	font-size: 16px;
	line-height: 35px;
	font-weight: normal;
	margin-top: 20px;
}
.letter-body-footer h6{
	font-weight: normal;
	font-size: 20px;
}
img.welcome-logo {
    margin-right: 40px;
    max-width: 150px;
}
@media screen and (max-width:767px){
	.letter-body {
    width:95%;
}

}
.welcome-letter-img img {
    width: 200px;
    height: 200px;
}
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}

</style>


<div class="container">
	<div class="row" id="printarea">
		<div class="col-xl-12 main-body">
			<h2>Business Welcome Letter</h2>
			<div class="letter-body">
				<div class="row">
					<div class="col-md-6">
					<span>To:<?php echo strtoupper($userData['name']);?><br>
					User ID :<?php echo strtoupper($userData['user_id']);?><br>
					Moible :<?php echo strtoupper($userData['phone']);?><br>
					Address :<?php echo strtoupper($userData['address']);?><br>
					Package :<?php echo strtoupper($userData['package_amount']);?></span>
				</div>
				<div class="col-md-6 welcome-letter-img text-right">
          <?php if(!empty($userinfo['profile_image'])){?>
					  <img style="max-width:150px; border:4px #fff solid" src="<?php echo base_url('uploads/'.$userinfo['profile_image']);?>" clas="img-fluid">
          <?php } else{ ?>
            <a href="<?php echo base_url('Dashboard/Profile');?>" class="btn btn-danger">Upload Profile Image</a>
          <?php } ?>
				</div>
				</div>
				<span>From:<?php echo title;?></span>
				<h5>Subject:</h5>
				<span>Dear: <b><?php echo $userData['name'];?><b></span>
				<p>Company ,would like to inform you Have purchase the product by <?php  echo title;?> Marketing. It is a tremendous Honor to be able to work with an experience company such as yours.</p>
				<p>We are aware you that you are capable of guite innovative sales strategies and would like you to handle that. We would also like to remind you that the agreed upon budget still needs to be Product Followed. Everything mentioned in the contract.</p>
				<p>In case of queries feel free to contact <?php  echo title;?> we look forward to a fruitful business partnership with Company</P>
					<p><b>Note: You have paid Rs.<?php echo strtoupper($userData['package_amount']);?> for product thuse amount are non refundable and company has provide the product.</b></p>
			<div class="letter-body-footer">
			<h6>Sincerely</h6>
			<span><b><?php  echo title;?> </b></span>

		</div>
	</div>
  <div class="signaure text-right">
    <?php if(!empty($userinfo['signature'])){?>
      <!-- <canvas id="sig-canvas">	 -->
        <img src="<?php echo base_url('uploads/'.$userinfo['signature']);?>" clas="img-fluid" style="width:200px;">
    <?php } else{ ?>
      <a href="<?php echo base_url('Dashboard/Profile');?>" class="btn btn-danger">Upload Image</a>
    <?php } ?>
  </div>
  <?php if(!empty($userinfo['profile_image'])){?>
	  <button target="_blank" id="btnp" class="btn btn-default" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
  <?php } else { ?>
    <button type="button" class="btn btn-danger">Upload Profile Image </button>
  <?php } ?>
	<img src="<?php echo base_url(logo);?>" class="welcome-logo" style="max-width:150px;float:right;">
</div>







<?php include_once 'footer.php'; ?>

<script>
function pageprint(){
	var divToPrint=document.getElementById('printarea');
  	var newWin=window.open('','Print-Window');
  	newWin.document.open();
  	newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  	newWin.document.close();
  	setTimeout(function(){newWin.close();},10);

	//$("#printarea").print();
  	//window.print() ;
}
</script>
