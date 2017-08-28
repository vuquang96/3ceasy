<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'id' => array( 'type' => 'unique' ),
	'list_content' => array(
		'title' => esc_html__( 'List Content', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'list_style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'style' => 'ol',
				),
				'picker' => array(
					'style' => array(
						'label' => esc_html__( 'List type', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'ol' => esc_html__( 'Ordered list', 'wplab-recover' ),
							'ul' => esc_html__( 'Unordered list', 'wplab-recover' ),
							'iconic' => esc_html__( 'Iconic list', 'wplab-recover' ),
							'dl' => esc_html__( 'Description list', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					'ol' => array(
		
						'ol_items' => array(
							'type'          => 'addable-popup',
							'label'         => esc_html__( 'Ordered List content', 'wplab-recover' ),
							'popup-title'   => esc_html__( 'Add/Edit list elements', 'wplab-recover' ),
							'desc'          => esc_html__( 'Add list elements', 'wplab-recover' ),
							'template'      => '{{=title}}',
							'popup-options' => array(
								'title' => array(
									'type'  => 'text',
									'label' => esc_html__('Title', 'wplab-recover')
								),
							),
						),
		
					),
					'ul' => array(
		
						'ul_items' => array(
							'type'          => 'addable-popup',
							'label'         => esc_html__( 'Unordered List content', 'wplab-recover' ),
							'popup-title'   => esc_html__( 'Add/Edit list elements', 'wplab-recover' ),
							'desc'          => esc_html__( 'Add list elements', 'wplab-recover' ),
							'template'      => '{{=title}}',
							'popup-options' => array(
								'title' => array(
									'type'  => 'text',
									'label' => esc_html__('Title', 'wplab-recover')
								),
							),
						),
		
					),
					'iconic' => array(
		
						'iconic_items' => array(
							'type'          => 'addable-popup',
							'label'         => esc_html__( 'Iconic List content', 'wplab-recover' ),
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
							),
						),
		
					),
					'dl' => array(
		
						'dl_items' => array(
							'type'          => 'addable-popup',
							'label'         => esc_html__( 'Definition List content', 'wplab-recover' ),
							'popup-title'   => esc_html__( 'Add/Edit list elements', 'wplab-recover' ),
							'desc'          => esc_html__( 'Add list elements', 'wplab-recover' ),
							'template'      => '{{=title}}',
							'popup-options' => array(
								'title' => array(
									'type'  => 'text',
									'label' => esc_html__('Title', 'wplab-recover')
								),
								'text' => array(
									'type'  => 'textarea',
									'label' => esc_html__('Definition', 'wplab-recover')
								),
							),
						),
						
						'dl_style' => array(
							'label' => esc_html__( 'Definition List Style', 'wplab-recover' ),
							'type' => 'select',
							'value' => '',
							'choices' => array(
								'default' => esc_html__( 'Default', 'wplab-recover' ),
								'boxed' => esc_html__( 'Boxed', 'wplab-recover' )
							),
						),
		
					),
				),
				'show_borders' => false,
			),
		)
	),
	'styling' => array(
		'title' => esc_html__( 'Styling', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'text_color' => array(
				'label' => esc_html__('Text Color', 'wplab-recover'),
				'type' => 'color-picker',
			),
			'dl_text_color' => array(
				'label' => esc_html__('Definition Text Color', 'wplab-recover'),
				'type' => 'color-picker',
			),
			'icon_color' => array(
				'label' => esc_html__('Bullets / Icons Color', 'wplab-recover'),
				'type' => 'color-picker',
			),
			'dl_background_color' => array(
				'label' => esc_html__('DL background color', 'wplab-recover'),
				'type' => 'color-picker',
				'desc' => esc_html__( 'Only for Boxed Definition List style', 'wplab-recover' ),
			),
			'dl_separator_color' => array(
				'label' => esc_html__('DL separator color', 'wplab-recover'),
				'type' => 'color-picker',
				'desc' => esc_html__( 'Only for Boxed Definition List style', 'wplab-recover' ),
			),
			'margins' => array(
				'label' => esc_html__( 'List Margins', 'wplab-recover' ),
				'type' => 'stylebox',
				'value' => '',
				'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
			),
			'paddings' => array(
				'label' => esc_html__( 'List Paddings', 'wplab-recover' ),
				'type' => 'stylebox',
				'value' => '',
				'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
			),
		)
	),

);