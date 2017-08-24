<?php if (!defined('FW')) die('Forbidden');

if ( ! function_exists( '_action_wplab_recover_shortcode_testimonials_enqueue_dynamic_css') ):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_testimonials_enqueue_dynamic_css( $data ) {
		global $wplab_recover_core;
    $shortcode = 'quote';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		wp_dequeue_style('fw-shortcode-testimonials');
		wp_dequeue_script('fw-shortcode-testimonials-caroufredsel');
		
		wp_enqueue_style( 'theme-testimonials-shortcode', $wplab_recover_core->skin_style_dir . '/testimonials.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		wp_enqueue_style( 'theme-quote-shortcode', $wplab_recover_core->skin_style_dir . '/quote.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		
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
		
		$inline_css .= '} ';
		
		$inline_css .= ' #' . $shortcode_id . ' blockquote {';		
		
		/**
		 * Custom photo
		 **/
		if( isset( $atts['style'] ) && $atts['style'] == 'big_photo' && isset( $atts['photo'] ) && !empty( $atts['photo'] ) ) {
			$inline_css .= 'background: url(' . $atts['photo']['url'] . ') left top no-repeat;';
		}
		
		$inline_css .= '}';
		
		/**
		 * Quote text color
		 **/
		if( $atts['text_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote .quote-content { color: ' . $atts['text_color'] . '; }';
		}
		
		/**
		 * Author text color
		 **/
		if( $atts['author_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote .author { color: ' . $atts['author_color'] . '; }';
		}
		
		/**
		 * Position text color
		 **/
		if( $atts['position_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote .position { color: ' . $atts['position_color'] . '; }';
		}
		
		/**
		 * Icon color
		 **/
		if( $atts['icon_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote:before { color: ' . $atts['icon_color'] . '; }';
			$inline_css .= ' #' . $shortcode_id . ' blockquote.style-small_photo_alt svg path { fill: ' . $atts['icon_color'] . '; }';
		}
		
		/**
		 * BG color for boxed quote
		 **/
		if( $atts['bg_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote.style-boxed .quote-content { background-color: ' . $atts['bg_color'] . '; }';
		}
		if( $atts['bg_triangle_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' blockquote.style-boxed .quote-content:after { border-color: transparent ' . $atts['bg_triangle_color'] . ' transparent transparent; }';
		}
		
		/**
		 * Pagination color
		 **/
		if( $atts['pagination_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .fs-carousel-page { background-color: ' . $atts['pagination_color'] . '; }';
		}
		
		if( $atts['pagination_active_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .fs-carousel-page.fs-carousel-active { background-color: ' . $atts['pagination_active_color'] . '; }';
		}
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:testimonials',
	  '_action_wplab_recover_shortcode_testimonials_enqueue_dynamic_css'
	);

endif;