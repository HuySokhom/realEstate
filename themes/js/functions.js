(function($) {

	"use strict"

	$('#back-to-top').on("click", function() {
		// When arrow is clicked
		$('body,html').animate({
			scrollTop : 0 // Scroll to top of body
		},800);
		return false;
	});

	/* Event - Document Ready /- */	
	$(document).ready( function($) {
		
		/* Expanding Search */
		var uisearch = new UISearch( document.getElementById( 'sb-search' ) );
		
		/* Sticky Navigation */
		var stickyNavTop = $('#top').offset().top;
		var scrollTop = $(window).scrollTop();
		var stickyNav = function() {

			if ( scrollTop > stickyNavTop ) {
				$('.header').addClass('navbar-fixed-top animated fadeInDown');
			} else {
				$('.header').removeClass('navbar-fixed-top animated fadeInDown'); 
			}
		};
		stickyNav();
		
		/* Event - Window Scroll */
		$(window).scroll(function() {

			/* Sticky Navigation */
			stickyNav();

			if ($(this).scrollTop() >= 50)
			{
				// If page is scrolled more than 50px
				$('#back-to-top').fadeIn(200);    // Fade in the arrow
			}
			else
			{
				$('#back-to-top').fadeOut(200);   // Else fade out the arrow
			}
		});
		/* Event - Window Scroll /- */

		$('.navbar-nav li a, .logo-block a').on('click', function(event)
		{
			var anchor = $(this);

			if( anchor == 'undefined' || anchor == null || anchor.attr('href') == '#' ) { return; }
			if ( anchor.attr('href').indexOf('#') === 0 )
			{
				if( $(anchor.attr('href')).length )
				{
					$('html, body').stop().animate( { scrollTop: $(anchor.attr('href')).offset().top - 72 }, 1500, 'easeInOutExpo' );					
				}
				event.preventDefault();
			}
		});

		$('.goto-next a').on('click', function(event)
		{
			var anchor = $(this);

			if( anchor == 'undefined' || anchor == null || anchor.attr('href') == '#' ) { return; }
			if ( anchor.attr('href').indexOf('#') === 0 )
			{
				if( $(anchor.attr('href')).length )
				{
					$('html, body').stop().animate( { scrollTop: $(anchor.attr('href')).offset().top - 150 }, 1500, 'easeInOutExpo' );			
				}
				event.preventDefault();
			}
		});

		/* .featured-section */
		$('.featured-section').each(function ()
		{
			var $this = $(this);
			var myVal = $(this).data("value");

			$this.appear(function()
			{
				$('.featured-section .featured-box').addClass('animated slideInLeft');
			});
		});
		
		/* Rent Property */
		if( $('#rent-property-block').length ) {
			
			$("#rent-property-block").owlCarousel(
			{
				autoPlay: 3000, //Set AutoPlay to 3 seconds

				items : 3,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [991,3],
				itemsMobile : [680,1],
				navigation : true,
				pagination: false
			});
		}
		
		/* Sale Property */
		if( $('#sale-property-block').length ) {
			
			$("#sale-property-block").owlCarousel(
			{
				autoPlay: 3000, //Set AutoPlay to 3 seconds

				items : 3,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [991,3],
				itemsMobile : [680,1],
				navigation : true,
				pagination: false
			});
		}
		
		/* Featured Property */
		if( $('#featured-property').length ) {
			
			$("#featured-property").owlCarousel(
			{
				autoPlay: 3000, //Set AutoPlay to 3 seconds

				items : 4,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [991,2],
				itemsMobile : [650,1],
				navigation : true,
				pagination: false
			});
		}
		
		/* Featured Property */
		if( $('#business-partner').length ) {

			$("#business-partner").owlCarousel(
			{
				autoPlay: 3000, //Set AutoPlay to 3 seconds

				items : 5,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [991,3],
				navigation : false,
				pagination: false
			});
		}
		
		/* rent-and-sale-one-row */
		if( $('#rent-and-sale-one-row').length ) {
			
			$("#rent-and-sale-one-row").owlCarousel(
			{
				autoPlay: 3000, //Set AutoPlay to 3 seconds

				singleItem:true,
				navigation : true,
				pagination: false
			});
		}
		
		/* gMAP */
		$("#gmap").gMap({
			controls: false,
			scrollwheel: true,
			
			markers: [
				{
					latitude: 47.670553,
					longitude: 9.588479,
					icon: {
						image: "images/map-marker.png",
						iconsize: [26, 46],
						iconanchor: [12,46]
					}
				},
				{
					latitude: 47.65197522925437,
					longitude: 9.47845458984375
				},
				{
					latitude: 47.594996,
					longitude: 9.600708,
					icon: {
						image: "images/map-marker.png",
						iconsize: [26, 46],
						iconanchor: [12,46]
					}
				}
			],
			icon: {
				image: "images/map-marker.png", 
				iconsize: [26, 46],
				iconanchor: [12, 46]
			},
			latitude: 47.58969,
			longitude: 9.473413,
			zoom: 10
		});
		
		/* gMAP */
		$("a[href='#add_location']").on('click', function(e) {
			$("#gmap2").gMap({
				controls: false,
				scrollwheel: true,
				
				markers: [
					{
						latitude: 47.670553,
						longitude: 9.588479,
						icon: {
							image: "images/map-marker.png",
							iconsize: [26, 46],
							iconanchor: [12,46]
						}
					},
					{
						latitude: 47.65197522925437,
						longitude: 9.47845458984375
					},
					{
						latitude: 47.594996,
						longitude: 9.600708,
						icon: {
							image: "images/map-marker.png",
							iconsize: [26, 46],
							iconanchor: [12,46]
						}
					}
				],
				icon: {
					image: "images/map-marker.png", 
					iconsize: [26, 46],
					iconanchor: [12, 46]
				},
				latitude: 47.58969,
				longitude: 9.473413,
				zoom: 10
			});
		});
		
		/* Checkbox */
		 $('input').iCheck({
			checkboxClass: 'icheckbox_minimal',
			radioClass: 'iradio_minimal',
			increaseArea: '20%' // optional
		});
		
		/* Contact Form */
		$( "#btn_smt" ).on( "click", function(event) {
		  event.preventDefault();
		  var mydata = $("form").serialize();
		  
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "quick-contact.php",
				data: mydata,
				success: function(data) {
					
					if( data["type"] == "error" ){
						$("#alert-msg").html(data["msg"]);
						$("#alert-msg").removeClass("alert-msg-success");
						$("#alert-msg").addClass("alert-msg-failure");
						$("#alert-msg").show();
					} else {
						$("#alert-msg").html(data["msg"]);
						$("#alert-msg").addClass("alert-msg-success");
						$("#alert-msg").removeClass("alert-msg-failure");					
						$("#input_name").val("");
						$("#input_email").val("");
						$("#textarea_message").val("");
						$("#alert-msg").show();						
					}

				},
				error: function(xhr, textStatus, errorThrown) {
					//alert(textStatus);
				}
			});
			return false;
			
		});/* Contact Form /- */
				
		$('body').on('click', '#add-item', function(event){
			event.preventDefault();
			$( ".submit-property .contact-feedback-form form" ).append( '<div class="input-group"><div class="col-md-4 col-sm-4"><input type="text" name="add-title3" placeholder="Title"></div><div class="col-md-7 col-sm-7"><input type="text" name="add-value3" placeholder="Value"></div><a href="#"><i class="fa fa-times-circle"></i></a></div>' );
			$( ".no-additional-details" ).remove();
		});
		
		$('body').on('click', '.submit-property .contact-feedback-form form .input-group a', function(event){
			event.preventDefault();
			$($(this).parent()).remove();			
		});
		
		
	});	/* document.ready /- */	
	
	if (!$('html').is('.ie6, .ie7, .ie8'))
	{
		/* Event - Window Load */
		$(window).load(function()
		{		
			/* Loader */
			$("#site-loader").delay(1000).fadeOut("slow");
		});
		/* Event - Window Load /- */
	}
	else
	{
		$("#site-loader").css('display','none');
	}
	
})(jQuery);