<?php 

if (!function_exists('_action_wplab_recover_shortcode_fid_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_fid_enqueue_dynamic_css( $data ) {
		global $wplab_recover_core;
		
    $shortcode = 'fid';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		wp_enqueue_style( 'theme-fid-shortcode', $wplab_recover_core->skin_style_dir . '/fid.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		
		$inline_css = ' #' . $shortcode_id . ' {';
		
			/** text color **/
			if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
				$inline_css .= 'color: ' . $atts['text_color'] . ';';
			}

		
		$inline_css .= '}';
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:fid',
	  '_action_wplab_recover_shortcode_fid_enqueue_dynamic_css'
	);

endif;