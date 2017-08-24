<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

global $wplab_recover_core;

$options = array(

	array(
		'id' => array( 'type' => 'unique' ),
		'attributes' => array(
			'title' => esc_html__( 'Header Attributes', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'title'    => array(
					'type'  => 'text',
					'label' => esc_html__( 'Heading Title', 'wplab-recover' ),
					'desc'  => esc_html__( 'Write the heading title content', 'wplab-recover' ),
				),
				'heading' => array(
					'type'    => 'select',
					'label'   => esc_html__('Heading Size', 'wplab-recover'),
					'choices' => array(
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
					)
				),
				'custom_classes' => array(
					'type'  => 'text',
					'label' => esc_html__( 'Custom CSS classes', 'wplab-recover' ),
					'desc'  => esc_html__( 'Type here your own custom CSS classes', 'wplab-recover' ),
				),
			
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
			
				'header_line' => array(
					'label' => esc_html__( 'Display a line after header', 'wplab-recover' ),
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
				'header_angle' => array(
					'label' => esc_html__( 'Display an angle before header', 'wplab-recover' ),
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
				'header_color' => array(
					'label' => esc_html__('Header text color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'header_line_color' => array(
					'label' => esc_html__('Header line color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'header_angle_color' => array(
					'label' => esc_html__('Header angle color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'text_align' => array(
					'type'    => 'select',
					'label'   => esc_html__('Text Align', 'wplab-recover'),
					'value'		=> '',
					'choices' => array(
						'' => esc_html__('- Default -', 'wplab-recover'),
						'left' => esc_html__('Left', 'wplab-recover'),
						'center' => esc_html__('Center', 'wplab-recover'),
						'right' => esc_html__('Right', 'wplab-recover'),
					),
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
				'font_size' => array(
					'label' => esc_html__('Font size', 'wplab-recover'),
					'type' => 'text',
					'desc' => esc_html__('In pixels, for example: 18', 'wplab-recover'),
				),
				'line_height' => array(
					'label' => esc_html__('Line height', 'wplab-recover'),
					'type' => 'text',
					'desc' => esc_html__('In pixels, for example: 24', 'wplab-recover'),
				),
				'font_size_mobile' => array(
					'label' => esc_html__('Font size (mobile devices)', 'wplab-recover'),
					'type' => 'text',
					'desc' => esc_html__('In pixels, for example: 18', 'wplab-recover'),
				),
				'line_height_mobile' => array(
					'label' => esc_html__('Line height (mobile devices)', 'wplab-recover'),
					'type' => 'text',
					'desc' => esc_html__('In pixels, for example: 24', 'wplab-recover'),
				),
				'animation' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Animate header?', 'wplab-recover' ),
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
					'label' => esc_html__( 'Header Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings' => array(
					'label' => esc_html__( 'Header Paddings', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
			
			),
		)
	),	
);