<?php
class functionalityClass {
public function getEpin($db) {
$epiRand =  rand(100000000,999999999);
$epiHash =  crypt($epiRand,32);
$while1 = true;
while ($while1 == true) {
$query = mysqli_query($db, "select `epin` from `epin` where `epin` = '$epiHash'") or die(mysqli_error($db));
$userIdcheck = mysqli_num_rows($query);
if ($userIdcheck == 0) {
break;
}
$epiRand =  rand(100000000,999999999);
$epiHash =   crypt($epiRand,32);
}
return $epiHash;
}
public function getUserDirect($db, $user) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE sponser_by='$user' and package!='InActive'"));
return $user;
exit;
}
public function getUserDirectActive($db, $user) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE sponser_by='$user' and `package`!='InActive'"));
return $user;
exit;
}
public function extract_post($db, $post) {
$var = array();
foreach ($post as $key => $val) {
$var[$key] = mysqli_real_escape_string($db, $val);
}
return $var;
}
public function totalUser($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE user_id!='admin'"));
return $user;
exit;
}
public function totalUserPaid($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE user_id!='admin' and package!='InActive'"));
return $user;
exit;
}
public function totalFranchise($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE service='franchise'"));
return $user;
exit;
}
public function totalBill($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `sale` where type='franchise'"));
return $user;
exit;
}
public function totalBillUser($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `sale` where type='user'"));
return $user;
exit;
}
public function totalProductSold($db) {
$user1 = mysqli_num_rows(mysqli_query($db, "SELECT SUM(stock) as smstock FROM `user_sale`"));
return $user1['smstock'];
exit;
}
public function totalProduct($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `product` WHERE stock!='0'"));
return $user;
exit;
}
public function totalTds($db) {
$user = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `wallet` WHERE transaction_type='tds'"));
return $user;
exit;
}
public function getUser($db, $id, $param = null) {
if (isset($param)) {
$user = mysqli_fetch_array(mysqli_query($db, "SELECT '$param' FROM `user` WHERE id='$id'"));
return $user;
exit;
}
$user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE id='$id'"));
return $user;
exit;
}
public function getPoints($db, $position, $sponser) {
$totalpv = 0;
$creditPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='credit'"));
$debitPv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(pv) as pvsum FROM `point_matching` WHERE user_id='$sponser' AND position!='$position' AND `type`='debit'"));
$totalpv = $creditPv['pvsum'] - $debitPv['pvsum'];
return $totalpv;
exit;
}
public function totalpoints($db, $position, $id) {
$Creditquery = mysqli_query($db, "SELECT SUM(pv) as totalCredit FROM  `point_matching` where `user_id`='$id' && `type`='credit' && `position`='$position'");
$creditREsult = mysqli_fetch_array($Creditquery);
return $total = (isset($creditREsult['totalCredit'])) ? $creditREsult['totalCredit'] : 0;
}
public function getRatio($db, $position, $sponser) {
$result = 0;
$result = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `point_matching` WHERE user_id='$sponser' AND position='$position' AND `type`='credit'"));
return $result;
exit;
}
public function getUserFromUserName($db, $id, $param = null) {
if (isset($param)) {
$user = mysqli_fetch_array(mysqli_query($db, "SELECT " . $param . " FROM `user` WHERE user_id='$id'"));
return $user;
exit;
}
$user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` WHERE user_id='$id'"));
return $user;
exit;
}
public function getUserId($db, $sponser) {
$user = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM `user` WHERE user_id='$sponser'"));
return $user['id'];
}
public function getUserfromSponsor($db, $sponser) {
$query = mysqli_query($db, "SELECT * FROM `user` WHERE sponser='$sponser'");
$data = array();
while ($result = mysqli_fetch_array($query)) {
$data[] = $result;
}
return $data;
}
public function getPackageId($db, $pack) {
$pack = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `package` WHERE id='$pack'"));
return $pack;
}
public function getPackageColor($db, $pack) {
$pack = mysqli_fetch_array(mysqli_query($db, "SELECT color FROM `package` WHERE id='$pack'"));
return $pack['color'];
}
public function getPv($db, $uid) {
$wallet = mysqli_fetch_array(mysqli_query($db, "SELECT amount FROM `wallet` WHERE userId='$uid' && type='credit' && walletType='pv'"));
$wallet1 = mysqli_fetch_array(mysqli_query($db, "SELECT amount FROM `wallet` WHERE userId='$uid' && type='debit' && walletType='pv'"));
return $wallet - $wallet1;
}
public function getWalleteStatus($db, $uid) {
$wallet = mysqli_num_rows(mysqli_query($db, "SELECT amount FROM `wallet` WHERE userId='$uid' && type='credit' && transaction_type='point_matching'"));
return $wallet;
}
public function pvCount($db, $position, $id) {
$Creditquery = mysqli_query($db, "SELECT SUM(pv) as totalCredit FROM  `point_matching` where `user_id`='$id' && `type`='credit' && `position`='$position'");
$creditREsult = mysqli_fetch_array($Creditquery);
$Debitquery = mysqli_query($db, "SELECT SUM(pv) as totalDebit FROM  `point_matching` where `user_id`='$id' && `type`='debit'  && `position`='$position'");
$debitResult = mysqli_fetch_array($Debitquery);
return $total = $creditREsult['totalCredit'] - $debitResult['totalDebit'];
}
public function pvCounttotal($db, $position, $id) {
$Creditquery = mysqli_query($db, "SELECT SUM(pv) as totalCredit FROM  `point_matching` where `user_id`='$id' && `type`='credit' && `position`='$position'");
$creditREsult = mysqli_fetch_array($Creditquery);
$Debitquery = mysqli_query($db, "SELECT SUM(pv) as totalDebit FROM  `point_matching` where `user_id`='$id' && `type`='debit'  && `position`='$position'");
$debitResult = mysqli_fetch_array($Debitquery);
return $total = $creditREsult['totalCredit'];
}
public function getWallet($db, $type, $id) {
$Creditquery = mysqli_query($db, "SELECT SUM(amount) as totalCredit FROM  `wallet` where `userId`='$id' && `type`='credit' && `walletType`='$type'");
$creditREsult = mysqli_fetch_array($Creditquery);
$Debitquery = mysqli_query($db, "SELECT SUM(amount) as totalDebit FROM  `wallet` where `userId`='$id' && `type`='debit'  && `walletType`='$type'");
$debitResult = mysqli_fetch_array($Debitquery);
return $total = $creditREsult['totalCredit'] - $debitResult['totalDebit'];
}
public function sms($phone, $msg) {
$key = "d6d3c34e8cXX";
$userkey = "";
$senderid = "";
$baseurl = "";
$msg = "$msg";
$msg = urlencode($msg);
$url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
$data = $this->curl_get_contents($url);
return $data;
}
public function curl_get_contents($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
// print_r($data);die;
return $data;
}


}
