<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'columns' => array(
				'label' => esc_html__( 'Columns number', 'wplab-recover' ),
				'type' => 'select',
				'value' => 'repeat',
				'choices' => array(
					'3' => esc_html__( '3 Columns, 3 products per tab', 'wplab-recover' ),
					'4' => esc_html__( '4 Columns, 4 products per tab', 'wplab-recover' ),
				),
			),
			'responsive_break' => array(
				'label' => esc_html__( 'Responsive at', 'wplab-recover' ),
				'desc' => esc_html__( 'Type here a screen width when tabs will to turned into Toggles', 'wplab-recover' ),
				'type' => 'text',
				'value' => '767'
			),
			'featured_tab' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display Featured tab', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'featured_tab_title' => array(
							'label' => esc_html__( 'Featured tab title', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'Featured', 'wplab-recover' )
						),

					),
				),
				'show_borders' => false,
			),
			'new_arrivals_tab' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display New Arrivals tab', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'new_arrivals_tab_title' => array(
							'label' => esc_html__( 'New Arrivals tab title', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'New Arrivals', 'wplab-recover' )
						),

					),
				),
				'show_borders' => false,
			),
			'popular_tab' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display Popular tab', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'popular_tab_title' => array(
							'label' => esc_html__( 'Popular tab title', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'Popular', 'wplab-recover' )
						),

					),
				),
				'show_borders' => false,
			),
			'top_rated_tab' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display Top Rated tab', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'top_rated_tab_title' => array(
							'label' => esc_html__( 'Top Rated tab title', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'Top Rated', 'wplab-recover' )
						),

					),
				),
				'show_borders' => false,
			),
			'onsale_tab' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display Sale tab', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'onsale_tab_title' => array(
							'label' => esc_html__( 'Sale tab title', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'Sale', 'wplab-recover' )
						),

					),
				),
				'show_borders' => false,
			),
		
		)
	),
);