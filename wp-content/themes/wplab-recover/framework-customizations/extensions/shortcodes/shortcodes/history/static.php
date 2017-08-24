<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'history_timeline', $wplab_recover_core->skin_style_dir . '/history_timeline.css', false, _WPLAB_RECOVER_CACHE_TIME_ );