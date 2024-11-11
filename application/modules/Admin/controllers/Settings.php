<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index() {
        if (is_admin()) {
            $response['packages'] = $this->Main_model->get_records('tbl_package', array(), '*');
            $this->load->view('package_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function news() {
        if (is_admin()) {
            $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
            $this->load->view('news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deleteNews($id) {
        if (is_admin()) {
            $get = $this->Main_model->get_single_record('tbl_news', array('id' => $id), '*');
            if(!empty($get['id'])){
                $delete = $this->Main_model->delete('tbl_news', $id);
                if($delete){
                    $this->session->set_flashdata('message', 'News Deleted Successfully!');
                }else{
                    $this->session->set_flashdata('message', 'Request not found!');
                }
            }else{
                $this->session->set_flashdata('message', 'Invaild Request ID!');
            }
            redirect('/Admin/Settings/news');
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function ResetPassword(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $cpassword = $data['cpassword'];
                $npassword = $data['npassword'];
                $cnpassword = $data['cnpassword'];
                $user = $this->Main_model->get_single_record('tbl_admin', array('user_id' => 'secureadmin'), 'id,user_id,password');
                if ($npassword !== $cnpassword) {
                    // $response['message'] = 'Verify Password Doed Not Match';
                    $this->session->set_flashdata('message', 'Verify Password Does Not Match');
                } elseif ($cpassword !== $user['password']) {
                    // $response['message'] = 'Wrong Current Password';
                    $this->session->set_flashdata('message', 'Wrong Current Password');
                } else {
                    $updres = $this->Main_model->update('tbl_admin', array('user_id' =>  'secureadmin'), array('password' => $cnpassword));
                    if ($updres == true) {
                        // $response['message'] = 'Password Updated Successfully';
                        $this->session->set_flashdata('message', 'Password Updated Successfully');
                        $response['success'] = 1;
                    } else {
                        // $response['message'] = 'There is an error while Changing Password Please Try Again';
                        $this->session->set_flashdata('message', 'There is an error while Changing Password Please Try Again');
                    }
                }
                // $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                // $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                // if ($this->form_validation->run() != FALSE) {
                //     $UserData = array(
                //         'name' => $data['name'],
                //         'email' => $data['email'],
                //         'phone' => $data['phone'],
                //     );
                //     $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                //     if ($res == TRUE) {
                //         $this->session->set_flashdata('message', 'User Details Updated Successfully');
                //     } else {
                //         $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                //     }
                // }
            }
            $this->load->view('reset_password', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function EditUser($user_id) {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if($data['form_type'] == 'personal'){
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('leftPower', 'Left Power', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('rightPower', 'Right Power', 'trim|numeric|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'],
                            'leftPower' => $data['leftPower'],
                            'rightPower' => $data['rightPower'],
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'User Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Details Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'password'){
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'password' => $data['password']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Password Please Try Again ...');
                        }
                    }
                }elseif($data['form_type'] == 'master_key'){
                    $this->form_validation->set_rules('master_key', 'Transaction Password', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'master_key' => $data['master_key']
                        );
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Transaction Password Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Transaction Password Please Try Again ...');
                        }
                    }
                }else{
                    // pr($data,true);
                    $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('bank_account_number', 'Bank Account Number', 'trim|numeric|required|xss_clean');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('pan', 'Pan Number', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('aadhar', 'Aadhar Number', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {
                        $UserData = array(
                            'account_holder_name' => $data['account_holder_name'],
                            'bank_name' => $data['bank_name'],
                            'bank_account_number' => $data['bank_account_number'],
                            'ifsc_code' => $data['ifsc_code'],
                            'pan' => $data['pan'],
                            'aadhar' => $data['aadhar'],
                            // 'ethereum' => $data['ethereum'],
                            // 'litecoin' => $data['litecoin'],
                        );
                        $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id),$UserData);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'BANK Details Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Bank Details Please Try Again ...');
                        }
                    }
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
            $response['user']['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');
            $this->load->view('edit_user', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function UpdateRank(){
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('directs', 'Directs', 'trim|numeric|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), '*');
                    if(!empty($user)){
                        $res = $this->Main_model->update('tbl_users', array('user_id' => $data['user_id']),array('directs' => $data['directs']));
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', 'Rank Updated Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Rank  Please Try Again ...');
                        }
                    }else{
                        $this->session->set_flashdata('message', 'Invalid user');
                    }
                }
            }
            $this->load->view('update_rank', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function CreateNews() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->add('tbl_news', $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Added Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                }
            }
            $this->load->view('create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function editNews($id) {
        if (is_admin()) {
            $response = array();
            $response['news'] = $this->Main_model->get_single_record('tbl_news',array('id' => trim(addslashes($id))), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'title' => $data['title'],
                        'news' => $data['news'],
                    );
                    $res = $this->Main_model->update('tbl_news',array('id' => $id), $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'News Edit Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Creating News  Please Try Again ...');
                    }
                    redirect('Admin/Settings/editNews/'.$id);
                }
            }
            $this->load->view('edit_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function token_value() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $promoArr = array(
                    'amount' => $this->input->post('token_value'),
                ); 
                $res = $this->Main_model->update('tbl_token_value', array('id' => 1),$promoArr);
                if ($res) {
                    $this->session->set_flashdata('message', 'Token Update dSuccessfully');
                } else {
                    $this->session->set_flashdata('message', 'Error While Updating Token Please Try Again ...');
                }                
            }
            $response['token_value'] = $this->Main_model->get_single_record('tbl_token_value', array(), '*');
            // pr($response,true);
            $this->load->view('token_value', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function popup() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'doc|pdf|jpg|png';
                $config['file_name'] = 'am' . time();
                if($this->input->post('type') == 'image'){
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('media')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $promoArr = array(
                            'caption' => $this->input->post('caption'),
                            'media' => $data['upload_data']['file_name'],
                            'type' => 'image'
                        ); 
                        $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                        if ($res) {
                            $this->session->set_flashdata('message', 'Image Update Successfully');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                        }
                    }
                }else{
                    $promoArr = array(
                        'caption' => $this->input->post('caption'),
                        'media' => $this->input->post('media'),
                        'type' => 'video'
                    ); 
                    $res = $this->Main_model->update('tbl_popup', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Image Updated Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
                
            }
            $response['materials'] = $this->Main_model->get_records('tbl_popup', array(), '*');
            $this->load->view('popup', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }




    public function roiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
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
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function BoosterroiList() {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
                
            $where['booster_status'] = 1;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_roi', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Management/users';
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
            $response['records'] = $this->Main_model->get_limit_records('tbl_roi', $where, '*', $config['per_page'], $segment);

            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];

            $this->load->view('roi_list', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    // public function popup_upload() {
    //     if (is_admin()) {
    //         $response = array();
    //         if ($this->input->server('REQUEST_METHOD') == 'POST') {
    //             $data = $this->security->xss_clean($this->input->post());
    //             $data = html_escape($data);
    //             if ($data['type'] == 'image') {
    //                 if (!empty($_FILES['media']['name'])) {
    //                     $config['upload_path'] = './uploads/';
    //                     $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
    //                     $config['file_name'] = 'payment_slip';
    //                     $this->load->library('upload', $config);
    //                     if (!$this->upload->do_upload('media')) {
    //                         $this->session->set_flashdata('error', $this->upload->display_errors());
    //                     } else {
    //                         $fileData = array('upload_data' => $this->upload->data());
    //                         $fileData = array('upload_data' => $this->upload->data());
    //                         $userData['media'] = $fileData['upload_data']['file_name'];
    //                         $userData['type'] = 'image';
    //                         $userData['caption'] = $this->input->post('caption');
    //                         $updres = $this->Main_model->update('tbl_user_popup',['id' => 1],$userData);
    //                         if ($updres == true) {
    //                             $this->session->set_flashdata('error', 'Popup Uploaded Successfully');
    //                         } else {
    //                             $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
    //                         }
    //                     }
    //                 } else {
    //                     $this->session->set_flashdata('error', 'There is an error while uploading Popup Image, Please try Again ..');
    //                 }
    //             } 
    //         }
    //         $response['popup'] = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
    //         $response['user'] = 1;
    //         $this->load->view('popup.php', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }
     

    public function popupSetting(){
        if(is_admin()){
            $popup = $this->Main_model->get_single_record('tbl_user_popup',[],'*'); 
            if($popup['status'] == 0){
                $status = 1;
            }else{
                $status = 0;
            }
            $this->Main_model->update('tbl_user_popup',['id' => 1],['status' => $status]);
            redirect('Admin/Settings/popup_upload');
        }else{
            redirect('Admin/Management/login');
        }
    }

    public function site_settings(){
        if(is_admin()){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                if(!empty($data['withdraw_button'])){ $withdraw_button = 1; }else {  $withdraw_button =  0; }
                if(!empty($data['transfer_button'])){ $transfer_button = 1; }else {  $transfer_button =  0; }
                if(!empty($data['popup_on'])){ $popup = 1; } else { $popup =  0; }
                
                if (!empty($_FILES['image']['name'])) {
                    $config['upload_path'] = './uploads/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['file_name'] = 'popup'.time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('image')) {
                        $this->session->set_flashdata('message', $this->upload->display_errors());
                    } else {
                        $fileData = array('upload_data' => $this->upload->data());                      
                        $siteData = [
                            'company_name' => $data['company_name'],
                            'mobile' => $data['mobile'],
                            'email' => $data['email'],
                            'website' => $data['website'], 
                            'address' => $data['address'],
                            'popup' => $popup, 
                            'popup_image' => $fileData['upload_data']['file_name'],
                            'username' => $data['username'], 
                            'direct_income' => $data['direct_income'],
                            'matching_income' => $data['matching_income'],
                            'overriding' => $data['overriding'],
                            'minimum_withdraw' => $data['minimum_withdraw'],
                            'multiple_amount' => $data['multiple_amount'],
                            'maximum_withdraw' => $data['maximum_withdraw'],
                            'admin_charges' => $data['admin_charges'],
                            'minimum_transfer' => $data['minimum_transfer'],
                            'bank_charges' => $data['bank_charges'],
                            'tds_charges' => $data['tds_charges'],
                            'coin_payment_charges' => $data['coin_payment_charges'],
                            'withdraw_button' => $withdraw_button,
                            'transfer_button' => $transfer_button,
                        ];
                        $res = $this->Main_model->update('tbl_site_settings',['id' => '1'],$siteData);
                        if($res){
                            $this->session->set_flashdata('message','<div class="text-success">Setting updated successfully</div>');
                             redirect('Admin/Settings/site_settings');
                        }else{
                            $this->session->set_flashdata('message','Network error,please try later');
                        }
                    }
                }else{
                    $siteData = [
                        'company_name' => $data['company_name'],
                        'mobile' => $data['mobile'],
                        'email' => $data['email'],
                        'website' => $data['website'], 
                        'address' => $data['address'],
                        'popup' => $popup, 
                        'username' => $data['username'], 
                        'direct_income' => $data['direct_income'],
                        'matching_income' => $data['matching_income'],
                        'overriding' => $data['overriding'],
                        'minimum_withdraw' => $data['minimum_withdraw'],
                        'multiple_amount' => $data['multiple_amount'],
                        'maximum_withdraw' => $data['maximum_withdraw'],
                        'admin_charges' => $data['admin_charges'],
                        'minimum_transfer' => $data['minimum_transfer'],
                        'bank_charges' => $data['bank_charges'],
                        'tds_charges' => $data['tds_charges'],
                        'coin_payment_charges' => $data['coin_payment_charges'],
                        'withdraw_button' => $withdraw_button,
                        'transfer_button' => $transfer_button,
                    ];
                    $res = $this->Main_model->update('tbl_site_settings',['id' => '1'],$siteData);
                    if($res){
                        $this->session->set_flashdata('message','<div class="text-success">Setting updated successfully</div>');
                        redirect('Admin/Settings/site_settings');
                    }else{
                        $this->session->set_flashdata('message','Network error,please try later');
                    }
                }
            }
            $response['info']  =  $this->Main_model->get_single_record('tbl_site_settings',[],'*');
            $this->load->view('company.php',$response);

        }else{
            redirect('Admin/Management/login');
        }
    }



    public function CreateEpins() {
        if (is_admin()) {
            $response = array();
            $response['header'] = 'Create Epins';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
               // $this->session->set_flashdata('message', 'Please Wait');

                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('pin_count', 'Pin Count', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('pin_amount', 'Pin Amount', 'trim|numeric|required|xss_clean');
                $this->form_validation->set_rules('master_key', 'Txn Pin', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    // if($this->session->login_otp == $data['otp'] && !empty($this->session->login_otp)){
                        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['user_id']), 'user_id');
                        if (!empty($user)) {
                            $master_key = $this->Main_model->get_single_record('tbl_admin',[],'*');
                            if($master_key['master_key'] == $data['master_key']){
                                if($data['pin_amount'] == 499){
                                    $pin_count = $this->input->post('pin_count');
                                    for ($i = 1; $i <= $pin_count; $i++) {
                                        $packArr = array(
                                            'user_id' => $data['user_id'],
                                            'epin' => $this->generate_pin(),
                                            'amount' => $data['pin_amount']
                                        );
                                        $res = $this->Main_model->add('tbl_epins', $packArr);
                                    }
                                
                                    if ($res == TRUE) {
                                        //$this->session->unset_userdata(array('login_otp'));
                                        $this->session->set_flashdata('message', '<span class="text-success">Epins Generated Successfully!</span>');
                                    } else {
                                        $this->session->set_flashdata('message', 'Error While Generating Epins  Please Try Again ...');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', 'Please select vaild package!');
                                }
                            }else{
                                $this->session->set_flashdata('message', 'Invalid Master Key');
                            }
                        } else {
                            $this->session->set_flashdata('message', 'Invalid User ID');
                        }
                    // }else{
                    //     $this->session->set_flashdata('message', 'ERROR:: Invalid OTP!');
                        
                    // }
                }
            }
            $response['packages'] = $this->Main_model->get_records('tbl_package',['id' => 1],'id,title,price');
            $this->load->view('create_epins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function generate_pin() {
        if (is_admin()) {
            $epin = md5(rand(100000, 9999999));
            $pin = $this->Main_model->get_single_record('tbl_epins', array('epin' => $epin), '*');
            if (!empty($pin)) {
                return $this->generate_pin();
            } else {
                return $epin;
            }
        }
    }


    public function UsersEPins() {
        if (is_admin()) {
            $response = array();
            $response['header'] = 'User Epins';
            $response['user_pins'] = $this->Main_model->user_epins();
            foreach($response['user_pins'] as $key => $pin_user){
                $response['user_pins'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $pin_user['user_id']), 'name,phone');
            }
            $this->load->view('user_pins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function UnusedEpins() {
        if (is_admin()) {
            $response = array();
            $response['header'] = 'Unused Epins';
            $response['user_pins'] = $this->Main_model->user_epins(array('status' => 0));
            foreach($response['user_pins'] as $key => $pin_user){
                $response['user_pins'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $pin_user['user_id']), 'name,phone');
            }
            $this->load->view('user_pins', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function userPinView($user_id = '') {
        if (is_admin()) {
            $response = array();
            $response['header'] = 'User Epin View';
            $response['pins'] = $this->Main_model->get_records('tbl_epins', array('user_id' => $user_id), '*');
            $this->load->view('user_pin_view', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }








    public function franchise() {
        if (is_admin()) {
            $response['franchises'] = $this->Main_model->get_records('tbl_franchise', array(), '*');
            $this->load->view('franchise', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deletefranchise($id) {
        if (is_admin()) {
            $get = $this->Main_model->get_single_record('tbl_franchise', array('id' => $id), '*');
            if(!empty($get['id'])){
                $delete = $this->Main_model->delete('tbl_franchise', $id);
                if($delete){
                    $this->session->set_flashdata('message', 'News Deleted Successfully!');
                }else{
                    $this->session->set_flashdata('message', 'Request not found!');
                }
            }else{
                $this->session->set_flashdata('message', 'Invaild Request ID!');
            }
            redirect('Admin/Settings/franchise');
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function createfranchise() {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User Id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('phone', 'Mobile No.', 'trim|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {

                    $user = $this->Main_model->get_single_record('tbl_franchise', ['user_id' => $data['user_id']], '*');
                    if(empty($user)){
                        $packArr = array(
                            'user_id' => $data['user_id'],
                            'name' => $data['name'],
                            'city' => $data['city'],
                            'state' => $data['state'],
                            'phone' => $data['phone'],

                        );
                        $res = $this->Main_model->add('tbl_franchise', $packArr);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', '<span class="text-success">New Franchise Added Successfully!</span>');
                            redirect('Admin/Settings/franchise');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Creating Franchise, Please Try Again ...');
                        }
                    }else {
                        $this->session->set_flashdata('message', 'Franchise Id already exist!');
                    }
                }
            }
            $response['header'] = 'Create Franchise';
            $response['displays'] = 'franchise';
            $this->load->view('createfranchise', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function editnumber($id='') {
        if (is_admin()) {
            $response = array();
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                //if ($this->form_validation->run() != FALSE) {

                    $phone = $this->Main_model->get_single_record('tbl_site', ['id' => $id], '*');
                    // if(empty($user)){
                        $packArr = array(
                            'phone1' => $data['phone1'],
                            'phone2' => $data['phone2'],
                        );
                        // pr($packArr,true);
                        $res = $this->Main_model->update('tbl_site', ['id' => $id],$packArr);
                        if ($res == TRUE) {
                            $this->session->set_flashdata('message', '<span class="text-success">New Number Updated Successfully!</span>');
                            redirect('Admin/Settings/numberReport');
                        } else {
                            $this->session->set_flashdata('message', 'Error While Updating Number, Please Try Again ...');
                        }
                    // }else {
                    //     $this->session->set_flashdata('message', 'Franchise Id already exist!');
                    // }
                //}
            }
            $response['site'] = $this->Main_model->get_single_record('tbl_site', ['id' => $id], '*');

            $response['header'] = 'Update Number';
            $response['displays'] = 'number';
            $this->load->view('createfranchise', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deletenumber($id) {
        if (is_admin()) {
            $get = $this->Main_model->get_single_record('tbl_site', array('id' => $id), '*');
            if(!empty($get['id'])){
                $delete = $this->Main_model->delete('tbl_site', $id);
                if($delete){
                    $this->session->set_flashdata('message', 'Number Deleted Successfully!');
                }else{
                    $this->session->set_flashdata('message', 'Request not found!');
                }
            }else{
                $this->session->set_flashdata('message', 'Invaild Request ID!');
            }
            redirect('Admin/Settings/changeNumber');
        } else {
            redirect('Admin/Management/login');
        }
    }

   public function numberReport() {
        if (is_admin()) {
            $response['franchises'] = $this->Main_model->get_records('tbl_site', array(), '*');
            $this->load->view('changernumber', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


     public function benificaryHistory(){
        if(is_admin()){
           
             $field = $this->input->get('type');
            $value = $this->input->get('value');
            // $export = $this->input->get('export');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();
            // $response['total_income'] = $this->Main_model->get_sum('tbl_coin_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_add_beneficiary', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Settings/benificaryHistory/';
            $config['suffix'] = '?'.http_build_query($_GET);
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
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
            $response['records'] = $this->Main_model->get_limit_records('tbl_add_beneficiary', $where, '*', $config['per_page'], $segment);
            // foreach ($response['records'] as $key => $val) {
            //     $response['records'][$key]['total_income'] = $this->Main_model->sum('tbl_coin_wallet',$where,'ifnull(sum(amount),0) as total_income');
            // }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            $response['header'] = 'Beneficiary List';
            $this->load->view('Benificarylist',$response);
        }else{
            redirect('Admin/Management/login');
        }
    }

     public function Editbenificary($user_id) {
          if (is_admin()) {
        $response = array();
            $response['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'id,user_id,name,phone,netbanking,email,paid_status');
            $beneficiaryCount = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $user_id), 'count(id) as ids');
            // if($beneficiaryCount['ids'] <= 1){
            //     $response['status'] = 0;
                if ($this->input->server('REQUEST_METHOD') == 'POST') {
                    $data = $this->security->xss_clean($this->input->post());
                    $this->form_validation->set_rules('beneficiary_name', 'Beneficiary Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_account_no', 'Beneficiary Account Number', 'trim|required|numeric|xss_clean');
                    $this->form_validation->set_rules('beneficiary_ifsc', 'IFSC Code', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_mobile', 'Beneficiary Mobile', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_bank', 'Beneficiary Bank Name', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('beneficiary_branch', 'Beneficiary Bank Branch', 'trim|required|xss_clean');
                    if ($this->form_validation->run() != FALSE) {

                            $beneficiary_account_no = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $user_id, 'beneficiary_account_no' => $data['beneficiary_account_no']), 'beneficiary_account_no');
                            //if(empty($beneficiary_account_no['beneficiary_account_no'])){
                                $add_beneficiary = array('user_id' => $user_id, 'beneficiary_name' => $data['beneficiary_name'], 'beneficiary_account_no' => $data['beneficiary_account_no'], 'beneficiary_ifsc' => $data['beneficiary_ifsc'], 'beneficiary_mobile' => $data['beneficiary_mobile'], 'account_ifsc' => $data['beneficiary_account_no'].'_'.$data['beneficiary_ifsc'], 'beneficiary_bank' => $data['beneficiary_bank'], 'beneficiary_branch' => $data['beneficiary_branch']);
                                $run = $this->Main_model->update('tbl_add_beneficiary',['user_id' => $user_id], $add_beneficiary);
                                if($run){
                                    $this->session->set_flashdata('message', 'Beneficiary Updated Successfully!');
                                    redirect('Admin/Settings/benificaryHistory');
                                }else{
                                    $this->session->set_flashdata('message', 'ERROR:: While Updating Beneficiary!');
                                }

                    }else{
                         $this->session->set_flashdata('message', validation_errors());
                    }
                }
                 $response['request'] = $this->Main_model->get_single_record('tbl_add_beneficiary', array('user_id' => $user_id), '*');
            $this->load->view('Editbenificary', $response);
        
        } else {
            redirect('Admin/Management/login');
        }
   
}
public function qrcode() {
    if (is_admin()) {
        $response = array();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            // pr($_FILES,true);
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = 'qr' . time();
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload('qrcode')){
                    // $this->session->set_flashdata('message', $this->upload->display_errors());
                    $data = array('upload_data' => $this->upload->data());
                    // pr($data,true);
                    $promoArr = array(
                        'upi_id' => $this->input->post('upi_id'),
                    ); 
                    $res = $this->Main_model->update('tbl_qr_code', array('id' => 1),$promoArr);
                   
                    if ($res) {
                        $this->session->set_flashdata('message', 'Request Update Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $promoArr = array(
                        'upi_id' => $this->input->post('upi_id'),
                        'image' => $data['upload_data']['file_name'],
                    ); 
                    // pr($promoArr,true);
                    $res = $this->Main_model->update('tbl_qr_code', array('id' => 1),$promoArr);
                    if ($res) {
                        $this->session->set_flashdata('message', 'Request Update Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error While Adding Popup Please Try Again ...');
                    }
                }
           
            
        }
        $response['qrcode'] = $this->Main_model->get_single_record('tbl_qr_code', array('id' => 1), '*');
        $this->load->view('qrcode', $response);
    } else {
        redirect('Admin/Management/login');
    }
}

public function Request_fund() {
    if (is_logged_in()) {
        $response = array();
        $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
        
        $this->load->view('header', $response);
        $this->load->view('Fund/request_fund', $response);
    } else {
        redirect('Dashboard/User/login');
    }
}


}
 