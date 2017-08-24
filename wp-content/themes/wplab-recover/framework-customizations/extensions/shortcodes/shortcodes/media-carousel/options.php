<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'images' => array(
					'type' => 'multi-upload',
					'label' => esc_html__('Images', 'wplab-recover'),
					'images_only' => true,
				),
				
			)
		),
	)

);