<?php
require_once("header.php");
$user = $_SESSION["user"];
$userId = $user["id"];

require_once("controller/userClass.php");
$userClass = new userClass();

$_GET = $userClass->extract_post($db, $_GET);

if (isset($_GET['select_type'])) {
    if ($_GET['select_type'] != "") {
        $column = $_GET['select_type'];
        $value = $_GET['v'];
        $q = "SELECT * FROM  `wallet` where `userId`= '$userId' && transaction_type ='ad' &&  $column='$value'";
    }
    if (isset($_GET['from'])) {
        $from = date("Y-m-d", strtotime($_GET['from']));
        $q = "SELECT * FROM `wallet` where `userId`= '$userId' && transaction_type ='ad' && datetime >= '$from 00:00:00'";
    }
    if (isset($_GET['to'])) {
        $to = date("Y-m-d", strtotime($_GET['to']));
        $q .= " and  datetime <= '" . $to . " 23:59:59 '";
    }
    echo $q;
    $totalResult = mysqli_num_rows(mysqli_query($db, $q));
} else {
    $totalResult = mysqli_num_rows(mysqli_query($db, "SELECT id FROM  `wallet` where `userId`= '$userId' && transaction_type ='ad'"));
}

///////
 function GenelogyTree($user_id = '') {
    if (is_logged_in()) {
        $validate_user = 0;
        $response = array();
        if($user_id == ''){
            $user_id = $this->input->get('user_id');
        }
        $user = $this->User_model->get_single_record('tbl_users', array('user_id' => $user_id), 'user_id');
        if(!empty($user)){
            if ($user_id == $this->session->userdata['user_id']) {
                $validate_user = 1;
            } else {
                $down_user = $this->User_model->get_single_record('tbl_downline_count', array('user_id' => $this->session->userdata['user_id'], 'downline_id' => $user_id), '*');
                if (!empty($down_user)) {
                    $validate_user = 1;
                }
            }
        }else{
            $validate_user = 0;
        }

        if ($validate_user == 1) {
            $response['validate_user'] = 1;
            $response['level1'] = $this->User_model->get_tree_user($user_id);
            if (!empty($response['level1'])) {
                $response['level2'][1] = $this->User_model->get_tree_user($response['level1']->left_node);
                $response['level2'][2] = $this->User_model->get_tree_user($response['level1']->right_node);
                if (!empty($response['level2'][1]->left_node)) {
                    $response['level3'][1] = $this->User_model->get_tree_user($response['level2'][1]->left_node);
                    if (!empty($response['level3'][1]->left_node)) {
                        $response['level4'][1] = $this->User_model->get_tree_user($response['level3'][1]->left_node);
                    } else {
                        $response['level4'][1] = array();
                    }
                    if (!empty($response['level3'][1]->right_node)) {
                        $response['level4'][2] = $this->User_model->get_tree_user($response['level3'][1]->right_node);
                    } else {
                        $response['level4'][2] = array();
                    }
                } else {
                    $response['level3'][1] = array();
                    $response['level4'][1] = array();
                    $response['level4'][2] = array();
                }
                if (!empty($response['level2'][1]->right_node)) {
                    $response['level3'][2] = $this->User_model->get_tree_user($response['level2'][1]->right_node);
                    if (!empty($response['level3'][2]->left_node)) {
                        $response['level4'][3] = $this->User_model->get_tree_user($response['level3'][2]->left_node);
                    } else {
                        $response['level4'][3] = array();
                    }
                    if (!empty($response['level3'][2]->right_node)) {
                        $response['level4'][4] = $this->User_model->get_tree_user($response['level3'][2]->right_node);
                    } else {
                        $response['level4'][4] = array();
                    }
                } else {
                    $response['level3'][2] = array();
                    $response['level4'][3] = array();
                    $response['level4'][4] = array();
                }
                if (!empty($response['level2'][2]->left_node)) {
                    $response['level3'][3] = $this->User_model->get_tree_user($response['level2'][2]->left_node);
                    if (!empty($response['level3'][3]->left_node)) {
                        $response['level4'][5] = $this->User_model->get_tree_user($response['level3'][3]->left_node);
                    } else {
                        $response['level4'][5] = array();
                    }
                    if (!empty($response['level3'][3]->right_node)) {
                        $response['level4'][6] = $this->User_model->get_tree_user($response['level3'][3]->right_node);
                    } else {
                        $response['level4'][6] = array();
                    }
                } else {
                    $response['level3'][3] = array();
                    $response['level4'][5] = array();
                    $response['level4'][6] = array();
                }
                if (!empty($response['level2'][2]->right_node)) {
                    $response['level3'][4] = $this->User_model->get_tree_user($response['level2'][2]->right_node);
                    if (!empty($response['level3'][4]->left_node)) {
                        $response['level4'][7] = $this->User_model->get_tree_user($response['level3'][4]->left_node);
                    } else {
                        $response['level4'][7] = array();
                    }
                    if (!empty($response['level3'][4]->right_node)) {
                        $response['level4'][8] = $this->User_model->get_tree_user($response['level3'][4]->right_node);
                    } else {
                        $response['level4'][8] = array();
                    }
                } else {
                    $response['level3'][4] = array();
                    $response['level4'][7] = array();
                    $response['level4'][8] = array();
                }
            } else {
                $response['level1'] = [];
            }
            // $response['level2'][1]['placement'] = 0;
            // $response['level2'][2]['placement'] = 0;
            // $response['level3'][1]['placement'] = 0;
            // $response['level3'][4]['placement'] = 0;
            // $response['level4'][1]['placement'] = 0;
            // $response['level4'][8]['placement'] = 0;
            if (!empty($response['level2'][1])) {
                if (!empty($response['level3'][1])) {
                    if (empty($response['level4'][1])) {
                        $response['level4'][1]['placement'] = 1;
                    }
                } else {
                    $response['level3'][1]['placement'] = 1;
                }
            } else {
                $response['level2'][1]['placement'] = 1;
            }
            if (!empty($response['level2'][2])) {
                if (!empty($response['level3'][4])) {
                    if (empty($response['level4'][8])) {
                        $response['level4'][8]['placement'] = 1;
                    }
                } else {
                    $response['level3'][4]['placement'] = 1;
                }
            } else {
                $response['level2'][2]['placement'] = 1;
            }
        } else {
            $response['validate_user'] = 0;
        }

        // pr($response,true);
        $this->load->view('gonology-tree', $response);
    } else {
        redirect('Dashboard/User/login');
    }
}

///////////



?>

<!-- Container Panel  -->
<div class="col-lg-9">
    <h2 class="admin-heading bg-offwhite">Daily Task Cashback</h2>
    <!-- Filter -->
    <!-- Filter End -->
    <!-- All Transactions  -->
    <div class="profile-content">
        <!-- Admin Heading Title  -->
        <div class="transaction-title bg-offwhite">
            <div class="items">
                <div class="row">
                    <div class="col" style="max-width: 170px;"><span class="">Date</span></div>
                    <div class="col">Description</div>
                    <div class="col">Amount</div>
                </div>
            </div>
        </div>
        <!-- Admin Heading Title End -->

        <!-- Transaction List -->
        <div class="transaction-area">
         
                    <?php
                    // $pagenum = $totalResult / 100;
                    // //Search data query
                    // $offset = 0;
                    // $pageResult = 100;
                    // if (isset($_GET['page'])) {
                    //     $page = $_GET['page'];
                    //     $offset = (($page - 1) * 100) + 1;
                    // }
                    // $q = "SELECT * FROM `wallet` where `userId`= '$userId' && transaction_type ='ad' ";
                    // if (isset($_GET['select_type'])) {
                    //     $column = $_GET['select_type'];
                    //     $value = $_GET['v'];
                    //     if ($_GET['select_type'] != "") {
                    //         $q .= " and  $column Like '%$value%' ";
                    //     }
                    //     if (isset($_GET['from'])) {
                    //         $q .= " and datetime >= '" . $from . " 00:00:00' ";
                    //     }
                    //     if (isset($_GET['to'])) {
                    //         $q .= " and datetime <= '" . $to . " 23:59:59' ";
                    //     }
                    // }
                    // $q .= "order by id asc limit $pageResult offset $offset";
//                                echo $q;die;
//$userId = $user["id"];
                    // $i = 1;
                    // $m = 1;
                    // $queryUser = mysqli_query($db, $q);
                    // while ($dataQuery = mysqli_fetch_array($queryUser)) {
                    //     $userFromID = $dataQuery['fromUserId'];
                    //     $userquery = mysqli_query($db, "SELECT * FROM `user` WHERE `user_id`= '$userFromID'");
                    //     $userresult = mysqli_fetch_array($userquery);
                        ?>
               <!-- <div class="items">
                <a href="#">
                        <div class="row">
                            <div class="col " style="max-width: 170px;">
                                <span class="name"><?php //echo $dataQuery['datetime']; ?></span>
                                    <span class="date">17</span>
                               <span class="pay-month">Jan</span>-->
                            <!-- </div>
                            <div class="col">
                                <span class="name"><?php //echo $dataQuery['description']; ?></span>
                            </div>

                            <div class="col">
                                <span class="payment-amaount"><?php //echo $dataQuery['amount']; ?></span>
                            </div>
                        </div>
                       </a> -->
            <!-- </div> --> 
                    <?php //} ?>
                    
             


        </div>
    </div>
    <!-- Transaction List End -->

    <!-- Transaction Details Modal  -->
    <!-- Transaction Modal End -->

    <!-- Pagination -->
<!--    <ul class="pagination justify-content-left mt-4 pt-4 pl-0">
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active"><a class="page-link" href="#">2 <span class="sr-only">(current)</span></a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item d-flex align-content-center text-muted mr-2">...</li>
        <li class="page-item"><a class="page-link" href="#">19</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
        </li>
    </ul>-->
    <ul class="pagination justify-content-left mt-4 pt-4 pl-0">
        <li style="">Page 
        </li>
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-left"></i></a></li>
        <?php
//Pagination 

        for ($i = 0; $i < $pagenum; $i++) {
            if (isset($_GET['select_type'])) {
//Query Parameter
                $parameter = $_SERVER['QUERY_STRING'];
//if page already send
                if (isset($_GET['page'])) {
                    parse_str($parameter, $get_array);
                    unset($get_array['page']);
                    $parameter = http_build_query($get_array);
                }
                ?> 
                <li class="page-item">
                    <a class="page-link" href="?<?php echo $parameter; ?>&page=<?php echo $i + 1; ?>">
                        <?php echo $i + 1; ?>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $i + 1; ?>">

                        <?php echo $i + 1; ?>
                    </a>
                </li>
                <?php
            }
        }
        ?> 
    </ul>

    <!-- Paginations end -->

</div>
<!-- All Transactions End -->
</div>
<!-- Middle End -->
</div>
</div>
</div>
<!-- Content end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>