<?php 

if (!function_exists('_action_wplab_recover_shortcode_posts_carousel_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_posts_carousel_enqueue_dynamic_css( $data ) {
		global $wplab_recover_core;
		
    $shortcode = 'posts_carousel';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		wp_enqueue_style( 'shortcode-posts-carousel', $wplab_recover_core->skin_style_dir . '/posts_carousel.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		
		if( isset( $atts['carousel_type'] ) && $atts['carousel_type']['style'] == 'infinite' ) {
			wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/libs/swiper.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
			wp_enqueue_script( 'swiper' );
		}

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:posts_carousel',
	  '_action_wplab_recover_shortcode_posts_carousel_enqueue_dynamic_css'
	);

endif;