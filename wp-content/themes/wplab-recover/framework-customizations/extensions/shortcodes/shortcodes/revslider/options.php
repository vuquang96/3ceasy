<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

$_sliders_list = array(
	'' => esc_html__('- Select a slider -', 'wplab-recover' ),
);

$sliders = array();

if( shortcode_exists('rev_slider') ) {
	$sliders = $wplab_recover_core->model( 'slider' )->get_sliders();
}

if( !empty( $sliders ) ) {
	foreach( $sliders as $slider ) {
		$_sliders_list[ $slider->alias ] = $slider->title;
	}
}

$options = array(
	'slider_alias' => array(
		'label' => esc_html__( 'Choose a slider', 'wplab-recover' ),
		'type' => 'select',
		'value' => '',
		'choices' => $_sliders_list,
		'desc' => esc_html__( 'Select one of created sliders', 'wplab-recover' ),
	),
);