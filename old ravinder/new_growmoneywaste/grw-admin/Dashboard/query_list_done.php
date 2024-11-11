<?php
require_once("include/header.php");

if(isset($_GET['select_type'])){
    if($_GET['select_type']!=""){
        $column = $_GET['select_type'];
       $value = $_GET['v'];
    $q = "SELECT * FROM  `support` where status='Resolved'";
  
    }
   
    if(isset($_GET['from'])){
         $q = "SELECT * FROM  `support` where status='Resolved' and  datetime >= '".$_GET['from']." 00:00:00'";
    }
    if(isset($_GET['to'])){
         $q .= " and  datetime <= '".$_GET['to']." 23:59:59 '";
    }
      $totalResult = mysqli_num_rows(mysqli_query($db, $q));    
}else{
 $totalResult = mysqli_num_rows(mysqli_query($db,"SELECT * FROM  `support` where status='Resolved'")); 
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
            <h2>Users </h2>
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
                        List of all users (Total:-<?php echo $totalResult ; ?>)
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
                        <form action="" method ="get" class="form1" <?php if(isset($_GET['from'])){?> style="display:none;"<?php } ?>>
                            <label> Search From</label>
                            <select name="select_type" id="select_search" onchange="searchSelect()">
                                
                                <option value="name" <?php if(isset($_GET['select_type'])) if($_GET['select_type']=="name") echo "selected"; ?>>Name</option>
                            </select>    
                            <input type="text" name="v" value="<?php if(isset($value)) echo $value; ?>" placeholder="Please enter your keyword" required> 
                            <input type="submit"  class="orangebuttion" name="submit" value="Search" > 
                            <a href="Users.php"><input class="orangebuttion" type="button" name="reset" value="Reset" > </a>
                        </form>
                        <script>
                        function selectForm(){
                           jQuery(".form1").toggle();
                           jQuery(".form2").toggle();
                        }
                        </script>
                        <form action="" method ="get" class="form2" <?php if(empty($_GET['from'])){?> style="display:none;"<?php } ?>>
                            <label> Search From Date</label>                               
                            <input type="hidden" name="select_type" value=""> 
                            <input type="hidden" name="v" id="date" value=""> 
                            <span> From<input type="text" name="from" id="datepicker"  > </span>
                            <span> to <input type="text" name="to" id="datepicker1"  > </span>
                            <input type="submit" name="submit" value="Search" > 
                            <a href="Users.php"><input type="button" name="reset" value="Reset" > </a>
                        </form>
                    </div>
                    <div >
                       
                        <ul class="pagination">
                            <li style="">Page </li>
                            <?php
                            //Pagination 
                            $pagenum = $totalResult / 100 ;
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
                             <?php } else {?>
                                    <li ><a href="?page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                                <?php } }   ?> 
                        </ul>
                    </div>


                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                     <th>User Id</th>
                                     <th>Topic</th>
                                     <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
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
                                $q = "SELECT * FROM  `support` where status='Resolved' ";
                               
                                if (isset($_GET['select_type'])) {
                                    $column = $_GET['select_type'];
                                    $value = $_GET['v'];
                                    if($_GET['select_type']!=""){
                                    $q .= " and  $column Like '%$value%' ";  
                                    }
                                    if(isset($_GET['from'])){
                                        $q .= " and datetime >= '".$_GET['from']." 00:00:00' ";  
                                    }
                                    if(isset($_GET['to'])){
                                        $q .= " and datetime <= '".$_GET['to']." 23:59:59' ";  
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

                                        <td><?php echo $i.'.'; ?>   </td>
                                    <td><?php echo $dataQuery['user_id']; ?>   </td>
                                    <td><?php echo $dataQuery['topic']; ?>   </td>
                                    <td><?php echo $dataQuery['subject']; ?>   </td>
                                    <td><?php echo $dataQuery['message'];?>   </td>
                                    <td><?php echo $dataQuery['status']; ?>   </td>
                                    <td><?php echo $dataQuery['datetime']; ?>   </td>
                                        

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

