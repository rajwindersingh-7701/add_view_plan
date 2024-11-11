<?php
require_once("header.php");
$user = $_SESSION["user"];
$user_id = $user["user_id"];
$userId = $user["id"];
$str='';
if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $str='select_type=&';
        $q = "SELECT * FROM  `downline_count` where `tag_sponsor`= '$user_id' && `position`='right'   &&  $column='$value'";
    }

    if (isset($_GET['from'])) {
          $str='select_type=&from='.$_GET['from'].'&';
        $fromDate = date("Y-m-d", strtotime($_GET['from']));
        $q = "SELECT * FROM `downline_count` where `tag_sponsor`= '$user_id' && `position`='right' and date >= '" . $fromDate . " 00:00:00'";
//        echo $q;die;
    }
    if (isset($_GET['to']) and $_GET['to'] != '') {
        $str.='to='.$_GET['to'].'&';
        $toDate = date("Y-m-d", strtotime($_GET['to']));
        $q .= " and  date <= '" . $toDate . " 23:59:59 '";
    }
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `downline_count` where `tag_sponsor`= '$user_id' && `position`='right'"));
//    $leftsmw= mysqli_fetch_array(mysqli_query($db,"SELECT * FROM down_count_total WHERE `userId`='".$userData['id']."'"));
//    $totalResult = $leftsmw['right'];
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header p-0">
      <h1>
        Right Participant
        <small>Control panel</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      
      <div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border"><h3 class="box-title p-2"><strong>List of Participant (Total:-<?php echo $totalResult; ?>)</strong></h3></div>
		</div>
		<div class="box-body padding" style="background:#FFFFFF; margin-top:-2%">
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
                            <a href="downline.php"><input class="orangebuttion" type="button" name="reset" value="Reset" > </a>
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
                            <a href="Users.php"><input type="button" name="reset" value="Reset" > </a>
                        </form>
                    </div>
                    
                    <div >
                       <p><?php echo "Total Result:- ".$totalResult; ?></p>
                        <ul class="pagination">
                            <li style="">Page </li>
                            <?php
//                            echo "SELECT * FROM  `wallet`  where `type`= 'debit' && `userId` ='$uiid'";
//                                $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT `id` FROM  `wallet`  where `type`= 'credit' && `userId` ='$uiid'"));

                            //Pagination 
                            $pagenum = ceil($totalResult / 100);
                            if($totalResult > 100){
                            for ($i = 0; $i < 10; $i++) {
                                
                                ?>
                                    <li ><a href="?<?php echo $str; ?>page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                                <?php
                                
                            } 
                            ?>
                                    <li>.... </li>
                                <?php
                            if(isset($_GET['page']) ){
                                if($pagenum > $_GET['page']){
                                $startpage = $_GET['page']-5;
                                $endpage = $_GET['page']+5;
                                if($startpage <= 0){
                                    $startpage=1;
                                }
                                
                                 for ($i = $startpage; $i < $endpage; $i++) {
                                
                                ?>
                                    <li ><a href="?<?php echo $str; ?>page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                                <?php
                                
                             }
                                }
                            }else{
                                 $startpage = ceil($pagenum/2)-5;
                                $endpage = ceil($pagenum/2)+5;
                                 if($startpage <= 0){
                                    $startpage=1;
                                }
                                 for ($i = $startpage; $i < $endpage; $i++) {
                                     
                                ?>
                                    <li ><a href="?<?php echo $str; ?>page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                           <?php
                            }
                            
                                 }
                            ?>
                                    <li>.... </li>
                                <?php
                            $lastPage = ceil($pagenum-3);
                                if($lastPage <= 0){
                                    $lastPage=1;
                                }
                            for ($i = $lastPage; $i < $pagenum; $i++) {
                                
                                ?>
                                    <li ><a href="?<?php echo $str; ?>page=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a></li>
                                <?php
                                
                            } ?>
                                    
                                   
                        </ul>
                         <span>
                             <form action=''>
                                 <input type='number' name='page' style='width:80px;padding: 3px;margin-right: 20px;margin-top: 2px;' value='<?php if(isset($_GET['page'])){ echo $_GET['page']; } ?>'>
                                 <input type='submit' value='GO TO PAGE' class='btn btn-flat'>
                             </form>
                         </span>
                          <?php } ?>
                    </div>
             
             
		</div>
	</div>
  <div style="width:100%; float:left; margin:0px 0p">
  <p>&nbsp;</p>
   
  </div>

    <div class="col-md-12">
		<div class="box-body padding" style="background:#FFFFFF; margin-top:-2%">
			<div class="table-responsive">
                        <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User id</th>
                                    <th>Position</th>
                                    <th>Sponsor</th>
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
                                $q = "SELECT * FROM `downline_count` where `tag_sponsor`= '$user_id'  && `position`='right' ";

                                if (isset($_GET['select_type'])) {
                                    $column = $_GET['select_type'];
                                    $value = $_GET['v'];
                                    if ($_GET['select_type'] != "") {
                                        $q .= " and  $column Like '%$value%' ";
                                    }
                                    if (isset($_GET['from'])) {
                                        $q .= " and Date >= '" . $fromDate . " 00:00:00' ";
                                    }
                                    if (isset($_GET['to'])) {
                                        if ($_GET['to']!='') {
                                        $q .= " and Date <= '" . $toDate . " 23:59:59' ";
                                    }
                                    }
                                }

                                $q .= "order by id ASC limit $pageResult offset $offset";

//                                echo $q;die;
//$userId = $user["id"];
                                $i = 1;$m=1;
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                   $userqdata = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` where `user_id`= '" . $dataQuery['user_id'] . "'"));
                                    $packagePrice = "<p style='color:red'>" . $userqdata["package"] . "<p>";
                                    if ($userqdata["package"] != "InActive") {

                                        $userquery = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `package` where `id`= '" . $dataQuery['top_up'] . "'"));
                                        
                                        $packagePrice = "<p style='color:green'>" . $userquery["price"] . "<p>";
                                    }
                                    $sponserName = $userClass->getUserFromUserId($db, $userqdata['sponser_by']);
                                    ?>
                                    <tr>
                                        <td><?php echo $m++; ?>   </td>
                                        <td><?php echo $userqdata['name']; ?>   </td>
                                        <td><?php echo $userqdata['user_id']; ?>   </td>
                                        <td><?php echo $dataQuery['position']; ?>   </td>
                                        <td><?php echo $userqdata['sponser_by'] . '(' . $sponserName['name'] . ')'; ?>  </td>
                                        <td><?php echo $userqdata['Date']; ?>  </td>
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
    
    
    
    
        <!-- Left col -->
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  
<script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        jQuery( ".treeview-menu" ).hide();
        jQuery( ".treeview" ).removeClass( "active" );
        
        jQuery( ".menu3>ul" ).show();
        jQuery( ".menu3" ).addClass( "active" );
        
    </script>
 <?php include "footer.php" ?>