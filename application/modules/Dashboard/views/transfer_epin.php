<?php include_once'header.php'; 

$none = 0;

?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
</style>
<main>
<div class="main-content ">
  <div class="container-fluid content-header">
  <!-- Breadcrumb-->
   <div class="row pt-2 pb-2">
      <div class="col-sm-9">
      <h4 class="page-title"><?php echo $header;?></h4>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Dashboard'); ?>">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $header;?></li>
       </ol>
   </div>

   </div>
  <!-- End Breadcrumb-->


  <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
         <div class="card-title"><?php echo $header;?></div>
         <hr>
         <div class="col-md-12">

           <div class="col-md-6">
                <?php 
                    if(empty($generate)){
                        echo form_open('', array('id' => 'TopUpForm')); 
                ?>
                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                    <div class="form-group">
                        <label style="font-size:20px; color:red">Available Pins ( <?php echo $available_epins['total_epins']; ?>)</label><br>
                    </div>
               
                    <div class="form-group">
                        <label>No of Epins</label>
                        <input type="number" class="form-control" name="epins" placeholder="Epins" value="<?php echo set_value('epins'); ?>"/>
                        <span class="text-danger"><?php echo form_error('epins') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                         <input type="number" class="form-control" name="amount" placeholder="Enter Amount" value="450"/ readonly>
                        <span class="text-danger"><?php echo form_error('amount') ?></span>
                       <!--  <select class="form-control" name="amount">
                            <?php  
                                // foreach ($package as $key => $value) {
                                //     echo '<option value="'.$value['price'].'">'.$value['price'].'</option>';
                                // }    
                            ?>
                        </select> -->
                    </div>
                    <?php  if($none == 1){ ?>
                    <div class="form-group" >
                        <label>Type</label>
                        <select class="form-control" name="type">
                                <option value="premium_pin">Premium Pin</option>
                                <option value="renewal_pin">Renewal Pin</option>
                                <!-- <option value="zero_pin">Zero Pin</option> -->
                        </select>
                    </div >
                <?php  }?>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value="" onchange="loadDoc()"/>
                        <span class="text-danger" id="errorMessage"><?php echo form_error('user_id') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Enter Password" value=""/>
                        <span class="text-danger"><?php echo form_error('password') ?></span>
                    </div>
                    <div class="form-group">
                        <button type="subimt" name="save" class="btn btn-success">Transfer</button>
                    </div>
               
                <?php 
                        echo form_close(); 
                    }
                ?>

                <?php
                    if(!empty($generate)){
                        $permission = json_decode($user['access'],true);
                        //pr($permission);
                        if(!empty($permission)){
                            if(in_array('pin_generation',$permission)){
                                //if(in_array('d_pin_generation',$permission)){
                                    echo form_open('', array('id' => 'TopUpForm')); ?>
                                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                                    <div class="form-group">
                                        <label style="font-size:20px; color:red">Available Balance ( <?php echo round($balance['balance'],2); ?>)</label><br>
                                    </div>
                                    <div class="form-group">
                                        <label>EPins</label>
                                        <input type="number" class="form-control" name="epins" placeholder="Epins" value="<?php echo set_value('epins'); ?>"/>
                                        <span class="text-danger"><?php echo form_error('epins') ?></span>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Amount</label>
                                        <select class="form-control" name="amount" onchange="docload()" id="package">
                                                <option value="1500">1500</option>
                                                <option value="1800">1800</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="type">
                                            <option value="premium_pin_1800">Premium Pin 1800</option>
                                            <option value="premium_pin_1500">Premium Pin 1500</option>
                                            <option value="renewal_pin_1800">Renewal Pin 1800</option>
                                            <!-- <option value="zero_pin">Zero Pin</option> -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Txn. Password</label>
                                        <input type="text" class="form-control" name="master_key" placeholder="Master Key" value=""/>
                                        <span class="text-danger"><?php echo form_error('master_key') ?></span>
                                    </div>
                                    <div class="form-group">
                                        <button type="subimt" name="save" class="btn btn-success" />Generate</button>
                                    </div>
                        <?php 
                                    echo form_close();
                                // }else{
                                //     echo '<span class="text-danger">You have no permission to Generate E-Pins!<br> </span>';    
                                // }
                            }else{
                                echo '<span class="text-danger">You have no permission to Generate E-Pins!<br> </span>';
                            }
                        }else{
                            echo '<span class="text-danger">You have no permission to Generate E-Pins!<br> </span>';
                        }
                        } 
                    ?>
           </div>

         </div>
       </div>
       </div>
    </div>


  </div><!--End Row-->



<!--start overlay-->
  <div class="overlay toggle-menu"></div>
<!--end overlay-->
  </div>
  <!-- End container-fluid-->

 </div><!--End content-wrapper-->

</main>
<?php include_once 'footer.php'; ?>
<script>
    function loadDoc() {
        var user_id = document.getElementById('user_id').value;
        var url = '<?php echo base_url()?>Dashboard/User/get_user/' + user_id;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("errorMessage").innerHTML =
                this.responseText;
            }
        };
        xhttp.open("GET",url, true);
        xhttp.send();
    }
    // jQuery(document).on('submit', '#TopUpForm', function () {
    //     if (confirm('Are You Sure To Transfer These Epins')) {
    //         yourformelement.submit();
    //     } else {
    //         return false;
    //     }
    // })

    // jQuery(document).on('blur','#user_id',function(){
    //     var user_id = jQuery(this).val();
    //     if (user_id != '') {
    //         var url = '<?php //echo base_url()?>Dashboard/User/get_user/' + user_id;
    //         jQuery.get(url, function (res) {
    //             jQuery('#errorMessage').html(res);
    //         })
    //     }
    // })
    
</script>
