<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}
	
	global $wplab_recover_core;
	
	/**
	 * Get existing menus
	 **/
	$_existing_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	
	$_menus_array = array();
	
	if( !empty( $_existing_menus ) ) {
		foreach( $_existing_menus as $_menu_item ) {
			$_menus_array[ $_menu_item->slug ] = $_menu_item->name;
		}
	}

	$options = array(
		array(
			'header' => array(
				'title' => esc_html__( 'Header', 'wplab-recover' ),
				'type' => 'tab',
				'options' => array(
	
					'logo_options' => array(
						'title' => esc_html__( 'Logo options', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'header-logo-box' => array(
								'title' => esc_html__( 'Logo options', 'wplab-recover' ),
								'type' => 'box',
								'limit' => 0,
								'options' => array(
								
									'header_logo_type' => array(
										'type' => 'multi-picker',
										'show_borders' => false,
										'label' => false,
										'desc' => false,
										'value' => array(
											'logo_type' => 'title',
										),
										'picker' => array(
											'logo_type' => array(
												'label' => esc_html__( 'Logo Type', 'wplab-recover' ),
												'type' => 'radio',
												'choices' => array(
													'title' => esc_html__( 'Site title only', 'wplab-recover' ),
													'title_and_tagline'  => esc_html__( 'Site title and tagline', 'wplab-recover' ),
													'image' => esc_html__( 'Image logo', 'wplab-recover' ),
												),
											)
										),
										'choices' => array(
											'image' => array(
												'header_logo_image' => array(
													'label' => esc_html__( 'Header Logo', 'wplab-recover' ),
													'type' => 'upload',
													'attr' => array( 'class' => 'wproto-image-auto-width' ),
												),
												'header_logo_image_2x' => array(
													'label' => esc_html__( 'Header Logo for Retina Displays', 'wplab-recover' ),
													'help' => esc_html__( 'Image logo for Retina Displays should be in a double-size. E.g. If your logo has 150x75 pixels size, Retina logo should be 300x150 pixels size.', 'wplab-recover' ),
													'attr' => array( 'class' => 'wproto-image-auto-width' ),
													'type' => 'upload'
												),
												'header_logo_width' => array(
													'label' => esc_html__( 'Logo Width', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
													'help' => esc_html__( 'Type here your image logo width in pixels, e.g.: 210', 'wplab-recover' ),
												),
												'header_logo_height' => array(
													'label' => esc_html__( 'Logo Height', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
													'help' => esc_html__( 'Type here your image logo height in pixels, e.g.: 90', 'wplab-recover' ),
												),
												'logo_margins' => array(
													'label' => esc_html__( 'Logo Margins', 'wplab-recover' ),
													'type' => 'stylebox',
													'value' => '',
													'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
												),
												
												'different_mobile_logo' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'picker' => array(
														'enabled' => array(
															'label' => esc_html__( 'Use different logo for mobiles?', 'wplab-recover' ),
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
														
															'mobile_header_logo_image' => array(
																'label' => esc_html__( 'Mobile Logo', 'wplab-recover' ),
																'type' => 'upload',
																'attr' => array( 'class' => 'wproto-image-auto-width' ),
															),
															'mobile_header_logo_image_2x' => array(
																'label' => esc_html__( 'Mobile Logo for Retina Displays', 'wplab-recover' ),
																'help' => esc_html__( 'Image logo for Retina Displays should be in a double-size. E.g. If your logo has 150x75 pixels size, Retina logo should be 300x150 pixels size.', 'wplab-recover' ),
																'attr' => array( 'class' => 'wproto-image-auto-width' ),
																'type' => 'upload'
															),
															'mobile_header_logo_width' => array(
																'label' => esc_html__( 'Mobile Logo Width', 'wplab-recover' ),
																'type' => 'short-text',
																'value' => '',
																'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
																'help' => esc_html__( 'Type here your image logo width in pixels, e.g.: 210', 'wplab-recover' ),
															),
															'mobile_header_logo_height' => array(
																'label' => esc_html__( 'Mobile Logo Height', 'wplab-recover' ),
																'type' => 'short-text',
																'value' => '',
																'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
																'help' => esc_html__( 'Type here your image logo height in pixels, e.g.: 90', 'wplab-recover' ),
															),
															'mobile_logo_margins' => array(
																'label' => esc_html__( 'Mobile Logo Margins', 'wplab-recover' ),
																'type' => 'stylebox',
																'value' => '',
																'desc' => esc_html__( 'Example: 10px 20% 20px 20%. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
															),
														
														)
													)
												),
												'different_rtl_logo' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'picker' => array(
														'enabled' => array(
															'label' => esc_html__( 'Use different logo in RTL mode?', 'wplab-recover' ),
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
														
															'rtl_logo_image' => array(
																'label' => esc_html__( 'RTL Logo', 'wplab-recover' ),
																'type' => 'upload',
																'attr' => array( 'class' => 'wproto-image-auto-width' ),
															),
															'rtl_logo_image_2x' => array(
																'label' => esc_html__( 'RTL Logo for Retina Displays', 'wplab-recover' ),
																'attr' => array( 'class' => 'wproto-image-auto-width' ),
																'type' => 'upload'
															),
														)
													)
												),
												
											)
										),
		
									),
								)
							),
						
						)
					),
					'favicon_options' => array(
						'title' => esc_html__( 'Favicon', 'wplab-financier' ),
						'type' => 'tab',
						'options' => array(
						
							'favicon-box' => array(
								'title' => esc_html__( 'Favicon', 'wplab-financier' ),
								'type' => 'box',
								'limit' => 0,
								'options' => array(
								
									'favicon' => array(
										'label' => esc_html__( 'Favicon', 'wplab-financier' ),
										'desc' => esc_html__( 'for Common Browsers', 'wplab-financier' ),
										'type' => 'upload',
										'images_only' => true,
									),
									'favicon_57' => array(
										'label' => esc_html__( 'Favicon 57x57', 'wplab-financier' ),
										'desc' => esc_html__( 'Standard IPhone', 'wplab-financier' ),
										'type' => 'upload',
										'images_only' => true,
									),
									'favicon_114' => array(
										'label' => esc_html__( 'Favicon 114x114', 'wplab-financier' ),
										'desc' => esc_html__( 'Retina IPhone', 'wplab-financier' ),
										'type' => 'upload',
										'images_only' => true,
									),
									'favicon_72' => array(
										'label' => esc_html__( 'Favicon 72x72', 'wplab-financier' ),
										'desc' => esc_html__( 'Standard IPad', 'wplab-financier' ),
										'type' => 'upload',
										'images_only' => true,
									),
									'favicon_144' => array(
										'label' => esc_html__( 'Favicon 144x144', 'wplab-financier' ),
										'desc' => esc_html__( 'Retina IPad', 'wplab-financier' ),
										'type' => 'upload',
										'images_only' => true,
									),
								
								)
							)
						
						)
					),
					'header_styling' => array(
						'title' => esc_html__( 'Header styling', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'header_styling-box' => array(
								'title' => esc_html__( 'Header options', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
						
									'header_style' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'value' => array(
											'style' => 'modern',
										),
										'picker' => array(
											'style' => array(
												'label' => esc_html__( 'Header style', 'wplab-recover' ),
												'type' => 'radio',
												'choices' => array(
													'modern' => esc_html__( 'Modern', 'wplab-recover' ),
													'classic' => esc_html__( 'Classic', 'wplab-recover' ),
												),
											)
										),
										'choices' => array(
											'modern' => array(
											
												'modern_header_bg' => array(
													'label' => esc_html__( 'Header Background image', 'wplab-recover' ),
													'desc' => esc_html__( 'Will be used as default background image for all pages, it can be chaged individually for each page', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'modern_header_parallax' => array(
													'label' => esc_html__( 'Parallax Effect', 'wplab-recover' ),
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
													'value' => 'true',
												),
												'modern_display_header_cta' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'picker' => array(
														'enabled' => array(
															'label' => esc_html__( 'Display Call To Action block at header', 'wplab-recover' ),
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
															'value' => 'true',
														)
													),
													'choices' => array(
														'true' => array(
															
															'modern_header_cta_link_text' => array(
																'label' => esc_html__( 'CTA Link text', 'wplab-recover' ),
																'type'  => 'text',
																'value' => esc_html__('Get In Touch', 'wplab-recover'),
															),
															
															'modern_header_cta_link_url' => array(
																'label' => esc_html__( 'CTA Link URL', 'wplab-recover' ),
																'type'  => 'text',
																'value' => '/contacts/',
															),
												
												
														),
													),
												),
											
											),
											'classic' => array(
											
												'classic_header_bg' => array(
													'label' => esc_html__( 'Header Background image', 'wplab-recover' ),
													'desc' => esc_html__( 'Will be used as default background image for all pages, it can be chaged individually for each page', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
											
											),
										)
									),
						
								)
							)
						
						)
					),
					'top_bar' => array(
						'title' => esc_html__( 'Top bar', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'top_bar-box' => array(
								'title' => esc_html__( 'Top bar options', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'display_top_bar' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Top bar', 'wplab-recover' ),
												'type' => 'switch',
												'left-choice' => array(
													'value' => 'false',
													'color' => '#ccc',
													'label' => esc_html__( 'Disabled', 'wplab-recover' )
												),
												'right-choice' => array(
													'value' => 'true',
													'label' => esc_html__( 'Enabled', 'wplab-recover' )
												),
												'value' => 'false',
											)
										),
										'choices' => array(
											'true' => array(
		
												'top_bar_phone_text' => array(
													'type'  => 'text',
													'label' => esc_html__('Phone Text', 'wplab-recover'),
													'value' => esc_html__('Call us:', 'wplab-recover')
												),
												'top_bar_phone' => array(
													'type'  => 'text',
													'label' => esc_html__('Phone', 'wplab-recover'),
												),
												'top_bar_email_text' => array(
													'type'  => 'text',
													'label' => esc_html__('Email Text', 'wplab-recover'),
													'value' => esc_html__('Email us:', 'wplab-recover')
												),
												'top_bar_email' => array(
													'type'  => 'text',
													'label' => esc_html__('Email', 'wplab-recover'),
												),
												'top_bar_wh_text' => array(
													'type'  => 'text',
													'label' => esc_html__('Working Hours Text', 'wplab-recover'),
													'value' => esc_html__('Working Hours:', 'wplab-recover')
												),
												'top_bar_wh' => array(
													'type'  => 'text',
													'label' => esc_html__('Working hours', 'wplab-recover'),
												),
		
												'top_bar_display_menu' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'picker' => array(
														'enabled' => array(
															'label' => esc_html__( 'Display menu', 'wplab-recover' ),
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
					
															'top_bar_menu' => array(
																'label' => esc_html__( 'Choose a menu', 'wplab-recover' ),
																'desc' => esc_html__( 'Only top-level links will be visible', 'wplab-recover' ),
																'type' => 'select',
																'value' => '',
																'choices' => $_menus_array
															),
				
														),
													),
													'show_borders' => false,
												),
		
												'top_bar_social_icons' => array(
													'label' => esc_html__( 'Display social icons', 'wplab-recover' ),
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
													'value' => 'true',
												),
												
												'top_bar_wpml' => array(
													'label' => esc_html__( 'Display WPML language switcher', 'wplab-recover' ),
													'desc' => esc_html__( 'works only if WPML plugin is active', 'wplab-recover' ),
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
												),
	
											),
										),
										'show_borders' => false,
									),
								
								)
							)
						)
					),
					'header_options' => array(
						'title' => esc_html__( 'Menu options', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'header_options-box' => array(
								'title' => esc_html__( 'Menu options', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
						
									'menu_style' => array(
										'label' => esc_html__( 'Menu Style', 'wplab-recover' ),
										'type' => 'select',
										'choices' => $wplab_recover_core->cfg['menu_styles'],
										'value' => 'default',
									),
									'submenu_style' => array(
										'label' => esc_html__( 'Sub-Menu Style', 'wplab-recover' ),
										'type' => 'select',
										'choices' => $wplab_recover_core->cfg['submenu_styles'],
										'value' => 'dark',
									),
									'menu_hover_effect' => array(
										'label' => esc_html__( 'Menu Hover Effect', 'wplab-recover' ),
										'type' => 'select',
										'choices' => $wplab_recover_core->cfg['animations'],
										'value' => 'fadeIn',
									),
									'menu_scrolling' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Scrolling Effect', 'wplab-recover' ),
												'type' => 'switch',
												'left-choice' => array(
													'value' => 'false',
													'color' => '#ccc',
													'label' => esc_html__( 'Disabled', 'wplab-recover' )
												),
												'right-choice' => array(
													'value' => 'true',
													'label' => esc_html__( 'Enabled', 'wplab-recover' )
												),
												'value' => 'false',
											)
										),
										'choices' => array(
											'true' => array(
		
												'menu_scrolling_style' => array(
													'label' => esc_html__( 'Scrolling style', 'wplab-recover' ),
													'type' => 'select',
													'value' => 'repeat',
													'choices' => array(
														'simple' => esc_html__( 'Simple', 'wplab-recover' ),
														'headroom' => esc_html__( 'Headroom', 'wplab-recover' ),
													),
												),
												'do_not_scroll_no_mobiles' => array(
													'label' => esc_html__( 'Do not scroll menu on mobiles', 'wplab-recover' ),
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
													'value' => 'true',
												),
	
											),
										),
									),
									'menu_display_cart' => array(
										'label' => esc_html__( 'Display Cart Icon', 'wplab-recover' ),
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
										'value' => 'true',
									),
									'menu_display_search' => array(
										'label' => esc_html__( 'Display Search Icon', 'wplab-recover' ),
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
										'value' => 'true',
									),

								)
							)
						
						
						)
					),
	
				)
			)
		),
	);