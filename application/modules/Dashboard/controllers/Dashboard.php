<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email','compose'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        if (is_logged_in()) {
            redirect('Dashboard/User/');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function coupans()
    {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('coupons-amazing', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function fix_deposit()
    {
        if (is_logged_in()) {
            $response = array();
            $response['deposits'] = $this->User_model->get_records('tbl_fix_deposit', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('fix_deposit_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    /*     * Token Wallet Activation */

    // public function ActivateAccount() {
    //     if (is_logged_in()) {
    //         $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
    //             if ($this->form_validation->run() != FALSE) {
    //                 $user_id = $data['user_id'];
    //                 $topup_amount = $data['amount'];
    //                 $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //                 $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //                 $fund_available_status = 0;
    //                 if(!empty($data['token_wallet'])){
    //                     $token_wallet = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as token_balance');
    //                     if($wallet['wallet_balance'] >= ($data['amount']*75/100)){
    //                         if( $token_wallet['token_balance'] >= ($data['amount']*25/100)){
    //                             $fund_available_status = 1;
    //                             $fund_deduction = $data['amount']*75/100;
    //                             $this->session->set_flashdata('message', 'Activate with 75%25% fund');
    //                         }else{
    //                             $this->session->set_flashdata('message', 'Insufficient Balance in Token Wallet');
    //                         }
    //                     }else{
    //                         $this->session->set_flashdata('message', 'Insufficient Balance in Wallet');
    //                     }
    //                 }else{
    //                     if($wallet['wallet_balance'] >= $data['amount']){
    //                         $fund_available_status = 1;
    //                         $fund_deduction = $data['amount'];
    //                         $this->session->set_flashdata('message', 'Activate with 100% fund');
    //                     }else{
    //                         $this->session->set_flashdata('message', 'Insufficient Balance in Wallet');
    //                     }
    //                 }
    //                 if (!empty($user)) {
    //                     if ($fund_available_status == 1) {
    //                         if ($user['paid_status'] == 0) {
    //                             $sendWallet = array(
    //                                 'user_id' => $this->session->userdata['user_id'],
    //                                 'amount' => - $fund_deduction,
    //                                 'type' => 'account_activation',
    //                                 'remark' => 'Account Activation Deduction for ' . $user_id,
    //                             );
    //                             $this->User_model->add('tbl_wallet', $sendWallet);
    //                             $topupData = array(
    //                                 'paid_status' => 1,
    //                                 'package_amount' => $data['amount'],
    //                                 'topup_date' => date('Y-m-d h:i:s'),
    //                                 // 'package_id' => $data['package_id'],
    //                                 // 'capping' => $package['capping'],
    //                             );
    //                             if(!empty($data['token_wallet'])){
    //                                 $sendWallet = array(
    //                                     'user_id' => $this->session->userdata['user_id'],
    //                                     'amount' => - $data['amount'] * 25 /100,
    //                                     'type' => 'account_activation',
    //                                     'remark' => 'Account Activation Deduction for ' . $user_id,
    //                                 );
    //                                 $this->User_model->add('tbl_token_wallet', $sendWallet);
    //                             }
    //                             $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
    //                             $this->User_model->update_directs($user['sponser_id']);
    //                             $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
    //                             $DirectIncome = array(
    //                                 'user_id' => $user['sponser_id'],
    //                                 'amount' => $data['amount'] * 5 / 100,
    //                                 'type' => 'direct_income',
    //                                 'description' => 'Direct Income from Activation of Member ' . $user_id,
    //                             );
    //                             $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //                             $this->update_business($user['user_id'], $user['user_id'], $level = 1, $data['amount'], $type = 'topup');
    //                             // $roiArr = array(
    //                             //     'user_id' => $user['user_id'],
    //                             //     'amount' => ($package['price'] * 2),
    //                             //     'roi_amount' => $package['commision'],
    //                             // );
    //                             // $this->User_model->add('tbl_roi', $roiArr);
    //                             $this->session->set_flashdata('message', 'Account Activated Successfully');
    //                         } else {
    //                             $this->session->set_flashdata('message', 'This Account Already Acitvated');
    //                         }
    //                     } else {
    //                         // $this->session->set_flashdata('message', 'Insuffcient Balance');
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('message', 'Invalid User ID');
    //                 }
    //             }
    //         }
    //         $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //         $response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
    //         $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
    //         $this->load->view('activate_account', $response);
    //     } else {
    //         redirect('Dashboard/User/login');
    //     }
    // }
    public function bank_transfer_summary()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Bank Transfer Summary';
            $response['transactions'] = $this->User_model->get_records('tbl_money_transfer', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('bank_transfer_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function unl($id)
    {
        $user_id = $this->session->tempdata('activationID');
        $package = $this->User_model->get_single_record('tbl_package', array('id' => $id), '*');
        $topupData = array(
            'user_id' => $user_id,
            'package_id' => $package['id'],
            'package_amount' => $package['price'],
            'topup_date' => date('Y-m-d H:i:s'),
            'capping' => $package['capping'],
            'account_type' =>  $this->session->tempdata('account_type'),
        );
        $this->User_model->add('tbl_topup_request', $topupData);
    }

    public function coinbaseGateway($id)
    {
        if (!empty($this->session->tempdata('activationID'))) {
            $user_id = $this->session->tempdata('activationID');
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
            $this->User_model->add('tbl_coinbase_transactions', ['user_id' => $user_id, 'checkout' => $response['data']['id'], 'data' => $amount, 'trans_type' => '1', 'account_type' => $this->session->tempdata('account_type')]);
            curl_close($curl);
            $response['amount'] = $amount;
            $this->session->unset_tempdata('activationID');
            $this->load->view('addBalanceCoinBase', $response);
        } else {
            redirect('Dashboard/ActivateAccount');
        }
    }

    public function ActivateAccount()
    {
        if (is_logged_in()) {

            
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // die('we are working on it...');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('otp', 'otp', 'trim|required|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //if(!empty($this->session->tempdata('otp'))){
                    //if($data['otp'] == $this->session->tempdata('otp')){
                    $user_id = $data['user_id'];
                    $checkCrossTeam = $this->User_model->get_single_record('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'],'downline_id' => $user_id), '*');

                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id'], 'price >' => 100), '*');
                    $uplinecheck = $this->checkUpline($user_id,$this->session->userdata['user_id']);

                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if(!empty($checkCrossTeam) || $user_id == $this->session->userdata['user_id'] || $uplinecheck == true){
                            if ($wallet['wallet_balance'] >= $package['price']) {
                                if ($user['package_amount'] == 0) {
                                    $sendWallet = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$package['price'],
                                        'type' => 'account_activation',
                                        'remark' => 'Account Activation Deduction for ' . $user_id,
                                    );
                                    $this->User_model->add('tbl_wallet', $sendWallet);

                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => $data['package_id'],
                                        'package_amount' => $package['price'],
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        'capping' => $package['capping']
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);


                                    // $roiData = [
                                    //     'user_id' => $user['user_id'],
                                    //     'amount' => $package['commision'] * $package['days'],
                                    //     'days' => $package['days'],
                                    //     'roi_amount' => $package['commision'],
                                    // ];
                                    // $this->User_model->add('tbl_roi', $roiData);
                                    $this->User_model->update_directs($user['sponser_id']);
                                    //$this->User_model->total_team_update($user['id']);
                                    $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs,user_id');
                                    //$position_directs = $this->User_model->count_position_directs($user['sponser_id']);
                                    //if(!empty($position_directs) && count($position_directs) == 2){
                                    if ($sponser['paid_status'] == 1) {
                                        // $roiData = [
                                        //     'user_id' => $user['sponser_id'],
                                        //     'amount' => 40*100,
                                        //     'days' => 100,
                                        //     'roi_amount' => 40,
                                        //     'type' => 'direct_income',
                                        //     'description'=> 'Refferal Points from Activation of Member ' . $user_id,
                                        // ];
                                        // $this->User_model->add('tbl_roi', $roiData);
                                        // $DirectIncome = array(
                                        //     'user_id' => $user['sponser_id'],
                                        //     'amount' => $package['direct_income'],
                                        //     'type' => 'direct_income',
                                        //     'description' => 'Refferal Points from Activation of Member ' . $user_id,
                                        // );
                                        // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    }
                                    //}
                                    //if($sponser['directs'] == 3){
                                    //$this->pool_entry($user['user_id'],'tbl_pool');
                                    //}
                                    // $this->level_income($sponser['user_id'] , $user_id, $package['level_coin']);
                                    //$this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
                                    $this->royaltyAchiever($user['sponser_id']);
                                    //$this->boosterAchiever($user['sponser_id']);
                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                                    //$this->update_units($user['user_id'] , $user['sponser_id'], $package['commision']);
                                    // $sms_text = 'Dear ' . $user_id . ', Your Account Successfully Activated By User ID ' . $this->session->userdata['user_id'] . '.' . base_url();
                                    $message = 'Dear User your account is successfully activated with amount is '.$package['price']. ' by User ' . $this->session->userdata['user_id'];
                                            send_crypto_email2($user['email'], 'Activation Successfull', $message);

                                            // notify($user_id,$sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');

                                    //notify_user($user_id , $sms_text);
                                    $this->session->set_flashdata('message', '<span class="text-success">Account Activated Successfully</span>');
                                } else {
                                    $this->session->set_flashdata('message', '<span class="text-danger">Account is not activated!</span>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<span class="text-danger">Insuffcient Balance</span>');
                            }
                        }else{
                            $this->session->set_flashdata('message', '<span class="text-danger">This user id is not your team</span>');

                        }
                        // }else{
                        //     $this->session->set_flashdata('message', ' Invalid OTP');
                        // }
                    } else {
                        $this->session->set_flashdata('message', '<span class="text-danger">Invalid User ID</span>');
                    }
                    // }else{
                    //     $this->session->set_flashdata('message','OTP has expired');
                    // }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', ['price >' => 100], '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function checkUpline($upline_id, $downline_id)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $downline_id), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '' && $user['sponser_id']  != 'none') {
            if($upline_id == $user['sponser_id']){
                return $upline_id;
                exit;
            }
            $downline_id = $user['sponser_id'];
            return $this->checkUpline($upline_id, $downline_id);
        }
    }


    private function level_income($sponser_id, $activated_id, $level_income)
    {
        //$incomes = array(100,50,40,30,10,10,10);
        //$incomes = array(4,2,1,1,1,1);
        $incomes = explode(',', $level_income);

        foreach ($incomes as $key => $income) {
            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), '*');
            $direct = $this->User_model->get_single_record('tbl_users', 'sponser_id =  "' . $sponser_id . '" AND paid_status > "0" AND topup_date >= "' . $sponser['topup_date'] . '"', 'count(id) as direct');
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
                    $this->User_model->add('tbl_coin_wallet', $LevelIncome);

                    //}
                }
                $sponser_id = $sponser['sponser_id'];
            }
        }
    }


 public function test12()
    {
        $userData['name'] = 'Adminstrator';
        $userData['user_id'] = $this->session->userdata['user_id'];
        $userData['password'] = '4321';
        $userData['email'] = 'gnisandeepsingh@gmail.com';
        $userData['phone'] = '7717687075';
        $message = 'Dear User your account is successfully activated with amount  by User ' . $this->session->userdata['user_id'];
        send_crypto_email2($userData['email'], 'Registration Successfull', $message);

    }
    public function ActivateAccountEpin($epin = '')
    {
        if (is_logged_in()) {
            //redirect('Dashboard/User');
            //die;
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // $this->session->set_flashdata('message', 'Please Wait!');

                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $pin_status = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'epin' => $data['epin']), '*');
                    if (!empty($pin_status)) {
                        $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
                        if (!empty($user)) {
                            if ($pin_status['status'] == 0) {
                                if ($user['paid_status'] == 0 ) {
                                    // if ($response['user']['master_key'] == $data['master_key']) {
                                    $topupData = array(
                                        'paid_status' => 1,
                                        'package_id' => $data['package_id'],
                                        'package_amount' => $package['price'],
                                        'topup_date' => date('Y-m-d H:i:s'),
                                        // 'task_days' => $package['days'],
                                        // 'complete_days' => 0,
                                        'capping' => $package['capping']
                                    );
                                    $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                    $this->User_model->update('tbl_epins', array('id' => $pin_status['id']), array('used_for' => $user['user_id'], 'status' => 1));
                                    if ($user['paid_status'] == 0 && $user['package_amount'] == 0) {

                                        $coin_incoem = array(
                                            'user_id' => $user['user_id'],
                                            'amount' => 100,
                                            'type' => 'coin_income',
                                            'description' => 'SDC Coin from Activation of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_coin_wallet', $coin_incoem);
                                        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs,user_id');

                                        //$this->level_income($sponser['user_id'] , $user_id, $package['level_coin']);


                                        $this->User_model->update_directs($user['sponser_id']);
                                    } elseif ($user['paid_status'] == 0 && $user['package_amount'] > 0) {
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), ['retopup_times' => ($user['retopup_times'] + 1)]);
                                        $coin_incoem = array(
                                            'user_id' => $user['user_id'],
                                            'amount' => 100,
                                            'type' => 'coin_income',
                                            'description' => 'SDC Coin from Retopup of Member ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_coin_wallet', $coin_incoem);
                                    }

                                    //$this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'] , $type = 'topup');
                                    // $sms_text = 'Dear User Login ID : '.$user['user_id'] .' Account Has been Successfully Activated Please Wait for your PH links '.base_url();
                                    // notify_user($user['user_id'], $sms_text);
                                    redirect('Dashboard/Settings/epins/0');
                                    $this->session->set_flashdata('message', 'Account Activated Successfully');
                                    // } else {
                                    //     $this->session->set_flashdata('message', 'Invalid Transaction Password');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', 'This Account Already Acitvated');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Expired Epin');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'This Pin is not valid for you');
                    }
                }
            }
            $response['available_pins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as available_pins');
            $response['packages'] = $this->User_model->get_records('tbl_package', array('id' => 1), '*');
            $response['epin'] = $epin;
            $this->load->view('activate_account_epin', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function royaltyAchiever($user_id)
    {
        $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'directs,topup_date');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 30 days'));
        $diff2 = strtotime($date2) - strtotime($date1);
        if ($diff2 > 0) {
            if ($user['directs'] >= 50) {
                $roiData = [
                    'user_id' => $user['user_id'],
                    'amount' => 5000 * 12,
                    'days' => 12,
                    'roi_amount' => 5000,
                    'type' => "royalty_income"
                ];
                $this->User_model->add('tbl_roi', $roiData);
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['royalty_status' => 1]);
            }

            if ($user['directs'] >= 75) {
                $roiData = [
                    'user_id' => $user['user_id'],
                    'amount' => 7500 * 12,
                    'days' => 12,
                    'roi_amount' => 7500,
                    'type' => "royalty_income"

                ];
                $this->User_model->update('tbl_roi', ['user_id' => $user_id], $roiData);
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['royalty_status' => 2]);
            }

            if ($user['directs'] >= 100) {
                $roiData = [
                    'user_id' => $user['user_id'],
                    'amount' => 10000 * 12,
                    'days' => 12,
                    'roi_amount' => 10000,
                    'type' => "royalty_income"

                ];
                $this->User_model->update('tbl_roi', ['user_id' => $user_id], $roiData);
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['royalty_status' => 3]);
            }
        }
    }




    public function UpgradeAccount2()
    {
        if (is_logged_in()) {
            // redirect('Dashboard/User');
            // die;
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // die('please wait we are working on it.');

                $data = $this->security->xss_clean($this->input->post());
                $user_id = $this->session->userdata['user_id'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                $balance = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as balance');

                $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                $directs = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $user_id,'package_id >=' =>1), 'count(id)as direct');

                if (!empty($user)) {
                    if ($wallet['wallet_balance'] >= $package['price'] && $package['price'] > 100 && $package['price'] > 0) {
                        // if ($user['upgrade_package'] != $package['price']) {
                        if ($user['package_amount'] < $package['price']) {
                            if ($user['paid_status'] == 0 && $user['package_id'] >= 1) {
                                if($directs['direct'] < 2){
                                    $looseIncome = array(
                                        'user_id' => $user_id,
                                        'amount' => -$balance['balance'],
                                        'type' => 'lose_income',
                                        'description' => ' Loose Income',
                                    );
                                    $this->User_model->add('tbl_income_wallet', $looseIncome);
                                }
                                // $checkPool = $this->User_model->get_single_record($package['products'],['user_id' => $user['user_id']],'*');
                                // if(empty($checkPool['user_id'])){
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account upgradation deduction for ' . $user_id,
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);
                                $topupData = array(
                                    'paid_status' => 1,
                                    'upgrade_id' => $data['package_id'],
                                    'upgrade_package' => $package['price'],
                                    'topup_date' => date('Y-m-d H:i:s'),
                                    'task_days' => $package['days'],
                                    'complete_days' => 0,
                                    // 'upgrade_at' => date('Y-m-d H:i:s'),
                                   // 'capping' => ($user['capping']),
                                );
                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                // $this->User_model->update_directs($user['sponser_id']);
                                $this->loseIncomeCron($user_id);
                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'user_id,sponser_id,directs');
                                $message = 'Dear User your account is successfully activated with amount is '.$package['price'].' by User ' . $this->session->userdata['user_id'];
                                        send_crypto_email2($user['email'], 'Activation Successfull', $message);
                                $this->session->set_flashdata('message', '<h5 class="text-success">Account upgraded successfully</h5>');
                            } else {
                                $this->session->set_flashdata('message', '<h5 class="text-danger">This Account not acitvated</h5>');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<h5 class="text-danger">This Account Already Acitvated</h5>');
                        }
                        // } else {
                        //         $this->session->set_flashdata('message', '<h5 class="text-danger">Same package upgrade not allowed!</h5>');
                        //     }
                    } else {
                        $this->session->set_flashdata('message', '<h5 class="text-danger">Insuffcient Balance</h5>');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
                // }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            // $response['packages'] = $this->User_model->get_records('tbl_package',"price >='".$response['user']['package_amount']."'  AND price > '".$response['user']['upgrade_package']."'", '*');
            $response['packages'] = $this->User_model->get_records('tbl_package', ['id ' => 1], '*');
            // pr($response['packages']);
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }




    private function loseIncomeCron($user_id){
        $uDetails = $this->User_model->get_records('tbl_users',['package_id' => 1,'user_id' =>$user_id ],'topup_date,user_id,directs');
        if(!empty($uDetails)){
            foreach ($uDetails as $key => $user) {
                $date1 = date('Y-m-d H:i:s');
                $date2 = date('Y-m-d H:i:s',strtotime($user['topup_date'].'+ 60 days'));
                $Diffs = strtotime($date2) - strtotime($date1);
                if($Diffs < 0 && $user['topup_date'] != "0000-00-00 00:00:00" && $user['directs'] < 2){
                    // echo $date2.'<br>';
                    // echo $Diffs.'<br>';
                    $checkIncome = $this->User_model->get_single_record('tbl_income_wallet',['user_id' => $user['user_id']],'ifnull(sum(amount),0)as total');
                    if($checkIncome['total'] >0){
                        $Income = array(
                            'user_id' => $user['user_id'],
                            'amount' => -$checkIncome['total'],
                            'type' => 'lose_money',
                            'description' => 'Lose Money',
                            'level' => $level,
                        );
                        // pr($checkIncome);
                       $this->User_model->add('tbl_income_wallet', $Income);
                    }
                    
                    // $deACTIVATE=['user_id' => $user['user_id']];
                    // $this->Main_model->add('tbl_deactivation_details',$deACTIVATE);
                }
            }
        }
    }

    public function retopup_id()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($response['user']['upgrade_id'] > 0) {
                $package_amount1 = $response['user']['upgrade_package'];
            } else {
                $package_amount1 = $response['user']['package_amount'];
            }
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $user_id = $this->session->userdata['user_id'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');

                if ($user['upgrade_id'] > 0) {
                    $package_amount = $user['upgrade_package'];
                } else {
                    $package_amount = $user['package_amount'];
                }
                $time2 = $user['topup_date'];
                $time1 = date('Y-m-d H:i:s');
                $hourdiff = round((strtotime($time1) - strtotime($time2)) / 3600, 1);

                $seconds = (strtotime($time1) - strtotime($time2));
                $days = intval(intval($seconds) / (3600 * 24));

                if (!empty($user) && $user['user_id'] == $data['user_id']) {
                    if ($wallet['wallet_balance'] >= $package['price']) {
                        if ($package_amount == $package['price'] and $user['paid_status'] == 0 and $package['price'] >= 1199) {
                            if ($days >= 15) {
                                $sendWallet = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$package['price'],
                                    'type' => 'account_activation',
                                    'remark' => 'Account Retopup deduction for ' . $user_id,
                                );
                                $this->User_model->add('tbl_wallet', $sendWallet);
                                $topupData = array(
                                    // 'paid_status' => 1,
                                    'upgrade_id' => $data['package_id'],
                                    'upgrade_package' => $package['price'],
                                    // 'topup_date' => date('Y-m-d H:i:s'),
                                    'upgrade_at' => date('Y-m-d H:i:s'),
                                    'task_days' => $package['days'],
                                    'complete_days' => 0,
                                    'paid_status' => 1,
                                    //'capping' => $package['capping'],
                                );
                                $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                                // $this->User_model->update_directs($user['sponser_id']);
                                $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'user_id,sponser_id,directs');
                                $this->session->set_flashdata('message', '<h5 class="text-success">Account Retopup successfully</h5>');
                            } else {
                                $this->session->set_flashdata('message', '<h5 class="text-danger">Days pending for retopup</h5>');
                            }
                        } else {
                            $this->session->set_flashdata('message', '<h5 class="text-danger">This Account Already Acitvated</h5>');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<h5 class="text-danger">Insuffcient Balance</h5>');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Invalid User ID');
                }
                // }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', "price >= '" . $package_amount1 . "'", '*');
            // pr($response['packages']);
            $this->load->view('retopup_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }







    // private function level_income($sponser_id, $activated_id, $package_income) {
    //     //$incomes = explode(',', $package_income);
    //     for($i=2;$i<=25;$i++){
    //         if($i == 2){
    //             $incomes[$i] = 20;
    //         }elseif($i == 3){
    //             $incomes[$i] = 10;
    //         }elseif($i == 4){
    //             $incomes[$i] = 5;
    //         }elseif($i >= 5){
    //             $incomes[$i] = 2;
    //         }
    //     }
    //     foreach ($incomes as $key => $income) {
    //         $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,directs,upgradeStatus');
    //         if (!empty($sponser)) {
    //             //if ($sponser['paid_status'] == 1 && $sponser['directs'] >= 4 && $sponser['upgradeStatus'] == 1) {
    //             if ($sponser['paid_status'] == 1) {
    //                 $LevelIncome = array(
    //                     'user_id' => $sponser['user_id'],
    //                     'amount' => $income,
    //                     'type' => 'level_income',
    //                     'description' => 'Level Income from Activation of Member ' . $activated_id . ' At level ' .$key,
    //                 );
    //                $this->User_model->add('tbl_income_wallet', $LevelIncome);
    //             }
    //             $sponser_id = $sponser['sponser_id'];
    //         }
    //     }
    // }

    protected function pool_entry($user_id, $table)
    {
        $pool_upline = $this->User_model->get_single_record($table, array('down_count <' => 2), 'id,user_id,down_count');
        if (!empty($pool_upline)) {
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => $pool_upline['user_id'],
            );
            $this->User_model->add($table, $poolArr);
            $this->User_model->update($table, array('id' => $pool_upline['id']), array('down_count' => $pool_upline['down_count'] + 1));
            $this->updateTeam($user_id, $table);
            $this->poolIncome($table, $user_id);
        } else {
            $poolArr =  array(
                'user_id' => $user_id,
                'upline_id' => '',
            );
            $this->User_model->add($table, $poolArr);
            $this->updateTeam($user_id, $table);
            $this->poolIncome($table, $user_id);
        }
    }

    protected function updateTeam($user_id, $table)
    {
        $uplineID = $this->User_model->get_single_record($table, array('user_id' => $user_id), 'upline_id');
        if (!empty($uplineID['upline_id'])) {
            $team = $this->User_model->get_single_record($table, array('user_id' => $uplineID['upline_id']), 'team');
            $newTeam = $team['team'] + 1;
            $this->User_model->update($table, array('user_id' => $uplineID['upline_id']), array('team' => $newTeam));
            $this->updateTeam($uplineID['upline_id'], $table);
        }
    }

    private function poolIncome($table, $user_id)
    {
        if ($table == 'tbl_pool') {
            $incomes  = ['2' => '100', '6' => '300', '14' => '800', '30' => '1600', '62' => '3200'];
            $pool = 'Star';
            $upgrade = 3000;
            $table2 = 'tbl_pool2';
        } elseif ($table == 'tbl_pool2') {
            $incomes = ['2' => '200', '6' => '1200', '14' => '3200', '30' => '8000', '62' => '22400'];
            $pool = 'Silver';
            $upgrade = 15000;
            $table2 = 'tbl_pool3';
        } elseif ($table == 'tbl_pool3') {
            $incomes = ['2' => '2000', '6' => '5600', '14' => '12800', '30' => '32000', '62' => '128000'];
            $pool = 'Gold';
            $upgrade = 70000;
            $table2 = 'tbl_pool4';
        } elseif ($table == 'tbl_pool4') {
            $incomes = ['2' => '10000', '6' => '28000', '14' => '64000', '30' => '160000', '62' => '640000'];
            $pool = 'Ruby';
            $upgrade = 400000;
            $table2 = 'tbl_pool5';
        } elseif ($table == 'tbl_pool5') {
            $incomes = ['2' => '40000', '6' => '160000', '14' => '480000', '30' => '1280000', '62' => '3200000'];
            $pool = 'Peral';
            $upgrade = 2000000;
            $table2 = 'tbl_pool6';
        } elseif ($table == 'tbl_pool6') {
            $incomes = ['2' => '200000', '6' => '800000', '14' => '2400000', '30' => '6400000', '62' => '16000000'];
            $pool = 'Diamond';
            $upgrade = 0;
        }
        foreach ($incomes as $key => $inc) :
            $user = $this->User_model->get_single_record($table, ['user_id' => $user_id], 'upline_id');
            if (!empty($user['upline_id'])) :
                $upline = $this->User_model->get_single_record($table, ['user_id' => $user['upline_id']], '*');
                if ($upline['team'] == $key) :
                    $userIncome = [
                        'user_id' => $upline['user_id'],
                        'amount' => $inc,
                        'type' => 'pool_income',
                        'description' => $pool . ' Pool Income',
                    ];
                    $this->User_model->add('tbl_income_wallet', $userIncome);
                    $user_id = $upline['user_id'];
                    if ($upline['team'] == 62 && $upgrade > 0) :
                        $debit = [
                            'user_id' => $upline['user_id'],
                            'amount' => -$upgrade,
                            'type' => 'upgrade_deduction',
                            'description' => 'Upgrade deduction for Next Pool',
                        ];
                        $this->User_model->add('tbl_income_wallet', $debit);
                        $this->pool_entry($upline['user_id'], $table2);
                    endif;
                endif;
            endif;
        endforeach;
    }


    private function boosterAchiever($user_id)
    {
        $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'directs,topup_date');
        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 1 days'));
        $date3 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 3 days'));
        $diff2 = strtotime($date2) - strtotime($date1);
        if ($diff2 > 0) {
            if ($user['directs'] >= 2) {
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster1' => 1]);
            }
        }
        $diff3 = strtotime($date3) - strtotime($date1);
        if ($diff3 > 0) {
            if ($user['directs'] >= 5) {
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster2' => 1]);
            }
        }
    }

    private function teamDevelopmentIncome($user_id, $linkedId, $amount)
    {
        $incomes = ['0.05', '0.05', '0.02', '0.01', '0.01'];
        foreach ($incomes as $key => $income) {
            $user = $this->Main_model->get_single_record('tbl_users', ['user_id' => $user_id], 'user_id,sponser_id');
            if (!empty($user['sponser_id'])) {
                $userIncome = [
                    'user_id' => $user['sponser_id'],
                    'amount' => $amount * $income,
                    'type' => 'team_development',
                    'description' => 'Team Development Income From User ' . $linkedId . ' at level ' . ($key + 1),
                ];
                $this->Main_model->add('tbl_income_wallet', $userIncome);
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
    public function FixDeposit()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // pr($data);
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
                $this->form_validation->set_rules('duration', 'Duration', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $wallet = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        if ($wallet['wallet_balance'] >= $data['amount']) {
                            // if ($user['paid_status'] == 0) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$data['amount'],
                                'type' => 'fix_deposit',
                                'remark' => 'Fix Deposit Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_token_wallet', $sendWallet);

                            $depositArr = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => $data['amount'],
                                'duration' => $data['duration'],
                            );
                            $this->User_model->add('tbl_fix_deposit', $depositArr);

                            $this->session->set_flashdata('message', 'Account Activated Successfully');
                            // } else {
                            //     $this->session->set_flashdata('message', 'This Account Already Acitvated');
                            // }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid User ID');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $response['token_wallet'] = $this->User_model->get_single_record('tbl_token_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', array(), '*');
            $this->load->view('fix_deposit', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function check_pool_stats()
    {
        $achievers = $this->User_model->get_records('tbl_pool', array('next_level' => 0, 'level1' => 5), '*');
        foreach ($achievers as $key => $achiever) {
            $RankIncome = array(
                'user_id' => $achiever['user_id'],
                'amount' => $achiever['pool_amount'] * 80 / 100,
                'type' => 'pool_income',
                'description' => 'Pool Bonus From level ' . $achiever['pool_level'],
            );
            $this->User_model->add('tbl_income_wallet', $RankIncome);
            $this->repurchase_income($achiever['user_id'], ($achiever['pool_amount'] * 20 / 100), 'pool_income', 'Pool Bonus From level ' . $achiever['pool_level']);
            $this->User_model->update('tbl_pool', array('id' => $achiever['id']), array('next_level' => 1));
            $this->pool_entry($achiever['user_id'], ($achiever['pool_level'] + 1), ($achiever['pool_amount'] * 2));
            $company_ids = $achiever['pool_amount'] / 500;
            for ($i = 1; $i <= $company_ids; $i++) {
                $this->pool_entry('admin', 1, 500);
            }
        }
    }

    public function UpgradeAccount()
    {
        if (is_logged_in()) {
            $response['packages'] = [
                '1' => ['id' => '1', 'price' => '800', 'table' => 'tbl_pool2'],
                '2' => ['id' => '2', 'price' => '2000', 'table' => 'tbl_pool3'],
                '3' => ['id' => '3', 'price' => '6000', 'table' => 'tbl_pool4'],
                '4' => ['id' => '4', 'price' => '20000', 'table' => 'tbl_pool5'],
                '5' => ['id' => '5', 'price' => '50000', 'table' => 'tbl_pool6'],
                '6' => ['id' => '6', 'price' => '160000', 'table' => 'tbl_pool7'],
            ];
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                $user_id = $this->session->userdata['user_id'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                //$package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id']), '*');
                if (!empty($user)) {
                    // pr($user,true);
                    // if ($wallet['wallet_balance'] >= $package['price']) {
                    //     if ($user['package_amount'] < $package['price']) {
                    if ($wallet['wallet_balance'] >= $response['packages'][$data['package_id']]['price']) {
                        if ($user['upgrade_package'] < $response['packages'][$data['package_id']]['price']) {
                            $sendWallet = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$response['packages'][$data['package_id']]['price'],
                                'type' => 'account_activation',
                                'remark' => 'Account Upgrade Deduction for ' . $user_id,
                            );
                            $this->User_model->add('tbl_wallet', $sendWallet);
                            $topupData = array(
                                'upgradeStatus' => 1,
                                'upgrade_id' => $response['packages'][$data['package_id']]['id'],
                                'upgrade_package' => $response['packages'][$data['package_id']]['price'],
                                //'topup_date' => date('Y-m-d H:i:s'),
                                //'capping' => $package['capping'],
                            );
                            $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);
                            // $this->User_model->update_directs($user['sponser_id']);
                            $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
                            // $DirectIncome = array(
                            //     'user_id' => $user['sponser_id'],
                            //     'amount' => $package['direct_income'],
                            //     'type' => 'direct_income',
                            //     'description' => 'Direct Income from Retopup of Member ' . $user_id,
                            // );
                            // $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            // $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
                            // $roiArr = array(
                            //     'user_id' => $user['user_id'],
                            //     'amount' => ($package['price'] * $package['days']),
                            //     'roi_amount' => $package['commision'],
                            // );
                            // $this->User_model->add('tbl_roi', $roiArr);
                            $this->holdingToWallet($user_id, $response['packages'][$data['package_id']]['id']);
                            $this->pool_entry($user_id, $response['packages'][$data['package_id']]['table']);
                            $this->session->set_flashdata('message', 'Account Upgraded Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'This Account Already Upgraded to this amount');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Insuffcient Balance');
                    }
                    // }else{
                    //     $this->session->set_flashdata('message', 'Invalid User ID');
                    // }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $this->load->view('upgrade_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function holdingToWallet($user_id, $pool)
    {
        $Income = $this->User_model->get_records('tbl_holding_wallet', ['user_id' => $user_id, 'status' => 0, 'pool' => $pool], '*');
        foreach ($Income as $key => $inc) {
            $userIncome = [
                'user_id' => $inc['user_id'],
                'amount' => $inc['amount'],
                'type' => $inc['type'],
                'description' => $inc['description'],
                'created_at' => $inc['created_at'],
            ];
            $this->User_model->add('tbl_income_wallet', $userIncome);
            $this->User_model->update('tbl_holding_wallet', ['id' => $inc['id']], ['status' => 1]);
        }
    }

    public function update_activate_users_business()
    {
        die;
        $users = $this->User_model->get_records('tbl_users', ['paid_status' => 1], 'user_id,package_id');
        foreach ($users as $k => $user) {
            $package =  $this->User_model->get_single_record('tbl_package', array('id' => $user['package_id']), '*');
            $this->update_business($user['user_id'], $user['user_id'], $level = 1, $package['bv'], $type = 'topup');
        }
    }

    function update_business($user_name = 'A915813', $downline_id = 'A915813', $level = 1, $business = '40', $type = 'topup')
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

    public function getUserIdForRegister($country_code = '')
    {
        $sponser = $this->User_model->get_single_record('tbl_users', array(), 'ifnull(max(id_number),0) + 1 as next_id');
        if ($sponser['next_id'] == 1) {
            $user_id = '10001';
        } else {
            $user_id = $sponser['next_id'];
        }
        return $user_id;
    }

    public function generateUserId()
    {
        $user_id = rand(10000, 99999);
    }

    //    public function magic_income_use() {
    //        $magic_users = $this->User_model->magic_users();
    //        pr($magic_users);
    //        foreach ($magic_users as $user) {
    //            $this->register_magic_user($user['user_id']);
    //        }
    //    }
    //    public function register_magic_user($user_id) {
    //        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //        $id_number = $this->getUserIdForRegister();
    //        $userData['user_id'] = 'WIN' . $id_number;
    //        $userData['id_number'] = $id_number;
    //        $userData['sponser_id'] = $user['sponser_id'];
    //        $userData['name'] = $user['name'];
    //        $userData['phone'] = $user['phone'];
    //        $userData['password'] = $user['password'];
    //        $userData['user_type'] = 'magic';
    //        $this->User_model->add('tbl_users', $userData);
    //        $this->User_model->add('tbl_bank_details', array('user_id' => $userData['user_id']));
    //        $this->repurchase_income($user_id, -3600, 'magic_user_registration', 'New Magic User Registered with ID ' . $userData['user_id']);
    //        $this->topup_magic_user($userData['user_id']);
    //    }
    //
    //    public function topup_magic_user($user_id) {
    //        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
    //        $package = $this->User_model->get_single_record('tbl_package', array('id' => 1), '*');
    //        $this->User_model->update('tbl_users', array('user_id' => $user_id), array('paid_status' => 1, 'package_id' => $package['id'], 'package_amount' => $package['price'], 'topup_date' => date('Y-m-d h:i:s')));
    //        $this->User_model->update_directs($user['sponser_id']);
    //        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,directs');
    //        $DirectIncome = array(
    //            'user_id' => $user['sponser_id'],
    //            'amount' => $package['direct_income'] * 80 / 100,
    //            'type' => 'direct_income',
    //            'description' => 'Direct Income from Activation of Member ' . $user_id,
    //        );
    //        $this->User_model->add('tbl_income_wallet', $DirectIncome);
    //        $this->repurchase_income($user['sponser_id'], ($package['direct_income'] * 20 / 100), 'direct_income', 'Direct Income from Activation of Member ' . $user_id);
    //        $this->level_income($sponser['sponser_id'], $user['user_id'], $package['level_income']);
    //        $this->pool_entry($user['user_id'], 1, 500);
    //        if ($package['price'] == 3600)
    //            $this->rank_bonus($user['user_id'], 200, $user['user_id'], 0, $package['price']);
    //        else
    //            $this->rank_bonus($user['user_id'], 105, $user['user_id'], 0, $package['price']);
    //        //$this->rank_bonus($user['user_id'], 200,$user['user_id'],0 , $package['price']);
    //    }
    //    public function differance_income_distribution() {
    //        $rank_incomes = array(
    //            5 => 50,
    //            10 => 75,
    //            15 => 100,
    //            20 => 125,
    //            25 => 150,
    //            50 => 175,
    //            100 => 200,
    //        );
    //    }
    //    public function rank_bonus($user_id = 'AMAZING6388', $amount = '200', $sender_id = 'AMAZING5177', $total_distribution = 0, $package_amount = 3600, $last_rank = 0) {
    //        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
    //        if ($amount > 0) {
    //            if (!empty($sponser)) {
    //                $sponser['last_distribution'] = $total_distribution;
    //                if ($package_amount == 3600) {
    //                    if ($sponser['directs'] >= 100) {
    //                        $income = 200;
    //                        $winner_rank = 7;
    //                    } elseif ($sponser['directs'] >= 50) {
    //                        $income = 175;
    //                        $winner_rank = 6;
    //                    } elseif ($sponser['directs'] >= 25) {
    //                        $income = 150;
    //                        $winner_rank = 5;
    //                    } elseif ($sponser['directs'] >= 20) {
    //                        $income = 125;
    //                        $winner_rank = 4;
    //                    } elseif ($sponser['directs'] >= 15) {
    //                        $income = 100;
    //                        $winner_rank = 3;
    //                    } elseif ($sponser['directs'] >= 10) {
    //                        $income = 75;
    //                        $winner_rank = 2;
    //                    } elseif ($sponser['directs'] >= 5) {
    //                        $income = 50;
    //                        $winner_rank = 1;
    //                    } elseif ($sponser['directs'] >= 0) {
    //                        $winner_rank = 0;
    //                        $income = 0;
    //                    }
    //                } else {
    //                    if ($sponser['directs'] >= 100) {
    //                        $income = 105;
    //                        $winner_rank = 7;
    //                    } elseif ($sponser['directs'] >= 50) {
    //                        $income = 90;
    //                        $winner_rank = 6;
    //                    } elseif ($sponser['directs'] >= 25) {
    //                        $income = 75;
    //                        $winner_rank = 5;
    //                    } elseif ($sponser['directs'] >= 20) {
    //                        $income = 60;
    //                        $winner_rank = 4;
    //                    } elseif ($sponser['directs'] >= 15) {
    //                        $income = 45;
    //                        $winner_rank = 3;
    //                    } elseif ($sponser['directs'] >= 10) {
    //                        $income = 30;
    //                        $winner_rank = 2;
    //                    } elseif ($sponser['directs'] >= 5) {
    //                        $income = 15;
    //                        $winner_rank = 1;
    //                    } elseif ($sponser['directs'] >= 0) {
    //                        $income = 0;
    //                        $winner_rank = 0;
    //                    }
    //                }
    //                $main_income = $income - $total_distribution;
    //                $total_distribution = $total_distribution + $main_income;
    //                if ($main_income > $amount) {
    //                    $main_income = $amount;
    //                }
    //                $amount = $amount - $main_income;
    //                $user_rank = calculate_rank($sponser['directs']);
    //                $RankIncome = array(
    //                    'user_id' => $sponser['user_id'],
    //                    'amount' => $main_income * 80 / 100,
    //                    'type' => 'rank_bonus',
    //                    'description' => 'Rank Bonus From ' . $sender_id . ' At ' . $user_rank,
    //                );
    //                // $RankIncome['total_distribution'] = $total_distribution;
    //                // $RankIncome['income'] = $main_income;
    //                if ($main_income > 0) {
    //                    if ($winner_rank > $last_rank) {
    //                        $this->User_model->add('tbl_income_wallet', $RankIncome);
    //                        $this->repurchase_income($sponser['user_id'], ($main_income * 20 / 100), 'rank_bonus', 'Rank Bonus From ' . $sender_id);
    //                        $last_rank = $winner_rank;
    //                    }
    //                }
    //
    //                $this->rank_bonus($sponser['sponser_id'], $amount, $sender_id, $total_distribution, $package_amount, $last_rank);
    //            }
    //        }
    //    }
    // public function rank_bonus($user_id = 'WIN10024', $amount ='200', $sender_id  = 'WIN10024', $last_distribution = 0){
    //     $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,sponser_id,paid_status,package_id,directs');
    //     if(!empty($sponser)){
    //         $sponser['rank'] = calculate_rank($sponser['directs']);
    //         $bonus_amount = calculate_rank_bonus($sponser['directs'],$sponser['package_id']);
    //         if($bonus_amount > 0){
    //             // $bonus_amount = $bonus_amount - $last_distribution;
    //             // if($amount > $bonus_amount)
    //             //     $income = $bonus_amount;
    //             // else
    //             //     $income = $amount;
    //                 $income = $bonus_amount;
    //             if($income > 0){
    //                 $RankIncome = array(
    //                     'user_id' => $sponser['user_id'],
    //                     'amount' => $income * 100 / 100 ,
    //                     'type' => 'rank_bonus',
    //                     'description' => 'Rank Bonus From '.$sender_id,
    //                 );
    //                 $sponser['income'] = $income;
    //                 $sponser['last_distribution'] = $last_distribution;
    //                 $sponser['status'] = '--------------------------';
    //                 // $this->User_model->add('tbl_income_wallet', $RankIncome);
    //                 $this->repurchase_income($sponser['user_id'],($income * 20 / 100),'rank_bonus' ,'Rank Bonus From '.$sender_id);
    //             }
    //             pr($sponser);
    //             $last_distribution =  $last_distribution - $income;
    //             if($amount > 0){
    //                 $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id , abs($last_distribution));
    //                 echo'case1';
    //             }
    //         }else{
    //             $this->rank_bonus($sponser['sponser_id'] , $amount , $sender_id, $last_distribution);
    //             echo'case2';
    //         }
    //     }
    // }

    public function payment_response($message)
    {
        if ($message == 'success') {
            $response['message'] = 'Payment Completed Succesfully';
        } else {
            $response['message'] = 'Error in Payment Process';
        }

        $this->load->view('payment_response', $response);
    }

    public function repurchase_income($user_id, $amount, $type, $description)
    {
        $RepurchaseIncome = array(
            'user_id' => $user_id,
            'amount' => $amount,
            'type' => $type,
            'description' => $description,
        );
        $this->User_model->add('tbl_repurchase_income', $RepurchaseIncome);
    }

    public function IncomeTransfer()
    {
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    $user_id = $this->input->post('user_id');
                    $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 5) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            // if($user['master_key'] == $master_key){
                            $DirectIncome = array(
                                'user_id' => $this->session->userdata['user_id'],
                                'amount' => -$withdraw_amount,
                                'type' => 'income_transfer',
                                'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);
                            $DirectIncome = array(
                                'user_id' => $user_id,
                                'amount' => $withdraw_amount * 95 / 100,
                                'type' => 'income_transfer',
                                'description' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                            );
                            $this->User_model->add('tbl_income_wallet', $DirectIncome);

                            $this->session->set_flashdata('message', 'Income Transferred Successfully');
                            // }else{
                            //     $this->session->set_flashdata('message', 'Invalid Master Key');
                            // }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Transfer Amount is $5');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer', $response);
        } else {
        }
    }

    public function eWalletTransfer()
    {
        if (is_logged_in()) {
            // $response['mini_transfer'] = $this->User_model->get_single_record('tbl_site_settings','id = 1','*');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('otp', 'OTP', 'trim|numeric|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    if (!empty($this->session->tempdata('otp'))) {
                        if ($data['otp'] == $this->session->tempdata('otp')) {
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                            $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                            $withdraw_amount = $this->input->post('amount');
                            $user_id = $this->input->post('user_id');
                            $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                            $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                            if ($withdraw_amount >= minTransfer) {
                                if ($balance['balance'] >= $withdraw_amount) {
                                    // if($user['master_key'] == $master_key){
                                    $DirectIncome = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$withdraw_amount,
                                        'type' => 'income_transfer',
                                        'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                                    );
                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    $DirectIncome = array(
                                        'user_id' => $user_id,
                                        'amount' => $withdraw_amount * 95 / 100,
                                        'type' => 'income_transfer',
                                        'remark' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                                    );
                                    $this->User_model->add('tbl_wallet', $DirectIncome);

                                    $this->session->set_flashdata('message', '<div class="text-success>"Income Transferred Successfully</div>');
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'Invalid Master Key');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', 'Insuffcient Balance');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Minimum Transfer Amount is Rs.' . minTransfer);
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid OTP');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'OTP has expired');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['eWallet'] = 1;
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }




    public function rWalletTransfer()
    {
        if (is_logged_in()) {
            // $response['mini_transfer'] = $this->User_model->get_single_record('tbl_site_settings','id = 1','*');
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Tnx Pin', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('otp', 'OTP', 'trim|numeric|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    // if(!empty($this->session->tempdata('otp'))){
                    //     if($data['otp'] == $this->session->tempdata('otp')){
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    $user_id = $this->input->post('user_id');
                    $transfer_user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $balance = $this->User_model->get_single_record('tbl_repurchase_income', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 5) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($user['master_key'] == $data['master_key']) {
                                $DirectIncome = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$withdraw_amount,
                                    'type' => 'income_transfer',
                                    'description' => 'Sent ' . $withdraw_amount . ' to ' . $user_id,
                                );
                                $this->User_model->add('tbl_repurchase_income', $DirectIncome);
                                $DirectIncome = array(
                                    'user_id' => $user_id,
                                    'amount' => $withdraw_amount,
                                    'type' => 'income_transfer',
                                    'remark' => 'Got ' . $withdraw_amount . ' from ' . $this->session->userdata['user_id'],
                                );
                                $this->User_model->add('tbl_wallet', $DirectIncome);

                                $this->session->set_flashdata('message', 'Income Transferred Successfully');
                            } else {
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Transfer Amount is Rs.5');
                    }
                    //     }else{
                    //         $this->session->set_flashdata('message', 'Invalid OTP');
                    //     }
                    // }else{
                    //  $this->session->set_flashdata('message', 'OTP has expired');
                    // }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['eWallet'] = 1;
            $response['balance'] = $this->User_model->get_single_record('tbl_repurchase_income', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('income_transfer3', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



    public function DirectIncomeWithdraw()
    {
        // redirect('Dashboard/User');
        // die();
        //die('this page is accessable');
        if (is_logged_in()) {
            $response['title'] = "Direct Withdraw";
            $siteSettings = $this->User_model->get_single_record('tbl_site_settings', ['id' => 1], '*');
            $response['des'] = "Minimum Transfer Amount " . currency . "" . $siteSettings['minimum_withdraw'] . "";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['directs'] = $this->User_model->get_single_record('tbl_users', array('sponser_id' => $this->session->userdata['user_id'], 'paid_status' => 1), 'count(id) as ids');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                //   $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');
                //$this->form_validation->set_rules('credit_type', 'Credit in', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //    if(!empty($_SESSION['verification_otp']) && $data['otp'] == $_SESSION['verification_otp']){
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= $siteSettings['minimum_withdraw']) {
                        // if ($withdraw_amount % $siteSettings['multiple_amount'] == 0) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($user['master_key'] == $master_key) {
                                // if ($response['directs']['ids'] >= 2 ||$response['user']['user_id']=='admin') {
                                    if ($kyc_status['kyc_status'] == 2||$response['user']['user_id']=='admin') {
                                        $DirectIncome = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$withdraw_amount,
                                            'type' => 'withdraw_request',
                                            'description' => 'Withdrawal Amount ',
                                        );
                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                        $totalcharges =  ($siteSettings['tds_charges'] + $siteSettings['admin_charges']);
                                        if ($data['pin_transfer'] == 0) {
                                            $final_amount = $withdraw_amount - ($withdraw_amount *10 / 100);

                                            $withdrawArr = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'amount' => $withdraw_amount,
                                                'type' => 'withdraw_request',
                                                'tds' => $withdraw_amount * 5 / 100,
                                                'admin_charges' => $withdraw_amount * 5 / 100,
                                                // 'repurchase_charges' => $withdraw_amount * 10 / 100,
                                                'fund_conversion' => 0,
                                                'payable_amount' => $final_amount,
                                                //'credit_type' => $data['credit_type'],
                                            );
                                            $this->User_model->add('tbl_withdraw', $withdrawArr);
                                            // $DirectIncomeGMT = array(
                                            //     'user_id' => $this->session->userdata['user_id'],
                                            //     'amount' => $final_amount/2,
                                            //     'type' => 'withdraw_amount',
                                            //     'description' => 'Withdrawal Amount ',
                                            // );
                                            // $this->User_model->add('tbl_gmt_wallet', $DirectIncomeGMT);
                                        } else {
                                            // $fund_converstion = $withdraw_amount * 45 /100;
                                            // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                            // $withdrawArr['type'] = 'direct_income' ;
                                            // $withdrawArr['amount'] = $withdraw_amount;
                                            // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                            // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                            // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
                                            // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
                                            // $this->User_model->add('tbl_withdraw', $withdrawArr);
                                            // $walletArr = array(
                                            //     'user_id' => $this->session->userdata['user_id'],
                                            //     'amount' => $withdraw_amount * 90 / 100,
                                            //     'type' => 'direct_income_withdraw',
                                            //     'remark' => 'fund generated from direct income withdraw',
                                            //     'sender_id' => $this->session->userdata['user_id'],
                                            // );
                                            // $this->User_model->add('tbl_wallet', $walletArr);
                                        }
                                        $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                    } else {
                                        $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
                                    }
                                // } else {
                                //     $this->session->set_flashdata('message', '2 directs required for withdraw!');
                                // }
                            } else {
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                        // } else {
                        //     $this->session->set_flashdata('message', 'Withdraw Amount is multiple of '.currency.''.$siteSettings['multiple_amount'].'');
                        // }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is ' . currency . '' . $siteSettings['minimum_withdraw']);
                    }
                    //  }else{
                    //         $this->session->set_flashdata('message', 'ERROR:: Invaild OTP!');
                    //     }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }




    public function matchingWithdraw()
    {
        //die('this page is accessable');
        if (is_logged_in()) {
            $response['title'] = "Matching Withdraw";
            $response['des'] = "Minimum Transfer Amount $200";
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('credit_type', 'Credit in', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (type = "matching_bonus" OR type = "direct_sponsor_income" OR type ="matching_withdraw")', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 200) {
                        if ($withdraw_amount % 10 == 0) {
                            if ($balance['balance'] >= $withdraw_amount) {
                                if ($user['master_key'] == $master_key) {
                                    // if($kyc_status['kyc_status'] == 2){
                                    $DirectIncome = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => -$withdraw_amount,
                                        'type' => 'matching_withdraw',
                                        'description' => 'Withdrawal Amount ',
                                    );
                                    $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                    if ($data['pin_transfer'] == 0) {
                                        $withdrawArr = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => $withdraw_amount,
                                            'type' => 'matching_withdraw',
                                            'tds' => $withdraw_amount * 0 / 100,
                                            'admin_charges' => $withdraw_amount * 10 / 100,
                                            'fund_conversion' => 0,
                                            'payable_amount' => $withdraw_amount - ($withdraw_amount * 10 / 100),
                                            'credit_type' => $data['credit_type'],
                                        );
                                        $this->User_model->add('tbl_withdraw', $withdrawArr);
                                    } else {
                                        // $fund_converstion = $withdraw_amount * 45 /100;
                                        // $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                        // $withdrawArr['type'] = 'direct_income' ;
                                        // $withdrawArr['amount'] = $withdraw_amount;
                                        // $withdrawArr['admin_charges'] = $withdraw_amount * 10 /100;
                                        // $withdrawArr['fund_conversion'] = $withdraw_amount * 45 /100;
                                        // $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 /100;
                                        // $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];
                                        // $this->User_model->add('tbl_withdraw', $withdrawArr);
                                        $walletArr = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => $withdraw_amount * 90 / 100,
                                            'type' => 'direct_income_withdraw',
                                            'remark' => 'fund generated from direct income withdraw',
                                            'sender_id' => $this->session->userdata['user_id'],
                                        );
                                        $this->User_model->add('tbl_wallet', $walletArr);
                                    }
                                    $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'Please Complete your Kyc before withdrawal amount');
                                    // }
                                } else {
                                    $this->session->set_flashdata('message', 'Invalid Master Key');
                                }
                            } else {
                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of $10');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is $200');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (type = "matching_bonus" OR type = "direct_sponsor_income" OR type ="matching_withdraw")', 'ifnull(sum(amount),0) as balance');
            $this->load->view('direct_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function app_fund_transfer($me_id, $amount, $sender_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/receiveMoneyFromSite",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('me_id' => $me_id, 'amount' => $amount, 'sender_id' => $sender_id),
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function get_app_user($user_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://winto.in/MobileApp/Money_transfer/validate_user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('user_id' => $user_id),
            CURLOPT_HTTPHEADER => array(),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function TaskIncomeWithdraw()
    {
        die('this page is accessable');
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // $user_id = $data['user_id'];
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $withdraw_amount = $this->input->post('amount');
                    // $winto_user_id = $this->input->post('user_id');
                    $master_key = $this->input->post('master_key');
                    $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and (type = "task_income" or  type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
                    if ($withdraw_amount >= 200) {
                        if ($balance['balance'] >= $withdraw_amount) {
                            if ($user['master_key'] == $master_key) {
                                $DirectIncome = array(
                                    'user_id' => $this->session->userdata['user_id'],
                                    'amount' => -$withdraw_amount,
                                    'type' => 'task_income_withdraw',
                                    'description' => 'Task income Withdraw ',
                                );
                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                if ($data['pin_transfer'] == 0) {
                                    $withdrawArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount,
                                        'type' => 'task_income',
                                        'tds' => $withdraw_amount * 5 / 100,
                                        'admin_charges' => $withdraw_amount * 10 / 100,
                                        'fund_conversion' => 0,
                                        'payable_amount' => $withdraw_amount - ($withdraw_amount * 15 / 100)
                                    );
                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                } else {
                                    $fund_converstion = $withdraw_amount * 45 / 100;
                                    $withdrawArr['user_id'] = $this->session->userdata['user_id'];
                                    $withdrawArr['type'] = 'task_income';
                                    $withdrawArr['amount'] = $withdraw_amount;
                                    $withdrawArr['admin_charges'] = $withdraw_amount * 10 / 100;
                                    $withdrawArr['fund_conversion'] = $withdraw_amount * 45 / 100;
                                    $withdrawArr['tds'] = $withdrawArr['fund_conversion'] * 5 / 100;


                                    $withdrawArr['payable_amount'] = $withdrawArr['fund_conversion'] - $withdrawArr['tds'];

                                    $this->User_model->add('tbl_withdraw', $withdrawArr);
                                    $walletArr = array(
                                        'user_id' => $this->session->userdata['user_id'],
                                        'amount' => $withdraw_amount * 45 / 100,
                                        'type' => 'task_income_withdraw',
                                        'remark' => 'fund generated from direct income withdraw',
                                        'sender_id' => $this->session->userdata['user_id'],
                                    );
                                    $this->User_model->add('tbl_wallet', $walletArr);
                                }
                                $this->session->set_flashdata('message', 'Withdraw Requested     Successfully');
                                // $app_response = $this->app_fund_transfer($winto_user_id , ($withdraw_amount * 90 / 100) , $user['user_id']);
                                // $app_response = json_decode($app_response,true);
                                // if($app_response['success'] == 1){
                                //     $DirectIncome = array(
                                //         'user_id' => $this->session->userdata['user_id'],
                                //         'amount' => - $withdraw_amount ,
                                //         'type' => 'direct_income_withdraw',
                                //         'description' => 'Amount WIthdraw in Winto Account for User'.$winto_user_id,
                                //     );
                                //     $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                //     $this->session->set_flashdata('message', 'Amount Withdrawal Successfully');
                                // }else{
                                //     $this->session->set_flashdata('message', $app_response['message']);
                                // }
                            } else {
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Insuffcient Balance');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is Rs 200');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and (type = "task_income" or type = "task_income_withdraw" or type = "task_level_income")', 'ifnull(sum(amount),0) as balance');
            $this->load->view('task_income_withdraw', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function CookieBasedTracking()
    {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->count_cookies($this->session->userdata['user_id']);
            $this->load->view('cookie_based_tracking', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function withdraw_history()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Withdraw Summary';
            $response['transactions'] = $this->User_model->get_records_desc('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('transaction_history', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function tds_charges()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'TDS Charges';
            $response['transactions'] = $this->User_model->get_records('tbl_withdraw', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('tds_charges', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }



    public function forgot_password()
    {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $user = $this->User_model->get_single_record('tbl_users', ' user_id = "' . $data['user_id'] . '" or email = "' . $data['user_id'] . '"', 'name,user_id,email,password,master_key,phone');
            if (!empty($user)) {
                // $sms_text = 'Dear ' . $user['name'] . '. Your Account Successfully created. User ID : ' . $user['user_id'] . '. Password :' . $user['password'] . '. Transaction Password:' . $user['master_key'] . '. ' . base_url() . '';
                // notify_sms($user['user_id'], $sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');

                $message = "Dear " . $user['name'] . ' your User ID ' . $user['user_id'] . '  password for Your Accountt is ' . $user['password'] . ' Transaction Password ' . $user['master_key'];
                $response['message'] = 'Account Detail Sent on Your Email Please check';
                $this->send_email($user['email'], 'Security Alert', $message);
                $sms_text = 'Dear ' . $user['name'] . '. Your Account Successfully created. User ID : ' . $user['user_id'] . '. Password :' . $user['password'] . '. Transaction Password:' . $user['master_key'] . '. ' . base_url() . '';
                $email_message = '<div style=\' box-shadow:0px 0px 10px #000; padding:10px;border:1px #f5f5f5 solid; border-radius:6px; margin:10px;  \'> <img style=\'max-width:200px;margin: 0;border-radius: 10px;\' src='.base_url('uploads/logo.png').'>'.'<br><p \'font-weight:500;font-size:15px;\'> Dear ' . $user['name'] . ', Your Account Successfully created. <br>User Name :  ' . $user['name'] . ' <br>'.'User ID :  ' . $user['user_id'] .' <br> Password :' . $user['password'] . ' <br> Transaction Password:' . $user['master_key'].'</p></div>';
                
                // composeMail($user['email'], 'Account Info', $email_message, $display = false);
                composeMail($user['email'], 'Account Info', $email_message);
                $sms_text ='Dear '.$user['name'].' you are successfully registered Your id : '.$user['user_id'].' and password is '.$user['password'].' and transaction password is '.$user['master_key'].' Website: https://growmoney.me omkarent';
     
                notifySms($user['user_id'], $sms_text,'OMENTO');
                
                // send_crypto_email2($user['email'],"Security Alert",$sms_text);
                // notify_user($user['user_id'] , $message);
                $this->session->set_flashdata('message', 'Password Sent On Your Registered Phone Number or Email.');
            } else {
                $this->session->set_flashdata('message', 'Invalid User ID');
            }
        }
        $this->load->view('forgot_password', $response);
    }

    public function test()
    {
        $user = $this->User_model->get_single_record('tbl_users', ' user_id = "' . $data['user_id'] . '" or email = "' . $data['user_id'] . '"', 'name,user_id,email,password,master_key,phone');

        $sms_text = 'Dear ' . $userData['name'] . '. Your Account Successfully created. User ID : ' . $userData['user_id'] . '. Password :' . $userData['password'] . '. Transaction Password:' . $userData['master_key'] . '. ' . base_url() . '';

        notify_sms($userData['user_id'], $sms_text, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');
    }

    public function send_email($email, $subject, $message)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('email');
        $this->email->from('info@tradebtc.us', 'Trade BTC');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }



    public function user_m(Type $var = null)
    {
        $users = $this->User_model->get_records('user', ['user_id !=' => 'SDC511313'], '*');
        foreach ($users as $key => $user) {
            if ($user['status'] == 'Active') {
                $paid_status = 1;
                $package_amount = 450;
                $package_id = 1;
                $topup_date = $user['topup_date'];
                $exp_date = $user['ex_date'];
            } else {
                $paid_status = 0;
                $package_amount = 0;
                $package_id = 0;
                $topup_date = '0000-00-00 00:00:00';
                $exp_date = '0000-00-00';
            }
            $data = [
                'user_id' => $user['user_id'],
                'password' => $user['password'],
                'sponser_id' => $user['sponser_id'],
                'name' => $user['name'],
                'phone' => $user['phone'],
                'email' => $user['email'],
                'paid_status' => $paid_status,
                'package_amount' => $package_amount,
                'package_id' => $package_id,
                'created_at' => $user['created_at'],
                'topup_date' => $topup_date,
                'exp_date' => $exp_date,
            ];

            $this->User_model->add('tbl_users', $data);

            $bank_details = [
                'user_id' => $user['user_id'],
                'bank_name' => $user['bank_name'],
                'bank_account_number' => $user['bank_ac'],
                'ifsc_code' => $user['ifsc'],
                'gpay' => $user['gpay'],
                'paytm' => $user['paytm'],
                'ppay' => $user['ppay'],
            ];

            $this->User_model->add('tbl_bank_details', $bank_details);

            if ($paid_status > 0) {
                $coin = [
                    'user_id' => $user['user_id'],
                    'amount' => 1000,
                    'type' => 'coin_income',
                    'description' => 'SDC Coin from Activation of Member ' . $user['user_id'],
                    'created_at' => $user['created_at'],
                ];

                $this->User_model->add('tbl_coin_wallet', $coin);
            }

            $this->add_counts($user['user_id'], $user['user_id'], 1);
            $this->add_sponser_counts($user['user_id'], $user['user_id'], $level = 1);

            pr($data);
        }
    }

    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level)
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

    function add_sponser_counts($user_name = 'DW56497', $downline_id = 'DW56497', $level)
    {
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'sponser_id,user_id');
        if ($user['sponser_id'] != '') {
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


    public function update_directs(Type $var = null)
    {
        $users = $this->User_model->get_records('tbl_users', ['paid_status >' => 0], '*');
        foreach ($users as $key => $user) {
            $directs = $this->User_model->get_single_record('tbl_users', ['paid_status >' => 0, 'sponser_id' => $user['user_id']], 'count(id) as directs');
            $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['directs' => $directs['directs']]);
            pr($directs);
        }
    }


    public function withdraw_dd(Type $var = null)
    {
        $users = $this->User_model->get_records('withdrwal', [''], '*');
        foreach ($users as $key => $user) {
            $user_id = $user['user_id'];
            $amount = $user['amount'];
            $admin_charges = $user['adm_amt'];
            $payable_amount = $user['f_amt'];
            $created_at = $user['r_date'];
            $status = $user['status'];
            $joloorderid = $user['order_id'];
            $beneficiaryid = $user['bank_ac'] . '_' . $user['ifsc'];
            if ($joloorderid == '') {
                $joloorderid = 0;
            }
            $debitIncome = [
                'user_id' => $user_id,
                'amount' => -$amount,
                'type' => 'bank_transfer',
                'description' => 'Bank Transfer',
                'created_at' => $created_at,
            ];
            $this->User_model->add('tbl_income_wallet', $debitIncome);

            $transactionArr = array(
                'user_id' => $user_id,
                'beneficiaryid' => $beneficiaryid,
                'amount' => $amount,
                'status' => $status,
                'joloorderid' => $joloorderid,
                'time' => '0',
                'desc' => '0',
                'orderid' => $joloorderid,
                'payable_amount' => $payable_amount,
                'tds' => 0,
                'admin_charges' => $admin_charges,
                'created_at' => $created_at,
            );
            $this->User_model->add('tbl_money_transfer', $transactionArr);
        }
    }
}
