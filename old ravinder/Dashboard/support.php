<?php require_once 'header.php'; ?>
<!-- Middle Panel -->
<div class="col-lg-9 profile-area">
    <!-- Edit personal info End -->
    <div class="col-md-12">
        <div class="bg-light shadow-md rounded p-4">
            <h2 class="text-6">Send a Request</h2>
            <p>Please fill out the form below and we promise you to get back to you within a couple of hours.</p>

            <form action="controller/support.php" method="post">
                <?php if (isset($_SESSION["support"])) if ($_SESSION["support"]["status"] == 'false') echo "<p id='response-msg' class='false' >" . $_SESSION['support']['msg'] . "</p>"; ?> <?php if (isset($_SESSION["transaction"])) if ($_SESSION["support"]["status"] == 'true') echo "<p id='response-msg' class='true' >" . $_SESSION['support']['msg'] . "</p>";unset($_SESSION["support"]); ?> 
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select name="topic" class="custom-select" id="subject" required="">
                        <option value="">Select Your Subject</option>
                        <!--<option value="Recharge">Recharge &amp; Bill Related Issue</option>-->
                        <option value="General">General</option>
                        <option value="Traning Support">Traning Support</option>
                        <option value="Enquiries">Enquiries</option>
                        <option value="Transection">Transection</option>
                        <option value="Other">Other</option>
                        <!--<option>Other</option>-->
                    </select>
                </div>

                <div class="form-group">
                    <label for="yourProblem">Your Query</label>
                    <textarea name="msg" class="form-control" rows="5" id="yourProblem" required="" placeholder="Specify your query"></textarea>
                </div>
                <button name="support" class="btn btn-default" type="submit">Submit</button>
            </form>
        </div>
    </div>



</div>

<div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading font-bold">
                <h2> &nbsp;&nbsp;&nbsp;Support Ticket List</h2>
            </div>
            <div class="panel-body" style="overflow-x:auto;">

                <table id="tblDataTables" class="table" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <thead class="thead-inverse" style="background-color: #edf1f2;">
                        <tr>
                            <th>Sno
                            </th>
                            <th>Department
                            </th>
                            <th>Message
                            </th>
                            <th>Status
                            </th>
                            <th>Last Updated
                            </th>
                            <th>Chat
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $currentdate = date('Y-m-d H:i:s');
                        $i = 1;
                        $query = mysqli_query($db, "SELECT * FROM `support` where `user_id`= '$user_id' order by id desc");
                        while ($dataQuery = mysqli_fetch_array($query)) {
                            ?>
                            <tr class="input_noborder">
                                <td>
                                    1
                                </td>
                                <td>
                                    <?php echo $dataQuery['topic']; ?>
                                </td>
                                
                                <td>
                                    <?php echo $dataQuery['message']; ?>
                                </td>
                                <td>
                                    <?php echo $dataQuery['status']; ?>
                                </td>
                                <td>
                                    <?php echo $dataQuery['datetime']; ?>
                                </td>
                                <td><a class="btn btn-default" href="support_msg.php?spi=<?php echo $dataQuery['id']; ?>">CHAT</a></td>
                            </tr>
                        <?php } ?>
                    </tbody></table>

            </div>
            <div class="widget-body" id="repMsg">
                <br>
                <span id="ctl00_ContentPlaceHolder1_Label1" class="widget-title"></span>
                <br>
            </div>

        </div>
    </div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->

<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav4").addClass("active");
</script>