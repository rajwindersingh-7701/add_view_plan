<?php include_once'header.php'; ?>
<div class="main-content page-content">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Task Perform</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="some_div"></div>
                <div id="player"></div>
                <!-- <img src="<?php //echo base_url('/uploads/'.$taskId['link'])?>"> -->
                <!-- <iframe id="player" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $taskId['link'];?>?autoplay=1&controls=0" title="YouTube video player" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
            </div>
        </div>
      </div>
    </div>
  </div>
<?php 
    include_once 'footer.php';
        
        
?>

<script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100%',
          width: '100%',
          videoId: '<?php echo $taskId['link'];?>',
          autoplay: 1,
          playerVars: {
            'playsinline': 1
            
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
        var timeCurrent = player.getDuration();
        var timeLeft = 10;
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
        
      }

      function taskComplete(){
            var url = '<?php echo base_url("Dashboard/Task/TaskComplete/".$taskId['id']);?>';
            $.get(url,function(res){
                window.location.href='<?php echo base_url("Dashboard/Task")?>';
            },'json')
        }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        //player.stopVideo();
        player.playVideo();
      }
    </script>


<script>


// var player;
// var checkInt; // save this as a var in this scope so we can clear it later
// function onYouTubePlayerAPIReady() {
//    player = new YT.Player('player');
//    startInterval()
// }

// function startInterval() {
//    //checks every 100ms to see if the video has reached 6s
//    checkInt = setInterval(function() {
//        console.log(player.getCurrentTime());
//     //   if (player.getCurrentTime() > 6) {
//     //      changeSrc();
//     //      clearInterval(checkInt);
//     //   };
//    }, 100)
// }


    // var timeLeft = 3;
    // var elem = document.getElementById('some_div');
    // var timerId = setInterval(countdown, 1000);
    // function countdown() {
    //     if (timeLeft == 0) {
    //         clearTimeout(timerId);
    //         taskComplete();
    //     } else {
    //         elem.innerHTML = timeLeft + ' seconds remaining';
    //         timeLeft--;
    //     }
    // }
    // countdown()
    // function taskComplete(){
    //     var url = '<?php echo base_url("Dashboard/Task/TaskComplete/".$taskId['id']);?>';
    //     $.get(url,function(res){
    //         window.location.href='<?php echo base_url("Dashboard/Task")?>';
    //     },'json')
    // }
    </script>