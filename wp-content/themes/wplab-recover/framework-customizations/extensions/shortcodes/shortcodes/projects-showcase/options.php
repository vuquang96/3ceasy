<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'query' => array(
		'title' => esc_html__( 'Query', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
			'posts_per_page' => array(
				'label' => esc_html__( 'Posts per page', 'wplab-recover' ),
				'type' => 'text',
				'value' => '7'
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
	),
);