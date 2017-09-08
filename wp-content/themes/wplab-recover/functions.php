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
	/*post_change_url("https://3ceasy.newwave.vn", "https://3ceasy.vn");
	post_change_url("http://3ceasy.newwave.vn", "http://3ceasy.vn");*/

	function change_footer(){
		global $wpdb;
		$ids = $wpdb->get_results("SELECT `ID` FROM `$wpdb->posts`", "ARRAY_A" );


		$footer = '<p style="text-align: center;">&copy;2017&nbsp;<a href="https://3ceasy.newwave.vn/" target="_blank" rel="noopener"><strong>3C easy Vietnam</strong></a>
			    	</p><p style="text-align: center;">Developed by &nbsp;<a href="http://newwave.vn/">newwave.vn</a></p>';
		foreach ($ids as $value) {
			$metaValue = get_post_meta($value['ID'], "fw_options", true);
			if(isset($metaValue['customize_page_footer']['true']['display_bottom_bar']['true']['bottom_bar_content'])){
				$metaValue['customize_page_footer']['true']['display_bottom_bar']['true']['bottom_bar_content'] = $footer;
			}
		 	update_post_meta($value['ID'], "fw_options", $metaValue);
		}
	}
	//change_footer();

