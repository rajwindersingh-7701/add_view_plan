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
                        <h1 class="page-header">GST Report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	
     <form action="bill_print.php" target="_blank" method="post"><table width="100%">
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
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Bill No.</th>
                                    <th>Amount</th>
                                    <th>GST</th>
                                    <th>Bill Date</th>
                                    <th>Download Bill</th>
                                </tr>
                                <?php $bl=mysqli_query($con,"select * from user where status='Active' order by ex_date");
								$i=0;
								while($bl_r=mysqli_fetch_array($bl)){
								$i++;
								?>
                                    	<tr>
                                        	<td><?php echo $i;?></td>
                                            <td><?php echo $lg=$bl_r['loginid'];?></td>
                                            <td><?php echo $bl_r['name'];?> / <?php echo $bl_r['mobile'];?></td>   
                                            <td>000<?php $bll=mysqli_query($con,"select * from j_bill where user_id='".$bl_r['loginid']."'");
											$bll_r=mysqli_fetch_array($bll);
											 echo $bll_r['id'];?></td>
                                            <td><?php $pn=mysqli_query($con,"select * from pin_list where use_for='$lg'");
											$pn_r=mysqli_fetch_array($pn);
											
											echo  $pn_r['pintype'];?></td>
                                            <td><?php if($pn_r['pintype']=='300'){?>00.00/-
											    <?php }elseif($pn_r['pintype']=='600'){?>46.62/-
                                                <?php }elseif($pn_r['pintype']=='650'){?>51.98/-
												<?php }elseif($pn_r['pintype']=='700'){?>19.34/-
												<?php }?>
                                                </td>
                                            <td><?php echo $bl_r['act_date'];?></td>
                                            <td><a href="join_print.php?us_id=<?php echo $bl_r['loginid'];?>">Download</a></td>
                                            </tr>
                                    <?php }?>
                            </table>
                                    <tr><td colspan="4">Grand Total</td>
                                    <td><?php $pn1=mysqli_query($con,"select sum(pintype) from pin_list ");
											$pn_r1=mysqli_fetch_array($pn1);
											
											echo  $tp=$pn_r1['0'];?></td>
                                            <td colspan="3" style="float:left">00.00</td>
                                    </tr>
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
