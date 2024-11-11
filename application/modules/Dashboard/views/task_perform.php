<?php include_once'header.php';?>
<div class="main-content page-content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <section class="col-md-12 content-header">

                    <span style="">Task Perform </span>

                </section>
            </div>

        </div>
    </div>
    <?php if(date('D') != 'Sun'){ ?>

    <div class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="some_div"></div>
                    <!-- <img src="<?php //echo base_url('/uploads/'.$taskId['link'])?>" class="img-fluid"> --> 
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $taskId['link']; ?>" frameborder="0" allowfullscreen></iframe>
                    <!-- <iframe src="<?php //echo $taskId['link'];?>" title="Site " class="w-100"  style="height: 400px;
        width: 100%; "></iframe> -->
                     <!-- <iframe width="560" height="315" src="<?php echo $taskId['link'];?>" title="" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                </div>
            </div>
        </div>
    </div>
    <?php }else{
        echo "Task Perform Only Monday to Saturday !";
        } ?>
</div>  
<?php 
    include_once 'footer.php';
        
        
?>

<script>
var timeLeft = 5;
var elem = document.getElementById('some_div');
var timerId = setInterval(countdown, 1000);

function countdown() {
    if (timeLeft == 0) {
        clearTimeout(timerId);
        taskComplete();
    } else {
        elem.innerHTML = timeLeft + ' seconds remaining';
        timeLeft--;
    }
}
countdown()

function taskComplete(){
        var url = '<?php echo base_url("Dashboard/Task/TaskComplete/".$taskId['id']);?>';
        $.get(url,function(res){
            console.log(res)
             window.location.href='<?php echo base_url("Dashboard/Task")?>';
        },'json')
    }
    </script>