<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'iconic-list', $wplab_recover_core->skin_style_dir . '/iconic_list.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
wp_enqueue_style( 'fw-font-awesome' );