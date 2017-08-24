<?php

require_once get_template_directory() . '/library/tgm-plugin-activation/class-tgm-plugin-activation.php';	

/**
 * Backend controller
 **/
class wplab_recover_backend_controller extends wplab_recover_core_controller {
	
	function __construct() {
		
		// Install required plugins
		add_action( 'tgmpa_register', array( $this, 'register_plugins' ) );
		
		// Extend Unyson with new option type
		add_action( 'fw_option_types_init', array( $this, 'extend_unyson_option_types' ) );
		
		// Add admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_styles' ) );
		
		// Footer notice
		add_filter( 'admin_footer_text', array( $this, 'add_footer_info' ) );
		
		// Allow additional mime types
		add_filter( 'upload_mimes', array( $this, 'add_upload_types' ) );
		
		// disable wp admin for non-admins optionally
		add_action( 'admin_init', array( $this, 'disable_wp_admin_access' ) );
		
		// hide activation notice
		add_action( 'admin_init', array( $this, 'hide_notice' ) );
		
		// Demo notice
		add_action( 'admin_notices', array( $this, 'add_notices'));
		
		// Demo data
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'register_demo_data' ) );
		
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'ignore_upload_ext' ), 10, 4);
		
	}
	
	/**
	 * Install required plugins
	 **/
	function register_plugins() {
		
		$plugins = array(
			array(
				'name' 								=> 'Unyson',
				'slug' 								=> 'unyson',
				'version' 						=> '2.3.3',
				'required' 						=> true,
				'force_activation' 		=> false
			),
			array(
				'name' 								=> 'WooCommerce',
				'slug' 								=> 'woocommerce',
				'version' 						=> '2.4.7',
				'required' 						=> true,
				'force_activation' 		=> false
			),
			array(
				'name' 								=> 'Mail Chimp',
				'slug' 								=> 'mailchimp-for-wp',
				'version' 						=> '2.3.10',
				'required' 						=> true,
				'force_activation' 		=> false
			),
			array(
				'name'     						=> 'Slider Revolution',
				'slug'     						=> 'revslider',
				'required' 						=> false,
				'version' 						=> '5.0.5',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'source' 							=> 'http://update.wplab.pro/third_party_plugins/revslider.zip'
			),
			array(
				'name'     						=> 'Envato Market',
				'slug'     						=> 'envato-market',
				'source'   						=> 'http://update.wplab.pro/third_party_plugins/envato-market.zip',
				'required' 						=> false,
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
			),
		);

		tgmpa( $plugins, array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    ) );
		
	}
	
	/** 
	 * Add new Unyson option types
	 **/
	function extend_unyson_option_types() {
		if( is_admin() ) {
			require_once get_template_directory() . '/framework-customizations/wproto_option_types/class-fw-option-type-stylebox.php';
		}
	}
	
	/**
	 * Add admin scripts
	 **/
	function add_scripts() {
		global $wplab_recover_core;
		
		$screen = get_current_screen();
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'wp-color-picker' );
		
		wp_enqueue_media();

		$js_vars = array(
			'adminURL' => admin_url(),
			'strSelectFile' => esc_html__( 'Select a file', 'wplab-recover' ),
			'strSelectImage' => esc_html__( 'Select an image', 'wplab-recover' ),
			'strSelect' => esc_html__( 'Select', 'wplab-recover' ),
			'siteDomain' => $_SERVER['SERVER_NAME'],
			'strPleaseWait' => esc_html__( 'Please, wait...', 'wplab-recover' ),
			'strCompilingLess' => esc_html__( 'Please wait until we\'re applying your custom styles.', 'wplab-recover'),
			'strError' => esc_html__( 'Error', 'wplab-recover' ),
			'strSuccess' => esc_html__( 'Success!', 'wplab-recover' ),
			'strLoadingLessFiles' => esc_html__('Loading list of LESS sources...', 'wplab-recover'),
			'strLoadingLessFilesSuccess' => esc_html__('We have got the list.', 'wplab-recover'),
			'strCompilationLess' => esc_html__('Compilation LESS into CSS...', 'wplab-recover'),
			'strLessParseError' => esc_html__('Cannot parse LESS. That\'s why: ', 'wplab-recover'),
			'strCompilationLessSuccess' => esc_html__('Successfully.', 'wplab-recover'),
			'strSavingLessIntoFile' => esc_html__('Saving stylesheet...', 'wplab-recover'),
			'strRefreshing' => esc_html__('Submitting the form...', 'wplab-recover'),
			'strOf' => esc_html__('of', 'wplab-recover'),
			'strCompilingFails' => esc_html__('Failed to write stylesheet. Please check that your /wp-content/uploads/ directory is writable and try again.', 'wplab-recover'),
			'strCompilingFile' => esc_html__('Compiling source', 'wplab-recover'),
			'strConfirmChangeSkin' => esc_html__('Do you want to change current skin? All customization settings will be reset to defaults.', 'wplab-recover'),
			'themeLessPath' => get_template_directory_uri() . '/skins/' . $wplab_recover_core->current_skin . '/less/',
			'strAllDone' => esc_html__( 'All done. Saving style version...', 'wplab-recover' ),
			'strErrorCustomCSSFile' => esc_html__('ERROR! Can not write custom CSS into file', 'wplab-recover'),
		);

		if( isset( $_GET['page'] ) && $_GET['page'] == 'theme_customizer' ) {
			wp_register_script( 'less', get_template_directory_uri() . '/js/libs/less.min.js', false, _WPLAB_RECOVER_CACHE_TIME_, true );
			wp_enqueue_script( 'less', array( 'jquery' ) );
			wp_register_script( 'serialize-object', get_template_directory_uri() . '/js/libs/jquery.serialize-object.min.js', false, _WPLAB_RECOVER_CACHE_TIME_, true );
			wp_enqueue_script( 'serialize-object', array( 'jquery' ) );
		}	
		
		wp_register_script( 'theme-core-admin', get_template_directory_uri() . '/js/admin/admin.js', false, _WPLAB_RECOVER_CACHE_TIME_, true );		
		wp_enqueue_script( 'theme-core-admin', array( 'jquery' ) );
		wp_localize_script( 'theme-core-admin', 'wprotoVars', $js_vars );
		
	}
	
	/**
	 * Add admin styles
	 **/
	function add_styles() {
		global $wp_styles, $wplab_recover_core;
		
		$screen = get_current_screen();
	
		if( wplab_recover_utils::is_unyson() ) {
			$wplab_recover_core->controller->init->load_theme_fonts();
		}	
		
		// Load default theme fonts
		if( ! wplab_recover_utils::is_unyson() || ( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'default_fonts' ), FILTER_VALIDATE_BOOLEAN ) ) ) {
			wp_enqueue_style( 'theme-default-fonts', get_template_directory_uri() . '/fonts/fonts.css' );
		}
		
		wp_enqueue_style( 'theme-core-admin', get_template_directory_uri() . '/css/admin/admin.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
				
		if( isset( $_GET['page'] ) && $_GET['page'] == 'theme_customizer' ) {
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_style( 'wproto-ui', get_template_directory_uri() . '/css/admin/ui/jquery-ui.min.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		}
		
	}
	
	/**
	 * Add footer info
	 **/
	function add_footer_info( $text ) {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		return $text . ' ' . sprintf( wp_kses( __('<i>Theme created by <a href="%s" target="_blank">WPlab.Pro</a></i>. If you love this theme, please support us and <a href="%s" target="_blank">rate it with &#9733;&#9733;&#9733;&#9733;&#9733;</a> on ThemeForest, it is so important for us!', 'wplab-recover' ), $allowed_tags ), 'http://themeforest.net/user/wplab/?ref=wplab', 'http://themeforest.net/downloads' );
	}
	
	/**
	 * Allow additional mime types to upload
	 **/
	function add_upload_types( $existing_mimes ) {
		$existing_mimes['ico'] = 'image/vnd.microsoft.icon';
		$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
		$existing_mimes['woff2'] = 'application/x-woff';
		$existing_mimes['woff'] = 'application/x-woff';
		$existing_mimes['ttf'] = 'application/octet-stream';
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['mp4'] = 'video/mp4';
		$existing_mimes['ogv'] = 'video/ogg';
		$existing_mimes['webm'] = 'video/webm';
		$existing_mimes['svg'] = 'image/svg+xml';
		return $existing_mimes;
	}
	
	/**
	 * Disable access to WP admin for non-admins optionally
	 **/
	function disable_wp_admin_access() {
		if ( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'logout_non_admins' ), FILTER_VALIDATE_BOOLEAN ) && ! current_user_can( 'manage_options' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
  		wp_redirect( home_url() );
			exit;
		}
	}
	
	/**
	 * Add admin notices
	 **/
	function add_notices() {
		global $wplab_recover_core;
		
		// demo data notice
		if( ! get_option('wplab_recover_hide_activation_message') ) {
			$this->view->load_partial( 'notice/activation' );
		}
		
		// is maintenance enabled
		if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'maintenance_mode/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
			$this->view->load_partial( 'notice/maintenance' );
		}
		
		// need to re-compile stylesheet
		$current_style_version = get_option( 'wplab_recover_compiled_style_version' );
		$screen = get_current_screen();
		
		if( wplab_recover_utils::is_unyson() && $current_style_version != '' && ( $screen->id != 'appearance_page_theme_customizer' ) ) {
			$style_version = $wplab_recover_core->controller->io->read( get_template_directory() . '/skins/' . $wplab_recover_core->current_skin . '/version.txt' );

			if( get_option('wplab_recover_theme_custom_styles') == 'yes' && version_compare( $style_version, $current_style_version, '>') ) {
				$this->view->load_partial( 'notice/customizer_update' );
			}	
		}
		
	}
	
	/**
	 * Hide activation notice
	 **/
	function hide_notice() {
		
		if( isset( $_GET['wproto_hide_activation_notice'] ) ) {
			update_option('wplab_recover_hide_activation_message', true);
		}
		
		if( isset( $_GET['wproto_hide_style_update_notice'] ) ) {
			update_option('wplab_recover_compiled_style_version', '' );
		}
		
	}
	
	/**
	 * Register demo data
	 **/
	function register_demo_data() {
		
		$curr_url = get_template_directory_uri();
		
    $demos_array = array(
      'modern' => array(
        'title' => esc_html__('Modern', 'wplab-recover'),
        'screenshot' => $curr_url . '/images/demo-modern.png',
        'preview_link' => 'http://themes.wplab.pro/recover/home-modern/',
      ),
      'classic' => array(
        'title' => esc_html__('Classic', 'wplab-recover'),
        'screenshot' => $curr_url . '/images/demo-classic.png',
        'preview_link' => 'http://themes.wplab.pro/recover-corporate/home-transparent-menu/',
      ),
    );

    $download_url = 'http://demo-data.wplab.pro/recover/';

    foreach ($demos_array as $id => $data) {
        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
          'url' => $download_url,
          'file_id' => $id,
        ));
        $demo->set_title( $data['title']);
        $demo->set_screenshot( $data['screenshot']);
        $demo->set_preview_link( $data['preview_link']);

        $demos[ $demo->get_id() ] = $demo;

        unset( $demo );
    }

    return $demos;
	}
	
	function ignore_upload_ext( $checked, $file, $filename, $mimes ) {
		
		//we only need to worry if WP failed the first pass
		if(!$checked['type']){
			//rebuild the type info
			$wp_filetype = wp_check_filetype( $filename, $mimes );
			$ext = $wp_filetype['ext'];
			$type = $wp_filetype['type'];
			$proper_filename = $filename;
	
			//preserve failure for non-svg images
			if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
				$ext = $type = false;
			}
	
			//everything else gets an OK, so e.g. we've disabled the error-prone finfo-related checks WP just went through. whether or not the upload will be allowed depends on the <code>upload_mimes</code>, etc.
	
			$checked = compact('ext','type','proper_filename');
		}
	
		return $checked;
		
	}
	
}