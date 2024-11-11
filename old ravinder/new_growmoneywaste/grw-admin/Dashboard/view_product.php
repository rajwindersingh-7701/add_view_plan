<?php
require_once("include/header.php");

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `product` where $column='$value' and stock!='0'";
    }

    if (isset($_GET['from'])) {
        $q = "SELECT * FROM  `product` where  DateTime >= '" . $_GET['from'] . " 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $q .= " and  Date <= '" . $_GET['to'] . " 23:59:59 '";
    }
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = $fu->totalProduct($db);
}
?>

<style>
    .pagination>li{
        display: inline;
    }

</style>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>Product <i class="fa fa-shopping-cart" aria-hidden="true"></i> </h2>
        </div>
        <div class="pull-right">
            <a href="add_product.php"> <button class="btn btn-default">Add New Products </button></a>
        </div>

        <div class="clearfix"></div>
    </div>

    <style>

        .orangebuttion
        {
            background:#ff9800; padding:10px 20px; color:#FFF; border:none; cursor:pointer;
        }
        ul.pagination li {
            padding: 2px 3px;
            background: #0e9048;
            margin-right: 0px;
            cursor: pointer;
            color: #FFF;
            font-size: 11px;
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
                        List of all Products (Total:-<?php echo $totalResult; ?>)
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
                        <div class='span12'>
                            <div class="pull-left">
                                <button class="orangebuttion" style="" onclick='selectForm()' >Change Filter</button>
                            </div>
                            <div class="pull-right">
                                <form>
                                    <input type='button' class="btn btn-default"  value="Export All" style="color:#fff;margin: 0px 15px;">
                                </form>
                            </div>
                        </div>
                        <form action="" method ="get" class="form1" <?php if (isset($_GET['from'])) { ?> style="display:none;"<?php } ?>>
                            <label> Search From</label>
                            <select name="select_type" id="select_search" onchange="searchSelect()">
                                <option value="name" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "user_id") echo "selected"; ?> >Name</option>
                                <option value="code" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "name") echo "selected"; ?>>Code</option>
                                <!--<option value="package">Package Name</option>-->
                                <option value="MRP" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser") echo "selected"; ?>>MRP</option>
                                <option value="PV" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "sponser_by") echo "selected"; ?>>PV</option>
                                <option value="DP" <?php if (isset($_GET['select_type'])) if ($_GET['select_type'] == "phone") echo "selected"; ?>>DP</option>
                            </select>    
                            <input type="text" name="v" value="<?php if (isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required> 
                            <input type="submit"  class="orangebuttion" name="submit" value="Search" > 
                            <a href="view_product.php"><input class="orangebuttion" type="button" name="reset" value="Reset" > </a>
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
                            <a href="view_product.php"><input type="button" name="reset" value="Reset" > </a>
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
                                <?php }
                            } ?> 
                        </ul>
                    </div>


                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Code</th>
                                    <th>Stock</th>
                                    <th>MRP</th>
                                    <th>DP</th>
                                    <th>BV</th>
                                    <th>Date</th>
                                    <th>Action</th>
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
                                $q = "SELECT * FROM  `product` where stock!='0'";

                                if (isset($_GET['select_type'])) {
                                    $column = $_GET['select_type'];
                                    $value = $_GET['v'];
                                    if ($_GET['select_type'] != "") {
                                        $q .= " and  $column like '$value' ";
                                    }
                                    if (isset($_GET['from'])) {
                                        $q .= " and DateTime >= '" . $_GET['from'] . " 00:00:00' ";
                                    }
                                    if (isset($_GET['to'])) {
                                        $q .= " and DateTime <= '" . $_GET['to'] . " 23:59:59' ";
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

                                        <td><?php echo $i; ?>   </td>
                                        <td><?php echo $dataQuery['name']; ?>   </td>
                                        <td><?php echo $dataQuery['category']; ?>   </td>
                                        <td><?php echo $dataQuery['code']; ?>   </td>
                                        <td><?php echo $dataQuery['stock']; ?> </td>                                   
                                        <td><?php echo $dataQuery['MRP']; ?>  </td>
                                        <td><?php echo $dataQuery['DP']; ?>  </td>
                                        <td><?php echo $dataQuery['PV']; ?>  </td>
                                        <td><?php echo $dataQuery['DateTime']; ?>  </td>
                                        <td>
                                            <a  href="edit_product.php?pid=<?php echo $dataQuery['id']; ?>" class="btn btn-danger" data-original-title="">Edit</a>  
                                            <a  href="add_stock.php?pid=<?php echo $dataQuery['id']; ?>" class="btn btn-danger" data-original-title="">Add stock</a>  
                                        </td>

                                    </tr>
    <?php
    $i++;
}
?>


                            </tbody>
                        </table>
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
                                    <?php }
                                } ?> 
                            </ul>
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

    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
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


    <script>



        function login(val) {
            $.ajax({
                url: "controller/function.php",
                type: "GET",
                data: {ido: val},
                success: function (response) {

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

