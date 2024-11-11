<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="main-content">
      <div class="page-content">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Videos List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tasks</li>
            </ol>
          </div><!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               
                <h3 class="card-title">Videos Lists</h3>
                  
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                  <?php if($countTask['ids'] < 10){ ?>
                    <a href="<?php echo base_url('Admin/Task/Create');?>" class="btn btn-success pull-right">Add New</a>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Link</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($tasks as $key => $task) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <!-- <iframe src="<?php echo $task['link'];?>" title="Site" class="w-50"  style="height: 200px;width: 100%; "></iframe>< -->

                                
                                <!-- <p><iframe src="https://www.growmoney.me/" width="680" height="500" frameborder="0"></iframe></p> -->
                                <td><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $task['link']; ?>" frameborder="0" allowfullscreen></iframe></td>
                                <td><?php echo $task['created_at']; ?></td>
                                <!-- <a href="<?php //echo base_url('Admin/Task/deleteTask/'.$task['id']);?>">Delete</a> </td> -->
                                
                                <td> <a href="<?php echo base_url('Admin/Task/Edit/'.$task['id']);?>">Edit</a></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' 
?>

<script>
  <?php 
foreach ($tasks as $key => $task) {
  ?>
  document.getElementById("frame<?php echo $key; ?>").src= "<?php echo $task['link'];?>";
// document.getElementById("frame<?php echo $key; ?>").innerHTML = '<iframe width="560" height="315" src="<??>" frameborder="0" allowfullscreen></iframe>';

<?php
 }
?>


</script>