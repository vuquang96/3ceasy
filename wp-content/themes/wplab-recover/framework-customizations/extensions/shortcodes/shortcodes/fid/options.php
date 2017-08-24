<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'number' => array(
				'type'  => 'text',
				'label' => esc_html__('Number', 'wplab-recover')
			),
			'title' => array(
				'type'  => 'text',
				'label' => esc_html__('Title', 'wplab-recover')
			),
			'icon_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'fid_icon' => '',
				),
				'picker' => array(
					'fid_icon' => array(
						'label' => esc_html__( 'Icon', 'wplab-recover' ),
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
			
		)
	),
	'style' => array(
		'title' => esc_html__( 'Styling', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'accent_color' => array(
				'label' => esc_html__('Accent color', 'wplab-recover'),
				'type' => 'color-picker',
			),
			'digits_color' => array(
				'label' => esc_html__('Digits color', 'wplab-recover'),
				'type' => 'color-picker',
			),
			'title_color' => array(
				'label' => esc_html__('Digits color', 'wplab-recover'),
				'type' => 'color-picker',
			),
		
		)
	)

);