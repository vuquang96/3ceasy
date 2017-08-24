<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<div class="post-gallery carousel_fade">
	<?php foreach( $atts['images'] as $k=>$v ): ?>
	<div class="item">
		<?php
			$image_alt = 'alt="' . esc_attr( get_post_meta( $v['attachment_id'], '_wp_attachment_image_alt', true ) ) . '"';
			echo wplab_recover_media::image( $v['url'], 1070, 600, true, true, $v['url'], true, array(), array($image_alt) );
		?>
	</div>
	<?php endforeach; ?>
</div>