<?php 

if (!function_exists('_action_wplab_recover_shortcode_header_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_header_enqueue_dynamic_css( $data ) {
    $shortcode = 'special_heading';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		
		$inline_css = ' #' . $shortcode_id . ' {';
		
		/**
		 * Auto CSS styles
		 **/
		if( isset( $atts['text_align'] ) && $atts['text_align'] <> '' ) {
			$inline_css .= 'text-align: ' . $atts['text_align'] . '; ';
		} 
		
		if( isset( $atts['text_transform'] ) && $atts['text_transform'] <> '' ) {
			$inline_css .= 'text-transform: ' . $atts['text_transform'] . ';';
		}
		
		if( isset( $atts['font_style'] ) && $atts['font_style'] <> '' ) {
			$inline_css .= 'font-style: ' . $atts['font_style'] . ';';
		}
		
		if( isset( $atts['font_variant'] ) && $atts['font_variant'] <> '' ) {
			$inline_css .= 'font-variant: ' . $atts['font_variant'] . ';';
		}
		
		if( isset( $atts['font_weight'] ) && $atts['font_weight'] <> '' ) {
			$inline_css .= 'font-weight: ' . $atts['font_weight'] . ';';
		}
		
		if( isset( $atts['font_size'] ) && $atts['font_size'] <> '' ) {
			$inline_css .= 'font-size: ' . $atts['font_size'] . 'px;';
		}
		
		if( isset( $atts['line_height'] ) && $atts['line_height'] <> '' ) {
			$inline_css .= 'line-height: ' . $atts['line_height'] . 'px;';
		}
		
		if( isset( $atts['header_color'] ) && $atts['header_color'] <> '' ) {
			$inline_css .= 'color: ' . $atts['header_color'] . ';';
		}
		
		/**
		 * Custom margins, paddings
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
		
		$inline_css .= '}';
		
		if( isset( $atts['header_line'] ) && filter_var( $atts['header_line'], FILTER_VALIDATE_BOOLEAN ) && $atts['header_line_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ':after { background-color: ' . $atts['header_line_color'] . '; }';
		}
		
		if( isset( $atts['header_angle'] ) && filter_var( $atts['header_angle'], FILTER_VALIDATE_BOOLEAN ) && $atts['header_angle_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' span.angle:before { border-color: ' . $atts['header_angle_color'] . '; }';
		}
		
		if( isset( $atts['header_color'] ) && $atts['header_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' span:after { background-color: ' . $atts['header_color'] . '; }';
		}
		
		$inline_css .= '@media screen and (max-width: 992px) { #' . $shortcode_id . ' { ';
		
		if( isset( $atts['font_size_mobile'] ) && $atts['font_size_mobile'] <> '' ) {
			$inline_css .= 'font-size: ' . $atts['font_size_mobile'] . 'px;';
		}
		
		if( isset( $atts['line_height_mobile'] ) && $atts['line_height_mobile'] <> '' ) {
			$inline_css .= 'line-height: ' . $atts['line_height_mobile'] . 'px;';
		}
		
		$inline_css .= '} }';
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:special_heading',
	  '_action_wplab_recover_shortcode_header_enqueue_dynamic_css'
	);

endif;