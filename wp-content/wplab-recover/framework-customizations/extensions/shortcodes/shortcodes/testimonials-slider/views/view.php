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

<div class="shortcode-testimonials-slider post-gallery carousel_fade style-<?php echo esc_attr( $atts['style'] ); ?>" <?php echo implode( ' ', $atttibutes ); ?>>
	<?php foreach( $atts['items'] as $item ): ?>
	<div class="item">
		<div class="style-<?php echo esc_attr( $atts['style'] ); ?>">
		
			<?php if( $atts['style'] == 'modern_slider' && isset( $item['photo'] ) && !empty( $item['photo'] ) ): ?>
			<div class="photo"><img src="<?php echo esc_attr( $item['photo']['url'] ); ?>" alt="" /></div>
			<?php endif; ?>
		
			<div class="quote-content">
				<?php echo apply_filters( 'the_content', $item['text'] ); ?>
			</div>
			
			<div class="quote-data">
				<?php if( $atts['style'] == 'slider' && isset( $item['photo'] ) && !empty( $item['photo'] ) ): ?>
				<div class="photo"><img src="<?php echo esc_attr( $item['photo']['url'] ); ?>" alt="" /></div>
				<?php endif; ?>
				
				<div class="cite">
					<?php if( $item['author'] <> '' ): ?>
					<div class="author"><?php echo wp_kses( $item['author'], $allowed_tags ); ?></div>
					<?php endif; ?>
				
					<?php if( $item['position'] <> '' ): ?>
					<div class="position"><?php echo wp_kses( $item['position'], $allowed_tags ); ?></div>
					<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>
	<?php endforeach; ?>
</div>
