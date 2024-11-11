<?php require_once 'header.php';?>
<style>
    
.contact_page_sec {
    margin-top: 75px;
    padding: 60px 0px;
    background-image: url('<?php echo base_url('Assets/');?>images/contact_main_bg.svg');
    background-repeat: no-repeat;
    background-repeat: repeat-y;
    background-size: 100%;
    background-position: center left;
    padding-bottom: 0;
}
.contact_main_txt h1 {
    font-style: normal;
    font-weight: 700;
    font-size: 52px;
    line-height: 62px;
    color: #fff;
    font-family: 'Inter', sans-serif;
    margin-bottom: 20px;
}

.contact_main_txt p {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0.02em;
    color: #fff;
    width: 80%;
}
.contact_im {
    margin-top: 100px;
}

.contact_main_frm label {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 19px;
    letter-spacing: 0.02em;
    color: #ffff;
}

.contact_main_frm input {
    background: #FFFFFF;
    margin-bottom: 15px;
    border: 1px solid #EAEAEA;
    height: 56px;
    border-radius: 10px;
    font-size: 14px;
    line-height: 22px;
    font-weight: 400;
    color: #000000;
}


.captcha_wrap {
    text-align: center;
}
.contact_main_frm textarea {
    min-height: 180px;
    resize: none;
}
.contact_main_frm .btn-submit {
    background: #26CE37;
    border-radius: 10px;
    display: inline-block;
    padding: 14px 20px;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    line-height: 23px;
    border: 2px solid #26CE37;
}




</style>



<div class="contact_page_sec">
     <div class="container">
        <div class="row">
           <div class="col-lg-6">
              <div class="contact_main_txt mt-3">
                 <h1>Let’s level up your <br>
                  brand, together</h1>

                  <p>Got a question? Simply want to learn more? Drop us a line and our team of marketing experts will get back to you as soon as possible! Generally in 6-12 hrs!</p>

                  <div class="contact_im">
                     <img src="<?php echo base_url('Assets/');?>images/girlll.svg" alt="a" class="img-fluid">
                  </div>
              </div>
           </div>
           <div class="col-lg-5">
              <div class="contact_main_frm">
                 <form action="#">
                    <div class="form-group">
                       <label for="">Name</label>
                       <input type="text" placeholder="Your name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                       <label for="">Email Address</label>
                       <input type="text" placeholder="you@company.com" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                       <label for="">Order Number (Optional)</label>
                       <input type="text" placeholder=" " id="order_id" class="form-control">
                    </div>
                    <div class="form-group">
                       <label for="">Message</label>
                       <textarea placeholder="How can we help? Tell us!" id="message" class="form-control"></textarea>
                    </div>
                    <div class="row">
                       <div class="col-md-6">
                          <div class="captcha_wrap">
                           <div class="g-recaptcha" data-sitekey="6Lc2Ol0cAAAAABPyunNxNJHPNj7Isk_Wu1xlJ1a_" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"><div style="width: 304px; height: 78px;"><div><iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Lc2Ol0cAAAAABPyunNxNJHPNj7Isk_Wu1xlJ1a_&amp;co=aHR0cHM6Ly92aXJhbHlmdC5jb206NDQz&amp;hl=en&amp;v=Nh10qRQB5k2ucc5SCBLAQ4nA&amp;size=normal&amp;cb=mx0j7ttyikh8" width="304" height="78" role="presentation" name="a-31xy84hhncw" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></div>
                      
                          </div>
                       </div>
                       <div class="col-md-6">
                          <div class="submit_btttns">
                             <button type="button" class="btn btn-submit" onclick="msg_send();">Submit Message</button>
                          </div>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
        </div>
     </div>
  </div>

















<?php require_once 'footer.php';?>