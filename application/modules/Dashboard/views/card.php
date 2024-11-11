<?php require_once'header.php';?>
<style>
	.home-bg {
	    background-image: url(https://add599.world/uploads/banner-home.jpg);
	    background-size: cover;
	    background-position: center;
	    border: 1px solid #ddd;
	    box-shadow: 1px 1px 10px #fff;
	    padding: 20px 15px;
	}
	.home-bg::before {
	    position: absolute;
	    content: '';
	    width: 100%;
	    height: 100%;
	    background: rgb(12 12 12 / 78%);
	    left: 0;
	    top: 0;
	    z-index: 0;
	}
	.home-bg * {
	    position: relative;
	    z-index: 8;
	}
	.logo {
	    /* background: #fff; */
	    /* width: 85%; */
	    height: auto;
	    /* padding: 5px; */
	    border: 3px solid #ddd;
	    max-height: 150px;
	    object-fit: contain;
	    margin-left: auto;
	    margin-right: auto;
	    display: block;
	    border-radius: 50%;
	}
	.business-name {
   	 	color: #fff;
	    text-align: center;
	    font-size: 25px;
	    font-weight: 700;
	    letter-spacing: 0.6px;
	    text-transform: uppercase;
	    margin: 10px 0px 5px 0px;
	}
	.font-color {
	    color: #ffffff !important;
	}
	.ratings-ul {
	    list-style-type: none;
	    text-align: center;
	    margin-bottom: 10px;
	    padding-left: 0px;
	}
	.ratings-ul li {
	    display: inline-block;
	    color: yellow;
	    font-size: 22px;
	}
	.home-cta-btns-ul {
	    list-style-type: none;
	    text-align: center;
	    padding-left: 0px;
	}
	.home-cta-btns-ul li {
	    display: inline-block;
	    margin: 0px 2px 10px 2px;
	}
	.home-cta-btns-ul li a i {
	    padding-right: 5px;
	}
	.home-cta-btns-ul li a {
	    color: #fff;
	    /* background: #EAC33D; */
	    background: #0085C4;
	    padding: 7px 10px;
	    font-weight: 500;
	    box-shadow: 0px 0px 10px 1px rgb(255 255 255 / 30%);
	    text-decoration: none;
	    font-size: 13px;
	}
	.home-cta-btns-ul li a {
	    background: #d24b4b !important;
	}
	.contact-points-ul {
    	list-style-type: none;
	    margin-left: 10px;
	    padding-left: 0px;
	}
	.contact-points-ul li {
	    color: #fff;
	    padding: 5px 0px;
	    /* font-weight: 500; */
	    font-size: 17px;
	}
	.contact-points-ul li i {
	    font-size: 16px;
	    background: #0085C4;
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	    text-align: center;
	    box-shadow: 1px 1px 1px #fff;
	}
	.contact-points-ul li i {
	    background: #d24b4b !important;
	}
	.contact-points-ul li span {
	    margin-left: 10px;
	}
	.social-ul {
	    list-style-type: none;
	    margin-left: 0px;
	    text-align: center;
	    margin-bottom: 20px;
	    padding-left: 0px;
	}
	.contact-points-ul li a {
	    color: #fff;
	    text-decoration: none;
	    /* font-weight: 500; */
	}
	.social-ul li {
	    display: inline-block;
	    margin: 0px 5px;
	}
	.social-ul li a i {
	    background: grey;
	    width: 42px;
	    height: 42px;
	    text-align: center;
	    line-height: 41px;
	    border-radius: 50%;
	    transition: all 0.3s ease;
	    border: 1px solid #ddd;
	    font-size: 17px;
	}
	</style>

<div class="main-content">
<div class="page-content">
<div class="col-md-5">
	<div class="home-bg">
                    <div class="home-inner-div">
                        <img src="<?php echo base_url('uploads/dummy-img.jpg');?>" alt="GURNAM SINGH" title="GURNAM SINGH" class="logo">
                        <h1 class="business-name font-color">GURNAM SINGH</h1>
                        <p style="text-align:center" class="font-color"><b><u>GST No:</u></b> &nbsp;</p>
                        <ul class="ratings-ul">
                         	<li><i class="fa fa-star"></i></li>
                         	<li><i class="fa fa-star"></i></li>
                         	<li><i class="fa fa-star"></i></li>
                         	<li><i class="fa fa-star"></i></li>
                        	<li><i class="fa fa-star"></i></li>
                        </ul>

                        <ul class="home-cta-btns-ul">
                             <li>
                                <a href="#">
                                    <i class="fa fa-phone"></i><span>Call</span>
                                </a>
                            </li>
                             <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-whatsapp"></i><span>Whatsapp</span>
                                </a> 
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i><span>Mail</span> 
                                </a> 
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-map-marker"></i><span>Map</span> 
                                </a> 
                            </li>
                        </ul>

                        <ul class="contact-points-ul">
                            <li>
                                <i class="fa fa-user"></i><span class="font-color">GURNAM SINGH | MD ADD599</span> 
                            </li>
                           
                        	<li>
                                <a href="#">
                                    <i class="fa fa-phone"></i><span class="font-color">+91 - 8725940712</span> 
                                </a> 
                            </li>
                            
                            <li>
                                <a href="#">
                                    <i class="fa fa-phone"></i><span class="font-color">+91 - 9872740712</span> 
                                </a> 
                            </li>
                             
                            <li>
                                <a href="#">
                                    <i class="fa fa-phone"></i><span class="font-color">9814240712</span> 
                                </a> 
                            </li>
                                                    <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i><span class="font-color">gurnamrcm712@gmail.com</span> 
                                </a> 
                            </li>
                             
                            <li>
                                <a href="#" target="_blank">
                                    <i class="fa fa-map-marker"></i><span class="font-color">BAWA SCHOOL WALI GALI,PREET NAGAR,BAHONA CHOWNKE,MOGA</span> 
                                </a> 
                            </li>
                            
                        </ul>
                        
                        <!-- <ul class="social-ul">
                            <li>
                                <a href="" target="_blank" title="Facebook">
                                    <i class="fas fa-facebook active-i"></i> 
                                </a> 
                            </li>
                            <li>
                                <a href="" target="_blank" title="Twitter">
                                    <i class="fa fa-twitter active-i"></i> 
                                </a> 
                            </li>
                            <li>
                                <a href="" target="_blank" title="Instagram">
                                    <i class="fa fa-instagram active-i"></i> 
                                </a> 
                            </li>
                            <li>
                                <a href="" target="_blank" title="Youtube">
                                    <i class="fa fa-youtube-play active-i"></i> 
                                </a> 
                            </li> 
                            <li> 
                                <a href="" target="_blank" title="Linkedin">
                                    <i class="fa fa-linkedin active-i"></i> 
                                </a> 
                            </li>
                            <li>
                                <a href="" target="_blank" title="Zoom ID">
                                    <i class="fa fa-video-camera active-i"></i> 
                                </a> 
                            </li>
                            <li>
                                <a href="" target="_blank" title="Telegram">
                                    <i class="fa fa-telegram active-i"></i> 
                                </a> 
                            </li>
                        </ul> -->
                        

                       
                    </div>
                  
                 

                </div>
</div>
</div>
</div>



<?php require_once'footer.php';?>