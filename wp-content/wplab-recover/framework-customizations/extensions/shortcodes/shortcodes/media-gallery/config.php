<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => esc_html__( 'Grid Gallery', 'wplab-recover' ),
	'description' => esc_html__( 'Add Images Gallery', 'wplab-recover' ),
	'tab'         => esc_html__( 'Media Elements', 'wplab-recover' ),
);