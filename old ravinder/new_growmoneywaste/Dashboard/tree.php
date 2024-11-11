<?php
require_once("header.php");
// die;
?>

<div class="col-lg-12">
  
        <div class="row">
          
            <div class="col-md-2 text-right">
                <h4> Search  ID :</h4>
            </div>
            <div class="col-md-4">
                <div class="pull-right2 wit6g">
                    <form action="" method="get">
                        <div class="input-group search-box">								
                            <input type="text" id="search"  name="uid" class="form-control" placeholder="Enter user id">
                            <span class="input-group-btn">
                                <button type="sunmit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    <section class="content">
        <?php
        $memberArray = array();
        $pic = "../images/dummy.png";
        $userId = $_SESSION["user"]["user_id"];
        $uuid = $userId;
        $id = $_SESSION["user"]["id"];
        if (isset($_GET["uid"])) {
            $userId = $_GET["uid"];
            $datatest = mysqli_num_rows(mysqli_query($db, "select id from downline_count where `tag_sponsor`='$uuid' and `user_id`='$userId'"));
            if ($datatest == 0) {
                die('<h1 style="color:#fff">This is not a valid id.');
            }
            $userSData = $userClass->getUserFromUserId($db, $userId, 'id');
            $id = $userSData['id'];
        }
        $parent1 = $userId;
        $treeData = "[";
        $i = 1;
        $userSData = $userClass->getUserFromUserId($db, $userId);
        $pvleft = $userClass->pvCount($db, 'left', $id);
        $pvRight = $userClass->pvCount($db, 'right', $id);


        $leftsmw23 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM down_count_total WHERE `userId`='$id'"));
        $pvleftnum = $leftsmw23['leftPaid'];
        $pvRightnum = $leftsmw23['rightPaid'];
        $colorUser = $userClass->getPack($db, $userSData['package']);
        if (empty($colorUser)) {
            $colorUser = "free.png";
        }
        $pv = $pvleft . " : " . $pvRight;
        $pvn = $pvleftnum . " : " . $pvRightnum;
        $sp_by21 = mysqli_fetch_array(mysqli_query($db, "SELECT `name`,`sponser_by` FROM `user` where user_id='$parent1'"));
        $sponsor_by21 = $sp_by21['sponser_by'];
        $tt = $sp_by21['name'];
        $treeData .= "{memberId:'$parent1',";

        $treeData .= "parentId:null,";
        $treeData .= "sp:'$sponsor_by21',";
        $treeData .= "pv:'$pv',";
        $treeData .= "users:'$pvn',";
        $treeData .= "name:'$tt',";
        $treeData .= "pic:'" . $userSData['picture'] . "',";
        $treeData .= "color:'$colorUser'},";
        $while = true;
        $attr = 1;
        $sponserArray1 = array();
        $sponserArray = array();
        $level = 1;
        $index = 1;
        $while = true;
        while ($while == true) {

            if ($level > 1) {

                $m = $index - 1;

                $userId = $sponserArray[$m];
            }
            $parent = $userId;
            $arrayData1 = array();
            $arrayData2 = array();
            $dataQuery1 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` where sponser='$userId' and position='left'"));
            $dataQuery2 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` where sponser='$userId' and position='right'"));
            $sponserData = $userClass->getUserFromUserId($db, $userId);
            $pv = $pvleft . " : " . $pvRight;
            $pvn = $pvleftnum . " : " . $pvRightnum;
            if (isset($dataQuery1['id'])) {
                $userSData = $userClass->getUserFromUserId($db, $dataQuery1['user_id']);

                $pvleft = $userClass->pvCount($db, 'left', $dataQuery1['id']);

                $pvRight = $userClass->pvCount($db, 'right', $dataQuery1['id']);
                $leftsmw2 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM down_count_total WHERE `userId`='" . $dataQuery1['id'] . "'"));

                $pvleftnum = $leftsmw2['leftPaid'];
                $pvRightnum = $leftsmw2['rightPaid'];
                $packId = $userSData["package"];

                $colorUser = $userClass->getPack($db, $packId);

                if (empty($colorUser)) {

                    $colorUser = "free.png";
                }



                $pv = $pvleft . " : " . $pvRight;
                $pvn = $pvleftnum . " : " . $pvRightnum;

                $sp_by11 = mysqli_fetch_array(mysqli_query($db, "SELECT `sponser_by` FROM `user` where user_id='" . $dataQuery1['user_id'] . "'"));
                $sponsor_by11 = $sp_by11['sponser_by'];

                $sponserArray1[] = $dataQuery1['user_id'];

                $treeData .= "{memberId:'" . $dataQuery1['user_id'] . "',";

                $treeData .= "parentId:'" . $parent . "',";
                $treeData .= "sp:'$sponsor_by11',";

                $treeData .= "pv:'$pv',";
                $treeData .= "users:'$pvn',";

                $treeData .= "name:'" . $dataQuery1['name'] . "',";

                $treeData .= "color:'$colorUser'},";
            } else {

                $treeData .= "{memberId:'Add New',";

                $treeData .= "parentId:'" . $parent . "',";

                $treeData .= "position:'left',";
                $treeData .= "sp:'',";
                $treeData .= "pv:'',";

                $treeData .= "name:'name',";

                $treeData .= "color:'blah'},";
            }



            if (isset($dataQuery2['id'])) {

                $userSData = $userClass->getUserFromUserId($db, $dataQuery2['user_id']);

                $pvleft = $userClass->pvCount($db, 'left', $dataQuery2['id']);

                $pvRight = $userClass->pvCount($db, 'right', $dataQuery2['id']);

                $leftsmw1 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM down_count_total WHERE `userId`='" . $dataQuery2['id'] . "'"));

                $pvleftnum = $leftsmw1['left'];
                $pvRightnum = $leftsmw1['right'];


                $packId = $userSData["package"];

                $colorUser = $userClass->getPack($db, $packId);

                if (empty($colorUser)) {

                    $colorUser = "free.png";
                }


                $sp_by12 = mysqli_fetch_array(mysqli_query($db, "SELECT `sponser_by` FROM `user` where user_id='" . $dataQuery2['user_id'] . "'"));
                $sponsor_by12 = $sp_by12['sponser_by'];

                $pv = $pvleft . " : " . $pvRight;
                $pvn = $pvleftnum . " : " . $pvRightnum;
                $sponserArray1[] = $dataQuery2['user_id'];

                $treeData .= "{memberId:'" . $dataQuery2['user_id'] . "',";
                $treeData .= "parentId:'" . $parent . "',";
                $treeData .= "sp:'" . $sponsor_by12 . "',";
                $treeData .= "pv:'$pv',";
                $treeData .= "users:'$pvn',";

                $treeData .= "name:'" . $dataQuery2['name'] . "',";
                $treeData .= "color:'$colorUser'},";
            } else {

                $treeData .= "{memberId:'Add New',";
                $treeData .= "parentId:'" . $parent . "',";
                $treeData .= "sp:'',";
                $treeData .= "position:'right',";
                $treeData .= "pv:'',";
                $treeData .= "name:'name',";
                $treeData .= "color:''},";
            }
            $index -= 1;
            if ($index == 0) {
                if (count($sponserArray1) > 0) {
                    $sponserArray = array();
                    $sponserArray = $sponserArray1;
                    $index = count($sponserArray);
                    $sponserArray1 = array();
                    $level++;
                } else {
                    $while = false;
                    continue;
                }
            }
            $i++;
            if ($level == 4) {
                $while = false;
                continue;
            }
        }

        $treeData .= "]";
        ?>
        <style>
            .member {
                color: #000 !important;
            }
            .member:hover {

                cursor: pointer;
            }
            #mainContainer{
                color:#000;
                width:100%;
            }
            .dashboard-wrapper {
                margin-left: 0px !important;
            }
            .container1{
                text-align:center;
                margin:10px .5%;
                padding:10px .5%;
                float:left;
                overflow:visible;
                position:relative;
            }
            .member{
                background:rgba(38, 38, 38, 0.09);   
                position:relative;
                z-index:   1;
                cursor:default;
                min-height: 10px;
                padding: 0px 5px;
                color:#000
            }
            .member:after {
                display: block;
                position: absolute;
                left: 50%;
                width: 1px;
                height: 20px;
                background: #000;
                content: " ";
                bottom: 100%;
            }
            .member:hover{
                z-index:   2;
            }
            .member .metaInfo{
                display:none;
                border:solid 2px #ff9800;
                background:#000;
                position:absolute;
                bottom:100%;
                left:50%;
                padding:5px;
                width:150px;
                color:#fff;
            }
            .member:hover .metaInfo{
                display:block;   
            }
            .wit6g {
                right: 43px;
                top: 146px;
            }
            .wrapper {
                height: 100%;
                position: inherit;
                overflow-x: hidden;
                overflow-y: auto;
            }
            .member .metaInfo img{
                width:50px;
                height:50px; 
                display:inline-block; 
                padding:5px;
                margin-right:5px;
                vertical-align:top;
                border:solid 1px #aaa;
            }
            .pk > li{
                display: inline;
                color: #000;
                padding:5px;
                font-weight:800;
                float: left;
                margin-left: 10px;
            }			
            .main-container2	
            {				
                width:100%!important;	
            }			
            .pull-left2		
            {			
                float:right;	
            }@media (max-width: 991px){
                .wtht {  
                    width: 100%; 
                    margin: 0px !important; }}
            .content-wrapper {
                background-image: none;
            }
            .bg-black {
                background-color: #fff0 !important;
            }

        </style>
        <div class="main-container main-container2 bg-black">
            <div style="width:100%;float:right">
                <ul class="pk">
                    <li ><img src='../images/tree/free.png' ><br><span style="text-align: center;margin-left: 10px;color:red">Free</span></li>
                    <?php
                    $packQuery = mysqli_query($db, "SELECT * FROM `package` where status='1'");
                    while ($pack = mysqli_fetch_array($packQuery)) {
                        ?>
                        <li ><img src='../images/tree/<?php echo $pack['color']; ?>'><br><span style="text-align: center;margin-left: 10px;color:#000"><?php echo $pack['price']; ?></span></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="clearfix"></div>
            <div class="main-container main-container2">
                <?php if (isset($_GET['uid'])) { ?>
                    <div class="pull-left ">
                        <a href="tree.php" style="font-size:20px" class="btn btn-default">Reset </a>
                    </div>
                <?php } ?>  

                <div style="width:100%; float:left; text-align:center"><img src="dist/img/1115070048.png" /></div>

                <div id="mainContainer" class="clearfix"></div>
            </div>
        </div>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script>-->
<script>

    var members =<?php echo $treeData; ?>;
    console.log(members);
    (function heya(parentId) {
        for (var i = 0; i < members.length; i++) {
            var member = members[i];
            var mbparent = member.parentId;
            if (mbparent != null) {
                mbparent = mbparent.split('.').join("");
            }
            var parentId1 = parentId;
            if (parentId != null) {
                parentId1 = parentId.split('.').join("");
            }
            if (mbparent === parentId1) {

                var parent = parentId1 ? $("#containerFor" + parentId1) : $("#mainContainer"),
                        memberId = member.memberId;

                var memberId1 = memberId;
                if (memberId != null) {
                    memberId1 = memberId.split('.').join("");
                }
                var name = member.name;
                var color = member.color;
                var sp = member.sp;
                var ratio = member.pv;
                var user = member.users;
                var img = "this.src='assets/img/dummy.jpg'";
                if (memberId === "Add New") {
                    metaInfo = "<img src='../images/qmm.jpg' class='tree-img'/>";
                    parent.append("<div class='container1' id='containerFor" + memberId1 + "'><a href='../register.php?sponsor=" + member.parentId + "&position=" + member.position + "'><div class='member' style='background:transparent; width:23%;margin:0 auto;color:#000; padding:10px 5px;'><img src='../images/tree/add.png' class='tree-img'><br />" + memberId + "</div></a></div>");
                } else {
                    metaInfo = "Sponser:" + member.sp + "<br>(L:R):- " + ratio + "<br>";
                    parent.append("<div  class='container1' id='containerFor" + memberId1 + "'><a href='?uid=" + memberId + "' ><div class='member' style='background:transparent;border-bottom: 1px dotted; width:29%;margin:0 auto;color:#000'>  <img src='../images/tree/" + color + "' class='tree-img'><br />" + name + "<br>" + memberId + "<div class='metaInfo'>" + metaInfo + "</div></div></a></div>");
                }
                heya(memberId);
            }
        }
    }(null));
    var pretty = function () {
        var self = $(this),
                children = self.children(".container1"),
                width = (100 / children.length) - 2;

        children
                .css("width", width + "%")

                .each(pretty);
    };
    $("#mainContainer").each(pretty);
</script>

<script>

    jQuery(".treeview-menu").hide();
    jQuery(".treeview").removeClass("active");
    jQuery(".menu3>ul").show();
    jQuery(".menu3").addClass("active");
</script>
<script>
    $(".member").load(function () {
        alert('alert')
                ;
    })</script>
</div></div>
<?php include "footer.php" ?>