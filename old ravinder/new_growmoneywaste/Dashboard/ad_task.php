<?php
require_once("header.php");
//include '../database/db.php';

$crf = rand(100000, 99999);
$_SESSION['crf'] = $crf;
$page = (isset($_GET['p'])) ? $_GET['p'] : 0;
$query = "select * from `googleadd` where status=0";
$res = mysqli_query($db, $query);
$dta = [];

while ($row = mysqli_fetch_array($res)) {
    $dta[] = $row;
}
$rowscount = COUNT($dta);

if (trim($_SESSION['ad']) != $page and $page != 0) {
//    echo $_SESSION['ad'].'fasd';die;
//    die;
    unset($_SESSION['ad']);
//    echo 'fasdf'.$_SESSION['ad'].'!='. $page;die;
    ?>
    <style>
        div#some_div {
            font-size: 31px;
            text-align: center;
            color: red;
        }
    </style>

    <script>
        window.location.href = "ad_task.php";
    </script>
    <?php
}
$crf = rand(100000, 99999);
$_SESSION['crf'] = $crf;

//print_r($dta[0]);die;
?>

<style>
    .widget.admin-widget.sec {
        padding: 12px 10px;
        min-height: 135px;
    }
    .task-portion {
        width: 100%;
        padding: 20px;
        text-align: center;
    }


</style>
<!-- Middle Panel  -->
<div class="col-lg-9">
    <div class="profile-content">
        <div class="row">
            <div class="col-lg-12 ">
                
                <div id="some_div"  style="font-weight: 800;font-size: 31px;text-align: center;color:#1f59bd">
                </div>
<!--<section class="content-header">-->
                <h3 style="text-align:center;">
                    
                    <bold>Task-<?php echo $page + 1; ?>/</bold>
                    <bold>  Total Task-<?php echo $rowscount; ?></bold>
                </h3>
                <!--</section>-->
                <div class="box-header with-border">
                    <!--<div id='next1' style="float:right;"></div>-->
                    <div style="text-align: center;">
                        <h3 class="box-title">
                        </h3>
                        <?php
                        if ($dta[$page]['url'] != '' and $dta[$page]['image'] == '') {
                            ?>
                            <!--<embed src="<?php // echo $dta[$page]['url']; ?>" width="100%" autoplay height="340">-->
                            <iframe width="100%" autoplay height="340" src="<?php echo $dta[$page]['url']; ?>" frameborder="0" allowfullscreen></iframe>
                            <?php
                        } else {
                            ?>
                            <a href="<?php echo $dta[$page]['url']; ?>" target="_blank"> <img src="<?php echo $dta[$page]['image']; ?>" class="ad-show" style="max-height: 300px; width: auto;margin: 0 auto;"></a> 
                        <?php } ?>

                    </div>
                </div>
                
                <div style="width:100%; float:left; margin:0px 0p">
                    <p>&nbsp;
                    </p>
                    <div class="col-md-12">
                        <!--		<div class="box box-info">
              <div class="box-header with-border"><h3 class="box-title"><strong>List of Direct Bonus (Total:-<?php echo $totalResult; ?>)</strong></h3></div>
              </div>-->
                        <div class="box-body padding" style="background:#FFFFFF; margin-top:-2%">
                            <div class="table-responsive">
                                <div id='next'></div>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Recent Activity End -->
</div>
<!-- Middle Panel End -->
</div>
</div>
</div>
<!-- Content end -->


<?php require 'footer.php'; ?>
<script>
    jQuery(".nav-item").removeClass("active");
    jQuery("#nav1").addClass("active");
</script>
<?php if(date("D")!="Suna" and $userData['binary']!=2){ ?>
<script>
    var timeLeft = 10;
    var elem = document.getElementById('some_div');
    var timerId = setInterval(countdown, 1000);
    function countdown() {

        if (timeLeft == 2) {
//            alert(timeLeft);
//            alert('fsdfs');
            $.ajax({url: "controller/ajax.php?uid=<?php echo $page + 1; ?>&crf=<?php echo $crf; ?>", success: function (result) {
                    console.log(result);
                    if(result == "falsee"){
                       elem.innerHTML = 'Capping Done';
                    }
//                    alert(result);
                }});
            
            elem.innerHTML = 'WAIT FOR NEXT TASK.';
            timeLeft--;
        } else if (timeLeft == 1) {
            timeLeft--;
        } else if (<?php echo $page ?> > <?php echo ($rowscount - 1); ?>) {
               window.location.href = "index.php";
            elem.innerHTML = 'Task Completed';
            elem.innerHTML = result;
           
            clearTimeout(timerId);
          
            doSomething();
            
            

        } else if (timeLeft == 0) {
            var btn = "<input type='button' class='btn btn-default' value='Next Task'>"
            document.getElementById('next').innerHTML = "<a class='btn btn-default' href='ad_task.php?p=<?php echo $page + 1; ?>'>" + btn + "</a>";
            document.getElementById('next1').innerHTML = "<a class='btn btn-default' href='ad_task.php?p=<?php echo $page + 1; ?>'>" + btn + "</a>";
//            window.location.href = "ad_task.php?p=<?php echo $page + 1; ?>";
            clearTimeout(timerId);
            doSomething();
        } else {
            elem.innerHTML = timeLeft + ' seconds remaining';
            timeLeft--;
        }
    }
    
    
    
    var promise = document.querySelector('video').play();

if (promise !== undefined) {
    promise.catch(error => {
        // Auto-play was prevented
        // Show a UI element to let the user manually start playback
    }).then(() => {
        // Auto-play started
    });
}
</script>

<?php }else if(date("D")!="Suna"){
    echo "sunday no task available";
}else if($userData['binary']==2){
    echo "Your id need to be reactivate! You have 3000 limit for 1 time.";
}
?>