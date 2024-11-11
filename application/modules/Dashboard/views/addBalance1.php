<?php require_once 'header.php';?>
<div class="main-content page-content">
    <div class="content-header">
        <div class="page-content">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="content-header">
                        <h5><?php echo $header; ?></h5>
                    </div>
                    <div class="card radius-15">
                        <div class="card-body">
                            <p style="color: green;font-size: 18px;text-align: center;font-weight: bold;"><?php echo $this->session->flashdata('message'); ?></p>
                            <?php echo form_open(); ?>
                                <!-- <div class="form-group">
                                    <label>Enter Number of Pins</label>
                                    <?php
                                    //echo form_input(array('type' => 'number', 'name' => 'pin', 'class' => 'form-control','placeholder' => 'Enter No. of Pins','onkeyup' => "myFunction()", 'id' => 'pinAmount','onchange' => "myFunction2()",'min' => '1'));
                                    ?>
                                </div> -->
                                <div class="form-group">
                                    <label>Amount $</label>
                                    <?php
                                    echo form_input(array('type' => 'text', 'name' => 'amount', 'class' => 'form-control','onkeyup' => "myFunction()",'id' => 'amount'));
                                    ?>
                                    <span class="text-danger" id="showAmount"></span>
                                </div>
                                <!-- <label>Amount</label>
                                <input type="number" name="amount" class="form-control" ></br>
                                <span class="text-danger"><?php //echo form_error('amount');?></span></br> -->
                                <input type="submit"  class="btn btn-info" >
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="overlay toggle-btn-mobile"></div>
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<?php require_once 'footer.php';?>
<script>
function myFunction() {
    var x = document.getElementById("amount").value;
    document.getElementById("showAmount").innerHTML = 'Rs.'+x*80;
}

function myFunction2() {
    var x = document.getElementById("pinAmount").value;
    document.getElementById("showAmount").value = x*699;
}
</script>