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
<html>
    <head>

    <title>Super Digital Coin GST</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">




    <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
    </script>
    </head>
    <body>
   
                           
        <table id="example" class="display" style="width:100%">
        <thead>
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
        </thead>
        <tbody>
       <?php $frd=$_POST['fromdate'];
								$tdt=$_POST['todate'];
								$bl=mysqli_query($con,"select * from user where act_date between '".$_POST['fromdate']."' and '".$_POST['todate']."' and  status='Active' order by ex_date");
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
                                            <td>00.00</td>
                                            <td><?php echo $bl_r['act_date'];?></td>
                                            <td><a href="join_print.php?us_id=<?php echo $bl_r['loginid'];?>">Download</a></td>
                                            </tr>
                                   
                                    <?php }?>
                                   
        </tbody>
        <tfoot>
             <tr><td colspan="4">Grand Total</td>
                                    <td><?php $pn1=mysqli_query($con,"select sum(pintype) from pin_list ");
											$pn_r1=mysqli_fetch_array($pn1);
											
											echo  $tp=$pn_r1['0'];?></td>
                                            <td colspan="3" style="float:left">00.00</td>
                                    </tr>
        </tfoot>
    </table>

        

    </body>

    </html>