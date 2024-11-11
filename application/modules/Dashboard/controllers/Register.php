<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email', 'compose'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        // die('');
        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['countries'] = $this->User_model->get_records('countries', array(), '*');
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // die('this page on updating...');
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[10]|max_length[10]|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('pan', 'PAN Card No.', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('register', $response);
            } else {
                $sponser_id = $data['sponser_id']; //$this->input->post('sponser_id');
                $phone = $data['phone']; //$this->input->post('phone');
                $response['sponser_id'] = $data['sponser_id']; //$sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $email = $this->User_model->get_single_record('tbl_users', array('email' => $data['email']), 'count(id) as email');
                $phone = $this->User_model->get_single_record('tbl_users', array('phone' => $data['phone']), 'count(id) as phone');
                // $pan = $this->User_model->get_single_record('tbl_bank_details', array('pan' => $data['pan']), 'count(id) as pan');
                //$sponser_count = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $sponser_id), 'ifnull(count(id),0) as ids');
                // pr($sponser_count['ids']);
                // die('op');
                $checkIntervel = $this->checkIntervel();
                if ($checkIntervel === true) {
                    if (!empty($sponser)) {
                        // if ($email['email'] == 0) {
                            // if ($phone['phone'] == 0) {
                                // if($pan['pan'] == 0){
                                //if($sponser_count['ids'] < 3){

                                $id_number = $this->getUserIdForRegister();
                                $userData['user_id'] =  $id_number;
                                $userData['sponser_id'] = $sponser_id;
                                $userData['name'] = $data['name']; //$this->input->post('name');
                                $userData['phone'] = $data['phone']; //$this->input->post('phone');
                                $userData['password'] = $data['password']; //$this->input->post('password'); //rand(100000,999999)
                                //$userData['position'] = $this->input->post('position');
                                //$userData['last_left'] = $userData['user_id'];
                                //$userData['last_right'] = $userData['user_id'];
                                // $userData['country_code'] = $this->input->post('country');
                                $userData['email'] = $data['email']; ////$this->input->post('email');
                                // $userData['country'] = $this->input->post('country');
                                $userData['master_key'] = rand(100000, 999999);
                                // if($userData['position'] == 'L'){
                                //     $userData['upline_id'] = $sponser['last_left'];
                                // }else{
                                //     $userData['upline_id'] = $sponser['last_right'];
                                // }
                                $res = $this->User_model->add('tbl_users', $userData);
                                // $res = $this->User_model->add2('tbl_users', $userData);
                                $res = $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
                                // $res = $this->User_model->add2('tbl_bank_details', array('user_id' => $userData['user_id']));
                                if ($res) {
                                    // if ($userData['position'] == 'R') {
                                    //     $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                                    // } elseif ($userData['position'] == 'L') {
                                    //     $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                                    // }
                                    //$this->add_counts($userData['user_id'], $userData['user_id'], 1);
                                    $this->add_sponser_counts($userData['user_id'], $userData['user_id'], $level = 1);
                                    // $this->add_sponser_counts2($userData['user_id'], $userData['user_id'], $level = 1);
                                    $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url() . '';
                                    $email_message = '<div style=\' box-shadow:0px 0px 10px #000; padding:10px;border:1px #f5f5f5 solid; border-radius:6px; margin:10px;  \'> <img style=\'max-width:200px;margin: 0;border-radius: 10px;\' src=' . base_url('uploads/logo.png') . '>' . '<br><p \'font-weight:500;font-size:15px;\'> Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User Name :  ' . $userData['name'] . ' <br>' . 'User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'] . '</p></div>';

                                    composeMail($userData['email'], 'Registration', $email_message, $display = false);

                                    // notify_sms($userData['user_id'], $sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');
                                    //$sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password: ' .$userData['master_key'] .'  '. base_url();
                                    // sendMail($userData['email'],$sms_text,'Registration Alert');
                                    //notify_user($userData['user_id'] , $sms_text);
                                    // send_crypto_email($userData['email'],"Register",$sms_text);

                                    // $sms_text ='Dear '.$userData['name'].' you are successfully registered Your id : '.$userData['user_id'].' and password is '.$userData['password'].' and transaction password is '.$userData['master_key'].' Website: https://growmoney.me omkarent';
     
                                    // notifySms($userData['user_id'], $sms_text,'OMENTO');
                                    $response['message'] = 'Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User ID :' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'];
                                    //$response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
                                    //composeMail($userData['email'],'Registration','Registration',$response['message'],$display=false);
                                    $this->load->view('success', $response);
                                } else {
                                    $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                                    $response['message'] = 'Error while Registraion please try Again';
                                    $this->load->view('register', $response);
                                }
                                // }
                                // else {
                                //     $this->session->set_flashdata('error', 'This PAN Card Number is already exist!');
                                //     $response['message'] = 'This PAN Card Number is already exist!';
                                //     $this->load->view('register', $response);
                                // }
                            // } else {
                            //     $this->session->set_flashdata('error', 'This Phone Number is already exist!');
                            //     $response['message'] = 'This Phone Number is already exist!';
                            //     $this->load->view('register', $response);
                            // }
                        // } else {
                        //     $this->session->set_flashdata('error', 'This email is already exist!');
                        //     $response['message'] = 'This email is already exist!';
                        //     $this->load->view('register', $response);
                        // }
                        // }else{
                        //     $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        //     $this->load->view('register', $response);
                        // }    
                    } else {
                        $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        $this->load->view('register', $response);
                    }
                } else {
                    $this->session->set_flashdata('error', "Please wait 5 Seconds for  registration.");
                    $this->load->view('register', $response);
                }
            }
        } else {
            $this->load->view('register', $response);
        }
    }


    public function index2()
    {
        // die('under maintance');
        $response = array();
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['countries'] = $this->User_model->get_records('countries', array(), '*');
        $response['sponser_id'] = $sponser_id;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // die('this page on updating...');
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[10]|max_length[10]|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('pan', 'PAN Card No.', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('register', $response);
            } else {
                $sponser_id = $data['sponser_id']; //$this->input->post('sponser_id');
                $phone = $data['phone']; //$this->input->post('phone');
                $response['sponser_id'] = $data['sponser_id']; //$sponser_id;
                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
                $email = $this->User_model->get_single_record('tbl_users', array('email' => $data['email']), 'count(id) as email');
                $phone = $this->User_model->get_single_record('tbl_users', array('phone' => $data['phone']), 'count(id) as phone');
                // $pan = $this->User_model->get_single_record('tbl_bank_details', array('pan' => $data['pan']), 'count(id) as pan');
                //$sponser_count = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $sponser_id), 'ifnull(count(id),0) as ids');
                // pr($sponser_count['ids']);
                // die('op');
                $checkIntervel = $this->checkIntervel();
                if ($checkIntervel === true) {
                    if (!empty($sponser)) {
                        if ($email['email'] == 0) {
                            if ($phone['phone'] == 0) {
                                // if($pan['pan'] == 0){
                                //if($sponser_count['ids'] < 3){

                                $id_number = $this->getUserIdForRegister();
                                $userData['user_id'] =  $id_number;
                                $userData['sponser_id'] = $sponser_id;
                                $userData['name'] = $data['name']; //$this->input->post('name');
                                $userData['phone'] = $data['phone']; //$this->input->post('phone');
                                $userData['password'] = $data['password']; //$this->input->post('password'); //rand(100000,999999)
                                //$userData['position'] = $this->input->post('position');
                                //$userData['last_left'] = $userData['user_id'];
                                //$userData['last_right'] = $userData['user_id'];
                                // $userData['country_code'] = $this->input->post('country');
                                $userData['email'] = $data['email']; ////$this->input->post('email');
                                // $userData['country'] = $this->input->post('country');
                                $userData['master_key'] = rand(100000, 999999);
                                // if($userData['position'] == 'L'){
                                //     $userData['upline_id'] = $sponser['last_left'];
                                // }else{
                                //     $userData['upline_id'] = $sponser['last_right'];
                                // }
                                // pr($userData,true);
                                $res = $this->User_model->add('tbl_users', $userData);
                                // $res = $this->User_model->add2('tbl_users', $userData);
                                $res = $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
                                // $res = $this->User_model->add2('tbl_bank_details', array('user_id' => $userData['user_id']));
                                if ($res) {
                                    // if ($userData['position'] == 'R') {
                                    //     $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                                    // } elseif ($userData['position'] == 'L') {
                                    //     $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                                    //     $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                                    // }
                                    // $this->add_counts($userData['user_id'], $userData['user_id'], 1);
                                    // $this->add_sponser_counts($userData['user_id'], $userData['user_id'], $level = 1);
                                    $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url() . '';
                                    // notify_sms($userData['user_id'], $sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');
                                    //$sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password: ' .$userData['master_key'] .'  '. base_url();
                                    // sendMail($userData['email'],$sms_text,'Registration Alert');
                                    //notify_user($userData['user_id'] , $sms_text);
                                    send_crypto_email($userData['email'], "Register", $sms_text);

                                    $response['message'] = 'Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User ID :' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'];
                                    //$response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
                                    //composeMail($userData['email'],'Registration','Registration',$response['message'],$display=false);
                                    $this->load->view('success', $response);
                                } else {
                                    $this->session->set_flashdata('error', 'Error while Registraion please try Again');
                                    $response['message'] = 'Error while Registraion please try Again';
                                    $this->load->view('registertest', $response);
                                }
                                // }
                                // else {
                                //     $this->session->set_flashdata('error', 'This PAN Card Number is already exist!');
                                //     $response['message'] = 'This PAN Card Number is already exist!';
                                //     $this->load->view('register', $response);
                                // }
                            } else {
                                $this->session->set_flashdata('error', 'This Phone Number is already exist!');
                                $response['message'] = 'This Phone Number is already exist!';
                                $this->load->view('registertest', $response);
                            }
                        } else {
                            $this->session->set_flashdata('error', 'This email is already exist!');
                            $response['message'] = 'This email is already exist!';
                            $this->load->view('registertest', $response);
                        }
                        // }else{
                        //     $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        //     $this->load->view('register', $response);
                        // }    
                    } else {
                        $this->session->set_flashdata('error', "Please enter valid Sponsor ID.");
                        $this->load->view('registertest', $response);
                    }
                } else {
                    $this->session->set_flashdata('error', "Please wait 5 Seconds for  registration.");
                    $this->load->view('registertest', $response);
                }
            }
        } else {
            $this->load->view('registertest', $response);
        }
    }

    public function test()
    {

        $userData['name'] = "vish";
        $userData['user_id'] = "vish";

        $userData['password'] = "vish";
        $userData['master_key'] = "vish";
        $userData['eamil'] = "gnivishal@gmail.com";

        $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url() . '';
        send_crypto_email($userData['eamil'], "Register", $sms_text);
        echo "done";
    }


    private function checkIntervel()
    {
        $checkId = $this->User_model->get_single_record('tbl_users', 'user_id != "none" order by id desc limit 1', '*');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s', strtotime($checkId['created_at'] . ' + 5 seconds'));
        $diff = strtotime($date1) - strtotime($date2);
        if ($diff > 0) {
            return true;
        } else {
            return false;
        }
    }
    private function getUserIdForRegister()
    {
        $user_id = idPrefix . '' . rand(100000, 999999);
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,name');
        // $lastID = $this->User_model->get_single_record('tbl_users',"user_id != '' ORDER BY id DESC LIMIT 1",'user_id');

        // $check = substr($lastID['user_id'],8);
        // if($check == 0){
        // $user_id = substr($lastID['user_id'],3) + 20;
        // }else{
        //     $user_id = substr($lastID['user_id'],3) + 1;
        // }
        // return idPrefix.''.$user_id;
        if (!empty($sponser)) {
            return $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }



    public function registerCron()
    {
        redirect('Admin/Management/logout');
        die;
        for ($i = 1; $i <= 18; $i++) {
            $package = $this->User_model->get_single_record('tbl_package', ['id' => 1], '*');
            $sponser_id = 'admin';
            $id_number = $this->getUserIdForRegister();
            if (!empty($id_number)) {
                $userData['user_id'] =  $id_number;
                $userData['sponser_id'] = $sponser_id;
                $userData['name'] = title;
                $userData['phone'] = '';
                $userData['password'] = rand(100000, 999999);
                $userData['master_key'] = rand(100000, 999999);
                $userData['paid_status'] = 1;
                $userData['package_id'] = $package['id'];
                $userData['package_amount'] = $package['price'];
                $userData['topup_date'] = date('Y-m-d H:i:s');
                $res = $this->User_model->add('tbl_users', $userData);
                $res = $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
                if ($res) {
                    $this->add_sponser_counts($userData['user_id'], $userData['user_id'], $level = 1);
                    $userID = $this->User_model->get_single_record('tbl_users', ['user_id' => $userData['user_id']], 'id');
                    $this->User_model->update_directs($userData['sponser_id']);
                    $this->User_model->total_team_update($userID['id']);
                }
            }
            //echo $i;
        }
        redirect('Admin/Management');
    }

    public function index12355()
    {
        $response = array();
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('position', 'Position', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            if ($this->form_validation->run() != false) {
                $checkEmail = $this->User_model->get_single_record('tbl_users', ['email' => $data['email']], 'email');
                $checkPhone = $this->User_model->get_single_record('tbl_users', ['phone' => $data['phone']], 'phone');
                if (empty($checkEmail['email'])) {
                    if (empty($checkPhone['phone'])) {
                        $id_number = $this->getUserIdForRegister();
                        $this->session->set_tempdata("user_id", $id_number, 1200);
                        $this->session->set_tempdata("sponser_id", $data['sponser_id'], 120);
                        $this->session->set_tempdata("name", $data['name'], 120);
                        $this->session->set_tempdata("phone", $data['phone'], 120);
                        $this->session->set_tempdata("password", rand(100000, 999999), 120);
                        $this->session->set_tempdata("master_key", rand(100000, 999999), 120);
                        $this->session->set_tempdata("position", $data['position'], 120);
                        $this->session->set_tempdata("last_left", $id_number, 120);
                        $this->session->set_tempdata("last_right", $id_number, 120);
                        $this->session->set_tempdata("email", $data['email'], 120);
                        $this->session->set_tempdata("country", $data['country'], 120);
                        $this->session->set_tempdata("accountType", $data['accountType'], 120);
                        $this->session->set_tempdata("package_id", $data['package_id'], 120);
                        $this->registers($this->session->tempdata());
                        redirect('Dashboard/Register/unlGateway');
                        exit;
                        //pr($this->session->tempdata());
                        die('here');
                    } else {
                        $this->session->set_flashdata('message', 'This Phone Number already exists,please try another');
                    }
                } else {
                    $this->session->set_flashdata('message', 'This Email Address already exists,please try another');
                }
            } else {
                $this->session->set_flashdata('message', validation_errors());
            }
        }
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['countries'] = $this->User_model->get_records('countries', array(), '*');
        $response['sponser_id'] = $sponser_id;
        $response['package'] = $this->User_model->get_records('tbl_package', array(), '*');
        $this->load->view('register_paid', $response);
    }

    public function coinpayment()
    {
        $response = array();
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $data = $this->security->xss_clean($this->input->post());
            $this->form_validation->set_rules('sponser_id', 'Sponser ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('position', 'Position', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            if ($this->form_validation->run() != false) {
                $checkEmail = $this->User_model->get_single_record('tbl_users', ['email' => $data['email']], 'email');
                $checkPhone = $this->User_model->get_single_record('tbl_users', ['phone' => $data['phone']], 'phone');
                if (empty($checkEmail['email'])) {
                    if (empty($checkPhone['phone'])) {
                        $id_number = $this->getUserIdForRegister();
                        $this->session->set_tempdata("user_id", $id_number, 1200);
                        $this->session->set_tempdata("sponser_id", $data['sponser_id'], 1200);
                        $this->session->set_tempdata("name", $data['name'], 1200);
                        $this->session->set_tempdata("phone", $data['phone'], 1200);
                        $this->session->set_tempdata("password", rand(100000, 999999), 1200);
                        $this->session->set_tempdata("master_key", rand(100000, 999999), 1200);
                        $this->session->set_tempdata("position", $data['position'], 1200);
                        $this->session->set_tempdata("last_left", $id_number, 1200);
                        $this->session->set_tempdata("last_right", $id_number, 1200);
                        $this->session->set_tempdata("email", $data['email'], 1200);
                        $this->session->set_tempdata("country", $data['country'], 1200);
                        $this->register($this->session->tempdata());
                        redirect('Dashboard/Register/coinpaymentform/' . $data['package_id']);
                        exit;
                        die('here');
                    } else {
                        $this->session->set_flashdata('message', 'This Phone Number already exists,please try another');
                    }
                } else {
                    $this->session->set_flashdata('message', 'This Email Address already exists,please try another');
                }
            } else {
                $this->session->set_flashdata('message', validation_errors());
            }
        }
        $sponser_id = $this->input->get('sponser_id');
        if ($sponser_id == '') {
            $sponser_id = '';
        }
        $response['countries'] = $this->User_model->get_records('countries', array(), '*');
        $response['sponser_id'] = $sponser_id;
        $response['package'] = $this->User_model->get_records('tbl_package', array(), '*');
        $this->load->view('register_paid2', $response);
    }

    // public function unlGateway(){
    //     if(!empty($this->session->tempdata())){
    //         $response['package'] = $this->User_model->get_single_record('tbl_package',['id' => $this->session->tempdata('package_id')],'price');
    //         $this->load->view('unlgateway',$response);
    //     }else{
    //         redirect('Dashboard/Register');
    //     }
    // }

    public function unlGateway()
    {
        if (!empty($this->session->tempdata('user_id'))) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('utr', 'UTR Number', 'trim|required');
                if ($this->form_validation->run() != false) {
                    $checkUTR = $this->User_model->get_single_record('tbl_temp_users', ['utr_number' => $data['utr']], 'utr_number');
                    if (empty($checkUTR['utr_number'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config['max_size'] = 2048;
                        $config['file_name'] = 'token_slip' . time();
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $this->session->set_flashdata('message', $this->upload->display_errors());
                        } else {
                            $fileData = array('upload_data' => $this->upload->data());
                            $userData = [
                                'utr_number' => $data['utr'],
                                'image' => $fileData['upload_data']['file_name'],
                            ];
                            $res = $this->User_model->update('tbl_temp_users', ['user_id' => $this->session->tempdata('user_id')], $userData);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Your request submitted successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Network error,Please try later');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('message', 'This UTR Number already exists');
                    }
                }
            }
            $response['package'] = $this->User_model->get_single_record('tbl_package', ['id' => $this->session->tempdata('package_id')], 'price');
            $this->load->view('unlgateway', $response);
        } else {
            redirect('Dashboard/Register');
        }
    }

    public function coinpaymentform($pack)
    {
        $response['package'] = $this->User_model->get_single_record('tbl_package', ['id' => $pack], '*');
        if (!empty($response['package']['price'])) {
            $this->load->view('coinpayment_form', $response);
        } else {
            die('Server error,please try again');
        }
    }

    // public function test(){
    //     echo $this->getUserIdForRegister();
    // }

    public function coinbaseGateway($id)
    {
        if (!empty($this->session->tempdata())) {
            $user_id = $this->session->tempdata('user_id');
            $package = $this->User_model->get_single_record('tbl_package', array('id' => $id), '*');
            $amount = $package['price'];
            $email = $this->session->tempdata('email');
            $curl = curl_init();
            $params = new stdClass();
            $params->name = $user_id;
            $params->description = $package['title'];

            $local_price = new stdClass();
            $local_price->amount = $amount;

            $local_price->currency = 'USD';
            $params->local_price = $local_price;
            $params->pricing_type = 'fixed_price';
            $params->requested_info = ['email'];
            // echo json_encode($params);


            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.commerce.coinbase.com/checkouts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($params),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "X-CC-Api-Key: 45ac6b2e-529d-4d7f-b761-19d1384369d2",
                    "X-CC-Version: 2018-03-22",
                    "Cookie: __cfduid=da062b513a9ad4c1d0c77a2a7d01979841606206538"
                ),
            ));

            $response = json_decode(curl_exec($curl), true);
            $response['package'] = $amount;
            $this->User_model->add('tbl_coinbase_transactions', ['user_id' => $user_id, 'checkout' => $response['data']['id'], 'data' => $amount, 'trans_type' => '1']);
            curl_close($curl);
            $response['amount'] = $amount;
            $this->load->view('addBalanceCoinBase', $response);
        } else {
            redirect('Dashboard/Register');
        }
    }

    private function registers($data)
    {
        $sponser = $this->User_model->get_single_record('tbl_users', ['user_id' => $data['sponser_id']], '*');
        $userData['user_id'] =  $data['user_id'];
        $userData['sponser_id'] = $data['sponser_id'];
        $userData['name'] = $data['name'];
        $userData['phone'] = $data['phone'];
        $userData['password'] = $data['password'];;
        $userData['position'] = $data['position'];;
        $userData['last_left'] = $userData['user_id'];
        $userData['last_right'] = $userData['user_id'];
        $userData['email'] = $data['email'];
        $userData['country'] = $data['country'];
        $userData['master_key'] = $data['master_key'];
        $userData['accountType'] = $data['accountType'];
        $userData['package_id'] = $data['package_id'];
        $this->User_model->add('tbl_temp_users', $userData);
        // if($userData['position'] == 'L'){
        //     $userData['upline_id'] = $sponser['last_left'];
        // }else{
        //     $userData['upline_id'] = $sponser['last_right'];
        // }
        // $res = $this->User_model->add('tbl_users', $userData);
        // $res = $this->User_model->add('tbl_bank_details',array('user_id' => $userData['user_id'] ));
        // if ($res) {
        //     if ($userData['position'] == 'R') {
        //         $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
        //         $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
        //     } elseif ($userData['position'] == 'L') {
        //         $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
        //         $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
        //     }
        //     $this->add_counts($userData['user_id'], $userData['user_id'], 1);
        //     $this->add_sponser_counts($userData['user_id'],$userData['user_id'], $level = 1);
        //     $sms_text = 'Dear ' .$userData['name']. ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' .$userData['master_key'] . base_url();
        //     sendMail($userData['email'],$sms_text,'Registration Alert');
        //     notify_user($userData['user_id'] , $sms_text);
        // }
    }

    public function emptyData()
    {
        $this->User_model->delete('tbl_users', ['id !=' => 1]);
        $this->User_model->delete('tbl_bank_details', ['id !=' => 1]);
        $this->User_model->delete('tbl_downline_business', ['id !=' => '']);
        $this->User_model->delete('tbl_downline_count', ['id !=' => '']);
        $this->User_model->delete('tbl_income_wallet', ['id !=' => '']);
        $this->User_model->delete('tbl_holding_wallet', ['id !=' => '']);
        $this->User_model->delete('tbl_point_matching_income', ['id !=' => '']);
        $this->User_model->delete('tbl_pool', ['id !=' => 1]);
        $this->User_model->delete('tbl_sponser_count', ['id !=' => '']);
        $this->User_model->delete('tbl_user_units', ['id !=' => '']);
        $this->User_model->delete('tbl_wallet', ['id !=' => '']);
        $this->User_model->delete('tbl_roi', ['id !=' => '']);
        $this->User_model->delete('tbl_roi', ['id !=' => '']);
        $this->User_model->delete('tbl_pool2', ['id !=' => '']);
        $this->User_model->delete('tbl_pool3', ['id !=' => '']);
        $this->User_model->delete('tbl_pool4', ['id !=' => '']);
        $this->User_model->delete('tbl_pool5', ['id !=' => '']);
        $this->User_model->delete('tbl_pool6', ['id !=' => '']);
        $this->User_model->delete('tbl_pool7', ['id !=' => '']);
        $this->User_model->update('tbl_users', ['id' => '1'], ['left_node' => '', 'right_node' => '', 'last_left' => 'admin', 'last_right' => 'admin', 'left_count' => 0, 'right_count' => 0, 'leftPower' => 0, 'rightPower' => 0, 'directs' => 0]);
        $this->User_model->update('tbl_pool', ['id' => '1'], ['down_count' => 0, 'team' => 0]);
        echo 'Done';
    }



    private function leftLeg($sponser_id, $user_id)
    {
        $data['user_id'] = $user_id;
        $data['sponser_id'] = $sponser_id;
        $data['name'] = 'ekprayas';
        $data['phone'] = '1234567980';
        $data['password'] = rand(100000, 999999);
        $data['master_key'] = rand(100000, 999999);
        $data['position'] = 'L';
        $data['last_left'] = $user_id;
        $data['last_right'] = $user_id;
        $data['email'] = 'admin@gmail.com';
        $data['country'] = 'india';
        $this->register($data);
    }

    private function rightLeg($sponser_id, $user_id)
    {
        $data['user_id'] = $user_id;
        $data['sponser_id'] = $sponser_id;
        $data['name'] = 'ekprayas';
        $data['phone'] = '1234567980';
        $data['password'] = rand(100000, 999999);
        $data['master_key'] = rand(100000, 999999);
        $data['position'] = 'R';
        $data['last_left'] = $user_id;
        $data['last_right'] = $user_id;
        $data['email'] = 'admin@gmail.com';
        $data['country'] = 'india';
        $this->register($data);
    }

    private function register($data)
    {
        $sponser = $this->User_model->get_single_record('tbl_users', ['user_id' => $data['sponser_id']], '*');
        $userData['user_id'] =  $data['user_id'];
        $userData['sponser_id'] = $data['sponser_id'];
        $userData['name'] = $data['name'];
        $userData['phone'] = $data['phone'];
        $userData['password'] = $data['password'];;
        $userData['position'] = $data['position'];;
        $userData['last_left'] = $userData['user_id'];
        $userData['last_right'] = $userData['user_id'];
        $userData['email'] = $data['email'];
        $userData['country'] = $data['country'];
        $userData['master_key'] = $data['master_key'];
        if ($userData['position'] == 'L') {
            $userData['upline_id'] = $sponser['last_left'];
        } else {
            $userData['upline_id'] = $sponser['last_right'];
        }
        $res = $this->User_model->add('tbl_users', $userData);
        $res = $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
        if ($res) {
            if ($userData['position'] == 'R') {
                $this->User_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
            } elseif ($userData['position'] == 'L') {
                $this->User_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                $this->User_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
            }
            $this->add_counts($userData['user_id'], $userData['user_id'], 1);
            $this->add_sponser_counts($userData['user_id'], $userData['user_id'], $level = 1);
            $sms_text = 'Dear ' . $userData['name'] . ', Your Account Successfully created. User ID :  ' . $userData['user_id'] . ' Password :' . $userData['password'] . ' Transaction Password:' . $userData['master_key'] . base_url();
            echo 'Account Created successfully<br>';
            // sendMail($userData['email'],$sms_text,'Registration Alert');
            // notify_user($userData['user_id'] , $sms_text);
        }
    }

    private function add_counts($user_name, $downline_id, $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->User_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->add_counts($user_name, $downline_id, $level + 1);
            }
        }
    }

    private function add_sponser_counts($user_name, $downline_id, $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '' && $user['sponser_id'] != 'none') {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'created_at' => 'CURRENT_TIMESTAMP',
                'level' => $level,
            );
            $this->User_model->add('tbl_sponser_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_sponser_counts($user_name, $downline_id, $level + 1);
        }
    }


    private function add_sponser_counts2($user_name, $downline_id, $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '' && $user['sponser_id'] != 'none') {
            $downlineArray = array(
                'user_id' => $user['sponser_id'],
                'downline_id' => $downline_id,
                'position' => '',
                'created_at' => 'CURRENT_TIMESTAMP',
                'level' => $level,
            );
            $this->User_model->add2('tbl_sponser_count', $downlineArray);
            $user_name = $user['sponser_id'];
            $this->add_sponser_counts2($user_name, $downline_id, $level + 1);
        }
    }

    private function update_business($user_name, $downline_id, $level = 1, $business = '40', $type = 'topup')
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position,user_id');
        if (!empty($user)) {
            if ($user['position'] == 'L') {
                $c = 'leftPower';
            } else if ($user['position'] == 'R') {
                $c = 'rightPower';
            } else {
                return;
            }
            $this->User_model->update_business($c, $user['upline_id'], $business);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'business' => $business,
                'type' => $type,
                'created_at' => date('Y-m-d h:i:s'),
                'level' => $level,
            );
            $this->User_model->add('tbl_downline_business', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['upline_id'] != '') {
                $this->update_business($user_name, $downline_id, $level + 1, $business, $type);
            }
        }
    }

    private function update_units($user_id, $sponser_id, $units)
    {
        $sponser = $this->User_model->get_single_record('tbl_users', ['user_id' => $sponser_id], 'user_id, units');
        if (!empty($sponser)) {
            $unitArr = [
                'user_id' => $sponser_id,
                'down_id' => $user_id,
                'units' => $units,
            ];
            $this->User_model->add('tbl_user_units', $unitArr);
            $this->User_model->update('tbl_users', array('user_id' => $sponser_id), ['units' => $sponser['units'] + $units]);
        }
    }

    private function level_income($sponser_id, $activated_id, $package_income)
    {
        $incomes = explode(',', $package_income);
        // $incomes = array(70,35,30,25,20,15,10,5,5);
        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status');
            if (!empty($sponser)) {
                if ($sponser['paid_status'] == 1) {
                    $LevelIncome = array(
                        'user_id' => $sponser['user_id'],
                        'amount' => $income,
                        'type' => 'direct_level_income',
                        'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' . ($key + 1),
                    );
                    //  $this->User_model->add('tbl_income_wallet', $LevelIncome);
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }
    public function email()
    {
        $userData['name'] = "vishal";
        $userData['user_id'] = "1234";
        $userData['password'] = "1234";
        $userData['master_key'] = "1234";
        $userData['email'] = "gnivishal@gmail.com";
        $response['message'] = 'Dear ' . $userData['name'] . ', Your Account Successfully created. <br>User ID :' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' . $userData['master_key'];
        //$response['message'] = 'Dear ' .$userData['name']. ', Your Account Successfully created. <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'] . ' <br> Transaction Password:' .$userData['master_key'];
        composeMail($userData['email'], 'Registration', 'Registration', $response['message'], $display = false);
    }

    public function newdbConnetion()
    {
        // $servername = "localhost";
        // $username = "gmtcoina_adasd";
        // $password = "m1mQ@KsLi2Pdw";

        // // Create connection
        // $conn = new mysqli($servername, $username, $password);

        // // Check connection
        // if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        // }
        // echo "Connected successfully";
        $dsn1 = 'mysql://gmtcoina_adasd:m1mQ@KsLi2Pdw@45.79.200.235/db1';
        $check = $this->db1 = $this->load->database($dsn1, true);
        echo $check;
    }
}
