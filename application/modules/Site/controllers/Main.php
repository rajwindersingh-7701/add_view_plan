<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'encryption', 'form_validation', 'security', 'email'));
        $this->load->model(array('Main_model'));
        $this->load->helper(array('site'));
    }
    

    public function index() {
		// redirect('Dashboard/User/MainLogin');
        // $response['news'] = $this->Main_model->get_records('tbl_news', array(), '*');
        // $response['popup'] = $this->Main_model->get_single_record1('tbl_site_settings', '*');
        $response['number'] = $this->Main_model->get_single_record('tbl_site', [],'*');

        // $response['top_ranks'] = $this->Main_model->top_ranks();
        // $response['top_eaners'] = $this->Main_model->top_earners();
        //$response = [''];
        $this->load->view('index.php',$response);
    }

    public function Register() {
        $response['message'] = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->security->xss_clean($this->input->post());
            $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $data['sponser_id']), 'user_id,last_left,last_right,name');
            if (!empty($sponser)) {
                $userData['user_id'] = $this->getUserIdForRegister();
                $userData['sponser_id'] = $data['sponser_id'];
                $userData['position'] = $data['position'];
                $userData['last_left'] = $userData['user_id'];
                $userData['last_right'] = $userData['user_id'];
                $userData['name'] = $data['name'];
                $userData['email'] = $data['email'];
                $userData['phone'] = $data['phone'];
                $userData['password'] = $data['password'];
                $userData['role'] = 'U';
                if ($data['position'] == 'L') {
                    $userData['upline_id'] = $sponser['last_left'];
                } elseif ($data['position'] == 'R') {
                    $userData['upline_id'] = $sponser['last_right'];
                }
                $res = $this->Main_model->add('tbl_users', $userData);
                if ($res) {
                    if ($data['position'] == 'R') {
                        $this->Main_model->update('tbl_users', array('last_right' => $userData['upline_id']), array('last_right' => $userData['user_id']));
                        $this->Main_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('right_node' => $userData['user_id']));
                    } elseif ($data['position'] == 'L') {
                        $this->Main_model->update('tbl_users', array('last_left' => $userData['upline_id']), array('last_left' => $userData['user_id']));
                        $this->Main_model->update('tbl_users', array('user_id' => $userData['upline_id']), array('left_node' => $userData['user_id']));
                    }
                    $this->add_counts($userData['user_id'], $userData['user_id']);
                    $response['message'] = 'Dear User Your Account Successfully created on DWAY <br> Now You Can Login with <br>User ID :  ' . $userData['user_id'] . ' <br> Password :' . $userData['password'];
                    $this->load->view('success.php', $response);
                } else {
                    $response['message'] = 'Error While Creating User';
                    $this->load->view('register.php', $response);
                }
            } else {
                $response['message'] = 'Invalid Sponser ID';
                $this->load->view('register.php', $response);
            }
        } else {
            $this->load->view('register.php', $response);
        }
    }

    function add_counts($user_name = 'DW56497', $downline_id = 'DW56497') {
        $user = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_name), $select = 'upline_id , position , role');
        if (count($user)) {
            if ($user['position'] == 'L') {
                $count = array('left_count' => ' left_count + 1');
                $c = 'left_count';
            } else if ($user['position'] == 'R') {
                $c = 'right_count';
                $count = array('right_count' => ' right_count + 1');
            } else {
                return;
            }
            $this->Main_model->update_count($c, $user['upline_id']);
            $downlineArray = array(
                'user_id' => $user['upline_id'],
                'downline_id' => $downline_id,
                'position' => $user['position'],
                'created_at' => 'CURRENT_TIMESTAMP',
            );
            $this->Main_model->add('tbl_downline_count', $downlineArray);
            $user_name = $user['upline_id'];

            if ($user['role'] != 'A') {
                $this->add_counts($user_name, $downline_id);
            }
        }
    }

    public function getUserIdForRegister() {
        $user_id = 'AMAZING' . rand(1000, 9999);
        $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,last_left,last_right,name');
        if (!empty($sponser)) {
            $this->getUserIdForRegister();
        } else {
            return $user_id;
        }
    }

     public function privacy() {
        $this->load->view('privacy');
    }


public function insta() {
        $this->load->view('insta');
    }

public function facebook() {
        $this->load->view('facebook');
    }

public function tiktok() {
        $this->load->view('tiktok');
    }


public function youtube() {
        $this->load->view('youtube');
    }

public function twitter() {
        $this->load->view('twitter');
    }


public function Soundcloud() {
        $this->load->view('Soundcloud');
    }

    public function like() {
        $this->load->view('buy-instagram-likes');
    }

    public function view() {
        $this->load->view('buy-instagram-views');
    }
   public function autolike() {
        $this->load->view('buy-instagram-auto-likes');
    }
     public function comments() {
        $this->load->view('buy-instagram-comments');
    }
     public function storyview() {
        $this->load->view('buy-instagram-story-views');
    }

       public function reelview() {
        $this->load->view('buy-instagram-reel-views');
    }

           public function youtubeview() {
        $this->load->view('buy-youtube-views');
    }

            public function youtubelike() {
        $this->load->view('buy-youtube-likes');
    }

            public function youtubecomments() {
        $this->load->view('buy-youtube-comments');
    }

             public function youtubeshares() {
        $this->load->view('buy-youtube-shares');
    }

             public function twitterretweets() {
        $this->load->view('buy-twitter-retweets');
    }
            public function twitterlikes() {
        $this->load->view('buy-twitter-likes');
    }

             public function postlikes() {
        $this->load->view('buy-facebook-post-likes');
    }

     public function followers() {
        $this->load->view('buy-facebook-followers');
    }
       public function facebookviews() {
        $this->load->view('buy-facebook-views');
    }





    





 public function Refund() {
        $this->load->view('Refund');
    }

public function faq() {
        $this->load->view('faq');
    }

 public function blog() {
        $this->load->view('blog');
    }


    public function Login() {
        $this->load->view('login.php');
    }
    public function bank() {
        $response['number'] = $this->Main_model->get_single_record('tbl_site', [],'*');

        $this->load->view('bank.php',$response);
    }
    public function buy() {
        $this->load->view('buy.php');
    }
    public function about() {
        $response['number'] = $this->Main_model->get_single_record('tbl_site', [],'*');

        $this->load->view('about.php',$response);
    }
    public function gallery() {
        $this->load->view('gallery.php');
    }
    public function contact() {
        $response['number'] = $this->Main_model->get_single_record('tbl_site', [],'*');

        $this->load->view('contact.php',$response);
    }
    public function terms() {
        $this->load->view('terms.php');
    }
    public function wallet() {
        $this->load->view('wallet.php');
    }
    public function market() {
        $this->load->view('market.php');
    }
    public function news() {
        $this->load->view('news.php');
    }
    public function buysell() {
        $this->load->view('buy_sell.php');
    }
    public function exchange() {
        $this->load->view('exchange.php');
    }
    public function marketdata() {
        $this->load->view('marketdata.php');
    }
    public function sitemap() {
        $this->load->view('sitemap.php');
    }
    public function content($content) {
        $this->load->view($content);
    }

    public function check_sponser() {
        $response = array();
        $response['success'] = 0;
        $user_id = $this->input->post('sponser_id');
        $sponser = $this->Main_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id,last_left,last_right,name');
        if (!empty($sponser)) {
            $response['message'] = 'Sponser Found';
            $response['success'] = 1;
            $response['sponser'] = $sponser;
        } else {
            $response['message'] = 'Sponser Not Found';
        }

        echo json_encode($response);
    }

    public function mail() {
        $this->email->from('info@gnisoftsolutions.com', 'Kush');
        $this->email->to('349kuldeep@gmail.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if (!$this->email->send()) {
            // Generate error
        }
    }



}
