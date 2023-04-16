$(document).ready(function(){

	$('input[placeholder], textarea[placeholder]').placeholder();

	$('input, textarea').focus(function(){
		$(this).data('placeholder', $(this).attr('placeholder'))
		$(this).attr('placeholder', '');
	});
	$('input, textarea').blur(function(){
		$(this).attr('placeholder', $(this).data('placeholder'));
	});

	$('input.mask-phone').mask('+7(999) 999 99 99');

    $(".custom-scrollbar").mCustomScrollbar({
        axis:'y',
        mouseWheel:{
            enable:true,
            scrollAmount:250
        }
    });

    $('.form-amount .minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.form-amount .plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });

    $('.magnificPopup').magnificPopup({
        callbacks: {
            beforeOpen: function() {
                jQuery('body').css('overflow', 'hidden');
            },
            beforeClose: function() {
                jQuery('body').css('overflow', 'auto');
            }
        }
    });

    $('.close-modal').click(function(e) {
       e.preventDefault();
       if (window.parent == window.top) {
          window.parent.$.magnificPopup.close();
       }
    });

    $('.video-iframe').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 300,
      preloader: false,
      fixedContentPos: false
    });

    if($(window).width() > 1200) {
        $(".appointment-online--inner").stick_in_parent();
    }

    $('[data-fancybox]').fancybox();

    $(".service-menu nav .js-arrow").click(function() { 
        $(this).parent().toggleClass("active");
    });

    $(".cabinet-menu .js-mobile-select").click(function() { 
        $(this).parent().toggleClass("active");
    });

    $(".slider-range-cost").slider({
        min: 0,
        max: 30000,
        values: [0,30000],
        range: true,
        stop: function(event, ui) {
        $(".minCost").val($(".slider-range-cost").slider("values",0));
        $(".maxCost").val($(".slider-range-cost").slider("values",1));
      },
       slide: function(event, ui){
       $(".minCost").val($(".slider-range-cost").slider("values",0));
       $(".maxCost").val($(".slider-range-cost").slider("values",1));
      }
    });
        
    $(".minCost").change(function(){
      var value1=$(".minCost").val();
      var value2=$(".maxCost").val();

      if(parseInt(value1) > parseInt(value2)){
        value1 = value2;
        $(".minCost").val(value1);
      }
      $(".slider-range-cost").slider("values",0,value1);   
    });

    $(".maxCost").change(function(){
       var value1=$(".minCost").val();
       var value2=$(".maxCost").val();
            
       if (value2 > 30000) { value2 = 30000; $(".maxCost").val(30000)}

            if(parseInt(value1) > parseInt(value2)){
             value2 = value1;
             $(".maxCost").val(value2);
         }
          $(".slider-range-cost").slider("values",1,value2);
    });

    $('.item-order').toShowHide({
        button: '.more',
        button_close: '.more',
        close_only_button: false,
        box: '.content, .link-edit'
    });

    $('.catalog-page').toShowHide({
        button: '.mob-bt-filter',
        close_only_button: false,
        box: '.catalog-filter',
        onShow: function(el){
            el.addClass('active');
        },
        onHide: function(el){
            el.removeClass('active');
        }
    });

    $('.catalog-panel .item').toShowHide({
        button: '.js-btn-show',
        close_only_button: false,
        box: '.dropdown',
        onShow: function(el){
            el.addClass('active');
        },
        onHide: function(el){
            el.removeClass('active');
        }
    });

    $(document).toShowHide({
        button: '.bt-menu',
        button_close: '.bt-menu',
        close_only_button: false,
        box: '.header-content',
        onShow: function(el){
            el.find('body').addClass('body-hidden');
            el.find('.bt-menu').addClass('close');
        },
        onHide: function(el){
            el.find('body').removeClass('body-hidden');
            el.find('.bt-menu').removeClass('close');
        }
    });

    $('.site-header .menu > ul > li').toShowHide({
        method: 'auto',
        button: '> a',
        box: '.dropdown-menu',
        effect: 'fade',
        anim_speed: 200,
        delay: 10
    });

    $('.site-header').toShowHide({
        button: '.bt-search',
        button_close: '.bt-search',
        close_only_button: false,
        box: '.form'
    });

    $('.site-footer .phones').toShowHide({
        button: '.mob-more',
        button_close: '.mob-more',
        close_only_button: true,
        box: '.mob-hidden'
    });

    $('.site-header .phone').toShowHide({
        button: '.more',
        button_close: '.more',
        close_only_button: false,
        box: '.list',
        effect: 'fade',
        onShow: function(el){
            el.find('.more').addClass('active');
        },
        onHide: function(el){
            el.find('.more').removeClass('active');
        }
    });

    $('.questions-section .item').toShowHide({
        button: '.top',
        button_close: '.top',
        close_only_button: false,
        box: '.answer',
        effect: 'slide',
        onShow: function(el){
            el.find('.top').addClass('active');
        },
        onHide: function(el){
            el.find('.top').removeClass('active');
        }
    });

    $('.services-box .services-tabs a').on('click', function(){
        $('.services-box .services-tabs a').removeClass('active');
        $(this).addClass('active');
        $('.services-box .tab-block').hide();
        $('.services-box .tab-block[data-id='+$(this).data('id')+']').show();
        return false;
    });

    $('.catalog-box .tabs a').on('click', function(){
        $('.catalog-box .tabs a').removeClass('active');
        $(this).addClass('active');
        $('.catalog-box .tab-block').hide();
        $('.catalog-box .tab-block[data-id='+$(this).data('id')+']').show();
        return false;
    });

    $('.slider-gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-thumbnails'
    });

    $('.slider-thumbnails').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-gallery',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        vertical: true,
        verticalSwiping: true,
        responsive: [
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-categories').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-goods').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 749,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-events').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 399,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-stocks').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 399,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-brands').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
        ]
    });

    $('.slider-pairs').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.slider-instagram').slick({
        autoplay: false,
        speed: 600,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.promo-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        //initialSlide: 1,
        arrows: false,
        fade: true,
        asNavFor: '.programs'
    });

    $('.programs').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.promo-slider',
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 479,
                settings: {
                    slidesToShow: 1,
                    arrows: true
                }
            }
        ]
    });

    $('.slider-examples').slick({
        speed: 600
    });

    $('.slider-doctors').slick({
        speed: 600
    });

    if($(window).width() < 750) {
        $('.achievement-section').slick({
            speed: 600,
            slidesToShow: 2,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.site-body .tabs').slick({
            variableWidth: true,
            slidesToShow: 3,
            arrows: false,
            swipeToSlide: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
    }
	
});


    function initMap() {
        // Styles a map in night mode.
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 59.9135912,
                lng: 30.31401
            },
            zoom: 12,
            disableDefaultUI: true
        });
        var image = 'http://belov.com.ua/cosmetology/i/map-marker.png';

        var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(59.9135912, 30.31401),
            map: map,
            title: "Hotel",
            icon: image
        });
    }