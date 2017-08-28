<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'number'   => array(
					'label' => esc_html__( 'Number', 'wplab-recover' ),
					'type'  => 'text',
					'value' => '01'
				),
				'title'   => array(
					'label' => esc_html__( 'Title', 'wplab-recover' ),
					'type'  => 'text',
					'value' => ''
				),
				'text'   => array(
					'label' => esc_html__( 'Text', 'wplab-recover' ),
					'type'  => 'textarea',
					'value' => ''
				),
				
			)
		),
	)

);