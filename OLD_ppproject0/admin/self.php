<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');

?>
<?php
//Clicked on send buton
if(isset($_GET['aid'])){
	
	
	mysqli_query($con,"update user set status='Active' where id='".$_GET['id']."' ");
	
	echo '<script>alert("Active successfully.");window.location.assign("user.php");</script>';	
}
if(isset($_GET['uid'])){
	
	
	mysqli_query($con,"update user set status='Unlock' where id='".$_GET['id']."' ");
	
	echo '<script>alert("Unactive successfully.");window.location.assign("user.php");</script>';	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Super Digital Coin  - Self Income</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script>function exportF(elem) {
  var table = document.getElementById("table");
  var html = table.outerHTML;
  var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  elem.setAttribute("href", url);
  elem.setAttribute("download", "user.xls"); // Choose the file name
  return false;
}</script>
 
<link rel="stylesheet"  
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
        <style>   
        table {  
            border-collapse: collapse;  
        }  
            .inline{   
                display: inline-block;   
                float: right;   
                margin: 20px 0px;   
            }   
             
            input, button{   
                height: 34px;   
            }   
      
        .pagination {   
            display: inline-block;   
        }   
        .pagination a {   
            font-weight:bold;   
            font-size:18px;   
            color: black;   
            float: left;   
            padding: 8px 16px;   
            text-decoration: none;   
            border:1px solid black;   
        }   
        .pagination a.active {   
                background-color: pink;   
        }   
        .pagination a:hover:not(.active) {   
            background-color: skyblue;   
        }   
            </style> 
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Self Income</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<a id="downloadLink" onclick="exportF(this)"><button value="Export to excel" >Export to excel</button></a><br>
                            <br>
                            <form action="" method="post"><table width="100%">
                            <tr><td> Userid:
                            <input type="text" name="login" class="form-control" style="width:90%"></td>
                            <td>&nbsp;  
                            <input type="submit" name="submit" value="Search" class="form-control" style="width:50%"></td>
                           </tr> </table></form><br>
                           <center>  
        <?php  
          
        // Import the file where we defined the connection to Database.     
            include('php-includes/connect.php');  
        
            $per_page_record = 100;  // Number of entries to show in a page.   
            // Look for a GET variable page if not found default is 1.        
            if (isset($_GET["page"])) {    
                $page  = $_GET["page"];    
            }    
            else {    
              $page=1;    
            }    
        
            $start_from = ($page-1) * $per_page_record;     
        
            $query = "SELECT * FROM self_in order by id desc LIMIT $start_from, $per_page_record";     
            $rs_result = mysqli_query ($con, $query);    
        ?>    
      
        <div class="container">   
          <br>   
          <div>   
            
            <table class="table table-striped table-condensed    
                                              table-bordered">   
              <thead>   
                <tr>   
                   <th>#</th>  
                  <th>User ID</th>   
                  <th>Amount</th>   
                  <th>Date</th>   
                </tr>   
              </thead>   
              <tbody>   
        <?php     $i=0;
                while ($row = mysqli_fetch_array($rs_result)) {    
                  $i++;    // Display each field of the records.    
                ?>     
                <tr> <td><?php echo $i;?></td>    
                 <td><?php echo $row["userid"]; ?></td>     
                <td><?php echo $row["amount"]; ?></td>   
                <td><?php echo $row["r_date"]; ?></td>   
                                                           
                </tr>     
                <?php     
                    };    
                ?>     
              </tbody>   
            </table>   
      
         <div class="pagination">    
          <?php  
            $query = "SELECT COUNT(*) FROM self_in";     
            $rs_result = mysqli_query($con, $query);     
            $row = mysqli_fetch_row($rs_result);     
            $total_records = $row[0];     
              
        echo "</br>";     
            // Number of pages required.   
            $total_pages = ceil($total_records / $per_page_record);     
            $pagLink = "";       
          
            if($page>=2){   
                echo "<a href='self.php?page=".($page-1)."'>  Prev </a>";   
            }       
                       
            for ($i=1; $i<=$total_pages; $i++) {   
              if ($i == $page) {   
                  $pagLink .= "<a class = 'active' href='self.php?page="  
                                                    .$i."'>".$i." </a>";   
              }               
              else  {   
                  $pagLink .= "<a href='self.php?page=".$i."'>   
                                                    ".$i." </a>";     
              }   
            };     
            echo $pagLink;   
      
            if($page<$total_pages){   
                echo "<a href='self.php?page=".($page+1)."'>  Next </a>";   
            }   
      
          ?>    
          </div>  
      
      
              
        </div>   
      </div>  
    </center>   
      <script>   
        function go2Page()   
        {   
            var page = document.getElementById("page").value;   
            page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
            window.location.href = 'self.php?page='+page;   
        }   
      </script>  
                        </div><!--/.table-responsive-->
                    </div>
                </div><!--/.row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
