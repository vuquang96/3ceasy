<?php
	if (!defined('FW')) die( 'Forbidden' );
	$atttibutes = array();
	$allowed_tags = wp_kses_allowed_html('post');
	
	/** unique id **/
	$atttibutes[] = 'id="shortcode-' . $atts['id'] . '"';
	
	if( filter_var( $atts['autoplay']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		$atttibutes[] = 'data-autoplay="1"';
		$atttibutes[] = 'data-autoplay-time="' . $atts['autoplay']['true']['autoplay_speed'] . '"';
	}
?>

<div class="shortcode-testimonials post-gallery carousel_fade style-<?php echo esc_attr( $atts['style'] ); ?>" <?php echo implode( ', ', $atttibutes ); ?>>
	<?php foreach( $atts['items'] as $item ): ?>
	<div class="item">
		<blockquote class="style-<?php echo esc_attr( $atts['style'] ); ?>">
		
			<div class="quote-content">
				<?php if( $atts['style'] == 'small_photo_alt' ): ?>
					<img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/images/svg/quote.svg" alt="" class="image-svg" />
				<?php endif; ?>
				
				<?php echo apply_filters( 'the_content', $item['text'] ); ?>
			</div>
			
			<div class="quote-data">
				<?php if( $atts['style'] != 'big_photo' && isset( $item['photo'] ) && !empty( $item['photo'] ) ): ?>
				<span class="photo"><img src="<?php echo esc_attr( $item['photo']['url'] ); ?>" alt="" /></span>
				<?php endif; ?>
				
				<div class="cite">
					<?php if( $item['author'] <> '' ): ?>
					<span class="author"><?php echo wp_kses( $item['author'], $allowed_tags ); ?></span>
					<?php endif; ?>
				
					<?php if( $item['position'] <> '' ): ?>
					<span class="position"><?php echo wp_kses( $item['position'], $allowed_tags ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			
		</blockquote>
	</div>
	<?php endforeach; ?>
</div>
