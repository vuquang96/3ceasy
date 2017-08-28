<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Raw HTML', 'wplab-recover' ),
	'description' => esc_html__( 'Add custom HTML / JavaScript / CSS code', 'wplab-recover' ),
	'tab'         => esc_html__( 'Content Elements', 'wplab-recover' ),
	'popup_size' 	=> 'large',
);
