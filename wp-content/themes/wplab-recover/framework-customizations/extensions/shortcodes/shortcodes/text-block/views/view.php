<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<?php

	$dropcap = filter_var( $atts['dropcap']['enabled'], FILTER_VALIDATE_BOOLEAN );

	if( $dropcap ) {
		echo '<div class="dropcap style-' . esc_attr( $atts['dropcap']['true']['style'] ) . '">';
	}

	echo do_shortcode( $atts['text'] );
	
	if( $dropcap ) {
		echo '</div>';
	}