<?php if (!defined('FW')) die('Forbidden');

if ( ! function_exists( '_action_wplab_recover_shortcode_testimonials_slider_enqueue_dynamic_css') ):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_testimonials_slider_enqueue_dynamic_css( $data ) {
		global $wplab_recover_core;
    $shortcode = 'testimonials_slider';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
		
		wp_enqueue_style( 'theme-testimonials-slider', $wplab_recover_core->skin_style_dir . '/testimonials-slider.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		
		$inline_css = '';
		
		/**
		 * Quote text color
		 **/
		if( $atts['text_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .quote-content, #' . $shortcode_id . ' .fs-carousel-control:before { color: ' . $atts['text_color'] . '; }';
		}
		
		/**
		 * Author text color
		 **/
		if( $atts['author_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .author { color: ' . $atts['author_color'] . '; }';
		}
		
		/**
		 * Position text color
		 **/
		if( $atts['position_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .position { color: ' . $atts['position_color'] . '; }';
		}
		
		/**
		 * Accent
		 **/
		if( $atts['accent_color'] <> '' ) {
			$inline_css .= ' #' . $shortcode_id . ' .fs-carousel-control:hover:before { color: ' . $atts['accent_color'] . '; }';
			$inline_css .= ' #' . $shortcode_id . ' .photo img { border-color: ' . $atts['accent_color'] . '; }';
		}
		
		/**
		 * Icon color
		 **/
		//if( $atts['icon_color'] <> '' ) {
			//$inline_css .= ' #' . $shortcode_id . ' blockquote:before { color: ' . $atts['icon_color'] . '; }';
			//$inline_css .= ' #' . $shortcode_id . ' blockquote.style-small_photo_alt svg path { fill: ' . $atts['icon_color'] . '; }';
		//}
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:testimonials_slider',
	  '_action_wplab_recover_shortcode_testimonials_slider_enqueue_dynamic_css'
	);

endif;