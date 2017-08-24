<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_dequeue_style( 'fw-shortcode-tabs' );
wp_dequeue_script( 'fw-shortcode-tabs' ); 

wp_enqueue_style( 'tabs-toggles', $wplab_recover_core->skin_style_dir . '/tabs_toggles.css', false, _WPLAB_RECOVER_CACHE_TIME_ );