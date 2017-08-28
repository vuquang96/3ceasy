<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( empty( $atts['icon'] ) ) {
	return;
}

$css_classes = $icon_attributes = array();

$icon_id = 'shortcode-' . $atts['id'];

$css_classes[] = 'image-svg';

if( $atts['icon_align'] <> '' ) {
	$css_classes[] = $atts['icon_align'];
}

$width = is_numeric( $atts['width'] ) ? $atts['width'] : '';
$height = is_numeric( $atts['height'] ) ? $atts['height'] : '';

$animated = false;
/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$animated = true;
}

?>

<?php if( $atts['icon_align'] == 'center' ): ?><div style="text-align: center;"><?php endif; ?>
<div <?php if( $animated ): ?>class="wow <?php echo esc_attr( $atts['animation']['yes']['effect'] ); ?>" data-wow-delay="<?php echo esc_attr( $atts['animation']['yes']['animation_delay'] ); ?>"<?php endif; ?> id="<?php echo esc_attr( $icon_id ); ?>">
	<img src="<?php echo esc_attr( $atts['icon']['url'] ); ?>" <?php echo implode( ' ', $icon_attributes ); ?> class="<?php echo implode( ' ', $css_classes ); ?>" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" alt="" />
</div>
<?php if( $atts['icon_align'] == 'center' ): ?></div><?php endif; ?>