<?php 

if (!function_exists('_action_wplab_recover_shortcode_welcome_enqueue_dynamic_css')):

	/**
	 * @internal
	 * @param array $data
	 */
	function _action_wplab_recover_shortcode_welcome_enqueue_dynamic_css( $data ) {
		global $wplab_recover_core;
		
    $shortcode = 'welcome';
    $atts = shortcode_parse_atts( $data['atts_string'] );
    $atts = fw_ext_shortcodes_decode_attr( $atts, $shortcode, $data['post']->ID );
    
    wp_enqueue_style( 'shortcode-welcome', $wplab_recover_core->skin_style_dir . '/welcome.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
		
		$shortcode_id = 'shortcode-' . $atts['id'];
		$inline_css = '';
		
		if( isset( $atts['block1_bg'] ) && $atts['block1_bg'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-1 { background-color: ' . $atts['block1_bg'] . '; }';
		}
		if( isset( $atts['block1_color'] ) && $atts['block1_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-1 h4, #' . $shortcode_id . ' .col-1 .desc { color: ' . $atts['block1_color'] . '; }';
			$inline_css .= '#' . $shortcode_id . ' .col-1 svg path { fill: ' . $atts['block1_color'] . '; }';
		}
		
		if( isset( $atts['block2_bg'] ) && $atts['block2_bg'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-2 { background-color: ' . $atts['block2_bg'] . '; }';
		}
		if( isset( $atts['block2_color'] ) && $atts['block2_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-2 h4, #' . $shortcode_id . ' .col-2 .desc { color: ' . $atts['block2_color'] . '; }';
			$inline_css .= '#' . $shortcode_id . ' .col-2 svg path { fill: ' . $atts['block2_color'] . '; }';
		}
		
		if( isset( $atts['block3_bg'] ) && $atts['block3_bg'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-3 { background-color: ' . $atts['block3_bg'] . '; }';
		}
		if( isset( $atts['block3_color'] ) && $atts['block3_color'] <> '' ) {
			$inline_css .= '#' . $shortcode_id . ' .col-3 h4, #' . $shortcode_id . ' .col-3 .desc { color: ' . $atts['block3_color'] . '; }';
			$inline_css .= '#' . $shortcode_id . ' .col-3 svg path { fill: ' . $atts['block3_color'] . '; }';
		}
		
		wp_add_inline_style( 'theme-footer', $inline_css );

	}
	add_action(
	  'fw_ext_shortcodes_enqueue_static:welcome',
	  '_action_wplab_recover_shortcode_welcome_enqueue_dynamic_css'
	);

endif;