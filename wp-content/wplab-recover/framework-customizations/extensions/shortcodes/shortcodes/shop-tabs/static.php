<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'tabs-toggles', $wplab_recover_core->skin_style_dir . '/tabs_toggles.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
wp_enqueue_style( 'shop-tabs-shortcode', $wplab_recover_core->skin_style_dir . '/shop_tabs.css', false, _WPLAB_RECOVER_CACHE_TIME_ );