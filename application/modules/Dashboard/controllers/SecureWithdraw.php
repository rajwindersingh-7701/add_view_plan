<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class secureWithdraw extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        date_default_timezone_set('Asia/Kolkata');
        $this->api_token = JOLOKEY;
        // 723259102038669
        // $this->api_user_id = 'Demo';
    }

    public function index(){
    	echo ('undefined URL');
    }

    public function addBeneficiary(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'id,user_id,name,phone,netbanking,email');
            $beneficiaryCount = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), 'count(id) as ids');
            //     $response['status'] = 0;
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_mobile', 'Beneficiary Mobile', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_bank', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_branch', 'Beneficiary Bank Branch', 'trim|required|xss_clean');
                    // $this->form_validation->set_rules('verification_otp', 'OTP', 'trim|required|numeric|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        if(!empty($_SESSION['verification_otp']) && $data['verification_otp'] == $_SESSION['verification_otp']){
                    if($beneficiaryCount['ids'] < 1){
                            $beneficiary_account_no = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'beneficiary_account_no' => $data['beneficiary_account_no']), 'beneficiary_account_no');
                            //if(empty($beneficiary_account_no['beneficiary_account_no'])){
                                $add_beneficiary = array('user_id' => $this->session->userdata['user_id'], 'beneficiary_name' => $data['beneficiary_name'], 'beneficiary_account_no' => $data['beneficiary_account_no'], 'beneficiary_ifsc' => $data['beneficiary_ifsc'], 'beneficiary_mobile' => $response['user']['phone'], 'account_ifsc' => $data['beneficiary_account_no'].'_'.$data['beneficiary_ifsc'], 'beneficiary_bank' => $data['beneficiary_bank'], 'beneficiary_branch' => $data['beneficiary_branch']);
                                $run = $this->User_model->add('tbl_add_beneficiary', $add_beneficiary);
                                if($run){
                                    $this->session->set_flashdata('message', 'Beneficiary Added Successfully!');
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: While addeding Beneficiary!');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'ERROR:: This beneficiary is already added!');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'ERROR:: Invaild OTP!');
                        }
                    }
                }
            // }else{
            //     $response['status'] = 1;
            // }
            $this->load->view('addBeneficiary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function beneficiaryList(){
        if (is_logged_in()) {
            $response['beneficiary'] = $this->User_model->get_records('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('beneficiaryList', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    public function withdrawAmount($beneficiry_id){
        if (is_logged_in()) {

            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            $response['total_directs'] = $this->User_model->get_single_record('tbl_users', 'sponser_id = "'.$this->session->userdata['user_id'].'"and paid_status > "0"', 'count(id) as total_directs');
            $final_directs = $response['total_directs']['total_directs'];
            //$response['admin'] = $this->User_model->get_single_record('tbl_admin', array('user_id' => 'admin'), 'withdrawStatus as withdraw_status');
            //$response['pool'] = $this->User_model->get_single_record('tbl_pool1', 'user_id = "' . $this->session->userdata['user_id'] . '"', '*');
            $response['beneficiary_id'] = $beneficiry_id;
             $response['directs'] = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > "0" ', 'count(id) as ids');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // redirect('Dashboard/User');
            // die;
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                // $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
             $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    $checkBeneficary = $this->User_model->get_single_record('tbl_add_beneficiary', array('user_id' => $this->session->userdata['user_id'], 'account_ifsc' => $beneficiry_id), '*');
                    if(!empty($checkBeneficary)){
                        // if($data['otp'] == $_SESSION['verification_otp'] && !empty($_SESSION['verification_otp'])){
                            // $user_id = $data['user_id'];
                            $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                            $kyc_status = $this->User_model->get_single_record('tbl_bank_details', array('user_id' => $this->session->userdata['user_id']), '*');
                            $withdraw_amount = $this->input->post('amount');
                            // $winto_user_id = $this->input->post('user_id');
                            $master_key = $this->input->post('password');
                            $balance = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" AND type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
                            $directs = $this->User_model->get_single_record('tbl_users', ' sponser_id = "' . $this->session->userdata['user_id'] . '" AND paid_status > 0', 'count(id) as ids');
                            $today_money = $this->User_model->get_single_record('tbl_money_transfer', ' user_id = "' . $this->session->userdata['user_id'] . '" AND (status = "SUCCESS" OR status = "ACCEPTED") and date(created_at) = date(now())', '*');
                            if(empty($today_money)){
                                if ($withdraw_amount >= minWithdraw ) {
                                    if($withdraw_amount <= maxWithdraw){
                                        if($directs['ids'] >= 2 && $final_directs >= 2){
                                        if ($withdraw_amount % multiple	 == 0) {
                                            if ($balance['balance'] >= $withdraw_amount) {
                                                if ($user['password'] == $master_key AND $checkBeneficary['account_ifsc'] != '6244482379_IDIB000R072') {
                                                    if($user['package_amount'] > 100){
                                                        // if($kyc_status['kyc_status'] == 2){
                                                            // $transfer_amount = (round($data['amount'] * 85 / 100) - 10); // 10% IMPS charges including admin+tds
                                                            // $transfer_amount = (round($data['amount']));
                                                            $tds = ($data['amount']*tdsCharges/100);
                                                            $adminCharges = ($data['amount']*adminCharges/100);
                                                            $transfer_amount = round(($data['amount']*(100-(tdsCharges+adminCharges))/100));
                                                            $transfer_amount2 = round(($data['amount']*(100-(tdsCharges+adminCharges))/100));
                                                            $myorderid = $this->generate_order_id();
                                                            $ch = curl_init();
                                                            $timeout = 61;
                                                            $b = explode('_',$beneficiry_id);
                                                            $callBackUrl = base_url('Dashboard/SecureWithdraw/callBackUrl');
                                                            $paramList = array('apikey' => $this->api_token,'mobileno' => substr($checkBeneficary['beneficiary_mobile'],-10), 'beneficiary_account_no' => $checkBeneficary['beneficiary_account_no'], 'beneficiary_ifsc' => $checkBeneficary['beneficiary_ifsc'], 'amount' => $transfer_amount2, 'orderid' => $myorderid, 'purpose' => 'BONUS', 'remarks' => title, 'callbackurl' => $callBackUrl);
                                                            //print_r($paramList);
                                                            $jsondata = $this->curlSetup($paramList);
                                                            if(!empty($jsondata)){
                                                                if($jsondata['status'] != 'FAILED'){
                                                                    $DirectIncome = array(
                                                                            'user_id' => $this->session->userdata['user_id'],
                                                                            'amount' => - $withdraw_amount,
                                                                            'type' => 'bank_transfer',
                                                                            'description' => 'Bank Transfer',
                                                                        );
                                                                        $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                                    }

                                                                if($jsondata['status'] == 'ACCEPTED' || $jsondata['status'] == 'SUCCESS'){
                                                                    $transactionArr = array(
                                                                        'user_id' => $this->session->userdata['user_id'],
                                                                        'beneficiaryid' => $jsondata['beneficiaryid'],
                                                                        'amount' => $transfer_amount2,
                                                                        'status' => $jsondata['status'],
                                                                        'joloorderid' => $jsondata['txid'],
                                                                        'time' => $jsondata['time'],
                                                                        'desc' => $jsondata['desc'],
                                                                        'orderid' => $myorderid,
                                                                        'payable_amount' => $withdraw_amount,
                                                                        'tds' => $tds,
                                                                        'admin_charges' => $adminCharges,
                                                                    );
                                                                    $this->User_model->add('tbl_money_transfer', $transactionArr);
                                                                    $message = 'Dear '.$user['name'].' your withdrawal '.currency.''.$withdraw_amount.' have been successful deposit into your account by '.title.'. Thanks';
                                                                    //notify_user($this->session->userdata['user_id'],$message);
                                                                    notify_sms($this->session->userdata['user_id'], $message, $entity_id = '1201161518339990262', $temp_id = '1207161730102098562');
                                                                    // $this->session->set_flashdata('message', 'Transaction Completed Successfully');
                                                                    $this->session->set_flashdata('message', $jsondata['desc']);
                                                                }else{
                                                                    if($jsondata['error'] == 'Insufficient API balance'){
                                                                        $this->session->set_flashdata('message', 'Your Bank not responding . please try after 2 hrs!');
                                                                    }else{
                                                                        $this->session->set_flashdata('message', $jsondata['error']);
                                                                    }
                                                                }

                                                            }else{
                                                                $this->session->set_flashdata('message', 'Api Not Responding Please Try Again');
                                                                // $countxx="0";//fake
                                                            }
                                                    } else {
                                                        $this->session->set_flashdata('message', 'This Package is not eligible for withdraw!');
                                                    }
                                                } else {
                                                        $this->session->set_flashdata('message', 'Invaild Password!');
                                                    }
                                                    // }else{
                                                    //     $this->session->set_flashdata('message', 'You KYC is not approved,Please contact Admin');
                                                    // }
                                                
                                            } else {
                                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                                            }
                                        } else {
                                            $this->session->set_flashdata('message', 'Withdraw Amount is multiple of '.multiple);
                                        }
                                        } else {
                                            $this->session->set_flashdata('message', 'Withdraw Two direct required for withdraw amount!');
                                        }
                                    } else {
                                        $this->session->set_flashdata('message', 'Payment gateway is updating, Maximum withdrawal is ' .currency. ''.maxWithdraw);
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Minimum Withdrawal Amount is' .currency.''.minWithdraw);
                                }
                            }else{
                                $this->session->set_flashdata('message', 'You Can Withdraw Only Once in a Day');
                            }
                        // }else{
                        //     $this->session->set_flashdata('message', 'Please enter correct OTP');
                        // }
                    }else{
                        $this->session->set_flashdata('message', 'Beneficiary ID invalid');
                    }
                } else {
                    $this->session->set_flashdata('message', 'erorrrrr');
                }
            }
			$response['withdraw'] = 'Minimum Withdraw Amount '.currency.''.minWithdraw; //enter minimum amount here to display on front
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'round(ifnull(sum(amount),0),2) as balance');
            $this->load->view('withdrawAmount', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transferMoney(){
        if (is_logged_in()) {
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('otp', 'OTP', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $transferUser = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id'], 'paid_status >' => 0), 'id,user_id');
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
                    $sum = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount), 0) as balance');
                    $check = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'], 'type' => 'transfer_income', 'amount <=' => 0), 'count(id) as ids');
                    if($user['user_id'] != $transferUser['user_id']){
                        if(!empty($user['user_id'])){
                            if(!empty($transferUser['user_id'])){
                                if($data['master_key'] == $user['master_key']){
                                    // if($data['otp'] == $_SESSION['otp'] && !empty($_SESSION['otp'])){
                                   // if($check['ids'] == 0){
                                        if ($data['amount'] >= 200 && $data['amount'] <= 2000) {
                                            if($sum['balance'] >= $data['amount'] AND $data['amount'] > 0 AND $sum['balance'] >= 200){
                                                $debitIncome = ['user_id' => $this->session->userdata['user_id'], 'amount' => -$data['amount'], 'type' => 'transfer_income', 'description' => 'Transfer income to '.$transferUser['user_id'].''];
                                                $this->User_model->add('tbl_income_wallet', $debitIncome);
                                                $creditIncome = ['user_id' => $transferUser['user_id'], 'amount' => $data['amount'], 'type' => 'transfer_income', 'description' => 'Received income from '.$user['user_id'].''];
                                                $this->User_model->add('tbl_income_wallet', $creditIncome);
                                                $this->session->set_flashdata('message', 'Money Transfer Successfully.');
                                            }else {
                                                $this->session->set_flashdata('message', 'Insuffcient Balance');
                                            }
                                        }else {
                                            $this->session->set_flashdata('message', 'ERROR:: Transfer Amount is multiple of 200 & maximum 2000');
                                        }
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'ERROR:: Please try Tomorrow!');
                                    // }
                                    // }else{
                                    //     $this->session->set_flashdata('message', 'ERROR:: OTP not matched!');
                                    // }
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: Txn Password Not Matched!');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'ERROR:: Transfer User ID Not Found!');
                            }
                        }else{
                            $this->session->set_flashdata('message', 'ERROR:: Session ID not matched!');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'ERROR:: You can not transfer income to own ID!');
                    }
                }else {
                    $this->session->set_flashdata('message', 'ERROR:: Validation not matched!');
                }
            }
            $response['balance'] = $this->User_model->get_single_record('tbl_income_wallet', ' user_id = "' . $this->session->userdata['user_id'] . '" and type != "recharge_income"', 'ifnull(sum(amount),0) as balance');
            $this->load->view('transferAmount', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function generate_order_id() {
        $order_id = rand(100000000, 999999999);
        $order = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $order_id), 'orderid');
        if (!empty($order)) {
            return $this->generate_order_id();
        } else {
            return $order_id;
        }
    }


    private function curlSetup($paramList){
        if(!empty($paramList)){
            $apikey= $this->api_token;
            // $userid= $this->api_user_id;
            // $headerstring = "$userid|$apikey";
            // $hashedheaderstring = hash("sha512", $headerstring);
        	$paramLists = $paramList;
        	$payload = json_encode($paramLists, true);
        	$url = "http://13.127.227.22/freeunlimited/v3/transfer.php";
            // $url = "http://13.127.227.22/unlimited/v3/transfer.php";
        	$header= array('Content-Type:application/json');
        	$ch = curl_init($url);
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        	$response = curl_exec ($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	return json_decode($response, true);
        }
    }




    public function callBackUrl(){
        //status=SUCCESS&operatortxnid=9001110002&joloorderid=Z123456789012345&userorderid=TEST123456
        $data = array();
        $res = array();
        $data['status'] = $this->input->post('status');
        $data['operatortxnid'] = $this->input->post('operatortxnid');
        $data['joloorderid'] = $this->input->post('joloorderid');
        $data['userorderid'] = $this->input->post('userorderid');
        $res = $this->User_model->update('tbl_money_transfer', array('orderid' => $data['userorderid']), $data);
        if($res){
            if($data['status'] == 'FAILED'){
                $transaction = $this->User_model->get_single_record('tbl_money_transfer', array('orderid' => $data['userorderid']), '*');
                $DirectIncome = array(
                    'user_id' => $transaction['user_id'],
                    'amount' => $transaction['payable_amount'],
                    'type' => 'bank_transfer',
                    'description' => 'Failed Bank Transaction',
                );
                $this->User_model->add('tbl_income_wallet', $DirectIncome);
            }
            $res['status'] = 'SUCCESS';
            $res['message'] = 'Request Updated Successfully';
        }else{
            $res['status'] = 'FAILED';
            $res['message'] = 'Error While Updating Request';
        }
        echo json_encode($res);
    }


    public function getOtp()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $_SESSION['verification_otp'] = rand(100000, 999999);
                $this->session->mark_as_temp('verification_otp', 300);
                 // $message = 'Dear '.$user['name'].' your withdrawal '.currency.''.$withdraw_amount.' have been successful deposit into your account by '.title.'. Thanks';
                // $message = 'You OTP is : '.$this->session->userdata['verification_otp'].' (One Time Password), this otp expire in 2 mintues!';
                 $message = 'Dear User, Your OTP is '.$this->session->userdata['verification_otp'].' Never share this OTP with anyone, this OTP expire in two minutes. More Info : '.base_url().' From mlmsig';
                notify_sms($this->session->userdata['user_id'], $message, $entity_id = '1201161518339990262', $temp_id = '1207162142573795782');
                // notify_user($this->session->userdata['user_id'], $message);
                if($message){
                    $response['status'] = 1;

                }else{
                    $response['status'] = 0;
                }
            }
        }else{
            $response['status'] = 0;
        }

        echo json_encode($response);
    }



    ////////////// Telegram bot system for otp by (SK)

    public function getChatId($phone = '', $name= '')
    {

        // $payload = json_encode($paramLists, true);
        if(!empty($phone)){
                $url = "https://api.telegram.org/bot1646282469:AAHiWW-GqCoJiUGkRRVGXuK65x04wVWK7wY/sendContact?chat_id=1683640241&phone_number=+91".$phone."&first_name=".$name;
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                $response = curl_exec ($ch);
                $err = curl_error($ch);
                curl_close($ch);
                $data = json_decode($response, true);
            //pr($data);
            if(empty($data['result']['contact']['user_id'])){
                return false;
            }else{
                return $data['result']['contact']['user_id'];
            }
        }else{
            return false;
        }
    }


    public function getOtp2()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'GET') {
                $_SESSION['verification_otp'] = rand(100000, 999999);
                $this->session->mark_as_temp('verification_otp', 300);
                $message = $this->session->userdata['verification_otp'];
                $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'name,phone');
                $get = $this->getChatId($user['phone'], $user['name']);
                if($get){
                    $url = "https://api.telegram.org/bot1646282469:AAHiWW-GqCoJiUGkRRVGXuK65x04wVWK7wY/sendMessage?chat_id=" . $get;;
                    $url = $url . "&text=" . urlencode($message);
                    $ch = curl_init();
                    $optArray = array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true
                    );
                    curl_setopt_array($ch, $optArray);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $data = json_decode($result,true);
                    if(empty($data['error_code'])){
                        //pr($data['error_code']);
                        $response['status'] = 1;
                    }else{
                        $response['status'] = 0;
                    }
                }else{
                    $response['status'] = 0;
                }
            }
        }else{
            $response['status'] = 0;
        }

        echo json_encode($response);
    }

}