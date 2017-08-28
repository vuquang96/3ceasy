<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'projects_num' => array(
				'type'  => 'text',
				'label' => esc_html__('Number of completed projects', 'wplab-recover')
			),
			'bg_image' => array(
				'label' => esc_html__( 'Background image for completed projects', 'wplab-recover' ),
				'type' => 'upload',
				'images_only' => true,
			),
			'title' => array(
				'type'  => 'text',
				'label' => esc_html__('Block title', 'wplab-recover')
			),
			'text' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Text after title', 'wplab-recover')
			),
			'cta_text' => array(
				'type'  => 'text',
				'label' => esc_html__('Call to action text', 'wplab-recover')
			),
			'cta_button_title' => array(
				'type'  => 'text',
				'label' => esc_html__('CTA button title', 'wplab-recover')
			),
			'cta_button_url' => array(
				'type'  => 'text',
				'label' => esc_html__('CTA button URL', 'wplab-recover')
			),
		
		)
	),
);