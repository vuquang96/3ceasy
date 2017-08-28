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
				'items' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Benefits', 'wplab-recover' ),
					'popup-title'   => esc_html__( 'Add/Edit Benefit', 'wplab-recover' ),
					'desc'          => esc_html__( 'Create your benefits', 'wplab-recover' ),
					'template'      => '{{=title}}',
					'popup-options' => array(
						'title' => array(
							'type'  => 'text',
							'label' => esc_html__('Title', 'wplab-recover')
						),
						'desc' => array(
							'type'  => 'textarea',
							'label' => esc_html__('Description', 'wplab-recover'),
							'reinit' => true
						),
						'link' => array(
							'type'  => 'text',
							'label' => esc_html__('Link (optional)', 'wplab-recover'),
							'reinit' => true
						),
						'icon_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'value' => array(
								'benefit_icon' => '',
							),
							'picker' => array(
								'benefit_icon' => array(
									'label' => esc_html__( 'Benefit icon', 'wplab-recover' ),
									'type' => 'radio',
									'choices' => array(
										'' => esc_html__( 'Without Icon', 'wplab-recover' ),
										'fontawesome' => esc_html__( 'Choose an icon from Font Awesome library', 'wplab-recover' ),
										'custom' => esc_html__( 'Upload custom Image icon', 'wplab-recover' ),
									),
								)
							),
							'choices' => array(
								'fontawesome' => array(
								
									'icon' => array(
										'type' => 'icon',
										'label' => esc_html__( 'Icon', 'wplab-recover' )
									),
								
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
					),
				),
				'style' => array(
					'label' => esc_html__( 'Block style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'2cols' => esc_html__('2 columns grid', 'wplab-recover'),
						'3cols' => esc_html__('3 columns grid', 'wplab-recover'),
						'3cols_alt' => esc_html__('3 columns grid, alt style', 'wplab-recover'),
						'3cols_third' => esc_html__('3 columns grid, third style', 'wplab-recover'),
						'3cols_fourth' => esc_html__('3 columns grid, fourth style', 'wplab-recover'),
						'3cols_photos' => esc_html__('3 columns photo', 'wplab-recover'),
						'3cols_fullwidth' => esc_html__('3 columns, full width', 'wplab-recover'),
						'3cols_corporate' => esc_html__('3 columns, corporate style', 'wplab-recover'),
						'3cols_corporate_alt' => esc_html__('3 columns, corporate (left icons) style', 'wplab-recover'),
						'3cols_corporate_second' => esc_html__('3 columns, corporate boxed style', 'wplab-recover'),
						'3cols_corporate_third' => esc_html__('3 columns, corporate (photos) style', 'wplab-recover'),
					),
				),
				'links_target' => array(
					'type'  => 'switch',
					'label'   => esc_html__( 'Open Links in New Window', 'wplab-recover' ),
					'desc'    => esc_html__( 'Select here if you want to open the linked benefits page in a new window', 'wplab-recover' ),
					'value' 	=> 'no',
					'right-choice' => array(
						'value' => 'true',
						'label' => esc_html__('Yes', 'wplab-recover'),
					),
					'left-choice' => array(
						'value' => 'false',
						'label' => esc_html__('No', 'wplab-recover'),
					),
				),
			)
		),
	)

);