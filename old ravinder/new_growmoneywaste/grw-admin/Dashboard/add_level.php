<?php
require_once("../../database/db.php");
require_once("include/header.php");
if (isset($_GET['delete'])) {
    mysqli_query($db, "DELETE FROM `level_income` WHERE id='" . $_GET['delete'] . "'");
    $_SESSION["package"] = array("msg" => "Level record Succefully deleted!", "status" => false);
    echo "<script type='text/javascript'> document.location = 'add_level.php'; </script>";
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
            <h2>Level Income</h2>
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="row-fluid">
        <div class="widget">
            <div class="widget-header">
                <div class="title">Add Level Income</div>
            </div>
            <div class="widget-body">
                <div class="form-horizontal no-margin">
                    <form action="controller/function.php" method="post">
                        <?php if (isset($_SESSION["package"])) if ($_SESSION["package"]["status"] == false) echo "<p id='response-msg-false' class='false' >" . $_SESSION['package']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["package"])) if ($_SESSION["package"]["status"] == true) echo "<p id='response-msg-true' class='true' >" . $_SESSION['package']['msg'] . "</p>";unset($_SESSION["package"]); ?> 
                        <?php
                        $query = mysqli_query($db, "SELECT * FROM  `level_income`  order by id asc ");
                        $levelData = mysqli_num_rows($query);
                        $levelcurrent = $levelData + 1;
                        if (isset($_GET['level'])) {
                            $levelquery = mysqli_query($db, "SELECT * FROM  `level_income` where `id`='" . $_GET['level'] . "'");
                            $levelDataq = mysqli_fetch_array($levelquery);
                            $levelcurrent = $levelDataq['level'];
                        }
                        ?> 

                        <div class="row">
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label class="control-label">Level# </label>
                                    <div class="controls">
                                        <input class="form-control" readonly="true" name="level" type="text" value='<?php echo $levelcurrent; ?>' required>
                                        <input name="levelid" type="hidden" value='<?php echo (isset($levelDataq['id'])) ? $levelDataq['id'] : 0; ?>'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label class="control-label">Income </label>
                                    <div class="controls">
                                        <input class="form-control" name="p" type="text" value='<?php echo (isset($levelDataq['percentage'])) ? $levelDataq['percentage'] : 0; ?>' required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label class="control-label">Direct Condition(optional) </label>
                                    <div class="controls">
                                        <input class="form-control" name="dc" value='<?php echo (isset($levelDataq['directcondition'])) ? $levelDataq['directcondition'] : 0; ?>' type="text" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="control-group">
                                    <label class="control-label">&nbsp;</label>
                                    <button  type="submit"  name="add_level" class="btn btn-primary">Submit</button>
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
                            List of level income
                        </div>
                    </div>
                    <div class="widget-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>


                                        <th>#</th>
                                        <th>Level</th>
                                        <th>Percentage%</th>
                                        <th>Direct Condition</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    // $userId = $user["id"];
                                    $i = 1;

                                    while ($dataQuery = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>

                                            <td><?php echo $i;
                                    $i++;
                                        ?>   </td>
                                            <td><?php echo $dataQuery['level']; ?>   </td>
                                            <td><?php echo $dataQuery['percentage']; ?>   </td>
                                            <td><?php echo $dataQuery['directcondition']; ?>   </td>
                                            <td><?php echo $dataQuery['createAt']; ?>   </td>
                                            <td><a href="?level=<?php echo $dataQuery['id']; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> </a> </td>
                                            <td><a href="?delete=<?php echo $dataQuery['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure for delete this level!')"><i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
                                        </tr>
<?php } ?>


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
