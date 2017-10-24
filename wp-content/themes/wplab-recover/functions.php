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
	    $wpdb->query("UPDATE `$wpdb->posts` SET `post_content` = (REPLACE (post_content, '$old_url', '$new_url'))");
	    $wpdb->query("UPDATE `$wpdb->posts` SET `guid` = (REPLACE (guid, '$old_url', '$new_url'))");
	}

	

	function nws_bottom_bar(){
		return wp_kses_post(get_option("nws_footer_bar", ""));
	}
	function change_footer(){
		global $wpdb;
		$ids = $wpdb->get_results("SELECT `ID` FROM `$wpdb->posts`", "ARRAY_A" );


		$footer = nws_bottom_bar();
		foreach ($ids as $value) {
			$metaValue = get_post_meta($value['ID'], "fw_options", true);
			if(isset($metaValue['customize_page_footer']['true']['display_bottom_bar']['true']['bottom_bar_content'])){
				$metaValue['customize_page_footer']['true']['display_bottom_bar']['true']['bottom_bar_content'] = $footer;
			}
		 	update_post_meta($value['ID'], "fw_options", $metaValue);
		}
	}

	if(get_option("nws_change_domain", 1)){
		post_change_url("https://3ceasy.newwave.vn", "https://3ceasy.vn");
		post_change_url("http://3ceasy.newwave.vn", "http://3ceasy.vn");
		change_footer();
		update_option("nws_change_domain", 0);
	}
	

