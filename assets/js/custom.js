/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '90%', 
		height: '90%'
	});

	$('a.colorboxNoSlide').colorbox({
		width: '90%', 
		height: '90%',
		slideshow: false
	});
	
	/*
	*
	*	Isotope with Images Loaded
	*
	------------------------------------*/
	var $container = $('#container').imagesLoaded( function() {
  	$container.isotope({
    // options
	 itemSelector: '.item',
		  masonry: {
			gutter: 15
			}
 		 });
	});


	/*
	*
	*	Equal Heights Divs
	*
	------------------------------------*/
	$('.js-blocks').matchHeight();


	/*
	*
	*	Smooth Scroll to Anchor
	*
	------------------------------------*/
	$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {

		if( $(this).parents("li").hasClass('menu-item') ) {
			$(".menu li").removeClass('active');
			$(this).parents('li').addClass('active');
		}

	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
			event.preventDefault();
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html, body').animate({scrollTop: target.offset().top - 50 }, 'slow');
			}
	    }
	});

	var scrollTop = $(".scrollTop");
    $(window).scroll(function() {
        var topPos = $(this).scrollTop();
        if (topPos > 100) {
          // $(scrollTop).css({
          //   "opacity":1,
          //   "z-index":3000
          // });
          	$("body").addClass('scrolled');
        } else {
        	$("body").removeClass('scrolled');
          // $(scrollTop).css({
          //   "opacity":0,
          //   "z-index":"-999"
          // });
        }
    });


	/* STICKY NAV */
   	var stickyNavTop = $('#masthead').offset().top;
   	var stickyNav = function(){
	    var scrollTop = $(window).scrollTop(); 
	    if (scrollTop > stickyNavTop) { 
	        $('#masthead').addClass('sticky');
	    } else {
	        $('#masthead').removeClass('sticky'); 
	    }
	};

	stickyNav();
	$(window).scroll(function() {
		stickyNav();
	});


	// Cache selectors
	var lastId,
	 topMenu = $("#primary-menu"),
	 topMenuHeight = topMenu.outerHeight()+1,
	 // All list items
	 menuItems = topMenu.find('a[href*="#"]').not('[href="#"]').not('[href="#0"]'),
	 // Anchors corresponding to menu items
	 scrollItems = menuItems.map(function(){
	   var item = $($(this).attr("href"));
	    if (item.length) { return item; }
	 });

	// Bind to scroll
	$(window).scroll(function(){
	   var fromTop = $(this).scrollTop()+topMenuHeight;
	   var cur = scrollItems.map(function(){
	     if ($(this).offset().top < fromTop)
	       return this;
	   });
	   cur = cur[cur.length-1];
	   var id = cur && cur.length ? cur[0].id : "";
	   if (lastId !== id) {
	       lastId = id;
	       menuItems
	        .parent().removeClass("active")
	        .end().filter("[href=#"+id+"]").parent().addClass("active");
	   }                   
	});

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	/* Sticky Contact Form */
	$(document).on("click","#contactFormPp",function(e){
		e.preventDefault();
		$(".sticky-contact-form").toggleClass('open');
		$("#formContents").slideToggle();
	});

	$(document).on("click","#primary-mobile-menu a",function(){
		$("body").removeClass("open-mobile-menu");
		$("#mobile-navigation").removeClass("open");
		$("#toggleMenu").removeClass("open");
	});

	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.mobile-navigation').toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$('.site-header .logo').toggleClass('fixed');
		var parentdiv = $(".mobile-navigation").outerHeight();
		var mobile_nav_height = $(".mobile-main-nav").outerHeight();
		if(mobile_nav_height>parentdiv) {
			$('.mobile-navigation').addClass("overflow-height");
		}
	});


	/* Add target Attribute if External Link */
	$("#primary-menu a, #primary-mobile-menu a").each(function(){
		var url = $(this).attr('href');
		var anchor = $(this);
		var txt = anchor.text();
		if ( url.indexOf("#") != -1 ) {
			var newURL = siteURL + '/' + url;
			anchor.attr('href',newURL);
		} else {
			var page_url = getBaseUrl();
			if (url.indexOf(page_url) ) {
				anchor.attr("target","_blank");
			} 
		}
	});

	function getBaseUrl() {
	    var re = new RegExp(/^.*\//);
	    var url = re.exec(window.location.href);
	    return url[0];
	}

});// END #####################################    END