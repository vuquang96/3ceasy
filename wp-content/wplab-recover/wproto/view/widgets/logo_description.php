<?php if( wplab_recover_utils::is_unyson() ): ?>

	<?php echo $data['args']['before_widget']; ?>
	
	<div class="logo">
		<?php if( isset( $data['instance']['logo'] ) && $data['instance']['logo'] <> '' ): ?>
		<img alt="" class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_attr( $data['instance']['logo'] ); ?>" <?php echo isset( $data['instance']['logo_2x'] ) && $data['instance']['logo_2x'] <> '' ? 'data-at2x="' . esc_attr( $data['instance']['logo_2x'] ) . '"' : 'data-no-retina'; ?> />
		<?php endif; ?>
		
		<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>
		<span class="text"><?php echo strip_tags( $data['title'] ); ?></span>
		<?php endif; ?>
		
	</div>
	
	<!-- widget content -->
	<?php if ( isset( $data['instance']['description'] ) && $data['instance']['description'] <> '' ) : ?>
	<div class="desc">
		<?php echo wp_kses( $data['instance']['description'], wp_kses_allowed_html('post') ); ?>
	</div>
	<?php endif; ?>
	
	<?php if ( isset( $data['instance']['display_social_icons'] ) && $data['instance']['display_social_icons'] ) : ?>
	<div class="share-links">
	
		<?php $fb_url = fw_get_db_settings_option( 'facebook_url' ); if( $fb_url <> '' ): ?>
			<a rel="nofollow" class="facebook" target="_blank" title="Facebook" href="<?php echo esc_attr( $fb_url ); ?>"></a>
		<?php endif; ?>
		
		<?php $twitter_url = fw_get_db_settings_option( 'twitter_url' ); if( $twitter_url <> '' ): ?>
			<a rel="nofollow" class="twitter" target="_blank" title="Twitter" href="<?php echo esc_attr( $twitter_url ); ?>"></a>
		<?php endif; ?>
		
		<?php $linkedin_url = fw_get_db_settings_option( 'linkedin_url' ); if( $linkedin_url <> '' ): ?>
			<a rel="nofollow" class="linkedin" target="_blank" title="LinkedIn" href="<?php echo esc_attr( $linkedin_url ); ?>"></a>
		<?php endif; ?>
		
		<?php $foursquare_url = fw_get_db_settings_option( 'foursquare_url' ); if( $foursquare_url <> '' ): ?>
			<a rel="nofollow" class="foursquare" target="_blank" title="FourSquare" href="<?php echo esc_attr( $foursquare_url ); ?>"></a>
		<?php endif; ?>
		
		<?php $gp_url = fw_get_db_settings_option( 'google_plus_url' ); if( $gp_url <> '' ): ?>
			<a rel="nofollow" class="google-plus" target="_blank" title="Google Plus" href="<?php echo $gp_url; ?>"></a>
		<?php endif; ?>
		
		<?php $youtube_url = fw_get_db_settings_option( 'youtube_url' ); if( $youtube_url <> '' ): ?>
			<a rel="nofollow" class="youtube" target="_blank" title="YouTube" href="<?php echo esc_attr( $youtube_url ); ?>"></a>
		<?php endif; ?>
		
		<?php $instagram_url = fw_get_db_settings_option( 'instagram_url' ); if( $instagram_url <> '' ): ?>
			<a rel="nofollow" class="instagram" target="_blank" title="Instagram" href="<?php echo esc_attr( $instagram_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_settings_option( 'rss_icon' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
			<?php $rss_url = get_bloginfo( 'rss2_url' ); ?>
			<a rel="nofollow" class="rss" target="_blank" title="RSS" href="<?php echo esc_attr( $rss_url ); ?>"></a>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
	<?php endif; ?>

<?php echo $data['args']['after_widget']; 

endif;