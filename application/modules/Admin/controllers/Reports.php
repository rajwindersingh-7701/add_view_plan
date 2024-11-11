<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination', 'Excel'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        if (is_admin() === false) {
            redirect('Admin/Management/logout');

        }
    }

    public function ippopayTransaction() {
        if (is_admin()) {
            $response['header'] = 'Ippo pay Transactions';
            $where = ['transaction_id !=' => ''];
            $config['base_url'] = base_url() . 'Admin/Reports/ippopayTransaction/';
            $config['total_rows'] = $this->Main_model->get_sum('ippo_transaction',$where, 'ifnull(count(id),0) as sum');
            $config ['uri_segment'] = 4;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('ippo_transaction', $where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('ippo_transaction', $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $this->load->view('ippopayTransaction', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


       public function activeUsers() {
        if (is_admin()) {
            $response['header'] = 'Activate Users';

            $response['users'] = $this->Main_model->get_records('tbl_epins',['used_for !=' => ''], '*');
            foreach ($response['users'] as $key => $value) {
               $response['users'][$key]['userinfo'] = $this->Main_model->get_single_record('tbl_users',['user_id' => $value['used_for']],'*');
            }
            $this->load->view('activeUsers', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function pagination($table, $where, $select, $base_url, $segment, $per_page)
    {
        $config['total_rows'] = $this->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
        $config['base_url'] = base_url($base_url);
        $config['suffix'] = '?' . http_build_query($_GET);
        $config['uri_segment'] = $segment;
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
        $records = $this->Main_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
        $response = ['records' => $records, 'segment' => $segment, 'path' => $config['base_url']];
        return $response;
    }


    public function incomeHistory()
    {
        if (is_admin() === false) {
            redirect('Admin/Management/login');

        }
        $response['header'] = 'Income History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = 'description = "Income Credit by Admin" OR description = "Income Debit by Admin"';
        if (!empty($type)) {
            // $where = [$type => $value];
            $where = $type.'="'.$value.'" AND (description ="Income Credit by Admin" OR description ="Income Debit by Admin")';
        }
        // pr($where,true);
        $records = $this->pagination('tbl_income_wallet', $where, '*', 'Admin/Reports/incomeHistory', 4, 10);
        $response['path'] =  $records['path'];
        $response['field'] = '<div class="col-4">
                                  <select class="form-control" name="type">
                                      <option value="user_id" ' . $type . ' == "user_id" ? "selected" : "";?>
                                          User ID</option>
                                  </select>
                                </div>
                              <div class="col-4">
                                  <input type="text" name="value" class="form-control  float-right"
                                      value="' . $value . '" placeholder="Search">
                              </div>
                              <div class="col-4">
                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                              </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>

                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 

            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $user_id . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . $description . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report', $response);
    }

    public function BoosterTimerHistory()
    {
        if (is_admin() === false) {
            redirect('Admin/Management/login');

        }
        $response['header'] = 'Achieved Booster Timer History';
        $type = $this->input->get('type');
        $value = $this->input->get('value');
        $where = 'booster_status = 1';
        if (!empty($type)) {
            // $where = [$type => $value];
            $where = $type.'="'.$value.'" AND (booster_status =1)';
        }
        // pr($where,true);
        $records = $this->pagination('tbl_users', $where, '*', 'Admin/Reports/BoosterTimerHistory', 4, 10);
        $response['path'] =  $records['path'];
        $response['field'] = '<div class="col-4">
                                  <select class="form-control" name="type">
                                      <option value="user_id" ' . $type . ' == "user_id" ? "selected" : "";?>
                                          User ID</option>
                                  </select>
                                </div>
                              <div class="col-4">
                                  <input type="text" name="value" class="form-control  float-right"
                                      value="' . $value . '" placeholder="Search">
                              </div>
                              <div class="col-4">
                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                              </div>';
        $response['thead'] = '<tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>name</th>
                                <th>phone</th>
                                <th>email</th>
                                <th>Booster Status</th>
                                <th>Date</th>

                             </tr>';
        $tbody = [];
        $i = $records['segment'] + 1;
        foreach ($records['records'] as $key => $rec) {
            extract($rec);
            if($rec['booster_status']==1){
                $timer = '<span class="badge badge-success">Achieved</span>';
            }elseif($rec['booster_status']==0){
                $timer = '<span class="badge badge-danger">Pending</span>';
            }else{
                $timer = '<span class="badge badge-danger">Pending</span>';

            }
            // $button =  form_open().form_hidden('orderID',$order_id).form_submit(['type' => 'submit','class' => 'btn btn-success','value' => 'Withdraw']); 

            $tbody[$key]  = ' <tr>
                                <td>' . $i . '</td>
                                <td>' . $user_id . '</td>
                                <td>' . $name . '</td>
                                <td>' . $phone . '</td>
                                <td>' . $email . '</td>
                                <td>' . $timer . '</td>
                                <td>' . $created_at . '</td>
                             </tr>';
            $i++;
        }
        $response['tbody'] = $tbody;
        $this->load->view('report', $response);
    }


   
}
?>