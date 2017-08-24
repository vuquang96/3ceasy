<?php 
/**
 * Customizer controller
 **/
class wplab_recover_customizer_controller extends wplab_recover_core_controller {
	
	function __construct() {
		
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		
		// AJAX
		add_action( 'wp_ajax_wproto_save_custom_fonts_list', array( $this, 'ajax_save_custom_fonts_list' ));
		add_action( 'wp_ajax_wproto_get_less_sources_list', array( $this, 'ajax_get_less_sources_list' ) );
		add_action( 'wp_ajax_wproto_get_less_content', array( $this, 'ajax_get_less_file_content' ) );
		add_action( 'wp_ajax_wproto_save_css', array( $this, 'ajax_save_css' ) );
		add_action( 'wp_ajax_wproto_change_skin', array( $this, 'ajax_change_skin' ) );
		add_action( 'wp_ajax_wproto_save_style_version', array( $this, 'save_style_version' ) );
		
	}
	
	/**
	 * Add customizer to menu
	 **/
	function add_admin_menu() {
		global $menu, $submenu;
		
		if ( current_user_can( 'edit_theme_options' ) ) {
			add_theme_page( esc_html__( 'Fonts and Colors', 'wplab-recover' ), esc_html__( 'Fonts and Colors', 'wplab-recover' ), 'edit_theme_options', 'theme_customizer', array( $this, 'display_customizer' ) );
		}
		
	}
	
	/**
	 * Display Customizer screen
	 **/
	function display_customizer() {
		global $wplab_recover_core;
		$wplab_recover_core->view->load_partial( 'settings/customizer', array() );
	}
	
	/**
	 * Save settings handler
	 **/
	function save() {
		
		$settings_array = array();
		$_POST = wp_unslash( $_POST );
		
		if( isset( $_POST['wproto_reset_to_defaults'] ) ) {
			update_option( 'wplab_recover_theme_custom_styles', 'no' );
			update_option( 'wplab_recover_theme_styles', '' );
			update_option( 'wplab_recover_compiled_style_version', '' );
			
		} elseif( isset( $_POST['theme_styles'] ) && is_array( $_POST['theme_styles'] ) ) {
			update_option( 'wplab_recover_theme_custom_styles', 'yes' );
			update_option( 'wplab_recover_theme_styles', $_POST['theme_styles'] );	
		}
			
		header( 'Location: ' . add_query_arg( array( 'updated' => 'true' ) ) );
		exit;
		
	}
	
	/**
	 * Save custom fonts list
	 **/
	function ajax_save_custom_fonts_list() {
		
		$fonts = $_POST['data'];
		
		if( is_array( $fonts ) && !empty( $fonts ) && count( $fonts ) > 0 ) {
			update_option( 'wplab_recover_theme_custom_fonts', $fonts );
		} else {
			update_option( 'wplab_recover_theme_custom_fonts', '' );
		}
		
	}
	
	/**
	 * Get list of LESS sources
	 **/
	function ajax_get_less_sources_list() {
		global $wplab_recover_core;
		
		$less_files = array();
		
    if ( $dh = opendir( get_template_directory() . '/skins/' . $wplab_recover_core->current_skin . '/less' )) {
      while (($file = readdir($dh)) !== false) {
      	
      	if( in_array( $file, array( '.', '..', 'vars.less') ) ) {
      		continue;
      	}
      	
        $less_files['files'][] = $file;
      }
      closedir($dh);
    }
    
    $less_files['count'] = count( $less_files['files'] );  
    
    die( json_encode( $less_files ) );
		
	}
	
	/**
	 * Get LESS file content
	 **/
	function ajax_get_less_file_content() {
		global $wplab_recover_core;
		
		$file = $_POST['file'];
		
		$path = wplab_recover_utils::locate_path( '/skins/' . $wplab_recover_core->current_skin . '/less/' . $file );
		
		$wplab_recover_core->controller->io->read( $path, true );
		
		die;
		
	}
	
	/**
	 * Save compiled LESS into file
	 **/
	function ajax_save_css() {
		global $wplab_recover_core;
		
		$css = stripslashes_deep( $_POST['content'] );
		$less_file = $_POST['file'];
		$css_file = str_replace( '.less', '.css', $less_file );
		
		$upload_dir = wp_upload_dir();
		
		// write to a file
		if( wp_mkdir_p( $upload_dir['basedir'] . '/wplab_recover_styles' ) ) {
			$wplab_recover_core->controller->io->write( $upload_dir['basedir'] . '/wplab_recover_styles/' . $css_file, $css );
			echo 'ok';
		} else {
			echo 'false';
		}
		die;
	}
	
	/**
	 * Change default skin
	 **/
	function ajax_change_skin() {
		
		$skin = $_POST['skin'];
		
		update_option( 'wplab_recover_current_skin', $skin );
		
		die;
		
	}
	
	/**
	 * Save style version
	 **/
	function save_style_version() {
		global $wplab_recover_core;
		
		$style_version = $wplab_recover_core->controller->io->read( get_template_directory() . '/skins/' . $wplab_recover_core->current_skin . '/version.txt' );
		
		update_option( 'wplab_recover_compiled_style_version', $style_version );
		die;
	}
	
}