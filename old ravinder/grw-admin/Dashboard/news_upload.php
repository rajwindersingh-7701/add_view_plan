<?php
require_once("include/header.php");
require_once("../../database/db.php");
if (isset($_POST['insertdata'])) {

    $sql = "INSERT INTO news (title,new_news) VALUES ('" . $_POST['title'] . "','" . $_POST['new_news'] . "')";
    mysqli_query($db, $sql);
    $_SESSION["invest"] = array("msg" => "News successfully Uploaded.", "status" => "true");
}
?>
<!-- Profile bar -->
<!-- End Profile bar -->

<div class="main-container  mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>News</h2>
        </div>
        <div class="clearfix"></div>
    </div>

    <style>
        .orangebuttion {
            background: #ff9800;
            padding: 10px 20px;
            color: #FFF;
            border: none;
            cursor: pointer;
        }

        ul.pagination li {

            padding: 5px 10px;
            background: #0e9048;

            margin-right: 3px;

            cursor: pointer;

            color: #FFF;

            font-size: 16px;
        }

        ul.pagination li a {

            color: #FFF;
        }

        .pull-left {
            float: left;
            width: 100%;
        }
    </style>

    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="page-header">
                    <div class="pull-left">
                        <div class="widget-header">
                            <div class="title">

                            </div>
                        </div>

                        <div class="widget-body">
                            <!-- Edit personal info  -->
                            <div id="edit-personal-details" style="display: block" class="accord bg-offwhite shadow">
                                <div class="content-edit-area">
                                    <div class="edit-header">
                                        <!-- <h5 class="title">UPI Details</h5> -->
                                        <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-12 profile-area">
                                            <div class="edit-content">
                                                <form id="" action="" method="POST">
                                                    <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['invest']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["invest"])) if ($_SESSION["invest"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['invest']['msg'] . "</p>";
                                                                                                                                                                                                                                unset($_SESSION["invest"]);
                                                                                                                                                                                                                                ?>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <span class="control-label  col-lg-3">Title </span>
                                                                        <div class="controls">
                                                                            <input type="text" class="span12 form-control" placeholder="Enter Title" name="title" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <span class="control-label  col-lg-3">News </span>
                                                                        <div class="controls">
                                                                            <textarea class="form-control" name="new_news" id="" cols="30" rows="10">

                                                                            </textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="btn-link float-left mb-3">
                                                                <button class=" btn btn-success" type="submit" name='insertdata'> Upload News</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                        <div class="col-6">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">News</th>
                                                <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            // $userId = $user["id"];
                                                $i=1;
                                                $query = mysqli_query($db, "SELECT * FROM  `news`");
                                                while($dataQuery = mysqli_fetch_array($query)){
                                                
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i; $i++;?></th>
                                                        <td><?php echo $dataQuery['title']; ?></td>
                                                        <td><?php echo $dataQuery['new_news']; ?></td>
                                                        <td><?php echo $dataQuery['date']; ?></td>
                                                        <td><a onclick="confirm('Are you sure!')" href="controller/submit.php?news_delete=0&uid=<?php echo $dataQuery['id']; ?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                <?php 
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Middle Panel End -->
                    </div>
                </div>
            </div>
            <!-- Content end -->

            <!-- Call to action section start -->

            <!-- Call to action section end -->

            <?php require 'footer.php'; ?>
            <script>
                jQuery(".nav-item").removeClass("active");
                jQuery("#nav7").addClass("active");
            </script>
            <script>
                jQuery(".sub-menu-drop3").show();
            </script>

            <script>
                function checkSponsor() {
                    var uname = document.getElementById("uids").value;
                    console.log(uname);
                    var params = "user_id=" + uname;
                    var url = "../model/ajax.php?request=sponser";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'html',
                        data: params,
                        beforeSend: function() {
                            document.getElementById("usernamechk").innerHTML = 'checking';

                            $('#pay_sponsor').val(uname);
                        },
                        complete: function() {},
                        success: function(html) {
                            document.getElementById("usernamechk").innerHTML = html;
                            //                $('#pay_sponsor').val(uname);   
                        }
                    });
                }
            </script>