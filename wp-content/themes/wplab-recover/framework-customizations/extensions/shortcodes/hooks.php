<?php

/**
 * Disable unused unyson shortcodes
 **/

function _filter_wplab_recover_disable_unyson_shortcodes( $to_disable ) {
	$to_disable[] = 'calendar';
	$to_disable[] = 'call_to_action';
	$to_disable[] = 'icon';
	$to_disable[] = 'icon_box';
	$to_disable[] = 'team_member';
	return $to_disable;
}

add_filter( 'fw_ext_shortcodes_disable_shortcodes', '_filter_wplab_recover_disable_unyson_shortcodes' );