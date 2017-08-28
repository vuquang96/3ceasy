<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Numeric Block', 'wplab-recover' ),
	'description' => esc_html__( 'Add a numeric block with description', 'wplab-recover' ),
	'tab'         => esc_html__( 'Theme Elements', 'wplab-recover' ),
);