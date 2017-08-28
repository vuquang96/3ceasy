<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'text' => array(
		'type'   => 'wp-editor',
		'teeny'  => false,
		'reinit' => true,
		'label'  => esc_html__( 'Content', 'wplab-recover' ),
		'desc'   => esc_html__( 'Enter some content for this texblock', 'wplab-recover' )
	),
	'dropcap' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'picker' => array(
			'enabled' => array(
				'label' => esc_html__( 'Dropcap', 'wplab-recover' ),
				'desc' => esc_html__('This option stylish a first letter of first paragraph', 'wplab-recover'),
				'type' => 'switch',
				'right-choice' => array(
					'value' => 'true',
					'label' => esc_html__( 'Yes', 'wplab-recover' )
				),
				'left-choice' => array(
					'value' => 'false',
					'color' => '#ccc',
					'label' => esc_html__( 'No', 'wplab-recover' )
				),
				'value' => 'false',
			)
		),
		'choices' => array(
			'true' => array(

				'style' => array(
					'label' => esc_html__( 'Dropcap style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'default' => esc_html__('Default', 'wplab-recover'),
						'boxed' => esc_html__('Boxed', 'wplab-recover'),
					),
				),


			),
		),
		'show_borders' => false,
	),
);
