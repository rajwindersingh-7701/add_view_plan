<?php
require('../connect.php');

$rr=mysqli_query($con,"SELECT * FROM `user` WHERE `loginid`='".$_REQUEST['str']."'");
$tt=mysqli_fetch_array($rr);

?>
                                                <b style="color:#157b8c;"> Name: 
                                                   <?php echo $tt['name'];?></b>
                                                