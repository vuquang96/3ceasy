<?php

/**
 * Primary core controller
 **/
class wplab_recover_core_controller {
	
	public $cfg;
	public $current_skin;
	public $skin_style_dir;
	public $menu_html;
	public $model;
	public $view;
	public $controller;
	
	/**
	 * Enter point for a framework
	 * @param array
	 **/
	public function run() {
		
		// Set the config
		$this->_set_config();
		
		// Start the session
		if( ! session_id() ) {
			@session_start();
		}
		
		// Translation support
		load_theme_textdomain( 'wplab-recover', get_template_directory() . '/languages' );
		
		// Theme activation & deactivation
		add_action( 'init', array( $this, 'activation_hook'));
		add_action( 'switch_theme', array( $this, 'deactivation_hook' ));
		
		// Load core classes
		$this->_dispatch();
		
		// Route $_GET/$_POST actions
		add_action( 'parse_request', array( $this, 'delegate_to_controller_action' ), 1 );
		add_action( 'admin_init', array( $this, 'delegate_to_controller_action' ), 1 );

	}
	
	/**
	 * Set the defaults
	 **/
	private function _set_config() {
		
		$this->cfg = array(
			'base_fonts' => array(
				array(
					'title' => 'Montserrat',
					'font_family' => 'montserrat',
				),
				array(
					'title' => 'Crimson Text Roman',
					'font_family' => 'crimson_textroman',
				),
			),
			'menu_styles' => array(
				'default' => esc_html__('Default (Accent color)', 'wplab-recover'),
				'white' => esc_html__('White', 'wplab-recover'),
				'white_slider' => esc_html__('White (for sliders)', 'wplab-recover'),
				'inverted' => esc_html__('Inverted (dark)', 'wplab-recover'),
				'inverted_slider' => esc_html__('Inverted (dark, for sliders)', 'wplab-recover'),
				'white_alt' => esc_html__('White alternate', 'wplab-recover'),
				'white_alt_slider' => esc_html__('White alternate (for sliders)', 'wplab-recover'),
				'inverted_alt' => esc_html__('Dark alternate', 'wplab-recover'),
				'inverted_alt_slider' => esc_html__('Dark alternate (for sliders)', 'wplab-recover'),
				'white_minimal' => esc_html__('White minimal, centered logo', 'wplab-recover'),
				'white_minimal_slider' => esc_html__('White minimal, centered logo (for sliders)', 'wplab-recover'),
				'dark_minimal' => esc_html__('Dark minimal, centered logo', 'wplab-recover'),
				'dark_minimal_slider' => esc_html__('Dark minimal, centered logo (for sliders)', 'wplab-recover'),
				'white_minimal_left' => esc_html__('White minimal, left-aligned logo', 'wplab-recover'),
				'white_minimal_left_slider' => esc_html__('White minimal, left-aligned logo (for sliders)', 'wplab-recover'),
				'dark_minimal_left' => esc_html__('Dark minimal, left-aligned logo', 'wplab-recover'),
				'dark_minimal_left_slider' => esc_html__('Dark minimal, left-aligned logo (for sliders)', 'wplab-recover'),
				'white_classic' => esc_html__('White classic, centered logo', 'wplab-recover'),
				'dark_classic' => esc_html__('Dark classic, centered logo', 'wplab-recover'),
			),
			'submenu_styles' => array(
				'dark' => esc_html__('Dark', 'wplab-recover'),
				'white' => esc_html__('White', 'wplab-recover'),
			),
			'animations' => array(
				'bounce' => esc_html__('Bounce', 'wplab-recover'),
				'flash' => esc_html__('Flash', 'wplab-recover'),
				'pulse' => esc_html__('Pulse', 'wplab-recover'),
				'rubberBand' => esc_html__('Rubber Band', 'wplab-recover'),
				'shake' => esc_html__('Shake', 'wplab-recover'),
				'swing' => esc_html__('Swing', 'wplab-recover'),
				'tada' => esc_html__('Tada', 'wplab-recover'),
				'wobble' => esc_html__('Wobble', 'wplab-recover'),
				'jello' => esc_html__('Jello', 'wplab-recover'),
				'bounceIn' => esc_html__('Bounce In', 'wplab-recover'),
				'bounceInDown' => esc_html__('Bounce In Down', 'wplab-recover'),
				'bounceInLeft' => esc_html__('Bounce In Left', 'wplab-recover'),
				'bounceInRight' => esc_html__('Bounce In Right', 'wplab-recover'),
				'bounceInUp' => esc_html__('Bounce In Up', 'wplab-recover'),
				'bounceOut' => esc_html__('Bounce Out', 'wplab-recover'),
				'bounceOutDown' => esc_html__('Bounce Out Down', 'wplab-recover'),
				'bounceOutLeft' => esc_html__('Bounce Out Left', 'wplab-recover'),
				'bounceOutRight' => esc_html__('Bounce Out Right', 'wplab-recover'),
				'bounceOutUp' => esc_html__('Bounce Out Up', 'wplab-recover'),
				'fadeIn' => esc_html__('Fade In', 'wplab-recover'),
				'fadeInDown' => esc_html__('Fade In Down', 'wplab-recover'),
				'fadeInDownBig' => esc_html__('Fade In Down Big', 'wplab-recover'),
				'fadeInLeft' => esc_html__('Fade In Left', 'wplab-recover'),
				'fadeInLeftBig' => esc_html__('Fade In Left Big', 'wplab-recover'),
				'fadeInRight' => esc_html__('Fade In Right', 'wplab-recover'),
				'fadeInRightBig' => esc_html__('Fade In Right Big', 'wplab-recover'),
				'fadeInUp' => esc_html__('Fade In Up', 'wplab-recover'),
				'fadeInUpBig' => esc_html__('Fade In Up Big', 'wplab-recover'),
				'fadeOut' => esc_html__('Fade Out', 'wplab-recover'),
				'fadeOutDown' => esc_html__('Fade Out Down', 'wplab-recover'),
				'fadeOutDownBig' => esc_html__('Fade Out Down Big', 'wplab-recover'),
				'fadeOutLeft' => esc_html__('Fade Out Left', 'wplab-recover'),
				'fadeOutLeftBig' => esc_html__('Fade Out Left Big', 'wplab-recover'),
				'fadeOutRight' => esc_html__('Fade Out Right', 'wplab-recover'),
				'fadeOutRightBig' => esc_html__('Fade Out Right Big', 'wplab-recover'),
				'fadeOutUp' => esc_html__('Fade Out Up', 'wplab-recover'),
				'fadeOutUpBig' => esc_html__('Fade Out Up Big', 'wplab-recover'),
				'flip' => esc_html__('Flip', 'wplab-recover'),
				'flipInX' => esc_html__('Flip in X', 'wplab-recover'),
				'flipInY' => esc_html__('Flip in Y', 'wplab-recover'),
				'flipOutX' => esc_html__('Flip out X', 'wplab-recover'),
				'flipOutY' => esc_html__('Flip out Y', 'wplab-recover'),
				'lightSpeedIn' => esc_html__('Light Speed In', 'wplab-recover'),
				'lightSpeedOut' => esc_html__('Light Speed Out', 'wplab-recover'),
				'rotateIn' => esc_html__('Rotate In', 'wplab-recover'),
				'rotateInDownLeft' => esc_html__('Rotate In Down Left', 'wplab-recover'),
				'rotateInDownRight' => esc_html__('Rotate In Down Right', 'wplab-recover'),
				'rotateInUpLeft' => esc_html__('Rotate In Up Left', 'wplab-recover'),
				'rotateInUpRight' => esc_html__('Rotate In Up Right', 'wplab-recover'),
				'rotateOut' => esc_html__('Rotate Out', 'wplab-recover'),
				'rotateOutDownLeft' => esc_html__('Rotate Out Down Left', 'wplab-recover'),
				'rotateOutDownRight' => esc_html__('Rotate Out Down Right', 'wplab-recover'),
				'rotateOutUpLeft' => esc_html__('Rotate Out Up Left', 'wplab-recover'),
				'rotateOutUpRight' => esc_html__('Rotate Out Up Right', 'wplab-recover'),
				'slideInUp' => esc_html__('Slide In Up', 'wplab-recover'),
				'slideInDown' => esc_html__('Slide In Down', 'wplab-recover'),
				'slideInLeft' => esc_html__('Slide In Left', 'wplab-recover'),
				'slideInRight' => esc_html__('Slide In Right', 'wplab-recover'),
				'slideOutUp' => esc_html__('Slide Out Up', 'wplab-recover'),
				'slideOutDown' => esc_html__('Slide Out Down', 'wplab-recover'),
				'slideOutLeft' => esc_html__('Slide Out Left', 'wplab-recover'),
				'slideOutRight' => esc_html__('Slide Out Right', 'wplab-recover'),
				'zoomIn' => esc_html__('Zoom In', 'wplab-recover'),
				'zoomInDown' => esc_html__('Zoom In Down', 'wplab-recover'),
				'zoomInLeft' => esc_html__('Zoom In Left', 'wplab-recover'),
				'zoomInRight' => esc_html__('Zoom In Right', 'wplab-recover'),
				'zoomInUp' => esc_html__('Zoom In Up', 'wplab-recover'),
				'zoomOut' => esc_html__('Zoom Out', 'wplab-recover'),
				'zoomOutDown' => esc_html__('Zoom Out Down', 'wplab-recover'),
				'zoomOutLeft' => esc_html__('Zoom Out Left', 'wplab-recover'),
				'zoomOutRight' => esc_html__('Zoom Out Right', 'wplab-recover'),
				'zoomOutUp' => esc_html__('Zoom Out Up', 'wplab-recover'),
				'hinge' => esc_html__('Hinge', 'wplab-recover'),
				'rollIn' => esc_html__('Roll In', 'wplab-recover'),
				'rollOut' => esc_html__('Roll Out', 'wplab-recover'),
			)
		);
		
	}
	
	/**
	 * Do some stuff when plugin was just activated
	 **/
	public function activation_hook() {
		global $pagenow, $wp_version;

		if( version_compare( PHP_VERSION, '5.2.6', '<' ) ) {
			wp_die( sprintf( esc_html__( 'Cannot activate the theme. PHP version >= 5.2.6 is required. Your PHP version: %s', 'wplab-recover' ), PHP_VERSION ) );
		}
	
		if( version_compare( $wp_version, '4.2', '<' ) ) {
			wp_die( sprintf( esc_html__( 'Cannot activate the theme. WordPress version >= 4.2 is required. Your WordPress version: %s', 'wplab-recover' ), $wp_version ) );
		}
	
		flush_rewrite_rules( true );
		wp_cache_flush();
		
	}
	
	/**
	 * Deactivation hook
	 **/
	public function deactivation_hook() {
		
		flush_rewrite_rules( true );
		
	}
	
	/**
	 * Autoload and instantiate all application
	 * classes neccessary for this plugin
	 **/
	private function _dispatch() {
		$this->model =		  new stdClass();
		$this->view =				new stdClass();
		$this->controller =	new stdClass();

		// Manually load dependency classes first
		require_once get_template_directory() . '/wproto/view/view.php';

		// Manually instantiate dependency classes first
		$this->view = new wplab_recover_view();
		$this->controller->base = $this;
		
		// Models
		require_once get_template_directory() . '/wproto/model/database.php';
		$this->model->database = new wplab_recover_database();
		
		require_once get_template_directory() . '/wproto/model/post.php';
		$this->model->post = new wplab_recover_post();
		
		require_once get_template_directory() . '/wproto/model/slider.php';
		$this->model->slider = new wplab_recover_slider();

		// Helpers
		$this->_autoload_directory( 'helper', '/', false );

		// Controllers
		require_once get_template_directory() . '/wproto/controller/shared/io-controller.php';
		$this->controller->io = new wplab_recover_io_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/init-controller.php';
		$this->controller->init = new wplab_recover_init_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/menu-controller.php';
		$this->controller->menu = new wplab_recover_menu_controller();
		
		require_once get_template_directory() . '/wproto/controller/shared/ajax-controller.php';
		$this->controller->ajax = new wplab_recover_ajax_controller();
		
		if( is_admin() ) {
			
			// Controllers for admin part only
			require_once get_template_directory() . '/wproto/controller/admin/backend-controller.php';
			$this->controller->backend = new wplab_recover_backend_controller();
			
			require_once get_template_directory() . '/wproto/controller/admin/woocommerce-admin-controller.php';
			$this->controller->woocommerce_admin = new wplab_recover_woocommerce_backend_controller();
			
			require_once get_template_directory() . '/wproto/controller/admin/customizer-controller.php';
			$this->controller->customizer = new wplab_recover_customizer_controller();
			
		} else {
			
			// Controllers for front-end part only			
			require_once get_template_directory() . '/wproto/controller/front/front-controller.php';
			$this->controller->front = new wplab_recover_front_controller();
			
			require_once get_template_directory() . '/wproto/controller/front/woocommerce-controller.php';
			$this->controller->woocommerce = new wplab_recover_woocommerce_controller();
			
			require_once get_template_directory() . '/wproto/controller/front/shortcodes-controller.php';
			$this->controller->shortcodes = new wplab_recover_shortcodes_controller();
			
		}
		
		if( defined( 'WPROTO_DEMO_STAND') && WPROTO_DEMO_STAND && file_exists( get_template_directory() . '/wproto/controller/front/shortcodes-controller.php' ) ) {
			require_once get_template_directory() . '/wproto/controller/front/demo-stand-controller.php';
			$this->controller->demo_stand = new wplab_recover_demo_stand_controller();
		}
		
		$this->_autoload_directory( 'widget', '/', false );

		// Inject models, view and controllers from this base
		// controller into all OTHER controllers & models
		foreach ( $this->controller as $controller ) {
			$controller->_inject_application_classes( $this->model, $this->view, $this->controller );
		}
	}
	
	/**
	 * Autoload all scripts in a directory
	 * @param string
	 * @param string
	 * @param bool
	 **/
	private function _autoload_directory( $layer, $dir = '/', $load_class = true ) {

		$directory = get_template_directory() . '/wproto/' . $layer . $dir;
		$handle = opendir( $directory );

		while ( false !== ( $file = readdir( $handle))) {
			
			if ( is_file( $directory . $file)) {
				// Figure out class name from file name
				$class = str_replace('.php', '', $file);
				
				$class = 'wplab_recover_' . str_replace('-', '_', $class ) . '';
				$shortClass = str_replace( 'wplab_recover_', '', $class );
				$shortClass = str_replace( '_' . $layer, '', $shortClass);

				if( $load_class ) {
					// Avoid recursion
					if ( $class != get_class( $this) ) {
						// Include and instantiate class
						require_once $directory . $file;
						$this->$layer->$shortClass = new $class();
					}
				} else {
					require_once $directory . $file;
				}

			}
		}
		
	}
	
	/**
	 * Inject models, view and controllers
	 * into all other controllers to make
	 * them callable from there
	 * @param object
	 * @param object
	 * @param object
	 **/
	private function _inject_application_classes( $model, $view, $controller ) {
		$this->model = $model;
		$this->view = $view;
		$this->controller = $controller;
	}
	
	/**
	 * Parse custom request using our own routing,
	 * i.e. $_GET['wplab_recover_action'] or $_POST['wplab_recover_action'],
	 * and then delegate to appropriate controller
	 * action.
	 *
	 * Example 1: '/?wplab_recover_action=front_controller-view'
	 * Example 2: '/wp-admin/index.php?wplab_recover_action=admin_settings-save'
	 **/
	public function delegate_to_controller_action() {
		if ( isset( $_POST['wplab_recover_action'] ) ) {
			$action = $_POST['wplab_recover_action'];
		} elseif ( isset( $_GET['wplab_recover_action'] ) ) {
			$action = $_GET['wplab_recover_action'];
		}

		if ( isset( $action ) ) {
			$controller_and_action = explode( '-', $action );

			if ( count( $controller_and_action ) == 2 ) {
				//! TODO: Learn from popular frameworks how they secure this bit here!
				$controller = 'wplab_recover_' . $controller_and_action[0] . '_controller';
				$short_controller = $controller_and_action[0];
				$action = $controller_and_action[1];

				if ( class_exists( $controller ) && method_exists( $controller , $action ) ) {
					call_user_func( array( $this->controller->$short_controller, $action ) );
				} 
			}
		}
	}
	
	/**
	 * Get a model
	 **/
	function model( $name ) {
		
		$class = 'wplab_recover_' . $name;
		
		if( !isset( $this->_model->$class ) ) {
			$directory = get_template_directory() . '/wproto/model/';
			require_once $directory . $name . '.php';
			
			@$this->_model->$name = new $class();
			
			return $this->_model->$name;
		} else {
			return $this->_model->$name;
		}
		
	}
	
}