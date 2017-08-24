<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<div class="contact-info-shortcode">
<?php if( $atts['phones'] <> '' ): ?>

	<div class="content-row phones">
		<?php wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/telephone.svg' ); ?>
		<div class="text-container">
			<div class="text">						
				<?php echo nl2br( $atts['phones'] ); ?>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php if( $atts['address'] <> '' ): ?>

	<div class="content-row address">
		<?php wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/direction.svg' ); ?>			
		<div class="text-container">
			<div class="text">	
				<?php echo nl2br( $atts['address'] ); ?>
			</div>
		</div>
	</div>

<?php endif; ?>

<?php if( $atts['emails'] <> '' ): ?>

	<div class="content-row emails">
		<?php wplab_recover_media::image_src( '', get_template_directory_uri() . '/images/svg/origami.svg' ); ?>		
		<div class="text-container">
			<div class="text">		
				<?php echo nl2br( wplab_recover_utils::emailize( $atts['emails'] ) ); ?>
			</div>
		</div>
	</div>

<?php endif; ?>
</div>