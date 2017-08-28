<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

	<div class="container">
		<div class="row">
			<div id="content" class="<?php echo wplab_recover_utils::get_content_classes(); ?>">
			
				<i class="img-404"></i>
			
				<?php if( wplab_recover_utils::is_unyson() ): ?>
				
					<?php echo fw_get_db_settings_option( 'page_404_content' ); ?>
					
					<?php
						if( filter_var( fw_get_db_settings_option( 'page_404_search_form' ), FILTER_VALIDATE_BOOLEAN ) ) {
							get_search_form();
						}
					?>
					
					<?php
						if( filter_var( fw_get_db_settings_option( 'page_404_buttons' ), FILTER_VALIDATE_BOOLEAN ) ):
						?>
						<a href="javascript:window.history.back();" class="button style-black poly left size-large"><?php esc_html_e( 'Come back', 'wplab-recover' ); ?></a>
						<a href="<?php echo esc_attr( get_site_url() );?>" class="button style-yellow poly right size-large"><?php esc_html_e( 'Go to home', 'wplab-recover' ); ?></a>
						<?php
						endif;
					?>
				
				<?php else: ?>
				
					<h1 class="h1"><span>404</span> <?php esc_html_e( 'Page not found', 'wplab-recover' ); ?></h1>
					
					<p><?php esc_html_e( 'The page you are looking for does not appear to exist.', 'wplab-recover' ); ?><br /><?php esc_html_e( 'Please go back or head on over our homepage to choose a new direction.', 'wplab-recover' ); ?></p>
					
					<?php get_search_form(); ?>
				
				<?php endif; ?>
			
			</div>
			
			<?php get_sidebar(); ?>
			
		</div>
	</div>

<?php get_footer(); 