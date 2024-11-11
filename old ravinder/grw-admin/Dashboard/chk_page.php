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

    // $totalResult = $fu->totalUser($db); 
}



// $sql_query = "SELECT name, user_id,email,phone,position,master_key,password FROM`user` WHERE user_id!='admin'";
// $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
// $developer_records = array();
// while( $rows = mysqli_fetch_assoc($resultset) ) {
// 	$developer_records[] = $rows;
// }	

// if(isset($_GET["export_data"])) {	
// 	$filename = "phpzag_data_export_".date('Ymd') . ".xls";			
// 	header("Content-Type: application/vnd.ms-excel");
// 	header("Content-Disposition: attachment; filename=\"$filename\"");	
// 	$show_coloumn = false;
// 	if(!empty($developer_records)) {
// 	  foreach($developer_records as $record) {
// 		if(!$show_coloumn) {
// 		  // display field/column names in first row
// 		  echo implode("\t", array_keys($record)) . "\n";
// 		  $show_coloumn = true;
// 		}
// 		echo implode("\t", array_values($record)) . "\n";
// 	  }
// 	}
// 	exit;  
// }
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

            <h2>Users </h2>

        </div>
        <div class="clearfix"></div>

    </div>

    <div class="row-fluid">

        <div class="span12">

            <div class="widget">

                <div class="widget-header">

                    <div class="title">

                        List of all users (Total:-<?php echo $totalResult; ?>)

                    </div>

                </div>

                <div class="pull-right" style="margin-right: 10px">

                    <a href="printrequest.php" target='__blank'><input type='button' class='btn btn-success' value="Export All"></a>

                </div>
                <div class="pull-right" style="margin-right: 10px">

                    <a href="export_all_user.php" target='__blank'><input type='button' class='btn btn-success' value="Export All In XL"></a>

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

                            <span> From<input type="text" name="from" id="datepicker"> </span>

                            <span> to <input type="text" name="to" id="datepicker1"> </span>

                            <input class="btn-danger p-1" type="submit" name="submit" value="Search">

                            <a href="Users.php"><input class="btn-danger p-1" type="button" name="reset" value="Reset"> </a>

                        </form>

                    </div>

                    <div>
                        <?php
                        $rowperpage = 5;
                        $row = 0;

                        // Previous Button
                        if (isset($_POST['but_prev'])) {
                            $row = $_POST['row'];
                            $row -= $rowperpage;
                            if ($row < 0) {
                                $row = 0;
                            }
                        }

                        // Next Button
                        if (isset($_POST['but_next'])) {
                            $row = $_POST['row'];
                            $allcount = $_POST['allcount'];

                            $val = $row + $rowperpage;
                            if ($val < $allcount) {
                                $row = $val;
                            }
                        }

                        ?>
                        <ul class="pagination">
                            <form method="post" action="">
                                <div id="div_pagination">
                                    <input type="hidden" name="row" value="<?php echo $row; ?>">
                                    <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">
                                    <input type="submit" class="button" name="but_prev" value="Previous">
                                    <input type="submit" class="button" name="but_next" value="Next">
                                </div>
                            </form>
                            <!-- <ul class="pagination">

                                <li style="">Page </li>

                                <?php
                                //Pagination 
                                $pagenum = $totalResult / 100;
                                for ($i = 0; $i < $pagenum; $i++) {
                                    if (isset($_POST['select_type'])) {

                                        //Query Parameter
                                        $parameter = $_SERVER['QUERY_STRING'];

                                        //if page already send
                                        if (isset($_POST['page'])) {
                                            parse_str($parameter, $get_array);
                                            unset($get_array['page']);
                                            $parameter = http_build_query($get_array);
                                        }
                                ?>
                                        <li><a href="?<?php echo $parameter; ?>&page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                                    <?php } else { ?>
                                        <li><a href="?page=<?php echo $i - 1; ?>">Prev</a></li>
                                        <li><a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                            <li><a href="?page=<?php echo $i + 1; ?>">Next</a></li>
                            <a href='?page=<?php echo $i + 1 ?>'> Next </a>


                    <?php }
                                } ?>
                        </ul> -->
                    </div>
                    <div class="table-responsive ">
                        <div id="content">
                            <table class="" width="100%" id="emp_table" border="0">
                                <tr class="tr_header">
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                </tr>
                                <?php
                                // count total number of rows
                                $sql = "SELECT COUNT(*) AS cntrows FROM user";
                                $result = mysqli_query($db, $sql);
                                $fetchresult = mysqli_fetch_array($result);
                                $allcount = $fetchresult['cntrows'];

                                // selecting rows
                                $sql = "SELECT * FROM user  ORDER BY ID ASC limit $row," . $rowperpage;
                                // $sql = "SELECT * FROM  `user` where user_id!='admin' and  Date >= '" . $_POST['from'] . " 00:00:00'";

                                $result = mysqli_query($db, $sql);
                                $sno = $row + 1;
                                while ($fetch = mysqli_fetch_array($result)) {
                                    $fetch['name'];
                                    $fetch['phone'];
                                ?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $fetch['name'];; ?></td>
                                        <td><?php echo $fetch['phone'];; ?></td>
                                    </tr>
                                <?php
                                    $sno++;
                                }
                                ?>
                            </table>

                            <!-- <table id="myTable" class="table table-striped">

                                <thead>

                                    <tr>



                                        <th>#</th>

                                        <th>Name</th>

                                        <th>User id</th>

                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Password</th>

                                        <th>Transaction Password</th>

                                        <th>Position</th>

                                        <th>Direct</th>

                                        <th>Package</th>

                                        <th>Sponsor</th>

                                        <th>wallet</th>
                                        <th>E-wallet</th>

                                        <th>Date</th>
                                        <th>paid date</th>



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

                                    $q = "SELECT * FROM  `user` where user_id!='admin'";



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
                                            <td><?php echo $dataQuery['email']; ?> </td>
                                            <td><?php echo $dataQuery['phone']; ?> </td>

                                            <td><?php echo $dataQuery['password']; ?> </td>

                                            <td><?php echo $dataQuery['master_key']; ?> </td>

                                            <td><?php echo $dataQuery['position']; ?> </td>

                                            <td><?php echo $fu->getUserDirect($db, $dataQuery['user_id']); ?> </td>

                                            <td><?php if ($dataQuery['package'] == 'InActive') {
                                                    echo 'Free';
                                                } else {
                                                    echo round($dataQuery['packageAmount'], 2);
                                                } ?> </td>

                                            <td><?php echo $dataQuery['sponser_by']; ?> </td>

                                            <td><?php echo $fu->getWallet($db, 'inr', $dataQuery['id']); ?> </td>
                                            <td><?php echo $fu->getWallet($db, 'epin', $dataQuery['id']); ?> </td>
                                            <td><?php echo $dataQuery['Date']; ?> </td>
                                            <td><?php echo $dataQuery['paid_date']; ?> </td>


                                            <td>

                                                <a onclick="login('<?php echo $dataQuery['id']; ?>')" class="btn btn-danger text-white p-2" data-original-title=""><i class="fa fa-sign-in" aria-hidden="true"></i></a>

                                                <a target="_blank" href="view_user.php?uid=<?php echo urlencode($dataQuery['id']); ?>" class=" btn btn-sm text-white bg-success p-2" data-original-title=""><i class="fa fa-eye" aria-hidden="true"></i></a>









                                            </td>



                                        </tr>

                                    <?php
                                        $i++;
                                    }
                                    ?>





                                </tbody>

                            </table> -->

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
    <?php
    include 'footer.php';
    ?>