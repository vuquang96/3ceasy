<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'id' => array( 'type' => 'unique' ),
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'images' => array(
					'type' => 'multi-upload',
					'label' => esc_html__('Images', 'wplab-recover'),
					'images_only' => true,
				),
				'columns' => array(
					'label' => esc_html__( 'Columns', 'wplab-recover' ),
					'type' => 'select',
					'value' => 'repeat',
					'choices' => array(
						'2' => esc_html__( '2 Columns', 'wplab-recover' ),
						'3' => esc_html__( '3 Columns', 'wplab-recover' ),
						'4' => esc_html__( '4 Columns', 'wplab-recover' ),
					),
				),
				
			)
		),
	)

);