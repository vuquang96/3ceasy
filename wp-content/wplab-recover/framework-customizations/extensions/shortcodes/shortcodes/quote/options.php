<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'id' => array( 'type' => 'unique' ),
	'quote_content' => array(
		'title' => esc_html__( 'Content', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
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
					'big_photo' => esc_html__( 'Big Photo', 'wplab-recover' ),
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

);