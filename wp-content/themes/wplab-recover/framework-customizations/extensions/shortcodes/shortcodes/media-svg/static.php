<?php 

if (!function_exists('_action_wplab_recover_shortcode_media_svg_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_media_svg_enqueue_dynamic_css( $data ) {
    $shortcode = 'media_svg';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );

		$shortcode_id = 'shortcode-' . $atts['id'];
		
		$inline_css = ' #' . $shortcode_id . ' svg {';
		
		$inline_css .= 'display: inline-block; width: ' . $atts['width'] . 'px; height: ' . $atts['height'] . 'px;';
		
		/**
		 * Custom margins, paddings and borders
		 **/
		
		if( isset( $atts['margins'] ) && is_array( $atts['margins'] ) && count( array_filter( $atts['margins'] ) ) > 0 ) {
			$inline_css .= wplab_recover_utils::get_styles( array(
				'top_margin' 			=> $atts['margins']['top'],
				'right_margin' 		=> $atts['margins']['right'],
				'bottom_margin' 	=> $atts['margins']['bottom'],
				'left_margin' 		=> $atts['margins']['left'],
			), '' );
		}
		
		$inline_css .= '}';
		
		if( isset( $atts['color'] ) && $atts['color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' svg path { fill: ' . $atts['color'] . '; }';
		}
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:media_svg',
	  '_action_wplab_recover_shortcode_media_svg_enqueue_dynamic_css'
	);

endif;