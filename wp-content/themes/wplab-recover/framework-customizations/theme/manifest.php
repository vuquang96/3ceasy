<?php

	if ( ! defined( 'FW' )) {
		exit;
	}

	$manifest = array();
	
	// ToDo
	// $manifest['id'] = get_option( 'stylesheet' );
	
	$manifest['requirements'] = array(
		'wordpress' => array(

		),
	  'framework' => array(

	  ),
	  'extensions' => array(

	  )
	);
	
	$manifest['supported_extensions'] = array(
	  'backups' 			=> array(),
	  'page-builder' 	=> array(),
	  'sidebars' 			=> array(),
	  'portfolio' 		=> array(),
	  'breadcrumbs' 	=> array(),
	  'seo' 					=> array(),
	  'analytics' 		=> array(),
	  'social' 				=> array(),
	  'wp-shortcodes' => array()
	);