<?php

    defined('BASEPATH') or exit('No direct script allowed');

    class SubAdminArea extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
            $this->load->model(array('Main_model'));
            $this->load->helper(array('admin', 'security'));
            if(is_subadmin() === false){
                redirect('Admin/Management/logoutSA');
                exit;
            }
            // echo $this->router->method;
            // die;
            $access = access($this->router->method);
            if($access === false){
                redirect('Admin/Management/logoutSA');
            }
        }

        public function index(){
            redirect('Admin/SubAdminArea/play_today_task');
            //$this->load->view('dashboard');
        }

        public function play_today_task() {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', ['user_id' => $data['user_id']], '*');
                    if(!empty($user)){
                        if($user['paid_status'] > 0){
                            $today_task = $this->Main_model->get_single_record('tbl_task_counter', "user_id = '".$data['user_id']."' and date(created_at) = date(NOW()) ", 'count(id) as today_task');
                            if($today_task['today_task'] != 1){
                                //$tasks = $this->Main_model->get_records('tbl_task_links', [''], '*');
                                $tasks = $this->Main_model->get_records('tbl_task_links', 'id > "0" LIMIT '.total_task.'', '*');
                                foreach ($tasks as $key => $task) {
                                    $this->complete_task($task['id'], $data['user_id']);
                                }
                                $now_today_task = $this->Main_model->get_single_record('tbl_task_counter', "user_id = '".$data['user_id']."' and date(created_at) = date(NOW()) ", 'count(id) as now_today_task');
                                if($now_today_task['now_today_task'] == total_task){
                                    $status = $this->RedeemMoney($data['user_id']);
                                    if($status['success'] == 1){
                                        $this->session->set_flashdata('message', '<span class="text-success">'.$status['message'].'!</span>');
                                    }else{
                                        $this->session->set_flashdata('message', '<span class="text-danger">'.$status['message'].'!</span>');
                                    }
                                }else{
                                    $this->session->set_flashdata('message', '<span class="text-danger">Please try again later!</span>');
                                }
                            }
                        }else{
                            $this->session->set_flashdata('message', '<span class="text-danger">User Id not Activated!</span>');
                        }
                    }else{
                        $this->session->set_flashdata('message', '<span class="text-danger">Invaild User Id!</span>');
                    }
                }
            }
            $this->load->view('play_task', $response);
        }

        public function complete_task($task_id, $user_id){
            $data['success'] = 0;
            $task = $this->Main_model->get_single_record('tbl_task', "user_id = '".$user_id."' and date(created_at) = date(NOW())", '*');
            // pr($task);
            if(!empty($task)){
                $today_task = $this->Main_model->get_single_record('tbl_task_counter', "user_id = '".$user_id."' and date(created_at) = date(NOW()) ", 'count(id) as ids');

                if($today_task['ids'] < total_task){
                    $TaskCounterIncome = array(
                        'user_id' => $user_id,
                        'task_id' => $task_id,
                    );
                    $this->Main_model->add('tbl_task_counter', $TaskCounterIncome);
                    $this->Main_model->update('tbl_task', array('id' => $task['id']),array('tasks' => $task['tasks']+ 1));
                    $this->Main_model->update('tbl_users',['user_id' => $user_id],['taskStatus' => 1]);
                    // $this->RedeemMoney();

                    $data['success'] = 1;
                    $data['message'] = 'Task Completed Successfully';
                }else{
                    $data['success'] = 0;
                    $data['message'] = "This Task Already Completed";
                }
            }else{
                $StartTask = array(
                    'user_id' => $user_id,
                    'tasks' => 1,
                    'redeem' => 0,
                );
                $this->Main_model->add('tbl_task', $StartTask);
                $TaskCounterIncome = array(
                        'user_id' => $user_id,
                        'task_id' => $task_id,
                    );
                    $this->Main_model->add('tbl_task_counter', $TaskCounterIncome);
                $this->Main_model->update('tbl_users',['user_id' => $user_id],['taskStatus' => 1]);
                // $this->RedeemMoney();
                $data['message'] = 'Task Completed Successfully';
                $data['success'] = 1;
            }
            return $data;
        }

        public function RedeemMoney($user_id){
            $data['success'] = 0;
            $task = $this->Main_model->get_single_record('tbl_task', "user_id = '".$user_id."' and date(created_at) = date(NOW())", '*');
            if(!empty($task)){
                if($task['redeem'] == 0){
                    if($task['tasks'] == total_task){
                        $this->Main_model->update('tbl_task', array('id' => $task['id']),array('redeem' => 1));
                        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                        if($user['upgrade_id'] > 1){
                            $package_id = $user['upgrade_id'];
                        }else{
                            $package_id = $user['package_id'];
                        }
                        $package = $this->Main_model->get_single_record('tbl_package',['id' => $package_id],'*');
                            $data['success'] = 1;
                            $data['message'] = 'Money Redeemed Successfully';
                            $totalIncome = $this->Main_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $user['user_id']], 'ifnull(sum(amount),0) as totalAmount');
                            $TaskIncome = array(
                                'user_id' => $user['user_id'],
                                'amount' =>  $package['commision'],
                                'type' => 'ad_income', 
                                'description' => 'Ad Income',
                            );
                            $this->Main_model->add('tbl_income_wallet', $TaskIncome);
                            $this->Main_model->update('tbl_users',['user_id' => $user['user_id']],['complete_days' => ($user['complete_days']+1)]);

                            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), '*');

                            if ($user['upgrade_package'] > 0) {
                                //$this->task_level_income($sponser['user_id'] , $user['user_id'], $package['level_income'], $package['price']);
                            }
                    }else{
                        $data['message'] = 'Still your tasks are Not Completed';
                        $data['success'] = 0;
                    }
                }else{
                    $data['success'] = 0;
                    $data['message'] = "you have Already Redeem Your Money";
                }
            }else{
                $data['message'] = 'Your tasks Are Not Completed Today';
                $data['success'] = 0;
            }
            return $data;
        }

        public function task_level_income($sponser_id,$activated_id,$level_income, $package_amount){
            // $incomes = array(6,5,4,3,2,1);
            //$incomes = array(4,2,1,1,1,1);
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
            foreach($incomes as $key => $income){
                $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $direct = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $sponser_id,'upgrade_package >' => 100), 'count(id) as direct');
                if(!empty($sponser)){
                    $level = ($key+1);
                    if($sponser['upgrade_package'] > 100 && $direct['direct'] >= $directs[$level] && $sponser['paid_status'] > 0){
                        if($sponser['upgrade_package'] >= $package_amount){
                            $totalIncome = $this->Main_model->get_single_record('tbl_income_wallet', ['amount >' => 0, 'user_id' => $sponser['user_id']], 'ifnull(sum(amount),0) as totalAmount');
    
                            
                                if($level == 1){
                                    $firstDirectCheck = $this->Main_model->get_single_record('tbl_users', 'sponser_id = "'.$sponser['user_id'].'" AND upgrade_package > "0" ORDER by topup_date ASC LIMIT 1', '*');
                                    if($firstDirectCheck['user_id'] != $activated_id){
                                        $LevelIncome = array(
                                            'user_id' => $sponser['user_id'],
                                            'amount' => $income,
                                            'type' => 'level_income', 
                                            'description' => 'Ad Level Income from Member '.$activated_id  . ' At level '.($level),
                                        );
                                        //$this->Main_model->add('tbl_income_wallet', $LevelIncome);
                                    }
                                }else{
                                    $LevelIncome = array(
                                        'user_id' => $sponser['user_id'],
                                        'amount' => $income,
                                        'type' => 'level_income', 
                                        'description' => 'Ad Level Income from Member '.$activated_id  . ' At level '.($level),
                                    );
                                    //$this->Main_model->add('tbl_income_wallet', $LevelIncome);
                                }
                                
                                if($totalIncome['totalAmount'] < $sponser['capping'] && $sponser['upgrade_package'] < 4999 && !empty($LevelIncome)){
                                    $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                                }elseif($sponser['upgrade_package'] >= 4999 && !empty($LevelIncome)){
                                    $this->Main_model->add('tbl_income_wallet', $LevelIncome);
                                }
                        }
                    }
                    $sponser_id = $sponser['sponser_id'];
                }
            }
        }
    }
?>