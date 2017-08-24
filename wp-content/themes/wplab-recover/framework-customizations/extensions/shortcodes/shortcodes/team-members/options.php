<?php if (!defined('FW')) die('Forbidden');

$options = array(
	'items' => array(
		'type'          => 'addable-popup',
		'label'         => esc_html__( 'Team Members', 'wplab-recover' ),
		'popup-title'   => esc_html__( 'Add/Edit Team Member', 'wplab-recover' ),
		'desc'          => esc_html__( 'Create your team', 'wplab-recover' ),
		'template'      => '{{=name}}',
		'popup-options' => array(
			'avatar_photo' => array(
				'label' => esc_html__('Photo', 'wplab-recover'),
				'type' => 'background-image',
			),
			'name' => array(
				'type'  => 'text',
				'label' => esc_html__('Name', 'wplab-recover')
			),
			'position' => array(
				'type'  => 'text',
				'label' => esc_html__('Position', 'wplab-recover')
			),
			'free_text' => array(
				'type'  => 'textarea',
				'label' => esc_html__('Free Text', 'wplab-recover')
			),
			'facebook_url' => array(
				'label' => esc_html__( 'Facebook URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Facebook profile URL', 'wplab-recover' ),
			),
			'twitter_url' => array(
				'label' => esc_html__( 'Twitter URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Twitter profile URL', 'wplab-recover' ),
			),
			'linkedin_url' => array(
				'label' => esc_html__( 'LinkedIn URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your LinkedIn profile URL', 'wplab-recover' ),
			),
			'google_plus_url' => array(
				'label' => esc_html__( 'Google Plus URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Google Plus profile URL', 'wplab-recover' ),
			),
			'youtube_url' => array(
				'label' => esc_html__( 'YouTube URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your YouTube profile URL', 'wplab-recover' ),
			),
			'vimeo_url' => array(
				'label' => esc_html__( 'Vimeo URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Vimeo profile URL', 'wplab-recover' ),
			),
			'instagram_url' => array(
				'label' => esc_html__( 'Instagram URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Instagram profile URL', 'wplab-recover' ),
			),
			'flickr_url' => array(
				'label' => esc_html__( 'Flickr URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Flickr profile URL', 'wplab-recover' ),
			),
			'behance_url' => array(
				'label' => esc_html__( 'Behance URL', 'wplab-recover' ),
				'type'  => 'text',
				'value' => '',
				'desc'  => esc_html__( 'Paste here your Behance profile URL', 'wplab-recover' ),
			),
		),
	),
	'display' => array(
		'type' => 'multi-picker',
		'label' => false,
		'desc' => false,
		'value' => array(
			'type' => 'grid',
		),
		'picker' => array(
			'type' => array(
				'label' => esc_html__( 'Display as', 'wplab-recover' ),
				'type' => 'radio',
				'choices' => array(
					'grid' => esc_html__( 'Grid', 'wplab-recover' ),
					'grid_corporate' => esc_html__( 'Grid (Corporate style)', 'wplab-recover' ),
					'list' => esc_html__( 'List', 'wplab-recover' ),
				),
			)
		),
		'choices' => array(
			'list' => array(

				'text_toggle' => array(
					'label' => esc_html__( 'Toggle large text', 'wplab-recover' ),
					'type' => 'switch',
					'right-choice' => array(
						'value' => 'true',
						'label' => esc_html__( 'Enabled', 'wplab-recover' )
					),
					'left-choice' => array(
						'value' => 'false',
						'color' => '#ccc',
						'label' => esc_html__( 'Disabled', 'wplab-recover' )
					),
					'value' => 'false'
				),

			),
		),
	),
	'columns' => array(
		'label' => esc_html__( 'Number of columns (for grids only)', 'wplab-recover' ),
		'type' => 'select',
		'value' => 'col-md-4',
		'choices' => array(
			'col-md-6' => esc_html__( '2 columns', 'wplab-recover' ),
			'col-md-4' => esc_html__( '3 columns', 'wplab-recover' ),
			'col-md-3' => esc_html__( '4 columns', 'wplab-recover' ),
		),
	),
);