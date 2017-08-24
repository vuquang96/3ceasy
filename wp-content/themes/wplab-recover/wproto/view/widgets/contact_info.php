<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->

	<?php if( isset( $data['instance']['free_text'] ) && $data['instance']['free_text'] <> '' ): ?>
	<div class="free_text">
		<?php echo wp_kses( $data['instance']['free_text'], wp_kses_allowed_html( 'post') ); ?>
	</div>
	<?php endif; ?>

	<?php if( isset( $data['instance']['phones'] ) && $data['instance']['phones'] <> '' ): ?>
	
		<div class="content-row phones">
			<?php
				wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/telephone.svg' );			
				echo nl2br( $data['instance']['phones'] );
			?>
		</div>
	
	<?php endif; ?>

	<?php if( isset( $data['instance']['address'] ) && $data['instance']['address'] <> '' ): ?>
	
		<div class="content-row address">
			<?php
				wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/direction.svg' );			
				echo nl2br( $data['instance']['address'] );
			?>
		</div>
	
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['emails'] ) && $data['instance']['emails'] <> '' ): ?>
	
		<div class="content-row emails">
			<?php
				wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/origami.svg' );			
				echo nl2br( wplab_recover_utils::emailize( $data['instance']['emails'] ) );
			?>
		</div>
	
	<?php endif; ?>

<?php echo $data['args']['after_widget']; 