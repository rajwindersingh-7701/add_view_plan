<?php
require_once("../../database/db.php");
require_once("include/header.php");
if (isset($_GET['delete'])) {
    mysqli_query($db, "DELETE FROM `meta` WHERE id='" . $_GET['delete'] . "'");
    $_SESSION["package"] = array("msg" => "Payment record Succefully deleted!", "status" => false);
    echo "<script type='text/javascript'> document.location = 'add_reward.php'; </script>";
    exit;
}
?>

<div class="main-container mt-152">
    <style>.irs-page-title-field {
            padding: 20px 0 !important;

        }

        .loginarea {
            background: #ffffff;
            color: #fff !important;
            border-radius: 10px;
            padding: 20px;
            border: 3px #1b1b1b dotted;
        }


    </style>
    <div class="page-header">
        <div class="pull-left">
            <h2>Rewards</h2>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="row-fluid">
        <div class="widget">
            <div class="widget-header">
                <div class="title">Add rewards</div>
            </div>
            <div class="widget-body">
                <div class="form-horizontal no-margin">
                    <form action="controller/function.php" method="post">
                        <?php if (isset($_SESSION["package"])) if ($_SESSION["package"]["status"] == false) echo "<p id='response-msg-false' class='false' >" . $_SESSION['package']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["package"])) if ($_SESSION["package"]["status"] == true) echo "<p id='response-msg-true' class='true' >" . $_SESSION['package']['msg'] . "</p>";unset($_SESSION["package"]); ?> 
                        <?php
                        $query = mysqli_query($db, "SELECT * FROM  `meta`  order by id asc ");
                        $levelData = mysqli_num_rows($query);
                        $levelcurrent = $levelData + 1;
                        if (isset($_GET['level'])) {
                            $level = mysqli_real_escape_string($db, $_GET['level']);
                            $levelquery = mysqli_query($db, "SELECT * FROM  `meta` where `id`='$level'");
                            $levelDataq = mysqli_fetch_array($levelquery);
                            $levelcurrent = $levelDataq['level'];
                        }
                        ?> 

                        <div class="row">
                            <div class="col-md-2">
                                <div class="control-group">
                                    <label class="control-label">Payment Title </label>
                                    <div class="controls">
                                        <input class="form-control"  name="title" type="text" value='<?php echo (isset($levelDataq['title'])) ? $levelDataq['title'] : 'please enter title'; ?>' required>
                                        <input name="levelid" type="hidden" value='<?php echo (isset($levelDataq['id'])) ? $levelDataq['id'] : 0; ?>'>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="control-group">
                                    <label class="control-label">Payment Detail</label>
                                    <div class="controls">
                                        <input class="form-control" name="detail" value='<?php echo (isset($levelDataq['text'])) ? $levelDataq['text'] : 'please enter detail'; ?>' type="text" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="control-group">
                                    <label class="control-label">&nbsp;</label>
                                    <button  type="submit"  name="payemnt-add" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            List of rewards
                        </div>
                    </div>
                    <div class="widget-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Payment Title</th>  
                                        <th>Payment detail</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
//Search data query

                                    $offset = 0;

                                    $pageResult = 100;

                                    if (isset($_GET['page'])) {

                                        $page = $_GET['page'];

                                        $offset = (($page - 1) * 100) + 1;
                                    }

                                    $q = "SELECT * FROM  `meta` where `type`='payment' ";



                                    if (isset($_GET['select_type'])) {

                                        $column = $_GET['select_type'];

                                        $value = $_GET['v'];

                                        if ($_GET['select_type'] != "") {

                                            $q .= " and  $column='$value' ";
                                        }

                                        if (isset($_GET['from'])) {

                                            $q .= " and date >= '" . $_GET['from'] . " 00:00:00' ";
                                        }

                                        if (isset($_GET['to'])) {

                                            $q .= " and date <= '" . $_GET['to'] . " 23:59:59' ";
                                        }
                                    }



                                    $q .= "order by id asc limit $pageResult offset $offset";



//                                echo $q;die;
//$userId = $user["id"];

                                    $i = 1;

                                    $queryUser = mysqli_query($db, $q);

                                    while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                        ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $dataQuery['title']; ?></td>
                                            <td><?php echo $dataQuery['text']; ?></td>
                                            <td><a href="?level=<?php echo $dataQuery['id']; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> </a> </td>
                                            <td><a href="?delete=<?php echo $dataQuery['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure for delete this level!')"><i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<!-- dashboard-container -->
</div>
<?php
include 'footer.php';
?>