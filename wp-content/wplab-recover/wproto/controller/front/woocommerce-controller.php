<?php 
/**
 * WooCommerce front-end controller
 **/
class wplab_recover_woocommerce_controller extends wplab_recover_core_controller {
	
	function __construct() {
		
		if( wplab_recover_utils::is_woocommerce() ) {
		
			// Remove WooCommerce default styles
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );
			
			// Remove WooCommerce lightbox
			add_action( 'wp_print_scripts', array( $this, 'deregister_js' ), 20 );
			
			// Ordering boxes
			add_action( 'init', array( $this, 'setup_woocommerce' ), 1 );
			
			// override breadcrumbs
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
			add_filter( 'woocommerce_show_page_title', '__return_false' );
			
			// remove PrettyPhoto, add nivoLightbox
			add_filter( 'woocommerce_single_product_image_html', array( $this, 'woocommerce_single_product_image_html'), 99, 1 ); // single image
			add_filter( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'woocommerce_single_product_image_html'), 99, 1); // thumbnails
			
			// Override search form
			add_filter( 'get_product_search_form', array( $this, 'custom_woo_search' ) );
			
			// custom posts per page
			add_filter( 'loop_shop_per_page', array( $this, 'custom_products_per_page' ) );
			
			// add share buttons
			add_action( 'woocommerce_product_meta_end', array( $this, 'add_share_buttons' ));
			
			// custom number of columns
			if( wplab_recover_utils::is_unyson() ) {
				add_filter( 'loop_shop_columns', array( $this, 'custom_loop_columns') );
			}
			
			// Update cart totals via AJAX
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'update_header_cart_totals' ) );
			
		}
		
	}
	
	/**
	 * Change prettyPhoto to a nivoLightbox
	 **/
	function woocommerce_single_product_image_html( $html ) {
		$html = str_replace('data-rel="prettyPhoto[product-gallery]', 'data-lightbox-gallery="product-gallery', $html);
		return $html;
	}
	
	/**
	 * Deregister prettyPhoto
	 **/
	function deregister_js() {
		wp_deregister_script( 'prettyPhoto' );
		wp_deregister_script( 'prettyPhoto-init' );
	}
	
	/**
	 * Disable ordering boxes
	 **/
	function setup_woocommerce() {

		if( wplab_recover_utils::is_unyson() && ! filter_var( fw_get_db_settings_option( 'woo_ordering_boxes' ), FILTER_VALIDATE_BOOLEAN ) ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
			remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		}
		
	}
	
	/**
	 * Override WooSearch Form
	 **/
	function custom_woo_search() {
		ob_start();
		?>
		<form class="search-form" action="<?php echo get_site_url(); ?>" method="get">
			<input type="hidden" name="post_type" value="product" />
			<input type="search" name="s" value="" placeholder="<?php esc_html_e( 'Type and hit enter...', 'wplab-recover' ); ?>" />
		</form>
		<?php
		return ob_get_clean();
	}
	
	/**
	 * Custom posts per page
	 **/
	function custom_products_per_page() {
		return wplab_recover_utils::is_unyson() ? absint( fw_get_db_settings_option( 'woo_posts_count' ) ) : 9;
	}
	
	/**
	 * Add share buttons to a single product page
	 **/
	function add_share_buttons() {
		if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'woo_share_links' ), FILTER_VALIDATE_BOOLEAN ) ) {
			wplab_recover_front::share_links();
		}
	}
	
	/**
	 * Change number of columns for products
	 **/
	function custom_loop_columns() {
		return fw_get_db_settings_option( 'woo_products_per_row' );
	}
	
	/**
	 * Update header cart totals
	 **/
	function update_header_cart_totals( $fragments ) {
		
		$fragments['a#header-cart-widget-toggle span'] = '<span>' . WC()->cart->get_cart_contents_count() . '</span>';
		
		return $fragments;
	}
	
}