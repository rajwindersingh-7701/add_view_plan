<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
$date=date('Y-m-d');
$wd=mysqli_query($con,"SELECT count(id) FROM `withdrwal` WHERE user_id='".$_POST['user_id']."' and r_date='$date'");
$wd_r=mysqli_fetch_array($wd);
 $twd=$wd_r['0'];
if(isset($_POST['submit'])&& $twd=='0'){
	mysqli_query($con,"INSERT INTO `withdrwal`(`user_id`, `amount`, `adm_amt`, `f_amt`, `r_date`, `status`,`order_id`, `bank_ac`, `ifsc`) VALUES ('".$_POST['user_id']."','".$_POST['amount']."','".$_POST['adm_amt']."','".$_POST['f_amt']."',NOW(),'".$_POST['status']."','584585','".$_POST['bank_ac']."','".$_POST['ifsc']."')");
	mysqli_query($con,"UPDATE `daily_pay` SET `amount`='0',`adm_amt`='0',`f_amt`='0' WHERE userid='".$_POST['user_id']."'");
	echo '<script>alert("Payout successfully.");window.location.assign("manual_with.php");</script>';	
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
    <title>Super Digital Coin - Withdrwal</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script>function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "export.xls"); // Choose the file name
  return false;
}</script>

</head>
<body>
 <div id="wrapper">
 <?php include('php-includes/menu.php'); ?>
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Withdrwal Request</h1>
						<a href="reject.php" style="float:right">Reject History</a>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                        	<script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body > <h1>Withdrwal List <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script><br><input type="button" value="Print" onclick="printDiv()"> <div id="GFG">
                            <table class="table table-striped table-bordered"  id="table" border="1">
                            	<tr><th colspan="10">Manual Withdrwal </th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    
                                    <th>Userid</th>
                                    <th>Name</th>
                                    <th>Bank Name</th>
                                    <th>Account No.</th>
                                    <th>IFSC Code</th>
                                    <th>Amount</th>
                                    <th>Admin</th>
                                    <th>Paybal Amount</th>
                                    <th>Click To Pay</th>
                                    
                                    
                                    
                                </tr>
                                <?php
									$ws=mysqli_query($con,"select * from daily_pay where status='Active'");
									$i='0';
									while($ws_r=mysqli_fetch_array($ws)){
										
										if($ws_r['amount']>='200' && $ws_r['sponser']>='2' && $ws_r['bank_ac']!='' ){ 
										$i++;
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $ws_r['userid']; ?></td>
                                                <td><?php echo $ws_r['name'];?></td>
                                                <td><?php echo $ws_r['bank']; ?></td>
                                                <td><?php echo $ws_r['bank_ac']; ?></td>
                                                <td><?php echo $ws_r['ifsc']; ?></td>
                                                
                                                <td><?php echo $ws_r['amount']; ?></td>
                                                <td><?php echo $ws_r['adm_amt']; ?></td>
                                                <td><?php echo $ws_r['f_amt']; ?></td>
                                                <td>
                                               <form action="" method="post">
                                               <input type="hidden" value="<?php echo $ws_r['amount'];?>" name="amount" >
                                               <input type="hidden" value="<?php echo $ws_r['adm_amt'];?>" name="adm_amt" >
                                               <input type="hidden" value="success" name="status" >
                                               <input type="hidden" value="<?php echo $ws_r['userid']; ?>" name="user_id" >
                                               <input type="hidden" value="<?php echo $ws_r['bank_ac']; ?>" name="bank_ac" >
                                               <input type="hidden" value="<?php echo $ws_r['ifsc']; ?>" name="ifsc" >
                                               <input type="hidden" value="<?php echo $ws_r['f_amt'];?>" name="f_amt" >
                                               <input type="submit" name="submit" value="<?php  echo $ws_r['f_amt'];?>" >
                                               </form>
                                               </td>
                                            </tr>
                                      <?php   
										}	}		
									?>
                                    	
                            </table><br>
                            </div>
                            
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
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
