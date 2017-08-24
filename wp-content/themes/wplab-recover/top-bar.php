<?php

	/**
	 * Top bar template
	 **/
	if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_top_bar/enabled' ), FILTER_VALIDATE_BOOLEAN ) ):
	
		if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/disable_top_bar' ), FILTER_VALIDATE_BOOLEAN ) ) {
			return;
		}
	
		$phone = fw_get_db_settings_option( 'display_top_bar/true/top_bar_phone' );
		$email = fw_get_db_settings_option( 'display_top_bar/true/top_bar_email' );
		$wh = fw_get_db_settings_option( 'display_top_bar/true/top_bar_wh' );
		$wpml = fw_get_db_settings_option( 'display_top_bar/true/top_bar_wpml' );
	?>
	<div id="top-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<?php if( $phone <> '' ): ?>
					<div class="tb-item phone">
						<i class="fa fa-phone"></i> <span><?php echo fw_get_db_settings_option( 'display_top_bar/true/top_bar_phone_text' ); ?></span> <?php echo wp_kses_post( $phone ); ?>
					</div>
					<?php endif; ?>
					
					<?php if( $email <> '' ): ?>
					<div class="tb-item email">
						<i class="fa fa-envelope"></i> <span><?php echo fw_get_db_settings_option( 'display_top_bar/true/top_bar_email_text' ); ?></span> <?php echo wplab_recover_utils::emailize( $email ); ?>
					</div>
					<?php endif; ?>
					
					<?php if( $wh <> '' ): ?>
					<div class="tb-item wh">
						<i class="fa fa-clock-o"></i> <span><?php echo fw_get_db_settings_option( 'display_top_bar/true/top_bar_wh_text' ); ?></span> <?php echo wp_kses_post( $wh ); ?>
					</div>
					<?php endif; ?>
					
					<?php if( $wpml && function_exists('icl_get_languages') ): ?>
					<div class="tb-item tb-wpml">
						<?php
					    $languages = icl_get_languages('skip_missing=0&orderby=code');
					    if(!empty($languages)){
				        foreach($languages as $l){
			            echo '<div class="lang-item">';
			            if($l['country_flag_url']){
		                if(!$l['active']) echo '<a href="'.$l['url'].'">';
		                echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
		                if(!$l['active']) echo '</a>';
			            }
			            if(!$l['active']) echo '<a href="'.$l['url'].'">';
			            echo icl_disp_language('', $l['translated_name']);
			            if(!$l['active']) echo '</a>';
			            echo '</div>';
				        }
					    }
						?>
					</div>
					<?php endif; ?>
					
					<?php if( filter_var( fw_get_db_settings_option( 'display_top_bar/true/top_bar_social_icons' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
					<div class="tb-item si">
						<?php wplab_recover_front::social_fa_icons(); ?>
					</div>
					<?php endif; ?>
					
					<?php if( filter_var( fw_get_db_settings_option( 'display_top_bar/true/top_bar_display_menu/enabled' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
					<div class="tb-item tb-menu">
						<?php
							$top_bar_menu = fw_get_db_settings_option( 'display_top_bar/true/top_bar_display_menu/true/top_bar_menu' );

							wp_nav_menu( array(
								'menu' => $top_bar_menu,
								'theme_location' => 'top_bar_menu',
								'menu_id' => 'top-bar-menu',
								'fallback_cb' => false,
								'container' => false						
							));
							
						?>
					</div>
					<?php endif; ?>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	endif;