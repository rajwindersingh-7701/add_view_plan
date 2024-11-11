<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model', 'User_model'));
        $this->load->helper(array('admin', 'security'));
        date_default_timezone_set('Asia/Kolkata');
        $this->public_key = '';
        $this->private_key = '';
    }

    public function index()
    {
        exit();
    }

    // public function debitCoin(){
    //     $users = $this->Main_model->get_records('tbl_coin_wallet',"user_id != '' group by user_id",'ifnull(sum(amount),0) as balance,user_id');
    //     foreach($users as $user):
    //         $debit = [
    //             'user_id' => $user['user_id'],
    //             'amount' => -$user['balance']*0.67,
    //             'type' => 'admin_amount',
    //             'description' => 'Debit by Admin',
    //         ];
    //         pr($debit);
    //         $this->Main_model->add('tbl_coin_wallet',$debit);
    //     endforeach;
    // }

    public function credit_hold_level_income()
    {
        $date = date('Y-m-d');
        $users = $this->Main_model->get_records('tbl_holding_wallet', 'user_id != "none" and amount > "0" and date(created_at) = "' . $date . '"', '*');
        foreach ($users as $key => $user) {
            $checkUserRecord = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id'], 'task_perform' => 1], 'user_id,capping');
            if (!empty($checkUserRecord)) {
                // $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date, 'type' => "ad_income", 'type' => "level_income"], 'ifnull(sum(amount),0) as totalAmount');
                $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', 'amount > "0" AND user_id="'.$user['user_id'].'" AND date(created_at)="'.$date.'" AND (type="ad_income" OR type="level_income")', 'ifnull(sum(amount),0) as totalAmount');
                $totalIncomeHolding = $this->User_model->get_single_record('tbl_holding_wallet','amount > "0" AND user_id="'.$user['user_id'].'" AND date(created_at)="'.$date.'"', 'ifnull(sum(amount),0) as totalAmount');
                // $totalIncomeHolding = $this->User_model->get_single_record('tbl_holding_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date], 'ifnull(sum(amount),0) as totalAmount');
                $dailyallIncome = ($totalIncome['totalAmount'] + $totalIncomeHolding['totalAmount']);
                if ($dailyallIncome < $checkUserRecord['capping']) {
                    $credit_hold_income = [
                        'user_id' => $user['user_id'],
                        'amount' => $user['amount'],
                        'type' => 'level_income', //$user['type'],
                        'description' => $user['description'],
                    ];
                    pr($credit_hold_income);

                    $this->Main_model->add('tbl_income_wallet', $credit_hold_income);

                    $this->Main_model->update('tbl_holding_wallet', ['id' => $user['id']], ['amount' => 0]);
                    $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['task_perform' => 0]);
                }
            }
        }
    }


    public function activation_coin_send_temp()
    {
        $users = $this->Main_model->get_records('tbl_users', ['package_amount >' => 0], 'id,user_id,sponser_id');
        foreach ($users as $key => $user) {
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs,user_id');
            $this->coin_level_income_temp($sponser['user_id'], $user['user_id'], '500,100,90,80,70,60,50,40,30,20');
        }
    }

    public function royaltyCron()
    {
        // echo "we are working";
        // die;
        // if(date('D') == 'Sun' || date('D') == 'Sat'){
        //     die('its weekend');
        // }
        $date = date('Y-m-d');
        $cron = $this->Main_model->get_single_record('tbl_cron', "cron_name = 'roiCron' and date(created_at) = date(now())", '*');
        if (empty($cron)) :
            $roi_users = $this->Main_model->get_records('tbl_roi', ['days >' => 0], '*');
            foreach ($roi_users as $key => $user) {
                $userinfo = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], '*');
                //$incomeCheck = $this->Main_model->get_single_record('tbl_income_wallet',"user_id = '".$user['user_id']."' and type = 'daily_roi_income' and date(created_at) = date(now())",'*');
                //if(empty($incomeCheck)):
                $totalIncome = $this->User_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id'], 'date(created_at)' => $date], 'ifnull(sum(amount),0) as totalAmount');
                // if ($totalIncome['totalAmount'] < $user['capping']) {
                    $new_day = $user['days'] - 1;
                    $date1 = date('Y-m-d');
                    $date2 = date('Y-m-d', strtotime($user['createDate'] . ' + 30 days'));
                    $diff = strtotime($date1) - strtotime($date2);
                    // if($user['booster_status'] == 1){
                    if ($diff > 0) {
                        //         $incomeArr = array(
                        //             'user_id' => $user['user_id'],
                        //             'amount' => $user['roi_amount'],
                        //             'type' => 'daily_roi_income',
                        //             'description' => 'Cashback Bonus at '.$new_day . ' Day',
                        //         );
                        //         pr($user);
                        //         if($user['days'] > 40){
                        //             $incomeArr['amount'] = $incomeArr['amount'] * 1;
                        //         }
                        //         $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        //         $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
                        //         // $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'user_id,sponser_id,directs');
                        //         // $this->roi_level_income($sponser['sponser_id'], $down_id = $user['user_id'],$user['roi_amount']);
                        //     }
                        // }else{
                        $incomeArr = array(
                            'user_id' => $user['user_id'],
                            'amount' => $user['roi_amount'],
                            'type' => $user['type'],
                            'description' => ucwords(str_replace("_", " ", $user['type'])),
                        );
                        pr($incomeArr);
                        $this->Main_model->add('tbl_income_wallet', $incomeArr);
                        $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount']),'createDate' => date('Y-m-d')));
                        //  $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']],'user_id,sponser_id,directs');
                        //   $this->roi_level_income($sponser['sponser_id'], $down_id = $user['user_id'],$user['roi_amount']);
                    }
                // }
                //endif;
            }
            $this->Main_model->add('tbl_cron', ['cron_name' => 'roiCron']);
        else :
            echo 'Today Cron already run';
        endif;
    }


    private function coin_level_income_temp($sponser_id, $activated_id, $level_income)
    {
        //$incomes = array(100,50,40,30,10,10,10);
        //$incomes = array(4,2,1,1,1,1);
        $incomes = explode(',', $level_income);

        foreach ($incomes as $key => $income) {
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "' . $sponser_id . '" AND paid_status > "0" AND topup_date >= "' . $sponser['topup_date'] . '"', 'count(id) as direct');
            if (!empty($sponser)) {
                // $directs = ($key+1);
                $level = ($key + 1);
                if ($sponser['paid_status'] > 0) {
                    //if($sponser['upgrade_package'] >= $package_amount){                            
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'coin_income',
                        'description' => 'Coin from Activation of Member ' . $activated_id  . ' At level ' . ($level),
                    );
                    pr($LevelIncome);
                    $this->Main_model->add('tbl_coin_wallet', $LevelIncome);

                    //}
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }


    // public function level_income($sponser_id,$activated_id, $level_income){
    //     //$incomes = array(100,50,40,30,10,10,10);
    //     //$incomes = array(4,2,1,1,1,1);
    //     $incomes = explode(',', $level_income);

    //     foreach($incomes as $key => $income){
    //         $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
    //         $direct = $this->User_model->get_single_record('tbl_users', 'sponser_id =  "'.$sponser_id.'" AND paid_status > "0" AND topup_date >= "'.$sponser['topup_date'].'"', 'count(id) as direct');
    //         if(!empty($sponser)){
    //             // $directs = ($key+1);
    //             $level = ($key+1);
    //             if($sponser['paid_status'] > 0){
    //                 //if($sponser['upgrade_package'] >= $package_amount){                            
    //                     $LevelIncome = array(
    //                         'user_id' => $sponser['user_id'],
    //                         'amount' => $income,
    //                         'type' => 'coin_income', 
    //                         'description' => 'Coin from Activation of Member '.$activated_id  . ' At level '.($level),
    //                     );
    //                     $this->User_model->add('tbl_coin_wallet', $LevelIncome);

    //                 //}
    //             }
    //             $sponser_id = $sponser['sponser_id'];
    //         }
    //     }
    // }


    public function credit_level_income2()
    {
        $income = [
            1 => 3,
            2 => 2,
            3 => 2,
            4 => 2,
            5 => 1,
            6 => 1,
            7 => 1,
            8 => 1,
            9 => 1,
            10 => 1,
        ];
        $users = $this->db->query('SELECT count(tbl_sponser_count.id) as total_user, tbl_sponser_count.user_id, level FROM `tbl_sponser_count` INNER JOIN tbl_users ON tbl_users.user_id = tbl_sponser_count.downline_id WHERE tbl_users.paid_status = "1" AND tbl_sponser_count.level <= "10" GROUP by tbl_sponser_count.level,tbl_sponser_count.user_id ORDER BY tbl_sponser_count.level ASC')->result_array();
        foreach ($users as $key => $user) {
            $credit_income = ($user['total_user'] * $income[$user['level']]);
            $level = $user['level'];
            $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "' . $user['user_id'] . '" AND paid_status > "0"', 'count(id) as direct');
            $paid_status = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user['user_id']], 'paid_status');
            $preview_date = date('Y-m-d', strtotime('-1 day'));
            $task_play = $this->Main_model->get_single_record('tbl_task', 'user_id = "' . $user['user_id'] . '" AND date(created_at) = "' . $preview_date . '" AND redeem = "1"', '*');
            if ($direct['direct'] >= $level && $credit_income > 0 && !empty($task_play)) {
                if ($paid_status['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $user['user_id'],
                        'amount' => $credit_income,
                        'type' => 'level_income',
                        'description' => 'Total Active Member ' . $user['total_user']  . ' At level ' . $level,
                        'level' => $level,
                    );
                    pr($LevelIncome);
                    $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                }
            }
            //pr($user);
        }
    }


    public function credit_level_income1()
    {
        ini_set('max_execution_time', '0');
        $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
        foreach ($users as $key => $user) {
            $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "' . $user['user_id'] . '" AND paid_status > "0"', 'count(id) as direct');
            $preview_date = date('Y-m-d', strtotime('-1 day'));
            $task_play = $this->Main_model->get_single_record('tbl_task', 'user_id = "' . $user['user_id'] . '" AND date(created_at) = "' . $preview_date . '" AND redeem = "1"', '*');

            $level_income = '3,2,2,2,1,1,1,1,1,1';
            $incomes = explode(',', $level_income);
            foreach ($incomes as $key => $income) {
                $level = ($key + 1);
                $query = $this->db->query('SELECT count(tbl_sponser_count.id) as total_ids FROM tbl_sponser_count INNER JOIN tbl_users ON tbl_sponser_count.downline_id = tbl_users.user_id WHERE tbl_sponser_count.user_id = "' . $user['user_id'] . '" AND tbl_sponser_count.level = "' . $level . '" AND tbl_users.paid_status = "1"')->row_array();
                $credit = ($query['total_ids'] * $income);
                if ($direct['direct'] >= $level && $income > 0 && !empty($task_play)) {
                    $LevelIncome = array(
                        'user_id' => $user['user_id'],
                        'amount' => $credit,
                        'type' => 'level_income',
                        'description' => 'Total Active Member ' . $query['total_ids']  . ' At level ' . $level,
                        'level' => $level,
                    );
                    pr($LevelIncome);
                }
            }

            // $query = $this->db->query('SELECT count(tbl_sponser_count.id) as total_ids FROM tbl_sponser_count INNER JOIN tbl_users ON tbl_sponser_count.downline_id = tbl_users.user_id WHERE tbl_sponser_count.user_id = "'.$user['user_id'].'" AND tbl_sponser_count.level = "2" AND tbl_users.paid_status = "1"')->row_array();
            // $income = $query['total_ids']*2;
            // if($direct['direct'] >= 2 && $income > 0 && !empty($task_play)){
            //     $LevelIncome = array(
            //         'user_id' => $user['user_id'],
            //         'amount' => $income,
            //         'type' => 'level_income', 
            //         'description' => 'Total Active Member '.$query['total_ids']  . ' At level 2',
            //         'level' => 2,
            //     );
            //     pr($LevelIncome);
            // }

            // echo $user['user_id'];
            // pr($query);

            //$get_users = $this->Main_model->get_records('tbl_sponser_count', ['user_id' => $user_id, 'level' => 1], '*');
        }
    }

    // public function credit_level_income2()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 2, 2, $direct['direct']);
    //     }
    // }

    // public function credit_level_income3()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 3, 2, $direct['direct']);
    //     }
    // }

    // public function credit_level_income4()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 4, 2, $direct['direct']);
    //     }
    // }

    // public function credit_level_income5()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 5, 1, $direct['direct']);
    //     }
    // }

    // public function credit_level_income6()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 6, 1, $direct['direct']);
    //     }
    // }


    // public function credit_level_income7()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 7, 1, $direct['direct']);
    //     }
    // }


    // public function credit_level_income8()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 8, 1, $direct['direct']);
    //     }
    // }


    // public function credit_level_income9()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 9, 1, $direct['direct']);
    //     }
    // }

    // public function credit_level_income10()
    // {
    //     ini_set('max_execution_time', '0');
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount,directs');
    //     foreach ($users as $key => $user) {
    //         $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "'.$user['user_id'].'" AND paid_status > "0"', 'count(id) as direct');
    //         $this->generate_level_income($user['user_id'], 10, 1, $direct['direct']);
    //     }
    // }

    public function generate_level_income($user_id, $level, $income, $directs)
    {
        ini_set('max_execution_time', '0');
        $get_users = $this->Main_model->get_records('tbl_sponser_count', ['user_id' => $user_id, 'level' => $level], '*');
        foreach ($get_users as $key => $user) {
            $paid_status = $this->Main_model->get_single_record('tbl_users', ['paid_status' => 1, 'user_id' => $user['downline_id']], 'paid_status');
            if ($paid_status['paid_status'] == 1) {
                $preview_date = date('Y-m-d', strtotime('-1 day'));
                $task_play = $this->Main_model->get_single_record('tbl_task', 'user_id = "' . $user_id . '" AND date(created_at) = "' . $preview_date . '" AND redeem = "1"', '*');
                if (!empty($task_play)) {
                    if ($directs >= $level) {
                        $LevelIncome = array(
                            'user_id' => $user_id,
                            'amount' => $income,
                            'type' => 'level_income',
                            'description' => 'Ad Level Income from Member ' . $user['downline_id']  . ' At level ' . ($level),
                            'level' => $level,
                        );
                        $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                        pr($LevelIncome);
                    }
                }
            }
        }
    }


    public function credit_level_income()
    {
        ini_set('max_execution_time', '0');
        $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,name,created_at,package_amount');
        foreach ($users as $key => $user) {
            $package = $this->Main_model->get_single_record('tbl_package', ['price' => $user['package_amount']], '*');
            $this->level_income($user['user_id'], $user['user_id'], $package['level_income']);
            //pr($package);
        }
    }


    public function level_income($sponser_id, $activated_id, $level_income)
    {
        //$incomes = array(100,50,40,30,10,10,10);
        //$incomes = array(4,2,1,1,1,1);
        $incomes = explode(',', $level_income);

        foreach ($incomes as $key => $income) {
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            $direct = $this->Main_model->get_single_record('tbl_users', 'sponser_id =  "' . $sponser_id . '" AND paid_status > "0" AND topup_date >= "' . $sponser['topup_date'] . '"', 'count(id) as direct');
            $preview_date = date('Y-m-d', strtotime('-1 day'));
            $task_play = $this->Main_model->get_single_record('tbl_task', 'user_id = "' . $sponser_id . '" AND date(created_at) = "' . $preview_date . '" AND redeem = "1"', '*');

            if (!empty($sponser)) {
                $directs = ($key + 1);
                $level = ($key + 1);
                if ($direct['direct'] >= $directs && $sponser['paid_status'] > 0) {
                    if (!empty($task_play)) {
                        //if($sponser['upgrade_package'] >= $package_amount){                            
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $income,
                            'type' => 'level_income',
                            'description' => 'Ad Level Income from Member ' . $activated_id  . ' At level ' . ($level),
                        );
                        //$this->Main_model->add('tbl_income_wallet', $LevelIncome);
                        pr($LevelIncome);
                        //}
                    }
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }


    public function retopup_process()
    {
        $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], 'id,user_id,created_at,topup_date');
        foreach ($users as $key => $user) {
            $time2 = $user['topup_date'];
            $time1 = date('Y-m-d H:i:s');
            $hourdiff = round((strtotime($time1) - strtotime($time2)) / 3600, 1);

            $seconds = (strtotime($time1) - strtotime($time2));
            $days = intval(intval($seconds) / (3600 * 24));
            if ($days >= 30) {
                $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['paid_status' => 0]);
                echo $days;
                pr($user);
            }
        }
    }

    public function generate_coins(Type $var = null)
    {
        $users = $this->Main_model->get_records('tbl_users', ['topup_date >' => 0], 'id,user_id,topup_date');
        foreach ($users as $key => $user) {
            $credit_coin = [
                'user_id' => $user['user_id'],
                'description' => 'SDC Coin from Activation of Member ' . $user['user_id'],
                'amount' => 1000,
                'type' => 'coin_income',
                'created_at' => $user['topup_date'],
            ];
            pr($credit_coin);
            $this->Main_model->add('tbl_coin_wallet', $credit_coin);
        }
    }

    // public function importData($value='')
    // {
    //     die('ok');
    //     $users = $this->Main_model->get_records('users', [''], '*');
    //     foreach ($users as $key => $user) {
    //         $user_id = $user['username'];
    //         $password = $user['password_text'];
    //         $phone = $user['mobile'];
    //         $phone2 = $user['mobile1'];
    //         $email = $user['email'];
    //         $address = $user['address'];
    //         $sponser_id = $user['referral'];
    //         $name = $user['first_name'];
    //         $package_amount = $user['package'];
    //         $first_name = $user['first_name'];
    //         $last_name = $user['last_name'];
    //         $address = $user['address'];
    //         $city = $user['city'];
    //         $country = $user['country'];
    //         $district = $user['district'];
    //         $old_balance = $user['old_balance'];
    //         $wallet_balance_level = $user['wallet_balance_level'];
    //         $wallet_balance = $user['wallet_balance'];



    //         // register 
    //         $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['referral']), '*');
    //         if(!empty($sponser)){

    //             $package = $this->User_model->get_single_record('tbl_package', array('price' => $package_amount), '*');

    //             if($package['price'] > 0){
    //                 $package_amount = $package['price'];
    //                 $package_id = $package['id'];
    //                 $paid_status = 1;
    //             }else{
    //                 $package_amount = 0;
    //                 $package_id = 0;
    //                 $paid_status = 0;
    //             }

    //             $createUser = [
    //                 'user_id' => $user_id,
    //                 'password' => $password,
    //                 'sponser_id' => $sponser_id,
    //                 'name' => $name,
    //                 'package_amount' => $package_amount,
    //                 'package_id' => $package_id,
    //                 'paid_status' => $paid_status,
    //                 'phone' => $phone,
    //                 'email' => $email,
    //                 'address' => $address,
    //                 'first_name' => $first_name,
    //                 'last_name' => $last_name,
    //                 'address' => $address,
    //                 'city' => $city,
    //                 'country' => $country,
    //                 'old_balance' => $old_balance,
    //                 'wallet_balance_level' => $wallet_balance_level,
    //                 'wallet_balance' => $wallet_balance,
    //                 'phone2' => $phone2,
    //                 'topup_date' => date('Y-m-d H:i:s'),
    //             ];
    //             pr($createUser);

    //             $res = $this->User_model->add('tbl_users', $createUser);


    //             $createBankDetails = [
    //                 'user_id' => $user_id,
    //                 'bank_name' => $user['bank_name'],
    //                 'bank_account_number' => $user['account_number'],
    //                 'ifsc_code' => $user['ifsc_code'],
    //                 'aadhar' => $user['aadhar'],
    //                 'branch' => $user['branch'],
    //                 'account_type' => $user['account_type'],
    //             ];

    //             $res = $this->User_model->add('tbl_bank_details',$createBankDetails);

    //             if ($res) {
    //                 $this->add_sponser_counts($user_id,$user_id, $level = 1);
    //             }
    //         }
    //     }
    // }

    // private function add_sponser_counts($user_name, $downline_id, $level) {
    //     $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
    //     if ($user['sponser_id'] != '') {
    //             $downlineArray = array(
    //                 'user_id' => $user['sponser_id'],
    //                 'downline_id' => $downline_id,
    //                 'position' => '',
    //                 'created_at' => 'CURRENT_TIMESTAMP',
    //                 'level' => $level,
    //             );
    //             $this->User_model->add('tbl_sponser_count', $downlineArray);
    //             $user_name = $user['sponser_id'];
    //             $this->add_sponser_counts($user_name, $downline_id, $level + 1);
    //     }
    // }


    // public function updateDirects($value='')
    // {
    //     $users = $this->Main_model->get_records('tbl_users', [''], '*');
    //     foreach ($users as $key => $user) {
    //         // $sponserCount = $this->Main_model->get_single_record('tbl_users', ['sponser_id' => $user['user_id'], 'paid_status > ' => 0], 'ifnull(count(id),0) as sponserCount');
    //         // $package = $this->User_model->get_single_record('tbl_package', array('price' => $user['package_id']), '*');
    //         $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['master_key' => rand(1000,9999)]);
    //         pr($user);
    //     }
    // }

    // public function blockUser(){
    //    //  $uDetails = $this->Main_model->get_single_record('tbl_users',['paid_status' => 0,'disabled' => 0],'created_at,user_id');
    //    //  $date1 = date('Y-m-d H:i:s');
    //    //  $date2 = date('Y-m-d H:i:s',strtotime($uDetails['created_at'].'+ 50 hours'));
    //    //  $Diffs = strtotime($date1) - strtotime($date2);
    //    // // pr($uDetails);
    //    // // echo $date2;
    //    // //  echo $Diffs;
    //    //  if($Diffs > 0){
    //    //     $this->Main_model->update('tbl_users',['user_id' => $uDetails['user_id']],['disabled' => 1]);
    //    //      echo 'Blocked';
    //    //  }
    // }


    // // public function leveldelete(){
    // //      $users = $this->Main_model->get_records('tbl_users', ['package_amount'=>100], 'user_id,package_amount,id');
    // //      foreach ($users as $key => $value) {
    // //        //$record $this->Main_model->get_single_record('tbl_income_wallet',['id' => $value['id']],'id');
    // //      $this->Main_model->leveldelete('tbl_income_wallet',['user_id' => $value['user_id'],'type' => 'level_income']);
    // //      pr($value);
    // //      }

    // // }


    public function freeCron(){
        $uDetails = $this->Main_model->get_records('tbl_users',['paid_status' => 1],'topup_date,user_id');
        if(!empty($uDetails)){
            foreach ($uDetails as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].'+ 30 days'));
                $Diffs = strtotime($date2) - strtotime($date1);
                if($Diffs < 0 && $user['topup_date'] != "0000-00-00 00:00:00"){
                    echo $date2.'<br>';
                    echo $Diffs.'<br>';
                    pr($user);
                    $freeUser = [
                        //  'active_status' => 0,
                            'paid_status' =>0,
                            'topup_date' => '0000-00-00 00:00:00',
                            // 'package_id' => 0,
                            'package_amount' => 0,
            
                        ];
                        pr($freeUser);
                    $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],$freeUser);
                    // $deACTIVATE=['user_id' => $user['user_id']];
                    // $this->Main_model->add('tbl_deactivation_details',$deACTIVATE);
                }
            }
        }
    }


    public function loseIncomeCron(){
        $uDetails = $this->Main_model->get_records('tbl_users',['package_id' => 1],'topup_date,user_id,directs');
        if(!empty($uDetails)){
            foreach ($uDetails as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].'+ 60 days'));
                $Diffs = strtotime($date2) - strtotime($date1);
                if($Diffs < 0 && $user['topup_date'] != "0000-00-00 00:00:00" && $user['directs'] < 2){
                    echo $date2.'<br>';
                    echo $Diffs.'<br>';
                    $checkIncome = $this->Main_model->get_single_record('tbl_income_wallet',['user_id' => $user['user_id']],'ifnull(sum(amount),0)as total');
                    if($checkIncome['total'] >0){
                        $Income = array(
                            'user_id' => $user['user_id'],
                            'amount' => -$checkIncome['total'],
                            'type' => 'lose_money',
                            'description' => 'Lose Money',
                            'level' => $level,
                        );
                        pr($checkIncome);
                       $this->Main_model->add('tbl_income_wallet', $Income);
                    }
                    
                    // $deACTIVATE=['user_id' => $user['user_id']];
                    // $this->Main_model->add('tbl_deactivation_details',$deACTIVATE);
                }
            }
        }
    }



























    // ////////////////////// ----------------- ///////////////// SK


    // public function upgradeAtSet($value='')
    // {
    //     $users = $this->Main_model->get_records('tbl_wallet', 'remark LIKE "%Account upgradation%" AND date(created_at) >= "2021-11-29"', '*');
    //     foreach ($users as $key => $user) {
    //         $user_id = str_replace("Account upgradation deduction for ", "", $user['remark']);
    //         pr($user);
    //         $set = ['upgrade_at' => $user['created_at']];
    //         $this->Main_model->update('tbl_users', ['user_id' => $user_id], $set);
    //     }
    // }


    // public function retopupProcess()
    // {
    //     $users = $this->Main_model->get_records('tbl_users', ['paid_status >' => 0], '*');
    //     foreach ($users as $key => $user) {
    //         if($user['upgrade_id'] > 0){
    //             $package_amount = $user['upgrade_package'];
    //             $topup_date = $user['upgrade_at'];
    //         }else{
    //             $package_amount = $user['package_amount'];
    //             $topup_date = $user['topup_date'];
    //         }

    //         if($package_amount >= 1199 || $package_amount >= 4999){

    //             $time2 = $topup_date;
    //             $time1 = date('Y-m-d H:i:s');
    //             $hourdiff = round((strtotime($time1) - strtotime($time2))/3600, 1);

    //             $seconds = (strtotime($time1) - strtotime($time2));
    //             $days = intval(intval($seconds) / (3600*24));
    //             if($days >= 15){
    //                 $set = [
    //                     'paid_status' => 0,
    //                 ];
    //                 $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], $set);

    //             }

    //         }
    //     }
    // }

    // public function remove_roi_level(){
    //     die('Stop');
    //     $achievers = $this->Main_model->checkRoiLevel();
    //     foreach($achievers as $key => $ac){
    //         for($i=1;$i<=14;$i++){
    //             $users = $this->Main_model->get_single_record('tbl_roi',array('user_id' => $ac['user_id'],'level' => $i),'*');
    //             if(!empty($users)){
    //                 $date1 = date('Y-m-d H:i:s');
    //                 $date2 = date('Y-m-d H:i:s',strtotime($users['created_at'].'+ 72 hours'));
    //                 $diff = strtotime($date1) - strtotime($date2);
    //                 //echo $diff . 'level '.$i.'<br>';
    //                 if($diff > 0){
    //                     //$this->lapsLevel($users['id'],$ac['user_id'],$i);
    //                 }
    //             }else{
    //                 $i = 14;
    //             }
    //         }
    //     }
    // }

    // public function lapsLevel($id,$user_id,$level){
    //     $legArr = $this->config->item('singleLeg');
    //     foreach($legArr as $key => $la){
    //         if($level == $key){
    //             $userdata = $this->Main_model->get_single_record('tbl_users',array('user_id' => $user_id),'directs');
    //             if($userdata['directs'] < $la['checkDirect']){
    //                 //$this->Main_model->update('tbl_roi',array('id' => $id,'level' => $level),array('days' => 0));
    //             }
    //         }
    //     }
    // }

    // public function calculate_roi_users(){
    //     //die;
    //     echo 'Start: '.date('H:i:s');
    //     $last_id = $this->Main_model->get_single_record_desc('tbl_users',array(),'id');
    //     $achievers = $this->Main_model->get_records('tbl_users', array('paid_status' => 1), 'id,user_id,sponser_id,directs,total_user_after_paid,single_leg_status');
    //     $legArr = $this->config->item('singleLeg');
    //     foreach($achievers as $key => $achiever){
    //         $directs = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $achiever['user_id'] , 'paid_status' => 1), 'ifnull(count(id),0) as directs');
    //         foreach($legArr as $key2 => $la){
    //             if($achiever['single_leg_status'] < $key2){
    //                 $new_id = $last_id['id'] - $achiever['id'];
    //                 if($directs['directs'] >= $la['checkDirect'] && ($achiever['total_user_after_paid']) >= $la['winning_team']){
    //                 //if($achiever['total_user_after_paid'] >= $la['winning_team']){
    //                     $roi_user = $this->Main_model->get_single_record('tbl_roi', array('user_id' => $achiever['user_id'] , 'level' => $key2), '*');
    //                     if(empty($roi_user)){

    //                         $roiArr = array(
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => $la['amount'],
    //                             'type' => 'single_leg',
    //                             'remark' =>'Single Leg Income for '.$key2.'  Level',
    //                             'level' => $key2,
    //                             'days' => $la['days'],
    //                         );
    //                         pr($roiArr);
    //                         echo date('H:i:s');
    //                         $this->Main_model->add('tbl_roi', $roiArr);
    //                         $this->Main_model->update('tbl_users', array('user_id' => $achiever['user_id']), array('single_leg_status' => $key2));
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     echo 'Done'.date('H:i:s');
    // }

    // public function credit_roi_income(){
    //     if(date('D') == 'Sun'){
    //         die('Sunday ROI Closed');
    //     }

    //     $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "roi_cron"' ,'*');
    //     if(empty($cron)){
    //         for ($i=1; $i < 14; $i++) {
    //             $achievers = $this->Main_model->get_records('tbl_roi', array('days >=' => 0, 'level' => $i), '*');
    //             foreach($achievers as $key => $achiever){
    //                 $legArr = $this->config->item('singleLeg');
    //                 $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');

    //                 if($user['directs'] >= $legArr[$achiever['level']]['checkDirect'] && $user['paid_status'] == 1){
    //                     //if($achiever['level'] < 6){
    //                         $income = array(
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => $achiever['amount'],
    //                             'type' => $achiever['type'],
    //                             'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                             'level' => $achiever['level'],
    //                         );

    //                         $this->Main_model->add('tbl_income_wallet', $income);
    //                         // $checkPool = $this->Main_model->get_single_record('tbl_pool',['user_id' => $achiever['user_id']],'*');
    //                         // if($achiever['level'] == '5'):
    //                         //     if(empty($checkPool)):
    //                         //         $debit = [
    //                         //             'user_id' => $achiever['user_id'],
    //                         //             'amount' => -1000,
    //                         //             'type' => 'upgrade_deduction',
    //                         //             'description' => 'Upgrade deduction for Pool',
    //                         //         ];
    //                         //         $this->Main_model->add('tbl_income_wallet',$debit);
    //                         //         $this->pool_entry($achiever['user_id'],'tbl_pool');
    //                         //     endif;
    //                         // endif;
    //                     // }elseif($achiever['level'] > 5){
    //                     //     if($achiever['days'] == $legArr[$achiever['level']]['days']){
    //                     //         $income = array(
    //                     //             'user_id' => $achiever['user_id'],
    //                     //             'amount' => $achiever['amount'],
    //                     //             'type' => 'repurchase_income',
    //                     //             'description' => 'Repurchase Income At Day '.$achiever['days'].' at level '.$achiever['level'],
    //                     //             'level' => $achiever['level'],
    //                     //         );

    //                     //         $this->Main_model->add('tbl_income_wallet', $income);
    //                     //     }else{
    //                     //         $income = array(
    //                     //             'user_id' => $achiever['user_id'],
    //                     //             'amount' => $achiever['amount'],
    //                     //             'type' => $achiever['type'],
    //                     //             'description' => $achiever['remark'] .' At Day '.$achiever['days'],
    //                     //             'level' => $achiever['level'],
    //                     //         );

    //                     //         $this->Main_model->add('tbl_income_wallet', $income);
    //                     //     }
    //                     // }
    //                     pr($user);
    //                     $this->Main_model->update('tbl_roi', array('id' => $achiever['id']), array('days' => $achiever['days'] - 1));
    //                 }
    //             }
    //         }
    //         $this->Main_model->add('tbl_cron', array('cron_name' => 'roi_cron'));
    //         //$this->checkPoolEntry();
    //         echo 'Done';
    //     }else{
    //         echo'today cron already run';
    //     }
    // }

    // public function checkPoolEntry(){
    //     //die;
    //     //for($i=1; $i < 14; $i++):
    //         $achievers = $this->Main_model->get_records('tbl_roi', array('level' => 5), '*');
    //         foreach($achievers as $key => $achiever):
    //             $legArr = array(
    //                 1 => array('winning_team' => 100, 'direct_sponser' => 1, 'amount' =>30, 'days' => 25),
    //                 2 => array('winning_team' => 350, 'direct_sponser' => 2, 'amount' => 40, 'days' => 30),
    //                 3 => array('winning_team' => 750, 'direct_sponser' => 3, 'amount' => 60, 'days' => 35),
    //                 4 => array('winning_team' => 1750, 'direct_sponser' => 5, 'amount' => 100, 'days' => 40),
    //                 5 => array('winning_team' => 3750, 'direct_sponser' => 7, 'amount' => 125, 'days' => 50),
    //                 6 => array('winning_team' => 8250, 'direct_sponser' => 11, 'amount' => 175, 'days' => 60),
    //                 7 => array('winning_team' => 15750, 'direct_sponser' => 17, 'amount' => 210, 'days' => 80),
    //                 8 => array('winning_team' => 25750, 'direct_sponser' => 24, 'amount' => 270, 'days' => 80),
    //                 9 => array('winning_team' => 45750, 'direct_sponser' => 32, 'amount' => 320, 'days' => 80),
    //                 10 => array('winning_team' => 80750, 'direct_sponser' => 42, 'amount' => 400, 'days' => 100),
    //                 11 => array('winning_team' => 130750, 'direct_sponser' => 54, 'amount' => 600, 'days' => 120),
    //                 12 => array('winning_team' => 205750, 'direct_sponser' => 68, 'amount' => 800, 'days' => 150),
    //                 13 => array('winning_team' => 305750, 'direct_sponser' => 84, 'amount' => 1000, 'days' => 200),
    //                 14 => array('winning_team' => 455750, 'direct_sponser' => 104, 'amount' => 1200, 'days' => 250),
    //             );
    //             $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => str_replace(' ','',$achiever['user_id'])), 'id,user_id,directs,single_leg_status,paid_status');
    //             if($user['directs'] >= $legArr[$achiever['level']]['direct_sponser'] && $user['paid_status'] == 1):
    //                 $checkPool = $this->Main_model->get_single_record('tbl_pool',['user_id' => $achiever['user_id']],'*');
    //                 if($achiever['level'] == '5'):
    //                     if(empty($checkPool)):
    //                         $debit = [
    //                             'user_id' => $achiever['user_id'],
    //                             'amount' => -1000,
    //                             'type' => 'upgrade_deduction',
    //                             'description' => 'Upgrade deduction for Pool',
    //                         ];
    //                         $this->Main_model->add('tbl_income_wallet',$debit);
    //                         $this->pool_entry($achiever['user_id'],'tbl_pool');
    //                     endif;
    //                 endif;
    //             endif;
    //         endforeach;
    //     //endfor;
    // }

    // protected function pool_entry($user_id,$table){
    //     $pool_upline = $this->Main_model->get_single_record($table, array('down_count <' => 2), 'id,user_id,down_count');
    //     if(!empty($pool_upline)){
    //         $poolArr =  array(
    //             'user_id' => $user_id,
    //             'upline_id' => $pool_upline['user_id'],
    //         );
    //         $this->Main_model->add($table, $poolArr);
    //         $this->Main_model->update($table, array('id' => $pool_upline['id']),array('down_count' => $pool_upline['down_count'] + 1));
    //         $this->updateTeam($user_id,$table);
    //         $this->poolIncome($table,$user_id);
    //     }else{
    //         $poolArr =  array(
    //             'user_id' => $user_id,
    //             'upline_id' => '',
    //         );
    //         $this->Main_model->add($table, $poolArr);
    //         $this->updateTeam($user_id,$table);
    //         $this->poolIncome($table,$user_id);
    //     }
    // }

    // protected function updateTeam($user_id,$table){
    //     $uplineID = $this->Main_model->get_single_record($table,array('user_id' => $user_id),'upline_id');
    //     if(!empty($uplineID['upline_id'])){
    //         $team = $this->Main_model->get_single_record($table,array('user_id' => $uplineID['upline_id']),'team');
    //         $newTeam = $team['team'] + 1;
    //         $this->Main_model->update($table, array('user_id' => $uplineID['upline_id']),array('team' => $newTeam));
    //         $this->updateTeam($uplineID['upline_id'],$table);
    //     }
    // }

    // private function poolIncome($table,$user_id){
    //     if($table == 'tbl_pool'){
    //         $incomes  = ['2' => '100','6' => '300','14' => '800','30' => '1600','62' => '3200'];
    //         $pool = 'Star';
    //         $upgrade = 3000;
    //         $table2 = 'tbl_pool2';
    //     }elseif($table == 'tbl_pool2'){
    //         $incomes = ['2' => '200','6' => '1200','14' => '3200','30' => '8000','62' => '22400'];
    //         $pool = 'Silver';
    //         $upgrade = 15000;
    //         $table2 = 'tbl_pool3';
    //     }elseif($table == 'tbl_pool3'){
    //         $incomes = ['2' => '2000','6' => '5600','14' => '12800','30' => '32000','62' => '128000'];
    //         $pool = 'Gold';
    //         $upgrade = 70000;
    //         $table2 = 'tbl_pool4';
    //     }elseif($table == 'tbl_pool4'){
    //         $incomes = ['2' => '10000','6' => '28000','14' => '64000','30' => '160000','62' => '640000'];
    //         $pool = 'Ruby';
    //         $upgrade = 400000;
    //         $table2 = 'tbl_pool5';
    //     }elseif($table == 'tbl_pool5'){
    //         $incomes = ['2' => '40000','6' => '160000','14' => '480000','30' => '1280000','62' => '3200000'];
    //         $pool = 'Peral';
    //         $upgrade = 2000000;
    //         $table2 = 'tbl_pool6';
    //     }elseif($table == 'tbl_pool6'){
    //         $incomes = ['2' => '200000','6' => '800000','14' => '2400000','30' => '6400000','62' => '16000000'];
    //         $pool = 'Diamond';
    //         $upgrade = 0;
    //     }
    //     foreach($incomes as $key => $inc):
    //         $user = $this->Main_model->get_single_record($table,['user_id' => $user_id],'upline_id');
    //         if(!empty($user['upline_id'])):
    //             $upline = $this->Main_model->get_single_record($table,['user_id' => $user['upline_id']],'*');
    //             if($upline['team'] == $key):
    //                 $userIncome = [
    //                     'user_id' => $upline['user_id'],
    //                     'amount' => $inc,
    //                     'type' => 'pool_income',
    //                     'description' => $pool.' Pool Income',
    //                 ];
    //                 $this->Main_model->add('tbl_income_wallet',$userIncome);
    //                 $user_id = $upline['user_id'];
    //                 if($upline['team'] == 62 && $upgrade > 0):
    //                     $debit = [
    //                         'user_id' => $upline['user_id'],
    //                         'amount' => -$upgrade,
    //                         'type' => 'upgrade_deduction',
    //                         'description' => 'Upgrade deduction for Next Pool',
    //                     ];
    //                     $this->Main_model->add('tbl_income_wallet',$debit);
    //                     $this->pool_entry($upline['user_id'],$table2);
    //                 endif;
    //             endif;
    //         endif;
    //     endforeach;
    // }

    // public function point_match_cron() {
    //     $response['users'] = $this->Main_model->get_records('tbl_users', '((left_count >= 2 and right_count >= 1) || (left_count >= 1 and right_count >= 2) )', 'id,user_id,sponser_id,left_count,right_count,package_amount,capping');
    //     foreach ($response['users'] as $user) {
    //         pr($user);
    //         $position_directs = $this->Main_model->count_position_directs($user['user_id']);
    //         if(!empty($position_directs) && count($position_directs) == 2){
    //             $user_package = $this->Main_model->get_single_record_desc('tbl_package', array('price' => $user['package_amount']), '*');
    //             $user_match = $this->Main_model->get_single_record_desc('tbl_point_matching_income', array('user_id' => $user['user_id']), '*');
    //             if (!empty($user_match)) {
    //                 if ($user['left_count'] > $user['right_count']) {
    //                     $old_income = $user['right_count'];
    //                 } else {
    //                     $old_income = $user['left_count'];
    //                 }
    //                 if ($user_match['left_bv'] > $user_match['right_bv']) {
    //                     $new_income = $user_match['right_bv'];
    //                 } else {
    //                     $new_income = $user_match['left_bv'];
    //                 }
    //                 $income = ($old_income - $new_income);
    //                 $user_income = $income * $user_package['binaryincome'];
    //                 if ($user_income > 0) {
    //                     if($user_income > $user['capping']){
    //                         $user_income = $user['capping'];
    //                     }
    //                     $matchArr = array(
    //                         'user_id' => $user['user_id'],
    //                         'left_bv' => $user['left_count'],
    //                         'right_bv' => $user['right_count'],
    //                         'amount' => $user_income,
    //                     );
    //                     $this->Main_model->add('tbl_point_matching_income', $matchArr);
    //                     $incomeArr = array(
    //                         'user_id' => $user['user_id'],
    //                         'amount' => $user_income,
    //                         'type' => 'matching_bonus',
    //                         'description' => 'Point Matching Bonus'
    //                     );
    //                     $this->Main_model->add('tbl_income_wallet', $incomeArr);
    //                     //$this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'salary_income');
    //                     pr($matchArr);
    //                 }
    //             } else {
    //                 if ($user['left_count'] > $user['right_count']) {
    //                     $income = $user['right_count'];
    //                 } else {
    //                     $income = $user['left_count'];
    //                 }
    //                 $user_income = $income * $user_package['binaryincome'];
    //                 //                echo $user_income;
    //                 if($user_income > $user['capping']){
    //                     $user_income = $user['capping'];
    //                 }
    //                 $matchArr = array(
    //                     'user_id' => $user['user_id'],
    //                     'left_bv' => $user['left_count'],
    //                     'right_bv' => $user['right_count'],
    //                     'amount' => $user_income,
    //                 );
    //                 $this->Main_model->add('tbl_point_matching_income', $matchArr);
    //                 $incomeArr = array(
    //                     'user_id' => $user['user_id'],
    //                     'amount' => $user_income,
    //                     'type' => 'matching_bonus',
    //                     'description' => 'Point Matching Bonus'
    //                 );
    //                 $this->Main_model->add('tbl_income_wallet', $incomeArr);
    //                 //$this->generation_income($user['sponser_id'] , $user_income , $user['user_id'],'direct_sponser_income');
    //                 pr($matchArr);
    //             }

    //         }
    //     }
    //     pr($response);
    //     die('code executed Successfully');
    // }


    // public function roiCron(){
    //     $cron = $this->Main_model->get_single_record('tbl_cron',"date(created_at) = date(now()) and cron_name = 'dailyRoiCron'",'cron_name');
    //     if(empty($cron)){
    //         $roi_users = $this->Main_model->get_records('tbl_roi',['days >' => 0], '*');
    //         foreach($roi_users as $key => $user){
    //             $userinfo = $this->Main_model->get_single_record('tbl_users',['user_id' => $user['user_id']], 'sponser_id,taskStatus,package_id');
    //             $new_day = $user['days'] - 1;
    //             if($userinfo['taskStatus'] == 1){
    //                 $incomeArr = array(
    //                     'user_id' => $user['user_id'],
    //                     'amount' => $user['roi_amount'],
    //                     'type' => 'daily_roi_income', //$user['type'],
    //                     'description' => 'Daily Cashback Income',//$user['description'],
    //                 );
    //                 pr($incomeArr);
    //                 $this->Main_model->add('tbl_income_wallet', $incomeArr);
    //                 $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day));
    //                 $this->Main_model->update('tbl_users', array('user_id' => $user['user_id']),['taskStatus' => 0]);
    //                 $package = $this->Main_model->get_single_record('tbl_package',['id' => $userinfo['package_id']],'level_income');
    //                 $this->task_level_income($userinfo['sponser_id'],$user['user_id'],$package['level_income']);
    //             }
    //         }
    //         $this->Main_model->add('tbl_cron',['cron_name' => 'dailyRoiCron']);
    //     }else{
    //         echo 'Today cron already run';
    //     }
    // }

    // public function task_level_income($sponser_id,$activated_id,$levelIncome){
    //     //$incomes = array(10,9,8,7,5,4,3,2,1,0.5,0.25,0.25,0.10,0.10,0.10);
    //     $incomes = explode(',',$levelIncome);
    //     foreach($incomes as $key => $income){
    //         $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,directs,sponser_id,paid_status');
    //         if(!empty($sponser)){
    //             if($sponser['paid_status'] == 1){
    //                 if($sponser['directs'] >= ($key+1)){
    //                     $LevelIncome = array(
    //                         'user_id' => $sponser['user_id'],
    //                         'amount' => $income ,
    //                         'type' => 'task_level_income', 
    //                         'description' => 'Task Income from Member '.$activated_id.' At level '.($key + 1),
    //                     );
    //                     pr($LevelIncome);
    //                     $this->Main_model->add('tbl_income_wallet', $LevelIncome);
    //                 }
    //             }
    //             $sponser_id = $sponser['sponser_id'];
    //         }
    //     }
    // }

    // public function incomeTransfer(){
    //     $cron = $this->Main_model->get_single_record('tbl_cron',"date(created_at) = date(now()) and cron_name = 'incomeTransfer'",'cron_name');
    //     if(empty($cron)){
    //         $this->Main_model->add('tbl_cron',['cron_name' => 'incomeTransfer']);
    //         $users = $this->Main_model->get_records('tbl_nonworking_wallet',['status' => 0],'*');
    //         foreach($users as $key => $user):
    //             $creditIncome = [
    //                 'user_id' => $user['user_id'],
    //                 'amount' => $user['amount'],
    //                 'type' => $user['type'],
    //                 'description' => $user['description'],
    //                 //'level' => $user['level'],
    //             ];
    //             pr($creditIncome);
    //             $this->Main_model->add('tbl_income_wallet',$creditIncome);
    //             $this->Main_model->update('tbl_nonworking_wallet',['id' => $user['id']],['status' => 1]);
    //         endforeach;
    //     }else{
    //         echo 'Today cron already run';
    //     }
    // }

    // public function selfIncome(){
    //     $users = $this->Main_model->get_records('tbl_users',['directs >=' => 15],'user_id,directs');
    //     if(!empty($users)){
    //         foreach ($users as $user) {
    //             if($user['directs'] >= 70){
    //                 $creditIncome = [
    //                     'user_id' => $user['user_id'],
    //                     'amount' => '500',
    //                     'type' => 'club_income',
    //                     'description' => 'Club Income From 70 Directs',
    //                 ];
    //                 $this->Main_model->add('tbl_income_wallet',$creditIncome);
    //             }elseif($user['directs'] >= 50){
    //                 $creditIncome = [
    //                     'user_id' => $user['user_id'],
    //                     'amount' => '200',
    //                     'type' => 'club_income',
    //                     'description' => 'Club Income From 50 Directs',
    //                 ];
    //                 $this->Main_model->add('tbl_income_wallet',$creditIncome);
    //             }elseif($user['directs'] >= 25){
    //                 $creditIncome = [
    //                     'user_id' => $user['user_id'],
    //                     'amount' => '50',
    //                     'type' => 'club_income',
    //                     'description' => 'Club Income From 25 Directs',
    //                 ];
    //                 $this->Main_model->add('tbl_income_wallet',$creditIncome);
    //             }elseif($user['directs'] >= 15){
    //                 $creditIncome = [
    //                     'user_id' => $user['user_id'],
    //                     'amount' => '20',
    //                     'type' => 'club_income',
    //                     'description' => 'Club Income From 15 Directs',
    //                 ];
    //                 $this->Main_model->add('tbl_income_wallet',$creditIncome);
    //             }
    //         }
    //     }
    // }

    // public function boosterIncome(){
    //     $date = date('Y-m-d',strtotime(date('Y-m-d').' +0 days'));
    //     $todayBusiness = $this->Main_model->get_single_record('tbl_users',['paid_status' => 1,'date(topup_date)' => $date],'ifnull(sum(package_amount),0) as business');
    //     $booster1 = $this->Main_model->get_records('tbl_users',['booster1' => 1],'user_id');
    //     $booster2 = $this->Main_model->get_records('tbl_users',['booster2' => 1],'user_id');
    //     if(!empty($booster1)){
    //         foreach ($booster1 as $b1) {
    //             $creditIncome1 = [
    //                 'user_id' => $b1['user_id'],
    //                 'amount' => '10',
    //                 'type' => 'booster_income1',
    //                 'description' => 'Single Booster Income',
    //             ];
    //             pr($creditIncome1);
    //             $this->Main_model->add('tbl_income_wallet',$creditIncome1);
    //         }
    //     }

    //     if(!empty($booster2)){
    //         foreach ($booster2 as $b2) {
    //             $creditIncome2 = [
    //                 'user_id' => $b2['user_id'],
    //                 'amount' => '20',
    //                 'type' => 'booster_income2',
    //                 'description' => 'Double Booster Income',
    //             ];
    //             pr($creditIncome2);
    //             $this->Main_model->add('tbl_income_wallet',$creditIncome2);
    //         }
    //     }
    // }

    // public function royaltyIncome(){
    //     $date = date('Y-m-d',strtotime(date('Y-m-d').' +0 days'));
    //     $todayBusiness = $this->Main_model->get_single_record('tbl_users',['paid_status' => 1,'date(topup_date)' => $date],'ifnull(sum(amount),0) as business');
    //     $response['users'] = $this->Main_model->get_records('tbl_users', '(left_count >= 1 and right_count >= 1)', 'id,user_id,sponser_id,left_count,right_count,package_amount,capping');
    //     foreach ($response['users'] as $user) {
    //         $royaltyUsers = [];
    //         $i=1;
    //         $position_directs = $this->Main_model->count_position_directs($user['user_id']);
    //         if(!empty($position_directs) && count($position_directs) == 2){
    //             $royaltyUsers[$i] = $user['user_id'];
    //             $i++;
    //         }
    //     }

    //     if(!empty($royaltyUsers)){
    //         $perUserIncome = $todayBusiness['business']/count($royaltyUsers);
    //         foreach($royaltyUsers as $key => $ru){
    //             $userRoyalty = [
    //                 'user_id' => $ru['user_id'],
    //                 'amount' => $perUserIncome,
    //                 'type' => 'royalty_income',
    //                 'description' => 'Royalty Income',
    //             ];
    //             $this->Main_model->add('tbl_income_wallet',$userRoyalty);
    //             $this->teamDevelopmentIncome($ru['user_id'],$ru['user_id'],$perUserIncome);
    //         }
    //     }
    // }

    // private function teamDevelopmentIncome($user_id,$linkedId,$amount){
    //     $incomes = ['0.05','0.05','0.02','0.01','0.01'];
    //     foreach($incomes as $key => $income){
    //         $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id');
    //         if(!empty($user['sponser_id'])){
    //             $userIncome = [
    //                 'user_id' => $user['sponser_id'],
    //                 'amount' => $amount*$income,
    //                 'type' => 'team_development',
    //                 'description' => 'Team Development Income From User '.$linkedId.' at level '.($key+1),
    //             ];
    //             $this->Main_model->add('tbl_income_wallet',$userIncome);
    //         }
    //     }
    // }

    public function rewardsCron()
    {
        // $awardsArr = [
        //     '1' => ['direct' => 15, 'days' => '7', 'reward' => '500', 'team' => '0', 'rank' => 'Star', 'capping' => '1000'],
        //     '2' => ['direct' => 0, 'days' => '7', 'reward' => '1100', 'team' => '75', 'rank' => 'Silver', 'capping' => '3000'],
        //     '3' => ['direct' => 0, 'days' => '7', 'reward' => '3100', 'team' => '300', 'rank' => 'Gold', 'capping' => '5000'],
        //     '4' => ['direct' => 0, 'days' => '7', 'reward' => '5100', 'team' => '1000', 'rank' => 'Platinum', 'capping' => '8000'],
        //     '5' => ['direct' => 0, 'days' => '7', 'reward' => '11000', 'team' => '2500', 'rank' => 'Ruby', 'capping' => '12000'],
        //     '6' => ['direct' => 0, 'days' => '7', 'reward' => '31000', 'team' => '8000', 'rank' => 'Emrald', 'capping' => '24000'],
        //     '7' => ['direct' => 0, 'days' => '7', 'reward' => '100000', 'team' => '25000', 'rank' => 'Diamond', 'capping' => '30000'],
        //     '8' => ['direct' => 0, 'days' => '7', 'reward' => '300000', 'team' => '75000', 'rank' => 'Red Diamond', 'capping' => '50000'],
        //     '9' => ['direct' => 0, 'days' => '7', 'reward' => '500000', 'team' => '200000', 'rank' => 'Crown Diamond', 'capping' => '80000'],
        //     '10' => ['direct' => 0, 'days' => '7', 'reward' => '1000000', 'team' => '500000', 'rank' => 'Kohinor', 'capping' => '100000'],

        // ];
        $awardsArr = [
            '1' => ['direct' => 15, 'days' => '7', 'reward' => '500', 'team' => '0', 'rank' => 'Star', 'capping' => '500'],
            '2' => ['direct' => 0, 'days' => '7', 'reward' => '1100', 'team' => '75', 'rank' => 'Silver', 'capping' => '1500'],
            '3' => ['direct' => 0, 'days' => '7', 'reward' => '3100', 'team' => '300', 'rank' => 'Gold', 'capping' => '2500'],
            '4' => ['direct' => 0, 'days' => '7', 'reward' => '5100', 'team' => '1000', 'rank' => 'Platinum', 'capping' => '4000'],
            '5' => ['direct' => 0, 'days' => '7', 'reward' => '11000', 'team' => '2500', 'rank' => 'Ruby', 'capping' => '6000'],
            '6' => ['direct' => 0, 'days' => '7', 'reward' => '31000', 'team' => '8000', 'rank' => 'Emrald', 'capping' => '8000'],
            '7' => ['direct' => 0, 'days' => '7', 'reward' => '100000', 'team' => '25000', 'rank' => 'Diamond', 'capping' => '12000'],
            '8' => ['direct' => 0, 'days' => '7', 'reward' => '300000', 'team' => '75000', 'rank' => 'Red Diamond', 'capping' => '25000'],
            '9' => ['direct' => 0, 'days' => '7', 'reward' => '500000', 'team' => '200000', 'rank' => 'Crown Diamond', 'capping' => '35000'],
            '10' => ['direct' => 0, 'days' => '7', 'reward' => '1000000', 'team' => '500000', 'rank' => 'Kohinor', 'capping' => '50000'],

        ];
        foreach ($awardsArr as $key => $award) {
            $users = $this->Main_model->get_records('tbl_users', ['paid_status' => 1], 'user_id');
            foreach ($users as $key2 => $u) {
                $directs = $this->Main_model->get_single_record('tbl_users', ['sponser_id' => $u['user_id'], 'paid_status' => 1], 'count(id) as directs');
                if ($directs['directs'] >= $award['direct']) {
                    $check = $this->Main_model->get_single_record('tbl_rewards', ['award_id' => $key, 'user_id' => $u['user_id']], '*');
                    $checkTeam = $this->Main_model->calculate_team($u['user_id'], $key);
                    if ($checkTeam['team'] >= $award['team']) {
                        if (empty($check)) {
                            $rewardData = [
                                'user_id' => $u['user_id'],
                                'amount' => $award['reward'],
                                'award_id' => $key,
                            ];
                            $this->Main_model->add('tbl_rewards', $rewardData);
                            pr($rewardData);
                            $userRoyalty = [
                                'user_id' => $u['user_id'],
                                'amount' => $award['reward'],
                                'type' => 'reward_income',
                                'description' => 'Reward Income',
                            ];
                            $this->Main_model->add('tbl_income_wallet', $userRoyalty);
                            $this->Main_model->update('tbl_users', ['user_id' => $u['user_id']], ['rank' => $award['rank']]);
                        }
                    }
                }
            }
        }
        
    }

    public function businessCalculationReward()
    {
        // $livePrice = getPrice();
        $rewards = $this->config->item('rewards');
        foreach ($rewards as $rkey => $reward) {
            $users = get_records('tbl_users', ['paid_status >' => 0], '*');
            foreach ($users as $key => $user) {
                $getDirects = get_records('tbl_users', ['sponser_id' => $user['user_id']], 'user_id');
                $directArr = [];
                foreach ($getDirects as $key2 => $gd) {
                    $selfBusiness = get_single_record('tbl_users', ['user_id' => $gd['user_id']], 'package_amount');
                    $getBusiness = $this->Main_model->getTeamBusiness($gd['user_id']);
                    
                    $directArr[$key2] = [
                        'user_id' => $gd['user_id'],
                        // 'downline_id' => $getBusiness['downline_id'],
                        'business' => $getBusiness['business'] + $selfBusiness['package_amount'],
                        'directBusiness' => $selfBusiness['package_amount'],
                    ];
                 
                }
                $columns = array_column($directArr, 'business');
                array_multisort($columns, SORT_DESC, $directArr);
                $teamA = 0;
                $teamB = 0;
                $secondLeg = 0;
                $thirdLeg = 0;
                $directBusiness = 0;
                // $fourthLeg = 0;
                foreach ($directArr as $dkey => $da) {
                    $directBusiness += $da['directBusiness'];
                    if ($dkey == 0) {
                        $teamA = $da['business'];
                    } else {
                        $teamB += $da['business'];
                        if ($dkey == 1) {
                            $secondLeg = $da['business'];
                        }
                        if ($dkey == 2) {
                            $thirdLeg += $da['business'];
                        }
                        // if($dkey == 4){
                        //     $fourthLeg = $da['business'];
                        // }
                    }
                }

                $response = [
                    'user_id' => $user['user_id'],
                    // 'teamBusiness' => $teamA,
                    'directBusiness' => $directBusiness,
                    'firstLeg' => $teamA,
                    'secondLeg' => $secondLeg,
                    'thirdLeg' => $thirdLeg,
                    // 'fourthLeg' => $fourthLeg,
                ];
                pr($response);
                if ($response['firstLeg']  >= ($reward['business'] * 0.30) && $response['secondLeg'] >= ($reward['business'] * 0.30) && $response['thirdLeg'] >= ($reward['business'] * 0.40) ) {
                    $check = get_single_record('tbl_rewards', ['award_id' => $rkey, 'user_id' => $user['user_id']], '*');
                    $rewardCheck = get_single_record('tbl_users', ['user_id' => $user['user_id']], '*');
                    // if ($rewardCheck['reward_income'] == 0) {
                    if (empty($check)) {
                        $rewardData = [
                            'user_id' => $user['user_id'],
                            'amount' => $reward['reward'],
                            'rewards' => $reward['reward2'],
                            // 'rank' => $reward['Rank'],
                            'award_id' => $rkey,
                        ];
                        $this->Main_model->add('tbl_rewards', $rewardData);

                        echo '<p style="color:green;"> Reward Credited....</p>';
                        pr($rewardData);
                       
                        // update('tbl_users', ['user_id' => $user['user_id']], ['on_roi' => $reward['roi'], 'rank' => $rkey, 'rank_user' => $rkey]);
                        // $this->rewardCron_star();
                        // }
                    }
                }
            }
        }
    }



    public function cappingCron()
    {

       
        $awardsArr = [
            '1' => ['direct' => 15, 'days' => '7', 'reward' => '500', 'team' => '0', 'rank' => 'Star', 'capping' => '500'],
            '2' => ['direct' => 0, 'days' => '7', 'reward' => '1100', 'team' => '75', 'rank' => 'Silver', 'capping' => '1500'],
            '3' => ['direct' => 0, 'days' => '7', 'reward' => '3100', 'team' => '300', 'rank' => 'Gold', 'capping' => '2500'],
            '4' => ['direct' => 0, 'days' => '7', 'reward' => '5100', 'team' => '1000', 'rank' => 'Platinum', 'capping' => '4000'],
            '5' => ['direct' => 0, 'days' => '7', 'reward' => '11000', 'team' => '2500', 'rank' => 'Ruby', 'capping' => '6000'],
            '6' => ['direct' => 0, 'days' => '7', 'reward' => '31000', 'team' => '8000', 'rank' => 'Emrald', 'capping' => '8000'],
            '7' => ['direct' => 0, 'days' => '7', 'reward' => '100000', 'team' => '25000', 'rank' => 'Diamond', 'capping' => '12000'],
            '8' => ['direct' => 0, 'days' => '7', 'reward' => '300000', 'team' => '75000', 'rank' => 'Red Diamond', 'capping' => '25000'],
            '9' => ['direct' => 0, 'days' => '7', 'reward' => '500000', 'team' => '200000', 'rank' => 'Crown Diamond', 'capping' => '35000'],
            '10' => ['direct' => 0, 'days' => '7', 'reward' => '1000000', 'team' => '500000', 'rank' => 'Kohinor', 'capping' => '50000'],

        ];
        foreach ($awardsArr as $key => $award) {
            $users = $this->Main_model->get_records('tbl_users', ['paid_status' => 1], 'user_id');
            foreach ($users as $key2 => $u) {
                $directs = $this->Main_model->get_single_record('tbl_users', ['sponser_id' => $u['user_id'], 'paid_status' => 1], 'count(id) as directs');

                $checkTeam = $this->Main_model->calculate_team($u['user_id'], $key);
                if ($directs['directs'] >= $award['direct']) {
                    if ($checkTeam['team'] >= $award['team']) {
                        $this->Main_model->update('tbl_users', ['user_id' => $u['user_id']], ['capping' => $award['capping']]);
                    }
                }
           
              
            }
        }
    }


    // public function blockFakeRegistration(){
    //     $users = $this->Main_model->get_records('tbl_temp_users',['status' => 0],'id,user_id,utr_number,created_at');
    //     foreach($users as $key => $u){
    //         $date1 = date('Y-m-d H:i:s');
    //         $date2 = date('Y-m-d H:i:s',strtotime($u['created_at'].' + 10 minutes'));
    //         $diff = strtotime($date1) - strtotime($date2);
    //         if($diff > 0){
    //             if(empty($u['utr_number'])){
    //                 $this->Main_model->update('tbl_temp_users',['id' => $u['id'],'user_id' => $u['user_id']],['status' => 2]);
    //             }
    //         }
    //     }
    // }

    // public function roi_level_income($user_id = '', $down_id = ''){
    //   // if(date('D') == 'Sun' || date('D') == 'Sat'){
    //   //     die('its weekend');
    //   // }
    //   //die;
    //     // $cron = $this->Main_model->get_single_record('tbl_cron','  date(created_at) = date(now()) and cron_name = "roi_level_cron"' ,'*');
    //     // if(empty($cron)){
    //     //     $users = $this->Main_model->get_records('tbl_users',['paid_status' => 1],'user_id,sponser_id');
    //     //     foreach($users as $key => $user){
    //     //         $down_id = $user['user_id'];
    //     //         $user_id = $user['sponser_id'];
    //             $incomes = [
    //                 1 => ['income' => 0.02 , 'directs' => 1],
    //                 2 => ['income' => 0.03 , 'directs' => 2],
    //                 3 => ['income' => 0.04 , 'directs' => 3],
    //                 4 => ['income' => 0.03 , 'directs' => 4],
    //                 5 => ['income' => 0.02 , 'directs' => 5],
    //                 6 => ['income' => 0.02 , 'directs' => 6],
    //                 7 => ['income' => 0.01 , 'directs' => 7],

    //             ];
    //             foreach($incomes as $key => $income){
    //                 $user = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,sponser_id,directs');
    //                 if(!empty($user)){
    //                     pr($user);
    //                     if($user['directs'] >= $income['directs']){
    //                         $income = array(
    //                             'user_id' => $user['user_id'],
    //                             'amount' => $income['income'],
    //                             'type' => 'roi_level_income',
    //                             'description' => 'ROI Level income At Level '.$key . ' from '.$down_id,
    //                         );
    //                         $this->Main_model->add('tbl_income_wallet', $income);
    //                     }
    //                     $user_id = $user['sponser_id'];
    //                 }
    //             }
    //         // }
    //     //     $this->Main_model->add('tbl_cron', array('cron_name' => 'roi_level_cron'));
    //     // }else{
    //     //     echo'today cron already run';
    //     // }
    // }

    // public function WithdrawCron(){
    //     $users = $this->Main_model->withdraw_users(500);
    //     pr($users);
    //     foreach($users as $key => $user){
    //         $DirectIncome = array(
    //             'user_id' => $user['user_id'],
    //             'amount' => - $user['total_amount'] ,
    //             'type' => 'withdraw_request',
    //             'description' => 'Withdraw Request',
    //         );
    //         $this->Main_model->add('tbl_income_wallet', $DirectIncome);
    //         $withdrawArr = array(
    //             'user_id' => $user['user_id'],
    //             'amount' => $user['total_amount'] ,
    //             'type' => 'withdraw_request',
    //             'tds' => $user['total_amount']* 5 /100,
    //             'admin_charges' => $user['total_amount']  * 5 /100,
    //             'fund_conversion' => 0,
    //             'payable_amount' => $user['total_amount'] * 90 /100
    //         );
    //         $this->Main_model->add('tbl_withdraw', $withdrawArr);
    //     }
    // }




    // public function credit_salary_income(){
    //     die;
    //     $roi_users = $this->Main_model->get_records('tbl_roi', array('amount >' => 0 , 'type' => 'salary'), '*');
    //     foreach($roi_users as $key => $user){
    //         $this_month_roi = $this->Main_model->get_single_record_desc('tbl_income_wallet', array('type' => 'salary_income' , 'user_id' => $user['user_id'],'month(created_at)' => date('m')), '*');
    //         if(empty($this_month_roi)){

    //             $new_day = $user['days'] - 1;
    //             $incomeArr = array(
    //                 'user_id' => $user['user_id'],
    //                 'amount' => $user['roi_amount'],
    //                 'type' => 'salary_income',
    //                 'description' => 'salary Income at '.$new_day . ' Month',
    //             );
    //             pr($user);
    //             $this->Main_model->add('tbl_income_wallet', $incomeArr);
    //             $this->Main_model->update('tbl_roi', array('id' => $user['id']), array('days' => $new_day, 'amount' => ($user['amount'] - $user['roi_amount'])));
    //         }
    //     }
    // }



    // public function webhook_response(){
    //     header("Access-Control-Allow-Origin: *");
    //     $_POST = json_decode(file_get_contents('php://input'), true);
    //     pr($_POST['event']['type']);
    //    //		$data = $this->input->post();
    //    $this->Main_model->add('tbl_webhook', ['data' => json_encode($_POST),'checkout' => $_POST['event']['data']['checkout']['id']]);
    //    $this->Main_model->update('tbl_coinbase_transactions', ['checkout' => $_POST['event']['data']['checkout']['id']],['status' => $_POST['event']['type'] , 'response' => json_encode($_POST)]);
    // }

    // public function checkCoinBaseUsers(){
    //     $users = $this->Main_model->get_records('tbl_users',['paid_status' => 0],'user_id,sponser_id');
    //     foreach($users as $key => $u){
    //         $coinPayment = $this->Main_model->get_single_record('tbl_coinbase_transactions',['user_id' => $u['user_id'],'status' => 'charge:confirmed'],'*');
    //         if(!empty($coinPayment['user_id'])){
    //             $package = $this->Main_model->get_single_record('tbl_package',['price' => $coinPayment['data']],'*');
    //             $topupData = array(
    //                 'paid_status' => 1,
    //                 'package_id' => $package['id'],
    //                 'package_amount' => $package['price'],
    //                 'topup_date' => date('Y-m-d H:i:s'),
    //                 'capping' => $package['capping']
    //             );
    //             $this->Main_model->update('tbl_users', array('user_id' => $u['user_id']), $topupData);
    //             $roiData = [
    //                 'user_id' => $u['user_id'],
    //                 'amount' => $package['commision'] * $package['days'],
    //                 'days' => $package['days'],
    //                 'roi_amount' => $package['commision'],
    //             ];
    //             $this->Main_model->add('tbl_roi', $roiData);
    //             $this->Main_model->update_directs($u['sponser_id']);
    //             $checkSponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $u['sponser_id']],'paid_status');
    //             if($checkSponser['paid_status'] == 1){
    //                 $DirectIncome = array(
    //                     'user_id' => $u['sponser_id'],
    //                     'amount' => $package['direct_income'],
    //                     'type' => 'direct_income',
    //                     'description' => 'Refferal Points from Activation of Member '.$u['user_id'],
    //                 );
    //                 $this->Main_model->add('tbl_income_wallet', $DirectIncome);
    //             }
    //             $this->update_business($u['user_id'], $u['user_id'], $level = 1, $package['bv'], $type = 'topup');
    //             $this->update_units($u['user_id'] , $u['sponser_id'], $package['commision']);
    //         }
    //     }
    // }

    // private function update_business($user_name, $downline_id, $level = 1, $business, $type = 'topup') {
    //     $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
    //     if (!empty($user)) {
    //         if ($user['position'] == 'L') {
    //             $c = 'leftPower';
    //         } else if ($user['position'] == 'R') {
    //             $c = 'rightPower';
    //         } else {
    //             return;
    //         }
    //         $this->Main_model->update_business($c, $user['upline_id'], $business);
    //         $downlineArray = array(
    //             'user_id' => $user['upline_id'],
    //             'downline_id' => $downline_id,
    //             'position' => $user['position'],
    //             'business' => $business,
    //             'type' => $type,
    //             'created_at' => date('Y-m-d h:i:s'),
    //             'level' => $level,
    //         );
    //         $this->Main_model->add('tbl_downline_business', $downlineArray);
    //         $user_name = $user['upline_id'];

    //         if ($user['upline_id'] != '') {
    //             $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
    //         }
    //     }
    // }

    // private function update_units($user_id , $sponser_id , $units){
    //     $sponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $sponser_id],'user_id, units');
    //     if(!empty($sponser)){
    //         $unitArr=[
    //             'user_id' => $sponser_id,
    //             'down_id' => $user_id,
    //             'units' => $units,
    //         ];
    //         $this->Main_model->add('tbl_user_units', $unitArr);
    //         $this->Main_model->update('tbl_users', array('user_id' => $sponser_id), ['units' => $sponser['units'] + $units]);
    //     }
    // }

    // public function coinPaymentCheck(){
    //     $cmd = 'get_tx_ids';
    //     $public_key = $this->public_key;
    //     $private_key = $this->private_key;
    //     $req['version'] = 1;
    //     $req['cmd'] = $cmd;
    //     $req['key'] = $public_key;
    //     $req['format'] = 'json';
    //     $post_data = http_build_query($req, '', '&');
    //     $hmac = hash_hmac('sha512', $post_data, $private_key);
    //     static $ch = NULL;
    //     if ($ch === NULL) {
    //         $ch = curl_init('https://www.coinpayments.net/api.php');
    //         curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //     }
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //     $data = curl_exec($ch);
    //     pr($data);
    //     $data = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);

    //     foreach($data['result'] as $d){
    //         $b_transaction = $this->Main_model->get_single_record_desc('BTC_TRANSACTION', array('transaction_id' => $d), '*');
    //         if(empty($b_transaction)){
    //             $this->getinfo2('get_tx_info', $d);
    //         }else{
    //             $this->getinfo3('get_tx_info', $d);
    //         }
    //         pr($d);
    //         // $sql = "SELECT transaction_id from BTC_TRANSACTION where transaction_id = '".$d."'";
    //         // $result = $conn->query($sql);
    //         // $i = 1;
    //         // if ($result->num_rows == 0) {
    //         //     getinfo2($conn,'get_tx_info', $d);
    //         // }else{
    //         //     echo $d.' this id already registered <br>';
    //         // }
    //     }
    // }
    // function getinfo2($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
    //     $public_key = $this->public_key;
    //     $private_key = $this->private_key;
    //     $req['version'] = 1;
    //     $req['cmd'] = $cmd;
    //     $req['txid'] = $tax_id;
    //     $req['full'] = TRUE;
    //     $req['key'] = $public_key;
    //     $req['format'] = 'json'; //supported values are json and xml
    //     $post_data = http_build_query($req, '', '&');
    //     $hmac = hash_hmac('sha512', $post_data, $private_key);
    //     static $ch = NULL;
    //     if ($ch === NULL) {
    //         $ch = curl_init('https://www.coinpayments.net/api.php');
    //         curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //     }
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //     $data = curl_exec($ch);
    //     $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
    //     echo'<pre>';
    //     print_r($data2);
    //     echo'</pre>';
    //     $send['transaction_id'] = $tax_id;
    //     $send['created_time'] = $data2['result']['time_created'];
    //     $send['time_expires'] = $data2['result']['time_expires'];
    //     $send['status'] = $data2['result']['status'];
    //     $send['status_text'] = $data2['result']['status_text'];
    //     $send['type'] = $data2['result']['type'];
    //     $send['coin'] = $data2['result']['coin'];
    //     $send['amount'] = $data2['result']['amount'];
    //     $send['amountf'] = $data2['result']['checkout']['amountf'];
    //     $send['received'] = $data2['result']['received'];
    //     $send['receivedf'] = $data2['result']['receivedf'];
    //     $send['recv_confirms'] = $data2['result']['recv_confirms'];
    //     $send['payment_address'] = $data2['result']['payment_address'];
    //     $send['invoice'] = $data2['result']['checkout']['invoice'];
    //     $send['user_id'] = $data2['result']['checkout']['custom'];
    //     $send['first_name'] = $data2['result']['checkout']['first_name'];
    //     $send['last_name'] = $data2['result']['checkout']['last_name'];
    //     $send['package'] = $data2['result']['checkout']['item_name'];
    //     // $columns = implode(", ",array_keys($send));
    //     // // $escaped_values = array_map(array_values($send));
    //     // $values  = '"'.implode('","', array_values($send)).'"';
    //     // print_r(array_values($send));
    //     $this->Main_model->add('BTC_TRANSACTION', $send);
    //     // echo $sql = "INSERT INTO `BTC_TRANSACTION`($columns) VALUES ($values)";
    //     // $conn->query($sql);
    //     if($send['status'] == 100){
    //         $amountArr = array('user_id' => $send['first_name'] ,'amount' => $send['amountf'],'transaction_id' => $send['transaction_id']);
    //         $this->Main_model->add('tbl_payment_request', $amountArr);
    //     //    echo $sql2 = "insert into tbl_payment_request (user_id ,amount,transaction_id ) values('".$send['first_name']."' ,'".$send['amountf']."','".$send['transaction_id']."')";
    //     //     $conn->query($sql2);
    //     }
    // }

    // function getinfo3($cmd = 'get_tx_info', $tax_id ='CPDI1TBAPSGQYM0DBRRDHSMTA0') {
    //     $public_key = $this->public_key;
    //     $private_key = $this->private_key;
    //     $req['version'] = 1;
    //     $req['cmd'] = $cmd;
    //     $req['txid'] = $tax_id;
    //     $req['full'] = TRUE;
    //     $req['key'] = $public_key;
    //     $req['format'] = 'json'; //supported values are json and xml
    //     $post_data = http_build_query($req, '', '&');
    //     $hmac = hash_hmac('sha512', $post_data, $private_key);
    //     static $ch = NULL;
    //     if ($ch === NULL) {
    //         $ch = curl_init('https://www.coinpayments.net/api.php');
    //         curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    //     }
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    //     $data = curl_exec($ch);
    //     $data2 = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
    //     echo'<pre>';
    //     print_r($data2);
    //     echo'</pre>';
    //     //$send['transaction_id'] = $tax_id;
    //     $send['created_time'] = $data2['result']['time_created'];
    //     $send['time_expires'] = $data2['result']['time_expires'];
    //     $send['status'] = $data2['result']['status'];
    //     $send['status_text'] = $data2['result']['status_text'];
    //     $send['type'] = $data2['result']['type'];
    //     $send['coin'] = $data2['result']['coin'];
    //     $send['amount'] = $data2['result']['amount'];
    //     $send['amountf'] = $data2['result']['checkout']['amountf'];
    //     $send['received'] = $data2['result']['received'];
    //     $send['receivedf'] = $data2['result']['receivedf'];
    //     $send['recv_confirms'] = $data2['result']['recv_confirms'];
    //     $send['payment_address'] = $data2['result']['payment_address'];
    //     $send['invoice'] = $data2['result']['checkout']['invoice'];
    //     $send['user_id'] = $data2['result']['checkout']['custom'];
    //     $send['first_name'] = $data2['result']['checkout']['first_name'];
    //     $send['last_name'] = $data2['result']['checkout']['last_name'];
    //     $send['package'] = $data2['result']['checkout']['item_name'];
    //     // $columns = implode(", ",array_keys($send));
    //     // // $escaped_values = array_map(array_values($send));
    //     // $values  = '"'.implode('","', array_values($send)).'"';
    //     // print_r(array_values($send));
    //     $check = $this->Main_model->get_single_record('BTC_TRANSACTION',['transaction_id' => $tax_id],'*');
    //     if($check['status'] != 100){
    //         $this->Main_model->update('BTC_TRANSACTION',['transaction_id' => $tax_id],$send);
    //     }
    // }

    // public function checkCoinPaymentUsers(){
    //     $users = $this->Main_model->get_records('tbl_users',['paid_status' => 0],'user_id,sponser_id');
    //     foreach($users as $key => $u){
    //         $coinPayment = $this->Main_model->get_single_record('BTC_TRANSACTION',['first_name' => $u['user_id'],'status' => '100','status_text' => 'Complete'],'first_name as user_id,package');
    //         if(!empty($coinPayment['user_id'])){
    //             //pr($coinPayment);
    //             $package = $this->Main_model->get_single_record('tbl_package',['title' => $coinPayment['package']],'*');
    //             pr($package);
    //             $topupData = array(
    //                 'paid_status' => 1,
    //                 'package_id' => $package['id'],
    //                 'package_amount' => $package['price'],
    //                 'topup_date' => date('Y-m-d H:i:s'),
    //                 'capping' => $package['capping']
    //             );
    //             $this->Main_model->update('tbl_users', array('user_id' => $u['user_id']), $topupData);
    //             $roiData = [
    //                 'user_id' => $u['user_id'],
    //                 'amount' => $package['commision'] * $package['days'],
    //                 'days' => $package['days'],
    //                 'roi_amount' => $package['commision'],
    //             ];
    //             $this->Main_model->add('tbl_roi', $roiData);
    //             $this->Main_model->update_directs($u['sponser_id']);
    //             $checkSponser = $this->Main_model->get_single_record('tbl_users',['user_id' => $u['sponser_id']],'paid_status');
    //             if($checkSponser['paid_status'] == 1){
    //                 $DirectIncome = array(
    //                     'user_id' => $u['sponser_id'],
    //                     'amount' => $package['direct_income'],
    //                     'type' => 'direct_income',
    //                     'description' => 'Refferal Points from Activation of Member '.$u['user_id'],
    //                 );
    //                 $this->Main_model->add('tbl_income_wallet', $DirectIncome);
    //             }
    //             $this->update_business($u['user_id'], $u['user_id'], $level = 1, $package['bv'], $type = 'topup');
    //             $this->update_units($u['user_id'] , $u['sponser_id'], $package['commision']);
    //         }
    //     }
    // }




    // public function cappingCron()
    // {
    //     $users = $this->Main_model->get_records('tbl_users', ['upgrade_package' => 4999], '*');
    //     foreach ($users as $key => $user) {
    //         $this->Main_model->update('tbl_users', ['user_id' => $user['user_id']], ['paid_status' => 1]);
    //         pr($user);
    //     }
    // }




    // public function level_income_p($value='')
    // {
    //     $users = $this->Main_model->get_records('tbl_users', ['package_amount' => 100, 'upgrade_package' => 0], 'id,user_id');
    //     foreach ($users as $key => $user) {
    //         $query = $this->db->query('SELECT * FROM tbl_income_wallet WHERE type = "level_income" AND description LIKE "%'.$user['user_id'].'%" AND date(created_at) = date(NOW())-6');
    //         $d = $query->row_array();
    //         pr($d);

    //         // $this->Main_model->delete('tbl_income_wallet', $d['id']);
    //     }
    // }


    public function checkTaskTable(){
        $date = date('Y-m-d');
        $this->Main_model->deleteCheck('tbl_holding_wallet',['amount' => 0]);
        $this->Main_model->deleteCheck('tbl_task_counter',['date(created_at) !=' =>$date]);
    }

    // public function updateBalance(){
    //     $users = $this->Main_model->get_records('tbl_income_wallet','user_id !="" group by user_id having blanace > 0', 'sum(amount) as blanace,user_id');
    //    foreach ($users as $key => $value) {
    //         $add = [
    //             'user_id' => $value['user_id'],
    //             'amount' => -$value['blanace'],
    //             'type' => 'withdraw_request',
    //             'description' => 'Deducted for New Plan V2'
    //         ];
    //         pr($add);
    //         $this->Main_model->add('tbl_income_wallet',$add);
    //         $final_amount = $value['blanace'] - ($value['blanace'] * 15 / 100);

    //         $withdrawArr = array(
    //             'user_id' => $value['user_id'],
    //             'amount' => $value['blanace'],
    //             'type' => 'withdraw_request',
    //             'tds' => $value['blanace'] * 5 / 100,
    //             'admin_charges' => $value['blanace'] * 10 / 100,
    //             // 'repurchase_charges' => $withdraw_amount * 10 / 100,
    //             'fund_conversion' => 0,
    //             'payable_amount' => $final_amount,
    //             'remark' => 'Deducted for new plan V2',
    //             'status' =>1
    //             //'credit_type' => $data['credit_type'],
    //         );
    //         pr($withdrawArr);
    //         if($withdrawArr['amount'] > 0){
    //             $this->User_model->add('tbl_withdraw', $withdrawArr);
    //         }
    //    }
       
    // }


    // public function ewalletTransfer()
    // {
    //     $users = $this->Main_model->get_records('tbl_users','id >"2" and  package_id > 0','*');
    //     foreach ( $users as $key => $user) {
    //         // $checKDate = $this->Main_model->get_single_record('tbl_users','user_id="'.$user['user_id'].'" and date(topup_date) < "2023-08-05"','user_id');
    //         // if(!empty($checKDate['user_id'])){
    //             // pr($user);
    //             // $DebitWallet = [
    //             //     'user_id' => $user['user_id'],
    //             //     'amount' => -$user['amount'],
    //             //     // 'sender_id' => $user['user_id'],
    //             //     'type' => 'admin_deduction',
    //             //     'description' => 'Admin deduction',
    //             // ];
    //             // pr($DebitWallet);
    //             $creditWallet = [
    //                 'directs' => 0,
    //                 'package_id' => 0,
    //                 'paid_status' => 0,
    //                 'upgrade_id' =>0,
    //                 'upgrade_package' =>0,
    //                 'capping' =>0,
    //                 'taskStatus' =>0,
    //                 'task_days' =>0,
    //                 'royalty1' =>0,
    //                 'complete_days' =>0,
    //                 'topup_date' =>'0000-00-00 00:00:00',
    //                 'top_up_from' =>'',
    //                 'sponser' =>'',
    //                 'royalty_status' =>'0',
    //                 'task_perform' =>0,
    //                 'rank'=>'',
    //             'package_amount' =>0
    //             ];
    //             pr($creditWallet);
    //             $this->Main_model->update('tbl_users',['user_id'=>$user['user_id']],$creditWallet);
    
    //             // $this->Main_model->add('tbl_income_wallet',$DebitWallet);
    //         // }
          
    //     }
    // }


    public function MoneyCron(){
        $users = $this->Main_model->get_records('tbl_users',['free_status' =>1],'*');
        foreach ($users as $key => $user) {
            if ($user['totalLimit'] > $user['pendingLimit']) {

            }else{
                echo "done";
                $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['free_status' => 0]);
            }
        }


        $usersroi = $this->Main_model->get_records('tbl_roi',[],'*');
        foreach ($usersroi as $key => $use) {
            $checkUsers =  $this->Main_model->get_records('tbl_roi','user_id = "'.$use['user_id'].'" and days = 0 order by id DESC','*');
            if (!empty($checkUsers)) {
                echo $use['user_id'];
                // $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['free_status' => 0]);
            }
        }
    }


   public function CheckDaysCron(){
        $usersroi = $this->Main_model->get_records('tbl_roi',[],'*');
        foreach ($usersroi as $key => $use) {
            $checkUsers =  $this->Main_model->get_single_record('tbl_roi','user_id = "'.$use['user_id'].'" order by id DESC','*');
            if ($checkUsers['days'] ==0 ){
                echo $use['user_id']."<br>";
                 $this->User_model->update('tbl_users', ['user_id' => $use['user_id']], ['free_status' => 0,'paid_status' =>0]);
            }
        }
    }

    public function dinMinusCron(){
        $users = $this->Main_model->get_records('tbl_roi',['days >' => 0],'*');
        foreach ($users as $key => $user) {
            $now = time(); 
            $your_date = strtotime($user['created_at']);
            $datediff = $now - $your_date;
            
            $days =  round($datediff / (60 * 60 * 24));
            $totaldays  = $user['total_days']-$days;
            echo $totaldays;
            $this->Main_model->update('tbl_roi',['id' => $user['id']],['days' => $totaldays]);
            
        }
    }


    

}


