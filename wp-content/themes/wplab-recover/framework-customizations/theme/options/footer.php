<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}
	
	// get all sidebars
	global $wp_registered_sidebars;
	$theme_sidebars = array();
	foreach( $wp_registered_sidebars as $sidebar ):
		$theme_sidebars[ $sidebar['id'] ] = $sidebar['name'];
	endforeach;
	
	// get all menus
	$theme_menus = get_terms('nav_menu');
	$menus = array();
	if( count( $theme_menus ) > 0 ) {
		foreach( $theme_menus as $menu ):
			$menus[ $menu->slug ] = $menu->name;
		endforeach;	
	}

	$options = array(
		array(
			'footer' => array(
				'title' => esc_html__( 'Footer', 'wplab-recover' ),
				'type' => 'tab',
				'options' => array(
	
					'footer_options' => array(
						'title' => esc_html__( 'Footer Settings', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'footer_options-box' => array(
								'title' => esc_html__( 'Footer Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'footer_bar' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'value' => array(
											'style' => 'hidden',
										),
										'picker' => array(
											'style' => array(
												'label' => esc_html__( 'Footer bar', 'wplab-recover' ),
												'desc' => esc_html__( 'Content to display before footer widgets', 'wplab-recover' ),
												'type' => 'radio',
												'choices' => array(
													'hidden' => esc_html__( 'Do not display', 'wplab-recover' ),
													'cta' => esc_html__( 'Call to action block', 'wplab-recover' ),
													'tweets' => esc_html__( 'Latest tweets', 'wplab-recover' ),
													'tweets_icons' => esc_html__( 'Latest tweets and social icons', 'wplab-recover' ),
													'contacts' => esc_html__( 'Contact information', 'wplab-recover' )
												),
											)
										),
										'choices' => array(
											'cta' => array(
											
												'footer_cta_text' => array(
											    'type'  => 'wp-editor',
											    'label' => esc_html__('CTA Block text', 'wplab-recover'),
											    'value'  => '<p>Looking for a quality and affordable constructor for your <strong>next project?</strong></p>',
											    'tinymce' => true,
											    'media_buttons' => false,
											    'teeny' => true,
											    'wpautop' => true,
											    //'reinit' => true,
											    'size' => 'large',
											    'editor_type' => 'tinymce',
											    'editor_height' => 100
												),
												
												'footer_cta_link_text' => array(
													'label' => esc_html__( 'CTA Link text', 'wplab-recover' ),
													'type'  => 'text',
													'value' => esc_html__('Request a quote', 'wplab-recover'),
												),
												
												'footer_cta_link_url' => array(
													'label' => esc_html__( 'CTA Link URL', 'wplab-recover' ),
													'type'  => 'text',
													'value' => '/contacts/',
												),
											
											),
											'contacts' => array(
											
												'footer_contacts_phones' => array(
													'type'  => 'textarea',
													'label' => esc_html__('Phones', 'wplab-recover'),
													'value' => "+123 456 7890 - Office\r\n(123) 456 7890 - Fax"
												),
												'footer_contacts_phone_icon' => array(
													'label' => esc_html__( 'Phones block custom icon', 'wplab-recover' ),
													'desc' => esc_html__( 'Default theme icon will be used if empty', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'footer_contacts_address' => array(
													'type'  => 'textarea',
													'label' => esc_html__('Address', 'wplab-recover'),
													'value' => "795 South Park Avenue,\r\nDoor 6 Wonderland, CA 94107,\r\nAustralia"
												),
												'footer_contacts_address_icon' => array(
													'label' => esc_html__( 'Address block custom icon', 'wplab-recover' ),
													'desc' => esc_html__( 'Default theme icon will be used if empty', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'footer_contacts_emails' => array(
													'type'  => 'textarea',
													'label' => esc_html__('Emails', 'wplab-recover'),
													'value' => "support@sitename.com\r\ninfo@sitename.com"
												),
												'footer_contacts_email_icon' => array(
													'label' => esc_html__( 'Email block custom icon', 'wplab-recover' ),
													'desc' => esc_html__( 'SVG Image only! Default theme icon will be used if empty', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
											
											),
											
										)
									),
									'go_top' => array(
										'label' => esc_html__( 'Go Top link', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'bottom_center',
										'choices' => array(
											'hidden' => esc_html__('Do not display', 'wplab-recover'),
											'rocket' => esc_html__('Rocket Style', 'wplab-recover'),
											'bottom_right' => esc_html__('Bottom bar right', 'wplab-recover'),
											'bottom_center' => esc_html__('Bottom bar center', 'wplab-recover'),
										)
									),
								
								)
							),
						
						)
					),
					'footer_side_options' => array(
						'title' => esc_html__( 'Primary Widget Area', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'footer_side_options-box' => array(
								'title' => esc_html__( 'Primary Widget Area Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'footer_side_display_widgets' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Display Widgets', 'wplab-recover' ),
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
		
												'footer_side_area' => array(
													'label' => esc_html__( 'Choose widgets area', 'wplab-recover' ),
													'type' => 'select',
													'value' => 'sidebar-footer-primary',
													'choices' => $theme_sidebars
												),
		
												'footer_side_columns' => array(
											    'type'  => 'slider',
											    'value' => 2,
											    'properties' => array(
										        'min' => 1,
										        'max' => 4,
											    ),
											    'label' => esc_html__( 'A number of columns for widgets', 'wplab-recover' ),
												),

	
											),
										),
									),
								
								)
							),
						
						)
					),
					'footer_side2_options' => array(
						'title' => esc_html__( 'Secondary Widget Area', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'footer_side2_options-box' => array(
								'title' => esc_html__( 'Secondary Widget Area Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'footer_side2_display_widgets' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Display Widgets', 'wplab-recover' ),
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
		
												'footer_side2_area' => array(
													'label' => esc_html__( 'Choose widgets area', 'wplab-recover' ),
													'type' => 'select',
													'value' => 'sidebar-footer-secondary',
													'choices' => $theme_sidebars
												),
		
												'footer_side2_columns' => array(
											    'type'  => 'slider',
											    'value' => 3,
											    'properties' => array(
										        'min' => 1,
										        'max' => 4,
											    ),
											    'label' => esc_html__( 'A number of columns for widgets', 'wplab-recover' ),
												),

	
											),
										),
									),
								
								)
							),
						
						)
					),
					'bottom_bar_options' => array(
						'title' => esc_html__( 'Bottom Bar', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'bottom_bar_options-box' => array(
								'title' => esc_html__( 'Bottom Bar', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
								
									'display_bottom_bar' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Display Bottom Bar', 'wplab-recover' ),
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
		
												'bottom_bar_content' => array(
											    'type'  => 'wp-editor',
											    'label' => esc_html__('Bottom Bar Content', 'wplab-recover'),
											    'value'  => nws_bottom_bar(),
											    'tinymce' => true,
											    'media_buttons' => false,
											    'teeny' => true,
											    'wpautop' => true,
											    //'reinit' => true,
											    'size' => 'large',
											    'editor_type' => 'tinymce',
											    'editor_height' => 200
												),
												
												'bottom_bar_style' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'value' => array(
														'style' => 'text',
													),
													'picker' => array(
														'style' => array(
															'label' => esc_html__( 'Bottom bar style', 'wplab-recover' ),
															'type' => 'radio',
															'choices' => array(
																'text' => esc_html__( 'Text only', 'wplab-recover' ),
																'text_menu' => esc_html__( 'Text and menu', 'wplab-recover' ),
															),
														)
													),
													'choices' => array(
														'text_menu' => array(
														
															'bottom_bar_menu' => array(
																'label' => esc_html__( 'Choose menu', 'wplab-recover' ),
																'type' => 'select',
																'choices' => $menus
															),
														
														)
													)
												),
	
											),
										),
									),

								
								)
							),
						
						)
					),
	
				)
			)
		),
	);