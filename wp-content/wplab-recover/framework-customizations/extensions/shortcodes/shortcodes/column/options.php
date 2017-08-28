<?php 

global $wplab_recover_core;

$options = array(

	array(
		'id' => array( 'type' => 'unique' ),
		'attributes' => array(
			'title' => esc_html__( 'Attributes', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
				
				'section_class' => array(
					'label' => esc_html__('Custom CSS Classes', 'wplab-recover'),
					'type' => 'text',
					'desc' => esc_html__('For example: my-custom-class', 'wplab-recover'),
				),
			
			)
		),
		'bg_options' => array(
			'title' => esc_html__( 'Background', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(

				'bg_css_type' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'value' => array(
						'type' => 'color',
					),
					'picker' => array(
						'type' => array(
							'label' => esc_html__( 'Background CSS type', 'wplab-recover' ),
							'type' => 'radio',
							'choices' => array(
								'color' => esc_html__( 'Background color', 'wplab-recover' ),
								'gradient' => esc_html__( 'Gradient background', 'wplab-recover' ),
							),
						)
					),
					'choices' => array(
						'color' => array(
						
							'background_color' => array(
								'label' => esc_html__('Background Color', 'wplab-recover'),
								'desc' => esc_html__('Select the custom background color', 'wplab-recover'),
								'type' => 'color-picker',
							),
						
						),
						'gradient' => array(
						
							'background_gradient' => array(
							  'type'  => 'gradient',
							  'value' => array(
							    'primary'   => '#ffffff',
							    'secondary' => '#eeeeee',
							  ),
							  'label' => esc_html__('Gradient background', 'wplab-recover'),
							),
							'background_gradient_direction' => array(
								'label' => esc_html__( 'Gradient direction', 'wplab-recover' ),
								'type' => 'select',
								'value' => '',
								'choices' => array(
									'top_bottom' => esc_html__( 'Linear, From Top to Bottom', 'wplab-recover' ),
									'left_right' => esc_html__( 'Linear, From Left to Right', 'wplab-recover' ),
									'top_left_bottom_right' => esc_html__( 'Linear, From Left Top to Right Bottom', 'wplab-recover' ),
									'bottom_left_top_right' => esc_html__( 'Linear, From Left Bottom to Right Top', 'wplab-recover' ),
									'radial' => esc_html__( 'Radial', 'wplab-recover' ),
								),
							),
						
						),
					)
				),

				'background_image' => array(
					'label' => esc_html__('Background Image', 'wplab-recover'),
					'desc' => esc_html__('Upload the background image', 'wplab-recover'),
					'type' => 'background-image',
				),
				'background_lazy' => array(
					'label' => esc_html__('Lazy Load Background Image', 'wplab-recover'),
					'desc' => esc_html__('If enabled, background image will be loaded through JavaScript after text content', 'wplab-recover'),
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
				),
				'background_cover' => array(
					'label' => esc_html__('Cover Background Image', 'wplab-recover'),
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
				),
				'background_repeat' => array(
					'label' => esc_html__( 'Background image repeat', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'no-repeat' => esc_html__( 'No repeat', 'wplab-recover' ),
						'repeat-x' => esc_html__( 'Repeat horizontally', 'wplab-recover' ),
						'repeat-y' => esc_html__( 'Repeat vertically', 'wplab-recover' ),
						'repeat' => esc_html__( 'Repeat horizontally and vertically', 'wplab-recover' ),
					),
				),
				'background_position' => array(
					'label' => esc_html__( 'Background image position', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'left top' => esc_html__( 'Left Top', 'wplab-recover' ),
						'center top' => esc_html__( 'Center Top', 'wplab-recover' ),
						'right top' => esc_html__( 'Right Top', 'wplab-recover' ),
						'left bottom' => esc_html__( 'Left Bottom', 'wplab-recover' ),
						'center bottom' => esc_html__( 'Center Bottom', 'wplab-recover' ),
						'right bottom' => esc_html__( 'Right Bottom', 'wplab-recover' ),
						'left center' => esc_html__( 'Left Center', 'wplab-recover' ),
						'center center' => esc_html__( 'Center Center', 'wplab-recover' ),
						'right center' => esc_html__( 'Right Center', 'wplab-recover' ),
					),
				),
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
				
				'animation' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Animate this column?', 'wplab-recover' ),
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
					'label' => esc_html__( 'Column Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'margins_mobile' => array(
					'label' => esc_html__( 'Column Margins (for mobile devices)', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings' => array(
					'label' => esc_html__( 'Column Paddings', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings_mobile' => array(
					'label' => esc_html__( 'Column Paddings (for mobile devices)', 'wplab-recover' ),
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
							'label' => esc_html__( 'Add CSS box shadow?', 'wplab-recover' ),
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
		),

	),
	'responsiveness' => array(
		'title' => esc_html__( 'Responsiveness', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'hide_bg_large_screens' => array(
				'label' => esc_html__('Hide background image at large screens', 'wplab-recover'),
				'desc' => esc_html__('Background-color will be still visible', 'wplab-recover'),
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
			),
			'hide_bg_medium_screens' => array(
				'label' => esc_html__('Hide background image at medium screens', 'wplab-recover'),
				'desc' => esc_html__('Background-color will be still visible', 'wplab-recover'),
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
			),
			'hide_bg_small_screens' => array(
				'label' => esc_html__('Hide background image at small screens', 'wplab-recover'),
				'desc' => esc_html__('Background-color will be still visible', 'wplab-recover'),
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
			),
			'hide_bg_estra_small_screens' => array(
				'label' => esc_html__('Hide background image at extra small screens', 'wplab-recover'),
				'desc' => esc_html__('Background-color will be still visible', 'wplab-recover'),
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
			),
			'hide_lg' => array(
				'label' => esc_html__('Hide at Large Desktops', 'wplab-recover'),
				'desc' => esc_html__('Switch to Yes if you need to hide this column at large desktops (1200px and up)', 'wplab-recover'),
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
			),
			'hide_md' => array(
				'label' => esc_html__('Hide at Medium Devices', 'wplab-recover'),
				'desc' => esc_html__('Switch to Yes if you need to hide this section at Medium devices (desktops)', 'wplab-recover'),
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
			),
			'hide_sm' => array(
				'label' => esc_html__('Hide at Tablets', 'wplab-recover'),
				'desc' => esc_html__('Switch to Yes if you need to hide this section at Tablets (small screen size)', 'wplab-recover'),
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
			),
			'hide_xs' => array(
				'label' => esc_html__('Hide at Phones', 'wplab-recover'),
				'desc' => esc_html__('Switch to Yes if you need to hide this section at Phones (extra small screen size)', 'wplab-recover'),
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
			),
		
		)
	),

);