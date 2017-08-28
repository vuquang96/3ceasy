<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'progress-bars', $wplab_recover_core->skin_style_dir . '/progress_bars.css', false, _WPLAB_RECOVER_CACHE_TIME_ );