<?php
require_once("include/header.php");

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="main-container mt-152">
<div class="page-header">
        <div class="pull-left">
            <h2>Add Gallery Image</h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="span6" style="float:none; margin: 0 auto;">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Gallery Image</div>
                    </div>
                    <div class="widget-body">
                        <div class="form-horizontal no-margin">
                            <form action="controller/submit.php" method="post" enctype="multipart/form-data" id="form">
                               
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <h4></h4>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Image</label>
                                        <div class="controls">
                                            <input type="file" name="file[]" id="file" multiple>
                                        </div>
                                    </div>                                                    

                                    <div class="form-actions no-margin">
                                        <button  type="submit" name="galleryImg" class="btn btn-primary loginpassword">Submit</button>
                                        <button type="reset" class="btn">Cancel</button>
                                    </div>
                                </fieldset>

                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>

</div>
              
<?php 
include 'footer.php';
?>
