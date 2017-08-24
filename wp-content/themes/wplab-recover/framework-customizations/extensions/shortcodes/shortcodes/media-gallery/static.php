<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'grid-gallery', $wplab_recover_core->skin_style_dir . '/grid_gallery.css', false, _WPLAB_RECOVER_CACHE_TIME_ );