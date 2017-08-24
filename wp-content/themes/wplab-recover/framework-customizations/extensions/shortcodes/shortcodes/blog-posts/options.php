<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'style' => array(
				'label' => esc_html__( 'Output style', 'wplab-recover' ),
				'type' => 'select',
				'value' => '',
				'choices' => array(
					'cols_1' => esc_html__('1 column', 'wplab-recover'),
					'cols_2' => esc_html__('2 columns', 'wplab-recover'),
					'masonry' => esc_html__('Masonry', 'wplab-recover'),
					'grid_cols_3' => esc_html__('Grid, 3 columns', 'wplab-recover'),
				),
			),
			'pagination' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display pagination', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(

						'pagination_style' => array(
							'label' => esc_html__( 'Pagination style', 'wplab-recover' ),
							'type' => 'select',
							'value' => '',
							'choices' => array(
								'prev_next' => esc_html__( 'Prev / Next links', 'wplab-recover'),
								'number' => esc_html__( 'Numbers', 'wplab-recover'),
								'ajax' => esc_html__( 'AJAX', 'wplab-recover'),
							),
						),

					),
				),
				'show_borders' => false,
			),
		
		)
	),
	'query' => array(
		'title' => esc_html__( 'Query', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
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
			'with_thumbs_only' => array(
				'label' => esc_html__( 'Posts with thumbnails only', 'wplab-recover' ),
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
				'value' => 'false',
			),
		)
	),
);