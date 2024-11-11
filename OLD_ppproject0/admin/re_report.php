<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
?>
<?php
//Clicked on send buton
if(isset($_POST['submit'])){
	if($_POST['pay_type']=='Success'){
	mysqli_query($con,"update withdrwal set status='Success',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	echo '<script>alert("Withdrwal send successfully.");window.location.assign("withdrwal.php");</script>';
}else{
	mysqli_query($con,"update withdrwal set r_status='Reject',remark='".$_POST['remark']."' where id='".$_POST['id']."'");
	echo '<script>alert("Withdrwal Reject successfully.");window.location.assign("withdrwal.php");</script>';	
}
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
    <title>Super Digital Coin - Re-Purchase Report</title>
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
                        <h1 class="page-header">Re-Purchase Report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<input type="button" id="btnExport" value="Export" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="table2excel.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("#btnExport").click(function () {
                $("#tblCustomers").table2excel({
                    filename: "Table.xls"
                });
            });
        });
    </script><br>
                            
                            <a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a>
                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr><th colspan="4">Re-Purchase Report</th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    
                                    <th>Userid</th>
                                    
                                     <th>Re-purchase</th>
                                    
                                     <th>Date</th>
                                    
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from withdrwal where status='Success'  order by id");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$us=mysqli_query($con,"select * from user where loginid='".$row['user_id']."'");
												$row1=mysqli_fetch_array($us);
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $row['user_id']; ?></td>
                                                
                                                <td><?php echo $row['re_amt']; ?></td>
                                                
                                                <td><?php echo $row['r_date']; ?></td>
                                                
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="4" align="center">You have no data.</td>
                                        </tr>
                                    <?php
									}
								?>
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
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
