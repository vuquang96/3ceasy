<?php 

wp_enqueue_style('fw-ext-builder-frontend-grid');

if (!function_exists('_action_wplab_recover_shortcode_list_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_list_enqueue_dynamic_css( $data ) {
    $shortcode = 'list';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
				
		$inline_css = ' #' . $shortcode_id . ' {';
		
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
		
		$inline_css .= '}';
		
		/**
		 * Custom colors
		 **/
		if( isset( $atts['text_color'] ) && $atts['text_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .li-content, #' . $shortcode_id . ' dt {';
			$inline_css .= 'color: ' . $atts['text_color'] . ';';
			$inline_css .= '}';
		}
		
		if( isset( $atts['dl_text_color'] ) && $atts['dl_text_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' dd {';
			$inline_css .= 'color: ' . $atts['dl_text_color'] . ';';
			$inline_css .= '}';
		}
		
		if( isset( $atts['icon_color'] ) && $atts['icon_color'] <> '' ) {
			$inline_css .= ' ul#' . $shortcode_id . '.simple, ol#' . $shortcode_id . '.simple, ul#' . $shortcode_id . '.iconic i.icon {';
			$inline_css .= 'color: ' . $atts['icon_color'] . ';';
			$inline_css .= '}';
			
			$inline_css .= ' ul#' . $shortcode_id . '.iconic svg path {';
			$inline_css .= 'fill: ' . $atts['icon_color'] . ';';
			$inline_css .= '}';
			
		}
		
		if( isset( $atts['dl_background_color'] ) && $atts['dl_background_color'] <> '' ) {
			$inline_css .= ' dl#' . $shortcode_id . '.style-boxed {';
			$inline_css .= 'background-color: ' . $atts['dl_background_color'] . ';';
			$inline_css .= '}';
		}
		
		if( isset( $atts['dl_separator_color'] ) && $atts['dl_separator_color'] <> '' ) {
			$inline_css .= ' dl#' . $shortcode_id . '.style-boxed dd {';
			$inline_css .= 'border-color: ' . $atts['dl_separator_color'] . ';';
			$inline_css .= '}';
		}
		
		wp_add_inline_style( 'theme-footer', $inline_css );
		wp_enqueue_style( 'fw-font-awesome' );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:list',
	  '_action_wplab_recover_shortcode_list_enqueue_dynamic_css'
	);

endif;