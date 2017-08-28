<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

wp_enqueue_style( 'portfolio-dark-carousel', $wplab_recover_core->skin_style_dir . '/portfolio_dark_carousel.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/libs/swiper.css', false, _WPLAB_RECOVER_CACHE_TIME_ );
wp_enqueue_script( 'swiper' );