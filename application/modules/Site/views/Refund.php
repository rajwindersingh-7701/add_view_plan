<?php require_once'header.php';?>
<style>
	
.refund_policy_sec {
    padding: 60px 0px;
    margin-top: 75px;
}
.refund_policy_txt h1 {
    font-style: normal;
    font-weight: 600;
    font-size: 56px;
    line-height: 74px;
    color: #1D1D1D;
    margin-bottom: 20px;
}
.refund_policy_txt h5 {
    font-style: normal;
    font-weight: 600;
    font-size: 26px;
    line-height: 32px;
    color: #1D1D1D;
    margin-bottom: 15px;
}

.refund_policy_txt p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 26px;
    color: rgba(29, 29, 29, 0.7);
    margin-bottom: 15px;
}
.refund_policy_note {
    background: #FAFAFA;
    border-radius: 10px;
    padding: 30px;
    margin-top: 25px;
}
.refund_policy_note p {
    font-style: normal;
    font-weight: 400;
    font-size: 16px;
    line-height: 26px;
    color: #000000;
}

.refund_policy_note p:last-child {
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
    color: #6646FF;
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

<section class="refund_policy_sec">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="refund_policy_txt">
            <h1>Refund Policy</h1>

            <h5>Grow money  Refund and Cancellation Policy</h5>

            <p>Since Growmoney.me is offering non-tangible irrevocable goods, we do not issue refunds once the order is accomplished and the product is sent. As a customer, you are responsible for understanding this upon purchasing any item at our site.</p>

            <p> However, we realize that exceptional circumstance can take place with regard to the character of the product we supply.</p>
            <p>Therefore, we DO honor requests for the refund on the following reasons:</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="refund_policy_note">
            <p><strong>Non-delivery of the product:</strong> in some cases, the process times are slower, and it may take a little longer for your orders to finish. In this case, we recommend contacting us for assistance. Claims for non-delivery must be submitted to our support department in writing within 72 hours from the order placing the date. </p>

            <p>Otherwise, the campaign will be considered completed. If your order delivery has started, then the delivery will be finished as soon as possible and no refunds will be issued once your order has started processing.</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="refund_policy_note">
            <p><strong>Product not-as-described:</strong> such issues should be reported to our support department within 72 hours from the date of the purchase. Clear evidence must be provided proving that the purchased product is not as it is described on the website.</p>

            <p>  Complaints, which are based merely on the customer’s false expectations or wishes, are NOT honored. Our support team is always eager to assist you and deliver highly professional support in a timely manner. Thank you for purchasing from us.</p>
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
