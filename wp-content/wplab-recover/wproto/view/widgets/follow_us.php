<?php if( wplab_recover_utils::is_unyson() ): ?>

	<?php echo $data['args']['before_widget']; ?>
	
	<!-- widget title -->
	<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>
	
		<?php echo $data['args']['before_title']; ?>
		
			<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
			
		<?php echo $data['args']['after_title']; ?>
		
	<?php endif; ?>
	
	<!-- widget content -->
	
	<div class="share-links">
	
		<?php if( isset( $data['instance']['display_facebook'] ) && $data['instance']['display_facebook'] ): ?>
			<?php $fb_url = fw_get_db_settings_option( 'facebook_url' ); ?>
			<a rel="nofollow" class="facebook" target="_blank" title="Facebook" href="<?php echo esc_attr( $fb_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_twitter'] ) && $data['instance']['display_twitter'] ): ?>
			<?php $twitter_url = fw_get_db_settings_option( 'twitter_url' ); ?>
			<a rel="nofollow" class="twitter" target="_blank" title="Twitter" href="<?php echo esc_attr( $twitter_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_linkedin'] ) && $data['instance']['display_linkedin'] ): ?>
			<?php $linkedin_url = fw_get_db_settings_option( 'linkedin_url' ); ?>
			<a rel="nofollow" class="linkedin" target="_blank" title="LinkedIn" href="<?php echo esc_attr( $linkedin_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_foursquare'] ) && $data['instance']['display_foursquare'] ): ?>
			<?php $foursquare_url = fw_get_db_settings_option( 'foursquare_url' ); ?>
			<a rel="nofollow" class="foursquare" target="_blank" title="FourSquare" href="<?php echo esc_attr( $foursquare_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_google_plus'] ) && $data['instance']['display_google_plus'] ): ?>
			<?php $gp_url = fw_get_db_settings_option( 'google_plus_url' ); ?>
			<a rel="nofollow" class="google-plus" target="_blank" title="Google Plus" href="<?php echo $gp_url; ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_youtube'] ) && $data['instance']['display_youtube'] ): ?>
			<?php $youtube_url = fw_get_db_settings_option( 'youtube_url' ); ?>
			<a rel="nofollow" class="youtube" target="_blank" title="YouTube" href="<?php echo esc_attr( $youtube_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_instagram'] ) && $data['instance']['display_instagram'] ): ?>
			<?php $instagram_url = fw_get_db_settings_option( 'instagram_url' ); ?>
			<a rel="nofollow" class="instagram" target="_blank" title="Instagram" href="<?php echo esc_attr( $instagram_url ); ?>"></a>
		<?php endif; ?>
		
		<?php if( isset( $data['instance']['display_rss'] ) && $data['instance']['display_rss'] && filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
			<?php $rss_url = get_bloginfo( 'rss2_url' ); ?>
			<a rel="nofollow" class="rss" target="_blank" title="RSS" href="<?php echo esc_attr( $rss_url ); ?>"></a>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>

<?php echo $data['args']['after_widget']; 

endif;