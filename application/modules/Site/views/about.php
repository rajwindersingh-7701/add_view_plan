<?php require_once'header.php';?>

<style>
    .about_hero_sec {
    padding: 60px 0px;
    background-color: #3E28A9;
    margin-top: 75px;
    padding-bottom: 0;
}
.about_hero_txt {
    text-align: center;
}
.about_hero_txt h1 {
    font-style: normal;
    font-weight: 700;
    font-size: 56px;
    line-height: 62px;
    color: #FFFFFF;
    font-family: 'Inter', sans-serif;
    margin-bottom: 20px;
}
.about_hero_txt p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 28px;
    letter-spacing: 0.02em;
    color: #FFFFFF;
}



.about_card_sec {
    padding: 60px 0px;
}
.about_card_box {
    background: #3E28A9;
    border-radius: 20px;
    padding: 25px 20px;
    text-align: center;
}

.about_card_box h5 {
    font-style: normal;
    font-weight: 700;
    font-size: 50px;
    line-height: 62px;
    color: #FFFFFF;
    font-family: 'Inter', sans-serif;
}
.about_card_box p {
    font-style: normal;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    color: #FFFFFF;
    margin-top: 15px;
}

.video_section {
    padding: 60px 0px;
}
.vdo_play {
    background: #C5A2FD;
    border-radius: 20px;
    padding: 50px 20px;
    position: relative;}

.vdo_icon {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.vdo_icon img {
    width: 120px;
}
.about_artical_sec {
    padding: 60px 0px;
}
.about_txt_title h2 {
    font-style: normal;
    font-weight: 700;
    font-size: 52px;
    line-height: 62px;
    color: #070707;
    font-family: 'Inter', sans-serif;
    margin-bottom: 30px;
}
.about_txt_title a {
    background: #26CE37;
    border-radius: 10px;
    display: inline-block;
    font-style: normal;
    font-weight: 700;
    font-size: 18px;
    line-height: 24px;
    color: #FFFFFF;
    font-family: 'Inter', sans-serif;
    padding: 14px 30px;
    transition: all linear .2s;
    border: 1px solid #26CE37;
}

.about_txt_desc p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 23px;
    letter-spacing: 0.02em;
    color: #070707;
    margin-bottom: 25px;
}
.about_artical_sec {
    padding: 60px 0px;
}

.about_txt_title h2 {
    font-style: normal;
    font-weight: 700;
    font-size: 52px;
    line-height: 62px;
    color: #070707;
    font-family: 'Inter', sans-serif;
    margin-bottom: 30px;
}
.about_txt_title p {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0.02em;
    color: #070707;
}

.about_txt_values {
    background: #533BC7;
    border-radius: 20px;
    padding: 50px;
    padding-bottom: 20px;
}

.about_txt_values h3 {
    font-style: normal;
    font-weight: 700;
    font-size: 52px;
    line-height: 62px;
    color: #FFFFFF;
    font-family: 'Inter', sans-serif;
}
.about_txt_values p {
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 28px;
    letter-spacing: 0.02em;
    color: #FFFFFF;
    margin-top: 20px;
}
.contact_section {
    padding: 60px 0px;
    background: #3E28A9;
    padding-bottom: 0;
}
.contact_lft h2 {
    font-style: normal;
    font-weight: 600;
    font-size: 54px;
    line-height: 63px;
    color: #FFFFFF;
    margin-bottom: 15px;
}
.contact_lft h5 {
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 22px;
    letter-spacing: 0.02em;
    color: #FFFFFF;
    margin-bottom: 30px;
}
.contact_lft .media {
    align-items: center;
}
.contact_lft .media img {
    margin-right: 15px;
}
.contact_lft .media h6 {
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 23px;
    letter-spacing: 0.02em;
    color: #fff;
}
.contact_lft .media p {
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 23px;
    letter-spacing: 0.02em;
    color: #fff;
}
.contact_img {
    margin-top: 35px;
}
.contact_form {
    background: #FFFFFF;
    box-shadow: 0px 10.79px 30.85px rgb(0 0 0 / 4%);
    border-radius: 20px;
    padding: 30px;
    margin-top: 10px;
}
.contact_form h5 {
    font-style: normal;
    font-weight: 600;
    font-size: 25px;
    line-height: 32px;
    color: #000000;
    margin-bottom: 20px;
}

.contact_form .form-control {
   background: #a020f01a;
    margin-bottom: 15px;
    border: 1px solid #EAEAEA;
    height: 56px;
    border-radius: 10px;
    font-size: 14px;
    line-height: 22px;
    font-weight: 400;
    color: #000000;
}



.contact_form textarea {
    min-height: 225px;
    resize: none;
}

.contact_form .submit-bttn {
    text-align: right;
}
.g-recaptcha {
    width: 165px;
    float: left;
}
.contact_form .btn-submit {
   background: #a020f0;
    border-radius: 10px;
    display: inline-block;
    padding: 17px 30px;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    line-height: 23px;
    border: 2px solid #a020f0;
}





</style>

<section class="about_hero_sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about_hero_txt">
            <h1>We are on a mission to help you grow on social media! Allowing you to become the ultimate content creator.</h1>

            <p>Take the stress out of growing your online identity with Growmoney ! Our team of experts makes it easy to reach your true potential!</p>

            <img src="<?php echo base_url('Assets/');?>images/teams.svg" alt="a" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </section>




<section class="about_card_sec">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11">
          <div class="row">
            <div class="col-lg-3 col-6 col-md-4">
              <div class="about_card_box">
                <h5>2.9B</h5>
    
                <p>Total Views <br>
                  Delivered</p>
              </div>
            </div>
            <div class="col-lg-3 col-6 col-md-4">
              <div class="about_card_box">
                <h5>75%</h5>
    
                <p>Engagement <br> Increased</p>
              </div>
            </div>
            <div class="col-lg-3 col-6 col-md-4">
              <div class="about_card_box">
                <h5>3.2k</h5>
    
                <p>Positive <br>
                  Reviews</p>
              </div>
            </div>
            <div class="col-lg-3 col-6 col-md-4">
              <div class="about_card_box">
                <h5>100k</h5>
    
                <p>Satisfied <br> Customers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



<section class="video_section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="video_section_wrap">
            <div class="vdo_play">
               <img src="<?php echo base_url('Assets/');?>images/about_vdo.svg" alt="a" class="img-fluid main-vdo">
               

              <div class="vdo_icon">
               <a href="#">
              <img src="<?php echo base_url('Assets/');?>images/about_play_icon.svg" alt="a" class="img-fluid">
            </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="about_artical_sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
            <div class="about_txt_title">
              <h2>Your success is our 
                success. Experience 
                data-driven growth 
                done right!</h2>

                <a href="contact">Contact Us!</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="about_txt_desc">
             <p>From YouTube to Instagram, social media is constantly evolving, stay ahead of the crowd with our exclusive tools. The more engagement you have the higher your content ranks, nobody wants to view content with little to no likes, views, or comments. This means you position yourself to grow faster with an initial boost!</p>
             <p>We believe in accessible pricing that allows everyone to enjoy the benefits of becoming social media famous! Whether you want thousands of likes, views or plays, or just a few- we have packages to meet the needs of every client.</p>
             <p>What are you waiting for? Start getting the exposure you deserve today and watch your social presence skyrocket like never before!</p>
            </div>
        </div>
      </div>
    </div>
  </section>


<section class="about_artical_sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
            <div class="about_txt_title">
              <h2>Our Mission</h2>
              <p>As influencers and marketers, we know how important it is to stand out from the competition, previously SMM marketing was reserved for major labels, celebrities, and movie studios. This is no longer the case thanks to our innovative marketing platform.  <br>
                We believe everyone deserves a chance to shine on social media, why focus on the heavy lifting when you can turn your attention towards making the best possible content- let your true creativity shine without stressing about how to expand your reach!</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="about_txt_values">
              <h3>Our Values</h3>
              <p>Quality without compromises is our motto! This is why thousands of social media users ranging from novices to experts choose Growmoney  every day.</p>

              <p>The competition is growing by leaps and bounds and you are falling behind- without the proper data-driven marketing you will never stand a chance. Let us be your secret weapon, we utilize quality techniques to bring engagement that can last a lifetime!</p>

              <p>We believe you should never put your sensitive information at risk, which is why we NEVER require passwords or login information to market your social media accounts. This helps to give you peace of mind in knowing that your security is never put at risk. Our aim is to give total privacy to our clients!</p>
            </div>
        </div>
      </div>
    </div>
  </section>


<section class="contact_section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="contact_lft">
            <h2>Let's Talk!</h2>

            <h5>Got a question? Simply want to learn more? Drop us a line and our team of marketing experts will get
              back to you as soon as possible! Generally in 6-12 hrs!</h5>

            <div class="media">


              <img src= "<?php echo base_url('Assets/');?>images/mail_icon.svg"alt="a" class="img-fluid">
              <div class="media-body">
                <h6>E-mail</h6>
                 <p>growmoney.me@gmail.com</p>
              </div>
            </div>
            <div class="contact_img">
              <img src="<?php echo base_url('Assets/');?>images/contact_im.png" alt="a" class="img-fluid">

              
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact_form" style="margin-bottom: 6px;">
            <h5>Send us a message</h5>
            <form action="#">

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" placeholder="Full Name" id="name" class="form-control">
                  </div>
                </div>
                <!--<div class="col-lg-6">-->
                <!--  <div class="form-group">-->
                <!--    <input type="text" placeholder="Phone Number" class="form-control">-->
                <!--  </div>-->
                <!--</div>-->
                <div class="col-lg-12">
                  <div class="form-group">
                    <input type="text" placeholder="Email Address" id="email" class="form-control">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <textarea name="" placeholder="Write your message" id="message" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="submit-bttn">
                      <div class="g-recaptcha" data-sitekey="6Lc2Ol0cAAAAABPyunNxNJHPNj7Isk_Wu1xlJ1a_" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"><div style="width: 304px; height: 78px;"><div><iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Lc2Ol0cAAAAABPyunNxNJHPNj7Isk_Wu1xlJ1a_&amp;co=aHR0cHM6Ly92aXJhbHlmdC5jb206NDQz&amp;hl=en&amp;v=Nh10qRQB5k2ucc5SCBLAQ4nA&amp;size=normal&amp;cb=cyn6slrrqq02" width="304" height="78" role="presentation" name="a-d4pb43uyb4lz" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></div>
                     
                    <button type="button" class="btn btn-submit" onclick="msg_send();">Submit Message</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>











    <?php require_once'footer.php';?>
