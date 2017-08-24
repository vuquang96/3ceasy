<?php 

if (!function_exists('_action_wplab_recover_shortcode_image_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_image_enqueue_dynamic_css( $data ) {
    $shortcode = 'media-image';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );

		$shortcode_id = 'shortcode-' . $atts['id'];
		
		$inline_css = ' #' . $shortcode_id . ' {';
		
		/**
		 * Auto CSS styles
		 **/
		
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
		
		if( isset( $atts['paddings'] ) && is_array( $atts['paddings'] ) && count( array_filter( $atts['paddings'] ) ) > 0 ) {
			$inline_css .= wplab_recover_utils::get_styles( array(
				'top_padding' 		=> $atts['paddings']['top'],
				'right_padding' 	=> $atts['paddings']['right'],
				'bottom_padding' 	=> $atts['paddings']['bottom'],
				'left_padding' 		=> $atts['paddings']['left'],
			), '' );
		}
		
		if( isset( $atts['border_width'] ) && is_array( $atts['border_width'] ) && count( array_filter( $atts['border_width'] ) ) > 0 ) {
			$inline_css .= wplab_recover_utils::get_styles( array(
				'top_border' 			=> $atts['border_width']['top'],
				'right_border' 		=> $atts['border_width']['right'],
				'bottom_border' 	=> $atts['border_width']['bottom'],
				'left_border' 		=> $atts['border_width']['left'],
			), '' );
		}
		
		if( isset( $atts['border_color'] ) && $atts['border_color'] <> '' ) {
			$inline_css .= 'border-color: ' . $atts['border_color'] . ';';
		}
		
		if( isset( $atts['border_style'] ) && $atts['border_style'] <> '' ) {
			$inline_css .= 'border-style: ' . $atts['border_style'] . ';';
		}
		
		if( isset( $atts['border_radius'] ) && !empty( $atts['border_radius'] ) ) {
			$inline_css .= wplab_recover_utils::get_styles( array(
				'top_border_radius' 		=> $atts['border_radius']['top'],
				'right_border_radius' 	=> $atts['border_radius']['right'],
				'bottom_border_radius' 	=> $atts['border_radius']['bottom'],
				'left_border_radius' 		=> $atts['border_radius']['left'],
			), '' );
		}
		
		if( isset( $atts['css_shadow']['enabled'] ) && filter_var( $atts['css_shadow']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
			$shadow_type = isset( $atts['css_shadow']['true']['shadow_type'] ) && $atts['css_shadow']['true']['shadow_type'] == 'inside' ? 'inset' : '';
			$inline_css .= 'box-shadow: ' . $shadow_type . ' ' . $atts['css_shadow']['true']['shadow_horizontal_length'] . 'px ' . $atts['css_shadow']['true']['shadow_vertical_length'] . 'px ' . $atts['css_shadow']['true']['shadow_blur_radius'] . 'px ' . $atts['css_shadow']['true']['shadow_spread_radius'] . 'px ' . $atts['css_shadow']['true']['shadow_color'] . ';';
		}
		
		$inline_css .= '}';
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:media_image',
	  '_action_wplab_recover_shortcode_image_enqueue_dynamic_css'
	);

endif;