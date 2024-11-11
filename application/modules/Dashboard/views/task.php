<?php include_once 'header.php'; ?>
<main>
    <div class="main-content page-content">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-md-12 content-header">

                        <span style="">Video Task Perform </span>

                    </section>
                </div>
            </div>
        </div>
        <?php if (date('D') != 'Sun' &&  date('D') != "Sat") { ?>

            <div class="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bg-white p-4 mb-4">
                                <?php
                                $t_none = 1;
                               // $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as totalAmount');
                                // $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $this->session->userdata['user_id']], '*');
                                // pr($user );
                                //echo $totalIncome['totalAmount'];
                                //echo $user['capping'];

                                // if($totalIncome['totalAmount'] > $user['capping'] && $user['upgrade_package'] < 4999){
                                //     echo '<span class="badge badge-danger">Capping Complete, Please retopup your id!</span>';
                                // }else{
                                if ($t_none > 0) {
                                    if ($user_info->paid_status == 1) {
                                        if ($bankInfo['kyc_status'] >= 0) {

                                            if (($task['tasks'] <= total_task)) {
                                                echo $task['tasks'] . '/' . total_task . ' Task Completed<br>';
                                                if ($task['redeem'] == 0) {

                                                    if ($task['tasks'] < total_task) {
                                                        echo '<a class="btn btn-danger" href="#">Pending</a>';
                                                    } elseif ($task['tasks'] == total_task && $task['redeem'] == 0) {
                                                        //echo'<button class="btn btn-success" id="rdmbtn">Redeem</button>';
                                                    }
                                                } else {
                                                    echo 'You Have redeemd your money<br>';
                                                }
                                            } else {
                                                echo '0/' . total_task . ' videos Completed<br>';
                                                echo '<a class="btn btn-success" href="' . base_url('Dashboard/Task/TaskPerform') . '">Perform</a>';
                                            }
                                ?>
                                            <div class="table-responsive mt-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td>#</td>
                                                            <td>Link</td>
                                                            <td>Status</td>
                                                            <!-- <td>Action</td> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($task_links as $key => $links) {
                                                            $completeID = $this->User_model->get_single_record('tbl_task_counter', "user_id='" . $this->session->userdata['user_id'] . "' and date(created_at) = date(now()) and task_id='" . $links['id'] . "'", 'task_id');
                                                            // pr($completeID);
                                                            // pr();
                                                            if ($links['type'] == 'site') {
                                                                $newLink = base_url('Dashboard/Task/TaskPerform/') . $links['id'];
                                                            } else {
                                                                $newLink = base_url('Dashboard/Task/TaskPerform/') . $links['id'];
                                                            }

                                                            echo '<tr>';
                                                            echo '<td>' . ($key + 1) . '</td>';
                                                            echo '<td> Task No .' . ($key + 1) . '</td>';
                                                            // echo ($links['taskCounter']['task_id'] != $links['id']) ? '<td><span class="badge badge-primary">Task Pending</span></td>':'<td><span class="badge badge-success">Task Completed</span></td>';
                                                            echo ($completeID['task_id'] != $links['id']) ? '<td><a class="btn btn-success" href="' . $newLink . '">Perform</a>' : '<td><span class="badge badge-info">Task Completed</span></td>';
                                                          

                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <div>
                                        <?php
                                        } else {
                                            echo '<span class="badge badge-danger">To Perform Task You need KYC Approved</span>';
                                        }
                                    } else {
                                        echo '<span class="badge badge-danger">Please Activate Your Account For Completing task</span>';
                                    }
                                } else {
                                    echo '<span class="badge badge-danger">Please wait we are working on it...</span>';
                                }

                                // }
                                        ?>

                                                </div>
                                            </div>
                            </div>
                        <?php } else {
                        echo "Task Perform Only Monday to Saturday !";
                    } ?>
                        </div>
                    </div>
                </div>
</main>
<?php include_once 'footer.php'; ?>
<script>
    $(document).on('click', '#rdmbtn', function() {
        var url = '<?php echo base_url("Dashboard/Task/RedeemMoney"); ?>';
        $.get(url, function(res) {
            alert(res.message)
            if (res.success == 1)
                window.location.href = '<?php echo base_url("Dashboard/Task") ?>';
        }, 'json')
    })


</script>