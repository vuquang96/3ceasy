<?php 

/**
 * Get existing menus
 **/
$_existing_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

$_menus_array = array(
	'' => esc_html__('- Use Default menu -', 'wplab-recover'),
);

if( !empty( $_existing_menus ) ) {
	foreach( $_existing_menus as $_menu_item ) {
		$_menus_array[ $_menu_item->slug ] = $_menu_item->name;
	}
}

/**
 * Post options array
 **/
$options = array(
	'main' => array(
		'title'   => esc_html__( 'Post Settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(

			'header_style' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'style' => 'default',
				),
				'picker' => array(
					'style' => array(
						'label' => esc_html__( 'Header style', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'default' => esc_html__( 'Default', 'wplab-recover' ),
							'bg' => esc_html__( 'Background Image', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					
					'bg' => array(
						'page_header_bg' => array(
							'label' => esc_html__( 'Header Background image', 'wplab-recover' ),
							'desc' => esc_html__( 'It can be chaged individually for each page', 'wplab-recover' ),
							'type' => 'upload',
							'images_only' => true,
						),
					)
				
				)
			),

		),
	),
);