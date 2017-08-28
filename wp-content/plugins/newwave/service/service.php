<?php
require_once "capcha-api/capcha-api.php";
require_once "customer/customer.php";
class service {
	public function __construct(){
 		add_action('init', array($this, 'service_init'));
 		add_action( 'save_post', array($this, 'wpdocs_save_meta_box'), 10, 3 );
 		add_action( 'add_meta_boxes', array($this, 'wpdocs_register_meta_boxes') );
 		new customer();
 		new CapchaApi();
 	}

 	public function service_init(){
		$labels = array(
			'name'               => _x( 'Service', NEWWAVE_DOMAIN ),
			'singular_name'      => _x( 'Service', NEWWAVE_DOMAIN ),
			'menu_name'          => _x( 'Service', NEWWAVE_DOMAIN ),
			'name_admin_bar'     => _x( 'Book', NEWWAVE_DOMAIN ),
			'add_new'            => _x( 'Add New', NEWWAVE_DOMAIN ),
			'add_new_item'       => __( 'Add New Service', NEWWAVE_DOMAIN ),
			'new_item'           => __( 'New Service', NEWWAVE_DOMAIN ),
			'edit_item'          => __( 'Edit Service', NEWWAVE_DOMAIN ),
			'view_item'          => __( 'View Service', NEWWAVE_DOMAIN ),
			'all_items'          => __( 'All Services', NEWWAVE_DOMAIN ),
			'search_items'       => __( 'Search Service', NEWWAVE_DOMAIN ),
			'parent_item_colon'  => __( 'Parent Service:', NEWWAVE_DOMAIN ),
			'not_found'          => __( 'No Service found.', NEWWAVE_DOMAIN ),
			'not_found_in_trash' => __( 'No Service found in Trash.', NEWWAVE_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Newwave Service .', NEWWAVE_DOMAIN ),
	        'menu_icon'			 => 'dashicons-list-view',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'service' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			//'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			'supports'           => array( 'title', 'editor', 'thumbnail', 'postcustom' )
		);
		register_post_type( 'service', $args );

		$category = array(
	        'name' => _x( 'Service Categories', 'taxonomy general name', NEWWAVE_DOMAIN ),
	        'singular_name' => _x( 'Category', 'taxonomy singular name', NEWWAVE_DOMAIN ),
	        'search_items' =>  __( 'Search Types', NEWWAVE_DOMAIN ),
	        'all_items' => __( 'All Categories', NEWWAVE_DOMAIN ),
	        'parent_item' => __( 'Parent Category', NEWWAVE_DOMAIN ),
	        'parent_item_colon' => __( 'Parent Category:', NEWWAVE_DOMAIN ),
	        'edit_item' => __( 'Edit Categories', NEWWAVE_DOMAIN ),
	        'update_item' => __( 'Update Category', NEWWAVE_DOMAIN ),
	        'add_new_item' => __( 'Add New Category', NEWWAVE_DOMAIN ),
	        'new_item_name' => __( 'New Category Name', NEWWAVE_DOMAIN ),
	    );

	    register_taxonomy('service_category', array('service'), array(
	        'hierarchical' => true,
	        'labels' => $category,
	        'show_ui' => true,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'service-category' ),
	    ));
	}

	public function wpdocs_register_meta_boxes() {
	    add_meta_box( 'meta-box-price', __( 'Price', NEWWAVE_DOMAIN ), array($this, 'callback_price'), 'service' );
	}

	public function wpdocs_save_meta_box( $post_id, $post, $update  ) {
		if(isset($_POST['service-price'])){
			update_post_meta($post_id, 'service-price', $_POST['service-price']);
		}
	}

	public function callback_price( $post ) {
		$metaPrice= get_post_meta($post->ID, 'service-price', true);
	    echo  "<input id='nws-price' name='service-price' type='number' step='0.001' value='$metaPrice' style='width:100%;' />";
	}
}