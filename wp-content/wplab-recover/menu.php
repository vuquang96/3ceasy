<?php
	$menu_id = '';
	$menu_style = 'default';
	$submenu_style = 'dark';
	$menu_hover_effect = 'fadeIn';
	$one_page = false;
	$one_page_update_hash = 0;
	$one_page_speed = 750;
	$one_page_offset = 100;
	
	$customize_page_header = false;
	$different_mobile_logo = false;
	
	if( wplab_recover_utils::is_unyson() ) {
	
		$menu_style = fw_get_db_settings_option( 'menu_style' );
		$submenu_style = fw_get_db_settings_option( 'submenu_style' );
		$menu_hover_effect = fw_get_db_settings_option( 'menu_hover_effect' );
	
		if( is_page() ) {
			$menu_id = fw_get_db_post_option( get_the_ID(), 'page_menu' );
			$one_page = filter_var( fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/enabled' ), FILTER_VALIDATE_BOOLEAN );
			if( $one_page ) {
				$one_page_update_hash = fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/true/onepage_update_hash' );
				$one_page_speed = fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/true/onepage_speed' );
				$one_page_offset = fw_get_db_post_option( get_the_ID(), 'enable_onepage_menu/true/onepage_offset' );
			}
			if( filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
				$menu_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/menu_style' );
				$submenu_style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/submenu_style' );
			}
		}
		
		$customize_page_header = filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN );
		
	}
	
	if( wplab_recover_utils::is_unyson() ) {
		
		if( is_page() && $customize_page_header ) {
			$different_mobile_logo = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/logo_type' ) == 'image' && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/enabled' ), FILTER_VALIDATE_BOOLEAN );
		} else {
			$different_mobile_logo = fw_get_db_settings_option( 'header_logo_type/logo_type' ) == 'image' && filter_var( fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/enabled' ), FILTER_VALIDATE_BOOLEAN );
		}
		
	}
	
?>
<!--
	Header Menu
-->
<header data-onepage-update-hash="<?php echo absint( $one_page_update_hash ); ?>" data-onepage-offset="<?php echo esc_attr( $one_page_offset ); ?>" data-onepage-speed="<?php echo esc_attr( $one_page_speed ); ?>" data-hover-effect="<?php echo esc_attr( $menu_hover_effect ); ?>" class="menu-style-<?php echo esc_attr( $menu_style ); ?> <?php if( $one_page ): ?>enable-one-page-menu<?php endif; ?> submenu-style-<?php echo esc_attr( $submenu_style ); ?>" id="header">
	<div id="header-menu-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="menu-inner">
						<div id="menu-holder" <?php if( $different_mobile_logo ): ?>class="different-logos"<?php endif; ?>>
						<?php
							/**
							 * Logo
							 **/
							$logo_type = 'title';
							
							// If Unyson Framework is enabled
							if( wplab_recover_utils::is_unyson() ) {
								if( is_page() && $customize_page_header ) {
									$logo_type = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/logo_type' );
								} else {
									$logo_type = fw_get_db_settings_option( 'header_logo_type/logo_type' );
								}
							}
				
							// If logo type is a "site title"
							if( $logo_type == 'title' ):
								?>
								<a href="<?php echo site_url(); ?>" class="logo logo-title"><?php echo esc_html( get_bloginfo('name') ); ?></a>
								<?php
							// If logo type is a "site title and tagline"
							elseif( $logo_type == 'title_and_tagline' ):
								?>
								<a href="<?php echo site_url(); ?>" class="logo logo-title-tagline"><span class="title"><?php echo esc_html( get_bloginfo('name') ); ?></span><span class="tagline"><?php echo esc_html( get_bloginfo('description') ); ?></span></a>
								<?php
							// If logo type is an "image"
							elseif( $logo_type == 'image' ):
							
								if( $customize_page_header ) {
									
									$logo_img 				= esc_attr( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/header_logo_image/url' ) );
									$logo_img_retina 	= esc_attr( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/header_logo_image_2x/url' ) );
									$header_logo_width = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/header_logo_width' );
									$header_logo_height = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/header_logo_height' );
									$header_logo_margin_top = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/logo_margins/top' );
									$header_logo_margin_right = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/logo_margins/right' );
									$header_logo_margin_bottom = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/logo_margins/bottom' );
									$header_logo_margin_left = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/logo_margins/left' );
									
								} else {
								
									$logo_img 				= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_image/url' ) );
									$logo_img_retina 	= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/header_logo_image_2x/url' ) );
									$header_logo_width = fw_get_db_settings_option( 'header_logo_type/image/header_logo_width' );
									$header_logo_height = fw_get_db_settings_option( 'header_logo_type/image/header_logo_height' );
									$header_logo_margin_top = fw_get_db_settings_option( 'header_logo_type/image/logo_margins/top' );
									$header_logo_margin_right = fw_get_db_settings_option( 'header_logo_type/image/logo_margins/right' );
									$header_logo_margin_bottom = fw_get_db_settings_option( 'header_logo_type/image/logo_margins/bottom' );
									$header_logo_margin_left = fw_get_db_settings_option( 'header_logo_type/image/logo_margins/left' );
									
									if( is_rtl() && filter_var( fw_get_db_settings_option( 'header_logo_type/image/different_rtl_logo/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
										$logo_img 				= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/different_rtl_logo/true/rtl_logo_image/url' ) );
										$logo_img_retina 	= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/different_rtl_logo/true/rtl_logo_image/url' ) );
									}
									
								}
								
								$logo_img_retina 	= $logo_img_retina == '' ? 'data-no-retina' : 'data-at2x="' . $logo_img_retina . '"';
								
								$logo_style = wplab_recover_utils::get_styles( array(
									'width' 				=> $header_logo_width,
									'height' 				=> $header_logo_height,
									'top_margin' 		=> $header_logo_margin_top,
									'right_margin' 	=> $header_logo_margin_right,
									'bottom_margin' => $header_logo_margin_bottom,
									'left_margin' 	=> $header_logo_margin_left,
								));
							
								?>
								<a href="<?php echo site_url(); ?>" class="logo logo-desktop logo-image"><img style="<?php echo esc_attr( $logo_style ); ?>" src="<?php echo $logo_img; ?>" <?php echo $logo_img_retina; ?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?> &ndash; <?php echo esc_attr( get_bloginfo('description') ); ?>" /></a>
								<?php
							endif;
						?>
						
						<?php
							// Different logo for mobiles
							if( $different_mobile_logo ):
							
								if( $customize_page_header ) {
									
									$mobile_logo_img 				= esc_attr( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_header_logo_image/url' ) );
									$mobile_logo_img_retina 	= esc_attr( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_header_logo_image_2x/url' ) );
									$mobile_header_logo_width = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_header_logo_width' );
									$mobile_header_logo_height = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_header_logo_height' );
									$mobile_header_logo_margin_top = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/top' );
									$mobile_header_logo_margin_right = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/right' );
									$mobile_header_logo_margin_bottom = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/bottom' );
									$mobile_header_logo_margin_left = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/left' );
									
								} else {
								
									$mobile_logo_img 				= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_header_logo_image/url' ) );
									$mobile_logo_img_retina 	= esc_attr( fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_header_logo_image_2x/url' ) );
									$mobile_header_logo_width = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_header_logo_width' );
									$mobile_header_logo_height = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_header_logo_height' );
									$mobile_header_logo_margin_top = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/top' );
									$mobile_header_logo_margin_right = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/right' );
									$mobile_header_logo_margin_bottom = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/bottom' );
									$mobile_header_logo_margin_left = fw_get_db_settings_option( 'header_logo_type/image/different_mobile_logo/true/mobile_logo_margins/left' );
									
								}
								
								$mobile_logo_img_retina = $mobile_logo_img_retina == '' ? 'data-no-retina' : 'data-at2x="' . $mobile_logo_img_retina . '"';

								$mobile_logo_style = wplab_recover_utils::get_styles( array(
									'width' 				=> $mobile_header_logo_width,
									'height' 				=> $mobile_header_logo_height,
									'top_margin' 		=> $mobile_header_logo_margin_top,
									'right_margin' 	=> $mobile_header_logo_margin_right,
									'bottom_margin' => $mobile_header_logo_margin_bottom,
									'left_margin' 	=> $mobile_header_logo_margin_left,
								));
							
						?>
						<a href="<?php echo site_url(); ?>" class="logo-mobile logo-image"><img style="<?php echo esc_attr( $mobile_logo_style ); ?>" src="<?php echo $mobile_logo_img; ?>" <?php echo $mobile_logo_img_retina; ?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?> &ndash; <?php echo esc_attr( get_bloginfo('description') ); ?>" /></a>
						<?php endif; ?>
					
						<?php
							/**
							 * Menu navigation
							 **/
							wp_nav_menu( array(
								'menu' => $menu_id,
								'theme_location' => 'header_menu',
								'walker' => new wplab_recover_front_nav_menu_walker,
								'menu_id' => 'header-menu',
								'menu_class' => 'dl-menu',
								'fallback_cb' => false,
								'container' => false						
							));
						?>
						
						<a href="javascript:;" id="mobile-menu-toggler" class="dl-trigger">
						  <span></span>
						  <span></span>
						  <span></span>
						  <span></span>
						</a>
					</div>
					
					<?php if( wplab_recover_utils::is_unyson() ): ?>
					
						<?php
							/**
							 * Header cart widget
							 **/
						?>
					
						<?php if( filter_var( fw_get_db_settings_option( 'menu_display_cart' ), FILTER_VALIDATE_BOOLEAN ) && wplab_recover_utils::is_woocommerce() ): ?>
						
							<div id="header-cart-widget">
								<a href="javascript:;" id="header-cart-widget-toggle"><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
								<div class="inside">
									<?php the_widget( 'WC_Widget_Cart' ); ?>
								</div>
							</div>
						
						<?php endif; ?>
						
						<?php
							/**
							 * Header search widget
							 **/
						?>
						
						<?php if( filter_var( fw_get_db_settings_option( 'menu_display_search' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
						
							<div id="header-search-widget">
								<a href="javascript:;" id="header-search-widget-toggle"></a>
								<div class="inside">
									<?php get_search_form(); ?>
								</div>
							</div>
						
						<?php endif; ?>
					
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>