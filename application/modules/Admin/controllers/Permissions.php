<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permissions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
    }

    public function index()
    {
        if (is_admin()) {
            $response['users'] = $this->Main_model->get_records('tbl_admin', ['role' => 'SA'], '*');
            $this->load->view('permission', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function accessDeined(){
        $this->load->view('accessDenied');
    }

    public function CreateSubAdmin()
    {
        if (is_admin()) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('email', 'E-Mail', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                // $this->form_validation->set_rules('type','Type','trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $user = $this->Main_model->get_single_record('tbl_admin', ['user_id' => $data['user_id']], 'name');
                    if (empty($user)) {
                        $userdata = [
                            'user_id' => $data['user_id'],
                            'password' => $data['password'],
                            'role' => $data['type'],
                            'email' => $data['email'],
                            'name' => $data['name'],
                            'role' => 'SA',
                        ];
                        $this->Main_model->add('tbl_admin', $userdata);
                        $this->session->set_flashdata('message', 'User Created Successfully');
                        redirect('Admin/Permissions/CreateSubAdmin');
                    } else {
                        $this->session->set_flashdata('message', 'User ID Already Exists');
                    }
                } else {
                    $this->session->set_flashdata('message', validation_errors());
                }
            }
            $this->load->view('addUser');
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ChangePermission($user_id)
    {
        if (is_admin()) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $access = json_encode($data);
                // pr($access,true);
                $res = $this->Main_model->update('tbl_admin', ['user_id' => $user_id], ['access' => $access]);
                if ($res) {
                    $this->session->set_flashdata('message', '<h3 style="color:green">Permission Updated successfully</h3>');
                } else {
                    $this->session->set_flashdata('message', '<h3 style="color:red">Network error,Please try later</h3>');
                }
            }
            $users = $this->Main_model->get_single_record('tbl_admin', ['user_id' => $user_id], 'access');
            // pr($users['access']);
            $response['access'] = json_decode($users['access'], true);
            // pr($response,true);   
            $response['user_id'] = $user_id;
            $this->load->view('changePermission', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function deleteUser($id)
    {
        if (is_admin()) {
            $checkUser = $this->Main_model->get_single_record('tbl_admin', ['id' => $id], '*');
            if (!empty($checkUser)) {
                $this->Main_model->delete('tbl_admin', $id);
                redirect('Admin/Permissions');
            } else {
                die('Server Issue');
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function edit($id)
    {
        if (is_admin()) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                // $this->form_validation->set_rules('user_id','User ID','trim|required');
                $this->form_validation->set_rules('password', 'Name', 'trim|required');
                if ($this->form_validation->run() != FALSE) {
                    $pass = ['password' => $data['password']];
                    $this->Main_model->update('tbl_admin', ['id' => $id], $pass);
                    $this->session->set_flashdata('message', '<h3 style="color:green">Password Updated successfully</h3>');
                    redirect('Admin/Permissions/');
                } else {
                    $this->session->set_flashdata('message', '<h3 style="color:red">Network error,Please try later</h3>');
                }
            }
            $response['user'] = $this->Main_model->get_single_record('tbl_admin', ['id' => $id], 'user_id');
            $this->load->view('edit_subadmin', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function check()
    {
        // $this->load->library('controllerlist');
        $list = $this->controllerlist->setControllerMethods('Management', 'index');
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        $get = get_class_methods('check');
        pr($get);
        pr($controller);
        pr($method);
        pr($list);
    }


    public function access()
    {
        $this->load->view('accessDenied');
        //  $this->load->helper('file');
        //  $controllers = get_filenames( APPPATH . 'modules/Admin/controllers/' ); 

        // foreach( $controllers as $k => $v )
        // {
        //     if( strpos( $v, '.php' ) === FALSE)
        //     {
        //     // die('here');

        //         unset( $controllers[$k] );
        //     }
        //     // pr($v);
        // }

        // echo '<ul>';
        //         // die;

        // foreach( $controllers as $controller )
        // {
        //     echo '<li>' . str_replace( '.php', '',$controller) . '<ul>';
        //     $class = str_replace( '.php', '',$controller);

        //     include_once APPPATH . 'modules/Admin/controllers/' . $controller;

        //     $methods = get_class_methods( str_replace( '.php', '', $controller ) );
        //     // $method=[];
        //     // $aUserMethods[]p
        //     // if($methods  != '__construct'){
        //     foreach( $methods as $method )
        //     {
        //         // if($method != '__construct' && $method != 'get_instance') {
        //         //             $aUserMethods[] = $method;
        //         //         }
        //         // pr($method);
        //         if($methods != '__construct' && $methods != 'get_instance'){
        //             $arry = array($class => $method);
        //             pr($arry);
        //         }
        //             // echo '<li>' . $method . '</li>';
        //     }
        // // }
        //     echo '</ul></li>';
        // }

        // echo '</ul>'; 
    }
}
