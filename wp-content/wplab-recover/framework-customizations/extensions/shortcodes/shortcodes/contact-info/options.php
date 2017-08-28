<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'phones'   => array(
					'label' => esc_html__( 'Phones', 'wplab-recover' ),
					'type'  => 'textarea',
					'value' => ''
				),
				'address'   => array(
					'label' => esc_html__( 'Address', 'wplab-recover' ),
					'type'  => 'textarea',
					'value' => ''
				),
				'emails'   => array(
					'label' => esc_html__( 'Emails', 'wplab-recover' ),
					'type'  => 'textarea',
					'value' => ''
				),
				
			)
		),
	)

);