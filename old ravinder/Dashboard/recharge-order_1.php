<?php require 'header.php'; ?>

    <!-- Profile bar -->
    <div class="profilebar shadow mt-2 border-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="balance-area">
                        <a href="#">
                            <div class="header-pro-thumb">
                                <img class="rounded-circle" src="images/profile.jpg" alt="">
                            </div> 
                            <span class="pl-4 pt-1"><b>Jhone Due</b></span>
                        </a>
                    

                    </div>
                </div>
                <div class="col">
                    <div class="local-time">
                        <p><b>Local Time:</b> 12:00PM</p>
                    </div>
                </div>
                <div class="col">
                    <div class="local-time">
                        <p><b>Last Visit:</b>1/12/2020 - 12:00PM</p>
                    </div>
                </div>
                <div class="col notify-col text-right">
                    <div class="notify-btn"><a href="profile-notifications.html"><i class="far fa-bell"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Profile bar -->

    <!-- Content  -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left sidebar -->
                <aside class="col-lg-3 sidebar">
                        <div class="widget admin-widget p-0">
                            <div class="Profile-menu">
                                <ul class="nav secondary-nav">
                                    <li class="nav-item active"><a class="nav-link" href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fab fa-autoprefixer"></i> Account</a></li>
                                    <li class="nav-item"><a class="nav-link" href="profile-cards.html"><i class="fas fa-university"></i> Cards Accounts</a></li>
                                    <li class="nav-item"><a class="nav-link" href="transactions.html"><i class="fas fa-list-ul"></i>Transaction</a></li>
                                    <li class="nav-item"><a class="nav-link" href="transactions-details.html"><i class="fas fa-list-ul"></i>Transaction Details</a></li>
                                    <li class="nav-item"><a class="nav-link" href="profile-notifications.html"><i class="fas fa-cog"></i>Setting</a></li>
                                </ul>
                            </div>
                        </div>
    
                        <div class="widget admin-widget">
                            <i class="fas fa-coins admin-overlay-icon"></i>
                            <h2>Earn $25</h2>
                            <p>Have questions or concerns regrading</p>
                            <a href="#" class="btn btn-default btn-center"><span>Refer A friend</span></a>
                        </div>
    
                        <div class="widget admin-widget">
                            <i class="fas fa-comments admin-overlay-icon"></i>
                            <h2>Need Help?</h2>
                            <p>Have questions or concerns regrading your account?<br>
                                Our experts are here to help!.</p>
                            <a href="#" class="btn btn-default btn-center"><span>Start Chat</span></a>
                        </div>
    
                    </aside>
                    <!-- Left Panel End -->

                <!-- Middle Panel  -->

                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Available Balance -->
                            <div class="bg-light shadow-sm text-center mb-3">
                                <div class="d-flex admin-heading pr-3">
                                    <div class="mr-auto">
                                        <h3 class="text-9 font-weight-400"><i class="fas fa-wallet"></i> Available Balance</h3>
                                    </div>
                                    <div class="ml-auto">
                                        <h3 class="text-9 font-weight-400">$3641.00</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- Available Balance End -->
                        </div>
                    </div>
                    <div class="col-md-12 profile-content ">
                        <ul class="nav nav-pills">
                           
                            <li class="nav-item">
                                <a class="nav-link active" href="recharge-order.html">Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="recharge-summary.html">Summary</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="recharge-payment.html">Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="recharge-done.html" >Done</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            
                            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <form>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Enter the receiver mobile number</label>
                                        <input type="text" class="form-control shadow form-control-lg mobilenumber" id="mobilenumber" required placeholder="Enter Mobile Number">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlInput04">Search Operator</label>
                                        <input type="email" class="form-control" id="exampleFormControlInput04" placeholder="Searching...">
                                    </div>

                                    <div class="operators">
                                        <h3 class="title">Select Your Operator</h3>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/1.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/2.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/3.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/4.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/5.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-4">
                                                <div class="single-operator">
                                                    <div class="op-logo" data-operator="op1">
                                                        <img src="images/bill/prepaid/6.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="products">
                                        <h3 class="title">Choose Your Plan</h3>
                                        <div class="row">
                                            <div class="col">
                                                    <a href="#" data-target="#view-plans" data-toggle="modal" class="view-plans">Prepaid Plan</a>
                                            </div>
                                            <div class="col">
                                                    <a href="#" data-target="#view-plans" data-toggle="modal" class="view-plans">Postpaid Plan</a>
                                            </div>    
                                                
                                        </div>
                                    </div>                                
                                    <ul class="pager my-5">
                                        <li>&nbsp;</li>
                                        <li><a href="recharge-summary.html" class="btn btn-default "> Next <i class="fas fa-chevron-right"></i></a></li>
                                    </ul>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
    </div>
    <!-- Content end -->

<?php require_once 'footer.php'; ?>