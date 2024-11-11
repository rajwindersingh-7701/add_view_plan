<?php require_once'header.php';?>

<style class="cp-pen-styles">

.sitemap {
    width: 100%;
    overflow: scroll;
    margin: 60px 0px;
}
.sitemap a {
  color: #000;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  margin: 0 5px;
  border-radius: 7px;
  text-align: center;
  position: relative;
}

.first > li > a {
  background: #a01ff0;
  width: 150px;
  height: 70px;
  line-height: 70px;
  display: block;
  margin: auto;
}
.first > li > a:after {
  content: "";
  position: absolute;
  left: 50%;
  width: 1px;
  height: 10px;
  background: #9e9f9e;
  top: 100%;
}

.second {
  padding-top: 20px;
}
.second > li {
  display: inline-block;
  vertical-align: top;
}
.second a {
  background: #a01ff0;
  font-size: 14px;
  width: 125px;
  height: 50px;
  line-height: 50px;
  z-index: 10;
}
.second a:before {
  content: "";
  position: absolute;
  border: 1px solid #9e9f9e;
  border-left: none;
  border-bottom: none;
  height: 9px;
  top: -10px;
  left: -156px;
    width: 216px;
}
.second li:first-child a:before {
  border-top: none;
}

.third {
  margin-left: 16px;
  padding-top: 20px;
}
.third a {
  background: #e4e4e3;
  width: 185px;
  height: 40px;
  line-height: 40px;
  margin-bottom: 10px;
  z-index: 5;
  font-size: 10px;
}
.third a:before {
  border: 1px solid #9e9f9e;
  border-right: none;
  border-top: none;
  height: 55px;
  top: -35px;
  left: -8px;
  width: 7px;
}

@media screen and (max-width:767px){
    ul.first {
        width: 1200px;
        overflow: scroll;
    }
}
</style>
<div class="container mt-5 pt-3">
  
  <div class="sitemap">
    <ul class="first">
      <li><a href="<?php echo base_url('');?>" class="text-white">Home</a>
        <ul class="second">
          <li><a href="#" class="text-white">Instagram</a>
            <ul class="third">
                <li><a href="<?php echo base_url('Site/Main/insta');?>">buy-instagram-followers</a></li>
				<li><a href="<?php echo base_url('Site/Main/like');?>">buy-instagram-likes</a></li>
				<li><a href="<?php echo base_url('Site/Main/view');?>">buy-instagram-views</a></li>
				<li><a href="<?php echo base_url('Site/Main/autolike');?>">buy-instagram-auto-likes</a></li>
				<li><a href="<?php echo base_url('Site/Main/comments');?>">buy-instagram-comments</a></li>
				<li><a href="<?php echo base_url('Site/Main/storyview');?>">buy-instagram-story-views</a></li>
				<li><a href="<?php echo base_url('Site/Main/reelview');?>">buy-instagram-reel-views</a></li>
            </ul>
          </li>
          <li><a href="#" class="text-white">Youtube</a>
            <ul class="third">
                <li><a href="<?php echo base_url('Site/Main/youtubelike');?>">buy-youtube-likes</a></li>
                <li><a href="<?php echo base_url('Site/Main/youtube');?>">buy-youtube-subscribers</a></li>
                <li><a href="<?php echo base_url('Site/Main/youtubeview');?>">buy-youtube-views</a></li>
			    <li><a href="<?php echo base_url('Site/Main/youtubecomments');?>">buy-youtube-comments</a></li>
			    <li><a href="<?php echo base_url('Site/Main/youtubeshares');?>">buy-youtube-shares</a></li>
            </ul>
          </li>
          <li><a href="#" class="text-white">Twitter</a>
            <ul class="third">
                <li><a href="<?php echo base_url('Site/Main/twitter');?>">buy-twitter-followers</a></li>
				<li><a href="<?php echo base_url('Site/Main/twitterretweets');?>">buy-twitter-retweets</a></li>
				<li><a href="<?php echo base_url('Site/Main/twitterlikes');?>">buy-twitter-likes</a></li>
            </ul>
          </li>
          <li><a href="#" class="text-white">Facebook</a>
            <ul class="third">
                <li><a href="<?php echo base_url('Site/Main/facebook');?>">buy-facebook-likes</a></li>
			    <li><a href="<?php echo base_url('Site/Main/postlikes');?>">buy-facebook-post-likes</a></li>
			    <li><a href="<?php echo base_url('Site/Main/followers');?>">buy-facebook-followers</a></li>
			    <li><a href="<?php echo base_url('Site/Main/facebookviews');?>">buy-facebook-views</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url('Dashboard/Register');?>" class="text-white">Register</a></li>
          <li><a href="<?php echo base_url('Dashboard/User/MainLogin');?>" class="text-white">Login</a></li>
        </ul>
      </li>
    </ul>
</div>
</div>
  
 
<?php require_once'footer.php';?>