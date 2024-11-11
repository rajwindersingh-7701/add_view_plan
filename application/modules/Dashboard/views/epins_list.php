<?php include'header.php' ?>
<style>
section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->

        <section class="content-header">
            <span><?php echo $header; ?></span>
        </section>

    </div>


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
        <h4 class="text-success"><?php echo $this->session->flashdata('message'); ?></h4>
                                   <div class="card-body">
              <div style="max-width:100%; overflow:scroll">
                <table class="table table-bordered table-striped dataTable" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>EPin</th>
                            <th>Received From</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Used For</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($records as $key => $record) {
                            ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $record['epin']; ?></td>
                                <td><?php echo $record['sender_id'] == '' ? 'Admin' : $record['sender_id']; ?></td>
                                <td><?php echo $record['amount']; ?></td>
                                <td>
                                    <?php
                                    if($record['status'] == 0){
                                        echo '<span class="text-info">Unused</span>';
                                    }elseif($record['status'] == 1){
                                        echo'<span class="text-success">Used</span>';
                                    }elseif($record['status'] == 2){
                                        echo'<span class="text-primary">Transferred</span>';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $record['used_for']; ?></td>
                                <td><?php
                                if($record['status'] == 0){
                                    echo'<a href="'.base_url('Dashboard/ActivateAccountEpin/'.$record['epin']).'">Active Now</a>';
                                }
                                ?></td>
                                <td><?php echo $record['created_at']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table></div>
            </div>
        </div>
    </div>
</div>
<?php include'footer.php' ?>
