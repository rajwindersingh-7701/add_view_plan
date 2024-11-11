<?php
require_once("include/header.php");




if (isset($_GET['select_type'])) {

    if ($_GET['select_type'] != "") {

        $column = $_GET['select_type'];
        $value = $_GET['v'];

//        if ($column == "username") {
//
//            $useriddata = mysqli_fetch_array(mysqli_query($db, "SELECT `id` FROM `user` where `user_id`='$value'"));
//            $column = "userId";
//            $value = $useriddata['id'];
//        }

        $q = "SELECT * FROM  `withdraw` where $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {

        if ($_GET['from'] != "") {

            $q = "SELECT * FROM  `withdraw` where status='done' and date >= '" . $_GET['from'] . " 00:00:00'";

            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }

    if (isset($_GET['to'])) {

        if ($_GET['to'] != "") {

            $q .= " and  date <= '" . $_GET['to'] . " 23:59:59 '";

            $totalResult = mysqli_num_rows(mysqli_query($db, $q));
        }
    }
} else {

     $totalResult1 = mysqli_fetch_array(mysqli_query($db,"SELECT count(*) as count FROM `withdraw` where status='done' and type='ROI'")); 
 $totalResult = $totalResult1['count'];
//    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `withdraw` where status='done'"));
}
?>



<style>

    .pagination>li{

        display: inline;

    }

    body{
        color:darkred;
    }
</style>

<div class="main-container  mt-152">

    <div class="page-header">

        <div class="pull-left">

            <h2 >ROI Withdrawal Done Requests</h2>

        </div>
<!--        <div class="pull-right">
            <a href="controller/submit.php?withdraw_all=true"><button class="btn btn-info">Collect Withdraw Request</button></a>
        </div> -->

        <div class="pull-right" style="margin-right: 10px">

            <a href="printrequest.php" target='__blank'><input type='button' class='btn btn-success' value="Export All"></a>

        </div>
        <div class="pull-right" style="margin-right: 10px">

            <a href="export_withdraw_pending.php" target='__blank'><input type='button' class='btn btn-success' value="Export All In XL"></a>

        </div>



        <div class="clearfix"></div>

    </div>





    <style>



        .orangebuttion

        {

            background:#ff9800; padding:10px 20px; color:#FFF; border:none; cursor:pointer;

        }

        ul.pagination li

        {

            padding:5px 10px; background:#0e9048;

            margin-right:3px;

            cursor:pointer;

            color:#FFF;

            font-size:16px;



        }

        ul.pagination li a

        {

            color:#FFF;

        }

    </style>



    <div class="row-fluid">

        <div class="span12">

            <div class="widget">

                <div class="widget-header">

                    <div class="title">

                        List of Withdrawal Done (Total:-<?php echo $totalResult; ?>)

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

                        <div class='span12'><button class="orangebuttion" style="" onclick='selectForm()' >Change Filter</button></div>

                        <form action="" method ="get" class="form1" <?php if (isset($_GET['from'])) { ?> style="display:none;"<?php } ?>>

                            <label> Search From</label>

                            <select name="select_type" id="select_search" onchange="searchSelect()">
                                <option value="acc" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "acc") echo "selected"; ?> >Account Number</option>
                                <option value="name" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "name") echo "selected"; ?> >Name</option>
                                <option value="username" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "username") echo "selected"; ?> >User Id</option>
                                <option value="type" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "type") echo "selected"; ?> >Wallet type</option>


                            </select>    

                            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required> 

                            <input type="submit"  class="orangebuttion" name="submit" value="Search" > 

                            <a href="pending_request.php"><input class="orangebuttion" type="button" name="reset" value="Reset" > </a>

                        </form>

                        <script>

                            function selectForm() {

                                jQuery(".form1").toggle();

                                jQuery(".form2").toggle();

                            }

                        </script>

                        <form action="" method ="get" class="form2" <?php if (empty($_GET['from'])) { ?> style="display:none;"<?php } ?>>

                            <label> Search From Date</label>                               

                            <input type="hidden" name="select_type" value=""> 

                            <input type="hidden" name="v" id="date" value=""> 

                            <span> From<input type="text" name="from" id="datepicker"  > </span>

                            <span> to <input type="text" name="to" id="datepicker1"  > </span>

                            <input type="submit" name="submit" value="Search" > 

                            <a href="wallet_transaction.php"><input type="button" name="reset" value="Reset" > </a>

                        </form>

                    </div>

                    <div >



                        <ul class="pagination">

                            <li style="">Page </li>

<?php
//Pagination 

$pagenum = $totalResult / 50;

for ($i = 0; $i < $pagenum; $i++) {



    if (isset($_GET['select_type'])) {

        //Query Parameter

        $parameter = $_SERVER['QUERY_STRING'];

        //if page already send



        if (isset($_GET['page'])) {



            parse_str($parameter, $get_array);

            unset($get_array['page']);

            $parameter = http_build_query($get_array);
        }
        ?> 



                                    <li ><a href="?<?php echo $parameter; ?>&page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                                <?php } else { ?>

                                    <li ><a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                                <?php
                                }
                            }
                            ?> 

                        </ul>

                    </div>


                    <?php

                                        $quwith = "SELECT sum(amount) as sumwith FROM  `withdraw` where `status`='done' and `type`='ROI' ";
                                          if ($_GET['select_type'] != "") {
        $quwith .= " and  $column LIKE '%$value%' ";
    }
                                         if(isset($from)){

                                         $quwith .=" and datetime  >= '$from'" ; 

                                        }

                                        if(isset($to)){

                                          $quwith .=" and datetime  <= '$to'" ; 

                                        }

                                        

                                        $sumwith = mysqli_fetch_array(mysqli_query($db, $quwith));

                                        $dollarWith = (isset($sumwith['sumwith'])) ? $sumwith['sumwith'] : 0;

                                        echo '<h1>Total Done :- ' . round($dollarWith) . '</h1>';

                                        ?>  


                    <div class="table-responsive">
                            <form action="controller/function.php" method='post'>

                        <table id="myTable" class="table table-striped">

                            <thead>

                                <tr>



                                    <th>#</th>

                                    <th>User Id</th>

                                    <th>Name</th>

                                    <th>Withdraw type</th>
                                    <th>Withdraw Id</th>

                                    <th>Phone</th>

                                    <th>Transaction id</th>

                                    <th>Amount</th>

                                    <th>Date</th>
                                    <th>Confirm Date</th>
                                    <th>Done</th>


                                </tr>

                            </thead>

                            <tbody>

<?php
//Search data query
$offset = 0;
$pageResult = 50;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = (($page - 1) * 50) + 1;
}
$q = "SELECT * FROM  `withdraw` where status='done' and `type`='ROI' ";
if (isset($_GET['select_type'])) {

    $column = $_GET['select_type'];

    $value = $_GET['v'];

    if ($_GET['select_type'] != "") {

        $q .= " and  $column LIKE '%$value%' ";
    }
    if (isset($_GET['from'])) {
        $q .= " and date >= '" . $_GET['from'] . " 00:00:00' ";
    }
    if (isset($_GET['to'])) {

        $q .= " and date <= '" . $_GET['to'] . " 23:59:59' ";
    }
}
$q .= "order by date desc limit $pageResult offset $offset";
//                                echo $q;die;
//$userId = $user["id"];

$i = 1;

$queryUser = mysqli_query($db, $q);
$m = 1;
while ($dataQuery = mysqli_fetch_array($queryUser)) {
    $userquery = mysqli_query($db, "SELECT * FROM `user` where `id`= '" . $dataQuery['userId'] . "'");
    $userresult = mysqli_fetch_array($userquery);
    
    ?>

                                    <tr>                                   






                                        <td><?php echo $m++; ?>   </td>
                                        <td><?php echo $userresult['user_id']; ?>   </td>

                                        <td><?php echo $userresult['name']; ?>   </td>

                                        <td><?php echo $dataQuery['withdrawWallet']; ?>   </td>
                                        <td><?php echo $dataQuery['tansferid']; ?>   </td>

                                        <td><?php echo $userresult['phone']; ?>   </td>

                                        <td><?php echo $dataQuery['transaction_id']; ?>   </td>

                                        <td><?php echo $dataQuery['amount']; ?>   </td>
                                        <td><?php echo $dataQuery['date']; ?>  </td>
                                        <td><?php echo $dataQuery['confirmDate']; ?>  </td>
                                        <td>Succefully Done </td>
                                    </tr>
    <?php
    $i++;
}
?>


                                                                     
                            </tbody>

                        </table>
                        
                        <div class="modal fade" id="overlay1">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                    <h4 class="modal-title" style='color:red'>Please Enter Selected Withdraw Remarks </h4>

                                </div>

                                <div class="modal-body">

                                        <!--<input type="hidden" name="userId" id='uid' value="">-->

                                        <div style="width:60%;margin: 0 auto;"> 

                                            <div class="control-group">

                                                <!--<input type="text" onChange="checkUser()" id="user" onFocus="checkUser()" class="form-control" name="userId" placeholder="Enter User Id">-->

                                                <textarea name='remarks' class="form-control"></textarea>

                                                <div id="user_check_msg"></div>

                                            </div>

                                            <div class="control-group">

                                                <input type="submit"  class="btn btn-default" name="with_id_selected" value="submit">

                                                <input type="Reset" value="Reset"  class="btn btn-default">

                                            </div>

                                        </div>


                                </div>

                            </div>

                        </div>

                    </div>

                         <a class="btn btn-default btn-sm" onclick="checkout1(<?php echo $dataQuery['id']; ?>)" > Confirm Selected</a> 

                            </form>
                    </div>

                    <div >



                        <ul class="pagination">

                            <li style="">Page </li>

<?php
//Pagination 

$pagenum = $totalResult / 50;

for ($i = 0; $i < $pagenum; $i++) {



    if (isset($_GET['select_type'])) {

        //Query Parameter

        $parameter = $_SERVER['QUERY_STRING'];

        //if page already send



        if (isset($_GET['page'])) {



            parse_str($parameter, $get_array);

            unset($get_array['page']);

            $parameter = http_build_query($get_array);
        }
        ?> 



                                    <li ><a href="?<?php echo $parameter; ?>&page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                                <?php } else { ?>

                                    <li ><a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>

                                <?php
                                }
                            }
                            ?> 

                        </ul>

                    </div>
                    
                    <div class="modal fade" id="overlay">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                    <h4 class="modal-title">Please Enter  Withdraw Remarks </h4>

                                </div>

                                <div class="modal-body">

                                    <form action="controller/function.php" method="POST"     >

                                        <input type="hidden" name="userId" id='uid' value="">

                                        <div style="width:60%;margin: 0 auto;"> 

                                            <div class="control-group">

                                                <!--<input type="text" onChange="checkUser()" id="user" onFocus="checkUser()" class="form-control" name="userId" placeholder="Enter User Id">-->

                                                <textarea name='remarks' class="form-control"></textarea>

                                                <div id="user_check_msg"></div>

                                            </div>

                                            <div class="control-group">

                                                <input type="submit"  class="btn btn-default" name="with_id" value="submit">

                                                <input type="Reset" value="Reset"  class="btn btn-default">

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    

    <script>



        $(document).ready(function () {

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

        function checkout(id) {

            $("#uid").val(id);

            $('#overlay').modal('show');

        }
        function checkout1(id) {

            $('#overlay1').modal('show');

        }

        jQuery(function () {



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











    <!-- container-fluid -->

</div>

<?php 
include 'footer.php';
?>



