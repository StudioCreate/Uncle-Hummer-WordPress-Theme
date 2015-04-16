// Text Fit
jQuery(document).on("animating.slides", function(a){
	setTimeout(function () {
	   'use strict';
		jQuery("h1.fittext").fitText(1, { minFontSize: "50px", maxFontSize: "100px" });
		jQuery("h2.fittext").fitText(1, { minFontSize: "40px", maxFontSize: "80px" });
		jQuery("h3.fittext").fitText(1, { minFontSize: "30px", maxFontSize: "60px" });
		jQuery("h4.fittext").fitText(1, { minFontSize: "20px", maxFontSize: "40px" });
		jQuery("h5.fittext").fitText(1, { minFontSize: "15px", maxFontSize: "30px" });
		jQuery("h6.fittext").fitText(1, { minFontSize: "10px", maxFontSize: "20px" });
	}, 100)
});
// Preloader
jQuery(function () { 
// makes sure the whole site is loaded
	'use strict';
	jQuery('#status').fadeOut(); // will first fade out the loading animation
		jQuery('#preloader').delay(200).fadeOut('slow'); // will fade out the white DIV that covers the website.
	jQuery('body').delay(200).css({'overflow-y':'visible'});
});

// Fullscreen content and background slider / fader
jQuery(function () {
	'use strict';
	jQuery("#slides").superslides({
		// play: 6000,
		animation: "fade", // Choose between slide or fade
		pagination: true // Choose between true or false
	});
});

// Nice Scroll
jQuery(function () {
	'use strict';
	var nice = jQuery("body").niceScroll(); 
});

// Before After Slider
jQuery(function () {
	'use strict';
	window.onload = function () {
		jQuery('.ba-slider').beforeAfter();
	}
});
// Partner Slide
jQuery(function () {
   'use strict';
    if(jQuery('#partners-slider').length) {
	jQuery('#partners-slider').carouFredSel({
		auto: false,
		swipe: {
			onTouch: true,
			onMouse: false
		},
		prev: '#partners-prev',
		next: '#partners-next',
		responsive: true,
		width: '100%',
		height: 'variable', 
		scroll: 1,
		items: {
			width: 360,
			visible: {
				min: 1,
				max: 4
			}
		}
	});
    };
});
// Service Slide
jQuery(function () {
	'use strict';
	if(jQuery('#services-slider').length) {
	jQuery('#services-slider').carouFredSel({
		auto: false,
		swipe: {
			onTouch: true,
			onMouse: false
		},
		prev: '#services-prev',
		next: '#services-next',
		responsive: true,
		width: '100%',
		height: 'variable', 
		scroll: 1,
		items: {
			width: 360,
			height: 'variable',
			visible: {
				min: 1,
				max: 3
			}
		}
	});
    };        
});	 
// 03 - Popup for images
jQuery(function(){
	'use strict';
	jQuery('.popup, popup-image').magnificPopup({ 
		type: 'image',
		fixedContentPos: false,
		fixedBgPos: false,
		mainClass: 'mfp-no-margins mfp-with-zoom',
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300
		}
	});
});
// IE Container Fix
jQuery(function () {
   'use strict';
	jQuery('#container').beforeAfter();
	jQuery('#container1').beforeAfter();
});

// Reviews slider
jQuery(function () {
   'use strict';
	var reviewsslider = jQuery('#reviews-slider').bxSlider({
		auto: true,
		responsive: true,
		adaptiveHeight: true,
		mode: 'fade',
		pager: false,
		controls: false
	});

	jQuery('#reviews-next').click(function () {
   'use strict';
		reviewsslider.goToNextSlide();
		return false;
	});

	jQuery('#reviews-prev').click(function () {
   'use strict';
		reviewsslider.goToPrevSlide();
		return false;
	});
	
});

// Menu toggle
jQuery(function () {
   'use strict';
    jQuery('#toggle').click(function (e){
		e.stopPropagation();
    });
	jQuery('html').click(function (e){
		if (!jQuery('.toggle').is(jQuery(e.target))){
			jQuery('#toggle').prop("checked", false);
		}
	});
});
// Back to Top
jQuery(function () {
	'use strict';
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 800) {
            jQuery('.back-to-top').fadeIn();
        } else {
            jQuery('.back-to-top').fadeOut();
        }
    });

    jQuery('.back-to-top').click(function () {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});
// Captacha Border
jQuery(function () {
	'use strict';
    jQuery("input.wpcf7-captchar").on('focus',function(){
		jQuery("#contactform img.wpcf7-captchac").addClass("preset_border");
	});
	jQuery("body").on('focusout',function(){
		jQuery("#contactform img.wpcf7-captchac").removeClass("preset_border");
	});
});
// Counter
jQuery('.counter').appear(function(){
	'use strict';
	jQuery(this).countTo({
		speed: 3000,
		refreshInterval: 20,
		onComplete: function (value) {
			if(jQuery(this).data("append")){
				jQuery(this).append($(this).data('append'));
			 }
		}
	});
});
// Menu
jQuery(function () {
	'use strict';
	jQuery('.rms-it').onePageNav();
});
// Scroll Smoothly Other Anchor
jQuery(function () {
	'use strict';
	jQuery('.smoothscroll').bind('click.smoothscroll',function (e){
		e.preventDefault();

        var target = this.hash,
        jQuerytarget = jQuery(target);

        jQuery('html, body').stop().animate({
			'scrollTop': jQuerytarget.offset().top-0
        }, 900, 'swing', function () {
			window.location.hash = target;
		});
	});
});
jQuery(function(){
    'use strict';
	if(jQuery(window).width() >= 768){
		jQuery('.rms-it').dropotron({ 
			offsetY: -10
		});
	}
});