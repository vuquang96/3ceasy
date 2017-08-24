<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_recover_core;

$options = array(
	array(
		'id' => array( 'type' => 'unique' ),
		'attributes' => array(
			'title' => esc_html__( 'Image', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'image' => array(
					'type'  => 'upload',
					'label' => esc_html__( 'Choose Image', 'wplab-recover' ),
					'desc'  => esc_html__( 'Either upload a new, or choose an existing image from your media library', 'wplab-recover' )
				),
				'image_2x' => array(
					'type'  => 'upload',
					'label' => esc_html__( 'Choose Image for Retina Displays', 'wplab-recover' ),
					'desc'  => esc_html__( 'It should has a twiced size, e.g. twiced size for 200x150 image is 400x300', 'wplab-recover' )
				),
				'size' => array(
					'type'    => 'group',
					'options' => array(
						'width'  => array(
							'type'  => 'text',
							'label' => esc_html__( 'Width', 'wplab-recover' ),
							'desc'  => esc_html__( 'Set image width', 'wplab-recover' ),
							'value' => 300
						),
						'height' => array(
							'type'  => 'text',
							'label' => esc_html__( 'Height', 'wplab-recover' ),
							'desc'  => esc_html__( 'Set image height', 'wplab-recover' ),
							'value' => 200
						)
					)
				),
			
			)
		),
		'image_settings' => array(
			'title' => esc_html__( 'Options', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'lazy_load' => array(
					'type'         => 'switch',
					'label'        => esc_html__( 'Lazy Load', 'wplab-recover' ),
					'desc'         => esc_html__( 'If enabled, image will be loaded via JavaScript to increase page loading speed', 'wplab-recover' ),
					'value'				 => 'false',
					'right-choice' => array(
						'value' => 'true',
						'label' => esc_html__( 'Enabled', 'wplab-recover' ),
					),
					'left-choice'  => array(
						'value' => 'false',
						'color' => '#ccc',
						'label' => esc_html__( 'Disabled', 'wplab-recover' ),
					),
				),
				
				'image-link-group' => array(
					'type'    => 'group',
					'options' => array(
						'link'   => array(
							'type'  => 'text',
							'label' => esc_html__( 'Image Link', 'wplab-recover' ),
							'desc'  => esc_html__( 'Where should your image link to?', 'wplab-recover' )
						),
						'target' => array(
							'type'         => 'switch',
							'label'        => esc_html__( 'Open Link in New Window', 'wplab-recover' ),
							'desc'         => esc_html__( 'Select here if you want to open the linked page in a new window', 'wplab-recover' ),
							'right-choice' => array(
								'value' => '_blank',
								'label' => esc_html__( 'Yes', 'wplab-recover' ),
							),
							'left-choice'  => array(
								'value' => '_self',
								'label' => esc_html__( 'No', 'wplab-recover' ),
							),
						),
						'lightbox' => array(
							'type'         => 'switch',
							'label'        => esc_html__( 'Open in lightbox?', 'wplab-recover' ),
							'desc'         => esc_html__( 'If Image Link is empty, full image will be opened in a lightbox', 'wplab-recover' ),
							'value'				 => 'false',
							'right-choice' => array(
								'value' => 'true',
								'label' => esc_html__( 'Yes', 'wplab-recover' ),
							),
							'left-choice'  => array(
								'value' => 'false',
								'color' => '#ccc',
								'label' => esc_html__( 'No', 'wplab-recover' ),
							),
						),
					)
				)
			
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'image_align' => array(
					'label' => esc_html__( 'Image Align', 'wplab-recover' ),
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
							'label' => esc_html__( 'Animate image?', 'wplab-recover' ),
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
					'label' => esc_html__( 'Image Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings' => array(
					'label' => esc_html__( 'Image Paddings', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'border_color' => array(
					'label' => esc_html__('Border Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'border_style' => array(
					'label' => esc_html__( 'Border Style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'none' => esc_html__( 'None', 'wplab-recover' ),
						'hidden' => esc_html__( 'Hidden', 'wplab-recover' ),
						'dotted' => esc_html__( 'Dotted', 'wplab-recover' ),
						'dashed' => esc_html__( 'Dashed', 'wplab-recover' ),
						'solid' => esc_html__( 'Solid', 'wplab-recover' ),
						'double' => esc_html__( 'Double', 'wplab-recover' ),
						'groove' => esc_html__( 'Groove', 'wplab-recover' ),
						'ridge' => esc_html__( 'Ridge', 'wplab-recover' ),
					),
				),
				'border_width' => array(
					'label' => esc_html__( 'Border width', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'border_radius' => array(
					'label' => esc_html__( 'Border radius', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top left, top right, bottom right, bottom left', 'wplab-recover' ),
				),
				
				'css_shadow' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Add CSS shadow?', 'wplab-recover' ),
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
						
							'shadow_color' => array(
								'label' => esc_html__('Shadow Color', 'wplab-recover'),
								'type' => 'color-picker',
							),
							'shadow_type' => array(
								'label' => esc_html__( 'Position', 'wplab-recover' ),
								'type' => 'switch',
								'right-choice' => array(
									'value' => 'outside',
									'label' => esc_html__( 'Outside', 'wplab-recover' )
								),
								'left-choice' => array(
									'value' => 'inside',
									'label' => esc_html__( 'Inside', 'wplab-recover' )
								),
								'value' => 'outside',
							),
							'shadow_blur_radius' => array(
						    'type'  => 'slider',
						    'value' => 0,
						    'properties' => array(
					        'min' => 0,
					        'max' => 300,
						    ),
						    'label' => esc_html__( 'Blur Radius', 'wplab-recover' ),
							),
							'shadow_spread_radius' => array(
						    'type'  => 'slider',
						    'value' => 0,
						    'properties' => array(
					        'min' => -200,
					        'max' => 200,
						    ),
						    'label' => esc_html__( 'Spread Radius', 'wplab-recover' ),
							),
							'shadow_horizontal_length' => array(
						    'type'  => 'slider',
						    'value' => 0,
						    'properties' => array(
					        'min' => -200,
					        'max' => 200,
						    ),
						    'label' => esc_html__( 'Horizontal Length', 'wplab-recover' ),
							),
							'shadow_vertical_length' => array(
						    'type'  => 'slider',
						    'value' => 0,
						    'properties' => array(
					        'min' => -200,
					        'max' => 200,
						    ),
						    'label' => esc_html__( 'Vertical Length', 'wplab-recover' ),
							),
						
						),
					)
				),
			
			)
		)
	)
);
