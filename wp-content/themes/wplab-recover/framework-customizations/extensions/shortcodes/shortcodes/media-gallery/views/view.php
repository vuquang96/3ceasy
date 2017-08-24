<?php
	if (!defined('FW')) die( 'Forbidden' );
	$cols = absint( $atts['columns'] );
	$column = 12/$cols;
	
	$img_width = 570;
	$img_height = 380;
	
	if( $cols == 3 ) {
		$img_width = 370;
		$img_height = 247;
	} elseif( $cols == 4 ) {
		$img_width = 270;
		$img_height = 180;
	}
	$id = isset( $atts['id'] ) ? $atts['id'] : '';
?>

<div class="grid-gallery">
	<?php $counter = 0; foreach( $atts['images'] as $k=>$v ): ?>
	
	<?php if( $counter % $cols == 0 ): ?>
	<div class="row">
	<?php endif; $counter++; ?>
	
	<div class="col-md-<?php echo $column; ?>">
		<a href="<?php echo esc_attr( $v['url'] ); ?>" class="inside lightbox" data-lightbox-gallery="grid-gallery-shortcode-<?php echo esc_attr( $id ); ?>">
			<?php
				$image_alt = 'alt="' . esc_attr( get_post_meta( $v['attachment_id'], '_wp_attachment_image_alt', true ) ) . '"';
				echo wplab_recover_media::image( $v['url'], $img_width, $img_height, true, true, $v['url'], true, array(), array($image_alt) );
			?>
		</a>
	</div>
	
	<?php if( $counter % $cols == 0 ): ?>
	</div>
	<?php endif; ?>
	
	<?php endforeach; ?>
	
	<?php if( $counter%$cols != 0 ): ?>
	</div>
	<?php endif; ?>
	
</div>