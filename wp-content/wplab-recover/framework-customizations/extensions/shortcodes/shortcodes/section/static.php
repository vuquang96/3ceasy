<?php 

wp_enqueue_style('fw-ext-builder-frontend-grid');

if (!function_exists('_action_wplab_recover_shortcode_section_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_section_enqueue_dynamic_css( $data ) {
    $shortcode = 'section';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );

		if( isset( $atts['section_effects']['effect'] ) && $atts['section_effects']['effect'] == 'video' ) {
			wp_enqueue_script( 'youtube-background' );
		}
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		
		/**
		 * Custom ID
		 **/
		if( isset( $atts['section_id'] ) && $atts['section_id'] <> '' ) {
			$shortcode_id = $atts['section_id'];
		}
		
		$inline_css = ' #' . $shortcode_id . ' {';
		
		/**
		 * Auto CSS styles
		 **/
		if( !isset( $atts['section_effects']['effect'] ) || $atts['section_effects']['effect'] != 'parallax' ) {
		
			if( isset( $atts['bg_css_type']['type'] ) && $atts['bg_css_type']['type'] == 'color' ) {
				if( isset( $atts['bg_css_type']['color']['background_color'] ) && $atts['bg_css_type']['color']['background_color'] <> '' ) {
					$inline_css .= 'background-color: ' . $atts['bg_css_type']['color']['background_color'] . '; ';
				}	
			} elseif( $atts['bg_css_type']['type'] == 'gradient' ) {
		
				if( isset( $atts['bg_css_type']['gradient']['background_gradient'] ) && !empty( $atts['bg_css_type']['gradient']['background_gradient'] ) ) {
					$gradient_start_color = esc_html( $atts['bg_css_type']['gradient']['background_gradient']['primary'] );
					$gradient_end_color = esc_html( $atts['bg_css_type']['gradient']['background_gradient']['secondary'] );
					$gradient_direction = esc_html( $atts['bg_css_type']['gradient']['background_gradient_direction'] );
					
					if( $gradient_direction == 'top_bottom' ) {
						
						$inline_css .= 'background: ' . $gradient_start_color . '; background: -moz-linear-gradient(top, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -webkit-gradient(left top, left bottom, color-stop(0%, ' . $gradient_start_color . '), color-stop(100%, ' . $gradient_end_color . ')); background: -webkit-linear-gradient(top, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -o-linear-gradient(top, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -ms-linear-gradient(top, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: linear-gradient(to bottom, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $gradient_start_color . '\', endColorstr=\'' . $gradient_end_color . '\', GradientType=0 ); ';
						
					} else if( $gradient_direction == 'left_right' ) {
					
						$inline_css .= 'background: ' . $gradient_start_color . '; background: -moz-linear-gradient(left, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -webkit-gradient(left top, right top, color-stop(0%, ' . $gradient_start_color . '), color-stop(100%, ' . $gradient_end_color . ')); background: -webkit-linear-gradient(left, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -o-linear-gradient(left, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -ms-linear-gradient(left, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: linear-gradient(to right, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $gradient_start_color . '\', endColorstr=\'' . $gradient_end_color . '\', GradientType=1 ); ';
						
					} else if( $gradient_direction == 'top_left_bottom_right' ) {
					
						$inline_css .= 'background: ' . $gradient_start_color . '; background: -moz-linear-gradient(-45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -webkit-gradient(left top, right bottom, color-stop(0%, ' . $gradient_start_color . '), color-stop(100%, ' . $gradient_end_color . ')); background: -webkit-linear-gradient(-45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -o-linear-gradient(-45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -ms-linear-gradient(-45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: linear-gradient(135deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $gradient_start_color . '\', endColorstr=\'' . $gradient_end_color . '\', GradientType=1 ); ';
					
					} else if( $gradient_direction == 'bottom_left_top_right' ) {
					
						$inline_css .= 'background: ' . $gradient_start_color . '; background: -moz-linear-gradient(45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -webkit-gradient(left bottom, right top, color-stop(0%, ' . $gradient_start_color . '), color-stop(100%, ' . $gradient_end_color . ')); background: -webkit-linear-gradient(45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -o-linear-gradient(45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -ms-linear-gradient(45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: linear-gradient(45deg, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $gradient_start_color . '\', endColorstr=\'' . $gradient_end_color . '\', GradientType=1 ); ';
						
					} else if( $gradient_direction == 'radial' ) {
					
						$inline_css .= 'background: ' . $gradient_start_color . '; background: -moz-radial-gradient(center, ellipse cover, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, ' . $gradient_start_color . '), color-stop(100%, ' . $gradient_end_color . ')); background: -webkit-radial-gradient(center, ellipse cover, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -o-radial-gradient(center, ellipse cover, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: -ms-radial-gradient(center, ellipse cover, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); background: radial-gradient(ellipse at center, ' . $gradient_start_color . ' 0%, ' . $gradient_end_color . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $gradient_start_color . '\', endColorstr=\'' . $gradient_end_color . '\', GradientType=1 ); ';
						
					}
					
				}
		
				
			}
			
			if( ! filter_var( $atts['background_lazy'], FILTER_VALIDATE_BOOLEAN ) && !empty( $atts['background_image']['data']['css'] ) && $atts['background_image']['data']['css']['background-image'] <> '' ) {
				$inline_css .= 'background-image: ' . $atts['background_image']['data']['css']['background-image'] . '; ';
			}
			
			if( isset( $atts['background_repeat'] ) && $atts['background_repeat'] <> '' ) {
				$inline_css .= 'background-repeat: ' . $atts['background_repeat'] . '; ';
			}
			
			if( isset( $atts['background_position'] ) && $atts['background_position'] <> '' ) {
				$inline_css .= 'background-position: ' . $atts['background_position'] . '; ';
			}
			
			if( isset( $atts['background_cover'] ) && filter_var( $atts['background_cover'], FILTER_VALIDATE_BOOLEAN ) ) {
				$inline_css .= 'background-size: cover; ';
			}
			
			if( isset( $atts['background_fixed'] ) && filter_var( $atts['background_fixed'], FILTER_VALIDATE_BOOLEAN ) ) {
				$inline_css .= 'background-attachment: fixed; ';
			}
			
			if( isset( $atts['display_triangle'] ) && !empty( $atts['display_triangle'] ) && filter_var( $atts['display_triangle']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
				$inline_css .= 'position: relative; ';
			}
		
		} 
		
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
		
		if( isset( $atts['border_radius'] ) && is_array( $atts['border_radius'] ) && count( array_filter( $atts['border_radius'] ) ) > 0 ) {
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
		
		if( isset( $atts['display_triangle'] ) && !empty( $atts['display_triangle'] ) && filter_var( $atts['display_triangle']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
			
			$inline_css .= ' #' . $shortcode_id . ':after {';
			$inline_css .= 'position: absolute; content: ""; left: 50%; margin-left: -34px; width: 0; height: 0; border-style: solid; ';
			
			if( $atts['display_triangle']['true']['triangle_position'] == 'from_top_to_top' ) {
				$inline_css .= 'top: -35px; border-width: 0 34px 35px 34px; border-color: transparent transparent ' . $atts['display_triangle']['true']['triangle_color'] . ' transparent; ';
			} elseif( $atts['display_triangle']['true']['triangle_position'] == 'from_top_to_bottom' ) {
				$inline_css .= 'top: 0; border-width: 35px 34px 0 34px; border-color: ' . $atts['display_triangle']['true']['triangle_color'] . ' transparent transparent transparent; ';
			} elseif( $atts['display_triangle']['true']['triangle_position'] == 'from_bottom_to_bottom' ) {
				$inline_css .= 'bottom: -35px; border-width: 35px 34px 0 34px; border-color: ' . $atts['display_triangle']['true']['triangle_color'] . ' transparent transparent transparent; ';
			} elseif( $atts['display_triangle']['true']['triangle_position'] == 'from_bottom_to_top' ) {
				$inline_css .= 'bottom: 0; border-width: 0 34px 35px 34px; border-color: transparent transparent ' . $atts['display_triangle']['true']['triangle_color'] . ' transparent; ';
			}
			
			$inline_css .= '}';
			
		}
		
		$inline_css .= '@media screen and (max-width: 992px) { #' . $shortcode_id . ' { ';
		
			if( isset( $atts['margins_mobile'] ) && is_array( $atts['margins_mobile'] ) && count( array_filter( $atts['margins_mobile'] ) ) > 0 ) {
				$inline_css .= wplab_recover_utils::get_styles( array(
					'top_margin' 			=> $atts['margins_mobile']['top'],
					'right_margin' 		=> $atts['margins_mobile']['right'],
					'bottom_margin' 	=> $atts['margins_mobile']['bottom'],
					'left_margin' 		=> $atts['margins_mobile']['left'],
				), '' );
			}
			
			if( isset( $atts['paddings_mobile'] ) && is_array( $atts['paddings_mobile'] ) && count( array_filter( $atts['paddings_mobile'] ) ) > 0 ) {
				$inline_css .= wplab_recover_utils::get_styles( array(
					'top_padding' 		=> $atts['paddings_mobile']['top'],
					'right_padding' 	=> $atts['paddings_mobile']['right'],
					'bottom_padding' 	=> $atts['paddings_mobile']['bottom'],
					'left_padding' 		=> $atts['paddings_mobile']['left'],
				), '' );
			}
		
		$inline_css .= '} }';
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:section',
	  '_action_wplab_recover_shortcode_section_enqueue_dynamic_css'
	);

endif;