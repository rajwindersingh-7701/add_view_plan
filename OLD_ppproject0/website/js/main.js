(function ($) {
    "use strict";

 /*----------------------------
   wow js active
  ------------------------------ */
   new WOW().init();
    /*----------------------------
        pre-loader active
    ------------------------------ */
    $(window).on("load", function () {
        if ($(".loader")[0]) {
            $(".loader").delay(0).fadeTo(500, 0, function () {
                $(this).remove();
            });
        }

    }); 

    /*----------------------------
        search popup active
    ------------------------------ */
    $('.nav_search_icon').on('click', function () {
        $('.search_popup').addClass('search_popup_show');
        $('.select_lang').css('z-index', '0');
    });
    $('.search_popup_close').on('click', function () {
        $('.search_popup').removeClass('search_popup_show');
        $('.select_lang').css('z-index', 'auto');
    });


    /*----------------------------
        header-background-color, scroll-top and nav-item-scrollSpy active
    ------------------------------ */
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 200) {
            $('.header_bottom').addClass("header_bottom_fixed");
        } else {
            $('.header_bottom').removeClass("header_bottom_fixed");
        }
    });

    /*----------------------------
        landing slider active
    ------------------------------ */
    var owl = $('.owl-carousel.landing_02_wrapper_content')
    owl.owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        items: 1,
        navText: ["PR<br>EV", "NE<br>XT"],
        smartSpeed: 750,
        autoplay: true,
    });

    /*----------------------------
        team slider active
    ------------------------------ */
    $('.owl-carousel.team_slider').owlCarousel({
        loop: true,
        nav: true,
        smartSpeed: 300,
        margin: 30,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });

    /*----------------------------
        team slider active
    ------------------------------ */
    $('.owl-carousel.blog_slider').owlCarousel({
        loop: true,
        nav: true,
        smartSpeed: 300,
        margin: 20,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    /*----------------------------
        team slider active
    ------------------------------ */
    $('.owl-carousel.partner_slider').owlCarousel({
        loop: true,
        nav: false,
        smartSpeed: 800,
        margin: 60,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    
    /*----------------------------
        (home-1)landing background-image change active
    ------------------------------ */

    if ($('.home_one_landing').length > 0) {
        $('.home_one_landing').vegas({
            overlay: !0,
            transition: 'fade',
            slides: [
                { src: 'img/landing_bg_img_01.jpg' },
                { src: 'img/landing_bg_img_02.jpg' },
                { src: 'img/landing_bg_img_03.jpg' }
            ]
        });
    }

    /*----------------------------
        accordion active
    ------------------------------ */
    function toggleIcon(e) {
        $(e.target).prev('.card-header').find('.fa').toggleClass('fa-angle-right fa-angle-down');
    }
    $('.accordion').on('hidden.bs.collapse', toggleIcon);
    $('.accordion').on('shown.bs.collapse', toggleIcon);

    /*----------------------------
        responsive menu active
    ------------------------------ */
    $('.header_brands .currency_icons_close').on('click', function () {
        $('.header_brands').fadeOut();
    });

    /*----------------------------
        timeline active
    ------------------------------ */
    timeline(document.querySelectorAll('.timeline'), {
        forceVerticalMode: 700,
        mode: 'horizontal',
        verticalStartPosition: 'left',
        visibleItems: 4
    });

    /*----------------------------
        marquee active
    ------------------------------ */
    $('.marquee').marquee({
        pauseOnHover: true,
        duplicated: true,
        duration: 10000,
        gap: 0,
        delayBeforeStart: 0,
    });

    /*----------------------------
        tooltip active
    ------------------------------ */
    $('[data-toggle="tooltip"]').tooltip();

    /*----------------------------
        responsive menu active
    ------------------------------ */
    $('.menu_btn').on('click', function () {
        $('nav').toggleClass('show');
        $('.select_lang').css('z-index', '0');
    });
    $('nav ul li a, .menu_close_btn').on('click', function () {
        $('nav').removeClass('show');
        $('.select_lang').css('z-index', '99991');
    });

    /*--------------------------
     scrollUp
    ---------------------------- */	
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
    /*--------------------------
     smooth_scroll
    ---------------------------- */	
    $('.smooth_scroll').click(function () {
        var target = $(this).attr('href');
        $('body, html').animate({
            scrollTop: $(target).offset().top
        }, 900);
        return !1
    });
    // Data images
    //----------------------------------
    $('.background-image').each(function () {
        var src = $(this).attr('data-src');
        $(this).css({
            'background-image': 'url(' + src + ')'
        });
    });
    if ($('.popup-youtube').length > 0) {

        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }
    
    function setAnimation(_elem,_InOut){var animationEndEvent='webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';_elem.each(function(){var $elem=$(this);var $animationType='animated '+$elem.data('animation-'+_InOut);$elem.addClass($animationType).one(animationEndEvent,function(){$elem.removeClass($animationType)})})}
    owl.on('change.owl.carousel',function(event){var $currentItem=$('.owl-item',owl).eq(event.item.index);var $elemsToanim=$currentItem.find("[data-animation-out]");setAnimation($elemsToanim,'out')});var round=0;owl.on('changed.owl.carousel',function(event){var $currentItem=$('.owl-item',owl).eq(event.item.index);var $elemsToanim=$currentItem.find("[data-animation-in]");setAnimation($elemsToanim,'in')})
    owl.on('translated.owl.carousel',function(event){console.log(event.item.index,event.page.count);if(event.item.index==(event.page.count-1)){if(round<1){round++
    console.log(round)}else{owl.trigger('stop.owl.autoplay');var owlData=owl.data('owl.carousel');owlData.settings.autoplay=!1;owlData.options.autoplay=!1;owl.trigger('refresh.owl.carousel')}}});

//google map activation 
//----------------------------------- 
if ($('#gmap').length > 0) {
    new GMaps({
        div: '#gmap',
        lat: -37.8178945, // -37.8178945,144.9630094
        lng: 144.9630094,
        scrollwheel: false,				
        styles: [
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            }
        ]
    }).addMarker({
        lat: -37.8178945, // -37.8178945,144.9630094
        lng: 144.9630094,
        infoWindow: {
            content: '<p>Australia, Envato Level 13, 2 Elizabeth, St. Melbourne, Victoria 3000</p>'
        }
        });

}

//nice select js
//----------------------------------- 
$('select').niceSelect();



})(jQuery);
