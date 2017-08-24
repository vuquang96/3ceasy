<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$atttibutes = array();
$allowed_tags = wp_kses_allowed_html('post');

/** unique id **/
$atttibutes[] = 'id="shortcode-' . $atts['id'] . '"';

?>
<blockquote class="style-<?php echo esc_attr( $atts['style'] ); ?>" <?php echo implode( ', ', $atttibutes ); ?>>

	<div class="quote-content">
		<?php if( $atts['style'] == 'small_photo_alt' ): ?>
			<img src="<?php echo esc_attr( get_template_directory_uri() ); ?>/images/svg/quote.svg" alt="" class="image-svg" />
		<?php endif; ?>
		
		<?php echo apply_filters( 'the_content', $atts['text'] ); ?>
	</div>
	
	<div class="quote-data">
		<?php if( $atts['style'] != 'big_photo' && isset( $atts['photo'] ) && !empty( $atts['photo'] ) ): ?>
		<span class="photo"><img src="<?php echo esc_attr( $atts['photo']['url'] ); ?>" alt="" /></span>
		<?php endif; ?>
		
		<div class="cite">
			<?php if( $atts['author'] <> '' ): ?>
			<span class="author"><?php echo wp_kses( $atts['author'], $allowed_tags ); ?></span>
			<?php endif; ?>
		
			<?php if( $atts['position'] <> '' ): ?>
			<span class="position"><?php echo wp_kses( $atts['position'], $allowed_tags ); ?></span>
			<?php endif; ?>
		</div>
	</div>
	
</blockquote>