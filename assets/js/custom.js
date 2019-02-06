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
		width: '80%', 
		height: '80%'
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

});// END #####################################    END