<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->
	<div class="two-cols-menu">
	
	<?php if( isset( $data['instance']['menu'] ) && $data['instance']['menu'] <> '' ): ?>
	
		<?php
			wp_nav_menu( array(
				'menu' => $data['instance']['menu'],
				'fallback_cb' => false,
				'container' => false						
			));	
		?>
	
	<?php endif; ?>
	
	<div class="clearfix"></div>
	
	</div>

<?php echo $data['args']['after_widget']; 