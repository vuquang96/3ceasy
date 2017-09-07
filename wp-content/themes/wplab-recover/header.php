<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	
		$allowed_tags = wp_kses_allowed_html( 'post' );
	
		/**
		 * Display page preloader
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_recover_front::preloader();
	?>
	
	<!--
		Main wrapper
	-->
	<div id="wrap" <?php if( wplab_recover_utils::is_unyson() && fw_get_db_settings_option( 'page_preloader/style' ) != 'hidden' ): ?>style="opacity: 0"<?php endif; ?>>
	
		<?php
			$menu_scrolling = false;
			$menu_scrolling_effect = 'simple';
			$do_not_scroll_on_mobiles = false;
			
			if( wplab_recover_utils::is_unyson() ) {
				$menu_scrolling = filter_var( fw_get_db_settings_option( 'menu_scrolling/enabled' ), FILTER_VALIDATE_BOOLEAN );
				$menu_scrolling_effect = fw_get_db_settings_option( 'menu_scrolling/true/menu_scrolling_style' );
				$do_not_scroll_on_mobiles = $menu_scrolling && filter_var( fw_get_db_settings_option( 'menu_scrolling/true/do_not_scroll_no_mobiles' ), FILTER_VALIDATE_BOOLEAN );
			}
			
		?>
	
		<div id="menu-container" class="<?php if( $menu_scrolling ): ?>scrolling-effect-<?php echo esc_attr( $menu_scrolling_effect ); endif; if( $do_not_scroll_on_mobiles ): ?> do-not-scroll-on-mobiles<?php endif; ?>">
			<?php
				get_template_part( 'top-bar' );
				get_template_part( 'menu' );
			?>
		</div>
	
		<!--
			Header wrapper
		-->
		<?php
			/**
			 * Header style
			 ***/
			$is_header_parallax = wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'header_style/modern/modern_header_parallax' ), FILTER_VALIDATE_BOOLEAN );
		
			// Page header image
			$header_bg_image = wplab_recover_front::get_header_bg_image();

		?>
		<div id="header-wrapper" <?php if( $is_header_parallax ): ?> data-speed="0.2" data-image-src="<?php echo esc_attr( $header_bg_image ); ?>" <?php elseif( $header_bg_image <> '' ): ?>style="background-image: url(<?php echo esc_attr($header_bg_image); ?>)"<?php endif; ?> class="default-tpl <?php echo $is_header_parallax ? 'parallax-section' : ''; ?>">				
			
			<!--
				Page title, breadcrumbs
			-->
			<header id="page-header">
				<div class="container">
					<div class="row">
					
						<?php if( is_rtl() ): ?>
						
						<div class="col-md-2">
							<?php
							/**
							 * CTA Link
							 **/
							if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/enabled' ), FILTER_VALIDATE_BOOLEAN ) ):
								$cta_link = fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/true/modern_header_cta_link_url' );
								$cta_text = fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/true/modern_header_cta_link_text' );
						 	?>
						 	<a href="<?php echo esc_attr( $cta_link ); ?>" class="button style-white link left size-medium header-cta"><?php echo wp_kses( $cta_text, $allowed_tags ); ?></a>
						 	<?php endif; ?>
						</div>
						<div class="col-md-10">
							
							<?php
							/**
							 * Page title
							 **/
							wplab_recover_front::print_page_title();
							
							/**
							 * Breadcrumbs
							 **/
						 	if( wplab_recover_utils::is_unyson() && function_exists( 'fw_ext_get_breadcrumbs' )): ?>
							
								<?php echo fw_ext_get_breadcrumbs( '' ); ?>
							
							<?php endif; ?>
							
						</div>
						
						<?php else: ?>
						
						<div class="col-md-10">
							
							<?php
							/**
							 * Page title
							 **/
							wplab_recover_front::print_page_title();
							
							/**
							 * Breadcrumbs
							 **/
						 	if( wplab_recover_utils::is_unyson() && function_exists( 'fw_ext_get_breadcrumbs' )): ?>
							
								<?php echo fw_ext_get_breadcrumbs( '' ); ?>
							
							<?php endif; ?>
							
						</div>
						<div class="col-md-2">
							<?php
							/**
							 * CTA Link
							 **/
							if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/enabled' ), FILTER_VALIDATE_BOOLEAN ) ):
								$cta_link = fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/true/modern_header_cta_link_url' );
								$cta_text = fw_get_db_settings_option( 'header_style/modern/modern_display_header_cta/true/modern_header_cta_link_text' );
						 	?>
						 	<a href="<?php echo esc_attr( $cta_link ); ?>" class="button style-white link left size-medium header-cta"><?php echo wp_kses( $cta_text, $allowed_tags ); ?></a>
						 	<?php endif; ?>
						</div>
						
						<?php endif; ?>
					
					</div>
				</div>
			</header>
			
		</div>
		
		<!--
			Content section area
		-->
		<div class="page-corners"></div>
		<div id="content-wrapper" class="default-tpl">