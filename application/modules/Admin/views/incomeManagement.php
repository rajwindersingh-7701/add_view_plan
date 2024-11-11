<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
        
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <section class="content-header">
            <span class="">Income Management</span>
          </section>  
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Income Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     
    
  
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" name="user_id" class="form-control"  placeholder="Enter User ID"/>
                        <label class="text-danger"><?php echo form_error('user_id');?></label>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control"  placeholder="Enter Amount"/>
                        <label class="text-danger"><?php echo form_error('amount');?></label>
                    </div>
                    <div class="form-group">
                        <label>Select Income</label>
                        <?php 
                          $incomeType = $this->config->item('incomes');
                        ?>
                        <select name='type' class="form-control">
                          <?php 
                          // pr($incomeType,true);
                          foreach($incomeType as $k => $type):
                          // pr($type);
                          ?>
                          <option value="<?php echo $type['type'];?>"><?php echo $type['name'];?></option>
                            <?php endforeach; ?>
                        </select>
                       
                    </div>
                    <div class="form-group">
                        <label>Credit/Debit</label>
                        <select name='income' class="form-control">
                          <option value="credit">Credit</option>
                          <option value="debit">debit</option>

                        </select>
                       
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Submit</button>
                    </div>
                <?php echo form_close();?>
              </div>
              <!-- /.card-body -->
              <!-- <iframe src="<?php //echo $task['link']?>"><iframe> -->
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