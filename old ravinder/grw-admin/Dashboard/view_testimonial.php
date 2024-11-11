<?php
require_once("include/header.php");
require_once("../../database/db.php");

?>
<div class="main-container mt-152">
    <div class="page-header">
        <div class="pull-left">
            <h2>All Testimonial </h2>
        </div>
        <div class="pull-right">
            <a href="add_testimonial.php"><button class="btn btn-info">Add Testimonial</button></a>
        </div>
     

        <div class="clearfix"></div>
    </div>




    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                       List of testimonial
                    </div>
                </div>
                <div class="widget-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>


                                    <th>#</th>
                                    <th>User Id</th>
                                    <th>Title</th>
                                    <th>Describe</th>
                                    
                                     <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                              <?php
                               // $userId = $user["id"];
                              $i=1;
                                $query = mysqli_query($db, "SELECT * FROM  `meta` where type='testimonial'  order by id desc ");
                               while($dataQuery = mysqli_fetch_array($query)){
                                  
                                ?>
                                <tr>

                                    <td><?php echo $i; $i++;?>   </td>
                                    <td><?php echo $dataQuery['user_id']; ?>   </td>
                                    <td><?php echo $dataQuery['title']; ?>   </td>
                                    <td><?php echo $dataQuery['text']; ?>   </td>
                                    <td><a onclick="confirm('Are you sure!')" href="controller/submit.php?deleteArchivers=true&uid=<?php echo $dataQuery['id']; ?>" class="btn btn-success"><i class="fa fa-trash-o" aria-hidden="true"></i> </a> </td>

                             
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
    function login(val){
            $.ajax({
                    url: "controller/function.php",
                    type: "GET" ,
                    data: { ido : val },
                    success: function(response) {

                        if(response=="true"){
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

