<?php $us=mysqli_query($con,"select * from user where loginid='".$_SESSION['userid']."'");
      $us_r=mysqli_fetch_array($us); 
?>
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.php">
       <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Super Digital Coin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="profile.php">
          <i class="zmdi zmdi-face"></i> <span>Profile Setting</span>
        </a>
      </li>
<li><?php  $dat=date('Y-m-d');  $ch=mysqli_query($con,"select count(id) from video_view where userid='".$_SESSION['userid']."' and r_date='$dat'");
	       $ch_r=mysqli_fetch_array($ch);
	       $tvd=$ch_r['0']+1;?>
        <a href="video.php?VID=<?php echo $tvd;?>">
          <i class="zmdi zmdi-assignment"></i> <span>Ad View</span>
        </a>
      </li>
      <li>
        <a href="direct.php">
          <i class="zmdi zmdi-attachment"></i> <span>Direct Team</span>
        </a>
      </li>
      <li>
        <a href="activelevel.php">
          <i class="zmdi zmdi-male-female"></i> <span>My  Team</span>
        </a>
      </li>
      <li>
        <a href="level.php">
          <i class="zmdi zmdi-accounts-add"></i> <span>Level Team</span>
        </a>
      </li>

      <li>
        <a href="selfincome.php">
          <i class="zmdi zmdi-account-box-mail"></i> <span>Self Income</span>
          
        </a>
      </li>
<li>
        <a href="pin_request.php">
          <i class="zmdi zmdi-attachment"></i> <span>Pin Request</span>
        </a>
      </li>
      <li>
        <a href="activate.php">
          <i class="zmdi zmdi-attachment"></i> <span>Activate </span>
        </a>
      </li>
      <li>
        <a href="levelincome.php">
          <i class="zmdi zmdi-card-giftcard"></i> <span>Level Income</span>
        </a>
      </li>

      <li>
        <a href="rewardincome.php" >
          <i class="zmdi zmdi-assignment-check"></i> <span>Reward Income</span>
        </a>
      </li>

       <li>
        <a href="bonazaincome.php" >
          <i class="zmdi zmdi-bike"></i> <span>Bonaza Income</span>
        </a>
      </li>

      <li class="sidebar-header">Withdrwal</li>
      <li><?php if($us_r['status']=='Active'){?><a href="withdrwal.php"><?php }else{?><a href="#" class="nav-link" onclick="alert('Activate Account First');"><?php }?><i class="icon-wallet mr-2 text-danger"></i> <span>Withdrwal Request</span></a></li>
      <li><a href="c_withdrwal.php"><i class="icon-wallet mr-2 text-success"></i> <span>Withdrwal History</span></a></li>
      <li><a href="p_withdrwal.php"><i class="icon-wallet mr-2 text-info"></i> <span>Pending</span></a></li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
    <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-envelope-open-o"></i></a>
    </li>
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
    </li>
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
          <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo $us_r['name'];?></h6>
            <p class="user-subtitle"><?php echo $us_r['loginid'];?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i><a href="news.php"> Notification</a></li>
        
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> <a href="passwordchange.php">Change Password</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> <a href="logout.php">Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>