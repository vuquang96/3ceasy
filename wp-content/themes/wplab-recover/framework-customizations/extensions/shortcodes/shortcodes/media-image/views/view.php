<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( empty( $atts['image'] ) ) {
	return;
}

$is_lightbox = filter_var( $atts['lightbox'], FILTER_VALIDATE_BOOLEAN );
$lightbox_class = '';
if( $atts['link'] <> '' || $is_lightbox ) {
	$href = '';
	if( $is_lightbox && $atts['link'] <> '' ) {
		$href = $atts['link'];
	} elseif( $atts['link'] <> '' ) {
		$href = $atts['link'];
	} else {
		$href = $atts['image']['url'];
	}
	if( $is_lightbox ) {
		$lightbox_class = 'lightbox';
	}
	echo '<a href="' . esc_attr( $href ) . '" target="' . esc_attr( $atts['target'] ) . '" class="' . $lightbox_class . '">';
}

$hd = false;
$hd_url = '';
if ( !empty( $atts['image_2x'] ) ) {
	$hd_url = $atts['image_2x']['url'];
	$hd = true;
}

$img_id = 'shortcode-' . $atts['id'];

$width = is_numeric( $atts['width'] ) ? $atts['width'] : null;
$height = is_numeric( $atts['height'] ) ? $atts['height'] : null;

$img_classes = $img_attributes = array();
$img_classes[] = 'img-shortcode';
$img_attributes[] = 'id="' . $img_id . '"';
$img_attributes[] = 'alt="' . esc_attr( get_post_meta( $atts['image']['attachment_id'], '_wp_attachment_image_alt', true ) ) . '"';

if( $atts['image_align'] <> '' ) {
	$img_classes[] = $atts['image_align'];
}

/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$img_classes[] = 'wow';
	$img_classes[] = $atts['animation']['true']['effect'];
	$img_attributes[] = 'data-wow-delay="' . esc_attr( $atts['animation']['true']['animation_delay'] ) . '"';
}

echo wplab_recover_media::image( $atts['image']['url'], $width, $height, true, $hd, $hd_url, filter_var( $atts['lazy_load'], FILTER_VALIDATE_BOOLEAN ), $img_classes, $img_attributes );

if( $atts['link'] <> '' || $is_lightbox ) {
	echo '</a>';
}