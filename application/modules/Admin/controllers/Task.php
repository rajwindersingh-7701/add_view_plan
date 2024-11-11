<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        // $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response = array();
            $response['tasks'] = $this->Main_model->get_records('tbl_task_links', array(), '*');
            $response['countTask'] = $this->Main_model->get_single_record('tbl_task_links', array(), 'count(id) as ids');
            $this->load->view('task_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function Create() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                    $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if($tasks['total_links'] <= 15){
                        //pr($_FILES['img']['name']);
                        if(!empty($_FILES['img']['name'])){
                            $config['upload_path'] = './uploads/';
                            $config['allowed_types'] = 'jpg|png|jpeg';
                            $config['name'] = 'task'.time();
                            $this->load->library('upload',$config);
                            if(!$this->upload->do_upload('img')){
                                $error = $this->upload->display_errors();
                                $this->session->set_flashdata('message','<span class="text-danger">'.$error.'</span>');
                            }else{
                                $data2 = array('upload_data' => $this->upload->data());
                                $TaskData = array(
                                'link' => $data2['upload_data']['file_name'],
                                'type' => $data['type'],
                                );
                                $this->Main_model->add('tbl_task_links', $TaskData);
                                $this->session->set_flashdata('message', '<span class="text-success">Task Created Successfully</span>');
                            }
                        }else{
                            $TaskData2 = array(
                                'link' => $data['youtube'],
                                'type' => 'site',
                            );
                            $this->Main_model->add('tbl_task_links', $TaskData2);
                            $this->session->set_flashdata('message', '<span class="text-success">Task Created Successfully</span>');
                        }
                    }else{
                        $this->session->set_flashdata('message', '<span class="text-danger">10 Tasks Already Created</span>');
                    }
                // }
            }
            $this->load->view('create_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Edit($task_id = '') {
        if (is_admin()) {
            $id = trim(addslashes($task_id));
            $response = array();
            $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                    // $tasks = $this->Main_model->get_single_record('tbl_task_links', array(), 'ifnull(count(id),0)  as total_links');
                    if(!empty($response['task'])){
                        //pr($_FILES['img']['name']);
                        if(!empty($_FILES['img']['name'])){
                            $config['upload_path'] = './uploads/';
                            $config['allowed_types'] = 'jpg|png|jpeg';
                            $config['name'] = 'task'.time();
                            $this->load->library('upload',$config);
                            if(!$this->upload->do_upload('img')){
                                $error = $this->upload->display_errors();
                                $this->session->set_flashdata('message','<span class="text-danger">'.$error.'</span>');
                            }else{
                                $data2 = array('upload_data' => $this->upload->data());
                                $TaskData = array(
                                'link' => $data2['upload_data']['file_name'],
                                'type' => $data['type'],
                                );
                                $this->Main_model->update('tbl_task_links', ['id' => $id], $TaskData);
                                $this->session->set_flashdata('message', '<span class="text-success">Task Update Successfully</span>');
                            }
                        }else{
                            $TaskData2 = array(
                                'link' => $data['youtube'],
                                'type' => 'youtube',
                            );
                            $this->Main_model->update('tbl_task_links',['id' => $id], $TaskData2);
                            $this->session->set_flashdata('message', '<span class="text-success">Task Update Successfully</span>');
                        }
                    }else{
                        $this->session->set_flashdata('message', '<span class="text-danger">Task Id not found!</span>');
                    }
                // }
            }
            $this->load->view('edit_task', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function Edit($task_id) {
    //     if (is_admin()) {
    //         $response = array();
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //         //     $data = $this->security->xss_clean($this->input->post());
    //         //     $this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
    //         //     if ($this->form_validation->run() != FALSE) {
    //         //         $updtask =  $updres = $this->Main_model->update('tbl_task_links', array('id' => $task_id), array('link' => $data['link']));
    //         //         if ($updres == true) {
    //         //             $this->session->set_flashdata('message', 'Task Updated Successfully');
    //         //         }else{
    //         //             $this->session->set_flashdata('message', 'Error while Updating Task');
    //         //         }
    //         //     }
    //         // }
    //         $config['upload_path'] = './uploads/';
    //         $config['allowed_types'] = 'jpg|png|jpeg';
    //         $config['name'] = 'task'.time();
    //         $this->load->library('upload',$config);
    //         if(! $this->upload->do_upload('link')){
    //             $error = $this->upload->display_errors();
    //             $this->session->set_flashdata('message','<span class="text-danger">'.$error.'</span>');
    //         }else{
    //             $data = array('upload_data' => $this->upload->data());
    //             $TaskData = array(
    //             'link' => $data['upload_data']['file_name'],
    //             );
    //             $this->Main_model->update('tbl_task_links', array('id' => $task_id), $TaskData);
    //             $this->session->set_flashdata('message', '<span class="text-success">Task Updated Successfully</span>');
    //         }
       
    // // }
    //     }
    //         $response['task'] = $this->Main_model->get_single_record('tbl_task_links', array('id' => $task_id), '*');
    //         $this->load->view('edit_task', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }

    public function deleteTask($id){
        if (is_admin()) {
            $this->Main_model->delete('tbl_task_links',$id);
            redirect('Admin/Task');
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function silverClub(){
    //     if(is_admin()){
    //         $response['header'] = 'Silver Club';
    //         $response['headerMenu'] = '#,User ID,Left Power,Right Power';
    //         $response['users'] = $this->Main_model->get_records('tbl_users',['paid_status >' => 0,'leftPower >=' => '2500','rightPower >=' => '2500'],'user_id,leftPower,rightPower');
    //         $this->load->view('clubReport', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }
    public function silverClub(){
        if(is_admin()){
            $response['header'] = 'Silver Club';
            $response['headerMenu'] = '#,User ID,Left Power,Right Power';
            $get = $this->Main_model->get_records('tbl_users',['directs >=' => 10],'user_id');
            foreach ($get as $key => $value) {
                $left = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if($left['ids'] >= 5){
                    $right = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if($right['ids'] >= 5){
                       $data[] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$value['user_id'].'"','user_id,leftPower,rightPower');
                    }
                }
            }
           if(!empty($data)){
                $response['users'] = $data;
            }
            
           $this->load->view('clubReport', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function GoldClub(){
    //     if(is_admin()){
    //         $response['header'] = 'Gold Club';
    //         $response['headerMenu'] = '#,User ID,Left Power,Right Power';
    //         $response['users'] = $this->Main_model->get_records('tbl_users',['paid_status >' => 0,'leftPower >=' => '5000','rightPower >=' => '5000'],'user_id,leftPower,rightPower');
    //         $this->load->view('clubReport', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }

    public function GoldClub(){
        if(is_admin()){
            $response['header'] = 'Gold Club';
            $response['headerMenu'] = '#,User ID,Left Power,Right Power';
            $get = $this->Main_model->get_records('tbl_users',['directs >=' => 20],'user_id');
            foreach ($get as $key => $value) {
                $left = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "L", 'paid_status >' => 0), 'count(id) as ids');
                if($left['ids'] >= 10){
                    $right = $this->Main_model->get_single_record('tbl_users', array('sponser_id' => $value['user_id'], 'position' => "R", 'paid_status >' => 0), 'count(id) as ids');
                    if($right['ids'] >= 10){
                       $data[] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$value['user_id'].'"','user_id,leftPower,rightPower');
                    }
                }
            }
            if(!empty($data)){
                $response['users'] = $data;
            }
            
           $this->load->view('clubReport', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function rewards(){
        if(is_admin()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('id','ID','trim|required');
                $this->form_validation->set_rules('status','Status','trim|required');
                if($this->form_validation->run() != false){
                    $check = $this->Main_model->get_single_record('tbl_rewards',['id' => $data['id']],'*');
                    if($check['status'] == 0){
                        $res = $this->Main_model->update('tbl_rewards',['id' => $data['id']],['status' => $data['status']]);
                        if($data['status'] == 1){
                            $msg = 'approved';
                            $IncomeData = [
                                'user_id' => $check['user_id'],
                                'amount' => $check['amount'],
                                'type' => 'royalty_income',
                                'description' => 'Reward Income',
                            ];
                            //pr($IncomeData);
                            $this->Main_model->add('tbl_income_wallet',$IncomeData);
                        }else{
                            $msg = 'rejected';
                        }
                        if($res){
                            $this->session->set_flashdata('message','Reward '.$msg.' successfully');
                            redirect('Admin/Task/rewards');
                        }else{
                            $this->session->set_flashdata('message','Network error,Please try later');
                        }
                    }else{
                        $this->session->set_flashdata('message','This reward request is already processed');
                    }
                }
            }
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 0],'*');
            foreach ($response['rewards'] as $key => $value) {
                $response['rewards'][$key]['userInfo'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $value['user_id']],'name');
            }
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function approvedrewards(){
        if(is_admin()){
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 1],'*');
            foreach ($response['rewards'] as $key => $value) {
                $response['rewards'][$key]['userInfo'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $value['user_id']],'name');
            }
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function rejectedrewards(){
        if(is_admin()){
            $response['rewards'] = $this->Main_model->get_records('tbl_rewards',['status' => 2],'*');
            $this->load->view('rewardList',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function PaidCoinTransactions(){
        if(is_admin()){
            $response['header'] = 'Paid Coin Transaction';
            $response['records'] = $this->Main_model->get_records('tbl_coinbase_transactions',['status' => 'charge:confirmed' , 'approve_status' => 0,'trans_type' => '1'],'*');
            foreach($response['records'] as $key => $record){
                $response['records'][$key]['user'] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$record['user_id'].'"','user_id,name,email');
                $response['records'][$key]['package'] = $this->Main_model->get_single_record('tbl_package',['price' => $record['data']],'title,description');
            }
            // pr($response);
            $this->load->view('coin_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function ApprovedTransactions(){
        if(is_admin()){
            $response['header'] = 'Approved Coin Transaction';
            $response['records'] = $this->Main_model->get_records('tbl_coinbase_transactions',['status' => 'charge:confirmed','trans_type' => '1'],'*');
            foreach($response['records'] as $key => $record){
                $response['records'][$key]['user'] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$record['user_id'].'"','user_id,name,email');
                $response['records'][$key]['package'] = $this->Main_model->get_single_record('tbl_package',['price' => $record['data']],'title,description');
            }
            // pr($response);
            $this->load->view('coin_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function PendingTransactions(){
        if(is_admin()){
            $response['header'] = 'Pending Coin Transaction';
            $response['records'] = $this->Main_model->get_records('tbl_coinbase_transactions',['status' => 'charge:pending' , 'approve_status' => 0,'trans_type' => '1'],'*');
            foreach($response['records'] as $key => $record){
                $response['records'][$key]['user'] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$record['user_id'].'"','user_id,name,email');
                $response['records'][$key]['package'] = $this->Main_model->get_single_record('tbl_package',['price' => $record['data']],'title,description');
            }
            // pr($response);
            $this->load->view('coin_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function AllTransactions(){
        if(is_admin()){
            $response['header'] = 'All Coin Transaction';
            $response['records'] = $this->Main_model->get_records('tbl_coinbase_transactions',['status !=' => '' , 'approve_status' => 0,'trans_type' => '1'],'*');
            foreach($response['records'] as $key => $record){
                $response['records'][$key]['user'] = $this->Main_model->get_single_record('tbl_users','user_id = "'.$record['user_id'].'"','user_id,name,email');
                $response['records'][$key]['package'] = $this->Main_model->get_single_record('tbl_package',['price' => $record['data']],'title,description');
            }
            // pr($response);
            $this->load->view('coin_transactions', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function AddUser(){
        if(is_admin()){
        	if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','trim|required');
                $this->form_validation->set_rules('name','Name','trim|required');
                $this->form_validation->set_rules('email','E-Mail','trim|required');
                $this->form_validation->set_rules('password','Password','trim|required');
                $this->form_validation->set_rules('type','Type','trim|required');
                if($this->form_validation->run() != FALSE){
                	$user = $this->Main_model->get_single_record('tbl_admin',['user_id' => $data['user_id']],'name');
                	if(empty($user)){
	                	$userdata = [
	                		'user_id' => $data['user_id'],
	                		'password' => $data['password'],
	                		'role' => $data['type'],
	                		'email' => $data['email'],
	                		'name' => $data['name']
	                	];
	                	$this->Main_model->add('tbl_admin',$userdata);
	                	$this->session->set_flashdata('message','User Created Successfully');
	                }else{
	                	$this->session->set_flashdata('message','User ID Already Exists');
	                }	
                }else{
                	$this->session->set_flashdata('message',validation_errors());
                }
            }    
            $this->load->view('addUser');
        }
    }

    public function Premission(){
        if(is_admin()){
     
            $this->load->view('permission');
        }
    }

    public function ChangePermission($type){
        if(is_admin()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $access = json_encode($data);
                $res = $this->Main_model->update('tbl_admin',['role' => $type],['access' => $access]);
                if($res){
                    $this->session->set_flashdata('message','<h3 style="color:green">Permission Updated successfully</h3>');
                }else{
                    $this->session->set_flashdata('message','<h3 style="color:red">Network error,Please try later</h3>');
                }
            }
            $users = $this->Main_model->get_single_record('tbl_admin',['role' => $type],'access');
            $response['access'] = json_decode($users['access'],true);    
            $response['type'] = $type; 
            $this->load->view('changePermission',$response);
        }
    }

    public function coin_payment_transaction(){
    	if(is_admin()){
    		$response['header'] = 'Coin Payment Transaction';
    		$response['coin_payment'] = $this->Main_model->get_records('BTC_TRANSACTION',[],'*');
    		$this->load->view('coin_payment_transactions',$response);
    	}else{
    		redirect('Admin/Management/login');

    	}
    }

    public function roiUser(){
        if(is_admin()){

            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $export = $this->input->get('export');
            $where = array($field => $value,'days >' => 0);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array('days >' => 0);
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Task/roiUser';
            $config ['uri_segment'] = 4;
            $config['per_page'] = 10;
            $config['attributes'] = array('class' => 'page-link');
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li class="paginate_button page-item ">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="paginate_button page-item  active"><a href="#" class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li class="paginate_button page-item ">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li class="paginate_button page-item">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="paginate_button page-item next">';
            $config['last_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li  class="paginate_button page-item next">';
            $config['next_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['requests'] = $this->Main_model->get_limit_records('tbl_roi', $where, 'user_id,amount,days,created_at', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['header'] = 'ROI Users'; 
            $this->load->view('roi_records',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }




    // Advance play any user task sk

    public function play_today_task() {
        // if (is_admin() || is_subadmin()) {
        //     $access = access($this->route->method());
        //     if($access === false){
        //         redirect('Admin/Management/logout');
        //     }
        if (is_admin()){
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
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function complete_task($task_id, $user_id){
        if (is_admin()) {
            $data['success'] = 0;
            $task = $this->Main_model->get_single_record('tbl_task', "user_id = '".$user_id."' and date(created_at) = date(NOW())", '*');
            // pr($task);
            if(!empty($task)){
                $today_task = $this->Main_model->get_single_record('tbl_task_counter', "user_id = '".$user_id."' and date(created_at) = date(NOW()) ", 'count(id) as ids');

                if($today_task['ids'] < 15){
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
           // echo json_encode($data);
        }else {
            redirect('Admin/Management/login');
        }
    }



    public function RedeemMoney($user_id){
        if (is_admin()) {
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
            //echo json_encode($data);
        } else {
            redirect('Admin/Management/login');
        }
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