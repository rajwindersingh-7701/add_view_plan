<?php

require_once("../../../database/db.php");
include_once("functionalityClass.php");
$fuClass = new functionalityClass();

if(isset($_GET["ad_deactive"])){
    $newsId = $_GET["uid"];
    $st = $_GET["ad_deactive"];
    mysqli_query($db,"UPDATE `googleadd` SET `status`=$st WHERE `id`='".$newsId."'");
    header("location:../ad_view.php");
}

if(isset($_GET["ad_delete"])){
    $newsId = $_GET["uid"];
    $st = $_GET["ad_delete"];
    
//    echo "DELETE FROM `googleadd` WHERE `id`='".$newsId."'";die;
    
    mysqli_query($db,"DELETE FROM `googleadd` WHERE `id`='".$newsId."'");
    header("location:../ad_view.php");
}

if (isset($_POST['googleAdd'])) {
    $flink = $_POST['link'];
    $r_link = $_POST['radio_link'];
    $button = $_POST['button'];
    $mlink = $_POST['mlink'];
    if ($flink != '' && $r_link != '') {
        $q = "insert into `googleadd`(`url`)values('$flink')";
        if (mysqli_query($db, $q)) {
            header('location:../ad_submit.php');
        }
    }else if($button !=''){
         $q = "insert into `googleadd`(`button`)values('$button')";
        if (mysqli_query($db, $q)) {
            header('location:../ad_submit.php');
        }
    } else{

        $ftype = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $imgurl = "data:image/$ftype;base64," . base64_encode(file_get_contents($_FILES['file']['tmp_name']));
        
//        echo $imgurl;die;
        $q = "insert into `googleadd`(`image`,`url`)values('$imgurl','$mlink')";
//        echo "insert into `googleadd`(`image`)values('$imgurl')";die;
        if (mysqli_query($db, $q)) {
        }
        header('location: ../ad_submit.php');
    }

}
if (isset($_POST['add_news'])) {
    $newsData = $fuClass->extract_post($db, $_POST);
    extract($newsData);

    mysqli_query($db, "INSERT INTO `meta`(`title`, `text`, `type`) VALUES ('$title','$news','news')");
    header("location:../view_news.php");
}
if (isset($_GET["deleteNews"])) {
    $newsId = $_GET["uid"];
    mysqli_query($db, "delete from meta where id='$newsId'");
    header("location:../view_news.php");
}
if (isset($_GET['del'])) {
    $query = "select * from meta where id='" . $_GET['del'] . "'";
    $result = mysqli_query($db, $query);
    $res = mysqli_fetch_assoc($result);
    $img = $res['image'];
    //$path
    echo $img;
    //die();
    unlink('../../' . $img);
    if (count($result) > 0) {
//        echo "DELETE FROM `galleryimage` WHERE id='" . $_GET['del'] . "' ";
        $q = "DELETE FROM `galleryimage` WHERE id='" . $_GET['del'] . "' ";
    }
    //print_r($q);
    //die;
    if ($db->query($q) == true) {
        header('location:../view_gallery.php');
    } else {
        echo "not delete";
    }
}
if (isset($_POST['galleryImg'])) {
    $totalfiles = (int) count($_FILES['file']['name']);
    // print_r($totalfiles);die;
    for ($i = 0; $i < $totalfiles; $i++) {
        $name = $_FILES['file']['name'][$i];
        $temp = $_FILES['file']['tmp_name'][$i];
        compressImage($temp, "../../uploads/" . $name, 20);
//        if (move_uploaded_file($temp, "../../uploads/" . $name)) {
        echo $q = "insert into `galleryimage`(`image`)values('$name')";
        if (mysqli_query($db, $q)) {
//            }
        }
        header('location: ../view_gallery.php');
    }
}
if (isset($_POST['galleryVideo'])) {
    $link=$_POST['videolink'];
    $q = "insert into `galleryvideo`(`link`)values('$link')";
    if (mysqli_query($db, $q)) {
        
    }
    header('location: ../view_videos.php');
}
if (isset($_POST['deletevideo'])) {
    $vid=$_POST['vid'];
    $q = "delete from `galleryvideo` where ID='$vid'";
    if (mysqli_query($db, $q)) {
        
    }
    header('location: ../view_videos.php');
}

function compressImage($source, $destination, $quality) {
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
    return true;
}

if (isset($_POST['add_archivers'])) {
    $newsData = $fuClass->extract_post($db, $_POST);
    extract($newsData);

    mysqli_query($db, "INSERT INTO `meta`(`user_id`,`title`, `text`, `type`) VALUES ('$user_id','$title','$desc','archivers')");
    header("location:../view_archivers.php");
}
if (isset($_GET["deleteArchivers"])) {
    $newsId = $_GET["uid"];
    mysqli_query($db, "delete from meta where id='$newsId'");
    header("location:../view_archivers.php");
}
if (isset($_POST['add_testimonial'])) {
    $newsData = $fuClass->extract_post($db, $_POST);
    extract($newsData);

    mysqli_query($db, "INSERT INTO `meta`(`user_id`,`title`, `text`, `type`) VALUES ('$user_id','$title','$desc','testimonial')");
    header("location:../view_archivers.php");
}
if (isset($_GET["deleteTestimonial"])) {
    $newsId = $_GET["uid"];
    mysqli_query($db, "delete from meta where id='$newsId'");
    header("location:../view_archivers.php");
}
if (isset($_GET["withdraw_all"])) {

    $package = mysqli_fetch_array(mysqli_query($db, "select id from package where title='Starter' and status ='1'"));
    //echo "select * from user where enable='1' and package!='InActive' and package != '".$package['id']."'";
    $userQuery11 = mysqli_query($db, "select * from user where enable='1' and package!='InActive' and package != '" . $package['id'] . "'");
    //$userData11 = mysqli_fetch_array($userQuery11);

    while ($userData = mysqli_fetch_array($userQuery11)) {
        $walletData = $fuClass->getWallet($db, 'inr', $userData['id']);
        if ($walletData > 299) {

            $tds = 10 / 100 * $walletData;
            $adminfee = 8 / 100 * $walletData;
            $currentdate = date("Y-m-d H:i:s");
            $fee = $adminfee + $tds;
            $amount = $walletData - $fee;
            $description = "Withdraw request for user id " . $userData['user_id'] . " and amount $walletData";
            $description4 = "Your wallet balance is deduct for withdraw admin fee";
            $description2 = "Your wallet balance is deduct for withdraw tds";
            $description1 = "Your wallet balance is deduct for withdraw";

            mysqli_query($db, "INSERT INTO `withdraw` (`userId`,`transaction_id`,`amount`, `status`, `date`, `description`, `confirmDate`) VALUES ('" . $userData['id'] . "','4142" . $userData['id'] . "', '$amount', 'pending', '$currentdate ', '$description', '')");
            $withID = mysqli_insert_id($db);

            mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '$tds', 'debit','admin', '$description2','', 'tds','inr','$withID')");
            mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '$adminfee', 'debit','admin', '$description4','','admin_fee','inr','$withID')");
            mysqli_query($db, "INSERT INTO `wallet` (`userId`,`username`, `amount`, `type`, `fromUserId`, `description`,`level`, `transaction_type`,`walletType`,`withdraw_id`) VALUES ( '" . $userData['id'] . "','" . $userData['user_id'] . "', '$amount', 'debit','admin', '$description1','', 'withdraw','inr','$withID')");
        }
    }
    header("location:../pending_request.php");
    exit;
}





if(isset($_GET["news_delete"])){
    $newsId = $_GET["uid"];
    $st = $_GET["news_delete"];
    mysqli_query($db,"DELETE FROM `news` WHERE `id`='".$newsId."'");
    header("location:../news_upload.php");
}


