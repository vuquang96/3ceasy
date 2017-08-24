<?php if (!defined('FW')) die('Forbidden');

$options = array(
	array(
		'id' => array( 'type' => 'unique' ),
		'general' => array(
			'title' => esc_html__( 'General', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'images' => array(
					'type'          => 'addable-popup',
					'label'         => esc_html__( 'Logos', 'wplab-recover' ),
					'popup-title'   => esc_html__( 'Add/Edit Logos', 'wplab-recover' ),
					'desc'          => esc_html__( 'Add Logo', 'wplab-recover' ),
					'template'      => '{{=url}}',
					'popup-options' => array(
						'logo' => array(
							'label' => esc_html__( 'Logo Image', 'wplab-recover' ),
							'type' => 'upload',
							'images_only' => true,
						),
						'url' => array(
							'type'  => 'text',
							'label' => esc_html__('Website URL', 'wplab-recover')
						),
					),
				),
				'columns' => array(
					'label' => esc_html__( 'Columns', 'wplab-recover' ),
					'type' => 'select',
					'value' => 'repeat',
					'choices' => array(
						'1' => esc_html__( '1 Column', 'wplab-recover' ),
						'2' => esc_html__( '2 Columns', 'wplab-recover' ),
						'3' => esc_html__( '3 Columns', 'wplab-recover' ),
						'4' => esc_html__( '4 Columns', 'wplab-recover' ),
					),
				),
				'opacity_effect' => array(
					'label' => esc_html__( 'Opacity Hover Effect', 'wplab-recover' ),
					'type' => 'switch',
					'left-choice' => array(
						'value' => 'false',
						'color' => '#ccc',
						'label' => esc_html__( 'Disabled', 'wplab-recover' )
					),
					'right-choice' => array(
						'value' => 'true',
						'label' => esc_html__( 'Enabled', 'wplab-recover' )
					),
					'value' => 'true',
				),
				'new_tab' => array(
					'label' => esc_html__( 'Open links at new tab', 'wplab-recover' ),
					'type' => 'switch',
					'left-choice' => array(
						'value' => 'false',
						'color' => '#ccc',
						'label' => esc_html__( 'No', 'wplab-recover' )
					),
					'right-choice' => array(
						'value' => 'true',
						'label' => esc_html__( 'Yes', 'wplab-recover' )
					),
					'value' => 'true',
				),
				
			)
		),
	)
);