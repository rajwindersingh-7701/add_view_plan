<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_GET['uid'])){
	
	mysqli_query($con,"update req_payment set status='Success' where id='".$_GET['uid']."'");
	
	echo '<script>alert("Payment successfully added.");window.location.assign("req_pay.php");</script>';	
}
if(isset($_GET['cid'])){
	
	mysqli_query($con,"update req_payment set status='Pending' where id='".$_GET['cid']."'");
	
	echo '<script>alert("Payment successfully Cancel.");window.location.assign("req_pay.php");</script>';	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Super Digital Coin - GST Report</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     
</head>
<body>
 <div id="wrapper">
 <?php include('php-includes/menu.php'); ?>
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Re-Purchase GST Report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	
     <form action="rebill_print.php" target="_blank" method="post"><table width="100%">
                            <tr><td> From Date:
                            <input type="date" name="fromdate" class="form-control" style="width:90%"></td>
                            <td> To Date:
                            <input type="date" name="todate" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:90%"></td>
                           </tr> </table></form><br>
						   
						   
                           
                           <table class="table table-bordered table-striped" id="tblCustomers">
                            	
                                
    <tr>
                                	<th>S.n.</th>
                                    <th>User ID</th>
                                    <th>Invoice Name</th>
                                    <th>Mobile NO</th>
                                    
                                    <th>Amount</th>
                                    <th>GST</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                                
                                       <?php 
									   $i=0;
									   $uss=mysqli_query($con,"select distinct(orderno) from product_bill where  product_status='Delivered'");
									   while($uss_r=mysqli_fetch_array($uss)){
										   $us=mysqli_query($con,"select * from product_bill where  orderno='".$uss_r['orderno']."'");
									   $us_r=mysqli_fetch_array($us);
									   $ru=mysqli_query($con,"select * from user where id='".$us_r['user_id']."'");
									   $ru_r=mysqli_fetch_array($ru);
									   $i++;
									   ?> 
                                       <th><?php echo $i;?></td>
                                       <td><?php echo $ru_r['loginid'];?></td>
                                       <td><?php echo $ru_r['name'];?></td>
                                       <td><?php echo $ru_r['mobile'];?></td>
                                    
                                    <td><?php $pr=mysqli_query($con,"select sum(tp_price) from product_bill where  product_status='Delivered'");
									          $pr_r=mysqli_fetch_array($pr);
											  echo $tpr=round($pr_r['0'],2);
									?></td>
                                    <td><?php $gstr=mysqli_query($con,"select sum(tp_gst) from product_bill where  product_status='Delivered'");
									          $gst_r=mysqli_fetch_array($gstr);
											  echo $gst=$gst_r['0'];
									?></td>
                                    <td><?php echo $tpr+$gst;?></td>
                                    <td><a href="re_print.php?Bill=<?php echo $us_r['orderno'];?>">View Bill</a></td></th>
                                   
                                        </tr><?php }?>
                                   
                            </table>
                           
                        </div><!--/.table-responsive-->
                    </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('tblCustomers'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 490,
							
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("gst.pdf");
                }
            });
        }
    </script>
</body>

</html>
