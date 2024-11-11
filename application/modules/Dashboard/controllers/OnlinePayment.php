<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Ippopay\IPOrder\IPOrder;

class OnlinePayment extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email','pagination'));
        $this->load->model(array('User_model'));
		$this->load->helper(array('user','security'));
		
		date_default_timezone_set('Asia/Kolkata');

		require realpath(APPPATH . '../vendor/autoload.php');
		//require realpath(APPPATH . '../vendor/ippopay/ippopay/Ippopay.php');
		$this->api = new IPOrder('pk_live_Y7HKxopjZhXv','sk_live_vSudQqf7AIqVtDeh0ppCdQeyuJ2R6W2MAv4LL7gm');
		$this->publicKey = 'pk_live_Y7HKxopjZhXv';
		$this->today = date('Y-m-d');
		
		if (is_logged_in() === false){
			redirect('Dashboard/User/login');
			die();
		}	
    }

	public function index(){
		redirect('Dashboard/OnlinePayment/paymentGateway');		
	}

	// public function paymentGateway(){
	// 	echo '<script>alert("Server is busy,Try later");</script>';
	// 	//redirect('Dashboard/User');
	// 	$response['header'] = 'Add Balance';
	// 	$this->load->view('addBalance1',$response);
	// }

	public function paymentGateway(){
		$response['header'] = 'Add Balance';
		//redirect('Dashboard/User');
		//$response['package'] = $this->User_model->get_records('tbl_package',[],'*');
		if($this->input->server("REQUEST_METHOD") == "POST"){
			$data = $this->security->xss_clean($this->input->post());
			$this->form_validation->set_rules('amount','Amount','trim|required');
			//$this->form_validation->set_rules('pin','Pins','trim|required');
			if($this->form_validation->run() != false){
				$userInfo = $this->User_model->get_single_record('tbl_users',['user_id' => $this->session->userData('user_id')],'*');
				//if($data['pin'] > 0){
					if($data['amount'] >= 1){
						//if ($data['amount'] % 1 == 0) {
							$response['amount'] = $data['amount'];
							$order = $this->api->createOrder([
								"amount"=> $data['amount']*80,
								"currency"=> "INR",
								"payment_modes"=> "cc,dc,nb,upi",
								"return_url"=> base_url('Dashboard/OnlinePayment/returnURL'),
								"customer"=> array(
									"name"=> $userInfo['name'].'('.$userInfo['user_id'].')',
									"email"=> !empty($userInfo['email'])?$userInfo['email']:$userInfo['user_id'].'@gmail.com',
									"phone"=> array(
										"country_code"=> "91" ,
										"national_number"=> $userInfo['phone'],
									)
								)
							]);
							$orderData = json_decode($order, true);
							
							$orderID = $orderData['data']['order']['order_id']; // Get your ORDER ID Here
							$orderTransactionDetails = $this->api->orderDetails($orderID);
							$response['orderId'] = $orderID;
							$response['publicKey'] = $this->publicKey;
							//pr($orderData,true);
							if($orderData['success'] == 1){
								$userData = [
									'user_id' => $this->session->userData('user_id'),
									'phone' => $orderData['data']['order']['customer']['phone']['national_number'],
									'name' => $orderData['data']['order']['customer']['name'],
									'email' => $orderData['data']['order']['customer']['email'],
									'amount' => $orderData['data']['order']['amount'],
									'dollar' => $orderData['data']['order']['amount']/80,
									'order_id' => $orderData['data']['order']['order_id'],
								];
								//pr($orderData,true);
								//$this->transaction($orderData['data']['order']['order_id']);
								$this->User_model->add('ippo_transaction',$userData);
							}
							$this->load->view('ippopay',$response);
						// } else {
						// 	$this->session->set_flashdata('message', 'Amount is multiple of 699');
						// 	$this->load->view('addBalance1',$response);
						// }	
					}else{
						$this->session->set_flashdata('message','Minimum Amount $1');
						$this->load->view('addBalance1',$response);
					}
				// }else{
				// 	$this->session->set_flashdata('message','Minimum Pin required is 1');
				// 	$this->load->view('addBalance1',$response);
				// }
			}else{
				$this->session->set_flashdata('message',validation_errors());
				$this->load->view('addBalance1',$response);	
			}
		}else{
			$this->load->view('addBalance1',$response);
		}
	}

	public function returnURL(){
		if($_REQUEST['status'] == 'success'){
			$orderID = $_REQUEST['order_id'];
			$transID = $_REQUEST['transaction_no'];
			$userData = [
				'transaction_id' => $transID,
				'status' => 1,
			];
			$this->User_model->update('ippo_transaction',['order_id' => $orderID],$userData);
			$checkAmount = $this->User_model->get_single_record('ippo_transaction',['order_id' => $orderID],'amount');
			$userFund = [
				'user_id' => $this->session->userData('user_id'),
				'amount' => $checkAmount['amount']/80,
				'type' => 'add_amount',
				//'status' => 0,
				'transaction_id' => $transID,
				'remark' => 'Transaction id '.$transID,
			];
			$this->User_model->add('tbl_wallet',$userFund);
			$this->session->set_flashdata('message','Payment done successfully');
			redirect('Dashboard/OnlinePayment/paymentGateway');
		}else{
			$this->session->set_flashdata('message','Payment failed');
			redirect('Dashboard/OnlinePayment/paymentGateway');
		}
	}

	public function addFund(){
		$orderID = $this->input->get('orderID');
		$transID = $this->input->get('transID');
		$userData = [
			'transaction_id' => $transID,
			'status' => 1,
		];
		$this->User_model->update('ippo_transaction',['order_id' => $orderID],$userData);
		$checkAmount = $this->User_model->get_single_record('ippo_transaction',['order_id' => $orderID],'amount');
		$userFund = [
			'user_id' => $this->session->userData('user_id'),
			'amount' => $checkAmount['amount']/80,
			'type' => 'add_amount',
			//'status' => 0,
			'transaction_id' => $transID,
			'remark' => 'Transaction id '.$transID,
		];
		//$this->User_model->add('tbl_epin_request',$userFund);
		$this->User_model->add('tbl_wallet',$userFund);
	}

	// public function check(){
	// 	if (is_user() === true){
	// 		$amount =  $this->input->post('payble_amount');
	// 		$product_info = $this->input->post('product_info');
	// 		$customer_name = $this->input->post('customer_name');
	// 		$customer_emial = $this->input->post('customer_email');
	// 		$customer_mobile = $this->input->post('mobile_number');
	// 		$customer_address = $this->input->post('customer_address');
	    
	//     	//payumoney details
	    
	    
	//         $MERCHANT_KEY = "mYMesj"; //"gtKFFx"; //"ew0RZLqu"; //change  merchant with yours
	//         $SALT = "oi1UJyHO"; //"eCwWELxi"; //"V8CmkVmuVK";  //change salt with yours 

	//         $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	//         //optional udf values 
	//         $udf1 = '';
	//         $udf2 = '';
	//         $udf3 = '';
	//         $udf4 = '';
	//         $udf5 = '';
	        
	//         $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
	//         $hash = strtolower(hash('sha512', $hashstring));
	         
	//        	$success = base_url('App/') . 'Status';  
	//         $fail = base_url('App/') . 'Status';
	//         $cancel = base_url('App/') . 'Status';
	        
	        
	//          $data = array(
	//             'mkey' => $MERCHANT_KEY,
	//             'tid' => $txnid,
	//             'hash' => $hash,
	//             'amount' => $amount,           
	//             'name' => $customer_name,
	//             'productinfo' => $product_info,
	//             'mailid' => $customer_emial,
	//             'phoneno' => $customer_mobile,
	//             'address' => $customer_address,
	//             'action' => "https://secure.payu.in", //"https://sandboxsecure.payu.in/", //for live change action  https://secure.payu.in
	//             'sucess' => $success,
	//             'failure' => $fail,
	//             'cancel' => $cancel            
	//         );
	// 		$this->load->view('confirmation', $data); 
	// 	}else{
	// 		redirect('App/login');
	// 	}  
	// }

	// public function help(){
	// 	if (is_user() === true){
	// 		$this->load->view('help');
	// 	}else{
	// 		redirect('App/login');
	// 	}
	// }

	public function transaction($order_id){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://pk_test_4EO41PTpZQHY:sk_test_GnZSBAM4wNraiO408gwY3SmlKhvwDEqCOKcKMlQl@api.ippopay.com/v1/order/".$order_id."/transaction",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_POSTFIELDS => '',
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		),
		));
		$response = curl_exec($curl);
		pr($response,true);
		$err = curl_error($curl);
		curl_close($curl);
	}

	// public function paymentGateway(){
	// 	$response['header'] = 'Add Balance';
	// 	if($this->input->server("REQUEST_METHOD") == "POST"){
	// 		$data = $this->security->xss_clean($this->input->post());
	// 		$this->form_validation->set_rules('amount','Amount','trim|required');
	// 		if($this->form_validation->run() != false){
	// 			if($data['amount'] > 0){
	// 				$response['amount'] = $data['amount'];
	// 				$this->load->view('ippopay',$response);
	// 			}else{
	// 				$this->session->flashdata('message','Please enter valid amount');
	// 				$this->load->view('addBalance1',$response);
	// 			}
	// 		}else{
	// 			$this->session->flashdata('message','Please enter amount');
	// 			$this->load->view('addBalance1',$response);	
	// 		}
	// 	}else{
	// 		$this->load->view('addBalance1',$response);
	// 	}
	// }
}
