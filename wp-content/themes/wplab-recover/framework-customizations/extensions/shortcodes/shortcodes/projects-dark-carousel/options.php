<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'id' => array( 'type' => 'unique' ),
	'general' => array(
		'title' => esc_html__( 'General', 'wplab-recover' ),
		'type' => 'tab',
		'options' => array(
		
			'display_filters' => array(
				'label' => esc_html__( 'Display filters', 'wplab-recover' ),
				'type' => 'select',
				'value' => 'false',
				'choices' => array(
					'true' => esc_html__('Yes', 'wplab-recover'),
					'false' => esc_html__('No', 'wplab-recover'),
				),
			),
			'all_projects_link' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Display All projects link', 'wplab-recover' ),
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
					)
				),
				'choices' => array(
					'true' => array(
					
						'all_projects_title' => array(
							'type'  => 'text',
							'label' => esc_html__('Link title', 'wplab-recover'),
							'desc'  => esc_html__('e.g. All Projects', 'wplab-recover'),
						),
						'all_projects_link_href' => array(
							'type'  => 'text',
							'label' => esc_html__('Link href', 'wplab-recover'),
							'desc'  => esc_html__('e.g. /my-portfolio/', 'wplab-recover'),
						),
					
					)
				)
			),
			'display_pagination' => array(
				'label' => esc_html__( 'Display pagination links', 'wplab-recover' ),
				'type' => 'select',
				'value' => 'false',
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
			'hover_effect' => array(
				'label' => esc_html__( 'Hover effect', 'wplab-recover' ),
				'type' => 'select',
				'value' => 'fade',
				'choices' => array(
					'fade' => esc_html__('Fade', 'wplab-recover'),
					'slide_top' => esc_html__('Slide from top', 'wplab-recover'),
					'slide_right' => esc_html__('Slide from right', 'wplab-recover'),
					'zoom' => esc_html__('Zoom', 'wplab-recover'),
					'clap_1' => esc_html__('Clap #1', 'wplab-recover'),
					'clap_2' => esc_html__('Clap #2', 'wplab-recover'),
					'burn' => esc_html__('Burn', 'wplab-recover'),
				),
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
		)
	)
);