<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script type="text/javascript" src="<?php echo base_url('Assets/');?>css/1.txt"></script><script type="text/javascript" src="<?php echo base_url('Assets/');?>css/1(1).txt"></script><script type="text/javascript" src="<?php echo base_url('Assets/');?>js/moatframe.js"></script>

	
	<!-- Meta -->
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="">
	<meta name="description" content="<?php echo title;?>">
	<meta property="og:title" content="<?php echo title;?>">
	<meta property="og:description" content="<?php echo title;?>">
	
	<meta name="format-detection" content="telephone=no">
	
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Title -->
	<title><?php echo title;?></title>
    
	<!-- Favicon icon -->
    <link rel="shortcut icon" href="<?php echo base_url('uploads/');?>favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Stylesheet -->
    <link href="<?php echo base_url('Assets/');?>css/bootstrap-select.min.css" rel="stylesheet">
	 <link href="<?php echo base_url('Assets/');?>css/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url('Assets/');?>css/lightgallery.min.css" rel="stylesheet">
	<link href="<?php echo base_url('Assets/');?>css/animate.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">

	
	<!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/style.css">
	<link class="skin" rel="stylesheet" href="<?php echo base_url('Assets/');?>css/skin-2.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/switcher.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/rangeslider.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/themify-icons.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/flaticon.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url('Assets/');?>css/line-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
	                           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

</head>
<style>
	/* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
}
.logo-header img {
    height: auto;
    width: 123px!important;
}
nav{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  height: 70px;
  background: #a020f0;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  z-index: 99;
}
.owl-carousel .owl-item span {
    
    font-weight: 500!important;
}
nav .navbar{
  height: 100%;
  max-width: 1250px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: auto;
  /* background: red; */
  padding: 0 50px;
}
.navbar .logo a{
  font-size: 30px;
  color: #fff;
  text-decoration: none;
  font-weight: 600;
}
nav .navbar .nav-links{
  line-height: 70px;
  height: 100%;
}
nav .navbar .links{
  display: flex;
}
nav .navbar .links li{
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  list-style: none;
  padding: 0 14px;
}
nav .navbar .links li a{
  height: 100%;
  text-decoration: none;
  white-space: nowrap;
  color: #fff;
  font-size: 15px;
  font-weight: 500;
}
.links li:hover .htmlcss-arrow,
.links li:hover .js-arrow{
  transform: rotate(180deg);
  }

nav .navbar .links li .arrow{
  /* background: red; */
  height: 100%;
  width: 22px;
  line-height: 70px;
  text-align: center;
  display: inline-block;
  color: #fff;
  transition: all 0.3s ease;
}
nav .navbar .links li .sub-menu{
  position: absolute;
  top: 70px;
  left: 0;
  line-height: 40px;
  background: #a01ff0;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  border-radius: 0 0 4px 4px;
  display: none;
  z-index: 2;
}
nav .navbar .links li:hover .htmlCss-sub-menu,
nav .navbar .links li:hover .js-sub-menu{
  display: block;
}
.navbar .links li .sub-menu li{
  padding: 0 22px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
}
.navbar .links li .sub-menu a{
  color: #fff;
  font-size: 15px;
  font-weight: 500;
}
.navbar .links li .sub-menu .more-arrow{
  line-height: 40px;
}
.navbar .links li .htmlCss-more-sub-menu{
  /* line-height: 40px; */
}
.navbar .links li .sub-menu .more-sub-menu{
  position: absolute;
  top: 0;
  left: 100%;
  border-radius: 0 4px 4px 4px;
  z-index: 1;
  display: none;
}
.links li .sub-menu .more:hover .more-sub-menu{
  display: block;
}
.navbar .search-box{
  position: relative;
   height: 40px;
  width: 40px;
}
.navbar .search-box i{
  position: absolute;
  height: 100%;
  width: 100%;
  line-height: 40px;
  text-align: center;
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}
.navbar .search-box .input-box{
  position: absolute;
  right: calc(100% - 40px);
  top: 80px;
  height: 60px;
  width: 300px;
  background: #3E8DA8;
  border-radius: 6px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.4s ease;
}
.navbar.showInput .search-box .input-box{
  top: 65px;
  opacity: 1;
  pointer-events: auto;
  background: #3E8DA8;
}
.search-box .input-box::before{
  content: '';
  position: absolute;
  height: 20px;
  width: 20px;
  background: #3E8DA8;
  right: 10px;
  top: -6px;
  transform: rotate(45deg);
}
.search-box .input-box input{
  position: absolute;
  top: 50%;
  left: 50%;
  border-radius: 4px;
  transform: translate(-50%, -50%);
  height: 35px;
  width: 280px;
  outline: none;
  padding: 0 15px;
  font-size: 16px;
  border: none;
}
.navbar .nav-links .sidebar-logo{
  display: none;
}
.navbar .bx-menu{
  display: none;
}
@media (max-width:920px) {
  nav .navbar{
    max-width: 100%;
    padding: 0 25px;
  }

  nav .navbar .logo a{
    font-size: 27px;
  }
  nav .navbar .links li{
    padding: 0 10px;
    white-space: nowrap;
  }
  nav .navbar .links li a{
    font-size: 15px;
  }
}
@media (max-width:800px){
  nav{
    /* position: relative; */
  }
  .navbar .bx-menu{
    display: block;
  }
  nav .navbar .nav-links{
    position: fixed;
    top: 0;
    left: -100%;
    display: block;
    max-width: 270px;
    width: 100%;
    background:#a01ff0;
    line-height: 40px;
    padding: 20px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    transition: all 0.5s ease;
    z-index: 1000;
  }
  .navbar .nav-links .sidebar-logo{
    display: flex;
    /* align-items: center; */
    justify-content: space-between;
  }
  .sidebar-logo .logo-name{
    font-size: 25px;
    color: #fff;
  }
    .sidebar-logo  i,
    .navbar .bx-menu{
      font-size: 25px;
      color: #fff;
    }
  nav .navbar .links{
    display: block;
    margin-top: 20px;
  }
  nav .navbar .links li .arrow{
    line-height: 40px;
  }
nav .navbar .links li{
    display: block;
  }
nav .navbar .links li .sub-menu{
  position: relative;
  top: 0;
  box-shadow: none;
  display: none;
}
nav .navbar .links li .sub-menu li{
  border-bottom: none;

}
.navbar .links li .sub-menu .more-sub-menu{
  display: none;
  position: relative;
  left: 0;
}
.navbar .links li .sub-menu .more-sub-menu li{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.links li:hover .htmlcss-arrow,
.links li:hover .js-arrow{
  transform: rotate(0deg);
  }
  .navbar .links li .sub-menu .more-sub-menu{
    display: none;
  }
  .navbar .links li .sub-menu .more span{
    /* background: red; */
    display: flex;
    align-items: center;
    /* justify-content: space-between; */
  }

  .links li .sub-menu .more:hover .more-sub-menu{
    display: none;
  }
  nav .navbar .links li:hover .htmlCss-sub-menu,
  nav .navbar .links li:hover .js-sub-menu{
    display: none;
  }
.navbar .nav-links.show1 .links .htmlCss-sub-menu,
  .navbar .nav-links.show3 .links .js-sub-menu,
  .navbar .nav-links.show2 .links .more .more-sub-menu{
      display: block;
    }
    .navbar .nav-links.show1 .links .htmlcss-arrow,
    .navbar .nav-links.show3 .links .js-arrow{
        transform: rotate(180deg);
}
    .navbar .nav-links.show2 .links .more-arrow{
      transform: rotate(90deg);
    }
}
@media (max-width:370px){
  nav .navbar .nav-links{
  max-width: 100%;
} 
}
.logo-header {
    display: table;
    float: left;
    vertical-align: middle;
    padding: 0;
    color: #EFBB20;
    margin-top: 0;
    margin-bottom: 0;
    margin-left: 0;
    margin-right: 0;
    width: 170px;
    height: 0px!important;
    position: relative;
    z-index: 9;
    -webkit-transition: all 1s;
    -ms-transition: all 1s;
    transition: all 1s;
}
.sidebar-logo {
    width: 100%;
}


.b-block__add{
  display: block !important;
}

@media (max-width:768px) {
  .sidebar-logo a img {
    width: 150px;
}
.logo-header {
    margin: 0 auto;
}
}
</style>
<body id="bg">

<div class="page-wraper">
	<!-- Header -->
<nav>
  <div class="navbar">
    <i class='bx bx-menu'></i>
 <div class="logo-header">
							<a href="/"><img src="<?php echo base_url('uploads/');?>logo_white.png" alt=""></a>
						</div>
    <div class="nav-links">
      <div class="sidebar-logo">
   <a href="/"><img src="<?php echo base_url('uploads/');?>logo_white.png"   alt="" ></a>
        <i class='bx bx-x' ></i>
      </div>
      <ul class="links">
      	<li class="active"><a href="/"><span>Home</span></a></li>
      	<!-- <li class=""><a href="<?php //echo base_url('uploads/business_plan.pdf');?>" target="_blank"><span>Business Plan</span></a></li> -->
        <!-- <li>
          <a href="#">Instagram</a>
          <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
          <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="<?php echo base_url('Site/Main/insta');?>">buy-instagram-followers</a></li>
					     <li><a href="<?php echo base_url('Site/Main/like');?>">buy-instagram-likes</a></li>
						<li><a href="<?php echo base_url('Site/Main/view');?>">buy-instagram-views</a></li>
						<li><a href="<?php echo base_url('Site/Main/autolike');?>">buy-instagram-auto-likes</a></li>
						<li><a href="<?php echo base_url('Site/Main/comments');?>">buy-instagram-comments</a></li>
						<li><a href="<?php echo base_url('Site/Main/storyview');?>">buy-instagram-story-views</a></li>
						<li><a href="<?php echo base_url('Site/Main/reelview');?>">buy-instagram-reel-views</a></li>
         
          </ul>
        </li> -->




        <!-- <li>
         		 <a href="#">You Tube</a>
         			 <i class='bx bxs-chevron-down js-arrow arrow '  onclick="myFunction()"></i>
         				 <ul class="js-sub-menu sub-menu" id="js-arrow">
          	              <li><a href="<?php echo base_url('Site/Main/youtubelike');?>">buy-youtube-likes</a></li>
                                <li><a href="<?php echo base_url('Site/Main/youtube');?>">buy-youtube-subscribers</a></li>
			           	       <li><a href="<?php echo base_url('Site/Main/youtubeview');?>">buy-youtube-views</a></li>
			           	   	    <li><a href="<?php echo base_url('Site/Main/youtubecomments');?>">buy-youtube-comments</a></li>
			           	   	 	<li><a href="<?php echo base_url('Site/Main/youtubeshares');?>">buy-youtube-shares</a></li>
         				 </ul>
       			 </li> -->

           		 <!-- <li>
          			<a href="#">Twitter</a>
          			<i class='bx bxs-chevron-down js-arrow1 arrow ' onclick="myFunction1()"></i>
         				 <ul class="js-sub-menu sub-menu" id="js-arrows">
        					 	<li><a href="<?php echo base_url('Site/Main/twitter');?>">buy-twitter-followers</a></li>
								<li><a href="<?php echo base_url('Site/Main/twitterretweets');?>">buy-twitter-retweets</a></li>
								<li><a href="<?php echo base_url('Site/Main/twitterlikes');?>">buy-twitter-likes</a></li>
          				</ul>
        		</li> -->


         		 <!-- <li>
          			<a href="#">Facebook</a>
          			<i class='bx bxs-chevron-down js-arrow2 arrow 'onclick="myFunction2()"></i>
         				 <ul class="js-sub-menu sub-menu" id="js-arrowS">
       					<li><a href="<?php echo base_url('Site/Main/facebook');?>">buy-facebook-likes</a></li>
			            <li><a href="<?php echo base_url('Site/Main/postlikes');?>">buy-facebook-post-likes</a></li>
			            <li><a href="<?php echo base_url('Site/Main/followers');?>">buy-facebook-followers</a></li>
			            <li><a href="<?php echo base_url('Site/Main/facebookviews');?>">buy-facebook-views</a></li>
		
          </ul>
        </li> -->


     	<li class="mobile-display">
								<a href="<?php echo base_url('Dashboard/Register');?>">
									<span>Register</span>
								</a>
							</li>
							<li class="mobile-display">
								<a href="<?php echo base_url('Dashboard/User/MainLogin');?>">
									<span>Login</span>
								</a>
							</li>
      </ul>
    </div>
    <div class="search-box d-none">
      <i class='bx bx-search'></i>
      <div class="input-box">
        <input type="text" placeholder="Search...">
      </div>
    </div>
  </div>
</nav>

	<!-- Header End -->
