<?php 

if (!function_exists('_action_wplab_recover_shortcode_button_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_button_enqueue_dynamic_css( $data ) {
		
    $shortcode = 'button';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		
		/**
		 * Custom ID
		 **/
		if( isset( $atts['button_id'] ) && $atts['button_id'] <> '' ) {
			$shortcode_id = $atts['button_id'];
		}
		
		$inline_css = ' #' . $shortcode_id . ' {';
		
			/** text color **/
			if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
				$inline_css .= 'color: ' . $atts['text_color'] . ';';
			}
		
			/** font weight **/
			if( isset( $atts['font_weight'] ) && $atts['font_weight'] <> '' ) {
				$inline_css .= 'font-weight: ' . $atts['font_weight'] . ';';
			}
			
			/** font variant **/
			if( isset( $atts['font_variant'] ) && $atts['font_variant'] <> '' ) {
				$inline_css .= 'font-variant: ' . $atts['font_variant'] . ';';
			}
			
			/** font style **/
			if( isset( $atts['font_style'] ) && $atts['font_style'] <> '' ) {
				$inline_css .= 'font-style: ' . $atts['font_style'] . ';';
			}
			
			/** text transform **/
			if( isset( $atts['text_transform'] ) && $atts['text_transform'] <> '' ) {
				$inline_css .= 'text-transform: ' . $atts['text_transform'] . ';';
			}
			
			/** text transform **/
			if( isset( $atts['text_transform'] ) && $atts['text_transform'] <> '' ) {
				$inline_css .= 'text-transform: ' . $atts['text_transform'] . ';';
			}
			
			/** margins **/
			if( isset( $atts['margins'] ) && is_array( $atts['margins'] ) && count( array_filter( $atts['margins'] ) ) > 0 ) {
				$inline_css .= wplab_recover_utils::get_styles( array(
					'top_margin' 			=> $atts['margins']['top'],
					'right_margin' 		=> $atts['margins']['right'],
					'bottom_margin' 	=> $atts['margins']['bottom'],
					'left_margin' 		=> $atts['margins']['left'],
				), '' );
			}
			
			/** paddings **/
			if( isset( $atts['paddings'] ) && is_array( $atts['paddings'] ) && count( array_filter( $atts['paddings'] ) ) > 0 ) {
				$inline_css .= wplab_recover_utils::get_styles( array(
					'top_padding' 		=> $atts['paddings']['top'],
					'right_padding' 	=> $atts['paddings']['right'],
					'bottom_padding' 	=> $atts['paddings']['bottom'],
					'left_padding' 		=> $atts['paddings']['left'],
				), '' );
			}
			
			/** button borders and border radius **/
			if( strpos( $atts['style'], 'simple' ) !== false || strpos( $atts['style'], 'stroke' ) !== false ) {
				
				if( isset( $atts['radius'] ) && is_array( $atts['radius'] ) && count( array_filter( $atts['radius'] ) ) > 0 ) {
				
					$inline_css .= wplab_recover_utils::get_styles( array(
						'top_border_radius' 		=> $atts['radius']['top'],
						'right_border_radius' 	=> $atts['radius']['right'],
						'bottom_border_radius' 	=> $atts['radius']['bottom'],
						'left_border_radius' 		=> $atts['radius']['left'],
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
				
				if( isset( $atts['border_style'] ) && $atts['border_style'] != 'none' ) {
					$inline_css .= 'border-style: ' . $atts['border_style'] . ';';
				}
				
				if( isset( $atts['border_color'] ) && $atts['border_color'] <> '' ) {
					$inline_css .= 'border-color: ' . $atts['border_color'] . ';';
				}
				
			}
			
			/** background color **/
			if( isset( $atts['style'] ) && $atts['style'] != 'link' ) {
				
				if( isset( $atts['background_color'] ) && $atts['background_color'] <> '' ) {
					$inline_css .= 'background-color: ' . $atts['background_color'] . ';';
				}
				
			}
			
			/** shadow **/
			if( isset( $atts['css_shadow']['enabled'] ) && filter_var( $atts['css_shadow']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
				$shadow_type = isset( $atts['css_shadow']['true']['shadow_type'] ) && $atts['css_shadow']['true']['shadow_type'] == 'inside' ? 'inset' : '';
				$inline_css .= 'box-shadow: ' . $shadow_type . ' ' . $atts['css_shadow']['true']['shadow_horizontal_length'] . 'px ' . $atts['css_shadow']['true']['shadow_vertical_length'] . 'px ' . $atts['css_shadow']['true']['shadow_blur_radius'] . 'px ' . $atts['css_shadow']['true']['shadow_spread_radius'] . 'px ' . $atts['css_shadow']['true']['shadow_color'] . ';';
			}
		
		$inline_css .= '}';
		
		/** hover text color **/
		if( isset( $atts['hover_text_color'] ) && $atts['hover_text_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ':hover { color: ' . $atts['hover_text_color'] . '; }';
		}
		
		/** link type styles **/
		if( isset( $atts['style'] ) && strpos( $atts['style'], 'link' ) !== false ) {
			
			/** border color **/
			if( isset( $atts['border_color'] ) && $atts['border_color'] <> '' ) {
				$inline_css .= ' #' . $shortcode_id . ':after { background: ' . $atts['border_color'] . '; }';
			}
			
			if( isset( $atts['hover_border_color'] ) && $atts['hover_border_color'] <> '' ) {
				$inline_css .= ' #' . $shortcode_id . ':hover:after { background: ' . $atts['hover_border_color'] . '; }';
			}
			
		} else {
			
			/** background color **/
			
			if( strpos( $atts['style'], 'poly' ) !== false && isset( $atts['background_color'] ) && $atts['background_color'] <> '' ) {
				$inline_css .= ' #' . $shortcode_id . '.poly:after { border-color: transparent transparent transparent ' . $atts['background_color'] . '; }';
				$inline_css .= ' #' . $shortcode_id . '.poly.left:after { border-color: transparent ' . $atts['background_color'] . ' transparent transparent; }';
			}
			
			if( isset( $atts['hover_background_color'] ) && $atts['hover_background_color'] <> '' ) {
				$inline_css .= ' #' . $shortcode_id . ':hover { background-color: ' . $atts['hover_background_color'] . '; }';
				$inline_css .= ' #' . $shortcode_id . '.poly:hover:after { border-color: transparent transparent transparent ' . $atts['hover_background_color'] . '; }';
				$inline_css .= ' #' . $shortcode_id . '.poly.left:hover:after { border-color: transparent ' . $atts['hover_background_color'] . ' transparent transparent; }';
			}
			
		}
		
		if( strpos( $atts['style'], 'simple' ) !== false || strpos( $atts['style'], 'stroke' ) !== false ) {
			if( isset( $atts['hover_border_color'] ) && $atts['hover_border_color'] <> '' ) {
				$inline_css .= ' #' . $shortcode_id . ':hover { border-color: ' . $atts['hover_border_color'] . '; }';
			}
		}
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:button',
	  '_action_wplab_recover_shortcode_button_enqueue_dynamic_css'
	);

endif;