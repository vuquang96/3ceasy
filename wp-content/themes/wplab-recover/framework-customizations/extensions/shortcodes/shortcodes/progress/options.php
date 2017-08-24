<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'items' => array(
		'title' => esc_html__( 'Progress bars', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'Progress bars', 'wplab-recover' ),
				'popup-title'   => esc_html__( 'Add/Edit Progress bars', 'wplab-recover' ),
				'desc'          => esc_html__( 'Add Progress bar', 'wplab-recover' ),
				'template'      => '{{=title}}',
				'popup-options' => array(
					'title' => array(
						'type'  => 'text',
						'label' => esc_html__('Title', 'wplab-recover')
					),
					'value' => array(
				    'type'  => 'slider',
				    'value' => 50,
				    'properties' => array(
			        'min' => 0,
			        'max' => 100,
				    ),
					),
				),
			),
		)
	),
	'animate' => array(
		'label' => esc_html__( 'Animate progress bars', 'wplab-recover' ),
		'type' => 'switch',
		'left-choice' => array(
			'value' => 'false',
			'color' => '#ccc',
			'label' => esc_html__( 'No', 'wplab-recover' )
		),
		'right-choice' => array(
			'value' => 'true',
			'label' => esc_html__( 'Yes', 'wplab-recover' )
		),
		'value' => 'true',
	),
);