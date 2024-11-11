<?php
require_once("include/header.php");
if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `user` where user_id!='admin' and  $column='$value'";
    }
    if (isset($_GET['from'])) {
        $q = "SELECT * FROM  `user` where user_id!='admin' and  Date >= '" . $_GET['from'] . " 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $q .= " and  Date <= '" . $_GET['to'] . " 23:59:59 '";
    }
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `user` WHERE user_id!='admin'"));
}

?>

<style>
    .table td,
    .table th {
        padding: 0.7rem;
        vertical-align: top;
        border-top: 1px solid #e9ecef;
    }
</style>
<div class="main-container mt-152">
    <div class="page-header mt-15">
        <div class="pull-left">
            <h2>ROI Users </h2>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row-fluid">

        <div class="span12">

            <div class="widget">

                <div class="widget-header">

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

                                <option value="sponser_by" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser_by") echo "selected"; ?>>Sponsor</option>

                                <option value="sponser_by" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser_by") echo "selected"; ?>>Direct</option>

                                <option value="phone" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "phone") echo "selected"; ?>>Phone</option>

                                <option value="packageAmount" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "packageAmount") echo "selected"; ?>>Package</option>

                            </select>

                            <input class="custom-select w-auto" type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required>

                            <input type="submit" class="orangebuttion btn-success p-1" name="submit" value="Search">

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

                            <input class="btn-danger p-1" type="submit" name="submit" value="Search">

                            <a href="Users.php"><input class="btn-danger p-1" type="button" name="reset" value="Reset"> </a>

                        </form>

                    </div>

                    <div>
                        <p><?php //echo "Total Result:- " . $totalResult; 
                            ?></p>
                        <!-- <li>Page </li> -->
                        <?php

                        $total_pages = ceil($totalResult / 100);
                        if ($totalResult > 100) {

                            if (isset($_GET["page"])) {
                                $page  = $_GET["page"];
                            } else {
                                $page = 1;
                            };
                            echo "<ul class='pagination'>";
                            echo "<li><a href='royalty_bonus.php?page=" . ($page - 1) . "' class='button'>Previous</a></li>";

                            for ($i = $page; $i <= ($page + 2); $i++) {
                                echo "<li><a href='royalty_bonus.php?page=" . $i . "'>" . $i . "</a></li>";
                            };
                            echo "<li><a href='royalty_bonus.php?page=" . ($page + 1) . "' class='button'>NEXT</a></li>";
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
                                    <th>User id</th>
                                    <th>Amount</th>
                                    <th>Days</th>
                                    <th>Type</th>
                                    <th>Credit Date</th>
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
                                $q = "SELECT * FROM  `tbl_roi` where type ='royalty_bonus'";
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
                                if (isset($value)) {
                                    $q .= "order by id asc limit $pageResult offset $offset";
                                } else {

                                    $q .= "order by id desc limit $pageResult offset $offset";
                                }
                                $i = 1;
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?> </td>
                                        <td><?php echo $dataQuery['user_id']; ?> </td>
                                        <td><?php echo $dataQuery['amount']; ?> </td>
                                        <td><?php echo $dataQuery['days']; ?> </td>
                                        <td><?php echo $dataQuery['type']; ?> </td>
                                        <td><?php echo $dataQuery['creditDate']; ?> </td>
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

    <script>
        $(document).ready(function() {

            $('#myTable').dataTable({

                "paging": false,

                "ordering": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all (not just selected)',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    }
                ],


            });

        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



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

<!--End of Tawk.to Script-->
<?php include 'footer.php'; ?>