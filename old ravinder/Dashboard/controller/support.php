                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php
session_start();
require_once("../../database/db.php");
require_once("userClass.php");
$userClass = new userClass();
$userData = $_SESSION['user'];
$userId = $userData['id'];
$user_id = $userData['user_id'];


if (isset($_POST['support'])) {
    
    $value = $userClass->extract_post($db, $_REQUEST);
    extract($value);
    $sp = mysqli_query($db, "INSERT INTO `support`(`user_id`, `ticket`,`email`, `subject`, `message`, `status`, `topic`) VALUES ('$user_id','','$sub','$email','$msg','pending','$topic')");
    if ($sp) {
        $_SESSION["support"] = array("msg" => "Your Request, Succefuly submitted.", "status" => "true");
    }
    
    echo "<script type='text/javascript'> document.location = '../support_new.php'; </script>";
    exit;
}
