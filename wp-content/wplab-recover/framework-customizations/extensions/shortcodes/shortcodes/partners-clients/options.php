<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'items' => array(
		'title' => esc_html__( 'Partners / Clients', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'Partners / Clients', 'wplab-recover' ),
				'popup-title'   => esc_html__( 'Add/Edit Partners / Clients', 'wplab-recover' ),
				'desc'          => esc_html__( 'Add Partner / Client', 'wplab-recover' ),
				'template'      => '{{=title}}',
				'popup-options' => array(
					'title' => array(
						'type'  => 'text',
						'label' => esc_html__('Title', 'wplab-recover')
					),
					'text' => array(
						'type'  => 'textarea',
						'label' => esc_html__('Text', 'wplab-recover')
					),
					'logo' => array(
						'label' => esc_html__( 'Partner / Client Logo', 'wplab-recover' ),
						'type' => 'upload',
						'images_only' => true,
					),
					'logo_2x' => array(
						'label' => esc_html__( 'Partner / Client Logo for Retina Displays', 'wplab-recover' ),
						'desc' => esc_html__( 'Upload custom logo for Retina Displays (optional)', 'wplab-recover' ),
						'type' => 'upload',
						'images_only' => true,
					),
					'url' => array(
						'type'  => 'text',
						'label' => esc_html__('Website URL', 'wplab-recover')
					),
				),
			),
		)
	),
);