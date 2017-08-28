<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'carousel_type' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'style' => 'default',
				),
				'picker' => array(
					'style' => array(
						'label' => esc_html__( 'Carousel type', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'default' => esc_html__( 'Standard', 'wplab-recover' ),
							'infinite' => esc_html__( 'Infinite', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					'default' => array(
						'read_more_text' => array(
							'label' => esc_html__( 'Read more link text', 'wplab-recover' ),
							'type' => 'text',
							'value' => esc_html__( 'Read more', 'wplab-recover' )
						),
						'visible_posts' => array(
							'label' => esc_html__( 'Visible posts (desktop)', 'wplab-recover' ),
							'type' => 'text',
							'value' => '3'
						),
						'visible_posts_small' => array(
							'label' => esc_html__( 'Visible posts (small screen)', 'wplab-recover' ),
							'type' => 'text',
							'value' => '2'
						),
						'visible_posts_phone' => array(
							'label' => esc_html__( 'Visible posts (phones)', 'wplab-recover' ),
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
					
					),
					'infinite' => array(
					
						'display_categories' => array(
							'label' => esc_html__( 'Display categories', 'wplab-recover' ),
							'type' => 'select',
							'value' => 'true',
							'choices' => array(
								'true' => esc_html__('Yes', 'wplab-recover'),
								'false' => esc_html__('No', 'wplab-recover'),
							),
						),
						'display_lightbox_link' => array(
							'label' => esc_html__( 'Display lightbox link', 'wplab-recover' ),
							'type' => 'select',
							'value' => 'true',
							'choices' => array(
								'true' => esc_html__('Yes', 'wplab-recover'),
								'false' => esc_html__('No', 'wplab-recover'),
							),
						),
						'display_project_link' => array(
							'label' => esc_html__( 'Display project link', 'wplab-recover' ),
							'type' => 'select',
							'value' => 'true',
							'choices' => array(
								'true' => esc_html__('Yes', 'wplab-recover'),
								'false' => esc_html__('No', 'wplab-recover'),
							),
						),
					
					),
				)
			),
		
		)
	),
	'query' => array(
		'title' => esc_html__( 'Query', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'post_type' => array(
				'label' => esc_html__( 'Post type', 'wplab-recover' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'post' => esc_html__('Blog posts', 'wplab-recover' ),
					'fw-portfolio' => esc_html__('Portfolio posts', 'wplab-recover' ),
				),
			),
			'posts_per_page' => array(
				'label' => esc_html__( 'Posts per page', 'wplab-recover' ),
				'type' => 'text',
				'value' => '9'
			),
			'order_by' => array(
				'label' => esc_html__( 'Posts ordering method', 'wplab-recover' ),
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
				'label' => esc_html__( 'Posts sorting method', 'wplab-recover' ),
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
	)
);