<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'contact-info', $wplab_recover_core->skin_style_dir . '/contact_info.css', false, _WPLAB_RECOVER_CACHE_TIME_ );