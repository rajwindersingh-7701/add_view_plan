<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Account Detail</span>
            </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     
    <div>
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
              <div class="card-header">
                  <form method="GET" action="<?php echo base_url('Admin/Management/bankHistory/');?>">
                      <div class="row">
                          <div class="col-md-3">
                              <select class="form-control" name="type">
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                 
                              </select>
                          </div>
                          <div class="col-md-3">
                              <input type="text" name="value" class="form-control float-right"
                                  value="" placeholder="Search">
                          </div>

                          <div class="col-md-3">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="input-group-append">
                                  <!-- <button type="button" class="btn btn-default" onclick="Export();">Export Excel<i class="fa fa-download"></i></button> -->
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <!-- <div class="export-table">
                  <a href="<?php echo base_url('Admin/Management/users?export=xls'); ?>" class="export-btn btn-primary"><img src="<?php echo base_url('NewDashboard/');?>assets/images/xls.png">Export to xls</a>
                  <a href="<?php echo base_url('Admin/Management/users?export=csv'); ?>" class="export-btn btn-success"><img src="<?php echo base_url('NewDashboard/');?>assets/images/csv.png">Export to csv</a>
                  <a href="<?php echo base_url('Admin/Management/users?export=txt'); ?>" class="export-btn btn-info "><img src="<?php echo base_url('NewDashboard/');?>assets/images/txt.png">Export to txt</a>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <p id="demo"></p>
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Bank Name</th>
                            <th>Bank Account Number</th>
                            <!-- <th>Postion</th> -->
                            <th>Account Holder Name</th>
                            <th>IFSC Code</th>
                            <th>Aadhar</th>
                            <th>Pan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i = ($segament) + 1;
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['bank_name'] ; ?></td>
                                <td><?php echo $user['bank_account_number']; ?></td>
                                <!-- <td><?php //echo $user['position']; ?></td> -->
                                <td><?php echo $user['account_holder_name']; ?></td>
                                <td><?php echo $user['ifsc_code']; ?></td>
                                <td><?php echo $user['aadhar']; ?></td>
                                <td><?php echo $user['pan']; ?></td>
                                 <td>
                                  <a class="btn btn-success" href="<?php echo base_url('Admin/Management/bankApprove/'.$user['user_id']);?>">Approve</a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <div class="row">
                  <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                          Showing <?php echo ($segament + 1) .' to  '.($i -1);?> of
                          <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                          <?php
                          echo $this->pagination->create_links();
                          ?>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
   </div>
<?php include'footer.php' ?>
<script>
$(document).on('click','.blockUser',function(){
  var status = $(this).data('status');
  var user_id = $(this).data('user_id');
  var url = "<?php echo base_url('Admin/Management/blockStatus/');?>"+user_id + '/' + status;
  $.get(url,function(res){
    alert(res.message)
    if(res.success == 1)
      location.reload()
  },'json')
})
</script>
<script>
function loadDoc($user) {
  let url = '<?php echo base_url('Admin/Management/notification/?user_id=');?>'+$user;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}
</script>