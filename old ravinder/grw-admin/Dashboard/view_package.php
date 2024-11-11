<?php
require_once("include/header.php");
require_once("../../database/db.php");
?>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>All package </h2>
        </div>

        <div class="clearfix"></div>
    </div>




    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        List of package
                    </div>
                </div>
                <div class="widget-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>


                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Daily Roi</th>
                                    <th>Roi Days</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                // $userId = $user["id"];
                                $i = 1;
                                $query = mysqli_query($db, "SELECT * FROM  `package` where status='1'  order by id asc ");
                                while ($dataQuery = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>

                                        <td><?php echo $i;
                                $i++;
                                ?>   </td>
                                        <td><?php echo $dataQuery['title']; ?>   </td>
                                        <td><?php echo $dataQuery['price']; ?>   </td>
                                        <td><?php echo $dataQuery['roi']; ?>   </td>
                                        <td><?php echo $dataQuery['roi_days']; ?>   </td>
                                        <td><a href="add_package.php?pack=<?php echo $dataQuery['id']; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> </a> </td>
                                        <td><a href="?delete=<?php echo $dataQuery['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure for delete this package!')"><i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

