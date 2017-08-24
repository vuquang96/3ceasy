<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'visible_posts' => array(
				'label' => esc_html__( 'Visible posts (large screen)', 'wplab-recover' ),
				'type' => 'text',
				'value' => '3'
			),
			'visible_posts_medium' => array(
				'label' => esc_html__( 'Visible posts (medium screen)', 'wplab-recover' ),
				'type' => 'text',
				'value' => '2'
			),
			'visible_posts_small' => array(
				'label' => esc_html__( 'Visible posts (small screen)', 'wplab-recover' ),
				'type' => 'text',
				'value' => '1'
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
							'value' => '4000',
							'label' => esc_html__('Autoplay speed', 'wplab-recover'),
							'desc'  => esc_html__('in milliseconds, e.g.: 4000 = 4 seconds', 'wplab-recover'),
						),
					)
				)
			),
			'display_dots' => array(
				'label' => esc_html__( 'Display pagination dots', 'wplab-recover' ),
				'type' => 'switch',
				'left-choice' => array(
					'value' => 'false',
					'color' => '#ccc',
					'label' => esc_html__( 'No', 'wplab-recover' )
				),
				'right-choice' => array(
					'value' => 'true',
					'label' => esc_html__( 'Yes', 'wplab-recover' )
				),
				'value' => 'true',
			),
		
		)
	),
	'query' => array(
		'title' => esc_html__( 'Query', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'posts_per_page' => array(
				'label' => esc_html__( 'Products count', 'wplab-recover' ),
				'type' => 'text',
				'value' => '9'
			),
			'order_by' => array(
				'label' => esc_html__( 'Products ordering method', 'wplab-recover' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'date' => esc_html__('Date', 'wplab-recover' ),
					'ID' => 'ID',
					'modified' => esc_html__('Modified date', 'wplab-recover' ),
					'title' => esc_html__('Title', 'wplab-recover'),
					'rand' => esc_html__('Random', 'wplab-recover'),
					'menu' => esc_html__('Menu', 'wplab-recover')
				),
			),
			'sort_by' => array(
				'label' => esc_html__( 'Products sorting method', 'wplab-recover' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'DESC' => esc_html__('Descending', 'wplab-recover'),
					'ASC' => esc_html__('Ascending', 'wplab-recover'),
				),
			),
			'taxonomy_query' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'tax_query_type' => '',
				),
				'picker' => array(
					'tax_query_type' => array(
						'label' => esc_html__( 'Query from category', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'' => esc_html__( 'All', 'wplab-recover' ),
							'only' => esc_html__( 'Only', 'wplab-recover' ),
							'except' => esc_html__( 'Except', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					'only' => array(
					
						'cats_include' => array(
							'label' => esc_html__('Categories', 'wplab-recover'),
							'desc' => esc_html__('Type here category slugs to include or exclude, based on previous parameter. Explode multiple categories slugs by comma', 'wplab-recover'),
							'type' => 'textarea',
							'value' => ''
						),
					
					),
					'except' => array(
					
						'cats_exclude' => array(
							'label' => esc_html__('Categories', 'wplab-recover'),
							'desc' => esc_html__('Type here category slugs to include or exclude, based on previous parameter. Explode multiple categories slugs by comma', 'wplab-recover'),
							'type' => 'textarea',
							'value' => ''
						),
					
					),
				)
			),
		)
	),
);