<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'id' => array( 'type' => 'unique' ),
	'list_content' => array(
		'title' => esc_html__( 'List Content', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'items' => array(
				'type'          => 'addable-popup',
				'label'         => esc_html__( 'List content', 'wplab-recover' ),
				'popup-title'   => esc_html__( 'Add/Edit list elements', 'wplab-recover' ),
				'desc'          => esc_html__( 'Add list elements', 'wplab-recover' ),
				'template'      => '{{=title}}',
				'popup-options' => array(
					'icon_type' => array(
						'type' => 'multi-picker',
						'label' => false,
						'desc' => false,
						'value' => array(
							'type' => 'library',
						),
						'picker' => array(
							'type' => array(
								'label' => esc_html__( 'Icon Type', 'wplab-recover' ),
								'type' => 'radio',
								'choices' => array(
									'library' => esc_html__( 'Choose from Icon Library', 'wplab-recover' ),
									'custom' => esc_html__( 'Custom SVG Icon', 'wplab-recover' ),
								),
							)
						),
						'choices' => array(
							'library' => array(
							
								'icon' => array(
									'type'  => 'icon',
									'value' => 'fa-trophy',
									'label' => esc_html__('Icon', 'wplab-recover'),
								)
							
							),
							'custom' => array(
							
								'icon' => array(
								  'type'  => 'upload',
								  'label' => esc_html__('Upload icon file', 'wplab-recover'),
								  'images_only' => true,
								),
							
							),
						)
					),
					'title' => array(
						'type'  => 'text',
						'label' => esc_html__('Title', 'wplab-recover')
					),
					'description' => array(
						'type'  => 'text',
						'label' => esc_html__('Description', 'wplab-recover')
					),
				),
			),
			'style' => array(
				'label' => esc_html__( 'Output style', 'wplab-recover' ),
				'type' => 'select',
				'value' => 'repeat',
				'choices' => array(
					'vertical' => esc_html__( 'Vertical list', 'wplab-recover' ),
					'horizontal' => esc_html__( 'Horizontal list', 'wplab-recover' ),
				),
			),
		)
	),

);