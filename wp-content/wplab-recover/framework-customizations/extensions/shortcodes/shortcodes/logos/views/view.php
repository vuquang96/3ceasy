<?php
	if (!defined('FW')) die( 'Forbidden' );
	$cols = absint( $atts['columns'] );
	$column = 12/$cols;
?>

<div id="shortcode-<?php echo esc_attr( $atts['id'] ); ?>" class="logos-shortcode <?php if( filter_var( $atts['opacity_effect'] , FILTER_VALIDATE_BOOLEAN)): ?>with-opacity<?php endif; ?>">
	<?php $counter = 0; foreach( $atts['images'] as $image ): ?>
	
	<?php $logo = is_array( $image['logo'] ) && !empty( $image['logo'] ) ? $image['logo']['url'] : ''; ?>
	
	<?php if( $counter % $cols == 0 ): ?>
	<div class="row">
	<?php endif; $counter++; ?>
	
	<div class="col-md-<?php echo $column; ?>">
		<?php if( $image['url'] <> '' ): ?>
		<a href="<?php echo esc_attr( $image['url'] ); ?>" <?php if( filter_var( $atts['new_tab'] , FILTER_VALIDATE_BOOLEAN)): ?>target="_blank"<?php endif; ?>>
		<?php endif; ?>
			<?php echo wplab_recover_media::image( $logo, null, null, false, false, '', true ); ?>
		<?php if( $image['url'] <> '' ): ?>
		</a>
		<?php endif; ?>
	</div>
	
	<?php if( $counter % $cols == 0 ): ?>
	</div>
	<?php endif; ?>
	
	<?php endforeach; ?>
	
	<?php if( $counter%$cols != 0 ): ?>
	</div>
	<?php endif; ?>
	
</div>