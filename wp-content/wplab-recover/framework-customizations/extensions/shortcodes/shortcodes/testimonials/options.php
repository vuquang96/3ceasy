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
					'label'         => esc_html__( 'Testimonials', 'wplab-recover' ),
					'popup-title'   => esc_html__( 'Add/Edit Testimonial', 'wplab-recover' ),
					'desc'          => esc_html__( 'Create your testimonials', 'wplab-recover' ),
					'template'      => '{{=author}}',
					'popup-options' => array(
						'text' => array(
							'type'  => 'textarea',
							'label' => esc_html__('Text', 'wplab-recover')
						),
						'author' => array(
							'type'  => 'text',
							'label' => esc_html__('Author', 'wplab-recover')
						),
						'position' => array(
							'type'  => 'text',
							'label' => esc_html__('Position', 'wplab-recover')
						),
						'photo' => array(
						  'type'  => 'upload',
						  'label' => esc_html__('Upload photo', 'wplab-recover'),
						  'images_only' => true,
						),
					),
				),
				'autoplay' => array(
					'type' => 'multi-picker',
					'label' => false,
					'desc' => false,
					'picker' => array(
						'enabled' => array(
							'label' => esc_html__( 'Autoplay', 'wplab-recover' ),
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
							'value' => 'false',
						)
					),
					'choices' => array(
						'true' => array(
							'autoplay_speed' => array(
								'type'  => 'text',
								'label' => esc_html__('Autoplay speed', 'wplab-recover'),
								'desc'  => esc_html__('in milliseconds, e.g.: 2000 = 2 seconds', 'wplab-recover'),
							),
						)
					)
				),
			)
		),
		'styling' => array(
			'title' => esc_html__( 'Styling', 'wplab-recover' ),
			'type' => 'tab',
			'options' => array(
				'style' => array(
					'label' => esc_html__( 'Quote Style', 'wplab-recover' ),
					'type' => 'select',
					'value' => '',
					'choices' => array(
						'small_photo' => esc_html__( 'Small Photo', 'wplab-recover' ),
						'small_photo_alt' => esc_html__( 'Small Photo (Alternate icon)', 'wplab-recover' ),
						'boxed' => esc_html__( 'Boxed', 'wplab-recover' )
					),
				),
				'text_color' => array(
					'label' => esc_html__('Quote Text Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'author_color' => array(
					'label' => esc_html__('Author Text Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'position_color' => array(
					'label' => esc_html__('Position Text Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'bg_color' => array(
					'label' => esc_html__('Background Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'bg_triangle_color' => array(
					'label' => esc_html__('Background Triangle Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'icon_color' => array(
					'label' => esc_html__('Icon Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'pagination_color' => array(
					'label' => esc_html__('Pagination Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'pagination_active_color' => array(
					'label' => esc_html__('Pagination Active Color', 'wplab-recover'),
					'type' => 'color-picker',
				),
				'margins' => array(
					'label' => esc_html__( 'Margins', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
				'paddings' => array(
					'label' => esc_html__( 'Paddings', 'wplab-recover' ),
					'type' => 'stylebox',
					'value' => '',
					'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
				),
			)
		),
	)

);