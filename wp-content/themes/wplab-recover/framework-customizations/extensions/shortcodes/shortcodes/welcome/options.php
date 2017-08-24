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
					'label'         => esc_html__( 'Add Blocks', 'wplab-recover' ),
					'popup-title'   => esc_html__( 'Add/Edit Welcome Block', 'wplab-recover' ),
					'desc'          => esc_html__( '3 blocks maximum allowed', 'wplab-recover' ),
					'template'      => '{{=title}}',
					'limit' 				=> 3,
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
						'icon_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'value' => array(
								'welcome_icon' => '',
							),
							'picker' => array(
								'welcome_icon' => array(
									'label' => esc_html__( 'Block icon', 'wplab-recover' ),
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
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'block1_bg' => array(
					'label' => esc_html__('First block background color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'block1_color' => array(
					'label' => esc_html__('First block text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				
				'block2_bg' => array(
					'label' => esc_html__('Second block background color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'block2_color' => array(
					'label' => esc_html__('Second block text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				
				'block3_bg' => array(
					'label' => esc_html__('Third block background color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'block3_color' => array(
					'label' => esc_html__('Third block text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
			
			)
		)
	)

);