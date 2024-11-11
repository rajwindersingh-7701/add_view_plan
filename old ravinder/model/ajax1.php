<?php
$db = mysqli_connect("localhost","root","","LOCAL") or die(mysqli_connect_error());
include("userClass.php");
$user = new user();
if (isset($_REQUEST["request"])) {
     $request = $_REQUEST["request"];
    if ($request == "valid_sponsor") {
        $uname = $_REQUEST['user_id'];
        $position = $_REQUEST['position'];
        $data = $user->getvalidSponsor($db, $uname, $position);
        $userData = mysqli_fetch_array(mysqli_query($db, "SELECT name FROM user where user_id = '$data'"));
        // echo "Under place sponsor id: <font color='blue'>" . $data . "</font> and name:<font color='blue'>" . $userData['name'] . "</font>";
        $response = array("id" => $data, "msg" => "Under place sponsor id: <font color='blue'>" . $data . "</font> and name:<font color='blue'>" . $userData['name'] . "</font>");
        echo json_encode($response);
        die;
    }
}