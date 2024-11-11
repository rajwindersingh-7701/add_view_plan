<?php
// die('site under maintenance');
session_start();
// $db = mysqli_connect("localhost", "growmone", "xLeEDzaJv3wj", "growmone_latest") or die('Sorry, Site is Under maintenance !');
$db = mysqli_connect("localhost", "growmone_gni", "Ez0kB@bLyd70I", "growmone_gni") or die('Sorry, Site is Under maintenance !');
// $db = mysqli_connect("localhost", "blazingw_growmon", "Hr8sv@GjrTce1", "blazingw_growmon") or die('Sorry, Site is Under maintenance !');
//$db = mysqli_connect("localhost","root","password","ktcclick") or die('Sorry, Site is Under maintenance !');

$key = "c921e0d754XX";
$userkey = "WEBCYST1";
$senderid = "ppppp";
$baseurl = "mobicomm.dove-sms.com//submitsms.jsp?";


$link = 'http://growmoney.me';
$slink = 'growmoney.me';
$site = 'growmoney';
$sitec = 'growmoney';
$currentdate = date('Y-m-d') . " 00:00:00";
//$j=1;
//for($i=1;$i<100000000;$i++){
//    $j++;
//}


if (isset($_REQUEST)) {
    $_REQUEST = extract_post($db, $_REQUEST);
}
if (isset($_POST)) {
    $_POST = extract_post($db, $_POST);
}
if (isset($_GET)) {
    $_GET = extract_post($db, $_GET);
}

function extract_post($db, $post) {
    $var = array();
    foreach ($post as $key => $val) {
        $var[$key] = mysqli_real_escape_string($db, $val);
    }
    return $var;
}
