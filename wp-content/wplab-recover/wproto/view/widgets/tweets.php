<?php if( wplab_recover_utils::is_unyson() ): ?>

	<?php echo $data['args']['before_widget']; ?>
	
	<!-- widget title -->
	<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>
	
		<?php echo $data['args']['before_title']; ?>
		
			<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
			
		<?php echo $data['args']['after_title']; ?>
		
	<?php endif; ?>
	
	<!-- widget content -->
	
	<div class="tweets-block" data-count="<?php echo esc_attr( $data['instance']['count'] ); ?>"><i class="fa fa-twitter"></i> <?php esc_html_e( 'Loading latest tweets...', 'wplab-recover' ); ?></div>

<?php echo $data['args']['after_widget']; 

endif;