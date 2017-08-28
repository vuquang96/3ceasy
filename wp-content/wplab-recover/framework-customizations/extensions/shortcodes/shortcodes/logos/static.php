<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'logos-shortcode', $wplab_recover_core->skin_style_dir . '/logos.css', false, _WPLAB_RECOVER_CACHE_TIME_ );