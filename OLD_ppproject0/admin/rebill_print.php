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

    <title>Super Digital Coin Website  - Re-Purchase Invoice</title>

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
                        <h1 class="page-header">Re-Purchase Invoice</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                <button onclick="printDiv('printMe')"><i class="fa fa-print fa-fw"></i> Print Invoice </button>
                <div id='printMe'>
                	<div class="col-lg-12">
                    	<div class="table-responsive">
<?php 
$bl=mysqli_query($con,"select * from product_bill where product_bdate between '".$_POST['fromdate']."' and '".$_POST['todate']."' and  product_status='Delivered' order by product_bdate");
						while($bl_r=mysqli_fetch_array($bl)){?>
        <div style="width: 21cm;min-height: 29.7cm;padding: 1cm;margin: 1cm auto;border: 1px #D3D3D3 solid;border-radius: 5px;background: white;box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);"><table class="table table-bordered table-striped" >
                       
                    <tr><th colspan="8"><center><h3>Super Digital Coin Private Limited</h3></center></th></tr>
                    <tr><th colspan="4">Invoice No. REP/000<?php 	 echo $bl_r['id'];?></th>
                    <th colspan="4">Invoice Date: <?php echo $bl_r['product_bdate'];?></th>
                    </tr>
                    <tr><th colspan="8">GST No.: 06ABDCS7868R1ZA</th></tr>
                    <tr><td colspan="4"><b>Address:</b> <?php $ad=mysqli_query($con,"select * from contact where id='1'");
					$ad_r=mysqli_fetch_array($ad);
					 echo $ad_r['address'];?></td>
                    <td colspan="4">Mobile Number: <?php echo  $ad_r['mobile'];?></td>
                    </tr>
                    <?php $bll=mysqli_query($con,"select * from user where id='".$bl_r['user_id']."'");
					$bll_r=mysqli_fetch_array($bll);
					?>
                    <tr><th colspan="3"><center><b>Invoice Name:</b></center></th>
                    <td colspan="5"><?php echo $bll_r['name'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>User ID:</b></center></th>
                    <td colspan="5"><?php echo $bll_r['loginid'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Father Name:</b></center></th>
                    <td colspan="5"><?php echo $bll_r['f_name'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Mobile Number:</b></center></th>
                    <td colspan="5"><?php echo $bll_r['mobile'];?></td>
                    </tr>
                    <tr><th colspan="3"><center><b>Address:</b></center></th>
                    <td colspan="5"><?php echo $bll_r['address'];?></td>
                    </tr>
    
                                
                                      <tr>
                                	<th>S.n.</th>
                                    <th>Product Name</th>
                                    <th>HSN Code</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>GST</th>
                                    <th>Total Amount</th>
                                    
                                </tr>
                                
                                      
                                       <td>1.</td>
                                    <td><?php echo $bl_r['product_name'];?></td>
                                    <td><?php echo $bl_r['product_hsn'];?></td>
                                    <td><?php echo $bl_r['product_qnty'];?></td>
                                    <td><?php echo $bl_r['product_price']/$bl_r['product_qnty']; $gst=$bl_r['product_price']*$bl_r['product_gst']/100;  $amt=$bl_r['product_price']-$gst;?></td>
                                    <td><?php echo $amt;?></td>
                                    <td><?php echo $gst;?></td>
                                    <td><?php echo $bl_r['product_price'];?></td>
                                    </tr>
                                     <tr><th colspan="7">Amount:</th>
                    <th >Rs. <?php echo $bl_r['product_dprice'];?>.00/-</th>
                    </tr>
                    <tr><th colspan="7">Discount:</th>
                    <th >- <?php echo $dp=$bl_r['product_dprice']-$bl_r['product_price'];?>.00/-</th>
                    </tr>
                    <?php if($bll_r['state']=='Haryana'){?>
                     <tr><th colspan="7">CGST Amount:</th>
                    <th>Rs. <?php echo $gst/2;?>.00/-</th>
                    </tr>
                    <tr><th colspan="7">SGST Amount:</th>
                    <th>Rs. <?php echo $gst/2;?>.00/-</th>
                    </tr><?php }else{?>
                    <tr><th colspan="7">IGST Amount:</th>
                    <th >Rs. <?php echo $gst;?>.00/-</th>
                    </tr>
                    <?php }?>
                                    <tr><th colspan="6">Total Amount:</th>
                    <th colspan="2">Rs. <?php echo $bl_r['product_price'];?>.00/-</th>
                    </tr>
                                   
                                   
                            </table></div>
                        	<?php }?>
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
