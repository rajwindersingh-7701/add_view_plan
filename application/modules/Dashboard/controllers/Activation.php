<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Activation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('User_model'));
        $this->load->helper(array('user', 'birthdate', 'security', 'email','compose'));
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {
        // die();
        if (is_logged_in()) {

            
            $response['user'] = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // die('we are working on it...');
                $data = $this->security->xss_clean($this->input->post());
                $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('package_id', 'Package', 'trim|required|numeric|xss_clean');

                //$this->form_validation->set_rules('otp', 'otp', 'trim|required|numeric|xss_clean');
                if ($this->form_validation->run() != FALSE) {
                    //if(!empty($this->session->tempdata('otp'))){
                    //if($data['otp'] == $this->session->tempdata('otp')){
                    $user_id = $data['user_id'];
                    $checkCrossTeam = $this->User_model->get_single_record('tbl_sponser_count', array('user_id' => $this->session->userdata['user_id'],'downline_id' => $user_id), '*');
                    $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), '*');
                    $package = $this->User_model->get_single_record('tbl_package', array('id' => $data['package_id'], 'price >' => 100), '*');
                   // $uplinecheck = $this->checkUpline($user_id,$this->session->userdata['user_id']);
                    $wallet = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
                    if (!empty($user)) {
                        $activatePer =  $package['price'];
                        $deductAmount =  $package['price'];
                      //  if(!empty($checkCrossTeam) || $user_id == $this->session->userdata['user_id'] || $uplinecheck == true){
                            if ($wallet['wallet_balance'] >= $deductAmount) {
                                if ($user['free_status'] == 0) {
                                    $checkPackage = $this->User_model->get_single_record('tbl_activation_details',['user_id' => $user_id,'package' => $package['price']],'*');
                                    if($user['package_amount'] <= $package['price']){
                                        $sendWallet = array(
                                            'user_id' => $this->session->userdata['user_id'],
                                            'amount' => -$deductAmount,
                                            'type' => 'account_activation',
                                            'remark' => 'Account Activation Deduction for ' . $user_id,
                                        );
                                        $this->User_model->add('tbl_wallet', $sendWallet);

                                        $topupData = array(
                                            'paid_status' => 1,
                                            'free_status' => 1,
                                            'package_id' => $data['package_id'],
                                            'package_amount' => $package['price'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            //'capping' => $package['capping'],
                                            'totalLimit' => $user['totalLimit']+($package['price']*2)
                                        );
                                        $this->User_model->update('tbl_users', array('user_id' => $user_id), $topupData);

                                        $activationData = [
                                            'user_id' => $user_id,
                                            'activater' => $this->session->userdata['user_id'],
                                            'package' => $package['price'],
                                            'topup_date' => date('Y-m-d H:i:s'),
                                            'activation_type' => $user['package_amount'] == 0 ? 'activation' : 'upgration',
                                        ];
                                        $this->User_model->add('tbl_activation_details', $activationData);

                                        $roiData = [
                                            'user_id' => $user['user_id'],
                                            'amount' => $package['commision'] * $package['days'],
                                            'total_days' => $package['days'],
                                            'days' => $package['days'],
                                            'roi_amount' => $package['commision'],
                                            'package' => $package['price'],
                                            'createDate' => date('Y-m-d')
                                        ];
                                        $this->User_model->add('tbl_roi', $roiData);

                                        //$this->User_model->total_team_update($user['id']);
                                        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $user['sponser_id']), 'sponser_id,paid_status,package_amount,package_id,directs,user_id,totalLimit,pendingLimit');
                                        if($user['package_amount'] == 0){
                                        $this->User_model->update_directs($user['sponser_id']);
                                        }

                                        //$position_directs = $this->User_model->count_position_directs($user['sponser_id']);
                                        //if(!empty($position_directs) && count($position_directs) == 2){
                                        if ($sponser['paid_status'] == 1) {
                                            if ($sponser['totalLimit'] > $sponser['pendingLimit']) {
                                                $totalCredit = $sponser['pendingLimit'] + $package['direct_income'];
                                                if ($totalCredit < $sponser['totalLimit']) {
                                                    $direct_income = $package['direct_income'];
                                                } else {
                                                    $direct_income = $sponser['totalLimit'] - $sponser['pendingLimit'];
                                                }
                                                $DirectIncome = array(
                                                    'user_id' => $user['sponser_id'],
                                                    'amount' => $direct_income,
                                                    //'dollar' => $data['amount']*$package['direct_income'],
                                                    //'token_price' => $response['tokenValue']['amount'],
                                                    'type' => 'direct_income',
                                                    'description' => 'Direct Income from Activation of Member ' . $user_id . ' with package ' . $package['price'],
                                                );
                                                $this->User_model->add('tbl_income_wallet', $DirectIncome);
                                                $this->User_model->update('tbl_users', ['user_id' => $user['sponser_id']], ['pendingLimit' => ($sponser['pendingLimit'] + $direct_income)]);
                                            }else{
                                                $this->User_model->update('tbl_roi', ['user_id' => $user['sponser_id']], ['days' => 0]);
                                                $this->User_model->update('tbl_users', ['user_id' => $user['sponser_id']], ['free_status' => 0]);
                                            }
                                        }
                                        $levelIncome = $package['level_income'];
                                        $this->level_income($sponser['sponser_id'], $user['user_id'], $levelIncome, $deductAmount);
                                        // $this->boosterAchiever($user['sponser_id']);
                                        $this->session->set_flashdata('message', '<span class="text-success">Account Activated Successfully</span>');
                                    } else {
                                        $this->session->set_flashdata('message', '<span class="text-danger">Account is already  activated!</span>');
                                    }
                                } else {
                                    $this->session->set_flashdata('message', '<span class="text-danger">Account is already  activated!</span>');
                                }
                            } else {
                                $this->session->set_flashdata('message', '<span class="text-danger">Insuffcient Balance</span>');
                            }
                        // }else{
                        //     $this->session->set_flashdata('message', '<span class="text-danger">This user id is not your team</span>');

                        // }
                        // }else{
                        //     $this->session->set_flashdata('message', ' Invalid OTP');
                        // }
                    } else {
                        $this->session->set_flashdata('message', '<span class="text-danger">Invalid User ID</span>');
                    }
                    // }else{
                    //     $this->session->set_flashdata('message','OTP has expired');
                    // }
                }
            }
            $response['wallet'] = $this->User_model->get_single_record('tbl_wallet', array('user_id' => $this->session->userdata['user_id']), 'ifnull(sum(amount),0) as wallet_balance');
            $response['packages'] = $this->User_model->get_records('tbl_package', ['price >' => 100], '*');
            $this->load->view('activate_account', $response);
        } else {
            redirect('Dashboard/User/login');
        }
    }

    private function boosterAchiever($user_id)
    {
        $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'directs,package_amount,topup_date,booster_status');
        $directs = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $user_id,'package_amount >=' => $user['package_amount']], 'count(id)as direct');

        $date1 = date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 1 days'));
        // $date3 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 3 days'));
        $diff2 = strtotime($date2) - strtotime($date1);
        // pr($diff2);
        if ($diff2 > 0) {
            
            if ($directs['direct'] >= 2) {
                if($user['booster_status'] == 0){
                $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster_status' => 1]);
                // $this->User_model->update('tbl_roi', ['user_id' => $user_id], ['roi_amount' => '2']);
                $this->db->query("UPDATE tbl_roi SET roi_amount = roi_amount*2 WHERE user_id = '$user_id'");
                }

            }
        }
        // $diff3 = strtotime($date3) - strtotime($date1);
        // if ($diff3 > 0) {
        //     if ($user['directs'] >= 5) {
        //         $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster2' => 1]);
        //     }
        // }
    }


//     private function boosterAchieverTest($user_id)
//     {
//         $user = $this->User_model->get_single_record('tbl_users', ['user_id' => $user_id], 'directs,topup_date,booster_status');
//         $date1 = date('Y-m-d H:i:s');
//         $date2 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 1 days'));
//         // $date3 = date('Y-m-d H:i:s', strtotime($user['topup_date'] . '+ 3 days'));
//         $diff2 = strtotime($date2) - strtotime($date1);
//         pr($diff2);
//         // if ($diff2 > 0) {
            
//             if ($user['directs'] >= 2) {
//                 if($user['booster_status'] == 0){
//                 $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster_status' => 1]);
//                 // $this->User_model->update('tbl_roi', ['user_id' => $user_id], ['roi_amount' => '2']);
//                 $this->db->query("UPDATE tbl_roi SET roi_amount = roi_amount*2 WHERE user_id = '$user_id'");
//                 }

//             // }
//         }
//         // $diff3 = strtotime($date3) - strtotime($date1);
//         // if ($diff3 > 0) {
//         //     if ($user['directs'] >= 5) {
//         //         $this->User_model->update('tbl_users', ['user_id' => $user_id], ['booster2' => 1]);
//         //     }
//         // }
//     }


//   public function testBooster(){
//     $this->boosterAchieverTest('MG156106');
//   }

private function level_income($sponser_id, $activated_id, $package_income, $package) 
{
    $incomeArr = explode(',', $package_income);

    foreach ($incomeArr as $key => $income) {
        $level = $key + 1;
        // $direct = $key + 1;
        $sponser = $this->User_model->get_single_record('tbl_users', array('user_id' => $sponser_id), 'id,user_id,sponser_id,paid_status,package_amount,totalLimit,pendingLimit,directs');
        if (!empty($sponser)) {
            if ($sponser['paid_status'] == 1) {
                // if ($sponser['directs'] >= $direct) {
                    if ($sponser['totalLimit'] > $sponser['pendingLimit']) {
                        $totalCredit = $sponser['pendingLimit'] + ($income * $package / 100);
                        if ($totalCredit < $sponser['totalLimit']) {
                            $level_income = $income * $package / 100;
                        } else {
                            $level_income = $sponser['totalLimit'] - $sponser['pendingLimit'];
                        }
                        $LevelIncome = array(
                            'user_id' => $sponser['user_id'],
                            'amount' => $level_income,
                            'type' => 'level_income',
                            'description' => 'Level Income from Activation of Member ($' . $package . ') ' . $activated_id . ' At level ' . ($level),
                        );
                        $this->User_model->add('tbl_income_wallet', $LevelIncome);
                        $this->User_model->update('tbl_users', ['user_id' => $sponser['user_id']], ['pendingLimit' => ($sponser['pendingLimit'] + $LevelIncome['amount'])]);
                    }
                // }
                // $sponser_id = $sponser['sponser_id'];
            }
            $sponser_id = $sponser['sponser_id'];
            // else {
            //     $sponser_id = $this->compressLevelIncome($sponser['sponser_id'],($income*$package/100),$package,$activated_id,$level,$packagePrice,$table);
            // }
        }
    }
}

    public function update_directs(Type $var = null)
    {
        $users = $this->User_model->get_records('tbl_users', ['paid_status >' => 0], '*');
        foreach ($users as $key => $user) {
            $directs = $this->User_model->get_single_record('tbl_users', ['paid_status >' => 0, 'sponser_id' => $user['user_id']], 'count(id) as directs');
            $this->User_model->update('tbl_users', ['user_id' => $user['user_id']], ['directs' => $directs['directs']]);
            pr($directs);
        }
    }
}
?>