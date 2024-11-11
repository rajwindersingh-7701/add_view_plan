<?php include'header.php' ?>
<div id="content" class="main-content">
    <style>
    .text-success {
        color: #117622!important;
        font-size: 14px;
        font-weight: bold;
    }
    </style>
    <h2 class="page-titel">
        <span style="font-size:20px">Rewards Status </span>
    </h2>

    <?php
        $awardsArr = [
            '1' => ['pair' => '50','designation' => 'Star','reward' => '1000 Cash'],
            '2' => ['pair' => '100','designation' => 'Silver ','reward' => '2500 Cash'],
            '3' => ['pair' => '250','designation' => 'Gold','reward' => '5000 Cash'],
            '4' => ['pair' => '500','designation' => 'Gold Star','reward' => '10000 Cash'],
            '5' => ['pair' => '1250','designation' => 'Ruby','reward' => 'Mobile'],
            '6' => ['pair' => '2500','designation' => 'Ruby Star','reward' => 'Laptop'],
            '7' => ['pair' => '5000','designation' => 'Diamond ','reward' => 'Bike'],
            '8' => ['pair' => '15000','designation' => ' Diamond Star','reward' => 'Alto Car'],
            '9' => ['pair' => '30000','designation' => 'Ambasador','reward' => 'Kwid Car'],
            '10' => ['pair' => '50000','designation' => ' Ambasador Star','reward' => 'Swift Dezire'],
            '11' => ['pair' => '100000','designation' => ' Crown ','reward' => 'GM Hactor Plus Car'],
            '12' => ['pair' => '2500000','designation' => 'President','reward' => '1 Crore Cash'],
            // '13' => ['pair' => '300000','designation' => 'Kohinoor Star','reward' => '15000'],
            // '14' => ['pair' => '400000','designation' => 'Kohinoor Star','reward' => '20000'],
            // '15' => ['pair' => '500000','designation' => 'Kohinoor Star','reward' => '25000'],
            // '16' => ['pair' => '1000000','designation' => 'Kohinoor Star','reward' => '50000'],
            // '17' => ['pair' => '2000000','designation' => 'Kohinoor Star','reward' => '100000'],
            // '18' => ['pair' => '3000000','designation' => 'Kohinoor Star','reward' => '150000'],
            // '19' => ['pair' => '4000000','designation' => 'Kohinoor Star','reward' => '200000'],
            // '20' => ['pair' => '5000000','designation' => 'Kohinoor Star','reward' => '250000'],
            // '21' => ['pair' => '6000000','designation' => 'Kohinoor Star','reward' => '300000'],
            // '22' => ['pair' => '10000000','designation' => 'Kohinoor Star','reward' => '500000'],
            // '23' => ['pair' => '14000000','designation' => 'Kohinoor Star','reward' => '700000'],
            // '24' => ['pair' => '20000000','designation' => 'Kohinoor Star','reward' => '1000000'],
            // '25' => ['pair' => '40000000','designation' => 'Kohinoor Star','reward' => '2000000'],
        ];
    ?>
    <div id="rootwizard" class="wizard wizard-full-width">
            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped dataTable" id="tableView">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Matching</th>
                                         <th>Designation</th> -
                                        <th>Bonus</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($awardsArr as $key => $reward) {
                                        $l = $key - 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $key;?></td>
                                            <td><?php echo $reward['pair'];?></td>
                                           <td><?php echo $reward['designation'];?></td> 
                                            <td><?php echo $reward['reward'];?></td>
                                            <td>
                                                <?php
                                                    if(!empty($rewards[$l])){
                                                        if($rewards[$l]['status'] == 0){
                                                            echo '<span class="badge badge-primary">Pending</span>';
                                                        }elseif($rewards[$l]['status'] == 1){
                                                            echo '<span class="badge badge-success">Approved</span>';
                                                        }elseif($rewards[$l]['status'] == 2){
                                                            echo '<span class="badge badge-danger">Rejected</span>';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(!empty($rewards[$l]['award_id'])){
                                                        echo '<span class="badge badge-success">Achieved</span>';
                                                    }else{
                                                        echo '<span class="badge badge-primary">Not Achieved</span>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
    <!-- END wizard -->
</div>






<?php include'footer.php' ?>
