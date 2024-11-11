<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index()
    {
        if (is_logged_in()) {
            //    die('Stop');
            $date = date('Y-m-d');
           // $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', 'amount > "0" and user_id = "' . $this->session->userdata['user_id'] . '" and date(created_at) ="' . $date . '" and (type = "ad_income" OR type = "level_income")', 'ifnull(sum(amount),0) as totalAmount');

            $response['bankInfo'] = $this->User_model->get_single_record('tbl_bank_details', ['user_id' => $this->session->userdata['user_id']], 'kyc_status');

            //$todayTask = $this->User_model->get_records('tbl_task_counter', [], 'created_at');
            // pr($todayTask,true);
            $response['task_links'] = $this->User_model->get_records('tbl_task_links', 'id > "0" LIMIT ' . total_task . '', '*');
            // foreach ($response['task_links'] as $key => $link) {
            //     $response['task_links'][$key]['counter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW()) and task_id = '" . $link['id'] . "'", '*');
            //     // $response['task_links'][$key]['taskCounter'] = $this->User_model->get_single_record('tbl_task_counter', "user_id = '".$this->session->userdata['user_id']."'and date(created_at) = date('Y-m-d')", 'task_id');
            // }
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');
            // pr($response['task'],true);
            $this->load->view('task', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function TaskPerform($id)
    {
        // redirect('Dashboard/User');
        // die;

        if (is_logged_in()) {
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');
            // $taskcounter = $this->User_model->get_records('tbl_task_counter',['user_id' =>$this->session->userdata['user_id']],'task_id');
            $response['taskId'] = $this->User_model->get_single_record('tbl_task_links', ['id =' => $id], '*');
            //$response['task_links'] = $this->User_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_perform', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function TaskPerformYoutube($id)
    {
        if (is_logged_in()) {
            $response['task'] = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');
            // $taskcounter = $this->User_model->get_records('tbl_task_counter',['user_id' =>$this->session->userdata['user_id']],'task_id');
            $response['taskId'] = $this->User_model->get_single_record('tbl_task_links', ['id =' => $id], '*');
            //$response['task_links'] = $this->User_model->get_records('tbl_task_links', array(), '*');
            $this->load->view('task_perform_youtube', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function TaskComplete($task_id)
    {
        // die('stop');
        if (is_logged_in()) {

            $data['success'] = 0;
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');
            // pr($task);
            if (!empty($task)) {
                $today_task = $this->User_model->get_single_record('tbl_task_counter', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW()) ", 'count(id) as ids');

                if ($today_task['ids'] < total_task) {
                    $TaskCounterIncome = array(
                        'user_id' => $this->session->userdata['user_id'],
                        'task_id' => $task_id,
                    );
                    $this->User_model->add('tbl_task_counter', $TaskCounterIncome);
                    $this->User_model->update('tbl_task', array('id' => $task['id']), array('tasks' => $task['tasks'] + 1));
                    $this->User_model->update('tbl_users', ['user_id' => $this->session->userdata['user_id']], ['taskStatus' => 1, 'task_perform' => 1]);
                    $_task = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');

                    if (!empty($_task)) {
                        if ($_task['redeem'] == 0) {
                            if ($_task['tasks'] == total_task) {
                                $this->RedeemMoney();
                            }
                        }
                    }
                    // $this->RedeemMoney();

                    $data['success'] = 1;
                    $data['message'] = 'Task Completed Successfully';
                } else {
                    $data['success'] = 0;
                    $data['message'] = "This Task Already Completed";
                }
            } else {
                $StartTask = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'tasks' => 1,
                    'redeem' => 0,
                );
                $this->User_model->add('tbl_task', $StartTask);
                $TaskCounterIncome = array(
                    'user_id' => $this->session->userdata['user_id'],
                    'task_id' => $task_id,
                );
                $this->User_model->add('tbl_task_counter', $TaskCounterIncome);
                $this->User_model->update('tbl_users', ['user_id' => $this->session->userdata['user_id']], ['taskStatus' => 1, 'task_perform' => 1]);
                $_task = $this->User_model->get_single_record('tbl_task', "user_id = '" . $this->session->userdata['user_id'] . "' and date(created_at) = date(NOW())", '*');

                if (!empty($_task)) {
                    if ($_task['redeem'] == 0) {
                        if ($_task['tasks'] == total_task) {
                            $this->RedeemMoney();
                        }
                    }
                }
                // $this->RedeemMoney();
                $data['message'] = 'Task Completed Successfully';
                $data['success'] = 1;
            }
            echo json_encode($data);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function RedeemMoney()
    {
        if (is_logged_in()) {
            $date = date('Y-m-d');
            $data['success'] = 0;
            $userID = $this->session->userdata['user_id'];
            $task = $this->User_model->get_single_record('tbl_task', "user_id = '" . $userID . "' and date(created_at) = '" . $date . "'", '*');
            if (!empty($task)) {
                if ($task['redeem'] == 0) {
                    if ($task['tasks'] == total_task) {
                        $this->User_model->update('tbl_task', array('id' => $task['id']), array('redeem' => 1));
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $userID), '*');
                        if ($user['upgrade_id'] >= 1) {
                            $package_id = $user['upgrade_id'];
                        } else {
                            $package_id = $user['package_id'];
                        }
                        $package = $this->User_model->get_single_record('tbl_package', ['id' => 1], '*');

                        $checkRoi = $this->User_model->get_records('tbl_roi', ['user_id' => $userID, 'days >' => 0], '*');
                        foreach ($checkRoi as $key => $roi) {
                            $data['success'] = 1;
                            $data['message'] = 'Money Redeemed Successfully';

                            // if($totalIncome['totalAmount'] < $package['capping']){
                            if ($user['totalLimit'] > $user['pendingLimit']) {
                                $totalCredit = $user['pendingLimit'] + $roi['roi_amount'];
                                if ($totalCredit < $user['totalLimit']) {
                                    $sendIncome = $roi['roi_amount'];
                                } else {
                                    $sendIncome = $user['totalLimit'] - $user['pendingLimit'];
                                }
                                $new_day = $roi['days'] - 1;
                                $days = ($roi['total_days'] + 1) - $roi['days'];
                                // if($user['retopup_times'] == 0){
                                $TaskIncome = array(
                                    'user_id' => $user['user_id'],
                                    'amount' => $sendIncome,
                                    'type' => 'ad_income',
                                    'description' => 'Ad Income at Day ' . $days,
                                );
                                $this->User_model->add('tbl_income_wallet', $TaskIncome);
                                $this->User_model->update('tbl_roi', array('id' => $roi['id']), array('days' => $new_day, 'amount' => ($roi['amount'] - $roi['roi_amount']), 'createDate' => date('Y-m-d')));
                                $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['pendingLimit' => ($user['pendingLimit'] + $sendIncome)]);

                                $this->credit_hold_level_income($user['user_id']);
                            } else {
                                $this->User_model->update('tbl_roi', ['user_id' => $user['user_id']], ['days' => 0]);
                                $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['free_status' => 0,'paid_status' => 0]);
                            }

                            $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['complete_days' => ($user['complete_days'] + 1)]);
                            if ($new_day == 1) {
                                $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['free_status' == 0,'paid_status' => 0]);
                            }
                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['user_id']), '*');


                            if ($sponser['paid_status'] == 1) {
                                $package['level_income'] = "0.1,0.05,0.03,0.02,0.02,0.01,0.01,0.01,0.01,0.01";
                                $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income'], $roi['roi_amount']);
                            }
                        }
                    } else {
                        $data['success'] = 0;
                        $data['message'] = 'Still your tasks are Not Completed';
                    }
                } else {
                    $data['success'] = 0;
                    $data['message'] = "you have Already Redeem Your Money";
                }
            } else {
                $data['message'] = 'Your tasks Are Not Completed Today';
                $data['success'] = 0;
            }
            // echo json_encode($data);

        } else {
            redirect('Dashboard/User/login');
        }
    }
    // public function task_level_income($sponser_id,$activated_id,$level_income, $package_amount){
    //     // $incomes = array(6,5,4,3,2,1);
    //     //$incomes = array(4,2,1,1,1,1);
    //     $incomes = explode(',', $level_income);
    //     $directs = [
    //         1 => 3,
    //         2 => 5,
    //         3 => 7,
    //         4 => 9,
    //         5 => 10,
    //         6 => 11,
    //         7 => 12,
    //     ];
    //     foreach($incomes as $key => $income){
    //         $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
    //         $direct = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $sponser_id,'upgrade_package >' => 100), 'count(id) as direct');
    //         if(!empty($sponser)){
    //             $level = ($key+1);
    //             if($sponser['upgrade_package'] > 100 && $direct['direct'] >= $directs[$level] && $sponser['paid_status'] > 0){
    //                 if($sponser['upgrade_package'] >= $package_amount){
    //                     $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $sponser['user_id']], 'ifnull(sum(amount),0) as totalAmount');


    //                         if($level == 1){
    //                             $firstDirectCheck = $this->User_model->get_single_record('tbl_users', 'sponser_id = "'.$sponser['user_id'].'" AND upgrade_package > "0" ORDER by topup_date ASC LIMIT 1', '*');
    //                             if($firstDirectCheck['user_id'] != $activated_id){
    //                                 $LevelIncome = array(
    //                                     'user_id' => $sponser['user_id'],
    //                                     'amount' => $income,
    //                                     'type' => 'level_income', 
    //                                     'description' => 'Ad Level Income from Member '.$activated_id  . ' At level '.($level),
    //                                 );
    //                                 //$this->User_model->add('tbl_income_wallet', $LevelIncome);
    //                             }
    //                         }else{
    //                             $LevelIncome = array(
    //                                 'user_id' => $sponser['user_id'],
    //                                 'amount' => $income,
    //                                 'type' => 'level_income', 
    //                                 'description' => 'Ad Level Income from Member '.$activated_id  . ' At level '.($level),
    //                             );
    //                             //$this->User_model->add('tbl_income_wallet', $LevelIncome);
    //                         }

    //                         if($totalIncome['totalAmount'] < $sponser['capping'] && $sponser['upgrade_package'] < 4999 && !empty($LevelIncome)){
    //                             $this->User_model->add('tbl_income_wallet', $LevelIncome);
    //                         }elseif($sponser['upgrade_package'] >= 4999 && !empty($LevelIncome)){
    //                             $this->User_model->add('tbl_income_wallet', $LevelIncome);
    //                         }
    //                 }
    //             }
    //             $sponser_id = $sponser['sponser_id'];
    //         }
    //     }
    // }


    public function level_income($sponser_id, $activated_id, $level_income, $amount)
    {
        //$incomes = array(100,50,40,30,10,10,10);
        //$incomes = array(4,2,1,1,1,1);
        $incomes = explode(',', $level_income);
        $date = date('Y-m-d');

        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            $direct = $this->User_model->get_single_record('tbl_users', 'sponser_id =  "' . $sponser_id . '" AND paid_status > "0"', 'count(id) as direct');
            $checkTask = $this->User_model->get_single_record('tbl_task', ['user_id' => $sponser_id, 'date(created_at)' => $date], '*');

            $directs = ($key + 1);
            $level = ($key + 1);

            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    if($direct['direct'] >= $directs ){
                    // if($totalIncome['totalAmount'] < $sponser['capping']){
                        if ($sponser['totalLimit'] > $sponser['pendingLimit']) {
                            $totalCredit = $sponser['pendingLimit'] + ($amount * $income);
                            if ($totalCredit < $sponser['totalLimit']) {
                                $sendIncome = ($amount * $income);
                            } else {
                                $sendIncome = $sponser['totalLimit'] - $sponser['pendingLimit'];
                            }
                            if ($checkTask['tasks'] == total_task) {
                                $LevelIncome = array(
                                    'user_id' => $sponser['user_id'],
                                    'amount' => $sendIncome,
                                    'type' => 'level_income',
                                    'description' => 'Ad Level Income from Member ' . $activated_id  . ' At level ' . ($level),
                                );
                                $this->User_model->add('tbl_income_wallet', $LevelIncome);
                                $pendingLimit = ($sponser['pendingLimit'] + $sendIncome);
                                $this->User_model->update('tbl_users', ['user_id' => $sponser['user_id']], ['pendingLimit' => $pendingLimit]);
                            } else {
                                $LevelIncome = array(
                                    'user_id' => $sponser['user_id'],
                                    'amount' => $sendIncome,
                                    'type' => 'level_income',
                                    'description' => 'Ad Level Income from Member ' . $activated_id  . ' At level ' . ($level),
                                );
                                $this->User_model->add('tbl_holding_wallet', $LevelIncome);
                            }
                        } else {
                            $this->User_model->update('tbl_roi', ['user_id' => $sponser['user_id']], ['days' => 0]);
                            $this->User_model->update('tbl_users', ['user_id' => $sponser['user_id']], ['free_status' => 0]);
                        }
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
        // pr($incomes,true);
    }

    // public function testID($yser)



    public function credit_hold_level_income($user_id)
    {
        $date = date('Y-m-d');
        $users = $this->User_model->get_records('tbl_holding_wallet', 'user_id = "' . $user_id . '" and amount > "0" and date(created_at) = "' . $date . '"', '*');
        foreach ($users as $key => $user) {

            $checkUserRecord = $this->User_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'user_id,capping,pendingLimit,totalLimit');
            if (!empty($checkUserRecord)) {
                $totalIncomeHolding = $this->User_model->get_single_record('tbl_holding_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date], 'ifnull(sum(amount),0) as totalAmount');
                // if($totalIncome['totalAmount'] < $checkUserRecord['capping']){
                if ($checkUserRecord['totalLimit'] > $checkUserRecord['pendingLimit']) {
                    $totalCredit = $checkUserRecord['pendingLimit'] + $user['amount'];
                    if ($totalCredit < $checkUserRecord['totalLimit']) {
                        $sendIncome = $user['amount'];
                    } else {
                        $sendIncome = $checkUserRecord['totalLimit'] - $checkUserRecord['pendingLimit'];
                    }
                    $credit_hold_income = [
                        'user_id' => $user['user_id'],
                        'amount' => $sendIncome,
                        'type' => 'level_income', //$user['type'],
                        'description' => $user['description'],
                    ];
                    // pr($credit_hold_income);

                    $this->User_model->add('tbl_income_wallet', $credit_hold_income);
                    $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['pendingLimit' => ($checkUserRecord['pendingLimit'] + $sendIncome)]);
                    $this->User_model->update('tbl_holding_wallet', ['id' => $user['id']], ['amount' => 0]);



                    //  $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['task_perform' => 1]);
                } else {
                    $this->User_model->update('tbl_roi', ['user_id' => $user['user_id']], ['days' => 0]);
                    $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['free_status' => 0]);
                }
            }
        }
        // $data['success'] = 1;
        // $data['message'] = 'Money Redeemed Successfully';
    }


    public function credit_hold_level_income2($user_id)
    {
        $date = date('Y-m-d');
        $users = $this->User_model->get_records('tbl_holding_wallet', 'user_id = "' . $user_id . '" and amount > "0" and date(created_at) = "' . $date . '"', '*');
        foreach ($users as $key => $user) {
            $checkUserRecord = $this->User_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'user_id,capping');
            if (!empty($checkUserRecord)) {
                $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date], 'ifnull(sum(amount),0) as totalAmount');
                $totalIncomeHolding = $this->User_model->get_single_record('tbl_holding_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date], 'ifnull(sum(amount),0) as totalAmount');
                if ($totalIncome['totalAmount'] < $checkUserRecord['capping']) {
                    $credit_hold_income = [
                        'user_id' => $user['user_id'],
                        'amount' => $user['amount'],
                        'type' => 'level_income', //$user['type'],
                        'description' => $user['description'],
                    ];
                    // pr($credit_hold_income);

                    $this->User_model->add('tbl_income_wallet', $credit_hold_income);

                    // $this->User_model->delete('tbl_holding_wallet', $user['id']);
                    $this->User_model->update('tbl_holding_wallet', ['id' => $user['id']], ['amount' => 0]);


                    //  $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['task_perform' => 1]);
                }
            }
        }
    }


    public function ATEST($user_id = '')
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
        if ($user['upgrade_id'] > 1) {
            $package_id = $user['upgrade_id'];
        } else {
            $package_id = $user['package_id'];
        }
        $package = $this->User_model->get_single_record('tbl_package', ['id' => $package_id], '*');
        pr($package);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs,user_id');
        $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id']], 'ifnull(sum(amount),0) as totalAmount');
        pr($sponser);
        if ($sponser['directs'] >= 3) {
            if ($totalIncome['totalAmount'] < $package['capping'] && $package_id < 4 && $package_id != 1) {
                $this->task_level_incomeTEST($sponser['user_id'], $user['user_id'], $package['level_income']);
            }
            if ($package_id == 4) {
                $this->task_level_incomeTEST($sponser['user_id'], $user['user_id'], $package['level_income']);
            }
        }
    }


    public function task_level_incomeTEST($sponser_id, $activated_id, $package_amount = '599', $level_income = '10,5,4,2,1,1,1')
    {
        $incomes = explode(',', $level_income);
        $directs = [
            1 => 3,
            2 => 5,
            3 => 7,
            4 => 9,
            5 => 10,
            6 => 11,
            7 => 12,
        ];
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            $direct = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $sponser_id, 'upgrade_package >' => 100), 'count(id) as direct');
            if (!empty($sponser)) {
                $level = ($key + 1);
                if ($sponser['upgrade_package'] > 100 && $direct['direct'] >= $directs[$level] && $sponser['paid_status'] > 0) {
                    if ($sponser['upgrade_package'] >= $package_amount) {
                        $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $sponser['user_id']], 'ifnull(sum(amount),0) as totalAmount');


                        if ($level == 1) {
                            $firstDirectCheck = $this->User_model->get_single_record('tbl_users', 'sponser_id = "' . $sponser['user_id'] . '" AND upgrade_package > "0" ORDER by topup_date ASC LIMIT 1', '*');
                            if ($firstDirectCheck['user_id'] != $activated_id) {
                                $LevelIncome = array(
                                    'user_id' => $sponser['user_id'],
                                    'amount' => $income,
                                    'type' => 'level_income',
                                    'description' => 'Ad Level Income from Member ' . $activated_id  . ' At level ' . ($level),
                                );
                                //$this->User_model->add('tbl_income_wallet', $LevelIncome);
                            }
                        } else {
                            $LevelIncome = array(
                                'user_id' => $sponser['user_id'],
                                'amount' => $income,
                                'type' => 'level_income',
                                'description' => 'Ad Level Income from Member ' . $activated_id  . ' At level ' . ($level),
                            );
                            //$this->User_model->add('tbl_income_wallet', $LevelIncome);
                        }

                        if ($totalIncome['totalAmount'] < $sponser['capping'] && $sponser['upgrade_package'] < 4999) {
                            pr($LevelIncome);
                            //$this->User_model->add('tbl_income_wallet', $LevelIncome);
                        } elseif ($sponser['upgrade_package'] >= 4999) {
                            pr($LevelIncome);
                            //$this->User_model->add('tbl_income_wallet', $LevelIncome);
                        }
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }


    public function reward()
    {
        if (is_logged_in()) {
            $response['rewards'] = $this->User_model->get_records('tbl_rewards', ['user_id' => $this->session->userdata['user_id']], '*');
            $this->load->view('rewards_status', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
