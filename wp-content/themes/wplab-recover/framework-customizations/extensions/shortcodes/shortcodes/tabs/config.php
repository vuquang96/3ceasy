<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Tabs', 'wplab-recover' ),
	'description' => esc_html__( 'Tabs Section', 'wplab-recover' ),
	'tab'         => esc_html__( 'Content Elements', 'wplab-recover' ),
);