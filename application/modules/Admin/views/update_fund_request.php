<?php include 'header.php' ?>
<style>
    #myImg:hover {
        opacity: 1;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 150px;
        right: 50px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <section class="content-header">
                            <span class=""><a href="<?php echo base_url('Admin/Management/Fund_requests/0'); ?>" class="btn btn-sm btn-info">Back </a> Update Fund Request</span>
                        </section>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item">Fund Request</li>
                            <li class="breadcrumb-item active">Update Fund Request</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->


                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="kt-portlet__head-title"><?php echo $this->session->flashdata('error'); ?></h4>
                                <?php echo form_open(base_url('Admin/Management/update_fund_request/' . $request['id'])); ?>
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">User ID</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <?php echo form_input(array('type' => 'text', 'class' => 'form-control', 'value' => $request['user_id'])); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Amount</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <?php echo form_input(array('type' => 'text', 'name' => 'amount', 'class' => 'form-control', 'value' =>  $request['amount'])); ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Proof :</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <img id="myImg" src="<?php echo $request['image'] != '' ? base_url('uploads/' . $request['image']) : base_url('classic/logo.png'); ?>" class="img-fluid">
                                                    <div id="myModal" class="modal">
                                                        <!-- The Close Button -->
                                                        <span class="close">&times;</span>

                                                        <!-- Modal Content (The Image) -->
                                                        <img class="modal-content" id="img01">

                                                        <!-- Modal Caption (Image Text) -->
                                                        <div id="caption"></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Remark :</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <?php
                                                    echo form_textarea(array('rows' => '2', 'class' => 'form-control', 'value' => $request['remarks'], 'name' => 'remarks'));
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Status :</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <?php
                                                    if ($request['status'] == 0) {
                                                        echo '<span class="btn btn-primary">Pending</span>';
                                                    } elseif ($request['status'] == 1) {
                                                        echo '<span class="btn btn-success">Approved</span>';
                                                    } elseif ($request['status'] == 2) {
                                                        echo '<span class="btn btn-danger">Rejected</span>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3">
                                            </div>
                                            <div class="col-lg-9 col-xl-9">
                                                <?php
                                                if ($request['status'] == 0) {
                                                    echo form_input(array('type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Approve', 'name' => 'status'));
                                                    echo '&nbsp;';
                                                    echo form_input(array('type' => 'submit', 'class' => 'btn btn-danger', 'value' => 'Reject', 'name' => 'status'));
                                                } elseif ($request['status'] == 2) {
                                                    echo form_input(array('type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Approve', 'name' => 'status'));
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>
<script>
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function() {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>