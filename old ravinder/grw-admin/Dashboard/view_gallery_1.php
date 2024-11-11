<?php
require_once("../../database/db.php");
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
    
a.link-delete {
    background: #000;
    padding: 10px;
}
.g-link {
    text-align: right;
}
</style>
<div class="main-container mt-152">

    <div class="page-header">
        <div class="pull-left">
            <h2>View Gallery Image</h2>
        </div>

        <div class="clearfix"></div>
    </div>
    
    <a href="add_gallery.php"><button style="float:right; background:#10538e; color:white; border:1px solid blue; height:6vh; margin-bottom:10px; border-radius:5px;"> Add Gallery Image</button></a><br>
    <br>
    <div class="row-fluid">
        <div class="row-fluid">
            <div class="span12" style="float:none; margin: 0 auto;">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Gallery Image</div>
                    </div>
                   
                    <div class="widget-body">
                                   <div class ="row">
                         <?php  while($row = mysqli_fetch_assoc($con)){ ?>
                       
                         
                            <div class="span4" >
                                 <div class='g-link'>
                           <a class='link-delete' href="controller/submit.php?del=<?php echo $row['id'];?>"><i class="fa fa-trash-o fonticon"></i></a>
                            </div>
                                <div class='g-images'>
                           <img src="<?php echo "../uploads/".$row['image']; ?>">
                           </div>
                           
                           
                            </div>
                         <?php } ?>
                        
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