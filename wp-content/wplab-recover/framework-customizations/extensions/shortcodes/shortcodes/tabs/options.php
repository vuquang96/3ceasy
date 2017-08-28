<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	array(
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
				'tabs' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Tabs', 'wplab-recover' ),
					'popup-title'   => esc_html__( 'Add/Edit Tab', 'wplab-recover' ),
					'desc'          => esc_html__( 'Create your tabs', 'wplab-recover' ),
					'template'      => '{{=tab_title}}',
					'popup-options' => array(
						'tab_title' => array(
							'type'  => 'text',
							'label' => esc_html__('Title', 'wplab-recover')
						),
						'tab_content' => array(
							'type'  => 'wp-editor',
							'label' => esc_html__('Content', 'wplab-recover'),
							'reinit' => true
						),
						'tab_icon_type' => array(
							'type' => 'multi-picker',
							'label' => false,
							'desc' => false,
							'value' => array(
								'tab_icon' => '',
							),
							'picker' => array(
								'tab_icon' => array(
									'label' => esc_html__( 'Tab icon', 'wplab-recover' ),
									'type' => 'radio',
									'choices' => array(
										'' => esc_html__( 'Without Icon', 'wplab-recover' ),
										'fontawesome' => esc_html__( 'Choose an icon from Font Awesome library', 'wplab-recover' ),
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
							)
						),
					),
				),
				'tabs_type' => array(
					'label' => esc_html__( 'Tabs type', 'wplab-recover' ),
					'type' => 'select',
					'value' => 'horizontal',
					'choices' => array(
						'horizontal' => esc_html__( 'Horizontal', 'wplab-recover' ),
						'vertical' => esc_html__( 'Vertical', 'wplab-recover' ),
					),
				),
				'responsive_break' => array(
					'label' => esc_html__('Responsive at', 'wplab-recover'),
					'desc' => esc_html__('For example: 767. If screen size will be less than this number, tabs will be turned into accordion', 'wplab-recover'),
					'type' => 'text',
				),
			)
		),
	)

);