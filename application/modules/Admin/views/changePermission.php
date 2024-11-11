<?php
include 'header.php';
?>
<style>
  label {
    font-size: 16px;
    padding: 0px 15px 0px 0px;
  }
</style>
<div class="main-content">
  <div class="page-content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/Index') ?>">Home</a></li>
            <li class="breadcrumb-item active">Change Permission</li>
          </ol>
        </div>
      </div>
      <div>
        <?php
        $permissionListArr = [
          'User Details' => [
            'All Members' => 'Management/users',
            'Paid Members' => 'Management/paidUsers',
            'Today Joining' => 'Management/today_joinings',
            'User Login' => 'Management/user_login',
            'Block Status' => 'Management/blockStatus',
            'Edit User' => 'Settings/EditUser'
          ],
          'Auto Deposit' => [
            'Auto Deposit History' => 'Crypto/index'
          ],
          'Settings' => [
            'Admin Activation' => 'activate-account',
            'Zero Pin History' => 'Report/zeroPinHistory',
            'Buy Price' => 'Settings/token_value',
            'Sell Price' => 'Settings/sellValue',
            'User Popup Image' => 'Settings/popup_upload',
            'Inactive Team' => 'active-inactive-team',
            'Change Sponser' => 'change-sponsor'
          ],
          'Mail' => [
            'Inbox' => 'Support/inbox',
            'Compose Mail' => 'Support/Compose',
            'Outbox' => 'Support/Outbox',
            'Mail View Button' => 'Support/view'
          ],
          'Fund Management' => [
            'Send Fund' => 'Management/SendWallet',
            'Fund History' => 'Management/fund_history',
            'Send Coin' => 'Management/SendCoin',
            'Fund Request' => 'Management/Fund_requests',
            'Pending Request' => 'Management/Fund_requests/0',
            'Approved Request' => 'Management/Fund_requests/1',
            'Rejected Request' => 'Management/Fund_requests/2'
          ],
          'Withdraw Management' => [
            'Withdrawal' => 'Withdraw/index',
            'Withdraw Request' => 'Withdraw/Pending',
            'Approved Withdraw Request' => 'Withdraw/Approved',
            'Rejected Withdraw Request' => 'Withdraw/Rejected',
            'Withdraw View Button' => 'Withdraw/request'
          ],
          '$ Withdraw Management' => [
            'Withdraw Request' => 'Withdraw/withdrawZil/pending',
            'Approved Withdraw Request' => 'Withdraw/withdrawZil/approve',
            'Rejected Withdraw Request' => '/Withdraw/withdrawZil/reject'
          ],
        ];
        ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="main-content-container container-fluid px-4">
                        <div class="page-header row no-gutters py-4">
                          <div class="text-center text-sm-left mb-0">
                            <span class="text-uppercase page-subtitle">Administrators</span>
                          </div>
                        </div>
                        <?php
                        echo $this->session->flashdata('message');
                        echo form_open();
                        ?>
                        <div class="card">
                          <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade active show" id="perm-content" role="tabpanel" aria-labelledby="perm-tab">
                                <div class="row">
                                  <div class="col-md-4">
                                    <?php foreach ($permissionListArr as $key => $permission) : ?>
                                      <h5 class="border-bottom mt-3"><?php echo $key; ?></h5>
                                      <?php foreach ($permission as $name => $url) : ?>
                                        <div class="form-check">
                                          <label>
                                            <input type="checkbox" name="<?php echo $url; ?>" value="<?php echo $url; ?>" <?php if (!empty($access[$url])) echo 'checked'; ?> class="form-check-input">
                                            <?php echo $name; ?>
                                          </label>
                                        </div>
                                      <?php endforeach; ?>
                                    <?php endforeach; ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <?php echo form_submit(['type' => 'submit', 'value' => 'Permission', 'class' => 'btn btn-primary']); ?>
                                  <a href="<?php echo base_url('Admin/Permissions'); ?>" class="btn btn-dark">Go back</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                        echo form_close();
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php' ?>