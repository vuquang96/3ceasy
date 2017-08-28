<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$uniqid = $atts['id'];
$allowed_tags = wp_kses_allowed_html( 'post' );

/**
 * @var $atts
 */

$css_classes = $atttibutes = array();

$title = $atts['title'];

/**
 * Custom CSS Classes
 **/
if( isset( $atts['custom_classes'] ) && $atts['custom_classes'] <> '' ) {
	$css_classes[] = esc_attr( $atts['custom_classes'] );
}

if( isset( $atts['header_line'] ) && filter_var( $atts['header_line'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'header-line';
	$title = '<span>' . $title . '</span>';
}

if( isset( $atts['header_angle'] ) && filter_var( $atts['header_angle'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'header-angle';
	$title = '<span class="angle"></span>' . $title . '';
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
 * Build a header
 **/
$css_classes = implode( ' ', $css_classes );
$atttibutes = implode( ' ', $atttibutes );

echo "<{$atts['heading']} id=\"shortcode-{$uniqid}\" class=\"{$css_classes}\" {$atttibutes}>{$title}</{$atts['heading']}>";