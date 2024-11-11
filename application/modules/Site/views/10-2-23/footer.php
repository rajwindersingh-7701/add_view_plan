
        <!-- Footer Start -->
        <footer id="rs-footer" class="rs-footer">
            <div class="container">
                <div class="footer-newsletter">
                    <div class="row y-middle">
                        <div class="col-md-6 sm-mb-26">
                            <h3 class="title white-color mb-0">Newsletter Subscribe</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <form class="newsletter-form">
                                <input type="email" name="email" placeholder="Your email address" required="">
                                <button type="submit"><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="footer-content pt-62 pb-79 md-pb-64 sm-pt-48">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 footer-widget md-mb-39">
                            <div class="about-widget pr-15">
                                <div class="logo-part">
                                    <a href="#"><img src="<?php echo base_url(logo);?>" alt="Footer Logo" style="
    max-width: 190px;
    background-color: #fff;
    padding: 10px;
    border-radius: 10px;
"></a>
                                </div>
                                <p class="desc">We denounce with righteous indignation in and dislike men who are so beguiled and to demo realized by the charms of pleasure moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound.</p>
                                <div class="btn-part">
                                    <a class="readon" href="#">Discover More</a>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-4 col-md-12 col-sm-12 footer-widget">
                            <h4 class="widget-title">Quick Link</h4>
                                 <ul class="address-widget pr-40">
                               
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/Register/'); ?>">Register</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>
                                </li>
                               
                              
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 md-mb-32 footer-widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <ul class="address-widget pr-40">
                                <li>
                                    <i class="flaticon-location"></i>
                                    <div class="desc"><?php echo address;?></div>
                                </li>
                                <li>
                                    <i class="flaticon-call"></i>
                                    <div class="desc">
                                        <a href="tel:<?php echo $number['phone1'];?>"><?php echo $number['phone1'];?></a>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-call"></i>
                                    <div class="desc">
                                        <a href="tel:<?php echo $number['phone2'];?>"><?php echo $number['phone2'];?></a>
                                    </div>
                                </li>
                                <li>
                                    <i class="flaticon-email"></i>
                                    <div class="desc">
                                        <a href="mailto:<?php echo email;?>"><?php echo email;?></a>
                                    </div>
                                </li>
                              <!--   <li>
                                    <i class="flaticon-clock"></i>
                                    <div class="desc">
                                        10:00 - 17:00
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="row y-middle">
                        <div class="col-lg-6 col-md-8 sm-mb-21">
                            <div class="copyright">
                                <p>© Copyright 2021 <?php echo title;?>. All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 text-right sm-text-center">
                            <ul class="footer-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- start scrollUp  -->
        <div id="scrollUp">
            <i class="fa fa-angle-up"></i>
        </div>
        <!-- End scrollUp  -->

        <!-- Search Modal Start -->
        <div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="flaticon-cross"></span>
            </button>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="search-block clearfix">
                        <form>
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Here..." type="text" required="">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Modal End -->

        <!-- modernizr js -->
        <script src="<?php echo base_url();?>assets/js/modernizr-2.8.3.min.js"></script>
        <!-- jquery latest version -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <!-- Bootstrap v4.4.1 js -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <!-- Menu js -->
        <script src="<?php echo base_url();?>assets/js/rsmenu-main.js"></script> 
        <!-- op nav js -->
        <script src="<?php echo base_url();?>assets/js/jquery.nav.js"></script>
        <!-- owl.carousel js -->
        <script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>
        <!-- Slick js -->
        <script src="<?php echo base_url();?>assets/js/slick.min.js"></script>
        <!-- isotope.pkgd.min js -->
        <script src="<?php echo base_url();?>assets/js/isotope.pkgd.min.js"></script>
        <!-- imagesloaded.pkgd.min js -->
        <script src="<?php echo base_url();?>assets/js/imagesloaded.pkgd.min.js"></script>
        <!-- wow js -->
        <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
        <!-- aos js -->
        <script src="<?php echo base_url();?>assets/js/aos.js"></script>
        <!-- Skill bar js -->
        <script src="<?php echo base_url();?>assets/js/skill.bars.jquery.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.counterup.min.js"></script>        
         <!-- counter top js -->
        <script src="<?php echo base_url();?>assets/js/waypoints.min.js"></script>
        <!-- video js -->
        <script src="<?php echo base_url();?>assets/js/jquery.mb.YTPlayer.min.js"></script>
        <!-- magnific popup js -->
        <script src="<?php echo base_url();?>assets/js/jquery.magnific-popup.min.js"></script>
        <!-- Nivo slider js -->
        <script src="<?php echo base_url();?>assets/inc/custom-slider/js/jquery.nivo.slider.js"></script>
        <!-- plugins js -->
        <script src="<?php echo base_url();?>assets/js/plugins.js"></script>
        <!-- contact form js -->
        <script src="<?php echo base_url();?>assets/js/contact.form.js"></script>
        <!-- main js -->
        <script src="<?php echo base_url();?>assets/js/main.js"></script>
    </body>
</html>