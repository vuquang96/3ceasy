<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts
 */
$atttibutes = array();
$output = '';
$allowed_tags = wp_kses_allowed_html('post');

/** unique id **/
$atttibutes[] = 'id="shortcode-' . $atts['id'] . '"';

/**
 * Ordered list 
 **/
if( $atts['list_style']['style'] == 'ol' ) {
	$atttibutes[] = 'class="ol simple"';
	$output .= '<ol ' . implode(' ', $atttibutes ) . '>';
	
		$items = $atts['list_style']['ol']['ol_items'];
		
		if( is_array( $items ) && count( $items ) > 0 ) {
			
			foreach( $items as $item ) {
				$output .= '<li><span class="li-content">' . wp_kses( $item['title'], $allowed_tags ) . '</span></li>';
			}
			
		}
	
	$output .= '</ol>';
/**
 * Unordered list
 **/
} elseif( $atts['list_style']['style'] == 'ul' ) {
	$atttibutes[] = 'class="ul simple"';
	$output .= '<ul ' . implode(' ', $atttibutes ) . '>';
	
		$items = $atts['list_style']['ul']['ul_items'];
		
		if( is_array( $items ) && count( $items ) > 0 ) {
			
			foreach( $items as $item ) {
				$output .= '<li><span class="li-content">' . wp_kses( $item['title'], $allowed_tags ) . '</span></li>';
			}
			
		}
	
	$output .= '</ul>';
/**
 * Definition list
 **/
} elseif( $atts['list_style']['style'] == 'dl' ) {
	
	if( $atts['list_style']['dl']['dl_style'] == 'boxed' ) {
		$atttibutes[] = 'class="style-boxed"';
	}
	
	$output .= '<dl ' . implode(' ', $atttibutes ) . '>';
	
		$items = $atts['list_style']['dl']['dl_items'];
		
		if( is_array( $items ) && count( $items ) > 0 ) {
			
			foreach( $items as $item ) {
				$output .= '<dt>' . wp_kses( $item['title'], $allowed_tags ) . '</dt>';
				$output .= '<dd>' . wp_kses( $item['text'], $allowed_tags ) . '</dd>';
			}
			
		}
	
	$output .= '</dl>';
/**
 * Iconic list
 **/
} elseif( $atts['list_style']['style'] == 'iconic' ) {
	$output .= '<ul ' . implode(' ', $atttibutes ) . ' class="iconic">';
	
		$items = $atts['list_style']['iconic']['iconic_items'];
		
		if( is_array( $items ) && count( $items ) > 0 ) {
			
			foreach( $items as $item ) {
				
				$icon = '';
				
				if( $item['icon_type']['type'] == 'library' ) {
					$icon = '<i class="icon ' . esc_attr( $item['icon_type']['library']['icon'] ) . '"></i>';
				} elseif( $item['icon_type']['type'] == 'custom' ) {
					echo '<img src="' . esc_attr( $item['icon_type']['custom']['icon']['url'] ) . '" class="image-svg" alt="" />';
				}
				
				$output .= '<li><span class="li-content">' . $icon . ' ' . wp_kses( $item['title'], $allowed_tags ) . '</span></li>';
			}
			
		}
	
	$output .= '</ul>';
}

echo do_shortcode( $output );