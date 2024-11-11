<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
        $this->api_key = '';
        $this->api_user_id = '';
        
        
    }

    public function index() {
        if (is_logged_in()) {
            $response['wallet_balance'] = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['opreators'] = $this->User_model->get_records('tbl_opreators', array(), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|xss_clean|max_length[10]');
                $this->form_validation->set_rules('amount', 'Amount', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('master_key', 'Master Key', 'trim|required|xss_clean');
                $this->form_validation->set_rules('opreator', 'Opreator', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $get = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'master_key');
                    $get2 = $this->User_model->get_single_record('tbl_opreators', array('opreator' => $data['opreator']), 'count(id) as ids');
                    $get3 = $this->User_model->get_single_record('tbl_opreators', array('opreator' => $data['opreator']), '*');
                    if($data['master_key'] == $get['master_key']){
                        if($get2['ids'] > 0){
                            if($response['wallet_balance']['wallet_balance'] >= $data['amount']){
                                   $curlResponse = $this->curlRequest('https://joloapi.com/api/v1/recharge.php?userid='.$this->api_user_id.'&key='.$this->api_key.'&operator='.$data['opreator'].'&service='.$data['mobile'].'&amount='.$data['amount'].'&orderid='.rand('10000000', '99999999').'');
                                   if($curlResponse['status'] == 'FAILED'){
                                        $saveTrasaction = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'status' => $curlResponse['status'],
                                            'trasaction_id' => $curlResponse['txid'],
                                            'opreator_name' => $get3['opreator_name'],
                                            'phone' => $data['mobile'],
                                            'amount' => $data['amount'],
                                            'operator' => $data['opreator'],
                                            'operatorid' => $curlResponse['operatorid'],
                                            'balance' => $curlResponse['balance'],
                                            'margin' => $curlResponse['margin'],
                                            'duration' => $curlResponse['duration'],
                                            'created_at' => 'CURRENT_TIMESTAMP',
                                        );
                                        $this->User_model->add('tbl_recharge_transactions', $saveTrasaction);
                                        $this->session->set_flashdata('error', 'ERROR:: '.$curlResponse['error'].'!');
                                   }elseif($curlResponse['status'] == 'SUCCESS'){
                                        $incomeDeduction = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$data['amount'],
                                            'type' => 'recharge_income',
                                            'description' => 'Successfully Recharge, Mobile No '.$data['mobile'].'',
                                            'created_at' => 'CURRENT_TIMESTAMP',
                                        );
                                        $executeQurey = $this->User_model->add('tbl_income_wallet', $incomeDeduction);
                                        if($executeQurey){
                                            $saveTrasaction = array(
                                                'user_id' => $this->session->userdata['user_id'],
                                                'status' => $curlResponse['status'],
                                                'trasaction_id' => $curlResponse['txid'],
                                                'opreator_name' => $get3['opreator_name'],
                                                'phone' => $data['mobile'],
                                                'amount' => $data['amount'],
                                                'operator' => $data['opreator'],
                                                'operatorid' => $curlResponse['operatorid'],
                                                'balance' => $curlResponse['balance'],
                                                'margin' => $curlResponse['margin'],
                                                'duration' => $curlResponse['duration'],
                                                );
                                            $this->User_model->add('tbl_recharge_transactions', $saveTrasaction);
                                        }
                                        $this->session->set_flashdata('success', 'Recharge/Transaction Successful!');
                                   }
                            }else{
                                $this->session->set_flashdata('error', 'ERROR:: Insufficient account balance!');
                            }
                        }else{
                            $this->session->set_flashdata('error', 'ERROR:: Invailid Opreator Selected!');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'ERROR:: Transaction Password is not matched!');
                    }
                }else{
                     $this->session->set_flashdata('error', 'ERROR:: Server Request Not Found!');
                }

            }
            $this->load->view('prepaidRecharge', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function rechargeHistory() {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = 'Recharge History';
            $response['transactions'] = $this->User_model->get_records('tbl_recharge_transactions', array('user_id' => $this->session->userdata['user_id']), '*');
            $this->load->view('rechargeHistory', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }


    private function curlRequest($url){
        if(!empty($url)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        }
    }

    public function CallbackUrl(){
        $userData = [
            'status' => $_POST["status"],
            'operatortxnid' => $_POST["operatortxnid"],
            'joloorderid' => $_POST["joloorderid"],
            'userorderid' => $_POST["userorderid"],
            'servicetype' => $_POST["servicetype"],
            'error' => $_POST["error"],
        ];
        $this->User_model->add('rechargeCallBack',$userData);
    }

}
