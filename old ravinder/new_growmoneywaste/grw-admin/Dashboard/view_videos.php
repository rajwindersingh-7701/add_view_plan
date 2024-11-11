<?php
require_once("include/header.php");

$query = "select * from `galleryvideo` order by id desc";
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
<script type="text/javascript">
    function getYoutubeLink() {
        var url = document.getElementById("videolink").value;
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        var match = url.match(regExp);
        var videoId = (match && match[2].length === 11) ? match[2] : '';
        console.log("VidoeID=" + videoId)
        if (url == '' || videoId == '') {
            alert("Invalid Link!");
            return false;
        }
        else {
            link = 'https://www.youtube.com/embed/' + videoId;
            document.getElementById("videolink").value = link;
            return true;
        }
    }
    //
    //const videoId = getId('http://www.youtube.com/watch?v=zbYf5_S7oJo');</script>
<div class="main-container mt-152">
    <div id="verticalcenter" class="modal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="controller/submit.php" method="post" enctype="multipart/form-data" id="form" onsubmit="return getYoutubeLink();">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="vcenter">Video</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="controls">
                            <label>Youtube Video URL</label>
                            <input class="" type="url" name="videolink" id="videolink" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="submit" name="galleryVideo" class="btn btn-primary loginpassword">Submit</button>
                        <button type="button" class="btn btn-info waves-effect m-b-10" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 pull-left"><h2>View Gallery Video</h2></div>
            <div class="col-md-5"></div>
            <div class="col-md-3">
                <a href="#">
                    <button data-toggle="modal" data-target="#verticalcenter" class="pull-right bg-success text-white p-2 model_img img-responsive"> Add Gallery Video</button></a><br>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($con)) { ?>
                <div class="col-md-3 col-6">
                    <div class="border">
                        <iframe width="100%" src="<?php echo $row['link']; ?>" frameborder="0"  allowfullscreen></iframe>
                        <form  action="controller/submit.php" method="post" onsubmit="return confirm('Do you really want to Delete?');">
                            <input type="hidden" name="vid" value="<?php echo $row['ID']; ?>"/>
                            <button type="submit" name="deletevideo" class="btn btn-danger btn-block">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
