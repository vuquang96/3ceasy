<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_recover_core;

$options = array(
	array(
		'id' => array( 'type' => 'unique' ),
		'attributes' => array(
			'title' => esc_html__( 'Attributes', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
				'label'  => array(
					'label' => esc_html__( 'Button Label', 'wplab-recover' ),
					'desc'  => esc_html__( 'This is the text that appears on your button', 'wplab-recover' ),
					'type'  => 'text',
					'value' => 'Submit'
				),
				'link'   => array(
					'label' => esc_html__( 'Button Link', 'wplab-recover' ),
					'desc'  => esc_html__( 'Where should your button link to', 'wplab-recover' ),
					'type'  => 'text',
					'value' => '#'
				),
				'target' => array(
					'type'  => 'switch',
					'label'   => esc_html__( 'Open Link in New Window', 'wplab-recover' ),
					'desc'    => esc_html__( 'Select here if you want to open the linked page in a new window', 'wplab-recover' ),
					'right-choice' => array(
						'value' => '_blank',
						'label' => esc_html__('Yes', 'wplab-recover'),
					),
					'left-choice' => array(
						'value' => '_self',
						'label' => esc_html__('No', 'wplab-recover'),
					),
				),
				'button_id'  => array(
					'label' => esc_html__( 'Button ID', 'wplab-recover' ),
					'desc'  => esc_html__( 'Here you can set unique identifier for this button', 'wplab-recover' ),
					'type'  => 'text',
					'value' => ''
				),
				'custom_classes'  => array(
					'label' => esc_html__( 'Custom CSS classes', 'wplab-recover' ),
					'desc'  => esc_html__( 'For example: my-custom-class alignleft', 'wplab-recover' ),
					'type'  => 'text',
					'value' => ''
				),
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'style'  => array(
					'label'   => esc_html__( 'Button Style', 'wplab-recover' ),
					'desc'    => esc_html__( 'Here you can choose pre-defined styles for a button', 'wplab-recover' ),
					'type'    => 'select',
					'choices' => array(
					
						array (
							'attr' => array(
								'label' => esc_html__( 'Simple button styles', 'wplab-recover' ),
							),
							'choices' => array(
								'green simple'      	=> esc_html__( 'Green', 'wplab-recover' ),
								'black simple' 				=> esc_html__( 'Black', 'wplab-recover' ),
								'yellow simple' 			=> esc_html__( 'Yellow', 'wplab-recover' ),
								'grey simple' 				=> esc_html__( 'Grey', 'wplab-recover' ),
							),
						),
						array (
							'attr' => array(
								'label' => esc_html__( 'Polygon button styles', 'wplab-recover' ),
							),
							'choices' => array(
								'green poly'      		=> esc_html__( 'Green, with Polygon', 'wplab-recover' ),
								'black poly' 					=> esc_html__( 'Black, with Polygon', 'wplab-recover' ),
								'yellow poly' 				=> esc_html__( 'Yellow, with Polygon', 'wplab-recover' ),
								'grey poly' 					=> esc_html__( 'Grey, with Polygon', 'wplab-recover' ),
							),
						),
						array (
							'attr' => array(
								'label' => esc_html__( 'Stroke button styles', 'wplab-recover' ),
							),
							'choices' => array(
								'green stroke'      		=> esc_html__( 'Green stroke', 'wplab-recover' ),
								'black stroke' 					=> esc_html__( 'Black stroke', 'wplab-recover' ),
								'yellow stroke' 				=> esc_html__( 'Yellow stroke', 'wplab-recover' ),
								'grey stroke' 					=> esc_html__( 'Grey stroke', 'wplab-recover' ),
							),
						),
						array (
							'attr' => array(
								'label' => esc_html__( 'Link button styles', 'wplab-recover' ),
							),
							'choices' => array(
								'black link' 					=> esc_html__( 'Black', 'wplab-recover' ),
								'yellow link' 				=> esc_html__( 'Yellow', 'wplab-recover' ),
								'white link'      		=> esc_html__( 'White', 'wplab-recover' ),
							),
						),
						array (
							'attr' => array(
								'label' => esc_html__( 'Classic button styles', 'wplab-recover' ),
							),
							'choices' => array(
								'black classic' 					=> esc_html__( 'Black Classic', 'wplab-recover' ),
								'yellow classic' 					=> esc_html__( 'Yellow Classic', 'wplab-recover' ),
								'green classic'      			=> esc_html__( 'Green Classic', 'wplab-recover' ),
								'grey classic'      			=> esc_html__( 'Grey Classic', 'wplab-recover' ),
							),
						),
					)
				),
				'align'  => array(
					'label'   => esc_html__( 'Button Align', 'wplab-recover' ),
					'type'    => 'select',
					'choices' => array(
						''      => esc_html__('None', 'wplab-recover'),
						'left' => esc_html__( 'Left', 'wplab-recover' ),
						'center' => esc_html__( 'Center', 'wplab-recover' ),
						'right' => esc_html__( 'Right', 'wplab-recover' ),
					)
				),
				'size' => array(
					'label' => esc_html__( 'Button Size', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'medium' => esc_html__( 'Medium', 'wplab-recover' ),
						'small' => esc_html__( 'Small', 'wplab-recover' ),
						'large' => esc_html__( 'Large', 'wplab-recover' ),
						'xlarge' => esc_html__( 'X Large', 'wplab-recover' ),
					),
				),
				'icon' => array(
			    'type'  => 'icon',
			    'value' => '',
				),
				'animation' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Animate button?', 'wplab-recover' ),
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
			
			)
		),
		'customize' => array(
			'title' => esc_html__( 'Customize', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'background_color' => array(
					'label' => esc_html__('Background color', 'wplab-recover'),
					'desc' => esc_html__('Select the custom background color. Will be not applied for Link styles.', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'hover_background_color' => array(
					'label' => esc_html__('Hover background color', 'wplab-recover'),
					'desc' => esc_html__('Select the custom background color on mouse hover. Will be not applied for Link styles.', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'text_color' => array(
					'label' => esc_html__('Text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'hover_text_color' => array(
					'label' => esc_html__('Hover text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'border_color' => array(
					'label' => esc_html__('Border color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'hover_border_color' => array(
					'label' => esc_html__('Hover border color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'poly_direction' => array(
					'label' => esc_html__( 'Polygon direction', 'wplab-recover' ),
					'desc' => esc_html__( 'Only for Polygon Button Style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'right' => esc_html__( 'Right', 'wplab-recover' ),
						'left' => esc_html__( 'Left', 'wplab-recover' )
					),
				),
				'border_direction' => array(
					'label' => esc_html__( 'Border direction', 'wplab-recover' ),
					'desc' => esc_html__( 'Only for Link Button Style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'left' => esc_html__( 'Left', 'wplab-recover' ),
						'center' => esc_html__( 'Center', 'wplab-recover' ),
						'right' => esc_html__( 'Right', 'wplab-recover' )
					),
				),
				'border_style' => array(
					'label' => esc_html__( 'Border Style', 'wplab-recover' ),
					'desc' => esc_html__( 'Only for Boxed Button Style', 'wplab-recover' ),
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
					'desc' => esc_html__( 'Only for Boxed Button Style', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left. Only for Boxed Button Style.', 'wplab-recover' ),
				),
				'radius' => array(
					'label' => esc_html__( 'Border radius', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 5px 5px 5px 5px. Follow clockwise: top, right, bottom, left. Only for Boxed Button Style.', 'wplab-recover' ),
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
				'margins' => array(
					'label' => esc_html__( 'Button Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings' => array(
					'label' => esc_html__( 'Button Paddings', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'text_transform' => array(
					'type'    => 'select',
					'label'   => esc_html__('Text Transform', 'wplab-recover'),
					'value'		=> '',
					'choices' => array(
						'' => esc_html__('- Default -', 'wplab-recover'),
						'none' => esc_html__('None', 'wplab-recover'),
						'uppercase' => esc_html__('Uppercase', 'wplab-recover'),
					),
				),
				'font_style' => array(
					'type'    => 'select',
					'label'   => esc_html__('Font Style', 'wplab-recover'),
					'value'		=> '',
					'choices' => array(
						'' => esc_html__('- Default -', 'wplab-recover'),
						'normal' => esc_html__('Normal', 'wplab-recover'),
						'italic' => esc_html__('Italic', 'wplab-recover'),
					),
				),
				'font_variant' => array(
					'type'    => 'select',
					'label'   => esc_html__('Font Variant', 'wplab-recover'),
					'value'		=> '',
					'choices' => array(
						'' => esc_html__('- Default -', 'wplab-recover'),
						'normal' => esc_html__('Normal', 'wplab-recover'),
						'small-caps' => esc_html__('Small Caps', 'wplab-recover'),
					),
				),
				'font_weight' => array(
					'type'    => 'select',
					'label'   => esc_html__('Font Weight', 'wplab-recover'),
					'value'		=> '',
					'choices' => array(
						'' => esc_html__('- Default -', 'wplab-recover'),
						'light' => esc_html__('Light', 'wplab-recover'),
						'normal' => esc_html__('Normal', 'wplab-recover'),
						'bold' => esc_html__('Bold', 'wplab-recover'),
						'bolder' => esc_html__('Bolder', 'wplab-recover'),
						'100' => '100',
						'300' => '300',
						'400' => '400',
						'600' => '600',
						'800' => '800',
					),
				),
			
			)
		),
	)
);