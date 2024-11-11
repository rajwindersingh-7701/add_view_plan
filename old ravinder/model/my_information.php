<?php
require_once "header.php";
$query1p = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='" . $userData['id'] . "' and type='national_id'");
$kycDatap = mysqli_fetch_array($query1p);
$query1n = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='" . $userData['id'] . "' and type='photo_id'");
$kycDatan = mysqli_fetch_array($query1n);
$query1pp = mysqli_query($db, "SELECT * FROM `kyc` WHERE userId='" . $userData['id'] . "' and type='user_pic'");
$kycDatapp = mysqli_fetch_array($query1pp);
?>




<div class="container-fluid">

    <div class="row mt-3">
        <div class="col-md-3 mb-3">
            <?php
            require_once "sidebar.php";
            ?>
        </div>
        <!--/.col-md-4 -->
        <div class = "col-md-9">

            <div class="row main-body pt-0">
                <div class="content-wrapper">

                    <section class="content">

                        <div class="row">

                            <div class="col-md-12 p-4">
                                <div class="box box-info">
                                    <div class="box-header with-border"><h3 class="box-title">Show Profile</h3></div>
                                </div>
                                <div class="box-body padding">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> User Id </th>
                                                <td><?php echo $userData['user_id']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> Refferal Link</th>
                                                <td>https://www.oduwa.io//Register.php?sponsor=<?php echo $user_id; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i>Name </th>
                                                <td><?php echo $userData['name']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> Phone No </th>
                                                <td><?php echo $userData['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-envelope user-profile-icon"></i> E-mail </th>
                                                <td colspan="3"> <?php echo $userData['email']; ?></td>

                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> City </th>
                                                <td><?php echo $userData['city']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> State </th>
                                                <td><?php echo $userData['state']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> Country  </th>
                                                <td><?php echo $userData['country']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-trophy user-profile-icon"></i> My Current Plan </th>
                                                <td><?php echo ($packData['price']) . 'BDC'; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-calendar user-profile-icon"></i> Date of Joining</th>
                                                <td><?php echo $userData['Date']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-check user-profile-icon"></i>Status </th>
                                                <th><span class="text-success">Activate</span></th>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <a href="index.php?page=edit-profile" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-edit m-right-xs"></i> Edit My Info
                                                    </a>
                                                </td>
                                                <td colspan="3" class="text-right">
                                                    <a class="btn btn-info btn-sm" href="index.php?page=user-profile">
                                                        <i class="fa fa-refresh"></i> View Profile!!!
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border"><h3 class="box-title">Account Details</h3></div>
                                </div>
                                <div class="box-body padding">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> Bitcoin Address </th>
                                                <td><?php echo $userData['bitcoin']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone user-profile-icon"></i> Joining Date</th>
                                                <td><?php echo $userData['Date']; ?></td>
                                            </tr>



                                            <tr>
                                                <td>
                                                    <a href="account.php" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-edit m-right-xs"></i> Edit My Info
                                                    </a>
                                                </td>

                                            </tr>
                                        </tbody></table>
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
            </div>
        </div>


        <!-- /.container -->
    </div>
</div>



<?php
include ('footer.php');
?>