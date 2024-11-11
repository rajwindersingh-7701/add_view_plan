<?php

if (!function_exists('pr')) {

    function pr($array, $die = false)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        if ($die)
            die();
    }
}
// if (!function_exists('is_admin')) {

//     function is_admin() {
//         $ci = & get_instance();
//         $ci->load->library('session');
//         if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A') {
//             return true;
//         } else {
//             return false;
//         }
//     }

// }

// if (!function_exists('is_admin')) {
//     function is_admin() {
//         $ci = & get_instance();
//         $ci->load->library('session');
//         if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A' && !empty($ci->session->userdata['admin_id']) && $ci->session->userdata['admin_id'] == 'admin') {
//             if(!empty($ci->session->userdata['guard'])){
//               return true;
//             }else{
//               return false;
//             }
//         } else {
//             return false;
//         }
//     }
// }

if (!function_exists('get_single_record')) {
    function get_single_record($table, $where, $select)
    {
        $ci = &get_instance();
        $ci->load->model('Main_model');
        $userdetails = $ci->Main_model->get_single_record($table, $where, $select);
        return $userdetails;
    }
}

if (!function_exists('get_records')) {
    function get_records($table, $where, $select)
    {
        $ci = &get_instance();
        $ci->load->model('Main_model');
        $userdetails = $ci->Main_model->get_records($table, $where, $select);
        return $userdetails;
    }
}

if (!function_exists('pagination')) {
    function pagination($table, $where, $select, $base_url, $segment, $per_page, $orderby = 'asc')
    {
        $ci = &get_instance();
        $ci->load->model('Main_model');
        $config['total_rows'] = $ci->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
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
        $ci->pagination->initialize($config);
        $segment = $ci->uri->segment($segment);
        $records =  $ci->Main_model->get_limit_records($table, $where, $select, $config['per_page'], $segment, $orderby);
        $response = ['records' => $records, 'segment' => $segment, 'path' => $config['base_url'], 'total_records' => $config['total_rows']];
        return $response;
    }
}

if (!function_exists('badge_success')) {

    function badge_success($message)
    {
        return '<span class="badge badge-success"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_danger')) {

    function badge_danger($message)
    {
        return '<span class="badge badge-danger"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_info')) {

    function badge_info($message)
    {
        return '<span class="badge badge-info"> ' . $message . ' </span>';
    }
}
if (!function_exists('badge_warning')) {

    function badge_warning($message)
    {
        return '<span class="badge badge-warning"> ' . $message . ' </span>';
    }
}

if (!function_exists('is_admin')) {
    function is_admin()
    {
        $ci = &get_instance();
        $ci->load->library('session');
        $ci->load->model('Main_model');
        if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'A') {
            return true;
        } elseif (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'SA') {
            // die('jeree');
            $value = $ci->router->method;
            $value2 = $ci->router->class;
            $userAccess = $ci->Main_model->get_single_record('tbl_admin', ['user_id' => $ci->session->userdata['admin_id']], 'access');
            $access = json_decode($userAccess['access'], true);
            // pr($access);
            // pr($value2,true);
            if ($ci->session->userdata['admin_id'] != 'admin') {
                if ($value == 'index' && $value2 == 'Management') {
                    return true;
                    die('wait');
                } elseif (in_array($value2 . '/' . $value, $access)) {
                    return true;
                    die('ok');
                } else {
                    if ($value == 'Sublogin') {
                        return true;
                        die('stop');
                    } else {
                        // $ci->Permission->access();
                        redirect('Admin/Permissions/accessDeined');
                        // $ci->load->view('accessDeined');
                        die('not ok');
                    }
                }
            } else {
                return true;
            }
            // die('here');
        } else {
            return false;
        }
    }
}

// if (!function_exists('is_subadmin')) {
//     function is_subadmin()
//     {
//         $ci = &get_instance();
//         $ci->load->library('session');
//         if (isset($ci->session->userdata['role']) && $ci->session->userdata['role'] == 'SA' && !empty($ci->session->userdata['user_id'])) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

if (!function_exists('access')) {
    function access($method)
    {
        $ci = &get_instance();
        $ci->load->library('session');
        $ci->load->model('Main_model');
        if (!empty($ci->session->userdata['admin_id'])) {
            $userinfo = $ci->Main_model->get_single_record('tbl_users', ['user_id' => $ci->session->userdata['admin_id']], 'access');
            $access = json_decode($userinfo['access'], true);
            if (!empty($access[$method]) && $access[$method] == $method) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}


if (!function_exists('finalExport')) {

    function finalExport($export, $application_type, $header, $records)
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
}


if (!function_exists('pool_count')) {

    function pool_count()
    {
        $ci = &get_instance();
        $ci->load->model('Main_model');
        $pool_count = $ci->Main_model->get_single_record('tbl_pool', array(), 'max(pool_level) as pool_count');
        return $pool_count;
    }
}
if (!function_exists('calculate_rank')) {

    function calculate_rank($directs)
    {
        if ($directs >= 100)
            $rank = 'Diamond';
        elseif ($directs >= 50)
            $rank = 'Emerald';
        elseif ($directs >= 25)
            $rank = 'Topaz';
        elseif ($directs >= 20)
            $rank = 'Pearl';
        elseif ($directs >= 15)
            $rank = 'Gold';
        elseif ($directs >= 10)
            $rank = 'Silver';
        elseif ($directs >= 5)
            $rank = 'Star';
        else
            $rank = 'Associate';

        return $rank;
    }
}
if (!function_exists('calculate_package')) {

    function calculate_package($package_id)
    {
        if ($package_id == 1)
            $package = '3600';
        elseif ($package_id == 2)
            $package = '1400';
        else
            $package = 'Free';
        return $package;
    }
}

if (!function_exists('incomes')) {

    function incomes()
    {
        $incomes = array(
            // 'direct_income' => 'Direct Income',
            // 'matching_bonus' => 'Matching Income',
            'task_income' => 'Cashback Income',
            'task_level_income' => 'Level Income',
            // 'level_income' => 'Level Income',
            // 'task_income' => 'Add view Income',
            // 'team_development' => 'Team Development',
            // 'royalty_income' => 'Royalty Income',
            // 'reward_income' => 'Reward Income',
            // 'pool_income' => 'Pool Income',
            // 'single_leg' => 'Single Leg Income',
            // 'booster_income1' => 'Booster Income',
            // 'booster_income2' => 'Double Booster Income',
            // 'club_income' => 'Club Income',

        );
        // return array_search($income_name, $incomes);
        return $incomes;
    }
}
if (!function_exists('get_income_name')) {

    function get_income_name($income_name)
    {
        $incomes = array(
            // 'matching_bonus' => 'Matching Income',
            // 'daily_roi_income' => 'Monthly Salary Income',
            // 'level_income' => 'Level Income',
            // 'royalty_income' => 'Royalty Income',
            // 'pool_income' => 'Pool Income',
            // 'team_development' => 'Team Development',
            // 'upgrade_deduction' => 'Pool Upgradation Deduction',
            'task_income' => 'Cashback Income',
            'task_level_income' => 'Level Income',
            // 'task_income' => 'Add view Income',

        );
        // return array_search($income_name, $incomes);
        return $incomes[$income_name];
    }
}
if (!function_exists('calculate_income')) {

    function calculate_income($incomeArr)
    {

        $incomes = incomes();
        $income_count = array();
        $total_payout = 0;
        foreach ($incomes as $key => $income) {
            $income_count[$key] = 0;
            foreach ($incomeArr as $arr) {
                if ($arr['type'] == $key) {
                    $income_count[$key] = $arr['sum'];
                }
            }
            $total_payout = $income_count[$key] + $total_payout;
        }
        $income_count['total_payout'] = $total_payout;
        return $income_count;
    }
}

if (!function_exists('notify_user')) {
    function notify_user($user_id, $message)
    {
        $ci = &get_instance();
        $ci->load->model('Main_model');
        // $user = $ci->Main_model->get_single_record('tbl_admin', array('user_id' => $user_id), 'name,email');
        $id_count = $ci->Main_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
        if ($id_count['ids'] <= sms_limit) {
            /* for sms */
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "GRAMIN";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
            $msg = urlencode($message);
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=7375074677&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => 'Admin', 'message' => $msg, 'response' => $data);
            $ci->Main_model->add('tbl_sms_counter', $sms_data);
        }
    }
}



if (!function_exists('notify_sms')) {
    function notify_sms($user_id, $message, $entity_id = '1201161518339990262', $temp_id = '')
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        // $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $id_count = $ci->user_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
        if ($id_count['ids'] <= sms_limit) {
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "MLMSIG";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
            $msg = urlencode($message);
            // $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            // $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1&&entityid='.$entity_id.'&&tempid='.$temp_id;
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=7375074677&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1&&entityid=' . $entity_id . '&&tempid=' . $temp_id;
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => 'Admin', 'message' => $msg, 'response' => $data);
            $ci->user_model->add('tbl_sms_counter', $sms_data);
        }
    }
}

if (!function_exists('notifySms1')) {
    function notifySms1($user_id, $message, $sender_id,$entity_id,$temp_id)
    {
        $ci = &get_instance();
        $ci->load->model('User_model');
        $user = $ci->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name,phone,email,user_id');
        $id_count = $ci->User_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
         if($id_count['ids'] <= sms_limit){
        $curl = curl_init();
        $msg = urlencode($message);
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://sms2.pmassindia.com/submitsms.jsp?user=kuldeepgni&key=0c3f226a6eXX&mobile=+917375074677&message='.$msg.'&senderid='.$sender_id.'&accusage=1&entityid='.$entity_id.'&tempid='.$temp_id.'',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: JSESSIONID=88613C89F0C3276FCDA9F508F62C7DA1'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
        $sms_data = array('user_id' => 'admin', 'message' => $msg, 'response' => $response);
        $ci->User_model->add('tbl_sms_counter', $sms_data);
    }
    }
}


if (!function_exists('sendMail')) {
    function sendMail($to, $message, $subject)
    {
        $CI = &get_instance();
        $CI->load->library('email');
        $config = array();
        $config = array(
            'charset' => 'ISO-8859-1',
            'wordwrap' => TRUE,
            'mailtype' => 'html'
        );
        $CI->email->initialize($config);
        $CI->email->from('info@1fxcoin.io', '1FX');
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        $CI->email->send();
    }
}



function pool()
{
    $pool = [
        1 => ['pool_name' => 'Star Pool', 'table' => 'tbl_pool'],
        2 => ['pool_name' => 'Silver Pool', 'table' => 'tbl_pool2'],
        3 => ['pool_name' => 'Gold Pool', 'table' => 'tbl_pool3'],
        4 => ['pool_name' => 'Ruby Pool', 'table' => 'tbl_pool4'],
        5 => ['pool_name' => 'Pearl Pool', 'table' => 'tbl_pool5'],
        6 => ['pool_name' => 'Diamond Pool', 'table' => 'tbl_pool6'],

    ];

    return $pool;
}
if (!function_exists('pagination')) {
 function pagination($table, $where, $select, $base_url, $segment, $per_page)
{
    $ci = &get_instance();
    $ci->load->model('user_model');
    $config['total_rows'] = $ci->Main_model->get_sum($table, $where, 'ifnull(count(id),0) as sum');
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
    $ci->pagination->initialize($config);
    $segment = $ci->uri->segment($segment);
    $records = $ci->Main_model->get_limit_records($table, $where, $select, $config['per_page'], $segment);
    $response = ['records' => $records, 'segment' => $segment, 'path' => $config['base_url']];
    return $response;
}
}