<?php

/**
 * Portfolio single options array
 **/
$options = array(
	'main' => array(
		'title'   => esc_html__( 'Portfolio post settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(
			'gallery_before' => array(
				'label' => esc_html__( 'Display gallery before content', 'wplab-recover' ),
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
				'value' => 'true',
				'desc' => esc_html__( 'If enabled, project images will be displayed before content', 'wplab-recover' ),
			),
			'short_description' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Short description', 'wplab-recover'),
			),
		)
	),
	'head' => array(
		'title'   => esc_html__( 'Header settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(
			'header_bg_img' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'source' => 'default',
				),
				'picker' => array(
					'source' => array(
						'label' => esc_html__( 'Header background image', 'wplab-recover' ),
						'desc' => esc_html__( 'This option changes Header Background Image for Modern Header style or Breadcrumbs background Image for Classic Header style.', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'default' => esc_html__( 'Default (from general header settings)', 'wplab-recover' ),
							'custom' => esc_html__( 'Custom Background Image', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					
					'custom' => array(
						'page_header_bg' => array(
							'label' => esc_html__( 'Image Source', 'wplab-recover' ),
							'desc' => esc_html__( 'It can be chaged individually for each page', 'wplab-recover' ),
							'type' => 'upload',
							'images_only' => true,
						),
					)
				
				)
			),
		)
	)
);