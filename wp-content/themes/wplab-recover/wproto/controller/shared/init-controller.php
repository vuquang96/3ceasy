<?php
/**
 * Theme init
 **/
class wplab_recover_init_controller extends wplab_recover_core_controller {
	
	function __construct() {
		
		// add theme support
		add_action( 'init', array( $this, 'add_theme_support'));
		
		// register menus
		add_action( 'init', array( $this, 'register_menus'));
		
		// register sidebars
		add_action( 'widgets_init', array( $this, 'register_sidebars'));
		
		// scan for skins
		$this->scan_skins();
		
	}
	
	/**
	 * Add theme support
	 **/
	function add_theme_support() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );		
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'audio', 'link', 'image', 'chat' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'woocommerce' );
		
		remove_post_type_support( 'page', 'comments' );
		remove_post_type_support( 'page', 'thumbnail' );
	}
	
	/**
	 * Register theme menus
	 **/
	function register_menus() {
		register_nav_menus( array(
			'header_menu' => esc_html__('Header Menu', 'wplab-recover')
		));
	}
	
	/**
	 * Register theme sidebars
	 **/
	function register_sidebars() {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Left Sidebar', 'wplab-recover' ),
			'id'            => 'sidebar-left',
			'description'   => esc_html__( 'Appears in the left side of the site.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Right Sidebar', 'wplab-recover' ),
			'id'            => 'sidebar-right',
			'description'   => esc_html__( 'Appears in the right side of the site.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'wplab-recover' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Appears on WooCommerce pages.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area (Primary)', 'wplab-recover' ),
			'id'            => 'sidebar-footer-primary',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area (Secondary)', 'wplab-recover' ),
			'id'            => 'sidebar-footer-secondary',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area (Third)', 'wplab-recover' ),
			'id'            => 'sidebar-footer-third',
			'description'   => esc_html__( 'Appears in the footer section of the site.', 'wplab-recover' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '<div class="clearfix"></div></div></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		));
		
	}
	
	/**
	 * Scan for skins
	 **/
	function scan_skins() {
		global $wplab_recover_core;
		
		$skins = array();
		$path = get_template_directory() . '/skins';
		
		$current_skin = get_option( 'wplab_recover_current_skin');
		
		if( ! $current_skin || ! is_dir( $path . '/' . $current_skin ) ) {
			$elements = scandir( $path );
			
			foreach( $elements as $element ) {
				if ( $element === '.' or $element === '..') continue;
				if ( is_dir( $path . '/' . $element ) ) {
					$skins[] = $element;
				}
			}
			
			$wplab_recover_core->current_skin = $skins[0];
			update_option( 'wplab_recover_current_skin', $wplab_recover_core->current_skin );
		} else {
			$wplab_recover_core->current_skin = $current_skin;
		}
		
		$upload_dir = wp_upload_dir();
		$cssdir = get_option('wplab_recover_theme_custom_styles') == 'yes' ? $upload_dir['baseurl'] . '/wplab_recover_styles' : get_template_directory_uri() . '/skins/' . $wplab_recover_core->current_skin . '/css';
		$wplab_recover_core->skin_style_dir = $cssdir;
		
	}
	
	/**
	 * Load theme fonts
	 **/
	function load_theme_fonts() {
		global $wplab_recover_core;
		
		$simple_base_fonts = array();
		foreach( $wplab_recover_core->cfg['base_fonts'] as $k=>$f ) {
			$simple_base_fonts[] = $f['font_family'];
		}
		
		$custom_fonts = get_option( 'wplab_recover_theme_custom_fonts' );
		
		if( is_array( $custom_fonts ) ) {
			$custom_fonts = array_diff( $custom_fonts, $simple_base_fonts );
		}
		
		if( is_array( $custom_fonts ) && !empty( $custom_fonts ) && count( $custom_fonts ) > 0 ) {
			
			$uploaded_fonts = fw_get_db_settings_option( 'custom_fonts' );
			
			if( is_array( $uploaded_fonts ) && !empty( $uploaded_fonts ) && count( $uploaded_fonts ) > 0 ) {
			
				foreach( $custom_fonts as $font ) {
					
					foreach( $uploaded_fonts as $fk=>$u_font ) {
						
						if( $u_font['font_family'] == $font ) {
							
							$eot = isset( $u_font['file_eot'] ) && is_array( $u_font['file_eot'] ) && !empty( $u_font['file_eot'] ) ? 'src: url(\'' . $u_font['file_eot']['url'] . '\'); src: url(\'' . $u_font['file_eot']['url'] . '?#iefix\') format(\'embedded-opentype\'),' : '';
							$woff = isset( $u_font['file_woff'] ) && is_array( $u_font['file_woff'] ) && !empty( $u_font['file_woff'] ) ? 'src: url(\'' . $u_font['file_woff']['url'] . '\'); src: url(\'' . $u_font['file_woff']['url'] . '\') format(\'woff\'),' : '';
							$woff2 = isset( $u_font['file_woff2'] ) && is_array( $u_font['file_woff2'] ) && !empty( $u_font['file_woff2'] ) ? 'src: url(\'' . $u_font['file_woff2']['url'] . '\'); src: url(\'' . $u_font['file_woff2']['url'] . '\') format(\'woff2\'),' : '';
							$truetype = isset( $u_font['file_truetype'] ) && is_array( $u_font['file_truetype'] ) && !empty( $u_font['file_truetype'] ) ? 'src: url(\'' . $u_font['file_truetype']['url'] . '\'); src: url(\'' . $u_font['file_truetype']['url'] . '\') format(\'truetype\'),' : '';
							$svg = isset( $u_font['file_svg'] ) && is_array( $u_font['file_svg'] ) && !empty( $u_font['file_svg'] ) ? 'src: url(\'' . $u_font['file_svg']['url'] . '\'); src: url(\'' . $u_font['file_svg']['url'] . '#' . $u_font['font_family'] . '\') format(\'svg\')' : '';
							
							wp_add_inline_style( 'theme-footer', "@font-face { font-family: '" . $u_font['font_family'] . "'; $eot $woff $woff2 $truetype $svg }" );
						}
						
					}
					
				}
				
			}
			
		}
	
		// Custom Google fonts
		$custom_google_fonts = array();
		$custom_google_fonts = wplab_recover_utils::get_all_custom_theme_fonts();
		
		if( is_array( $custom_google_fonts ) ) {
			$custom_google_fonts = array_diff( $custom_google_fonts, $simple_base_fonts );
			if( is_array( $custom_fonts ) ) {
				$custom_google_fonts = array_diff( $custom_google_fonts, $custom_fonts );
			}
		}
		
		// Default fonts
		
		$custom_google_fonts_string = '';
		
		// Additional font subsets
		$font_subsets = array();
		$font_subsets_settings = fw_get_db_settings_option( 'font_subsets' );
		
		if( is_array( $font_subsets_settings ) && !empty( $font_subsets_settings ) ) {
			foreach( $font_subsets_settings as $k=>$v ) {
				if( $v === true ) {
					$font_subsets[] = $k;
				}
			}
		}
		
		// Additional font styles
		$font_styles = array();
		$font_styles_settings = fw_get_db_settings_option( 'font_styles' );
		
		if( is_array( $font_styles_settings ) && !empty( $font_styles_settings ) ) {
			foreach( $font_styles_settings as $k=>$v ) {
				if( $v === true ) {
					$font_styles[] = $k;
				}
			}
		}
		
		// Load google fonts
		if( is_array( $custom_google_fonts ) && ! empty( $custom_google_fonts ) > 0 ) {

			foreach( $custom_google_fonts as $k=>$font ) {
				$custom_google_fonts_string .= $font . ':' . implode( ',', $font_styles ) . '|';
			}
			
			$custom_google_fonts_string .= '&subset=' . implode( ',', $font_subsets );
			wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=' . $custom_google_fonts_string );
			
		}
	}
	
}