<?php

include_once("../../../database/db.php");


// ===============================
if (isset($_POST['type']) && $_POST['type'] == "lod") {

   
    $uid = $_POST['support_id'];
    $data = mysqli_query($db, "SELECT * FROM `chat` WHERE `support_id`='$uid' ORDER BY datetime desc");
    $json=array();
        while ($row = mysqli_fetch_assoc($data)) {
            
            $json[] = $row;
        }
        echo json_encode($json);
       
   
}
// ===============================
if (isset($_POST['type']) && $_POST['type'] == "submit") {
    $msg = trim($_REQUEST['msg']);
    if (mysqli_query($db, "INSERT INTO `chat`(`support_id`, `sender`, `receiver`, `msg`)VALUES ('".$_POST['support_id']."','admin','user','$msg')")) {
      $json=array();
       $row_id= mysqli_insert_id($db);
        $data = mysqli_query($db, "SELECT * FROM `chat` WHERE `id`='$row_id'");
  $json=array();
        while ($row = mysqli_fetch_assoc($data)) {
            
            $json["status"] =1;
            $json[] = $row;
            
        }
      
       
       
    } else {
        $json[status]=0;
       
    }
     
        echo json_encode($json);
}

?>