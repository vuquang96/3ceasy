<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'portfolio-projects', $wplab_recover_core->skin_style_dir . '/portfolio_shortcode.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
