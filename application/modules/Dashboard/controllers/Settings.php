<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Shopping_model','User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email'));
    }

    public function index() {
        if (is_logged_in()) {
            $response['products'] = $this->Shopping_model->get_product();
            $this->load->view('Shopping/products', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function epins($status = '') {
        if (is_logged_in()) {
            if($status == 0){
                $response['header'] = 'Unused Epins';
            }
            if($status == 1){
                $response['header'] = 'Used Epins';
            }
            if($status == 2){
                $response['header'] = 'Transfered Epins';
            }
            if($status == 3){
                $response['header'] = 'Epins History';
            }
            if ($status < 3) {
                $where = array('user_id' => $this->session->userdata['user_id'], 'status' => $status);
            } else {
                $where = array('user_id' => $this->session->userdata['user_id']);
            }
            $response['records'] = $this->Shopping_model->get_records('tbl_epins', $where, '*');
            $response['header'] = 
            $this->load->view('epins_list', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function transfer_epins() {
        if (is_logged_in()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('epins', 'Epins', 'trim|required|numeric|xss_clean');
                $this->form_validation->set_rules('amoun', 'Amount', 'trim|xss_clean');
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id,phone');
                    $master_key = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), 'user_id,phone,master_key,password');
                    if ($master_key['password'] == $data['password']) {
                        if (!empty($user)) {
                            // if($data['amount'] % 100 == 0){      
                                $available_pins = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0,'amount >=' => $data['amount']), 'ifnull(count(id),0) as total_epins');
                                if ($data['epins'] > 0) {
                                    if ($data['epins'] <= $available_pins['total_epins']) {
                                        for ($i = 1; $i <= $data['epins']; $i++) {
                                            $pin = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0,'amount >=' => $data['amount']), '*');
                                            $this->User_model->update('tbl_epins', array('id' => $pin['id']), array('status' => 2, 'used_for' => $data['user_id']));
                                            $packArr = array(
                                                'user_id' => $data['user_id'],
                                                'epin' => $this->generate_pin(),
                                                'amount' => $pin['amount'],
                                                'sender_id' => $this->session->userdata['user_id'],
                                                // 'type' => $pin['type'],
                                            );
                                            // pr($packArr,true);
                                            $res = $this->User_model->add('tbl_epins', $packArr);
                                        $this->session->set_flashdata('message', '<span class="text-success">Pin transferred Successfully</span>'); 

                                        }
                                    }else{
                                        $this->session->set_flashdata('message', 'You have insufficient pin to transfer'); 
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Please Set Atleast 1 Pin');
                                }
                            // }else{
                            //     $this->session->set_flashdata('message', 'Please Enter Valid Amount');
                            // }    
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    } else {
                        $this->session->set_flashdata('message', 'Invalid Password');
                    }
                }
            }
            $response['header'] = 'Transfer Epin';
            $response['package'] = $this->User_model->get_records('tbl_package',array(),'*');
            $response['available_epins'] = $this->User_model->get_single_record('tbl_epins', array('user_id' => $this->session->userdata['user_id'], 'status' => 0), 'ifnull(count(id),0) as total_epins');
            $this->load->view('transfer_epin', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

     public function generate_pin() {
        if (is_logged_in()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->User_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }

    public function SendSmsUser() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('send_sms_user', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function SendYoutubeUser() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('send_youtube_user', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function BusinessPlan() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('businesss-plan', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function PurchaseCourse() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('purchase_course', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function PurchaseSite() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('purchase_site', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    } 
    public function OnlineShopping() {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('online_shopping', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function payout_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->payout_summary();
            foreach($response['records'] as $key => $record){
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'date(created_at) = "'.$record['date'].'" and user_id = "'.$this->session->userdata['user_id'].'" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet'," amount > '0' Group by type",'type');
            //pr($response,true);
            $this->load->view('payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function week_payout_summary() {
        if (is_logged_in()) {
            $response = array();
            $response['records'] = $this->User_model->week_summary();
            foreach($response['records'] as $key => $record){
                //
                $incomes = $this->User_model->get_incomes('tbl_income_wallet', 'WEEK(created_at)%MONTH(created_at)+1 = "'.$record['date'].'" and user_id = "'.$this->session->userdata['user_id'].'" and amount > 0', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            $response['type'] = $this->User_model->get_records('tbl_income_wallet'," amount > '0' Group by type",'type');
            $this->load->view('week_payout_summary', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function weekWisePayout($date = '') {
        if (is_logged_in()) {
            $response['header'] = 'Week Payout Summary';
            // $config['base_url'] = base_url() . 'Dashboard/Settings/incomeLedgar';
            // $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(count(id),0) as sum');
            // $config ['uri_segment'] = 4;
            // $config['per_page'] = 100;
            // $this->pagination->initialize($config);
            // $segment = $this->uri->segment(4);
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'week(created_at)+1 = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', 'week(created_at)+1 = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', '*');
            //$response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function dateWisePayout($date = '') {
        if (is_logged_in()) {
            $response['header'] = 'Datewise Payout Summary';
            // $config['base_url'] = base_url() . 'Dashboard/Settings/incomeLedgar';
            // $config['total_rows'] = $this->User_model->get_sum('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(count(id),0) as sum');
            // $config ['uri_segment'] = 4;
            // $config['per_page'] = 100;
            // $this->pagination->initialize($config);
            // $segment = $this->uri->segment(4);
            $response['total_income'] = $this->User_model->get_single_record('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', 'ifnull(sum(amount),0) as total_income');
            $response['user_incomes'] = $this->User_model->get_records('tbl_income_wallet', 'date(created_at) = "'.$date.'" and user_id = "'.$this->session->userdata['user_id'].'"', '*');
            //$response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }
    public function welcomeLetter(){
        if(is_logged_in()){
            $response['userData'] = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userdata['user_id']],'*');
            $response['userinfo'] = $this->User_model->get_single_record('tbl_bank_details',['user_id' => $this->session->userdata['user_id']],'*');
            $this->load->view('welcome_letter',$response);
        }else{
            redirect('Dashboard/User/login');
        }
    }
}
