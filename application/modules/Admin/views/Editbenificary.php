<?php include'header.php' ?>
  <div class="main-content">
      <div class="page-content">
         <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <section class="content-header">
                    <span class="">Update Bank Detail</span>
                </section>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Update Bank Detail</li>
                    <li class="breadcrumb-item active">Update Bank Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
       
  
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                    <h4 class="kt-portlet__head-title"><?php echo $this->session->flashdata('message');?></h4>
                    <?php echo form_open(base_url('Admin/Settings/Editbenificary/' . $request['user_id'])); ?>
                    <div class="kt-portlet__body">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Bank Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text', 'class' => 'form-control','name' => 'beneficiary_bank', 'value' => $request['beneficiary_bank'])); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Bank Account No</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text','name' => 'beneficiary_account_no', 'class' => 'form-control', 'value' =>  $request['beneficiary_account_no'])); ?>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Bank IFSC</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text','name' => 'beneficiary_ifsc', 'class' => 'form-control', 'value' =>  $request['beneficiary_ifsc'])); ?>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Account Holder Name</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text','name' => 'beneficiary_name', 'class' => 'form-control', 'value' =>  $request['beneficiary_name'])); ?>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Bank Branch</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text','name' => 'beneficiary_branch', 'class' => 'form-control', 'value' =>  $request['beneficiary_branch'])); ?>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Beneficiary Mobile No</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <?php echo form_input(array('type' => 'text','name' => 'beneficiary_mobile', 'class' => 'form-control', 'value' =>  $request['beneficiary_mobile'])); ?>
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
                                   
                                        echo form_input(array('type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Update', 'name' => 'status'));
                                        echo'&nbsp;';
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


<?php include'footer.php' ?>