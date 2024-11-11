<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->library(array('session', 'pagination'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user'));
    }

    public function report()
    {
        if (is_logged_in()) {
            $response = array();
            $response['header'] = '';
            $response['level'] = $this->User_model->levelReport(array('user_id' => $this->session->userdata['user_id']));
            $response['reports'] = $this->User_model->get_records('tbl_sponser_count', ['user_id' => $this->session->userdata['user_id']], '*');
            $this->load->view('static', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function ClubIncome()
    {
        if (is_logged_in()) {
            $response = array();
            $this->load->view('header');
            $this->load->view('clubIncome', $response);
            $this->load->view('footer');
        } else {
            redirect('Dashboard/User/login');
        }
    }

    public function activationHistory(){
        $response['header'] = 'Activation History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = ['user_id' => $this->session->userdata['user_id']];
        if(!empty($type)){
           $where=[$type => $value];
        }
        $records = $this->pagination('tbl_activation_details',$where,'*','Dashboard/Reports/activationHistory',4,10);
        $response['path'] =  $records['path'];
        $searchField = '<div class="col-4">
                            <select class="form-control" name="type">
                                <option value="name" '.$type.' == "name" ? "selected" : "";?>
                                    Name</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="value" class="form-control text-white float-right"
                                value="'.$value.'" placeholder="Search">
                        </div>
                        <div class="col-4">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>';
        $response['field'] = '';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>Activater ID</th>
                                <th>Package Amount</th>
                                <th>Date</th>
                             </tr>';
        $tbody = []; 
        $i = $records['segment'] +1; 
        $tokenValue = $this->User_model->get_single_record('tbl_token_value',['id' => 1],'amount');                  
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            
            $tbody[$key]  = ' <tr>
                                <td>'.$i.'</td>
                                <td>'.$activater.'</td>
                                <td>'.$package.'</td>
                                <td>'.$topup_date.'</td>
                             </tr>';
                             $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report',$response);
    }

    public function pagination($table,$where,$select,$base_url,$segment,$per_page){
        $config['total_rows'] = $this->User_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
        $config['base_url'] = base_url($base_url);
        $config['suffix'] = '?'.http_build_query($_GET);
        $config ['uri_segment'] = $segment;
        $config['per_page'] = $per_page;
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
        $segment = $this->uri->segment($segment);
        $records = $this->User_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
        $response=['records' => $records,'segment' => $segment,'path' => $config['base_url']];
        return $response;
    }
  
   
}
