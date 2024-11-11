<?php
require_once("include/header.php");

$query = "select * from `galleryimage` order by id desc";
$con = mysqli_query($db, $query);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
    .widget-body i {
        position: relative;
        top: 0px;
        right: 0px;
        font-size:24px;
        color:red;
    }
    .link-delete {

        text-align: center;
        float: right;

        border-radius: 6px;
        margin: 5px 5px;
    }
    .link-delete i
    {
        font-size: 20px;
        color: #fff;
        padding: 10px 12px;

    }
</style>
<div class="main-container mt-152">

    <div id="verticalcenter" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="controller/submit.php" method="post" enctype="multipart/form-data" id="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="controls">



                            <input type="file" name="file[]" id="file" multiple>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button  type="submit" name="galleryImg" class="btn btn-primary loginpassword">Submit</button>
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 pull-left"><h2>View Gallery Image</h2></div>
            <div class="col-md-5"></div>


            <div class="col-md-3">
                <a href="#">
                    <button data-toggle="modal" data-target="#verticalcenter" class="pull-right bg-success text-white p-2 model_img img-responsive"> Add Gallery Image</button></a><br></div>


        </div>
        <br>
        <br>
        <div class="row">
<?php while ($row = mysqli_fetch_assoc($con)) { ?>

                <div class="col-md-3">
                    <div class="card img-thumbnail">
                        <div class='g-link'>
                            <a data-toggle="modal" data-target="#verticalcenter" class='link-delete bg-success' href=""><i class="fa fa-edit"></i></a>
                            <a class='link-delete bg-danger' href="controller/submit.php?del=<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i></a>

                        </div>

                        <img class=" w-100" src="<?php echo "../uploads/" . $row['image']; ?>">



                    </div>
                </div>
<?php } ?>

        </div>

    </div>


</div>





<?php
include 'footer.php';
?>
