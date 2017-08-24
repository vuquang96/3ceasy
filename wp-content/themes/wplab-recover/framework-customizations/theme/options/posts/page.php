<?php 

global $wp_registered_sidebars, $wplab_recover_core;

/**
 * Get existing menus
 **/
$_existing_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

$_menus_array = array(
	'' => esc_html__('- Use Default menu -', 'wplab-recover'),
);

if( !empty( $_existing_menus ) ) {
	foreach( $_existing_menus as $_menu_item ) {
		$_menus_array[ $_menu_item->slug ] = $_menu_item->name;
	}
}

// get all sidebars
$theme_sidebars = array();
foreach( $wp_registered_sidebars as $sidebar ):
	$theme_sidebars[ $sidebar['id'] ] = $sidebar['name'];
endforeach;

/**
 * Page options array
 **/
$options = array(
	'header' => array(
		'title'   => esc_html__( 'Page Header Settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(
		
			'customize_page_header' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'enabled' => 'false',
				),
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Customize Page Header settings', 'wplab-recover' ),
						'desc' => esc_html__( 'This option overrides some of global header settings only for current page', 'wplab-recover' ),
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

						'disable_top_bar' => array(
							'label' => esc_html__( 'Disable Top Bar', 'wplab-recover' ),
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

						'header_style' => array(
							'label' => esc_html__( 'Header Style', 'wplab-recover' ),
							'type' => 'select',
							'choices' => array(
								'modern' => esc_html__( 'Modern', 'wplab-recover' ),
								'classic' => esc_html__( 'Classic', 'wplab-recover' ),
							),
							'value' => 'modern',
						),
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
										'desc' => esc_html__( 'in pixels. Follow clockwise: top, right, bottom, left', 'wplab-recover' ),
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
									
								)
							),

						),

					)
				
				)
			),
		
			'header_bg_img' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'source' => 'default',
				),
				'picker' => array(
					'source' => array(
						'label' => esc_html__( 'Header background image', 'wplab-recover' ),
						'desc' => esc_html__( 'This option changes Header Background Image for Modern Header style or Breadcrumbs background Image for Classic Header style. Can be applied only for Default page template', 'wplab-recover' ),
						'type' => 'radio',
						'choices' => array(
							'default' => esc_html__( 'Default (from general header settings)', 'wplab-recover' ),
							'custom' => esc_html__( 'Custom Background Image', 'wplab-recover' ),
						),
					)
				),
				'choices' => array(
					
					'custom' => array(
						'page_header_bg' => array(
							'label' => esc_html__( 'Image Source', 'wplab-recover' ),
							'desc' => esc_html__( 'It can be chaged individually for each page', 'wplab-recover' ),
							'type' => 'upload',
							'images_only' => true,
						),
					)
				
				)
			),
		
		)
	),
	'navigation' => array(
		'title'   => esc_html__( 'Navigation Settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(

			'enable_onepage_menu' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'enabled' => 'false',
				),
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'One-page navigation', 'wplab-recover' ),
						'desc' => esc_html__( 'If enabled, theme menu will work as one-page menu', 'wplab-recover' ),
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
					
						'onepage_update_hash' => array(
							'label' => esc_html__( 'Update URL Hash', 'wplab-recover' ),
							'type' => 'switch',
							'left-choice' => array(
								'value' => 0,
								'label' => esc_html__( 'No', 'wplab-recover' )
							),
							'right-choice' => array(
								'value' => 1,
								'label' => esc_html__( 'Yes', 'wplab-recover' )
							),
							'value' => 0,
						),
						'onepage_speed' => array(
							'label' => esc_html__( 'Navigation Speed', 'wplab-recover' ),
							'type'  => 'text',
							'value' => 750,
						),
						'onepage_offset' => array(
							'label' => esc_html__( 'Navigation Offset', 'wplab-recover' ),
							'type'  => 'text',
							'value' => 100,
						),
					
					)
					
				)
			),
			
			'page_menu' => array(
				'label' => esc_html__( 'Custom header navigation menu', 'wplab-recover' ),
				'type' => 'select',
				'value' => '',
				'choices' => $_menus_array,
				'desc' => esc_html__( 'Here you can change header navigation menu only for current page', 'wplab-recover' ),
			),

		),
	),
	'footer' => array(
		'title'   => esc_html__( 'Page Footer Settings', 'wplab-recover' ),
		'type'    => 'box',
		'options' => array(

			'customize_page_footer' => array(
				'type' => 'multi-picker',
				'label' => false,
				'desc' => false,
				'value' => array(
					'enabled' => 'false',
				),
				'picker' => array(
					'enabled' => array(
						'label' => esc_html__( 'Customize Page Footer settings', 'wplab-recover' ),
						'desc' => esc_html__( 'This option overrides some of global footer settings only for current page', 'wplab-recover' ),
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

						'footer_options' => array(
							'title' => esc_html__( 'Footer Settings', 'wplab-recover' ),
							'type' => 'tab',
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
										    'reinit' => true,
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
						'footer_side_options' => array(
							'title' => esc_html__( 'Primary Widget Area', 'wplab-recover' ),
							'type' => 'tab',
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
						'footer_side2_options' => array(
							'title' => esc_html__( 'Secondary Widget Area', 'wplab-recover' ),
							'type' => 'tab',
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
						'bottom_bar_options' => array(
							'title' => esc_html__( 'Bottom Bar', 'wplab-recover' ),
							'type' => 'tab',
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
										    'value'  => '<p style="text-align: center;">&copy;2016&nbsp;Recover WordPress Theme.</p><p style="text-align: center;">Developed by <a href="http://themeforest.net/user/wplab/?ref=wplab">WPlab.Pro</a> / Designed by <a href="http://themeforest.net/user/themefire/?ref=wplab">ThemeFire</a></p>',
										    'tinymce' => true,
										    'media_buttons' => false,
										    'teeny' => true,
										    'wpautop' => true,
										    'reinit' => true,
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
															'choices' => $_menus_array
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
				
				)
			),
		
		)
	),
);