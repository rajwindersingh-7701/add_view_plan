<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fund extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function Request_fund()
    {
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['qrcode'] = $this->User_model->get_single_record('tbl_qr_code', array('id' => 1), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = 'payment_slip'.time();
                $config['max_size'] = 1000; //kb size
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $this->session->set_flashdata('message', $this->upload->display_errors());
                } else {

                    $fileData = array('upload_data' => $this->upload->data());
                    if ($data['amount'] >= 500) {
                        $tnx = $this->User_model->get_single_record('tbl_payment_request', array('transaction_id' => $data['transaction_id']), '*');
                        if (empty($tnx)) {
                            $reqArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                                'payment_method' => $data['payment_method'],
                                'transaction_id' => $data['transaction_id'],
                                'remarks' => $data['remarks'],
                                'image' => $fileData['upload_data']['file_name'],
                                'status' => 0,
                            );
                            $res = $this->User_model->add('tbl_payment_request', $reqArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Payment Request Submitted Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Submitting Payment Request Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'This UTR No. Alerady Exists!');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum fund amount Rs.500');
                    }
                }
            }
            $this->load->view('header', $response);
            $this->load->view('Fund/request_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function requests()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_payment_request', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('requests', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function gmtHistory()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_gmt_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('gmt_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'fund_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_history', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function wallet_ledger()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function income_ledger()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records_desc('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'income_transfer'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'income_transfer'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function activation_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'account_activation'), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'account_activation'), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('wallet_ledger', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function upgradeactivation_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->get_records('tbl_wallet', array('remark' => 'Account upgradation deduction for ' . $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('remark' => 'Account upgradation deduction for ' . $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header');
            $this->load->view('upgradeactivation_history', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function transfer_fund()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required');

                if ($this->form_validation->run() != FALSE) {
                    if ($data['amount'] >= 500) {
                        // pr($_SESSION,1);
                        $response['directs'] = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'paid_status' => 1), 'count(id) as ids');

                        if ($data['user_id'] != $this->session->userdata['user_id']) {
                            $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                            $dowlinereceiver = $this->User_model->get_single_record('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'],'downline_id'=>$data['user_id']), '*');
                            $uplinecheck = $this->add_sponser_counts($data['user_id'],$this->session->userdata['user_id']);
                            if ($response['directs']['ids'] >= 2 || $this->session->userdata['user_id']=='admin') {

                                if (!empty($receiver)) {
                                if (!empty($dowlinereceiver) || $uplinecheck == true) {

                                    if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                        $master_key = $this->input->post('master_key');
                                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                                    if ($user['master_key'] == $master_key) {

                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -abs($data['amount']),
                                            'sender_id' => $data['user_id'],
                                            'type' => 'fund_transfer',
                                            'remark' => $data['remark'],
                                        );
                                        $res = $this->User_model->add('tbl_wallet', $senderData);
                                        if ($res) {
                                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                            $receiverData = array(
                                                'user_id' => $data['user_id'],
                                                'amount' => abs($data['amount']),
                                                'sender_id' => $this->session->userdata['user_id'],
                                                'type' => 'fund_transfer',
                                                'remark' => $data['remark'],
                                            );
                                            $this->User_model->add('tbl_wallet', $receiverData);
                                        } else {
                                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Invalid Master Key');
                                    }
                                    } else {
                                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Receiver Id is not your upline or downline');
                                }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Receiver Id');
                                }
                            } else {
                                $this->session->set_flashdata('message', '2 directs required for withdraw!');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimun Transfer Amount is Rs 500');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function add_sponser_counts($upline_id, $downline_id)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $downline_id), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '' && $user['sponser_id']  != 'none') {
            if($upline_id == $user['sponser_id']){
                return $upline_id;
                exit;
            }
            $downline_id = $user['sponser_id'];
            return $this->add_sponser_counts($upline_id, $downline_id);
        }
    }
    // transfer to gmt wallet //
    public function transferToGmtWallet()
    {

        die;
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'required|trim');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required');

                if ($this->form_validation->run() != FALSE) {
                    if($data['walletType'] == 1){
                        $table = 'tbl_wallet';
                    }elseif($data['walletType'] == 2){
                        $table = 'tbl_income_wallet';
                        
                    }else{
                        redirect('Dashboard/User/logout');
                    }
                    $response['wallet_amount'] = $this->User_model->get_single_record($table, array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
                    // $walletBalance = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
                    if ($data['amount'] >= 1) {
                        if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                            $master_key = $this->input->post('master_key');
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                            if ($user['master_key'] == $master_key) {

                                if($data['walletType'] == 1){
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -abs($data['amount']),
                                        // 'sender_id' => $data['user_id'],
                                        'type' => 'gmt_transfer',
                                        'remark' => 'GMT Transfer',
                                    );
                                    $type = 'fund_transfer';
                                    $des = 'Fund Transfer';
                                }elseif($data['walletType'] == 2){
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -abs($data['amount']),
                                        // 'sender_id' => $data['user_id'],
                                        'type' => 'gmt_transfer',
                                        'description' => 'GMT Transfer',
                                    );
                                    $type = 'income_transfer';
                                    $des = 'Income Transfer';
                                }
                              
                                $res = $this->User_model->add($table, $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'GMT Transferred Successfully');
                                    $senderData = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => ($data['amount']),
                                        // 'sender_id' => $this->session->userdata['user_id'],
                                        'type' => $type,
                                        'description' => $des,
                                    );
                                    $res = $this->User_model->add('tbl_gmt_wallet', $senderData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                            $this->session->set_flashdata('message', 'Invalid Master Key');
                        }
                        } else {
                            $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimun Transfer Amount is Rs 1');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $response['income_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_amount', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    // transfer to gmt wallet end//


    public function incometoe_wallet()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $directs = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'paid_status' => 1), 'count(id) as ids');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data['user_id'] = $this->session->userdata['user_id'];
                // $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
                $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required');

                if ($this->form_validation->run() != FALSE) {
                    if ($directs['ids'] >= 2 || $this->session->userdata['user_id'] =='admin') {

                        if ($data['amount'] >= 500) {
                            // pr($_SESSION,1);
                            if ($data['user_id'] == $this->session->userdata['user_id']) {
                                $master_key = $this->input->post('master_key');
                                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');

                                $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');

                                if (!empty($receiver)) {
                                    
                                    if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                    if ($user['master_key'] == $master_key) {

                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -abs($data['amount']),
                                            // 'sender_id' => $this->session->userdata['user_id'],
                                            'type' => 'income_transfer',
                                            'description' => 'Income Tranfer',
                                        );
                                        $res = $this->User_model->add('tbl_income_wallet', $senderData);
                                        if ($res) {
                                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                           $final_amount = $data['amount']*0.9;//abs($data['amount'] - ($data['amount'] * 8 / 100));
                                            $receiverData = array(
                                                'user_id' => $data['user_id'],
                                                'amount' => $final_amount,
                                                // 'sender_id' => $this->session->userdata['user_id'],
                                                'type' => 'income_transfer',
                                                'remark' => 'Income Transfer',

                                            );
                                            $this->User_model->add('tbl_wallet', $receiverData);
                                            // $senderDataGMT = array(
                                            //     'user_id' => $this->session->userdata['user_id'],
                                            //     'amount' => $final_amount*0.30,
                                            //     // 'sender_id' => $this->session->userdata['user_id'],
                                            //     'type' => 'income_transfer',
                                            //     'description' => 'Income Tranfer',
                                            // );
                                            // $res = $this->User_model->add('tbl_gmt_wallet', $senderDataGMT);
                                        } else {
                                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Invalid Master Key');
                                    }
                                    } else {
                                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Receiver Id');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Minimun Transfer Amount is Rs 500');
                        }
                    } else {
                        $this->session->set_flashdata('message', '2 directs required for Income Transfer!');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_income', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    // growmoney to gmt transfer//
    public function growtogmt()
    {

        die;
        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_gmt_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $directs = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'paid_status' => 1), 'count(id) as ids');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $data['user_id'] = $this->session->userdata['user_id'];
                // $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
                $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required');

                if ($this->form_validation->run() != FALSE) {
                    // if ($directs['ids'] >= 2 || $this->session->userdata['user_id'] =='admin') {

                        if ($data['amount'] >= 1) {
                            // pr($_SESSION,1);
                            if ($data['user_id'] == $this->session->userdata['user_id']) {
                                $master_key = $this->input->post('master_key');
                                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');

                                $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');

                                if (!empty($receiver)) {
                                    
                                    if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                    if ($user['master_key'] == $master_key) {

                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -abs($data['amount']),
                                            // 'sender_id' => $this->session->userdata['user_id'],
                                            'type' => 'gmt_transfer',
                                            'description' => 'GMT Transfer',
                                        );
                                        $res = $this->User_model->add('tbl_gmt_wallet', $senderData);
                                        if ($res) {
                                            $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                           $final_amount =($data['amount']/90);
                                            $receiverData = array(
                                                'user_id' => $data['user_id'],
                                                'amount' => $final_amount,
                                                // 'sender_id' => $this->session->userdata['user_id'],
                                                'type' => 'growmoney_transfer',
                                                'remark' => 'Grow Money Transfer',
                                            );
                                            $this->User_model->add2('tbl_growmoney_wallet', $receiverData);
                                           
                                        } else {
                                            $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Invalid Master Key');
                                    }
                                    } else {
                                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Receiver Id');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Self Transfer only');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Minimun Transfer Amount is Rs 1');
                        }
                    // } else {
                    //     $this->session->set_flashdata('message', '2 directs required for Income Transfer!');
                    // }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_gmt_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_income', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    // growmoney to gmt transfer end //



    public function transfer_coin()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $response['wallet_amount'] = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
                if ($this->form_validation->run() != FALSE) {
                    //pr($response['wallet_amount'],1);
                    if ($data['amount'] > 0) {
                        // pr($_SESSION,1);
                        if (!empty($data['user_id'])) {
                            // $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                            // if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://skydeepcoin.live/User/transfer_callback.php',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                    CURLOPT_POSTFIELDS => array('userid' => $data['user_id'], 'amount' => $data['amount']),
                                ));

                                $response = curl_exec($curl);

                                curl_close($curl);

                                $result = json_decode($response, true);
                                if ($result['status'] == 'Success' && !empty($result)) {


                                    $saveResponse = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => abs($data['amount']),
                                        'to_user_id' => $data['user_id'],
                                        'status' => $result['status'],
                                        'message' => $result['message'],
                                    );
                                    $res = $this->User_model->add('tbl_coin_api_response', $saveResponse);

                                    if ($res) {
                                        $senderData = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -abs($data['amount']),
                                            'sender_id' => $data['user_id'],
                                            'type' => 'user_coin_transfer',
                                            'description' => $data['remark'],
                                        );
                                        $res = $this->User_model->add('tbl_coin_wallet', $senderData);
                                        if ($res) {
                                            // $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                            $this->session->set_flashdata('message', '<div class="alert alert-success">Coin Transferred Successfully!</div>');
                                            // $receiverData = array(
                                            //     'user_id' => $data['user_id'],
                                            //     'amount' => abs($data['amount']),
                                            //     'sender_id' => $this->session->userdata['user_id'],
                                            //     'type' => 'fund_transfer',
                                            //     'remark' => $data['remark'],
                                            // );
                                            // $this->User_model->add('tbl_wallet', $receiverData);
                                        } else {
                                            $this->session->set_flashdata('message', '<div class="alert alert-info">Error While Transferring Fund Please Try Again!</div>');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', '<div class="alert alert-info">Something went wrong, please try again later!</div>');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', '<div class="alert alert-info">' . $result['message'] . '!</div>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<div class="alert alert-info">Maximum Transfer Coin is ' . $response['wallet_amount']['wallet_amount'] . '!</div>');
                            }
                            // } else {
                            //     $this->session->set_flashdata('message', '<div class="alert alert-info">Invalid Receiver Id!</div>');
                            // }
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-info">You Cannot Transfer Coin In Another User Account!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-info">Minimun Transfer Coin is 0!</div>');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-info">' . validation_errors() . '!</div>');
                }
            }
            // $response['wallet_amount'] = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            // $response['wallet_amount'] = $this->User_model->get_single_record('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_coin', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function coinTransactions()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_coin_api_response', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('coinTransaction', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function user_to_user_coin_transfer()
    {
        if (is_logged_in()) {
            $response = array();
            $response['requests'] = $this->User_model->get_records('tbl_coin_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'coin_transfer'), '*');
            $this->load->view('user_to_user_coin_transfer.php', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function shopping_wallet_transfer()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_shopping_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function token_wallet_transfer()
    {

        if (is_logged_in()) {
            $response = array();
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($data['user_id'] != $this->session->userdata['user_id']) {
                        $receiver = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                        if (!empty($receiver)) {
                            if ($response['wallet_amount']['wallet_amount'] >= $data['amount']) {
                                $senderData = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$data['amount'],
                                    'sender_id' => $data['user_id'],
                                    'type' => 'fund_transfer',
                                    'remark' => $data['remark'],
                                );
                                $res = $this->User_model->add('tbl_wallet', $senderData);
                                if ($res) {
                                    $response['wallet_amount']['wallet_amount'] = $response['wallet_amount']['wallet_amount'] - $data['amount'];
                                    $this->session->set_flashdata('message', 'Fund Transferred Successfully');
                                    $receiverData = array(
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'sender_id' => $this->session->userdata['user_id'],
                                        'type' => 'fund_transfer',
                                        'remark' => $data['remark'],
                                    );
                                    $this->User_model->add('tbl_token_wallet', $receiverData);
                                } else {
                                    $this->session->set_flashdata('message', 'Error While Transferring Fund Please Try Again ...');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Maximum Transfer Amount is ' . $response['wallet_amount']['wallet_amount']);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Receiver Id');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You Cannot Transfer Amount In Same Account');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Transfer Amount is rs 0');
                }
            }
            $response['wallet_amount'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_amount');
            $this->load->view('header', $response);
            $this->load->view('Fund/transfer_fund', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function all_transactions()
    {
        if (is_logged_in()) {
            $response = array();
            $response['transactions'] = $this->User_model->get_records('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,amount,type,description,created_at');
            $this->load->view('all_transactions', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_request()
    {
        if (is_logged_in()) {
            $response = array();
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
            //            pr($response,true);
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($data['amount'] > 0) {
                    if ($response['balance']['total_income'] >= $data['amount']) {
                        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'otp');
                        if ($user['otp'] == $data['otp']) {

                            $incomeArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'withdraw_amount',
                                'description' => 'WIthdraw Amount',
                            );
                            $withdrawArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                            );
                            $res = $this->User_model->add('tbl_income_wallet', $incomeArr);
                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                            if ($res) {
                                $this->session->set_flashdata('message', 'Withdraw Request Submitted Successfully');
                                $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as total_income');
                            } else {
                                $this->session->set_flashdata('message', 'Error While Requesting Withdraw Please Try Again ...');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid Otp');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Maximum Transfer Amount is $' . $response['balance']['total_income']);
                    }
                } else {
                    $this->session->set_flashdata('message', 'Minimun Withdraw Amount is $0');
                }
            }
            $this->load->view('withdraw_request', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function withdraw_summary()
    {
        if (is_logged_in()) {
            $response = array();
            $response['withdraw_transctions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as sum');
            //            $this->load->view('header', $response);
            $this->load->view('withdraw_summary', $response);
            //            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function levelReport()
    {
        if (is_logged_in()) {
            $response = array();

            $response['level'] = $this->User_model->levelReport(array('user_id' => $this->session->userdata['user_id']));

            $this->load->view('header');
            $this->load->view('levelReport', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function levelWise($level)
    {
        if (is_logged_in()) {
            $response = array();
            $response['levelName'] = $level;

            $response['level'] = $this->User_model->get_records('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'], 'level' => $level), '*');
            foreach ($response['level'] as $key => $value) {
                $response['level'][$key]['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $value['downline_id']), '*');
                $response['level'][$key]['task'] = $this->User_model->get_single_record('tbl_task', 'user_id = "' . $value['downline_id'] . '" and date(created_at) = date(NOW()) and redeem = "1"', '*');
            }
            $this->load->view('header');
            $this->load->view('levelWise', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transferCoin()
    {
        if (is_logged_in()) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric');
                if ($this->form_validation->run() === true) {
                    if ($this->session->userdata['user_id'] != $data['user_id']) {
                        $checkUser = $this->User_model->get_single_record('tbl_users', ['user_id' => $data['user_id']], '*');
                        if (!empty($checkUser)) {
                            $balance = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
                            if ($balance['balance'] >= $data['amount']) {
                                if ($data['amount'] > 0) {
                                    $debit = [
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$data['amount'],
                                        'type' => 'coin_transfer',
                                        'description' => 'Coin Transfer to ' . $data['user_id'],
                                    ];
                                    $this->User_model->add('tbl_coin_wallet', $debit);
                                    $credit = [
                                        'user_id' => $data['user_id'],
                                        'amount' => $data['amount'],
                                        'type' => 'coin_transfer',
                                        'description' => 'Coin Received from ' . $this->session->userdata['user_id'],
                                    ];
                                    $this->User_model->add('tbl_coin_wallet', $credit);
                                    $this->session->set_flashdata('message', 'Coin Transferred successfully');
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Amount');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Insufficient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'You cannot transfer to self');
                    }
                }
            }
            $response['header'] = 'Transfer Coin';
            $response['balance'] = $this->User_model->get_single_record('tbl_coin_wallet', ['user_id' => $this->session->userdata['user_id']], 'ifnull(sum(amount),0) as balance');
            $this->load->view('coin-transfer', $response);
        } else {
            redirect('Dashboard/User/logoutf');
        }
    }

    public function reward()
    {
        if (is_logged_in()) {
            $response['header'] = 'Reward List';
            $this->load->view('header');
            $this->load->view('rewardReport', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }
}
