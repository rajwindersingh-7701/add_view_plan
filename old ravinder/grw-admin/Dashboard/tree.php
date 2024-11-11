<?php
require_once("include/header.php");

$dataQuery = mysqli_query($db, "SELECT * FROM `user`");
$arrayData = array();

$memberArray = array();
$pic = "../../images/dummy.png";
$userId = $_SESSION["admin"]["user_id"];
$userId = "Ad220334";
$id = $_SESSION["user"]["id"];
$id = 31;

if (isset($_GET["uid"])) {
    $userId = $_GET["uid"];
    $userSData = $fu->getUserFromUserName($db, $userId, 'id');
    $userId = $_GET["uid"];
    $id = $userSData['id'];
}
$parent1 = $userId;

$treeData = "[";
$i = 1;
$userSData = $fu->getUserFromUserName($db, $userId);
$pvleft = $fu->pvCount($db, 'left', $id);
$pvRight = $fu->pvCount($db, 'right', $id);
$colorUser = $fu->getPackageColor($db, $userSData['package']);

if (empty($colorUser)) {
    $colorUser = "free.png";
}

$pv = $pvleft . " : " . $pvRight;

$treeData .= "{memberId:'$parent1',";
$treeData .= "parentId:null,";
$treeData .= "parentname:'YOU',";
$treeData .= "pv:'$pv',";
$treeData .= "name:'you',";
$treeData .= "pic:'" . $userSData['picture'] . "',";
$treeData .= "date:'" . $userSData['Date'] . "',";
$treeData .= "color:'$colorUser'},";
$while = true;
$attr = 1;
$sponserArray1 = array();
$sponserArray = array();
$level = 1;
$index = 1;
$while = true;
echo 'fsdf';
while ($while == true) {
    echo 'fsdf11';
    if ($level > 1) {
        $m = $index - 1;
        $userId = $sponserArray[$m];
    }
    // $userId = $dataUser["user_id"];
    $parent = $userId;


    $arrayData1 = array();
    $arrayData2 = array();

    $dataQuery1 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` where sponser='$userId' and position='left'"));
    $dataQuery2 = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `user` where sponser='$userId' and position='right'"));

    $sponserData = $fu->getUserFromUserName($db, $userId);


    $pv = $pvleft . " : " . $pvRight;
    if (isset($dataQuery1['id'])) {
        $userSData = $fu->getUserFromUserName($db, $dataQuery1['user_id']);
        $pvleft = $fu->pvCount($db, 'left', $dataQuery1['id']);
        $pvRight = $fu->pvCount($db, 'right', $dataQuery1['id']);

        $packId = $userSData["package"];
        $colorUser = $fu->getPackageColor($db, $packId);
        if (empty($colorUser)) {
            $colorUser = "free.png";
        }

        $pv = $pvleft . " : " . $pvRight;
        $sponserArray1[] = $dataQuery1['user_id'];
        $treeData .= "{memberId:'" . $dataQuery1['user_id'] . "',";
        $treeData .= "parentId:'" . $parent . "',";
        $treeData .= "parentname:'" . $sponserData['name'] . "',";
        $treeData .= "pv:'$pv',";
        $treeData .= "name:'" . $dataQuery1['name'] . "',";
        $treeData .= "pic:'" . $userSData['picture'] . "',";
        $treeData .= "date:'" . $userSData['Date'] . "',";
        $treeData .= "color:'$colorUser'},";
    } else {
        $treeData .= "{memberId:'Add New',";
        $treeData .= "parentId:'" . $parent . "',";
        $treeData .= "position:'left',";
        $treeData .= "pv:'',";
        $treeData .= "name:'name',";
        $treeData .= "pic:'$pic',";
        $treeData .= "color:'blah'},";
    }

    if (isset($dataQuery2['id'])) {
        $userSData = $fu->getUserFromUserName($db, $dataQuery2['user_id']);
        $pvleft = $fu->pvCount($db, 'left', $dataQuery2['id']);
        $pvRight = $fu->pvCount($db, 'right', $dataQuery2['id']);

        $packId = $userSData["package"];
        $colorUser = $fu->getPackageColor($db, $packId);
        if (empty($colorUser)) {
            $colorUser = "free.png";
        }

        $pv = $pvleft . " : " . $pvRight;
        $sponserArray1[] = $dataQuery2['user_id'];
        $treeData .= "{memberId:'" . $dataQuery2['user_id'] . "',";
        $treeData .= "parentId:'" . $parent . "',";
        $treeData .= "parentname:'" . $sponserData['name'] . "',";
        $treeData .= "pv:'$pv',";
        $treeData .= "name:'" . $dataQuery2['name'] . "',";
        $treeData .= "pic:'" . $userSData['picture'] . "',";
        $treeData .= "date:'" . $userSData['Date'] . "',";
        $treeData .= "color:'$colorUser'},";
    } else {
        $treeData .= "{memberId:'Add New',";
        $treeData .= "parentId:'" . $parent . "',";
        $treeData .= "position:'right',";
        $treeData .= "pv:'',";
        $treeData .= "name:'name',";
        $treeData .= "pic:'$pic',";
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
    #mainContainer{
        /*background:Red;*/
        color:#fff;
        min-width:850px;
    }
    .container{
        text-align:center;
        margin:10px .5%;
        padding:10px .5%;
        /* background:linear-gradient(to left, green, #8DC247);*/
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
        color:#fff

    }
    .member:after{
        display:block;
        position:absolute;
        left:50%;
        width:1px; 
        height:20px;
        background:#000;
        content:" ";
        bottom:100%;
    }
    .member:hover{
        z-index:   2;
    }
    .member .metaInfo{
        display:none;
        border:solid 2px #ff9800;
        background:#fff;
        position:absolute;
        bottom:100%;
        left:50%;
        padding:5px;
        width:150px;
        color:#000;
    }
    .member:hover .metaInfo{
        display:block;   
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
        color: #fff;
        padding:5px;
        font-weight:800;
        float: left;
        margin-left: 20px;
    }
</style>

<div class="main-container mt-152">

    <div class="page-header mt-15">

        <div class="pull-left">

            <h2>Users </h2>

        </div>
        <div class="clearfix"></div>

    </div>

    <div class="row-fluid">

        <div class="span12">

            <div class="widget">
    <div class="pull-left">
        <h2>Team Tree </h2>
    </div>
    <div style="width:67%;float: right">
        <ul class="pk">
            <li ><img src='../../images/tree/free.png'><br><span style="text-align: center;margin-left: 10px;color:#000">Free</span></li>
            <?php
            $packQuery = mysqli_query($db, "SELECT * FROM `package` where status='1'");


            while ($pack = mysqli_fetch_array($packQuery)) {
                ?>
                <li ><img src='../../images/tree/<?php echo $pack['color']; ?>'><br><span style="text-align: center;margin-left: 10px;color:#000"><?php echo $pack['price']; ?></span></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="main-container">
        <?php if (isset($_GET['uid'])) { ?>

            <div class="pull-left">
                <a href="tree.php" style="font-size:20px" class="btn btn-default">Reset </a>
            </div>

        <?php } ?>  
        <div class="pull-right">
            <form action="" method="get">
                <input type='text' style="margin-top:10px" name="uid"  placeholder="Enter user id">
                <button type='sunmit' class="btn btn-default" ><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
        </div>
        <div style="width:100%; float:left; text-align:center"><img src="assets/img/1115070048.png" /></div>
        <div id="mainContainer" class="clearfix"></div>

    </div>
</div>
</div>
</div>
</body> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<!--<script src="assets/js/jquery.min.js"></script>-->
<script>
    var members =<?php echo $treeData; ?>;
    console.log(members);
    (function heya(parentId) {
        // This is slow and iterates over each object everytime.
        // Removing each item from the array before re-iterating 
        // may be faster for large datasets.
        for (var i = 0; i < members.length; i++) {
            var member = members[i];
            if (member.parentId === parentId) {
                var parent = parentId ? $("#containerFor" + parentId) : $("#mainContainer"),
                        memberId = member.memberId;
                var name = member.name;
                var color = member.color;
                var membername = member.parentname;
                var ratio = member.pv;
                var testImgSrc = member.pic;
                if (testImgSrc === "") {
                    var testImgSrc = "assets/img/dummy.jpg";
                }

                var img = "this.src='assets/img/dummy.jpg'";
                if (memberId === "Add New") {
                    metaInfo = "<img src='../../images/qmm.jpg'/>";
                    parent.append("<div class='container' id='containerFor" + memberId + "'><a href='../../Register.php?sponsor=" + member.parentId + "&position=" + member.position + "'><div class='member' style='background:transparent; width:49%;margin:0 auto;color:#000; padding:10px 5px;'><img src='../../images/tree/add.png'><br />" + memberId + "</div></a></div>");
                } else {
                    metaInfo = "<img   src='" + testImgSrc + "' onerror=" + img + "/><br>Sponser:-" + membername + " (<span style='color:green'>" + member.parentId + "</span>)<br>$(L:R):- " + ratio + "<br><br>Date: " + member.date;
                    parent.append("<div  class='container' id='containerFor" + memberId + "'><a href='?uid=" + memberId + "' ><div class='member' style='background:transparent;border-bottom: 1px dotted; width:49%;margin:0 auto;color:#000'>  <img src='../../images/tree/" + color + "'><br />" + name + "<br>" + memberId + "<div class='metaInfo'>" + metaInfo + "</div></div></a></div>");
                }

                heya(memberId);
            }
        }
    }(null));

// makes it pretty:
// recursivley resizes all children to fit within the parent.
    var pretty = function () {
        var self = $(this),
                children = self.children(".container"),
                // sXBTract 4% for margin/padding/borders.
                width = (100 / children.length) - 2;
        children
                .css("width", width + "%")
                .each(pretty);

    };
    $("#mainContainer").each(pretty);

</script>
</html>
