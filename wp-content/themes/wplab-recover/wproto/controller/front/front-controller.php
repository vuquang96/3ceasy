<?php
/**
 * Front side controller
 **/
class wplab_recover_front_controller extends wplab_recover_core_controller {

	// resources
	protected $inline_css;
	protected $inline_js;

	function __construct() {

		// Preloader script should be included in header
		add_action( 'wp_head', array( $this, 'add_header_resources' ) );

		// Add admin scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'add_styles' ) );

		// Add auto-generated styles and scripts
		add_action( 'wp_footer', array( $this, 'print_inline_js' ), 50 );

		// Modify a webste titl
		add_filter( 'wp_title',  array( $this, 'wp_title' ), 10, 2 );

		// Add BODY classes
		add_filter( 'body_class', array( $this, 'body_classes' ));

		// Control RSS feed
		add_action( 'init', array( $this, 'setup_rss' ) );

		// add images to RSS feed
		add_filter( 'the_excerpt_rss', array( $this, 'add_featured_image_to_feed' ), 1000, 1);
		add_filter( 'the_content_feed', array( $this, 'add_featured_image_to_feed' ), 1000, 1);

		// Hide admin bar from non-admins if this required by theme settings
		add_action( 'after_setup_theme',  array( $this, 'remove_admin_bar' ) );

		// Custom search form
		add_filter( 'get_search_form', array( $this, 'custom_search_template' ) );

		// customize password protected post form
		add_filter( 'the_password_form', array( $this, 'customize_password_protect' ));

		// Coming soon / Maintenance modes
		add_action( 'template_redirect', array( $this, 'is_maintenance' ), 10, 1);

		add_action( 'wp_footer', array( $this, 'add_preloader_splash_html' ));

	}

	/**
	 * Theme header
	 **/
	function add_header_resources() {
		if( wplab_recover_utils::is_unyson() ) {
			/** Preloader script **/
			if( fw_get_db_settings_option( 'page_preloader/style' ) == 'theme' ) {
				echo '<script src="' . get_template_directory_uri() . '/js/libs/jpreLoader.min.js' . '"></script>';
			}

			/** favicon **/
			$favicon = fw_get_db_settings_option( 'favicon' );
			$favicon57 = fw_get_db_settings_option( 'favicon_57' );
			$favicon114 = fw_get_db_settings_option( 'favicon_114' );
			$favicon72 = fw_get_db_settings_option( 'favicon_72' );
			$favicon144 = fw_get_db_settings_option( 'favicon_144' );

			?>

			<?php if( isset( $favicon['url'] ) && $favicon['url'] <> '' ): ?>
			<!-- Favicons -->
			<link rel="shortcut icon" href="<?php echo $favicon['url']; ?>" type="image/x-icon">
			<link rel="icon" href="<?php echo $favicon['url']; ?>" type="image/x-icon">
			<?php endif; ?>

			<?php if( isset( $favicon57['url'] ) && $favicon57['url'] <> '' ): ?>
			<!-- Standard iPhone -->
			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $favicon57['url']; ?>" />
			<?php endif; ?>

			<?php if( isset( $favicon114['url'] ) && $favicon114 <> '' ): ?>
			<!-- Retina iPhone -->
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $favicon114['url']; ?>" />
			<?php endif; ?>

			<?php if( isset( $favicon72['url'] ) && $favicon72 <> '' ): ?>
			<!-- Standard iPad -->
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $favicon72['url']; ?>" />
			<?php endif; ?>

			<?php if( isset( $favicon144['url'] ) && $favicon144 <> '' ): ?>
			<!-- Retina iPad -->
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $favicon144['url']; ?>" />
			<?php endif; ?>

			<?php

		}
	}

	/**
	 * Add admin scripts
	 **/
	function add_scripts() {

		wp_enqueue_script( 'jquery' );

		wp_register_script( 'swiper', get_template_directory_uri() . '/js/libs/swiper.jquery.min.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );

		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		wp_register_script( 'youtube-background', get_template_directory_uri() . '/js/libs/jquery.youtubebackground.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );

		if( wplab_recover_utils::is_unyson() ) {

			/** one page navigation **/
			if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				wp_register_script( 'one-page-nav', get_template_directory_uri() . '/js/libs/jquery.singleNav.min.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
				wp_enqueue_script( 'one-page-nav' );
			}

			/** if SmoothScroll enabled **/
			if( filter_var( fw_get_db_settings_option( 'smooth_scrolling' ), FILTER_VALIDATE_BOOLEAN ) ) {
				wp_register_script( 'smooth-scroll', get_template_directory_uri() . '/js/libs/jquery.nicescroll.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
				wp_enqueue_script( 'smooth-scroll' );
			}
			/** if Maintenance enabled **/
			if( !is_user_logged_in() ) {

				if( filter_var( fw_get_db_settings_option( 'maintenance_mode/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_settings_option( 'maintenance_mode/true/countdown/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
					wp_register_script( 'countdown', get_template_directory_uri() . '/js/libs/countdown.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
					wp_enqueue_script( 'countdown' );

					$open_date = fw_get_db_settings_option( 'maintenance_mode/true/countdown/true/date' );

					$this->add_inline_js('
						jQuery("#countdown").countdown({
								date: "' . date( 'm-d-y', strtotime( $open_date ) ) . ' 00:00:00",
								format: "on"
							}
						);
					');

				}

			}
		}

		wp_register_script( 'theme-front-scripts', get_template_directory_uri() . '/js/libs.min.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
		wp_enqueue_script( 'theme-front-scripts' );

		wp_register_script( 'dlmenu', get_template_directory_uri() . '/js/libs/jquery.dlmenu.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
		wp_enqueue_script( 'dlmenu' );

		wp_register_script( 'theme-front', get_template_directory_uri() . '/js/front.min.js', array( 'jquery' ), _WPLAB_RECOVER_CACHE_TIME_, true );
		wp_enqueue_script( 'theme-front' );

		wp_register_script( 'match-height', get_template_directory_uri() . '/js/libs/jquery.matchHeight-min.js', array( 'jquery', 'theme-front' ), _WPLAB_RECOVER_CACHE_TIME_, true );

		$js_vars = array(
			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
			'strSuccess' 		=> esc_html__('Success', 'wplab-recover'),
			'strError' 			=> esc_html__('Error', 'wplab-recover'),
			'strAJAXError' => esc_html__( 'An AJAX error occurred when performing a query. Please contact support if the problem persists.', 'wplab-recover' ),
			'strServerResponseError' => esc_html__( 'The script have received an invalid response from the server. Please contact support if the problem persists.', 'wplab-recover' ),
			'strMenuBack' => esc_html__( 'Back', 'wplab-recover' ),
		);

		// woocommerce 3
		wp_dequeue_script('select2');

		wp_localize_script( 'theme-front-scripts', 'wprotoEngineVars', $js_vars );

	}

	/**
	 * Add admin styles
	 **/
	function add_styles() {
		global $wp_styles, $wplab_recover_core;

		if( wplab_recover_utils::is_unyson() ) {

			// Preloader custom styles
			$preloader = fw_get_db_settings_option( 'page_preloader/style' );
			if( $preloader != 'hidden' ) {
				wp_enqueue_style( 'preloaders', $wplab_recover_core->skin_style_dir . '/preloader.css', false, _WPLAB_RECOVER_CACHE_TIME_ );

				if( $preloader == 'theme' ) {

					$preloader_bg_image = fw_get_db_settings_option( 'page_preloader/theme/background' );
					$preloader_bg_image = is_array( $preloader_bg_image ) && !empty( $preloader_bg_image ) ? $preloader_bg_image['url'] : '';

					$preloader_bg_repeat = fw_get_db_settings_option( 'page_preloader/theme/background_repeat' );
					$preloader_bg_pos = fw_get_db_settings_option( 'page_preloader/theme/background_position' );

					$preloader_bg_color = fw_get_db_settings_option( 'page_preloader/theme/bg_color' );

					$preloader_progress_bg_color = fw_get_db_settings_option( 'page_preloader/theme/progress_background' );
					$preloader_accent_color = fw_get_db_settings_option( 'page_preloader/theme/accent_color' );

					$custom_css = '.jpreloader #wrap { opacity: 0; } .no-js #wrap { opacity: 1; } #jpreOverlay { background-color: ' . $preloader_bg_color . '; }';
					if( $preloader_bg_image <> '' ) {
						$custom_css .= '#jpreOverlay { background-image: url(' . $preloader_bg_image . '); background-repeat: ' . $preloader_bg_repeat . '; background-position: ' . $preloader_bg_pos . '; }';
					}

					$custom_css .= '#jpreLoader { background-color: ' . $preloader_progress_bg_color . '; }';
					$custom_css .= '#jpreBar { background-color: ' . $preloader_accent_color . '; }';

					$custom_css .= '#jprePercentage { color: ' . $preloader_accent_color . '; }';

					$this->add_inline_css( $custom_css );
				}

			}

			if( filter_var( fw_get_db_settings_option( 'css_animations/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/libs/animate.min.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
			}

			if( filter_var( fw_get_db_settings_option( 'maintenance_mode/enabled' ), FILTER_VALIDATE_BOOLEAN ) && !is_user_logged_in() ) {
				wp_enqueue_style( 'maintenance', $wplab_recover_core->skin_style_dir . '/maintenance.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
			}

			if( fw_get_db_settings_option( 'blog_template' ) != 'cols_1' && ( is_home() || is_archive() || is_category() || is_author() || is_tag() ) ) {
				wp_enqueue_style( 'blog-posts', $wplab_recover_core->skin_style_dir . '/blog_posts.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
			}

		}

		wp_enqueue_style( 'fw-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', false, _WPLAB_RECOVER_CACHE_TIME_ );

		wp_enqueue_style( 'theme-base', $wplab_recover_core->skin_style_dir . '/base.css', false, _WPLAB_RECOVER_CACHE_TIME_ );

		$header_style = 'modern';
		$menu_style = 'default';
		$submenu_style = 'dark';

		if( wplab_recover_utils::is_unyson() ) {
			if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$header_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_style' );
				$menu_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/menu_style' );
				$submenu_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/submenu_style' );
			} else {
				$header_style = fw_get_db_settings_option( 'header_style/style' );
				$menu_style = fw_get_db_settings_option( 'menu_style' );
				$submenu_style = fw_get_db_settings_option( 'submenu_style' );
			}
		}

		wp_enqueue_style( 'theme-head', $wplab_recover_core->skin_style_dir . '/head-' . $header_style . '.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		wp_enqueue_style( 'theme-menu', $wplab_recover_core->skin_style_dir . '/menu-' . $menu_style . '.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		wp_enqueue_style( 'theme-submenu', $wplab_recover_core->skin_style_dir . '/submenu-' . $submenu_style . '.css', false, _WPLAB_RECOVER_CACHE_TIME_ );

		wp_enqueue_style( 'theme-aside', $wplab_recover_core->skin_style_dir . '/aside.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		wp_enqueue_style( 'theme-footer', $wplab_recover_core->skin_style_dir . '/footer.css', false, _WPLAB_RECOVER_CACHE_TIME_ );

		if( is_tax('fw-portfolio-category') ) {
			wp_enqueue_style( 'portfolio-projects', $wplab_recover_core->skin_style_dir . '/portfolio_shortcode.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		}

		if( wplab_recover_utils::is_woocommerce() ) {
			wp_enqueue_style( 'theme-woocommerce', $wplab_recover_core->skin_style_dir . '/woocommerce.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		}

		wp_add_inline_style( 'theme-footer', $this->inline_css );

		if( wplab_recover_utils::is_unyson() ) {
			// Load Theme Fonts
			$wplab_recover_core->controller->init->load_theme_fonts();
		}

		// Load default theme fonts
		if( ! wplab_recover_utils::is_unyson() || ( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'default_fonts' ), FILTER_VALIDATE_BOOLEAN ) ) ) {
			wp_enqueue_style( 'theme-default-fonts', get_template_directory_uri() . '/fonts/fonts.css' );
		}

		wp_enqueue_style( 'theme-ie-fix', $wplab_recover_core->skin_style_dir . '/ie.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		$wp_styles->add_data( 'theme-ie-fix', 'conditional', 'IE' );

		wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css' );

		/** custom layouts **/
		$layout = 'default';
		if( wplab_recover_utils::is_unyson() ) {
			$layout = fw_get_db_settings_option( 'body_layout/style' );
		}

		if( $layout == 'boxed' ) {
			$wrapper_width = absint( fw_get_db_settings_option( 'body_layout/boxed/wrapper_width' ) );
			wp_add_inline_style( 'theme-style', '#wrap { max-width: ' . $wrapper_width . 'px; } #menu-container { max-width: ' . $wrapper_width . 'px; } @media screen and (min-width: ' . $wrapper_width . 'px) { body.layout-boxed #menu-container { left: 50% !important; margin-left: -' . $wrapper_width / 2 . 'px; } .layout-boxed #wrap, .layout-framed #wrap { position: relative; margin: 0 auto; } }' );
		} elseif( $layout == 'framed' ) {
			$wrapper_width = absint( fw_get_db_settings_option( 'body_layout/boxed/wrapper_width' ) );
			$top_margin = fw_get_db_settings_option( 'body_layout/framed/wrapper_margin_top' );
			$bottom_margin = fw_get_db_settings_option( 'body_layout/framed/wrapper_margin_bottom' );
			wp_add_inline_style( 'theme-style', '#wrap { max-width: ' . $wrapper_width . 'px; } #menu-container { max-width: ' . $wrapper_width . 'px; } #wrap { margin-top: ' . $top_margin . 'px !important; margin-bottom: ' . $bottom_margin . 'px !important; } #menu-container.scrolling-effect-headroom, #menu-container.scrolling-effect-headroom.headroom--not-top.headroom--pinned, #menu-container.scrolling-effect-simple { margin-top: ' . $top_margin . 'px; } @media screen and (min-width: ' . $wrapper_width . 'px) { body.layout-boxed #menu-container { left: 50% !important; margin-left: -' . $wrapper_width / 2 . 'px; } .layout-boxed #wrap, .layout-framed #wrap { position: relative; margin: 0 auto; } }' );
		}

		// woocommerce 3
		wp_dequeue_style('select2');

	}

	/**
	 * Title filter
	 **/
	function wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		if( is_home() || is_front_page() )
			return $title;

		return $title . ' ' . $sep . ' ' . get_bloginfo( 'description' );

	}

	/**
	 * Add custom body classes
	 **/
	function body_classes( $classes ) {

		// If Unyson Framework is enabled
		if( wplab_recover_utils::is_unyson() ) {

			/**
			 * Layout mode
			 **/
			$classes[] = 'layout-' . fw_get_db_settings_option( 'body_layout/style' );

			/**
			 * Header style
			 **/
			if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$header_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_style' );
			} else {
				$header_style = fw_get_db_settings_option( 'header_style/style' );
			}

			$classes[] = 'header-' . $header_style;

			/**
			 * Maintenance
			 **/
			if( filter_var( fw_get_db_settings_option( 'maintenance_mode/enabled' ), FILTER_VALIDATE_BOOLEAN ) && !is_user_logged_in() ) {
				$classes[] = 'template-maintenance';
			}

			/**
			 * Preloader
			 **/
		 	$preloader_style = fw_get_db_settings_option( 'page_preloader/style' );
			if( $preloader_style == 'theme' ) {
				$classes[] = 'preloader';
				$classes[] = 'jpreloader';
			} elseif( $preloader_style != 'hidden' ) {
				$classes[] = 'preloader';
			}

			/**
			 * Animations
			 **/
			if( filter_var( fw_get_db_settings_option( 'css_animations/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'anim-on';
				if( filter_var( fw_get_db_settings_option( 'css_animations/true/css_animations_mobile' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$classes[] = 'anim-mobile-on';
				}
			}

			/**
			 * GoTop link
			 **/
			if( filter_var( fw_get_db_settings_option( 'go_top_link' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'go-top';
			}

			/**
			 * Header scrolling
			 **/
			if( filter_var( fw_get_db_settings_option( 'header_scrolling' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'fixed-header';
			}

			/**
			 * Custom inputs
			 **/
			if( ! filter_var( fw_get_db_settings_option( 'custom_inputs' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'no-custom-input';
			}

			/**
			 * Sidebar position
			 **/
		 	if( function_exists('fw_ext_sidebars_get_current_position') ) {
				$current_sidebar_position = fw_ext_sidebars_get_current_position();
				$classes[] = 'sidebar-' . $current_sidebar_position;
		 	} else {
		 		$classes[] = 'sidebar-right';
		 	}


			/**
			 * Parallax footer
			 **/
			if( filter_var( fw_get_db_settings_option( 'footer_parallax' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$classes[] = 'parallax-footer';
			}

			/**
			 * Additional settings for a single posts
			 **/
			if( is_single() || is_home() || is_page() ) {

				$post_id = is_home() ? get_option( 'page_for_posts' ) : get_the_ID();

				/**
				 * Intro header
				 **/
				if( filter_var( fw_get_db_post_option( $post_id, 'intro_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$classes[] = 'transparent-header';
					$classes[] = 'intro-header';
				}

			}

			/**
			 * Additional settings for pages
			 **/
			if( is_page() ) {

				/**
				 * One-page menu
				 **/
				if( filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$classes[] = 'one-page';
				}

			}

		} else {
			$classes[] = 'header-modern';
		}

		return $classes;
	}

	/**
	 * Enable or disable RSS feed
	 **/
	function setup_rss() {

		if( wplab_recover_utils::is_unyson() && ! filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
			remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
			remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
			remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link

			add_action( 'do_feed', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rdf', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss2', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_atom', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_rss2_comments', array( $this, 'disable_rss_feed' ), 1);
			add_action( 'do_feed_atom_comments', array( $this, 'disable_rss_feed' ), 1);
		}

	}

	/**
	 * Disable RSS feed
	 **/
	function disable_rss_feed() {
		wp_die( esc_html_e( 'RSS Feed was disabled by administrator', 'wplab-recover' ) );
	}

	/**
	 * Add thumbnails to RSS feed
	 **/
	function add_featured_image_to_feed( $content ) {
		global $post;

		if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_settings_option( 'rss_feed/display_thumbnails_in_rss' ), FILTER_VALIDATE_BOOLEAN ) ) {

			if ( has_post_thumbnail( $post->ID ) ){
				$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 800, 600 ) );
				$content = '<!-- POST THUMBNAIL --><img src="' . $img_src[0] . '" width="400" alt="" />' . $content;
			}

		}

		return $content;
	}

	/**
	 * Hide admin bar if it disabled in settings
	 **/
	function remove_admin_bar() {

		if ( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'hide_admin_bar' ), FILTER_VALIDATE_BOOLEAN ) && !current_user_can('delete_pages') && !is_admin()) {
			show_admin_bar( false );
		}

	}

	/**
	 * Custom search template
	 **/
	function custom_search_template() {
		ob_start();
		include wplab_recover_utils::locate_path( '/search-form.php' );
		return ob_get_clean();
	}

	/**
	 * Customize password form
	 **/
	function customize_password_protect() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . esc_html__( "To view this protected post, enter the password below:", 'wplab-recover' ) . '</p>
    <p><input class="pass" placeholder="' . esc_attr__( "Type here post password", 'wplab-recover' ) . '" name="post_password" id="' . $label . '" type="password" maxlength="20" /></p><p><input type="submit" name="Submit" value="' . esc_attr__( "Submit", "wplab_recover" ) . '" /></p>
    </form>
    ';
    return $o;
	}

	/**
	 * Add inline CSS styles
	 **/
	function add_inline_css( $content ) {
		$this->inline_css = $this->inline_css . "\r\n" . $content;
	}

	/**
	 * Add inline JavaScript
	 **/
	function add_inline_js( $content ) {
		$this->inline_js = $this->inline_js . "\r\n" . $content;
	}

	/**
	 * Print auto-generated inline JavaScript to wp_footer
	 **/
	function print_inline_js() {
		global $wplab_recover_core;
		?>

		<script type="text/javascript">
			// Load interface SVG Icons later, via AJAX to increase website loading speed
			(function($){
				$.ajax({
					url: '<?php echo $wplab_recover_core->skin_style_dir; ?>/svg.css?time=<?php echo _WPLAB_RECOVER_CACHE_TIME_; ?>',
					success: function( data ){
						$( 'head' ).append( '<style>' + data + '</style>' );
					}
				});
			})( window.jQuery );
		</script>

		<script type="text/javascript">
			<?php print trim( $this->inline_js ); ?>
		</script>

		<?php
	}

	/**
	 * Check for maintenance / coming soon mode
	 **/
	function is_maintenance() {

		if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'maintenance_mode/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
			$is_admin = current_user_can('delete_pages');

			if( ! $is_admin ) {

				$bg_image = fw_get_db_settings_option( 'maintenance_mode/true/background' );

				if( is_array( $bg_image ) && !empty( $bg_image ) ) {
					$this->add_inline_css('body.template-maintenance { background-image: url(' . $bg_image['url'] . '); }');

					$this->add_inline_css('body.template-maintenance .countdown .time .days:before { content: "' . esc_html__('Days', 'wplab-recover') . '"; }');
					$this->add_inline_css('body.template-maintenance .countdown .time .hours:before { content: "' . esc_html__('Hours', 'wplab-recover') . '"; }');
					$this->add_inline_css('body.template-maintenance .countdown .time .minutes:before { content: "' . esc_html__('Minutes', 'wplab-recover') . '"; }');
					$this->add_inline_css('body.template-maintenance .countdown .time .seconds:before { content: "' . esc_html__('Seconds', 'wplab-recover') . '"; }');

				}

				include( wplab_recover_utils::locate_path( '/page-template-maintenance.php' ) );
				exit();
			}

		}

	}

	/**
	 * Add splash HTML into preloader if enabled
	 **/
	function add_preloader_splash_html() {

		if( wplab_recover_utils::is_unyson() && fw_get_db_settings_option( 'page_preloader/style' ) == 'theme' ):

			$preloader_logo = fw_get_db_settings_option( 'page_preloader/theme/logo' );
			$preloader_logo = is_array( $preloader_logo ) && !empty( $preloader_logo ) ? $preloader_logo['url'] : '';

			$preloader_logo2x = fw_get_db_settings_option( 'page_preloader/theme/logo_2x' );
			$preloader_logo2x = is_array( $preloader_logo2x ) && !empty( $preloader_logo2x ) ? $preloader_logo2x['url'] : '';

			$preloader_logo2x = $preloader_logo2x <> '' ? 'data-at2x="' . esc_attr( $preloader_logo2x ) .'"' : 'data-no-retina';

			if( $preloader_logo <> '' ):
		?>
		<div id="jSplash">
			<img src="<?php echo esc_attr( $preloader_logo ); ?>" <?php echo $preloader_logo2x; ?> alt="" />
		</div>
		<?php
			endif;
		endif;

	}

}
