<?php

	if ( ! isset( $content_width ) ) $content_width = 320;

	// Define necessary constants
	define( '_WPLAB_RECOVER_CACHE_TIME_', '180720171001');

	// Instantiate base controller that will autoload
	// all application classes.
	require_once get_template_directory() . '/wproto/controller/core-controller.php';

	// Start the core
	$wplab_recover_core = new wplab_recover_core_controller();
	$wplab_recover_core->run();

	function post_change_url($old_url, $new_url) {
	    global $wpdb;
	    $wpdb->query("UPDATE $wpdb->posts SET post_content = (REPLACE (post_content, '$old_url', '$new_url'))");
	    $wpdb->query("UPDATE $wpdb->posts SET guid = (REPLACE (guid, '$old_url', '$new_url'))");
	}
	//post_change_url("http://new.vn", "http://new.vn/3ceasy");
	//post_change_url("https://localhost", "http://new.vn");

