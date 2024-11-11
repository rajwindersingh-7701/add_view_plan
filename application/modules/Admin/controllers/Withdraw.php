
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email', 'pagination'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('admin', 'security'));
        //        require_once( APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php');
        //        if (file_exists(APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php')) {
        //            echo'file exist';
        //        }
    }

    public function WithdrawHistory($status)
    {
        if (is_admin()) {
            $export = $this->input->get('export');
            $type = $this->input->get('type');
            $value = $this->input->get('value');
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $sumAmount = $this->Main_model->get_single_record('tbl_withdraw',['status' => 0 ],'ifnull(sum(amount),0)as total');

            if ($status  == 'Pending') {
                $response['header'] = ' Pending Withdrawal Request' .'(Amount :- '.$sumAmount['total'].')';
                $where = ['status' => 0];
            } elseif ($status == 'Approved') {
                $response['header'] = 'Approved Withdrawal Request';
                $where = ['status' => 1];
            } elseif ($status == 'Rejected') {
                $response['header'] =  ' Rejected Withdrawal Request';
                $where = ['status' => 2];
            } elseif ($status == 'allrequest') {
                $response['header'] = 'All Withdrawal Request';
                $where = [];
            } else {
                $response['header'] = 'Withdrawal Request';
                $where = [];
            }

            if (!empty($start_date)) {
                if ($status  == 'pending') {
                    $response['header'] = ' Pending Withdrawal Request';
                    $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" and admin_status = "0" OR admin_status = "1"';
                    // $where = ['status' => 0, $type => $value];
                } elseif ($status == 'approved') {
                    $response['header'] = 'Approved Withdrawal  Request';
                    // $where = ['status' => 1, $type => $value];
                    $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" and admin_status = "2"';
                } elseif ($status == 'rejected') {
                    $response['header'] =  ' Rejected Withdrawal  Request';
                    // $where = ['status' => 2, $type => $value];
                    $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" and admin_status = "3"';
                } elseif ($status == 'allrequest') {
                    $response['header'] = 'All Withdrawal Request';
                    $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" and admin_status != "4"';
                    // $where = [$type => $value];
                } else {
                    $response['header'] = 'Withdrawal Request';
                    $where = [$type => $value];
                }
            }
            $response['status_check'] = $status;

            $records = pagination('tbl_withdraw', $where, '*', 'Admin/Withdraw/WithdrawHistory/' . $status, 5, 10);
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone', 'Amount', 'Deductions', 'Payable Amount',  'Type', 'Status', 'Bank Name', 'Bank Account Number', 'Account Holder Name ', 'IFSC Code', 'Remark', 'Request Date'];
                $usersss = get_records('tbl_withdraw', array(''), '*');
                foreach ($usersss as $key => $request) {
                    $user = get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,sponser_id,email,phone');
                    $bank = get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');

                    $records_export[$key]['i'] = ($key + 1);
                    $records_export[$key]['user_id'] = $request['user_id'];
                    $records_export[$key]['name'] = $user['name'];
                    $records_export[$key]['phone'] = $user['phone'];
                    $records_export[$key]['amount'] = $request['amount'];
                    $records_export[$key]['charity'] = $request['admin_charges'];
                    $records_export[$key]['payable_amount'] = $request['payable_amount'];
                    $records_export[$key]['type'] = ucwords(str_replace('_', ' ', $request['type']));
                    $records_export[$key]['status'] = ($request['status'] == 0 ? 'Pending' : ($request['status'] == 1 ? 'Approved' : ($request['status'] == 2 ? 'Rejected' : 'Rejected')));
                    $records_export[$key]['bank_name'] = $bank['bank_name'];
                    $records_export[$key]['bank_account_number'] = $bank['bank_account_number'];
                    $records_export[$key]['account_holder_name'] = $bank['account_holder_name'];
                    $records_export[$key]['ifsc_code'] = $bank['ifsc_code'];
                    $records_export[$key]['remark'] = $request['remark'];
                    $records_export[$key]['created_at'] = $request['created_at'];
                }
                finalExport($export, $application_type, $header, $records_export);
            }
            $response['path'] =  $records['path'];
            $searchField = '<div class="col-4">
                                    <input type="date" name="start_date" class="form-control"
                                    value="' . $start_date . '" placeholder="Start Date">
                                </div>
                                <div class="col-4">
                                    <input type="date" name="end_date" class="form-control"
                                    value="' . $end_date . '" placeholder="End Date">
                                </div>
                                <div class="col-4">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>';
            $response['field'] = $searchField;
            $response['thead'] = '<tr>
                                <th>#</th>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Deductions</th>
                                <th>Payable Amount</th>
                                <th>Type</th>
                                <th>Status</th>
                                
                                <th>Remark</th>
                                <th>Date</th>                              
                                <th>Action</th>                              
                             </tr>';
            $tbody = [];
            $i = $records['segment'] + 1;
            foreach ($records['records'] as $key => $rec) {
                extract($rec);
                $user = get_single_record('tbl_users', array('user_id' => $user_id), 'id,name,phone');
                $bank = get_single_record('tbl_bank_details', array('user_id' => $user_id), '*');

                $tbody[$key]  = ' <tr>
                                <td>' . ($status == 0 ? '<input name="data[]" type="checkbox" value="' . $id . '"/>' : '') . '</td>
                                <td>' . $i . '</td>
                                <td>' . $user_id . '</td>
                                <td>' . $user['name'] . '</td>
                                <td>' . $user['phone'] . '</td>
                                <td>' . $amount . '</td>
                                <td>' . ($admin_charges) . '</td>
                                <td>' . $payable_amount . '</td>
                                <td>' . ucwords(str_replace('_', ' ', $type)) . '</td>
                                <td>' . ($status == 0 ? badge_warning('Pending') : ($status == 1 ? badge_success('Approved') : ($status == 2 ? badge_danger('Rejected') : ($status == 3 ? badge_danger('Rejected') : badge_info('Withdraw'))))) . '</td>
                               
                                <td>' . $remark . '</td>
                                <td>' . $created_at . '</td>
                                <td>' . ($status == 0 ? '<button class="btn btn-success WithdrawUser" data-id="' . $id . '" data-user_id="' . $user_id . '">View</button>' : ($status == 0 ? badge_warning('Pending') : ($status == 1 ? badge_success('Approved') : ($status == 2 ? badge_danger('Rejected') : ($status == 3 ? badge_danger('Rejected') : badge_info('Withdraw')))))) . '</td>
                             </tr>';
                $i++;
            }



            $response['tbody'] = $tbody;
            $response['segment'] = $records['segment'];
            $response['total_records'] = $records['total_records'];
            $response['i'] = $i;
            $response['export'] = true;
            $response['script'] = true;
            $response['status'] = 0;
            $this->load->view('withdraw_report', $response);
        } else {
            redirect('admin/login');
        }
    }


    public function index()
    {
        if (is_admin()) {
            // $object = new PHPExcel();
            // pr($object);
            // echo APPPATH . 'modules/Admin/libraries/SimpleExcel/SimpleExcel.php';
            // die;
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $field = $this->input->get('type');
            $export = $this->input->get('export');

            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field])) {

                $where = array('');
            }
            if (!empty($start_date) && !empty($end_date)) {
                $where = array('created_at >=' => $start_date, 'created_at <=' => $end_date);
            }
            $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array(), '*');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/index';
            $config['uri_segment'] = 4;
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
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            $response['total_withdraw'] = $this->Main_model->get_single_record('tbl_withdraw', $where, 'ifnull(sum(payable_amount),0) as total_withdraw');

            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone',  'Amount', 'Payable Amount',  'Bank Name', 'A/C', 'Account Holder Name', 'Ifsc', 'Request Date'];
                $response['users'] = $this->Main_model->get_records('tbl_withdraw', array(''), '*');
                foreach ($response['users'] as $key => $record) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $record['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                    $bank = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $record['user_id']), '*');

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['name'] = $user['name'];
                    $records[$key]['phone'] = $user['phone'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['payable_amount'] = $record['payable_amount'];
                    $records[$key]['bank_name'] = $bank['bank_name'];
                    $records[$key]['bank_account_number'] = $bank['bank_account_number'];
                    $records[$key]['account_holder_name'] = $bank['account_holder_name'];
                    $records[$key]['ifsc_code'] = $bank['ifsc_code'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $response['url'] = 'index';
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Approved()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');

            $where = array($field => $value, 'status' => 1);
            // pr($where,true);
            if (empty($where[$field])) {
                $where = array('status' => 1);
            }
            if (!empty($start_date) && !empty($end_date)) {
                $where = array('date(created_at) >=' => $start_date, 'date(created_at) <=' => $end_date, 'status' => 1);
            }
            // pr($where,true);

            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 1), '*');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/Approved';
            $config['suffix'] = '?' . http_build_query($_GET);
            $config['uri_segment'] = 4;
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
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            $response['total_withdraw'] = $this->Main_model->get_single_record('tbl_withdraw', $where, 'ifnull(sum(payable_amount),0) as total_withdraw');

            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone',  'Amount', 'Payable Amount',  'Bank Name', 'A/C', 'Account Holder Name', 'Ifsc', 'Request Date'];
                $response['users'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 1), '*');
                // $response['users'] = $this->Main_model->get_limit_records('tbl_withdraw', array('status'=>1), '*', 1000, 0);
                foreach ($response['users'] as $key => $record) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $record['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                    $bank = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $record['user_id']), '*');

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['name'] = $user['name'];
                    $records[$key]['phone'] = $user['phone'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['payable_amount'] = $record['payable_amount'];
                    $records[$key]['bank_name'] = $bank['bank_name'];
                    $records[$key]['bank_account_number'] = $bank['bank_account_number'];
                    $records[$key]['account_holder_name'] = $bank['account_holder_name'];
                    $records[$key]['ifsc_code'] = $bank['ifsc_code'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $response['url'] = 'Approved';
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Pending()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');

            $where = array($field => $value, 'status' => 0);
            // pr($where,true);
            if (empty($where[$field])) {
                $where = array('status' => '0');
            }
            if (!empty($start_date) && !empty($end_date)) {
                $where = array('created_at >=' => $start_date, 'created_at <=' => $end_date, 'status' => 0);
            }

            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/Pending';
            $config['uri_segment'] = 4;
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
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            $response['total_withdraw'] = $this->Main_model->get_single_record('tbl_withdraw', $where, 'ifnull(sum(payable_amount),0) as total_withdraw');
            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone',  'Amount', 'Payable Amount',  'Bank Name', 'A/C', 'Account Holder Name', 'Ifsc', 'Request Date'];
                $response['users'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 0), '*');
                foreach ($response['users'] as $key => $record) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $record['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                    $bank = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $record['user_id']), '*');

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['name'] = $user['name'];
                    $records[$key]['phone'] = $user['phone'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['payable_amount'] = $record['payable_amount'];
                    $records[$key]['bank_name'] = $bank['bank_name'];
                    $records[$key]['bank_account_number'] = $bank['bank_account_number'];
                    $records[$key]['account_holder_name'] = $bank['account_holder_name'];
                    $records[$key]['ifsc_code'] = $bank['ifsc_code'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $response['url'] = 'Pending';
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Rejected()
    {
        if (is_admin()) {
            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $export = $this->input->get('export');
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');

            $where = array($field => $value, 'status' => 2);
            // pr($where,true);
            if (empty($where[$field])) {

                $where = array('status' => 2);
            }
            if (!empty($start_date) && !empty($end_date)) {
                $where = array('created_at >=' => $start_date, 'created_at <=' => $end_date, 'status' => 2);
            }
            // $response['requests'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 2), '*');
            $config['total_rows'] = $this->Main_model->get_sum('tbl_withdraw', $where, 'ifnull(count(id),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/Rejected';
            $config['uri_segment'] = 4;
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
            $response['requests'] = $this->Main_model->get_limit_records('tbl_withdraw', $where, '*', $config['per_page'], $segment);
            $response['total_withdraw'] = $this->Main_model->get_single_record('tbl_withdraw', $where, 'ifnull(sum(payable_amount),0) as total_withdraw');

            foreach ($response['requests'] as $key => $request) {
                $response['requests'][$key]['user'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $request['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
                $response['requests'][$key]['bank'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $request['user_id']), '*');
            }
            $response['segament'] = $segment;
            $response['type'] = $field;
            $response['value'] = $value;
            $response['total_records'] = $config['total_rows'];
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Name', 'Phone',  'Amount', 'Payable Amount',  'Bank Name', 'A/C', 'Account Holder Name', 'Ifsc', 'Request Date'];
                $response['users'] = $this->Main_model->get_records('tbl_withdraw', array('status' => 2), '*');
                foreach ($response['users'] as $key => $record) {
                    $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $record['user_id']), 'id,first_name,name,last_name,sponser_id,email,phone');
                    $bank = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => $record['user_id']), '*');

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['name'] = $user['name'];
                    $records[$key]['phone'] = $user['phone'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['payable_amount'] = $record['payable_amount'];
                    $records[$key]['bank_name'] = $bank['bank_name'];
                    $records[$key]['bank_account_number'] = $bank['bank_account_number'];
                    $records[$key]['account_holder_name'] = $bank['account_holder_name'];
                    $records[$key]['ifsc_code'] = $bank['ifsc_code'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $response['url'] = 'Rejected';
            $this->load->view('withdraw_requests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function approveAdminWithdraw()
    {
        if (is_admin()) {
            $response = array();
            $ai_working_withdraw_tbl = 'tbl_withdraw';
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // die('Hello');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('data[]', 'Users Withdraw Check', 'trim|required|xss_clean');
                $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

                if ($this->form_validation->run() != FALSE) {
                    if (!empty($data)) {
                        foreach ($data['data'] as $key => $index) {
                            $check = $this->Main_model->get_single_record($ai_working_withdraw_tbl, ['id' => $index, 'status' => 0], '*');
                            if ($check) {
                                // $pr = array('id' => $check['id'],'admin_status' => $data['status']);
                                // print_r($check);
                                // die('ds');

                                $this->Main_model->update($ai_working_withdraw_tbl, ['id' => $check['id']], ['status' => 1]);

                                if ($data['status'] == 2) {
                                    $this->Main_model->update($ai_working_withdraw_tbl, ['id' => $check['id']], ['status' => 2]);

                                    $productArr = array(
                                        'user_id' => $check['user_id'],
                                        'amount' => $check['amount'],
                                        'type' => $check['type'],
                                        'description' => 'Rejected By Admin',
                                    );
                                    $this->Main_model->add('tbl_income_wallet', $productArr);
                                    // $this->Main_model->add('ai_income_wallet', $productArr);
                                    // redirect('Admin/Withdraw/Pending');
                                }
                            }
                            //pr($index);
                        }
                    }
                }
            }
            redirect('Admin/Withdraw/WithdrawHistory/Pending');
            // redirect('Admin/Withdraw/Pending');
            // $this->load->view('AI/create_news', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    // public function payout_summary() {
    //     if (is_admin()) {
    //         $response = array();
    //         $response['records'] = $this->Main_model->payout_summary();
    //         foreach($response['records'] as $key => $record){
    //             //
    //             $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "'.$record['date'].'"', 'ifnull(sum(amount),0) as sum,type');
    //             $response['records'][$key]['incomes'] = calculate_income($incomes);
    //         }
    //         // pr($response,true);
    //         $this->load->view('payout_summary', $response);
    //     } else {
    //         redirect('Admin/Management/login');
    //     }
    // }

    public function payout_summary()
    {
        if (is_admin()) {
            $response = array();
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['records'] = $this->Main_model->payout_summary2($where);
            foreach ($response['records'] as $key => $record) {
                //
                $incomes = $this->Main_model->get_incomes('tbl_income_wallet', 'date(created_at) = "' . $record['date'] . '"', 'ifnull(sum(amount),0) as sum,type');
                $response['records'][$key]['incomes'] = calculate_income($incomes);
            }
            // pr($response,true);

            if ($export) {
                $filename = 'PayoutSummary_' . time() . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $usersData = $response['records'];
                $file = fopen('php://output', 'w');
                $header = array("#", "Date", "Matching Bonus", "Monthly Salary Bonus", "Level Bonus", "Royalty Bonus", "Total Payout");
                fputcsv($file, $header);
                foreach ($usersData as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['date'] = $record['date'];
                    $records[$key]['matching_bonus'] = $record['incomes']['matching_bonus'];
                    $records[$key]['daily_roi_income'] = $record['incomes']['daily_roi_income'];
                    $records[$key]['level_income'] = $record['incomes']['level_income'];
                    $records[$key]['royalty_income'] = $record['incomes']['royalty_income'];
                    $records[$key]['total_payout'] = $record['incomes']['total_payout'];
                }

                foreach ($records as $key => $line) {
                    fputcsv($file, $line);
                }
                fclose($file);
                exit;
            }
            $this->load->view('payout_summary2', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function request($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                if ($response['request']['status'] != 0) {
                    $this->session->set_flashdata('message', 'Status of this request already updated!');
                } else {
                    if ($data['status'] == 1) {
                        $wArr = array(
                            'status' => 1,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        $productArr2 = array(
                            'user_id' => $response['request']['user_id'],
                            'amount' => $response['request']['amount'] * 10 / 100,
                            'type' => 'repurchase_income',
                            'description' => 'Repurchase Income',
                        );
                        $this->Main_model->add('tbl_repurchase_income', $productArr2);

                        if ($res) {
                            $this->session->set_flashdata('message', 'Withdraw request approved');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing request');
                        }
                    } elseif ($data['status'] == 2) {
                        $wArr = array(
                            'status' => 2,
                            'remark' => $data['remark'],
                        );
                        $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                        if ($res) {
                            $productArr = array(
                                'user_id' => $response['request']['user_id'],
                                'amount' => $response['request']['amount'],
                                'type' => $response['request']['type'],
                                'description' => $data['remark'],
                            );
                            $this->Main_model->add('tbl_income_wallet', $productArr);
                            $this->session->set_flashdata('message', 'Withdraw request rejected');
                        } else {
                            $this->session->set_flashdata('message', 'Error while apporing rejection');
                        }
                    }
                }
            }
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            $response['user_details'] = $this->Main_model->get_single_record('tbl_users', array('user_id' => $response['request']['user_id']), 'id,name,first_name,last_name,sponser_id,email,phone');
            $this->load->view('request', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RejectedWithdraw($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($response['request']['status'] != 0) {
                $this->session->set_flashdata('message', 'Status of this request already updated!');
            } else {
                $wArr = array(
                    'status' => 2,
                    'remark' => 'Rejected',
                );
                $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                if ($res) {
                    $productArr = array(
                        'user_id' => $response['request']['user_id'],
                        'amount' => $response['request']['amount'],
                        'type' => $response['request']['type'],
                        'description' => '',
                    );
                    $this->Main_model->add('tbl_income_wallet', $productArr);
                    redirect('Admin/Withdraw/Pending');
                }
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApproveWithdraw($id)
    {
        if (is_admin()) {
            $response['request'] = $this->Main_model->get_single_record('tbl_withdraw', array('id' => $id), '*');
            if ($response['request']['status'] != 0) {
                $this->session->set_flashdata('message', 'Status of this request already updated!');
            } else {
                $wArr = array(
                    'status' => 1,
                    'remark' => 'Approved',
                );
                $res = $this->Main_model->update('tbl_withdraw', array('id' => $id), $wArr);
                $productArr2 = array(
                    'user_id' => $response['request']['user_id'],
                    'amount' => $response['request']['amount'] * 10 / 100,
                    'type' => 'repurchase_income',
                    'description' => 'Repurchase Income',
                );
                $this->Main_model->add('tbl_repurchase_income', $productArr2);
                redirect('Admin/Withdraw/Pending');
            }
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function income2($type = '')
    {
        if (is_admin()) {
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 5;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', array('type' => $type), 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', array('type' => $type), '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function dateWisePayout($date = '')
    {
        if (is_admin()) {
            $response['header'] = 'Datewise Payout Summary';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "' . $date . '"', 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 4;
            $config['per_page'] = 100;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', 'date(created_at) = "' . $date . '"', 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_records('tbl_income_wallet', 'date(created_at) = "' . $date . '"', '*');
            $response['segament'] = 0;
            // pr($response,true);
            $this->load->view('incomes', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }
    public function incomeLedgar($type = '')
    {
        if (is_admin()) {
            $response['header'] = 'Income Ledgar';
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '"';
            } else {
                $where = array('');
            }
            $response['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/incomeLedgar';
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 4;
            $config['per_page'] = 50;
            $config['suffix'] = '?' . http_build_query($_GET);
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            $response['segament'] = $segment;
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('incomeLedgar', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function income($type = '')
    {
        if (is_admin()) {
            $response['header'] = ucwords(str_replace('_', ' ', $type));
            $start_date = $this->input->get('start_date');
            $end_date = $this->input->get('end_date');
            $export = $this->input->get('export');
            if (!empty($start_date)) {
                $where = 'date(created_at) >= "' . $start_date . '" AND date(created_at) <= "' . $end_date . '" AND type = "' . $type . '"';
            } else {
                $where = array('type' => $type);
            }

            $response['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type . '/';
            $config['base_url'] = base_url() . 'Admin/Withdraw/income/' . $type;
            $config['total_rows'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(count(id),0) as sum');
            $config['uri_segment'] = 5;
            $config['per_page'] = 50;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(5);
            $response['total_income'] = $this->Main_model->get_sum('tbl_income_wallet', $where, 'ifnull(sum(amount),0) as sum');
            $response['user_incomes'] = $this->Main_model->get_limit_records('tbl_income_wallet', $where, '*', $config['per_page'], $segment);
            foreach ($response['user_incomes'] as $key => $user) {
                $response['user_incomes'][$key]['user'] = $this->Main_model->get_single_record('tbl_users',  ['user_id' => $user['user_id']], 'id,name,phone');
            }
            $response['segament'] = $segment;
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Amount', 'Type', 'Description', 'Credit Date'];
                foreach ($response['user_incomes'] as $key => $record) {
                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['amount'] = $record['amount'];
                    $records[$key]['type'] = $record['type'];
                    $records[$key]['description'] = $record['description'];
                    $records[$key]['created_at'] = $record['created_at'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }

            $this->load->view('income_dynmic', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }


    public function finalExport($export, $application_type, $header, $records)
    {
        if ($export) {
            $filename = $export . 'Summary_' . time() . '.' . $export;
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: " . $application_type . "");
            $file = fopen('php://output', 'w');
            $header = $header;
            fputcsv($file, $header);

            foreach ($records as $key => $line) {
                fputcsv($file, $line);
            }

            fclose($file);
            exit();
        }
    }

    public function AddressRequests()
    {
        if (is_admin()) {
            $export = $this->input->get('export');

            $where = array('kyc_status' => 1);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //     $start_date = date_format(date_create($this->input->post('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->post('end_date')),"Y-m-d");; 
            //     $where = "  date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }else{
            //     $where = array('kyc_status' => 1);
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Bank Name', 'Bank Account Number', 'Account Holder Name', 'IFSC Code', 'Pan No.', 'Aadhar No.'];
                $response['users'] = $this->Main_model->get_records('tbl_bank_details',  $where, 'id,user_id,bank_name,bank_account_number,account_holder_name,ifsc_code,pan,aadhar');
                foreach ($response['users'] as $key => $record) {

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['bank_name'] = $record['bank_name'];
                    $records[$key]['bank_account_number'] = $record['bank_account_number'];
                    $records[$key]['account_holder_name'] = $record['account_holder_name'];
                    $records[$key]['ifsc_code'] = $record['ifsc_code'];
                    $records[$key]['pan'] = $record['pan'];
                    $records[$key]['aadhar'] = $record['aadhar'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('AddressRequests2', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function Withdraw_remark($user_id)
    {
        if (is_admin()) {
            $response = array();
            $response['remark'] = $this->Main_model->get_single_record('tbl_bank_details', array('user_id' => ($user_id)), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('remark', 'Remark', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'remark' => $data['remark'],
                        'kyc_status' => 3,
                    );
                    $res = $this->Main_model->update('tbl_bank_details', array('user_id' => $user_id), $packArr);
                    if ($res == TRUE) {
                        $this->session->set_flashdata('message', 'Remark Submit Successfully');
                    } else {
                        $this->session->set_flashdata('message', 'Error  Please Try Again ...');
                    }
                }
            }
            $this->load->view('withdraw_remark', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApprovedAddressRequests()
    {
        if (is_admin()) {
            $export = $this->input->get('export');

            $where = array('kyc_status' => 2);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 2 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Approved Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Bank Name', 'Bank Account Number', 'Account Holder Name', 'IFSC Code', 'Pan No.', 'Aadhar No.'];
                $response['users'] = $this->Main_model->get_records('tbl_bank_details',  $where, 'id,user_id,bank_name,bank_account_number,account_holder_name,ifsc_code,pan,aadhar');
                foreach ($response['users'] as $key => $record) {

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['bank_name'] = $record['bank_name'];
                    $records[$key]['bank_account_number'] = $record['bank_account_number'];
                    $records[$key]['account_holder_name'] = $record['account_holder_name'];
                    $records[$key]['ifsc_code'] = $record['ifsc_code'];
                    $records[$key]['pan'] = $record['pan'];
                    $records[$key]['aadhar'] = $record['aadhar'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('AddressRequests', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RejectedAddressRequests()
    {
        if (is_admin()) {
            $export = $this->input->get('export');

            $where = array('kyc_status' => 3);
            $start_date = '';
            $end_date = '';
            // if ($this->input->server('REQUEST_METHOD') == 'GET') {
            //     $start_date = date_format(date_create($this->input->get('start_date')),"Y-m-d"); 
            //     $end_date = date_format(date_create($this->input->get('end_date')),"Y-m-d");; 
            //     $where = "kyc_status  = 3 and date(created_at) >= date('".$start_date."') and date(created_at) <= date('".$end_date."')";
            // }
            $response['start_date'] = date_format(date_create($start_date), "m/d/Y");
            $response['end_date'] = date_format(date_create($end_date), "m/d/Y");
            $response['header'] = 'Rejected Bank Address Requests';
            $response['users'] = $this->Main_model->get_records('tbl_bank_details', $where, '*');
            // pr($where,true);
            if ($export) {
                $application_type = 'application/' . $export;
                $header = ['#', 'User ID', 'Bank Name', 'Bank Account Number', 'Account Holder Name', 'IFSC Code', 'Pan No.', 'Aadhar No.'];
                $response['users'] = $this->Main_model->get_records('tbl_bank_details',  $where, 'id,user_id,bank_name,bank_account_number,account_holder_name,ifsc_code,pan,aadhar');
                foreach ($response['users'] as $key => $record) {

                    $records[$key]['i'] = ($key + 1);
                    $records[$key]['user_id'] = $record['user_id'];
                    $records[$key]['bank_name'] = $record['bank_name'];
                    $records[$key]['bank_account_number'] = $record['bank_account_number'];
                    $records[$key]['account_holder_name'] = $record['account_holder_name'];
                    $records[$key]['ifsc_code'] = $record['ifsc_code'];
                    $records[$key]['pan'] = $record['pan'];
                    $records[$key]['aadhar'] = $record['aadhar'];
                }
                $this->finalExport($export, $application_type, $header, $records);
            }
            $this->load->view('AddressRequests1', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function ApproveUserAddressRequest($id, $status)
    {
        if (is_admin()) {
            $data['success'] = 0;
            $res = $this->Main_model->update('tbl_bank_details', array('id' => $id), array('kyc_status' => $status));
            if ($status == 3) {
                $user_data['bank_name'] = '';
                $user_data['account_holder_name'] = '';
                $user_data['bank_account_number'] = '';
                $user_data['ifsc_code'] = '';
                $user_data['aadhar'] = '';
                $user_data['pan'] = '';
                $this->Main_model->update('tbl_bank_details', array('id' => $id), $user_data);
            }
            if ($res) {
                $data['message'] = 'Request Accepted Successfully';
                $data['success'] = 1;
            } else {
                $data['message'] = 'Error While Updating Status';
            }
            echo json_encode($data);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function RejectedRequest()
    {
        if (is_admin()) {
            $data['success'] = 0;
            // $response['remark'] = $this->Main_model->get_single_record('tbl_bank_details', array('id' => $id), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('id', 'ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('remark', 'Remark', 'trim|required|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    $packArr = array(
                        'remark' => $data['remark'],
                        'kyc_status' => 3,
                    );
                    $res = $this->Main_model->update('tbl_bank_details', array('id' => $data['id']), $packArr);
                    if ($res) {
                        $data['message'] = 'Request Rejected Successfully';
                        $this->session->set_flashdata('message', '<span class="text-success">KYC request rejected</span>');
                        redirect('Admin/Withdraw/AddressRequests');
                        $data['success'] = 1;
                    } else {
                        $data['message'] = 'Error While Updating Status';
                        $this->session->set_flashdata('message', '<span class="text-danger">Error While Updating Status</span>');
                    }
                    redirect('Admin/Withdraw/AddressRequests');
                    echo json_encode($data);
                } else {
                    redirect('Admin/Management/login');
                }
            }
        }
    }


    public function bank_transfer_summary()
    {
        if (is_admin()) {
            $response = array();
            $response['header'] = 'Bank Transfer Summary';

            $field = $this->input->get('type');
            $value = $this->input->get('value');
            $where = array($field => $value);
            // pr($where,true);
            if (empty($where[$field]))
                $where = array();

            $config['total_rows'] = $this->Main_model->get_sum('tbl_money_transfer', $where, 'ifnull(count(id),0) as sum');
            $response['bank_amount'] = $this->Main_model->get_sum('tbl_money_transfer', [], 'ifnull(sum(amount),0) as sum');
            $config['base_url'] = base_url() . 'Admin/Withdraw/bank_transfer_summary';
            $config['uri_segment'] = 4;
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
            $config['reuse_query_string'] = true;
            $this->pagination->initialize($config);
            $segment = $this->uri->segment(4);
            $response['segament'] = $segment;

            $response['total_records'] = $config['total_rows'];

            $response['transactions'] = $this->Main_model->get_limit_records('tbl_money_transfer', $where, '*', $config['per_page'], $segment);

            $this->load->view('bank_transfer_summary', $response);
        } else {
            redirect('Admin/Management/login');
        }
    }

    public function incomeManagement()
    {
        if (is_admin()) {
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'required');
                $this->form_validation->set_rules('amount', 'Amount', 'required');
                if ($this->form_validation->run() != false) {
                    if ($data['income'] == 'credit') {
                        $amount = $data['amount'];
                        $description = 'Income Credit by Admin';
                    } elseif ($data['income'] == 'debit') {
                        $amount = -$data['amount'];
                        $description = 'Income Debit by Admin';
                    }
                    $incomeArr = [
                        'user_id' => $data['user_id'],
                        'amount' => $amount,
                        'type' => $data['type'],
                        'description' =>  $description,
                    ];
                    $res = $this->Main_model->add('tbl_income_wallet', $incomeArr);
                    if ($res) {
                        $this->session->set_flashdata('message', '<h3 class="text-success">Income Successfully Updated</h3>');
                    } else {
                        $this->session->set_flashdata('message', '<h3 class="text-danger">Something went wrong please try again...</h3>');
                    }
                }
            }
            $this->load->view('incomeManagement');
        } else {
            redirect('Admin/Management/login');
        }
    }
}
