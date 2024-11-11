<?php
    require('php-includes/connect.php');
    $sql=mysqli_query($con,"select * from user where loginid='".$_GET['username']."' ");
    $row=mysqli_fetch_array($sql);
	if($row['id']=='') { echo "<p style='color:red'>Error Check ID Again.</p>"; 
	  }
	  else {
    if($row['loginid']!='') {  echo  "<p style='color:green'> Verfiy User :- ".$row['name']."</p>"; ?>
	
	<?php  }}
    ?>