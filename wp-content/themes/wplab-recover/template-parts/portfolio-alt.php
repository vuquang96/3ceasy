<?php
	$terms = wp_get_post_terms( get_the_ID(), 'fw-portfolio-category' );
	$terms_array = array();
	if( count( $terms ) > 0 ) {
		foreach( $terms as $term ) {
			$terms_array[] = $term->slug;
		}
	}
?>
<article class="item <?php echo implode( ' ', $terms_array ); ?>">
	<div class="inside">
		<div class="element">
			<?php
				$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
				
				$img_width = 480;
				$img_height = 330;
				if( wplab_recover_utils::is_unyson() ) {
					$img_width = absint( fw_get_db_settings_option( 'portfolio_alt_thumb_width' ) );
					$img_height = absint( fw_get_db_settings_option( 'portfolio_alt_thumb_height' ) );
				}
				
				echo wplab_recover_media::image( $thumb_url, $img_width, $img_height, true, true, $thumb_url, true );
			?>
		  <div class="overlay overlay-1 overlay-top"></div>
		  <div class="overlay overlay-2 overlay-bottom"></div>
			<div class="caption">
				<div class="caption-table">
					<div class="caption-cell">
						<a href="<?php the_permalink(); ?>" class="title"><h4><?php the_title(); ?></h4></a>
						<a href="<?php echo esc_attr( $thumb_url ); ?>" class="view lightbox" title="<?php echo esc_attr( get_the_title() ); ?>" data-lightbox-gallery="portolio-shortcode-gallery"></a>
						<a href="<?php the_permalink(); ?>" class="link"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>