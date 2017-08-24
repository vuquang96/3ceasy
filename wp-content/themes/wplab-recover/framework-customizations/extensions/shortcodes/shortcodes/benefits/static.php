<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;
wp_enqueue_style( 'benefits', $wplab_recover_core->skin_style_dir . '/benefits.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
wp_enqueue_script( 'match-height' );