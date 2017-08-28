<?php

$css_classes = $atttibutes = array();

$col_style = '';

$css_classes[] = 'layout-col';

/**
 * Custom CSS Classes
 **/
if( isset( $atts['section_class'] ) && $atts['section_class'] <> '' ) {
	$css_classes[] = esc_attr( $atts['section_class'] );
}

if( isset( $atts['hide_bg_large_screens'] ) && filter_var( $atts['hide_bg_large_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-lg';
}

if( isset( $atts['hide_bg_medium_screens'] ) && filter_var( $atts['hide_bg_medium_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-md';
}

if( isset( $atts['hide_bg_small_screens'] ) && filter_var( $atts['hide_bg_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-sm';
}

if( isset( $atts['hide_bg_estra_small_screens'] ) && filter_var( $atts['hide_bg_estra_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-xs';
}

if( isset( $atts['hide_lg'] ) && filter_var( $atts['hide_lg'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-lg';
}

if( isset( $atts['hide_md'] ) && filter_var( $atts['hide_md'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-md';
}

if( isset( $atts['hide_sm'] ) && filter_var( $atts['hide_sm'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-sm';
}

if( isset( $atts['hide_xs'] ) && filter_var( $atts['hide_xs'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-xs';
}

/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'wow';
	$css_classes[] = $atts['animation']['true']['effect'];
	$atttibutes[] = 'data-wow-delay="' . esc_attr( $atts['animation']['true']['animation_delay'] ) . '"';
}

/**
 * Shortcode ID
 **/
$atttibutes[] = 'id="shortcode-' . $atts['id'] . '"';

$class = fw_ext_builder_get_item_width( 'page-builder', $atts['width'] . '/frontend_class' );

/**
 * Lazy load bg image
 **/
if( filter_var( $atts['background_lazy'], FILTER_VALIDATE_BOOLEAN ) && !empty( $atts['background_image']['data']['css'] ) ) {
	$class .= ' b-lazy';
	$atttibutes[] = 'data-src="' . esc_attr( $atts['background_image']['data']['icon'] ) . '"';
}

?>
<div class="<?php echo esc_attr( $class ); ?> <?php echo implode( ' ', $css_classes ); ?>" <?php echo implode( ' ', $atttibutes ); ?>>
	<?php echo do_shortcode( $content ); ?>
</div>