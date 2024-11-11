<?php
die;
date_default_timezone_set('Asia/Kolkata');

$db = mysqli_connect("localhost", "payadsf1_user", "5R1gGMTEQUP7", "payadsf1_ads") or die('Sorry, Site is Under maintenance !');

$query = mysqli_query($db, "SELECT * FROM  `user` WHERE `binary`!='0'");

while($data = mysqli_fetch_array($query)){
    mysqli_query($db, "UPDATE `user` SET `onlybinary`=1 WHERE id='".$data['id']."'");
}
