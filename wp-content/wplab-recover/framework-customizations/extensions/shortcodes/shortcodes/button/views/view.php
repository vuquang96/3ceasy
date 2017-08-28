<?php
// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_classes = $atttibutes = array();

$css_classes[] = 'button';

if( isset( $atts['custom_classes'] ) && $atts['custom_classes'] <> '' ) {
	$css_classes[] = esc_attr( $atts['custom_classes'] );
}

/**
 * Custom ID
 **/
if( isset( $atts['button_id'] ) && $atts['button_id'] <> '' ) {
	$atttibutes[] = 'id="' . esc_attr( $atts['button_id'] ) . '"';
} else {
	$atttibutes[] = 'id="shortcode-' . esc_attr( $atts['id'] ) . '"';
}

/**
 * Link href
 **/
if( isset( $atts['link'] ) && $atts['link'] <> '' ) {
	$atttibutes[] = 'href="' . esc_attr( $atts['link'] ) . '"';
}

/**
 * Custom target
 **/
if( isset( $atts['target'] ) && $atts['target'] <> '' ) {
	$atttibutes[] = 'target="' . esc_attr( $atts['target'] ) . '"';
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
 * Button icon
 **/
$icon = isset( $atts['icon'] ) && $atts['icon'] <> '' ? '<i class="button-icon fa ' . esc_attr( $atts['icon'] ) . '"></i>' : '';

/**
 * Button style
 **/
if( isset( $atts['style'] ) && $atts['style'] <> '' ) {
	$css_classes[] = 'style-' . esc_attr( $atts['style'] );
	
	if( strpos( $atts['style'], 'link' ) !== false && $atts['border_direction'] <> '' ) {
		$css_classes[] = $atts['border_direction'];
	}
	
	if( strpos( $atts['style'], 'poly' ) !== false && $atts['poly_direction'] <> '' ) {
		$css_classes[] = $atts['poly_direction'];
	}
	
}

/**
 * Button size
 **/
if( isset( $atts['size'] ) && $atts['size'] <> '' ) {
	$css_classes[] = 'size-' . esc_attr( $atts['size'] );
}

/**
 * Button label
 **/
$label = isset( $atts['label'] ) && $atts['label'] <> '' ? esc_attr( $atts['label'] ) : '';

if( $label <> '' ) {
	$css_classes = implode( ' ', $css_classes );
	$atttibutes = implode( ' ', $atttibutes );
	
	if( isset( $atts['align'] ) && $atts['align'] <> '' ) {
		echo '<div class="button-align-' . esc_attr( $atts['align'] ) . '">';
	}
	
	echo "<a {$atttibutes} class=\"{$css_classes}\">{$icon}{$label}</a>";
	
	if( isset( $atts['align'] ) && $atts['align'] <> '' ) {
		echo '</div>';
	}
	
}