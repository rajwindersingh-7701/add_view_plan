<?php
require_once("header.php");
$user = $_SESSION["user"];
$user_id = $user["user_id"];
$userId = $user["id"];
$str='';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="col-lg-9">
      
      <section class="content-header p-0">
      <h1>
       Rejected Kyc
        <small>Control panel</small>
      </h1>
      
    </section>
  
    <section class="content">
      <div class="row">
    <div class="col-md-12">
		<div class="box-body padding" style="background:#FFFFFF; margin-top:-2%">
			<div class="table-responsive">
                        <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account Name</th>
                                    <th>Bank Name</th>
                                    <th>Bank Ifsc</th>
                                    <th>Account Number</th>
                                    <th>Pan Number</th>
                                    <th>Remarks</th>
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
                                $q = "SELECT * FROM `user_kyc` where `userId`= '$userId' and kyc_status = -1 ";
                                $q .= "order by id desc limit $pageResult offset $offset";
//echo $q; 
                                $queryUser = mysqli_query($db, $q);
                                while ($dataQuery = mysqli_fetch_array($queryUser)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $m++; ?>   </td>
                                        <td><?php echo $dataQuery['account_name']; ?>   </td>
                                        <td><?php echo $dataQuery['bank_name']; ?>   </td>
                                        <td><?php echo $dataQuery['bank_ifsc']; ?>   </td>
                                        <td><?php echo $dataQuery['account_number']; ?>  </td>
                                        <td><?php echo $dataQuery['pan']; ?>  </td>
                                        <td><?php echo $dataQuery['kyc_remarks']; ?>  </td>
                                        <td><?php echo $dataQuery['createdAt']; ?>  </td>
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

    </section>
    <!-- /.content -->
  </div>
  </div>
<!-- Middle End -->
</div>
</div>
</div>
<?php require 'footer.php'; ?>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script>
        jQuery( ".treeview-menu" ).hide();
        jQuery( ".treeview" ).removeClass( "active" );
        
        jQuery( ".menu3>ul" ).show();
        jQuery( ".menu3" ).addClass( "active" );
        
    </script>