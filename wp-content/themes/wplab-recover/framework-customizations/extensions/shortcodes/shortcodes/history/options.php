<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'items' => array(
		'title' => esc_html__( 'Timeline', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'Timeline', 'wplab-recover' ),
				'popup-title'   => esc_html__( 'Add/Edit Timeline Elements', 'wplab-recover' ),
				'desc'          => esc_html__( 'Add Timeline Element', 'wplab-recover' ),
				'template'      => '{{=year}}',
				'popup-options' => array(
					'year' => array(
						'type'  => 'text',
						'label' => esc_html__('Year', 'wplab-recover')
					),
					'title' => array(
						'type'  => 'text',
						'label' => esc_html__('Title', 'wplab-recover')
					),
					'text' => array(
						'type'  => 'textarea',
						'label' => esc_html__('Text', 'wplab-recover')
					),
				),
			),
		)
	),
);