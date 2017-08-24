<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'html' => array(
		'type'   => 'textarea',
		'size' => 'large',
		'label'  => esc_html__( 'HTML Content', 'wplab-recover' ),
		'desc'   => esc_html__( 'Here you can add any HTML code into Page Builder', 'wplab-recover' )
	),
);
