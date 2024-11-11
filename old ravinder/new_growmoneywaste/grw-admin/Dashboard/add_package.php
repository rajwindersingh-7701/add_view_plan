<?php
require_once("../../database/db.php");
require_once("include/header.php");
$selected =2 ;
if (isset($_GET['pack'])) {
    $level = mysqli_real_escape_string($db, $_GET['pack']);
    $levelquery = mysqli_query($db, "SELECT * FROM  `package` where `id`='$level'");
    $packData = mysqli_fetch_array($levelquery);
//    $levelcurrent = $levelDataq['id'];
    $selected = $packData['sat&sund'];
}
?>

<div class="main-container mt-152">
<style>.irs-page-title-field {
    padding: 20px 0 !important;
    
}

 .loginarea {
    background: #ffffff;
    color: #fff !important;
    border-radius: 10px;
    padding: 20px;
    border: 3px #1b1b1b dotted;
}


</style>
    <div class="page-header">
        <div class="pull-left">
            <h2>Package</h2>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="row-fluid">
    <div class="row-fluid">
                                <div class="span6" style="float:none; margin: 0 auto;">
                                    <div class="widget">
                                        <div class="widget-header">
                                            <div class="title">Add package</div>
                                        </div>
                                        <div class="widget-body">
                                            <div class="form-horizontal no-margin">
                                                <form action="controller/function.php" method="post">
                                                      <?php if(isset($_SESSION["package"]))if($_SESSION["package"]["status"]==false) echo "<p id='response-msg-false' class='false' >". $_SESSION['package']['msg'] ."</p>";?> <?php if(isset($_SESSION["package"]))if($_SESSION["package"]["status"]==true) echo "<p id='response-msg-true' class='true' >". $_SESSION['package']['msg'] ."</p>";unset($_SESSION["package"]);?> 
                                                <fieldset>
                                                    <div class="control-group">
                                                       
                                                        <div class="controls">
                                                            <h4></h4>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">Title </label>
                                                        <div class="controls">
                                                            <input class="span12 password" name="title" type="text" value='<?php echo (isset($packData['title'])) ? $packData['title'] : ''; ?>' required>
                                                            <input name="packid" type="hidden" value='<?php echo (isset($packData['id'])) ? $packData['id'] : 0; ?>'>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">Price </label>
                                                        <div class="controls">
                                                            <input class="span12 password" name="price" type="text" value='<?php echo (isset($packData['price'])) ? $packData['price'] : ''; ?>' required>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">ROI Amount</label>
                                                        <div class="controls">
                                                            <input class="span12 password" name="roi" type="text" value='<?php echo (isset($packData['roi'])) ? $packData['roi'] : ''; ?>' required>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">ROI Days</label>
                                                        <div class="controls">
                                                            <input class="span12 password" name="days" type="text" value='<?php echo (isset($packData['roi_days'])) ? $packData['roi_days'] : ''; ?>' required>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label">ROI Sat & Sun</label>
                                                        <div class="controls">
                                                            <select name='offd'>
                                                                <option value='1' <?php if($selected==1){ echo 'selected'; } ?>>ON</option>
                                                                <option value='0' <?php if($selected==0){ echo 'selected'; } ?>>OFF</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-actions no-margin">
                                                        <button  type="submit" name="add_package" class="btn btn-primary loginpassword">Submit</button>
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
</div>
<!-- dashboard-container -->
</div>
<?php 
include 'footer.php';
?>
