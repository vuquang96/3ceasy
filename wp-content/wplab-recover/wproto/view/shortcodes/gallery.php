<!--			
	POST GALLERY SHORTCODE VIEW
-->
<div class="post-gallery carousel_fade">
	<?php foreach( $data['items'] as $item ): ?>
	<div class="item">
		<?php
			$image = wp_get_attachment_image_src( $item->ID, 'full' );
			echo wplab_recover_media::image( $image[0], 1070, 600, true, true, $image[0], true );
		?>
	</div>
	<?php endforeach; ?>
</div>