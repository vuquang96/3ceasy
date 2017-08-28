<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'url'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Insert Video URL', 'wplab-recover' ),
		'desc'  => esc_html__( 'Insert Video URL to embed this video', 'wplab-recover' )
	),
	'lazy_load' => array(
		'label' => esc_html__('Lazy Load', 'wplab-recover'),
		'desc' => esc_html__('Works only for YouTube videos', 'wplab-recover'),
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
		'value' => 'false',
	),
	'preview_img' => array(
		'label' => esc_html__( 'Custom Preview Image', 'wplab-recover' ),
		'desc' => esc_html__( 'Only for Lazy Videos (optional)', 'wplab-recover' ),
		'type' => 'upload',
		'images_only' => true,
	),
	'video_title' => array(
		'type'  => 'text',
		'label' => esc_html__('Custom title', 'wplab-recover'),
		'desc'  => esc_html__('Only for Lazy Videos (optional)', 'wplab-recover'),
	),
);
