<?php
    defined('BASEPATH') or exit('No direct script allowed');

    class SubAdmin extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
            $this->load->model(array('Main_model'));
            $this->load->helper(array('admin', 'security'));
            if(is_admin() === false){
                redirect('Admin/Management/logout');
                exit;
            }
        }

        public function index(){
            if($this->input->server("REQUEST_METHOD") == "POST"){
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id','User ID','trim|required');
                if($this->form_validation->run() === true){
                    $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'user_id,sub_admin');
                    if(!empty($checkUser['user_id'])){
                        if($checkUser['sub_admin'] == 0){
                            $this->Main_model->update('tbl_users',['user_id' => $data['user_id']],['sub_admin' => 1]);
                            redirect('Admin/SubAdmin/permissionUser/'.$data['user_id']);
                        } else {
                            $this->session->set_flashdata('message','<h5 class="text-danger">This User ID already as Sub Admin!</h5>');
                        }
                    } else {
                        $this->session->set_flashdata('message','<h5 class="text-danger">Invalid User ID!</h5>');
                    }
                }
            }
            $response['form'] = '<div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" class="form-control" name="user_id" value="'.set_value('user_id').'" id="user_id" placeholder="User ID"/>
                                    <span class="text-danger">'.form_error('user_id').'</span>
                                    <span id="errorMessage"></span>
                                </div> 
                                <div class="form-group">
                                    <button type="subimt" name="save" class="btn btn-success">Submit</button>
                                </div>';
            $response['header'] = 'Create Sub Admin';
            $this->load->view('form',$response);
        }

        public function permissionUser($user_id){
            $check = $this->Main_model->get_single_record('tbl_users',['user_id' => $user_id],'user_id,access');
            if(!empty($check['user_id'])){
                if($this->input->server("REQUEST_METHOD") == "POST"){
                    $data = $this->security->xss_clean($this->input->post());
                    $data['index'] = 'index';
                    $jsonData = json_encode($data);
                    $checkUser = $this->Main_model->get_single_record('tbl_users',['user_id' => $data['user_id']],'user_id');
                    if(!empty($checkUser['user_id'])){
                        $this->Main_model->update('tbl_users',['user_id' => $data['user_id']],['access' => $jsonData,'role' => 'SA']);
                        $this->session->set_flashdata('message','<h5 class="text-success">Permission updated successfully</h5>');
                        redirect('Admin/SubAdmin/permissionUser/'.$data['user_id']);
                    } else {
                        $this->session->set_flashdata('message','<h5 class="text-danger">Invalid User ID!</h5>');
                    }
                }
                $access = json_decode($check['access'],true);
                $checked = !empty($access['play_today_task'])? 'checked':'';
                $response['form'] = '<div class="form-group">
                                        <input type="hidden" name="user_id" value="'.$user_id.'"/>
                                        Play Task : <input type="checkbox" name="play_today_task" value="play_today_task" '.$checked.'/>
                                    </div> 
                                    <div class="form-group">
                                        <button type="subimt" name="save" class="btn btn-success">Update</button>
                                    </div>';
                $response['header'] = 'User Permission';
                $this->load->view('form',$response);
            } else {
                redirect('Admin/Management/logout');
            }
        }

        public function subadminList(){
            $response['header'] = 'Sub Admin List';
            $response['users'] = $this->Main_model->get_records('tbl_users',['sub_admin' => 1],'user_id');
            $this->load->view('sub-admin-list',$response);
        }
    }
?>