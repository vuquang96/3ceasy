<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'sidebar' => array(
				'title' => esc_html__( 'Sidebar', 'wplab-recover' ),
				'type' => 'tab',
				'options' => array(
	
					'sidebar_options' => array(
						'title' => esc_html__( 'Sidebar Settings', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'sidebar_options-box' => array(
								'title' => esc_html__( 'Sidebar Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'sidebar_size' => array(
								    'type'  => 'slider',
								    'value' => 3,
								    'properties' => array(
							        'min' => 3,
							        'max' => 5,
								    ),
								    'label' => esc_html__( 'Sidebar size', 'wplab-recover' ),
									),
								
								)
							),
						
						)
					),
	
				)
			)
		),
	);