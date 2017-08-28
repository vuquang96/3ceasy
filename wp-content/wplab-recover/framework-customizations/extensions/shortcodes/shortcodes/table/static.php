<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_dequeue_style( 'fw-shortcode-table' );
wp_enqueue_style( 'pricing-tables', $wplab_recover_core->skin_style_dir . '/pricing_tables.css', false, _WPLAB_RECOVER_CACHE_TIME_ );