<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'photo' => array(
			  'type'  => 'upload',
			  'label' => esc_html__('Intro photo', 'wplab-recover'),
			  'images_only' => true,
			),
			'title' => array(
				'type'  => 'text',
				'label' => esc_html__('Title', 'wplab-recover')
			),
			'text' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Text', 'wplab-recover')
			),
		)
	),

);