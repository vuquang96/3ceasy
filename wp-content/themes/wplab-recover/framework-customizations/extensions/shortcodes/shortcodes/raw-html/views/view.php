<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
?>
<?php

	echo trim( do_shortcode( $atts['html'] ) );