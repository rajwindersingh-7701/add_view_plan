<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `payment_invest` where $column='$value'";
        $totalResult = mysqli_num_rows(mysqli_query($db, $q));
    }

    if (isset($_GET['from'])) {
        if ($_GET['from'] != "") {
            $q = "SELECT * FROM  `payment_invest` where status='pending' and date >= '" . $_GET['from'] . " 00:00:00'";
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
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM `payment_invest` where status='pending'"));
}
?>

<style>
    .pagination>li{
        display: inline;
    }

</style>
<div class="main-container">
    <div class="page-header">
        <div class="pull-left">
            <h2>Pending Requests</h2>
        </div>
 <div class="pull-right">
            <!--<a href="controller/submit.php?withdraw_all=true"><button class="btn btn-info">Collect Withdraw Request</button></a>-->
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
                        List of Investment Pending Request(Total:-<?php echo $totalResult; ?>)
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
                                <option value="user_id" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "user_id") echo "selected"; ?> >User Id</option>
                            </select>    
                            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required> 
                            <input type="submit"  class="orangebuttion" name="submit" value="Search" > 
                            <a href="tds_detail.php"><input class="orangebuttion" type="button" name="reset" value="Reset" > </a>
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
                            <span> From<input type="date" name="from" id="datepicker"  > </span>
                            <span> to <input type="date" name="to" id="datepicker1"  > </span>
                            <input type="submit" name="submit" value="Search" > 
                            <a href="wallet_transaction.php"><input type="button" name="reset" value="Reset" > </a>
                        </form>
                    </div>
                    <div >

                        <ul class="pagination">
                            <li style="">Page </li>
                            <?php
//Pagination 
                            $pagenum = $totalResult / 100;
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
                                <?php }
                            }
                            ?> 
                        </ul>
                    </div>

                    

                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Slip</th>
                                    <th>Transfer type</th>
                                    <th>Company Bank</th>
                                    <th>From Bank</th>
                                    <th>User id</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
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
                                $q = "SELECT * FROM  `payment_invest` where status='pending'";

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

                                $q .= "order by id desc limit $pageResult offset $offset";

//                                echo $q;die;
//$userId = $user["id"];
                                $i = 1;
                                $m=1;
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
//                                    echo "SELECT * FROM `user` where `user_id`= '" . $userresult['user_id'] . "'";
                                    $userquery = mysqli_query($db, "SELECT * FROM `user` where `user_id`= '" . $dataQuery['user_id'] . "'");
                                    $userresult = mysqli_fetch_array($userquery);
                                    ?>
                                    <tr>                                   


                                        <td><?php echo $m++; ?>   </td>
                                        <td><a href="../../Dashboard/uploads/<?php echo $dataQuery['Slip']; ?>" target="__blank"><img src="../../Dashboard/uploads/<?php echo $dataQuery['Slip']; ?>"  style='max-width:100px;'> </a></td>
                                        <td><?php echo $dataQuery['payType']; ?>   </td>
                                        <td><?php echo $dataQuery['chequeOfBankNam']; ?>   </td>
                                        <td><?php echo $dataQuery['chequeOfBankNam']; ?>   </td>
                                        <td><?php echo $dataQuery['user_id']; ?>   </td>
                                        <td><?php echo $userresult['name']; ?>   </td>
                                        <td><?php echo $dataQuery['amount']; ?>   </td>
                                        <td> <?php if ($dataQuery['status'] == 'pending') { ?> <p style="color: red;"> <?php echo $dataQuery['status']; ?></p> <?php } else { ?> <p style="color: green;"> <?php echo $dataQuery['status']; ?></p>  <?php } ?>     </td>
                                         <td><a class="btn btn-default btn-sm" onclick="checkout(<?php echo $dataQuery['id']; ?>)" >Confirm</a>
                                        <a class="btn btn-default btn-sm" onclick="checkout1(<?php echo $dataQuery['id']; ?>)" >Reject</a> </td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="overlay">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Please Enter confirmation description </h4>
                                </div>
                                <div class="modal-body">
                                    
                                    <form action="controller/register_submit.php" method="POST">
                                        <input type="hidden" name="refId" id='uid' value="">
                                        <div style="width:60%;margin: 0 auto;"> 
                                            <div class="control-group">
                                             Received Confirm Amount<input type='text' name='amount' class="form-control">
                                            </div>
                                            <div class="control-group">
                                                <!--<input type="text" onChange="checkUser()" id="user" onFocus="checkUser()" class="form-control" name="userId" placeholder="Enter User Id">-->
                                              Remarks  <textarea name='remarks' class="form-control"></textarea>
                                                <div id="user_check_BPg"></div>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit"  class="btn btn-default" name="investconfirmation" value="submit">
                                                <input type="Reset" value="Reset"  class="btn btn-default">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="overlay1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Please Enter rejected description </h4>
                                </div>
                                <div class="modal-body">
                                    <form action="controller/register_submit.php" method="POST">
                                        <input type="hidden" name="refId" id='uid1' value="">
                                        <div style="width:60%;margin: 0 auto;"> 
                                            <div class="control-group">
                                                <!--<input type="text" onChange="checkUser()" id="user" onFocus="checkUser()" class="form-control" name="userId" placeholder="Enter User Id">-->
                                                <textarea name='remarks' class="form-control"></textarea>
                                                <div id="user_check_BPg"></div>
                                            </div>
                                            <div class="control-group">
                                                <input type="submit"  class="btn btn-default" name="rejected" value="submit">
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
 function checkout(id){
             $("#uid").val(id);
            $('#overlay').modal('show');
        }
 function checkout1(id){
             $("#uid1").val(id);
            $('#overlay1').modal('show');
        }
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
  jQuery( function() {

      jQuery( "#datepicker" ).datepicker({
        changeYear: true,
        changeMonth: true,
         maxDate:new Date(),
         dateFormat: "yy-mm-dd "
//        yearRange: "2017:2020"
      });
      jQuery( "#datepicker1" ).datepicker({
        changeYear: true,
        changeMonth: true,
        maxDate:new Date() ,
        dateFormat: "yy-mm-dd "
//        yearRange: "2017:2020"
      });
    //jQuery( "#datepicker" ).datepicker();
  } );
  </script>


    


    <!-- container-fluid -->
</div>
<!--End of Tawk.to Script-->
</body> 
</html>

