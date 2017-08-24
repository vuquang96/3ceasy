<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
	/**
	 * Display page preloader
	 * this function located at /wproto/helper/front.php
	 **/
	wplab_recover_front::preloader();
	?>
	
	<div id="wrap" <?php if( wplab_recover_utils::is_unyson() && fw_get_db_settings_option( 'page_preloader/style' ) != 'hidden' ): ?>style="opacity: 0"<?php endif; ?>>
	
		<?php
			$menu_scrolling = false;
			$menu_scrolling_effect = 'simple';
			$do_not_scroll_on_mobiles = true;
			
			if( wplab_recover_utils::is_unyson() ) {
				$menu_scrolling = filter_var( fw_get_db_settings_option( 'menu_scrolling/enabled' ), FILTER_VALIDATE_BOOLEAN );
				$menu_scrolling_effect = fw_get_db_settings_option( 'menu_scrolling/true/menu_scrolling_style' );
				$do_not_scroll_on_mobiles = filter_var( fw_get_db_settings_option( 'menu_scrolling/true/do_not_scroll_no_mobiles' ), FILTER_VALIDATE_BOOLEAN );
			}
			
		?>
	
		<div id="menu-container" class="<?php if( $menu_scrolling ): ?>scrolling-effect-<?php echo esc_attr( $menu_scrolling_effect ); endif; if( $do_not_scroll_on_mobiles ): ?> do-not-scroll-on-mobiles<?php endif; ?>">
			<?php
				get_template_part( 'top-bar' );
				get_template_part( 'menu');
			?>
		</div>