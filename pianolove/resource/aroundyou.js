 (function($){
	$(document).ready(function($) {

		//main-header
		var header = jQuery('.main-header'),
			myWindow = jQuery(window);
	
		if (myWindow.scrollTop() > 10) {
			header.addClass('header-scrolled');
		}

		myWindow.on('scroll', function() {
			if (myWindow.scrollTop() > 10) {
				header.addClass('header-scrolled');
			} else {
				header.removeClass('header-scrolled');
			}
		});

		//banner
		var dragging = true;
		var owlElementID = "#banner";
		
		function fadeInDownReset() {
			if (!dragging) {
				$(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(700).animate({ opacity: 0, top: "-35px" }, { duration: 200, easing: "easeInCubic" });
			}
			else {
				$(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({ opacity: 0, top: "-35px" });
			}
		}
		
		function fadeInDown() {
			$(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 500, easing: "easeOutCubic" });
			$(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 700, easing: "easeOutCubic" });
		}
	
		$(owlElementID).owlCarousel({
			autoPlay: 4000,
			stopOnHover: false,
	        	navigation: true,
			pagination: true,
			singleItem: true,
			addClassActive: true,
	        	transitionStyle: "fade",
	        	navigationText: ["<i class='icon-left-open-mini'></i>", "<i class='icon-right-open-mini'></i>"],
				
	    		afterInit: function() {
		        	fadeInDown();
		    	},
		    	afterMove: function() {
					fadeInDown();
		    	},
		    	afterUpdate: function() {
				fadeInDown();
		    	},
		    	startDragging: function() {
				dragging = true;
		    	},
		    	afterAction: function() {
				fadeInDownReset();
				dragging = false;
		    	}
		});

		$("#prod-caro").owlCarousel({
			autoPlay : 5000,
			stopOnHover : false,
			navigation : false,
			pagination : true,
			singleItem : true,
			addClassActive : true,
			transitionStyle : "fade",
		});

		// mb- toggle & mobile-nav
		var menuRightBG = document.getElementById( 'mb-nav-bg' ),
			menuRight = document.getElementById( 'mb-nav' ),
	
		body = document.body;
		
		showRight.onclick = function() {
		      classie.toggle( this, 'active' );
			classie.toggle( menuRightBG, 'bg-open' );
			classie.toggle( menuRight, 'menu-open' );
		      disableOther( 'showRight' );
		       $(".toggle-bar").toggleClass("active");
		};

		 function disableOther( button ) {
		      if( button !== 'showRight' ) {
		            classie.toggle( menuRightBG, 'disabled' );
		            classie.toggle( showRight, 'disabled' );
		      }
		 };

		menuRightBG.onclick = function() {
			classie.toggle( menuRightBG, 'bg-open' );
			classie.toggle( menuRight, 'menu-open' );
		      $(".toggle-bar").toggleClass("active");
		};

		//side-menu
		$('#side-menu').metisMenu();

		//mobile-menu
		$('#mb-menu').metisMenu();

		//youtube
		$(function() {
	          $(".video-link").jqueryVideoLightning({
	            autoplay: 1,
	            backdrop_color: "#ddd",
	            backdrop_opacity: 0.6,
	            glow: 20,
	            glow_color: "#000"
	        });
	    });

		//recent-carousel
		var owl = $("#recent-carousel");
	        owl.owlCarousel({
	            items : 2,
	            itemsDesktop : [1199,2],
	            itemsDesktopSmall : [991,2],
	            itemsTablet: [767,1], 
	            itemsMobile : [479,1]
	        });
	
		//toTop
		$.fn.scrollToTop = function(options) {
		        var config = {
		            "speed" : 800
		        };
		
		        if (options) {
		            $.extend(config, {
		                "speed" : options
		            });
		        }
		
		        return this.each(function() {
		            var $this = $(this);
		
		            $(window).scroll(function() {
		                if ($(this).scrollTop() > 100) {
		                    $this.fadeIn();
		                } else {
		                    $this.fadeOut();
		                }
		            });
		
		            $this.click(function(e) {
		                e.preventDefault();
		                $("body, html").animate({
		                    scrollTop : 0
		                }, config.speed);
		            });
		        });
		    };
		$(function() {
			$("#toTop").scrollToTop(1000);
		 });

		//sample-collapse
		$('#sample1-collapse').metisMenu();
		$('#sample2-collapse').metisMenu();
		$('#sample3-collapse').metisMenu();
	});
}) (jQuery);