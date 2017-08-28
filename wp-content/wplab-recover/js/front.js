(function($){

	"use strict";

	window.themeFrontCore = {

		/**
			Constructor
		**/
		initialize: function() {

			var self = this;

			$(document).ready(function(){
				self.build();
				self.events();
			});

		},
		/**
			Build page elements, plugins init
		**/
		build: function() {

			var self = this;

			// fix ie bugs
			this.fixIE();

			// Setup body classes
			this.setupDocumentClasses();

			// lazy loading for images
			this.initLazyLoading();

			// do Layout
			this.doLayout();

			// page preloader
			this.initPreloader();

			// Headroom
			this.setupHeader();

			// Setup animations
			this.setupAnimations();

			// Setup parallax effect for sections
			this.setupParallax();

			// Setup parallax effect for sections
			this.setupVideoBG();

			// Load inline SVG
			this.loadSVG();

			// Setup menus
			this.setupMenu();

			// Setup post formats
			this.setupPostFormats();

			// Comments
			this.setupComments();

			// Setup custom inputs
			this.setupInputForms();

			// Setup carousels
			this.setupCarousels();
			this.swiperCarousels();

			// Setup tabs
			this.setupTabs();

			// Go Top link
			this.setupGoTop();

			// Lazy YouTube videos
			this.setupVideos();

			// Masonry posts
			this.setupMasonry();

			// Some tweaks for Shortcodes
			this.setupShortcodes();

			// Some tweaks for WooCommerce
			this.setupWoo();

			// Portfolio Galleries
			this.setupPortfolio();

			// Init Lightbox
			this.setupLightbox();

			// Contact form sender
			this.bindContactForm();

			// Widgets tweaks
			this.setupWidgets();

			// Load latest tweets
			this.loadTweets();
			
			// Load Service Template
			this.loadService();

			// Load Service Store
			this.loadStore();

			// Append hacks for bad brwsers
			this.initHacks();

			// RTL tweaks
			this.rtlTweaks();

		},
		/**
			Set page events
		**/
		events: function() {

			var self = this;

			$('.benefits.style-3cols_photos .item').each( function() {

				var $this = $(this),
				$link = $(this).find('a:first');

				if( $link.length ) {
					$this.css('cursor', 'pointer');
				}

				$this.click( function() {

					if( $link.length ) {
						window.location = $this.find('a:first').attr('href');
					}

					return false;
				});
			});

			$(window).resize( function() {
				self.doLayout();
			});

			// Submit a form
			$('.form-builder-submit').each( function() {

				$(this).on('click', function() {
					$(this).parents('form').submit();
					return false;
				});

			});

			// AJAX pagination
			$('.ajax-pagination-link').click( function() {
				var $link = $(this);
				if( $link.attr('disabled') == 'disabled' ) return false;

				var targetId = $link.data('target-id');
				var $target = $( targetId );
				var data = $link.data();
				var action = $link.data('action');

				$.ajax({
					url: wprotoEngineVars.ajaxurl,
					type: "POST",
					dataType : 'json',
					data: {
						'action' : action,
						'data' : data
					},
					beforeSend: function() {
						$link.attr('disabled', 'disabled').addClass('active');
						$target.fadeTo( 200, '0.5' );
					},
					success: function( response ) {

						$link.data( 'current-page', response.current_page );
						$link.data( 'next-page', response.next_page );

						if( response.next_page > $link.data('max-pages') || self.stringToBoolean( response.hide_link ) ) {
							$link.parents('.ajax-pagination').remove();
						}

						if( response.html ) {

							$target.append( response.html );

							if( $link.data('masonry') == 'yes' ) {
								var $appended = $( response.html );
								$target.isotope( 'appended', $appended ).isotope('destroy');

								self.setupMasonry();

								$target.waitForImages({
									waitForAll: true,
									finished: function() {

										$target.isotope('layout');

									}
								});

							}

							self.setupPostFormats();
							self.setupCarousels();
							self.setupVideos();
							self.setupLightbox();

							// re-load added lazy images
							self.bLazy.revalidate();

						}

						$link.removeAttr('disabled').removeClass('active');
						$target.fadeTo( 200, '1' );

					},
					error: function() {
						$link.removeAttr('disabled').removeClass('active');
						$target.fadeTo( 200, '1' );
						self.alertMessage( wprotoEngineVars.strServerResponseError );
					},
					ajaxError: function() {
						$link.removeAttr('disabled').removeClass('active');
						$target.fadeTo( 200, '1' );
						self.alertMessage( wprotoEngineVars.strAJAXError );
					}
				});

				return false;
			});

			// header widgets
			$('#header-cart-widget-toggle, #header-search-widget-toggle').click( function() {
				if( $(this).attr('id') == 'header-cart-widget-toggle' ) {
					$('#header-search-widget .inside').css('opacity', '0').hide().removeClass('fadeIn animated opened');
				} else {
					$('#header-cart-widget .inside').css('opacity', '0').hide().removeClass('fadeIn animated opened');
					$('#header-search-widget input[type=search]').focus();
				}
				$(this).parent().find('.inside').show().css('opacity', '0').toggleClass('fadeIn animated opened');
				return false;
			});

			// header posts
			$(document).on('click', '.menu-posts-carousel .filters a', function() {
				var $link = $(this);
				var $parent = $link.parents('.menu-posts-carousel-loader');
				var type = $parent.data('type');
				var $target = $link.parents('.menu-posts-carousel-loader').find('.menu-posts-carousel .posts');
				var category = $link.data('filter');

				$parent.find('.filters a').removeClass('current');
				$link.addClass('current');

				$.ajax({
					url: wprotoEngineVars.ajaxurl,
					type: "POST",
					data: {
						'action' : 'theme_load_menu_posts_carousel',
						'category' : type,
						'cat' : category
					},
					beforeSend: function() {
						$parent.addClass('refresh');
					},
					success: function( html ) {

						$parent.removeClass('refresh');
						$target.html( html );
						self.bLazy.revalidate();

					}
				});

			});

		},
		/**************************************************************************************************************************************************/
		/** init preloader **/
		initPreloader: function() {

			var self = this;

			if( $('#preloader-inner').length ) {
		    $('#preloader-inner.ball-pulse').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-grid-pulse').html(self.createPreloaderDivs(9));
		    $('#preloader-inner.ball-clip-rotate').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-clip-rotate-pulse').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.square-spin').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-clip-rotate-multiple').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-pulse-rise').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-rotate').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.cube-transition').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-zig-zag').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-zig-zag-deflect').html(self.createPreloaderDivs(2));
		    $('#preloader-inner.ball-triangle-path').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-scale').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.line-scale').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.line-scale-party').html(self.createPreloaderDivs(4));
		    $('#preloader-inner.ball-scale-multiple').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-pulse-sync').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-beat').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.line-scale-pulse-out').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.line-scale-pulse-out-rapid').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-scale-ripple').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.ball-scale-ripple-multiple').html(self.createPreloaderDivs(3));
		    $('#preloader-inner.ball-spin-fade-loader').html(self.createPreloaderDivs(8));
		    $('#preloader-inner.line-spin-fade-loader').html(self.createPreloaderDivs(8));
		    $('#preloader-inner.triangle-skew-spin').html(self.createPreloaderDivs(1));
		    $('#preloader-inner.pacman').html(self.createPreloaderDivs(5));
		    $('#preloader-inner.ball-grid-beat').html(self.createPreloaderDivs(9));
		    $('#preloader-inner.semi-circle-spin').html(self.createPreloaderDivs(1));
			}

			// Close preloader
			$(window).load(function() {

				if( $('body.preloader').length ) {

					$('body').waitForImages({
						waitForAll: true,
						finished: function() {

							$('#preloader').fadeOut( 1200, function() {
								$('body.preloader').removeClass('preloader');
								$(this).remove();
								$('#wrap').css('opacity', '1');
							});

						}
					});

					if( self.isIE ) {
						$('#preloader').remove();
						$('#wrap').css('opacity', '1');
						$('body').removeClass('preloader');
					}

				}
			});

		},
		/** fix IE bugs **/
		fixIE: function() {
			$('iframe').each(function() {
			  var url = $(this).attr("src");
			  if( typeof url !== typeof undefined && url !== false ) {

				  if (url.indexOf("?") > 0) {
				    $(this).attr({
				      "src" : url + "&wmode=transparent",
				      "wmode" : "opaque"
				    });
				  } else {
				    $(this).attr({
				      "src" : url + "?wmode=transparent",
				      "wmode" : "opaque"
				    });
				  }

			  }
			});
		},
		/** setup documents classes **/
		setupDocumentClasses: function() {

			var self = this;

			$('html').removeClass('no-js');

			// Detect mobile browser
			if( (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) || (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.platform)) ) {
				$('html').addClass('mobile');
			}

			// Detect MAC
	    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Mac') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
	      $('html').addClass('mac');
	    }

			// Detect IE
			self.isIE = document.documentMode || /Edge/.test(navigator.userAgent);

			if( self.isIE ) {
				$('body').addClass('ie');
			}

		},
		/** lazy loading **/
		initLazyLoading: function() {

			var self = this;

    	self.bLazy = new Blazy({
    		loadInvisible: true,
	      success: function( element ){

	      	var $masonry = $('.blog-posts-shortcode-masonry, .portfolio-posts-shortcode, .portfolio-posts-shortcode-alt');

	      	if( $masonry.length ) {
	      		$masonry.isotope('layout');

	      		setTimeout(function() {
	      			$masonry.isotope('layout');
	      		}, 500);

						$masonry.waitForImages({
							waitForAll: true,
							finished: function() {

								$masonry.isotope('layout');

							}
						});

	      	}

				}
			});

		},
		/** do layout **/
		doLayout: function() {

			/**
				Make row stretch outside container for default page template
			**/

      var $elements = $( '.stretch_row_content_no_paddings, .stretch_row_content, .stretch_row');

      $.each( $elements, function(key, item) {

        var $el = $(this);
        var $el_full = $el.next( '.row-full-width');
        $el_full.length || ( $el_full = $el.parent().next( '.row-full-width') );

        if( $el_full.length ) {

	        var el_margin_left = parseInt( $el.css( 'margin-left'), 10),
	          el_margin_right = parseInt( $el.css( 'margin-right'), 10),
	          offset = 0 - $el_full.offset().left - el_margin_left,
	          width = $(window).width();

					if( $('body').hasClass('rtl') ) {

	          if( $el.css({
	            position: 'relative',
	            right: offset,
	            width: $(window).width()
	          }), $el.hasClass( 'stretch_row')) {

	            var padding = -1 * offset;
	            0 > padding && ( padding = 0);
	            var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
	            0 > paddingRight && ( paddingRight = 0), $el.css({
	              'padding-left': padding + 'px',
	              'padding-right': paddingRight + 'px'
	            });
	          }

					} else {

	          if( $el.css({
	            position: 'relative',
	            left: offset,
	            width: $(window).width()
	          }), $el.hasClass( 'stretch_row')) {

	            var padding = -1 * offset;
	            0 > padding && ( padding = 0);
	            var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
	            0 > paddingRight && ( paddingRight = 0), $el.css({
	              'padding-left': padding + 'px',
	              'padding-right': paddingRight + 'px'
	            });
	          }

					}

       	}

      });

      /**
      	Make section full-height
     	**/
	    $(".full-height-section").each(function() {
        $(this).css( 'min-height', $(window).height() + 'px');
	    });

		},
		/** sticky header **/
		setupHeader: function() {

			$('.breadcrumbs').find('.last-item').after('<span class="corner"></span>');

		},
		/** animations **/
		setupAnimations: function() {

			if( $('body').hasClass('anim-on') ) {

				var animMobile = $('body').hasClass('anim-mobile-on');

			  var wow = new WOW({
					boxClass:     'wow',
					animateClass: 'animated',
					offset:       0,
					mobile:       animMobile,
					live:         true,
					callback:     function( box ) {

						var $box = $(box);

						if( $box.hasClass('animationProgressBar') ) {
							var w = $box.data('width');
							$box.width( w );
						} else if( $box.hasClass('animationNuminate') ) {
							$box.each( function() {
								var $item = $(this);
								var to = $item.data('to');

								$item.numinate({ format: '%counter%', from: 1, to: to, runningInterval: 2000, stepUnit: 5});
							});
						}

					}
				});

			  wow.init();

			  $('.share-links').not('.single-product .share-links').stick_in_parent({
			  	offset_top: 20,
			  	recalc_every: 5
			  });

			} else {

				$('.animationNuminate').each( function() {
					$(this).html( $(this).data('to') );
				});

				$('.animationProgressBar').each( function() {
						var w = $(this).data('width');
						$(this).width( w );
				});

			}

		},
		/** parallax effect for sections **/
		setupParallax: function() {

			var self = this;

			if( self.isIE === false ) {

				$('.parallax-section').each( function() {
					$( this ).parallax({ zIndex: 10 });
				});

			} else {

				$('.parallax-section[data-image-src]').each( function() {
					$(this).css({
						'background-image' : 'url(' + $(this).data('image-src') + ')',
						'background-size' : 'cover'
					});
				});

		    $('.parallax-section').each(function(){
	        var $bgobj = $(this); // assigning the object
	    		var $window = $(window);
	    		$bgobj.css('background-attachment', 'fixed');

	        $window.scroll(function() {
            var yPos = -($window.scrollTop() / $bgobj.data('speed') / 10);
            // Put together our final background position
            var coords = '50% '+ yPos + 'px';
            // Move the background
            $bgobj.css({ backgroundPosition: coords });
	        });
		    });

			}

		},
		/** video backgrounds for sections **/
		setupVideoBG: function() {

			var self = this;

			$('.video-bg-section').each( function() {

				var videoId = $(this).data('video-id');
				var mute = self.stringToBoolean( $(this).data('video-mute') );
				var pauseOnScroll = self.stringToBoolean( $(this).data('video-pause-scroll') );

				$( this ).YTPlayer({
					videoId: videoId,
					mute: mute,
					pauseOnScroll: pauseOnScroll
				});

			});

		},
		/** load inline SVG **/
		loadSVG: function() {

	    $('img.image-svg').each(function(){
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

    		var extension = imgURL.replace(/^.*\./, '');
    		extension = extension.toLowerCase();

    		if( extension == 'svg' ) {

	        $.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = $(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
              $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

	        }, 'xml');

    		}

	    });

		},
		/** mobile responsive header menu **/
		setupMenu: function() {

			var self = this;

			if( $('#menu-container.scrolling-effect-headroom').length ) {
				$('#menu-container.scrolling-effect-headroom').headroom({
					'offset': $('#menu-container').outerHeight()
				});
			}

			self.menuMobile();
			self.menuHovers();
			self.checkForFixedHeader();

			$(window).resize( function() {
				self.menuMobile();
				self.menuHovers();
				self.checkForFixedHeader();
			});

			self.checkForSliderHeader();

			$('#mobile-menu-toggler').click( function() {
				var $link = $(this);
				var linkOffset = $link.offset();
				var $menu = $('#header-menu');

				$menu.css({
					'top': $('#header').outerHeight() + 'px'
				});

				$link.toggleClass('open');
			});

			// One Page menu
			if( $('#header').hasClass('enable-one-page-menu') ) {

				var $h = $('#header');
				var $hMenu = $('#header-menu');

				$hMenu.find("li a[href*='#']:first").parent().addClass('current-menu-item');

				var updateHash = self.stringToBoolean( $h.data('onepage-update-hash'));
				var speed = $h.data('onepage-speed');
				var offset = $h.data('onepage-offset');

				$('#header-menu').singlePageNav({
					currentClass: 'current-menu-item',
					updateHash: updateHash,
					speed: speed,
					offset: offset,
					filter: ':not(.external)'
				});

				if( window.location.hash ) {

				  setTimeout(function() {
				    window.scrollTo(0, 0);
				  }, 1);

					var $t = $( window.location.hash );

			    $('html, body').animate({
		        scrollTop: $t.offset().top - offset
			    }, 2000);
				}

			}

		},
		/** mobile menu effects **/
		menuMobile: function() {
			// Mobile menu effects
			$( '#menu-holder' ).dlmenu({
				'backLabel' : wprotoEngineVars.strMenuBack
			});
		},
		/** hovers for menus **/
		menuHovers: function() {
			var self = this;

			if( $('#header').hasClass('menu-style-white_minimal') || $('#header').hasClass('menu-style-dark_minimal') || $('#header').hasClass('menu-style-white_minimal_left') || $('#header').hasClass('menu-style-dark_minimal_left') ) {
				return false;
			}

			var menuHoverEffect = $('#header').data('hover-effect');

			var $menu = $('#header-menu li.menu-item').not('.widget_mega_menu li.menu-item');

			if( $( window ).width() > 1199 ) {

				if( $('#header').hasClass('menu-style-white_minimal') == false && $('#header').hasClass('menu-style-white_minimal_slider') == false && $('#header').hasClass('menu-style-dark_minimal') == false && $('#header').hasClass('menu-style-dark_minimal_slider') == false && $('#header').hasClass('menu-style-white_minimal_left') == false && $('#header').hasClass('menu-style-white_minimal_left_slider') == false && $('#header').hasClass('menu-style-dark_minimal_left') == false && $('#header').hasClass('menu-style-dark_minimal_left_slider') == false ) {
					$('#header-menu li').off('click.dlmenu');

					$menu.unbind('mouseenter mouseleave');

					$menu.bind({
						mouseenter: function() {

							var $li = $(this);

							if( $li.hasClass('menu-item-has-children') ) {
								$li.find('ul.sub-menu:first').addClass( menuHoverEffect + ' hovered animated' );
							} else if( $li.hasClass('widget_portfolio_carousel') || $li.hasClass('widget_blog_carousel') || $li.hasClass('widget_shop_carousel') ) {
								var $holder = $li.find('.menu-posts-carousel-loader');

								$holder.addClass( menuHoverEffect + ' hovered animated' );

								if( ! $holder.find('.menu-posts-carousel').length ) {

									// load posts into menu via AJAX
									$.ajax({
										url: wprotoEngineVars.ajaxurl,
										type: "POST",
										data: {
											'action' : 'theme_load_menu_posts_carousel',
											'category' : $holder.data('type')
										},
										success: function( html ) {

											$holder.addClass('loaded');
											$holder.html( html );

											self.bLazy.revalidate();

										}
									});

								} else {
									self.bLazy.revalidate();
								}

							}

						},
						mouseleave: function() {

							var $li = $(this);
							if( $li.hasClass('menu-item-has-children') ) {
								$li.find('ul.sub-menu:first').removeClass( menuHoverEffect ).removeClass('hovered animated');
							} else if( $li.hasClass('widget_portfolio_carousel') || $li.hasClass('widget_blog_carousel') || $li.hasClass('widget_shop_carousel') ) {
								$li.find('.menu-posts-carousel-loader').removeClass( menuHoverEffect ).removeClass('hovered animated');
							}

						}
					});

				}

			} else {
				self.menuMobile();
				$menu.unbind('mouseenter mouseleave');
			}


		},
		/** check for fixed header **/
		checkForFixedHeader: function() {

			/** fixed header **/
			if( $('#menu-container.scrolling-effect-simple, #menu-container.scrolling-effect-headroom').length ) {

				if( $( window ).width() < 1199 && $('#menu-container.scrolling-effect-simple, #menu-container.scrolling-effect-headroom').hasClass('.do-not-scroll-on-mobiles') ) {
					//
				} else {

					var $scrollHeader = $('#menu-container.scrolling-effect-simple, #menu-container.scrolling-effect-headroom');
					var headHeight = $scrollHeader.outerHeight();
					var $header = $('#header');

					if( $header.hasClass('menu-style-white_slider') == false && $header.hasClass('menu-style-inverted_slider') == false && $header.hasClass('menu-style-white_alt_slider') == false && $header.hasClass('menu-style-inverted_alt_slider') == false && $header.hasClass('menu-style-white_minimal_slider') == false && $header.hasClass('menu-style-dark_minimal_slider') == false && $header.hasClass('menu-style-white_minimal_left_slider') == false && $header.hasClass('menu-style-dark_minimal_left_slider') == false ) {
						$('#wrap').css('padding-top', headHeight + 'px' );
						$('#menu-container').css('top', '0px !important');
					}

					if( $('body').hasClass('admin-bar') ) {
						$scrollHeader.css({ 'position': 'fixed', 'left': '0', 'right' : '0', 'top': $('#wpadminbar').outerHeight() });
					} else {
						$scrollHeader.css({ 'position': 'fixed', 'left': '0', 'right' : '0', 'top': '0'});
					}

				}

			}

		},
		/** check for slider header **/
		checkForSliderHeader: function() {

			var $el = $('#menu-container.scrolling-effect-simple');
			if( $el.length ) {
				var elpos_original = $el.offset().top;

				$(window).scroll(function(){

					var elpos = $el.offset().top;
					var windowpos = $(window).scrollTop();
					var finaldestination = windowpos;
					var padding = $el.outerHeight();

					if(windowpos<=elpos_original) {
						finaldestination = elpos_original;
						$el.removeClass('scrolled').addClass('normal-state');
					} else {
						$el.removeClass('normal-state').addClass('scrolled');
					}

				});
			}

		},
		/** add some styles to post formats **/
		setupPostFormats: function() {

		  // Select first word of every paragraph in post format chat
		  $('article.format-chat .text p, .single #content article.format-chat p').each( function(){
		    var text_splited = $(this).text().split(" ");
		   	$(this).html("<strong>"+text_splited.shift()+"</strong> "+text_splited.join(" "));
		  });

		  $('article').fitVids();

		},
		/** style comments **/
		setupComments: function() {

			$('#comments.with-avatars ul.children').prev('.comment-body').addClass('has-children');
			$('#comments.with-avatars .has-children').parent().addClass('comments-thread-expanded');

		},
		/** custom inputs in forms **/
		setupInputForms: function() {

			if( $('body').hasClass('no-custom-input') == false ) {
				// Custom Selectbox
				$("select").dropdown({
					mobile: true
				});

				// Custom checkbox
				$("input[type=radio], input[type=checkbox]").not('.shipping_method, .input-radio').checkbox();
			}

		},
		/** setup carousels **/
		setupCarousels: function() {

			var self = this;

			$(".post-gallery").each( function() {

				var autoTime = $(this).data('autoplay-time');
				var autoplay = self.stringToBoolean( $(this).data('autoplay') );

				$(this).carousel({
					autoHeight: true,
					infinite: true,
					single: true,
					autoTime: autoTime,
					autoAdvance: autoplay
				});
			});

			$('.wproto_posts_carousel_widget').each( function() {

				var $carousel = $(this).find('.post-gallery');

				$(this).find('a.c-prev').click( function() {
					$carousel.carousel('previous');
				});

				$(this).find('a.c-next').click( function() {
					$carousel.carousel('next');
				});

			});

			$('.shortcode-theme-posts-carousel.style-default').each( function() {

				var $carousel = $(this),
				items = $carousel.data('items'),
				itemsSmall = $carousel.data('items-small'),
				itemsPhone = $carousel.data('items-phone'),
				autoTime = $carousel.data('autoplay-time'),
				autoplay = self.stringToBoolean( $carousel.data('autoplay') );

				$carousel.carousel({
					infinite: true,
			    show: {
			    	"320px" : itemsPhone,
		        "767px" : itemsSmall,
		        "992px" : items
			    },
					pagination: true,
					paged: false,
					autoTime: autoTime,
					autoAdvance: autoplay
				});

			});

			$('.products-carousel').each( function() {

				var $carousel = $(this),
				items = $carousel.data('items'),
				itemsSmall = $carousel.data('items-small'),
				itemsPhone = $carousel.data('items-phone'),
				autoTime = $carousel.data('autoplay-time'),
				autoplay = self.stringToBoolean( $carousel.data('autoplay') ),
				paged = self.stringToBoolean( $carousel.data('pagination-dots') );

				$carousel.carousel({
					infinite: true,
			    show: {
			    	"320px" : itemsPhone,
		        "767px" : itemsSmall,
		        "992px" : items
			    },
					pagination: paged,
					paged: paged,
					autoTime: autoTime,
					autoAdvance: autoplay,
					autoHeight: true
				});

			});


		},
		/** swiper **/
		swiperCarousels: function() {

			var self = this;

			$('.shortcode-theme-posts-carousel.style-infinite, .portfolio-showcase').each( function() {

				var id = $(this).attr('id');

				// init Swiper
		    var swiper = new Swiper( '#' + id + ' .items', {
	        paginationClickable: false,
	        freeMode: true,
	        spaceBetween: 0,
	        slidesPerView: 'auto',
	        effect: 'slide'
		    });

			});

			$('.portfolio-carousel-shortcode').each( function( index ) {
				var $carousel = $(this);
				var id = $carousel.attr('id');
				var baseId = $carousel.data('id');

				$( '#' + id ).find('.swiper-slide').clone().appendTo( '#wproto-posts-carousel-temp-holder-' + baseId );

				// init Swiper
		    var swiper = new Swiper( '#' + id + ' .items', {
	        paginationClickable: true,
	        freeMode: true,
	        autoHeight: true,
	        nextButton: '#' + id + ' .nav-right',
	        prevButton: '#' + id + ' .nav-left',
	        spaceBetween: 0,
	        slidesPerView: 'auto',
	        effect: 'slide'
		    });

		    // make carousel filters
		    $('#wproto-posts-carousel-shortcode-nav-' + baseId + ' a').off('click').on('click', function() {

		    	$('#wproto-posts-carousel-shortcode-nav-' + baseId + ' a').removeClass('current');
		    	$(this).addClass('current');

		    	var category = $(this).data('term');

		    	swiper.removeAllSlides();

		    	$( '#wproto-posts-carousel-temp-holder-' + baseId + ' ' + category ).each( function() {
		    		swiper.appendSlide( $(this).get(0).outerHTML );
		    	});

		    	self.setupLightbox();

		    	return false;
		    });

			});

		},
		/** tabs script **/
		setupTabs: function() {

			$('.theme-tabs').each( function() {

				var $tabs = $(this),
				respBreak = $tabs.data('responsive-break');

				if( respBreak != '' ) {

					if( $( window ).width() <= respBreak ) {
						$tabs.find('nav').hide();
						$tabs.removeClass('not-responsive').addClass('is-responsive');
					} else {
						$tabs.find('nav').show();
						$tabs.removeClass('is-responsive').addClass('not-responsive');
					}

					$(window).resize( function() {

						if( $( window ).width() <= respBreak ) {
							$tabs.find('nav').hide();
							$tabs.removeClass('not-responsive').addClass('is-responsive');
						} else {
							$tabs.find('nav').show();
							$tabs.removeClass('is-responsive').addClass('not-responsive');
						}

					});

				}

				$(this).find('.theme-tab').tabs({
					mobileMaxWidth: respBreak + 'px'
				});
			});

			$('.theme-toggle').swap();

			$('.theme-accordion').each( function() {
				$(this).find('.theme-toggle:first').click();
			});

		},
		/** go top link **/
		setupGoTop: function() {

			$('#go-top').click( function() {
				$("html, body").animate({ scrollTop: 0 }, "slow");
				return false;
			});

		},
		/** lazy YouTube videos **/
		setupVideos: function() {

	    $(".lazy-video").each(function() {

	    	var $item = $(this);

	    	var ytID = $item.data('youtube-id');

	    	if( $item.hasClass('custom-bg') == false ) {
	        // Based on the YouTube ID, we can easily find the thumbnail image
	        $item.css('background-image', 'url(http://img.youtube.com/vi/' + ytID + '/0.jpg)');
	    	}

        // Overlay the Play icon to make it look like a video player
        $item.append($('<div/>', {'class': 'play'}));

        $(document).delegate('#'+this.id, 'click', function() {
          // Create an iFrame with autoplay set to true
          var iframe_url = "https://www.youtube.com/embed/" + ytID + "?autoplay=1&autohide=1";
          if ($(this).data('params')) iframe_url+='&'+$(this).data('params');

          // Replace the YouTube thumbnail with YouTube HTML5 Player
          $(this).replaceWith('<div class="responsive-video-wrapper"><iframe src="' + iframe_url + '" frameborder="0" width="100%" height="400"></iframe></div>');
        });
	    });

			$('body.single article.format-video iframe').each( function() {
				$(this).parents('p').addClass('responsive-video-contaner');
			});

		},
		/** Masonry posts **/
		setupMasonry: function() {

			var self = this;

			$('.blog-posts-shortcode-masonry, .portfolio-posts-shortcode, .portfolio-posts-shortcode-alt').each( function() {

				var $elem = $(this);

				if( $elem.data('isotope') ) {
					$elem.isotope('destroy');
				}

				var $m = $elem.isotope({
					layoutMode: 'masonry',
					itemSelector: 'article',
	        onLayout: function () {
            $(window).trigger('scroll');
	        }
				});

				$elem.waitForImages({
					waitForAll: true,
					finished: function() {

						$elem.isotope('layout');

					}
				});

    		setTimeout(function() {
    			$elem.isotope('layout');
    		}, 500);

			});

		},
		/** Setup shortcodes **/
		setupShortcodes: function() {

			$('.theme-collapse-text').each( function() {

				var $item = $(this);
				var moreText = $item.data('more-text');
				var lessText = $item.data('less-text');

				$('.theme-collapse-text').readmore({
				  collapsedHeight: 90,
				  lessLink: '<a href="#" class="button style-black link left size-medium">' + lessText + '</a>',
				  moreLink: '<a href="#" class="button style-black link left size-medium">' + moreText + '</a>',
				});

			});

			var $benefits = $('.match-height');
			if( $benefits.length ) {
				$benefits.matchHeight();
			}

			$('.after-slider-cta').each( function() {
				var $elem = $(this),
				h = $elem.find('.cta-text').outerHeight();
				$elem.find('.cta-btn').css('margin-top', '-' + h + 'px' );

			});

		},
		/** woocommerce tweaks **/
		setupWoo: function() {
			if( $('body').hasClass('no-custom-input') == false ) {
				$('td.value').on( 'click', function() {
					$('table.variations select').val('').trigger("change").dropdown("update");
				});
			}

		},
		/** Portfolio galleries **/
		setupPortfolio: function() {

			var self = this;

			/** portfolio filters **/
			$('.portfolio-posts-filters a, .portfolio-shortcode-posts-filters a').click( function() {
				var target = $(this).parent().data('target-id');
				var $target = $( '#' + target );
				var cat = $(this).data('term');
				$target.isotope({ filter: cat });
				$(this).parent().find('a').removeClass('current');
				$(this).addClass('current');

				return false;
			});


		},
		/** setup LightBox **/
		setupLightbox: function() {

			var $items = $('.gallery a[href$=".gif"], .gallery a[href$=".jpg"], .gallery a[href$=".png"], .lightbox, .zoom, .woocommerce-product-gallery__image a');
			if( $items.length ) {
				$items.nivoLightbox({
					effect: 'fall'
				});
			}

			/*
			$('body.single article.format-image img').each( function() {
				$(this).parents('a').addClass('lightbox');
			});

			*/

		},
		/** send a contact form **/
		bindContactForm: function() {

			if( window.fwForm ) {

		    fwForm.initAjaxSubmit({
	        selector: 'form.fw_form_fw_form',
					onSuccess: function (elements, ajaxData) {
						if ( $('body').hasClass('wp-admin') ) {
							fwForm.backend.showFlashMessages(
								fwForm.backend.renderFlashMessages(ajaxData.flash_messages)
							);
						} else {
							var html = fwForm.frontend.renderFlashMessages(ajaxData.flash_messages);

							if (!html.length) {
								html = '<p>Success</p>';
							}

							elements.$form.fadeOut(function(){
								elements.$form.html(html).fadeIn();
							});

							// prevent multiple submit
							elements.$form.on('submit', function(e){ e.preventDefault(); e.stopPropagation(); });

							var redirectURL = $.trim( elements.$form.parent().data('redirect-url') );
							if( redirectURL != '' ) {
								window.location = redirectURL;
							}
						}
					},
					onErrors: function (elements, data) {
						// Frontend
						jQuery.each(data.errors, function (inputName, message) {
							message = '<p class="form-error">{message}</p>'
								.replace('{message}', message);

							var $input = elements.$form.find('[name="' + inputName + '"]').last();

							if (!$input.length) {
								// maybe input name has array format, try to find by prefix: name[
								$input = elements.$form.find('[name^="'+ inputName +'["]').last();
							}

							if ($input.length) {
								// error message under input
								$input.parent().after(message);
							} else {
								// if input not found, show message in form
								elements.$form.prepend(message);
							}
						});

	        if (typeof Recaptcha != 'undefined') Recaptcha.reload();
	        if (typeof grecaptcha != 'undefined') grecaptcha.reset();

					}
		    });

			}

		},
		/** some tweaks for widgets **/
		setupWidgets: function() {

			/**
				Style tweak for MailChimp widget
			**/
			$('.widget_mc4wp_form_widget').each( function() {

				$(this).find('input[type=submit]').wrap('<span class="submit-wrapper"></span>');

			});

			/**
				Style tweak for WooCommerce widget
			**/
			$('.widget_product_categories').each( function() {

				var $elem = $(this);

				if( $elem.find('ul.product-categories > li > ul').length ) {
					$elem.find('ul.product-categories').addClass('wproto-hierarchical');
				}

				$elem.find('ul.wproto-hierarchical > li > ul').hide();

				$elem.find('ul.wproto-hierarchical > li').each( function() {
					if( $(this).find('ul.children').length ) {
						$(this).append('<a href="javascript:;" class="wproto-expand-collapse"></a>');
					} else {
						$(this).append('<span class="wproto-no-expand"></span>');
					}
				});

				$elem.find('ul.wproto-hierarchical .current-cat-parent, ul.wproto-hierarchical .current-cat.cat-parent').addClass('opened');
				$elem.find('ul.wproto-hierarchical .current-cat-parent ul.children, ul.wproto-hierarchical .current-cat.cat-parent ul.children').first().show();

			});

			$('.wproto-expand-collapse').click( function() {
				$(this).prev('ul.children').toggle('fast');
				$(this).toggleClass('opened');
			});

		},
		/** load latest tweets via AJAX **/
		loadTweets: function() {

			if( $('.tweets-container').length ) {

				$.ajax({
					url: wprotoEngineVars.ajaxurl,
					type: "POST",
					data: {
						'action' : 'theme_get_latest_tweets',
						'type' : 'carousel'
					},
					success: function( response ) {

						$('.tweets-container').each( function() {
							$(this).replaceWith( response );
						});

						if( $('.tweets-carousel').length ) {

							$('.tweets-carousel').carousel({
								autoHeight: true,
								infinite: true,
								single: true,
								autoAdvance: true
							});

						}

					}
				});

			}

			if( $('.tweets-block').length ) {

				$('.tweets-block').each( function() {
					var $block = $(this);
					var count = $block.data('count');

					$.ajax({
						url: wprotoEngineVars.ajaxurl,
						type: "POST",
						data: {
							'action' : 'theme_get_latest_tweets',
							'count' : count
						},
						success: function( response ) {

							$('.tweets-block').each( function() {
								$block.replaceWith( response );
							});

						}
					});

				});

			}

		},
		/** load template service AJAX **/
		loadService: function() {
			var action = "load_category_service";
			var ajaxUrl = wprotoEngineVars.ajaxurl;
			$(".nws-brand .item").click(function(){
				var idTerm = $(this).data('idterm');
				$(".nws-brand .item").removeClass("active");
				$(this).addClass("active");
				$.ajax({
					url: ajaxUrl,
					data : {
								action  	: action,
								id_term		: idTerm
							},
					type : "POST", 
					success : function(data, status){
						$(".nws-service .nws-model").empty();
						$(".nws-service .nws-model-error").empty();
						$(".nws-service .nws-model-service").empty();


						$(".nws-service .nws-model").html(data);
					}
				});
			});

			$(document).on('click', '.nws-model .item', function() {
				var idTerm = $(this).data('idterm');
				$(".nws-model .item").removeClass("active");
				$(this).addClass("active");

				$.ajax({
					url: ajaxUrl,
					data : {
								action  	: action,
								id_term		: idTerm
							},
					type : "POST", 
					success : function(data, status){
						$(".nws-service .nws-model-error").empty();
						$(".nws-service .nws-model-service").empty();
						$(".nws-service .nws-model-error").html(data);
					}
				});
			});

			$(document).on('click', '.nws-model-error .item', function() {
				var idTerm = $(this).data('idterm');
				$(".nws-model-error .item").removeClass("active");
				$(this).addClass("active");
				
				$.ajax({
					url: ajaxUrl,
					data : {
								action  	: action,
								service  	: 'service',
								id_term		: idTerm
							},
					type : "POST", 
					success : function(data, status){
						$(".nws-service .nws-model-service").empty();
						$(".nws-service .nws-model-service").html(data);
					}
				});
			});

		},
		/** load Store form service AJAX **/
		loadStore: function() {
			$(".single-service .current-location").keyup(function(){
				var curentLocation = $(".single-service .current-location").val();
				
				if(curentLocation.length > 2){
					$.ajax({
						url: wprotoEngineVars.ajaxurl,
						type: "POST",
						data: {
							'action' : 'load_store_service',
							'local' : curentLocation
						},
						success: function( data ) {
							$(".single-service select[name='store']").empty();
							var slt = "<option value='0'>-- Select --</option>";
							data = slt + data;
							$(".single-service select[name='store']").html(data);
							$(".single-service .select-store .fs-dropdown-options").remove();
							$(".single-service .select-store button").remove();
						}
					});
				}
			});
			
		},
		/** init hacks for bad browsers **/
		initHacks: function() {

			$('.after-slider-cta').each( function( i) {
				var svg = $(this).data('svg-id');

				$('<style>'+ '#' + $(this).attr('id') + ' .cta-btn a:after { clip-path: url(#' + svg + '); }' +'</style>').appendTo(document.head);

			});

			$('.benefits.style-3cols_fourth, .benefits.style-3cols_third').each( function( i) {
				var svg = $(this).data('svg-id');
				$('<style>'+ '#' + $(this).attr('id') + ' .item:before { clip-path: url(#' + svg + '); }' +'</style>').appendTo(document.head);
			});

			$('#footer-bar.style-cta').each( function( i) {
				$('<style>'+ '#footer-bar.style-cta .col-link:before { clip-path: url(#footer-cta-svg); }' +'</style>').appendTo(document.head);
			});

			$('.fw-pricing').each( function( i) {
				var svg = $(this).data('svg-id');
				$('<style>'+ '#' + $(this).attr('id') + ' .fw-pricing-row:after, #' + $(this).attr('id') + ' .fw-desc-row:after { clip-path: url(#' + svg + '); }' +'</style>').appendTo(document.head);
			});

		},
		/** right-to-left tweaks **/
		rtlTweaks: function() {
			if( $('body').hasClass('rtl') ) {
				var list = $('.header-classic .breadcrumbs');
				var listItems = list.children('span');
				list.append(listItems.get().reverse());
			}
		},
		/**
			Make alert
		**/
		alertMessage: function( text, title ) {

			title = (typeof title === 'undefined') ? wprotoEngineVars.strError : title;

			swal({
				title: title,
				text: text,
				type: "error",
				confirmButtonText: "OK",
				confirmButtonColor: ''
			});

		},
		/**************************************************************************************************************************
			Utils
		**************************************************************************************************************************/
		/**
			Check email address
		**/
		isValidEmailAddress: function( emailAddress ) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
 			return pattern.test( emailAddress );
		},
		preloadImages: function(arrayOfImages) {
	    $(arrayOfImages).each(function(){
        $('<img/>')[0].src = this;
	    });
		},
		createPreloaderDivs: function( n ) {
      var arr = [];
      var i = 0;
      for (i = 1; i <= n; i++) {
        arr.push('<div></div>');
      }
      return arr;
		},
		stringToBoolean: function(string){

			switch(string){
				case "true": case "yes": case "1": return true;
				case "false": case "no": case "0": case null: case '': return false;
				default: return Boolean(string);
			}
		},

	}

	window.themeFrontCore.initialize();

})( window.jQuery );
