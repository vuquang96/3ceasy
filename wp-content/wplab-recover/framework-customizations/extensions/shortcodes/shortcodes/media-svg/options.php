<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_recover_core;

$options = array(
	array(
		'id' => array( 'type' => 'unique' ),
		'attributes' => array(
			'title' => esc_html__( 'Icon', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'icon' => array(
					'type'  => 'upload',
					'label' => esc_html__( 'Choose SVG Icon', 'wplab-recover' ),
					'desc'  => esc_html__( 'Either upload a new, or choose an existing icon from your media library', 'wplab-recover' )
				),
				'size' => array(
					'type'    => 'group',
					'options' => array(
						'width'  => array(
							'type'  => 'text',
							'label' => esc_html__( 'Width', 'wplab-recover' ),
							'desc'  => esc_html__( 'Set icon width', 'wplab-recover' ),
							'value' => 70
						),
						'height' => array(
							'type'  => 'text',
							'label' => esc_html__( 'Height', 'wplab-recover' ),
							'desc'  => esc_html__( 'Set icon height', 'wplab-recover' ),
							'value' => 70
						)
					)
				),
			
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'color' => array(
					'label' => esc_html__('Icon Color', 'wplab-recover'),
					'desc' => esc_html__('Select the custom icon color', 'wplab-recover'),
					'type' => 'color-picker',
				),
			
				'icon_align' => array(
					'label' => esc_html__( 'Icon Align', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'' => esc_html__( 'Default', 'wplab-recover' ),
						'alignleft' => esc_html__( 'Left', 'wplab-recover' ),
						'aligncenter' => esc_html__( 'Center', 'wplab-recover' ),
						'alignright' => esc_html__( 'Right', 'wplab-recover' ),
					),
				),
				'animation' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Animate icon?', 'wplab-recover' ),
							'desc' => esc_html__('Using CSS animation', 'wplab-recover'),
							'type' => 'switch',
							'right-choice' => array(
								'value' => 'true',
								'label' => esc_html__( 'Yes', 'wplab-recover' )
							),
							'left-choice' => array(
								'value' => 'false',
								'color' => '#ccc',
								'label' => esc_html__( 'No', 'wplab-recover' )
							),
							'value' => 'false',
						)
					),
					'choices' => array(
						'true' => array(

							'effect' => array(
								'label' => esc_html__( 'Choose animation effect', 'wplab-recover' ),
								'type' => 'select',
								'value' => '',
								'choices' => array(
									array (
										'attr' => array(
											'label' => esc_html__( 'Animate.css Library', 'wplab-recover' ),
										),
										'choices' => $wplab_recover_core->cfg['animations'],
									),
								),
							),

							'animation_delay' => array(
								'label' => esc_html__('Animation delay', 'wplab-recover'),
								'desc' => esc_html__('For example: 0.3s', 'wplab-recover'),
								'type' => 'text',
							),

						),
					),
					'show_borders' => false,
				),
				'margins' => array(
					'label' => esc_html__( 'Icon Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
			
			)
		)
	)
);
