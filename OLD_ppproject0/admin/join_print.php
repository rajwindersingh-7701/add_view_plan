<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin Website  - Invoice</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

 <script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
	</script>

<script>function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "user.xls"); // Choose the file name
  return false;
}</script></head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Joining Invoice</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <button onclick="printDiv('printMe')"><i class="fa fa-print fa-fw"></i> Print Invoice </button>
                <div id='printMe'>
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                    <table class="table table-bordered table-striped">
                    <?php $us=mysqli_query($con,"select * from user where loginid='".$_GET['us_id']."'");
									   $us_r=mysqli_fetch_array($us);
									   $pn=mysqli_query($con,"select * from pin_list where use_for='".$_GET['us_id']."'");
									          $pn_r=mysqli_fetch_array($pn);
									   ?>
                    <tr><th colspan="8"><center><h3>Super Digital Coin Private Limited</h3></center></th></tr>
                    <tr><th colspan="4">Invoice No. 000<?php $bl=mysqli_query($con,"select * from j_bill where user_id='".$_GET['us_id']."'");
					$bl_r=mysqli_fetch_array($bl);
					 echo $bl_r['id'];?></th>
                    <th colspan="4">Invoice Date: <?php echo $pn_r['use_date'];?></th>
                    </tr>
                    <tr><th colspan="8">GST No.: 06ABDCS7868R1ZA</th></tr>
                    <tr><td colspan="4"><b>Address:</b> <?php $ad=mysqli_query($con,"select * from contact where id='1'");
					$ad_r=mysqli_fetch_array($ad);
					 echo $ad_r['address'];?></td>
                    <td colspan="4">Mobile Number: <?php echo  $ad_r['mobile'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Invoice Name:</b></center></th>
                    <td colspan="5"><?php echo $us_r['name'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Father Name:</b></center></th>
                    <td colspan="5"><?php echo $us_r['f_name'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Mobile Number:</b></center></th>
                    <td colspan="5"><?php echo $us_r['mobile'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Address:</b></center></th>
                    <td colspan="5"><?php echo $us_r['address'];?></td>
                    </tr>
    <tr>
                                	<th>S.n.</th>
                                    <th>Product Name</th>
                                    <th>HSN Code</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>GST</th>
                                    <th colspan="2">Total Amount</th>
                                    
                                </tr>
                                
                                       <?php $us=mysqli_query($con,"select * from user where loginid='".$_GET['us_id']."'");
									   $us_r=mysqli_fetch_array($us);
									   if($us_r['status']=='Active'){
										   $pn=mysqli_query($con,"select * from pin_list where use_for='".$_GET['us_id']."'");
									          $pn_r=mysqli_fetch_array($pn);
											  if($pn_r['pintype']=='300'){
									   ?> 
                                       <td>S.n.</td>
                                    <td>Sanitary Pads</td>
                                    <td>96190010</td>
                                    <td><?php if($pn_r['pintype']=='300'){ echo '2'; }else{ echo '4'; }?></td>
                                    <td>300</td>
                                    <td><?php 
											  echo $pn_r['pintype']*2;
									?></td>
                                    <td>0</td>
                                    <td><?php echo $pn_r['pintype'];?></td>
                                    
                                     <tr><th colspan="7">Amount:</th>
                    <th >Rs. <?php echo $pn_r['pintype']*2;?>.00/-</th>
                    </tr>
                    <tr><th colspan="7">Discount:</th>
                    <th >- <?php echo $pn_r['pintype'];?>.00/-</th>
                    </tr>
                    <?php if($us_r['state']=='Haryana'){?>
                     <tr><th colspan="7">CGST Amount:</th>
                    <th >Rs. 00.00/-</th>
                    </tr>
                    <tr><th colspan="7">SGST Amount:</th>
                    <th >Rs. 00.00/-</th>
                    </tr><?php }else{?>
                    <tr><th colspan="7">IGST Amount:</th>
                    <th >Rs. 00.00/-</th>
                    </tr>
                    <?php }?>
                                    <tr><th colspan="7">Total Amount:</th>
                    <th >Rs. <?php echo $pn_r['pintype'];?>.00/-</th>
                    </tr>
                                   <?php }elseif($pn_r['pintype']=='600'){?>
                    <td>1</td>
                                    <td>Sanitary Pads</td>
                                    <td>96190010</td>
                                    <td>1</td>
                                    <td>150</td>
                                    <td>150</td>
                                    <td>0</td>
                                    <td>150</td>
                                    </tr>
                                    <tr>
                                    <td>2</td>
                                    <td>Alovera Juice</td>
                                    <td>33049990</td>
                                    <td>1</td>
                                    <td>300</td>
                                    <td>267.86</td>
                                    <td>32.14</td>
                                    <td>300</td>
                                    </tr>
                                    <tr>
                                    <td>3</td>
                                    <td>Toilet Cleaner</td>
                                    <td>960500</td>
                                    <td>1</td>
                                    <td>70</td>
                                    <td>59.32</td>
                                    <td>10.68</td>
                                    <td>70</td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                    <td>Haldi Powder</td>
                                    <td>09103010</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                    <tr>
                                    <td>5</td>
                                    <td>Mirchi Powder</td>
                                    <td>09042020</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                     <tr><th colspan="5">Amount:</th>
                                     <th >Rs. 553.38/-</th>
                                     <th >Rs. 46.62/-</th>
                    <th >Rs. 600.00/-</th>
                    </tr>
                    <tr><th colspan="7">Discount:</th>
                    <th >- 000.00/-</th>
                    </tr>
                    <?php if($us_r['state']=='Haryana'){?>
                     <tr><th colspan="7">CGST Amount:</th>
                    <th>Rs. 23.31/-</th>
                    </tr>
                    <tr><th colspan="7">SGST Amount:</th>
                    <th>Rs. 23.31/-</th>
                    </tr><?php }else{?>
                    <tr><th colspan="7">IGST Amount:</th>
                    <th >Rs. 46.62/-</th>
                    </tr>
                    <?php }?>
                                    <tr><th colspan="6">Total Amount:</th>
                    <th colspan="2">Rs. <?php echo $pn_r['pintype'];?>.00/-</th>
                    </tr>
					<?php }elseif($pn_r['pintype']=='700'){?>
                    <td>1</td>
                                    <td>Sanitary Pads</td>
                                    <td>96190010</td>
                                    <td>3</td>
                                    <td>150</td>
                                    <td>150</td>
                                    <td>0</td>
                                    <td>450</td>
                                    </tr>
                                    <tr>
                                    
                                    <td>2</td>
                                    <td>Toilet Cleaner</td>
                                    <td>960500</td>
                                    <td>1</td>
                                    <td>70</td>
                                    <td>59.32</td>
                                    <td>10.68</td>
                                    <td>70</td>
                                    </tr>
                                    <tr>
                                    <td>3</td>
                                    <td>Haldi Powder</td>
                                    <td>09103010</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                    <td>Mirchi Powder</td>
                                    <td>09042020</td>
                                    <td>1</td>
                                    <td>55</td>
                                    <td>52.38</td>
                                    <td>2.62</td>
                                    <td>55</td>
                                    </tr>
                                    <td>5</td>
                                    <td>Dhaniya Powder</td>
                                    <td>09103010</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                    <tr>
                                    <td>6</td>
                                    <td>Jeera</td>
                                    <td>09042020</td>
                                    <td>1</td>
                                    <td>45</td>
                                    <td>42.86</td>
                                    <td>2.14</td>
                                    <td>45</td>
                                    </tr>
                                     <tr><th colspan="5">Amount:</th>
                                     <th >Rs. 680.66/-</th>
                                     <th >Rs. 19.34/-</th>
                    <th >Rs. 700.00/-</th>
                    </tr>
                    <tr><th colspan="7">Discount:</th>
                    <th >- 000.00/-</th>
                    </tr>
                    <?php if($us_r['state']=='Haryana'){?>
                     <tr><th colspan="7">CGST Amount:</th>
                    <th>Rs. 09.67/-</th>
                    </tr>
                    <tr><th colspan="7">SGST Amount:</th>
                    <th>Rs. 09.67/-</th>
                    </tr><?php }else{?>
                    <tr><th colspan="7">IGST Amount:</th>
                    <th >Rs. 19.34/-</th>
                    </tr>
                    <?php }?>
                                    <tr><th colspan="6">Total Amount:</th>
                    <th colspan="2">Rs. <?php echo $pn_r['pintype'];?>.00/-</th>
                    </tr>
					<?php }elseif($pn_r['pintype']=='650'){?>
                    <td>1</td>
                                    <td>Sanitary Pads</td>
                                    <td>96190010</td>
                                    <td>1</td>
                                    <td>150</td>
                                    <td>150</td>
                                    <td>0</td>
                                    <td>150</td>
                                    </tr>
                                    <tr>
                                    <td>2</td>
                                    <td>Alovera Juice</td>
                                    <td>33049990</td>
                                    <td>1</td>
                                    <td>350</td>
                                    <td>312.50</td>
                                    <td>37.50</td>
                                    <td>350</td>
                                    </tr>
                                    <tr>
                                    <td>3</td>
                                    <td>Toilet Cleaner</td>
                                    <td>960500</td>
                                    <td>1</td>
                                    <td>70</td>
                                    <td>59.32</td>
                                    <td>10.68</td>
                                    <td>70</td>
                                    </tr>
                                    <tr>
                                    <td>4</td>
                                    <td>Haldi Powder</td>
                                    <td>09103010</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                    <tr>
                                    <td>5</td>
                                    <td>Mirchi Powder</td>
                                    <td>09042020</td>
                                    <td>1</td>
                                    <td>40</td>
                                    <td>38.10</td>
                                    <td>1.90</td>
                                    <td>40</td>
                                    </tr>
                                     <tr><th colspan="5">Amount:</th>
                                     <th >Rs. 598.02/-</th>
                                     <th >Rs. 51.98/-</th>
                    <th >Rs. 650.00/-</th>
                    </tr>
                    <tr><th colspan="7">Discount:</th>
                    <th >- 000.00/-</th>
                    </tr>
                    <?php if($us_r['state']=='Haryana'){?>
                     <tr><th colspan="7">CGST Amount:</th>
                    <th>Rs. 25.99/-</th>
                    </tr>
                    <tr><th colspan="7">SGST Amount:</th>
                    <th>Rs. 25.99/-</th>
                    </tr><?php }else{?>
                    <tr><th colspan="7">IGST Amount:</th>
                    <th >Rs. 51.98/-</th>
                    </tr>
                    <?php }?>
                                    <tr><th colspan="6">Total Amount:</th>
                    <th colspan="2">Rs. <?php echo $pn_r['pintype'];?>.00/-</th>
                    </tr>
                                    <?php }else{?>
                                    	<tr>
                                        	<td colspan="8">Sorry no data found</td>
                                        </tr><?php }}?>
                                   
                            </table>
                        	
                        </div>
                    </div></div>
                </div><!--/.row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
