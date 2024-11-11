<?php require_once'header.php';?>


<style>
	


/*=============== GOOGLE FONTS ===============*/
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

:root {
  --accent-color: #a876aa;
}



h1 {
  margin: 50px 0 30px;
  text-align: center;
  color: var(--accent-color);
}

.faq-container {
  max-width: 600px;
  margin: 0 auto;
  border-radius: 10px;
  background-color: #fff;
  overflow: hidden;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
}

.faq {
  box-sizing: border-box;
  background: transparent;
  padding: 30px;
  position: relative;
  overflow: hidden;
}

.faq:not(:first-child) {
  border-top: 1px solid #e6e6e6;
}

.faq-title {
  margin: 0 35px 0 0;
}

.faq-text {
  margin: 30px 0 0;
  display: none;
  line-height: 1.5rem;
}

.faq.active {
  background-color: #f8f8f8;
  box-shadow: inset 4px 0px 0px 0px var(--accent-color);
}

.faq.active .faq-title {
  color: var(--accent-color);
}

.faq.active .faq-text {
  display: block;
}

.faq-toggle {
  background-color: transparent;
  border: 1px solid #e6e6e6;
  color: inherit;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  padding-top: 3px;
  position: absolute;
  top: 30px;
  right: 30px;
  height: 30px;
  width: 30px;
  transition: 0.3s ease;
}

.faq-toggle:focus {
  outline: none;
}

.faq.active .faq-toggle {
  transform: rotate(180deg);
  background-color: var(--accent-color);
  border-color: var(--accent-color);
  color: #fff;
}


.faq_section {
    padding: 60px 0px;
    margin-top: 75px;
}
.faq_lft_wrap h1 {
    font-style: normal;
    font-weight: 700;
    font-size: 52px;
    line-height: 62px;
    color: #070707;
    font-family: 'Inter', sans-serif;
    margin-bottom: 20px;
}


h3.faq-title {
  
    font-weight: 500;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
}

.faq_lft_wrap p {
    font-style: normal;
    font-weight: 400;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0.02em;
    color: #212121;
}

.faq_img {
    margin-top: 70px;
    background-image: url('<?php echo base_url('Assets/');?>images/curvd_bg.svg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain;
}

</style>






<section class="faq_section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="faq_lft_wrap">
            <h1>Frequently Asked <br>
              Questions</h1>

              <p>Got a question? Simply want to learn more? <a href="contact">Drop us a line</a> and our team of marketing experts will get back to you as soon as possible! Generally in 6-12 hrs!</p>

              <!--<div class="faq_searchbar">-->
              <!--  <form action="">-->
              <!--   <div class="form-group">-->
              <!--    <img src="images/search_icon.svg" alt="Search" class="img-fluid">-->
              <!--    <input type="text" placeholder="Ask a question..." class="form-control">-->
              <!--   </div>-->

              <!--    <button type="submit" class="btn btn-search">Search</button>-->
              <!--  </form>-->
              <!--</div>-->

              <div class="faq_img">
                <img src="<?php echo base_url('Assets/');?>images/faq_img.svg" alt="Faq" class="img-fluid">
              </div>
          </div>
        </div>
        <div class="col-lg-6">
          

<!--=============== FONT AWESOME ===============-->


<div class="faq-container">
  <div class="faq">
    <h3 class="faq-title">
    Is it safe to buy Instagram followers on your website? 
    </h3>
    <p class="faq-text">Yes, it is safe to buy Instagram followers from our site. We are not running a scam. What you receive from Growmoney  are genuine services. We don't want our customers to face any unwarranted risk. The followers we supply are high quality. Some sites will scam you and not even deliver the order. We don't work like that. Once you pay for the service our team gets on your case. We provide a tentative delivery date and we always deliver within time. The followers we supply will not harm your account.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq active">
    <h3 class="faq-title">
      How do I get Instagram followers or likes?
    </h3>
    <p class="faq-text">It is very easy to get Instagram followers and likes from Growmoney  We have several services and packages to help our customers boost their social media stats. To get more likes on your posts you have to choose that service. Once you have chosen the service you will be shown a list of packages.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
   What is the normal timeframe it takes to complete an order?
    </h3>
    <p class="faq-text"> we are committed to helping out our customers. When you buy from us you can expect high-quality services delivered within a small time frame. We don't want our customers to wait. In general, you will get the followers and likes delivered in a few hours. It generally takes anywhere from 1 hour to 10 hours to deliver the orders to our customers. Our services are mostly delivered without any delays.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
      How long can I get a free refill?
    </h3>
    <p class="faq-text">We do provide free refills to our customers. Our services are of high quality so you probably won't need to cash that in. Once the order is delivered we give you a 5-day duration during which you can claim a free refill if you notice a drop in the number of followers or likes we have delivered. No refill will be provided after 5 days for free. You will have to buy a new package if you want to boost the number of likes and followers on your Instagram.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>

  <div class="faq">
    <h3 class="faq-title">
     What is the best way to contact a representative if I have questions?
    </h3>
    <p class="faq-text">There are a couple of ways you can reach out to us. You can visit the contact page and fill-up the form or directly mail us at our email. We also have a live chat feature on our website. Once you visit the site look at the bottom right corner. You will see the chat icon. You can use that to drop your query and someone will try to respond.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>


<div class="faq">
    <h3 class="faq-title">
   If a few days have passed since the placement of my order and I am not receiving any followers or likes yet what can I do?
    </h3>
    <p class="faq-text"> At growmoney it is important to us that our clients get the best service possible without any hiccups. But we are ready to take prompt action on any issues that may arise during the transactions or with your order. If the delivery deadline has passed and it has been a few days since you ordered you need to reach out to us.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>


<div class="faq">
    <h3 class="faq-title">
In order to receive followers do I have to follow others in return?
    </h3>
    <p class="faq-text">No. We do not provide that service here. You don't have to do anything from your side to get the followers. Just buy the service you want and we will deliver the followers to you.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>


  <div class="faq">
    <h3 class="faq-title">
    I have a specific request for my order, can you do custom orders?
    </h3>
    <p class="faq-text">We do entertain custom orders from our customers. Many times, our customers may have large orders or need something tailored to their requirements. If it's possible for us to create a custom package for you we will do it. You have to reach out to us with your request and we will do our best to accommodate your needs.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>


<div class="faq">
    <h3 class="faq-title">
    Why should I choose you to buy social media promotions?    </h3>
    <p class="faq-text">We are not new at this game. We have nearly a decade of experience providing social media marketing services to social media users. Creators, marketers and businesses use our sites to grow their social media presence. If a company has been successful in a field for a decade that means it's doing something right and we believe that.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>



<div class="faq">
    <h3 class="faq-title">
   Can I get restricted, banned, or penalized?
    </h3>
    <p class="faq-text">You will not get banned on social media platforms by using our services. We have been providing social media marketing services for many years and none of our customers has faced that issue. So, you don't have to worry about getting banned, penalized or restricted by using our services.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>



<div class="faq">
    <h3 class="faq-title">
Do I need to give my passwords or any other credentials to buy services?    </h3>
    <p class="faq-text">No, not really. We want you to be safe. Do not blindly trust websites and platforms that ask you to give private info like passwords. We don't need your password or other credentials to deliver the service. We only need a small amount of info to deliver your order.</p>
    <button class="faq-toggle">
      <i class="fas fa-angle-down"></i>
    </button>
  </div>





</div>



















        </div>
      </div>
    </div>
  </section>





<script>
	const buttons = document.querySelectorAll(".faq-toggle");

buttons.forEach((button) => {
  button.addEventListener("click", () =>
    button.parentElement.classList.toggle("active")
  );
});

</script>






<?php require_once'footer.php';?>
