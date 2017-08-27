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





function nws_order_customer() {
	if(isset($_POST)) {
		$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
		$site_key    = '6LcmBS4UAAAAALCnGWjQB2CIWU2HcMPPHdOlS2Dp';
		$secret_key  = '6LcmBS4UAAAAAIjcUBXvXDvxTcuwlMiiM_hQwyMT';
		//get data post
	    $site_key_post    = $_POST['g-recaptcha-response'];
	      
	    //get IP client
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
	        $remoteip = $_SERVER['REMOTE_ADDR'];
	    }
	     
	    //create link connect
	    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
	    //result google
	    $response = file_get_contents($api_url);
	    //data json
	    $response = json_decode($response);
	    if($response->success == true)
	    {
	        	echo "<pre>";
	        	print_r($_POST);
	        	echo "<pre>";
	    }else{
	        echo 'Captcha khong dung';
	    }
	}
}

//add_action( 'admin_post_nopriv_nws_customer', 'nws_order_customer' );