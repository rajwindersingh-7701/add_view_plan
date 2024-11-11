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
	echo '<script>alert("Payout successfully.");window.location.assign("manual_with.php");</script>';	
}

?>

                        	<table class="table table-striped table-bordered"  id="table">
                            	<tr><th colspan="10">Manual Withdrwal </th></tr>
                                <tr>
                                	<th>S.n.</th>
                                    
                                    <th>Userid</th>
                                    <th>Name / Mobile No.</th>
                                    <th>Bank Name</th>
                                    <th>Account No.</th>
                                    <th>IFSC Code</th>
                                    <th>Amount</th>
                                    <th>Admin</th>
                                    <th>Paybal Amount</th>
                                    
                                    
                                    
                                </tr>
                                <?php
									$ws=mysqli_query($con,"select * from user where status='Active'");
									$i='0';
									while($ws_r=mysqli_fetch_array($ws)){
										$i++;
										$li=mysqli_query($con,"select sum(amount) from level_in  where userid='".$ws_r['loginid']."' and r_date<='2022-01-29'");
                                                       $li_r=mysqli_fetch_array($li);
				                                       $lv_in=$li_r['0'];
				                                  //self
				                               $sf=mysqli_query($con,"select sum(amount) from self_in  where userid='".$ws_r['loginid']."' and r_date<='2022-01-29'");
                                               $sf_r=mysqli_fetch_array($sf);
				                               $sf_in=$sf_r['0'];
				                               //withdrwal
	                                          $wt=mysqli_query($con,"SELECT sum(amount) FROM `withdrwal` where user_id='".$ws_r['loginid']."' and r_date<='2022-01-28'");
				                              $wt_r=mysqli_fetch_array($wt);
				                              $wtt=$wt_r['0'];
				                              $tb=$lv_in+$sf_in;
				                                $utt=mysqli_query($con,"SELECT count(id) FROM `user` where sponser_id='".$ws_r['loginid']."' and status='Active' and r_date<='2022-01-29'");
				                                $utt_r=mysqli_fetch_array($utt);
				                                $uttt=$utt_r['0'];
												$fam=$tb-$wtt;
												$adm=$fam*10/100;
												$tam=$fam-$adm;
				                                 ?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $ws_r['loginid']; ?></td>
                                                <td><?php echo $ws_r['name'];
												 ?> / <?php echo $ws_r['mob'];?></td>
                                                
                                                <td><?php echo $ws_r['bank_name']; ?></td>
                                                <td><?php echo $ws_r['bank_ac']; ?></td>
                                                <td><?php echo $ws_r['ifsc']; ?></td>
                                                
                                                <td><?php echo $fam; ?></td>
                                                <td><?php echo $adm; ?></td>
                                                <td><?php $tam;
												$ut=mysqli_query($con,"SELECT count(id) FROM `user` where sponser_id='".$ws_r['loginid']."' and status='Active' and r_date<='2022-01-29'");
				                                $ut_r=mysqli_fetch_array($ut);
				                                $utt=$ut_r['0'];
				  
												 if($tam>='200' && $utt>='2'){?>
                                               <form action="" method="post">
                                               <input type="hidden" value="<?php echo $fam;?>" name="amount" >
                                               <input type="hidden" value="<?php echo $adm;?>" name="adm_amt" >
                                               <input type="hidden" value="success" name="status" >
                                               <input type="hidden" value="<?php echo $ws_r['loginid']; ?>" name="user_id" >
                                               <input type="hidden" value="<?php echo $ws_r['bank_ac']; ?>" name="bank_ac" >
                                               <input type="hidden" value="<?php echo $ws_r['ifsc']; ?>" name="ifsc" >
                                               <input type="hidden" value="<?php echo $tam;?>" name="f_amt" >
                                               <input type="submit" name="submit" value="<?php  echo $tam?>" >
                                               </form><?php }else{ echo $tam; }?>
                                               </td>
                                            </tr>
                                      <?php   
									}			
									?>
                                    	
                            </table>