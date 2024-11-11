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
if (!function_exists('is_logged_in')) {

    //    protected $CI;
    // $ci = &get_instance();

    // if($ci->session->userdata['role'] != 'A'){
    //     redirect('https://growmoney.me/');
    //     die();

    // }
    function is_logged_in()
    {
        $ci = &get_instance();
        $ci->load->library('session');
        if (isset($ci->session->userdata['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('userinfo')) {

    function userinfo()
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $userdetails = $ci->user_model->get_single_object('tbl_users', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $userdetails;
    }
}

if (!function_exists('bankinfo')) {
    function bankinfo()
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $userdetails = $ci->user_model->get_single_object('tbl_bank_details', array('user_id' => $ci->session->userdata['user_id']), '*');
        return $userdetails;
    }
}

if (!function_exists('pool_count')) {

    function pool_count()
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $pool_count = $ci->user_model->get_single_object('tbl_pool', array('user_id' => $ci->session->userdata['user_id']), 'ifnull(count(id),0) as pool_count');
        return $pool_count;
    }
}
if (!function_exists('pool_levels')) {

    function pool_levels()
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $pool_count = $ci->user_model->get_records('tbl_pool', array('user_id' => $ci->session->userdata['user_id']), '*');
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

        return $package;
    }
}
if (!function_exists('calculate_rank_bonus')) {

    function calculate_rank_bonus($directs, $package_id)
    {
        if ($package_id == 1) {
            if ($directs >= 100)
                $income = 200;
            elseif ($directs >= 50)
                $income = 175;
            elseif ($directs >= 25)
                $income = 150;
            elseif ($directs >= 20)
                $income = 125;
            elseif ($directs >= 15)
                $income = 100;
            elseif ($directs >= 10)
                $income = 75;
            elseif ($directs >= 5)
                $income = 50;
            else
                $income = 0;

            return $income;
        } else {
            if ($directs >= 100)
                $income = 105;
            elseif ($directs >= 50)
                $income = 90;
            elseif ($directs >= 25)
                $income = 75;
            elseif ($directs >= 20)
                $income = 60;
            elseif ($directs >= 15)
                $income = 45;
            elseif ($directs >= 10)
                $income = 30;
            elseif ($directs >= 5)
                $income = 15;
            else
                $income = 0;

            return $income;
        }
    }
}
if (!function_exists('notify_user')) {

    function notify_user($user_id, $message)
    {
        // $ci = & get_instance();
        // $ci->load->model('user_model');
        // $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');

        // $total_msg = $ci->user_model->get_single_record('tbl_sms_counter', array(''), 'count(id) as total_msg');
        // if($total_msg['total_msg'] < sms_limit){
        //      $key = "a08f1ade94XX";
        //      $userkey = "gniweb2";
        //      $senderid = "SMSGSS";
        //      $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
        //      $msg = urlencode($message);
        //      $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
        //      $ch = curl_init();
        //      curl_setopt($ch, CURLOPT_HEADER, 0);
        //      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //      curl_setopt($ch, CURLOPT_URL, $url);
        //      $data = curl_exec($ch);
        //      curl_close($ch);
        //      $sms_data = array('user_id' => $user_id , 'message' => $msg , 'response' => $data);
        //      $ci->user_model->add('tbl_sms_counter', $sms_data);
        // }
        /* for sms */
    }
}

if (!function_exists('notify_sms')) {
    function notify_sms($user_id, $message, $entity_id = '1201161518339990262', $temp_id = '')
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $user = $ci->user_model->get_single_object('tbl_users', array('user_id' => $user_id), 'name,phone,email');
        $id_count = $ci->user_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
        if ($id_count['ids'] <= sms_limit) {
            $key = "a08f1ade94XX";
            $userkey = "gniweb2";
            $senderid = "MLMSIG";
            $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";
            $msg = urlencode($message);
            // $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
            // $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=7837243545&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1&&entityid='.$entity_id.'&&tempid='.$temp_id;
            $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $user->phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1&&entityid=' . $entity_id . '&&tempid=' . $temp_id;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $data = curl_exec($ch);
            curl_close($ch);
            $sms_data = array('user_id' => $user_id, 'message' => $msg, 'response' => $data);
            $ci->user_model->add('tbl_sms_counter', $sms_data);
        }
    }
}

if (!function_exists('tax')) {

    function tax()
    {
        $ci = &get_instance();
        $ci->load->model('user_model');
        $tax = $ci->user_model->get_single_object('tbl_tax', array('id' => 1), '*');
        return $tax->tax;
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
        $CI->email->from(email, title);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        $CI->email->send();
    }
}

if (!function_exists('cart_items')) {

    function cart_items()
    {
        $ci = &get_instance();
        $ci->load->model('Shopping_model');
        $userdetails = $ci->Shopping_model->cart_items($ci->session->userdata['user_id']);
        return $userdetails;
    }
}
if (!function_exists('tree_img')) {

    function tree_img($package_amount, $empty)
    {
        if ($empty == 0) {
            if ($package_amount > 0) {
                $img = base_url('SiteAssets/treeimage/tree.png');
            } else {
                $img = base_url('SiteAssets/treeimage/male.jpg');
            }
        } else {
            $img = base_url('SiteAssets/treeimage/unknown.jpg');
        }
        return $img;
    }
}


if (!function_exists('get_income_name')) {

    function get_income_name($income_name)
    {
        $incomes = array(
            // 'direct_income' => 'Direct Income',
            // 'level_income' => 'Level Income',
            // 'single_leg' => 'Single Leg Income',
            // 'booster_income1' => 'Booster Income',
            // 'booster_income2' => 'Double Booster Income',
            'ad_income' => 'Ad Income',
            'task_income' => 'Cashback Income',
            'task_level_income' => 'Level Income',
            'royalty_income' => 'Royalty Income',

            // 'task_income' => 'Add view Income',
            // 'team_development' => 'Team Development Income',
            // 'royalty_income' => 'Royalty Income',
            //   'pool_income' => 'Pool Income',
            //   'upgrade_deduction' => 'Pool Upgradation Deduction',
            'bank_transfer' => 'Bank Transfer',

        );
        return $incomes[$income_name];
    }
}

if (!function_exists('incomes')) {
    function incomes()
    {
        $incomes = array(
            // 'direct_income' => 'Direct Income',
            'level_income' => 'Level Income',
            // 'single_leg' => 'Single Leg Income',
            // 'booster_income1' => 'Booster Income',
            // 'booster_income2' => 'Double Booster Income',
            // 'club_income' => 'Club Income',
            'ad_income' => 'Ad Income',
            'task_income' => 'Cashback Income',
            'task_level_income' => 'Level Income',
            'income_transfer' => 'Income Transfer',
            'royalty_income' => 'Royalty Income',
            'withdraw_request' => 'Withdraw Request',
            'withdraw' => 'Withdraw Request',

            'reward_income' => 'Reward Income',
        );
        return $incomes;
    }
}

if (!function_exists('getIndianCurrency')) {
    function getIndianCurrency($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else
                $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}
function notify_mail($to_email, $message)
{
    $personalizations = new stdClass();

    $content = new stdClass();
    $from = new stdClass();
    $reply_to = new stdClass();

    $content->type  = 'text/plain';
    $content->value = $message;
    $from->email = 'btcalliance.co@gmail.com';
    $from->name = 'btcalliance';


    $reply_to->email = 'btcalliance.co@gmail.com';
    $reply_to->name = 'btcalliance';

    $to[0] = ['email' => $to_email];
    $personalizations->subject = 'Registration Alert';
    $post_data['personalizations'][0] = $personalizations;
    $post_data['personalizations'][0]->to = $to;
    $post_data['content'][0] = $content;
    $post_data['from'] = $from;

    $post_data['reply_to'] = $reply_to;
    // echo json_encode($post_data);
    // pr($post_data);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($post_data),
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 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",
            "cache-control: no-cache",
            "content-type: application/json",
        ),
    ));

    echo $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

function country_dropdown($name, $id, $class, $selected_country, $top_countries = array(), $all, $selection = NULL, $show_all = TRUE)
{
    // Getting the array of countries from the config file
    $countries = config_item('country_list');
    $html = "<select name='{$name}' id='{$id}' class='{$class}'>";
    $selected = NULL;
    if (in_array($selection, $top_countries)) {
        $top_selection = $selection;
        $all_selection = NULL;
    } else {
        $top_selection = NULL;
        $all_selection = $selection;
    }
    if (!empty($selected_country) && $selected_country != 'all' && $selected_country != 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='{$selected_country}'{$selected}>{$countries[$selected_country]}</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'all') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    } else if ($selected_country == 'select') {
        $html .= "<optgroup label='Selected Country'>";
        if ($selected_country === $top_selection) {
            $selected = "SELECTED";
        }
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
        $html .= "</optgroup>";
    }
    if (!empty($all) && $all == 'all' && $selected_country != 'all') {
        $html .= "<option value='all'>All</option>";
        $selected = NULL;
    }
    if (!empty($all) && $all == 'select' && $selected_country != 'select') {
        $html .= "<option value='select'>Select</option>";
        $selected = NULL;
    }

    if (!empty($top_countries)) {
        $html .= "<optgroup label='Top Countries'>";
        foreach ($top_countries as $value) {
            if (array_key_exists($value, $countries)) {
                if ($value === $top_selection) {
                    $selected = "SELECTED";
                }
                $html .= "<option value='{$value}'{$selected}>{$countries[$value]}</option>";
                $selected = NULL;
            }
        }
        $html .= "</optgroup>";
    }
    if ($show_all) {
        $html .= "<optgroup label='All Countries'>";
        foreach ($countries as $key => $country) {
            if ($key === $all_selection) {
                $selected = "SELECTED";
            }
            $html .= "<option value='{$key}'{$selected}>{$country}</option>";
            $selected = NULL;
        }
        $html .= "</optgroup>";
    }

    $html .= "</select>";
    return $html;
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

if (!function_exists('downlineTeam')) {
    function downlineTeam($user_id, $status, $position)
    {
        $ci = &get_instance();
        $ci->load->model('User_model');
        $team = $ci->User_model->calculate_Position_team($user_id, $status, $position);
        //pr($team);
        return $team['team'];
    }

if (!function_exists('send_crypto_email2')) {
    function send_crypto_email2($email,$subject,$message){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://64.227.105.87:8000/send_email_multi',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'user='.user1.'&pass='.pass1.'&from='.sender_id1.'&title='.sender_name1.'&email='.$email.'&subject='.$subject.'&html=<div style=\' background: #FFFFFF;
    padding: 10px;\'><h3 style=\'color:#4e4848;font-weight:normal;line-height: 31px;\'>'.$message.'</h3><div style=\'font-size:17px;font-weight: normal;display:none;color:#ffea81; margin-top:20px\'><a href="'.base_url('Dashboard/User/MainLogin').'" style=\'background-color:#17b824; color:#fff;width: 100%; font-weight:normal; border-radius: 4px;  display: block;\'>Click here to login</a></div></div>',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        // echo $response;
    }
}
    if (!function_exists('send_crypto_email')) {
        function send_crypto_email($email,$subject,$message){
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://64.227.105.87:8000/send_email_multi',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'user='.user.'&pass='.pass.'&from='.sender_id.'&title='.sender_name.'&email='.$email.'&subject='.$subject.'&html=<div style=\' background: #000000;
        margin: auto;
        max-width: 400px;
        padding: 20px;
        border: 4px #4ce7ff solid;
        margin: 10px auto;\'><center><img style=\'max-width:200px;margin: 0;border-radius: 10px;\' src=\'https://growmoney.me/uploads/logo.png\' alt=\'logo\'><br><h3 style=\'color:#fff;\'>'.$message.'</h3><div style=\'font-size:20px;font-weight: bold; color:#ffea81; margin-top:20px\'><a href="'.base_url('Dashboard/User/MainLogin').'" style=\'background-color:#17b824; color:#fff;width: 100%; font-weight:normal; border-radius: 4px;  display: block;\'>Click here to login</a></div></center></div>',
                CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
                ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
            //echo $response;
        }
    }

    if (!function_exists('notifySms')) {
        function notifySms($user_id, $message, $sender_id)
        {
            $ci = &get_instance();
            $ci->load->model('User_model');
            $user = $ci->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'name,phone,email,user_id');
            $id_count = $ci->User_model->get_single_record('tbl_sms_counter', array(), 'count(id) as ids');
             if($id_count['ids'] <= sms_limit){
            $curl = curl_init();
            $msg = urlencode($message);
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://sms2.pmassindia.com/submitsms.jsp?user=kuldeepgni&key=0c3f226a6eXX&mobile=+91'.$user['phone'].'&message='.$msg.'&senderid='.$sender_id.'&accusage=1&entityid=1401487200000053882&tempid=1407168594286519178',
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
            $sms_data = array('user_id' => $user_id, 'message' => $msg, 'response' => $response);
            $ci->User_model->add('tbl_sms_counter', $sms_data);
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
              CURLOPT_URL => 'http://sms2.pmassindia.com/submitsms.jsp?user=kuldeepgni&key=0c3f226a6eXX&mobile=+91'.$user['phone'].'&message='.$msg.'&senderid='.$sender_id.'&accusage=1&entityid='.$entity_id.'&tempid='.$temp_id.'',
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
            $sms_data = array('user_id' => $user_id, 'message' => $msg, 'response' => $response);
            $ci->User_model->add('tbl_sms_counter', $sms_data);
        }
        }
    }


    
    
}
