<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'toggles' => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Toggles', 'wplab-recover' ),
		'popup-title'   => esc_html__( 'Add/Edit Toggle', 'wplab-recover' ),
		'desc'          => esc_html__( 'Create your toggles', 'wplab-recover' ),
		'template'      => '{{=title}}',
		'popup-options' => array(
			'title'   => array(
				'type'  => 'text',
				'label' => esc_html__('Title', 'wplab-recover')
			),
			'content' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Content', 'wplab-recover')
			)
		)
	),
	'style' => array(
		'label' => esc_html__( 'Style', 'wplab-recover' ),
		'type' => 'select',
		'value' => '',
		'choices' => array(
			'big_font' => esc_html__( 'Big font', 'wplab-recover' ),
			'small_font' => esc_html__( 'Small font', 'wplab-recover' ),
		),
	),
);