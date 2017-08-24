<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;
wp_enqueue_style( 'numeric-block', $wplab_recover_core->skin_style_dir . '/numeric_block.css', false, _WPLAB_RECOVER_CACHE_TIME_ );