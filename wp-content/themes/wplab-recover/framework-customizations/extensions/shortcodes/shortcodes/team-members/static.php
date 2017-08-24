<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'team-members', $wplab_recover_core->skin_style_dir . '/team.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
