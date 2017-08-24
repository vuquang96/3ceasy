<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'items' => array(
		'title' => esc_html__( 'Frequently Asked Questions', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'FAQ', 'wplab-recover' ),
				'popup-title'   => esc_html__( 'Add/Edit FAQ', 'wplab-recover' ),
				'desc'          => esc_html__( 'Add FAQ', 'wplab-recover' ),
				'template'      => '{{=question}}',
				'popup-options' => array(
					'question' => array(
						'type'  => 'textarea',
						'label' => esc_html__('Question', 'wplab-recover')
					),
					'answer' => array(
						'type'  => 'wp-editor',
						'label' => esc_html__('Answer', 'wplab-recover'),
						'reinit' => true
					),
				),
			),
		)
	),
	'style' => array(
		'label' => esc_html__( 'Style', 'wplab-recover' ),
		'type' => 'select',
		'value' => '',
		'choices' => array(
			'default' => esc_html__('Default', 'wplab-recover'),
			'corporate' => esc_html__('Corporate', 'wplab-recover'),
		),
	),
	'answer_abbr' => array(
		'label' => esc_html__( 'Answer custom abbreviation (A)', 'wplab-recover' ),
		'type' => 'text',
		'value' => 'A',
	),
	'question_abbr' => array(
		'label' => esc_html__( 'Question custom abbreviation (Q)', 'wplab-recover' ),
		'type' => 'text',
		'value' => 'Q',
	),
);