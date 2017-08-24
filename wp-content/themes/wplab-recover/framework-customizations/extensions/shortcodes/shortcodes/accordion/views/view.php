<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$id = uniqid('theme-toggles-');
?>
<div class="theme-accordion style-<?php echo esc_attr( $atts['style'] ); ?>">
	<?php $i=0; foreach ( $atts['toggles'] as $toggle ) : ?>
		<div class="theme-toggle target" data-swap-group="group-<?php echo esc_attr( $id ); ?>" data-swap-target="#<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>">
			<?php echo do_shortcode( $toggle['title'] ) ?>
		</div>
		<div class="toggle" id="<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>">
			<?php echo do_shortcode( $toggle['content'] ) ?>
		</div>
	<?php $i++; endforeach; ?>
</div>