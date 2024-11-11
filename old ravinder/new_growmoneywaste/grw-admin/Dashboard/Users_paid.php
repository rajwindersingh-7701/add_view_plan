<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `user` where user_id!='admin' and package!='InActive' and  $column='$value'";
    }

    if (isset($_GET['from'])) {
        $q = "SELECT * FROM  `user` where user_id!='admin' and package!='InActive' and  Date >= '" . $_GET['from'] . " 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $q .= " and  Date <= '" . $_GET['to'] . " 23:59:59 '";
    }
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = $fu->totalUserPaid($db);
}
?>

<style>
    .pagination>li {
        display: inline;
    }
</style>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>Paid Users </h2>
        </div>

        <div class="clearfix"></div>
    </div>


    <style>
        .orangebuttion {
            color: #FFF;
        }

        ul.pagination li {
            padding: 5px 10px;
            background: #0e9048;
            margin-right: 3px;
            cursor: pointer;
            color: #FFF;
            font-size: 16px;

        }

        ul.pagination li a {
            color: #FFF;
        }
    </style>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        List of all paid users (Total:-<?php echo $totalResult; ?>)
                        
                    </div>
                </div>
                <div class="widget-body">
                    <div>
                        <?php
                        if (isset($_GET['select_type'])) {
                            $column = $_GET['select_type'];
                            $value = $_GET['v'];
                        }
                        ?>
                        <br>
                        <div class='span12'><button class="orangebuttion btn-danger p-2" style="" onclick='selectForm()'>Change Filter</button></div>
                        <br>
                        <form action="" method="get" class="form1" <?php if (isset($_GET['from'])) { ?> style="display:none;" <?php } ?>>
                            <label> Search From</label>
                            <select class="custom-select w-auto" name="select_type" id="select_search" onchange="searchSelect()">
                                <option value="user_id" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "user_id") echo "selected"; ?>>User Id</option>
                                <option value="name" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "name") echo "selected"; ?>>Name</option>
                                <!--<option value="package">Package Name</option>-->
                                <option value="sponser" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser") echo "selected"; ?>>Sponsor</option>
                                <option value="sponser_by" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser_by") echo "selected"; ?>>Direct</option>
                                <option value="phone" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "phone") echo "selected"; ?>>Phone</option>
                                <option value="packageAmount" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "packageAmount") echo "selected"; ?>>Package</option>
                            </select>
                            <input class="custom-select w-auto" type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required>
                            <input type="submit" class="orangebuttion btn-danger p-1" name="submit" value="Search">
                            <a href="Users.php"><input class="orangebuttion btn-danger p-1" type="button" name="reset" value="Reset"> </a>
                        </form>
                        <script>
                            function selectForm() {
                                jQuery(".form1").toggle();
                                jQuery(".form2").toggle();
                            }
                        </script>
                        <form action="" method="get" class="form2" <?php if (empty($_GET['from'])) { ?> style="display:none;" <?php } ?>>
                            <label> Search From Date</label>
                            <input type="hidden" name="select_type" value="">
                            <input type="hidden" name="v" id="date" value="">
                            <span> From<input type="date" name="from" id="datepicker"> </span>
                            <span> to <input type="date" name="to" id="datepicker1"> </span>
                            <input type="submit" name="submit" value="Search">
                            <a href="Users.php"><input type="button" name="reset" value="Reset"> </a>
                        </form>
                    </div>
                    <div>
                        <?php
                        $total_pages = ceil($totalResult / 100);
                        if ($totalResult > 100) {

                            if (isset($_GET["page"])) {
                                $page  = $_GET["page"];
                            } else {
                                $page = 1;
                            };
                            echo "<ul class='pagination'>";
                            echo "<li><a href='Users_paid.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

                            for ($i = $page; $i <= ($page + 3); $i++) {
                                echo "<li><a href='Users_paid.php?page=" . $i . "'>" . $i . "</a></li>";
                            };
                            echo "<li><a href='Users_paid.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
                            echo "</ul>";
                        ?>
                            <span>
                                <form action=''>
                                    <input type='number' name='page' style='width:80px;padding: 3px;margin-right: 20px;margin-top: 2px;' value='<?php if (isset($_GET['page'])) {
                                                                                                                                                    echo $_GET['page'];
                                                                                                                                                } ?>'>
                                    <input type='submit' value='GO TO PAGE' class='btn btn-flat'>
                                </form>
                            </span>
                        <?php } ?>
                    </div>


                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User id</th>
                                    <th>Phone</th>
                                    <th>Password</th>
                                    <th>Master Key</th>
                                    <th>Direct</th>
                                    <th>Package</th>
                                    <th>Sponsor</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Action</th>
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
                                $q = "SELECT * FROM  `user` where user_id!='admin' and package!='InActive'";

                                if (isset($_GET['select_type'])) {
                                    $column = $_GET['select_type'];
                                    $value = $_GET['v'];
                                    if ($_GET['select_type'] != "") {
                                        $q .= " and  $column Like '%$value%' ";
                                    }
                                    if (isset($_GET['from'])) {
                                        $q .= " and Date >= '" . $_GET['from'] . " 00:00:00' ";
                                    }
                                    if (isset($_GET['to'])) {
                                        $q .= " and Date <= '" . $_GET['to'] . " 23:59:59' ";
                                    }
                                }

                                $q .= "order by id desc limit $pageResult offset $offset";

                                //                                echo $q;die;
                                //$userId = $user["id"];
                                $i = 1;
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                ?>
                                    <tr>

                                        <td><?php echo $i; ?> </td>
                                        <td><?php echo $dataQuery['name']; ?> </td>
                                        <td><?php echo $dataQuery['user_id']; ?> </td>
                                        <td><?php echo $dataQuery['phone']; ?> </td>
                                        <td><?php echo $dataQuery['password']; ?> </td>
                                        <td><?php echo $dataQuery['master_key']; ?> </td>
                                        <td><?php echo $fu->getUserDirect($db, $dataQuery['user_id']); ?> </td>
                                        <td><?php if ($dataQuery['package'] == 'InActive') {
                                                echo 'Free';
                                            } else {
                                                echo $fu->getPackageId($db, $dataQuery['package'])["title"];
                                            } ?> </td>
                                        <td><?php echo $dataQuery['sponser_by']; ?> </td>
                                        <td> </td>
                                        <td><?php echo $dataQuery['Date']; ?> </td>
                                        <td>
                                            <a onclick="login('<?php echo $dataQuery['id']; ?>')" class="btn btn-danger" data-original-title=""><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                                            <a target="_blank" href="view_user.php?uid=<?php echo urlencode($dataQuery['id']); ?>" class=" btn btn-sm " data-original-title=""><i class="fa fa-eye" aria-hidden="true"></i></a>




                                        </td>

                                    </tr>
                                <?php $i++;
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#myTable').dataTable({
                "paging": false,
                "ordering": false,
            });
        });
    </script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <script type="text/javascript" src="../../js/script.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        jQuery(function() {

            jQuery("#datepicker").datepicker({
                changeYear: true,
                changeMonth: true,
                maxDate: new Date(),
                dateFormat: "yy-mm-dd "
                //        yearRange: "2017:2020"
            });
            jQuery("#datepicker1").datepicker({
                changeYear: true,
                changeMonth: true,
                maxDate: new Date(),
                dateFormat: "yy-mm-dd "
                //        yearRange: "2017:2020"
            });
            //jQuery( "#datepicker" ).datepicker();
        });
    </script>


    <script>
        function login(val) {
            $.ajax({
                url: "controller/function.php",
                type: "GET",
                data: {
                    ido: val
                },
                success: function(response) {

                    if (response == "true") {
                        window.open('../../Dashboard');
                    }
                }
            });
        }
    </script>


    <!-- container-fluid -->
</div>
<?php
include 'footer.php';
?>