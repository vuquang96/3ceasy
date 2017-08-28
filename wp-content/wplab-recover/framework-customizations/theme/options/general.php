<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'general' => array(
				'title' => esc_html__( 'General', 'wplab-recover' ),
				'type' => 'tab',
				'options' => array(

					'theme_options' => array(
						'title' => esc_html__( 'General options', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'theme_options-box' => array(
								'title' => esc_html__( 'General options', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'disable_lazy_loading' => array(
										'label' => esc_html__( 'Disable Lazy Loading for images', 'wplab-recover' ),
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

									'css_animations' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'CSS Animations', 'wplab-recover' ),
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
												'value' => 'true',
											)
										),
										'choices' => array(
											'true' => array(

												'css_animations_mobile' => array(
													'label' => esc_html__( 'CSS Animations for mobile devices', 'wplab-recover' ),
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
													'value' => 'true',
												),

											),
										),
										'show_borders' => false,
									),

									'page_preloader' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'value' => array(
											'style' => 'hidden',
										),
										'picker' => array(
											'style' => array(
												'label' => esc_html__( 'Page preloader', 'wplab-recover' ),
												'type' => 'radio',
												'choices' => array(
													'hidden' => esc_html__( 'Turn off page preloader', 'wplab-recover' ),
													'theme' => esc_html__( 'Percentage preloader', 'wplab-recover' ),
													'css' => esc_html__( 'Use CSS preloader from library', 'wplab-recover' ),
													'custom' => esc_html__( 'Upload custom image as a page preloader', 'wplab-recover' )
												),
											)
										),
										'choices' => array(
											'theme' => array(

												'logo' => array(
													'label' => esc_html__( 'Preloader Logo', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload custom logo (optional)', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'logo_2x' => array(
													'label' => esc_html__( 'Preloader Logo for Retina Displays', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload custom logo for Retina Displays (optional)', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'background' => array(
													'label' => esc_html__( 'Preloader Background image', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload background image (optional)', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'background_repeat' => array(
													'label' => esc_html__( 'Preloader Background image repeat', 'wplab-recover' ),
													'type' => 'select',
													'value' => 'repeat',
													'choices' => array(
														'no-repeat' => esc_html__( 'No repeat', 'wplab-recover' ),
														'repeat-x' => esc_html__( 'Repeat horizontally', 'wplab-recover' ),
														'repeat-y' => esc_html__( 'Repeat vertically', 'wplab-recover' ),
														'repeat' => esc_html__( 'Repeat horizontally and vertically', 'wplab-recover' ),
													),
												),
												'background_position' => array(
													'label' => esc_html__( 'Preloader Background image position', 'wplab-recover' ),
													'type' => 'select',
													'value' => 'left top',
													'choices' => array(
														'left top' => esc_html__( 'Left Top', 'wplab-recover' ),
														'center top' => esc_html__( 'Center Top', 'wplab-recover' ),
														'right top' => esc_html__( 'Right Top', 'wplab-recover' ),
														'left bottom' => esc_html__( 'Left Bottom', 'wplab-recover' ),
														'center bottom' => esc_html__( 'Center Bottom', 'wplab-recover' ),
														'right bottom' => esc_html__( 'Right Bottom', 'wplab-recover' ),
														'left center' => esc_html__( 'Left Center', 'wplab-recover' ),
														'center center' => esc_html__( 'Center Center', 'wplab-recover' ),
														'right center' => esc_html__( 'Right Center', 'wplab-recover' ),
													),
												),
												'bg_color' => array(
													'type'  => 'color-picker',
													'label' => esc_html__('Preloader Background Color', 'wplab-recover'),
													'value' => '#ffffff'
												),
												'progress_background' => array(
													'type'  => 'color-picker',
													'label' => esc_html__('Preloader Progress Bar Background', 'wplab-recover'),
													'value' => '#f3f3f3'
												),
												'accent_color' => array(
													'type'  => 'color-picker',
													'label' => esc_html__('Preloader Accent Color', 'wplab-recover'),
													'value' => '#fcd846'
												),

											),
											'css' => array(

												'css_preloader_style' => array(
													'label' => esc_html__( 'Choose preloader style', 'wplab-recover' ),
													'type' => 'select',
													'value' => '',
													'choices' => array(
														''  => '---',
														array (
															'attr' => array(
																'label' => esc_html__( 'Loaders.css Library', 'wplab-recover' ),
															),
															'choices' => array(
																'ball-pulse' => esc_html__('Ball pulse', 'wplab-recover'),
																'ball-grid-pulse' => esc_html__('Ball grid pulse', 'wplab-recover'),
																'ball-clip-rotate' => esc_html__('Ball clip rotate', 'wplab-recover'),
																'square-spin' => esc_html__('Square spin', 'wplab-recover'),
																'ball-clip-rotate-multiple' => esc_html__('Ball clip rotate multiple', 'wplab-recover'),
																'ball-pulse-rise' => esc_html__('Ball pulse rise', 'wplab-recover'),
																'ball-rotate' => esc_html__('Ball rotate', 'wplab-recover'),
																'cube-transition' => esc_html__('Cube transition', 'wplab-recover'),
																'ball-zig-zag' => esc_html__('Ball zig-zag', 'wplab-recover'),
																'ball-zig-zag-deflect' => esc_html__('Ball zig-zag deflect', 'wplab-recover'),
																'ball-triangle-path' => esc_html__('Ball triangle path', 'wplab-recover'),
																'ball-scale' => esc_html__('Ball scale', 'wplab-recover'),
																'line-scale' => esc_html__('Line scale', 'wplab-recover'),
																'line-scale-party' => esc_html__('Line scale party', 'wplab-recover'),
																'ball-scale-multiple' => esc_html__('Ball scale multiple', 'wplab-recover'),
																'ball-pulse-sync' => esc_html__('Ball pulse', 'wplab-recover'),
																'ball-beat' => esc_html__('Ball beat', 'wplab-recover'),
																'line-scale-pulse-out' => esc_html__('Line scale pulse out', 'wplab-recover'),
																'line-scale-pulse-out-rapid' => esc_html__('Line scale pulse out rapid', 'wplab-recover'),
																'ball-scale-ripple' => esc_html__('Ball scale ripple', 'wplab-recover'),
																'ball-scale-ripple-multiple' => esc_html__('Ball scale ripple multiple', 'wplab-recover'),
																'ball-spin-fade-loader' => esc_html__('Ball spin fade loader', 'wplab-recover'),
																'line-spin-fade-loader' => esc_html__('Line spin fade loader', 'wplab-recover'),
																'triangle-skew-spin' => esc_html__('Triangle skew spin', 'wplab-recover'),
																'pacman' => esc_html__('Pacman', 'wplab-recover'),
																'ball-grid-beat' => esc_html__('Grid beat', 'wplab-recover'),
																'semi-circle-spin' => esc_html__('Cemi circle spin', 'wplab-recover'),
															),
														),
													),
												),

											),
											'custom' => array(
												'custom_preloader_image' => array(
													'label' => esc_html__( 'Preloader image', 'wplab-recover' ),
													'desc' => esc_html__( 'Choose your own preloader image', 'wplab-recover' ),
													'type' => 'upload',
												),
												'custom_preloader_image_2x' => array(
													'label' => esc_html__( 'Preloader image for Retina Displays', 'wplab-recover' ),
													'desc' => esc_html__( 'Choose your own preloader image for Retina Displays.', 'wplab-recover' ),
													'type' => 'upload',
													'help'  => esc_html__( 'It should be in a twice size of your custom preloader image.', 'wplab-recover' ),
												),
												'custom_preloader_image_width' => array(
													'label' => esc_html__( 'Preloader image width', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
													'help' => esc_html__( 'Type here a width of preloader image in pixels, e.g.: 50', 'wplab-recover' ),
												),
												'custom_preloader_image_height' => array(
													'label' => esc_html__( 'Preloader image Height', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
													'help' => esc_html__( 'Type here a height of preloader image in pixels, e.g.: 50', 'wplab-recover' ),
												),
											),
										),
										'show_borders' => false,
									),

									'custom_inputs' => array(
										'label' => esc_html__( 'Custom styles for form inputs', 'wplab-recover' ),
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
										'desc' => esc_html__( 'Disable custom inputs if you have problems with some third-party plugins', 'wplab-recover' ),
									),

									'smooth_scrolling' => array(
										'label' => esc_html__( 'Smooth Scrolling', 'wplab-recover' ),
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
										'value' => 'false',
										'desc' => esc_html__( 'If enabled, theme adds some delay when you scroll a website using a mouse scroller', 'wplab-recover' ),
									),

									'dev_info' => array(
										'label' => esc_html__( 'Display information for developers', 'wplab-recover' ),
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
										'value' => 'false',
										'help' => esc_html__('If enabled, developers information will be displayed in HTML comment after primary footer tag.', 'wplab-recover'),
										'desc' => esc_html__('Page generation time and SQL queries count', 'wplab-recover' ),
									),

								)
							),

						),
					),

					'layout_options' => array(
						'title' => esc_html__( 'Layout', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'layout_options-box' => array(
								'title' => esc_html__( 'Layout', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'body_layout' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'value' => array(
											'style' => 'wide',
										),
										'picker' => array(
											'style' => array(
												'label' => esc_html__( 'Page layout', 'wplab-recover' ),
												'type' => 'radio',
												'choices' => array(
													'wide' => esc_html__( 'Wide', 'wplab-recover' ),
													'boxed' => esc_html__( 'Boxed', 'wplab-recover' ),
													'framed' => esc_html__( 'Framed', 'wplab-recover' ),
												),
											)
										),
										'choices' => array(
											'boxed' => array(

												'wrapper_width' => array(
													'label' => esc_html__( 'Wrapper width', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '1400',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
												),

											),
											'framed' => array(

												'wrapper_width' => array(
													'label' => esc_html__( 'Wrapper width', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '1400',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
												),
												'wrapper_margin_top' => array(
													'label' => esc_html__( 'Wrapper top margin', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '25',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
												),
												'wrapper_margin_bottom' => array(
													'label' => esc_html__( 'Wrapper bottom margin', 'wplab-recover' ),
													'type' => 'short-text',
													'value' => '25',
													'desc' => esc_html__( 'value in pixels', 'wplab-recover' ),
												),

											),
										)
									),

								)
							),

						)
					),

					'fonts_options' => array(
						'title' => esc_html__( 'Fonts', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'fonts_options-box' => array(
								'title' => esc_html__( 'Fonts', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'default_fonts' => array(
										'label' => esc_html__( 'Default theme fonts', 'wplab-recover' ),
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

									'custom_fonts' => array(
										'type'          => 'addable-popup',
										'label'         => esc_html__( 'Custom Fonts', 'wplab-recover' ),
										'popup-title'   => esc_html__( 'Add/Edit Custom Font', 'wplab-recover' ),
										'desc'          => esc_html__( 'Add Custom Font', 'wplab-recover' ),
										'template'      => '{{=title}}',
										'popup-options' => array(
											'title' => array(
												'type'  => 'text',
												'label' => esc_html__('Font title', 'wplab-recover'),
												'desc'  => esc_html__('e.g. My Custom Font', 'wplab-recover'),
											),
											'font_family' => array(
												'type'  => 'text',
												'label' => esc_html__('CSS Font family', 'wplab-recover'),
												'desc'  => esc_html__('e.g. my-cusom-font', 'wplab-recover'),
											),
											'file_eot' => array(
												'type'  => 'upload',
												'label' => esc_html__('Font file in EOT format', 'wplab-recover'),
												'desc'  => esc_html__('TIP: this file can be generated through <a href="http://www.fontsquirrel.com/" target="_blank">FontSquirrel</a>', 'wplab-recover'),
												'images_only' => false,
											),
											'file_woff' => array(
												'type'  => 'upload',
												'label' => esc_html__('Font file in WOFF format', 'wplab-recover'),
												'desc'  => esc_html__('TIP: this file can be generated through <a href="http://www.fontsquirrel.com/" target="_blank">FontSquirrel</a>', 'wplab-recover'),
												'images_only' => false,
											),
											'file_woff2' => array(
												'type'  => 'upload',
												'label' => esc_html__('Font file in WOFF2 format', 'wplab-recover'),
												'desc'  => esc_html__('TIP: this file can be generated through <a href="http://www.fontsquirrel.com/" target="_blank">FontSquirrel</a>', 'wplab-recover'),
												'images_only' => false,
											),
											'file_truetype' => array(
												'type'  => 'upload',
												'label' => esc_html__('Font file in TrueType format', 'wplab-recover'),
												'desc'  => esc_html__('TIP: this file can be generated through <a href="http://www.fontsquirrel.com/" target="_blank">FontSquirrel</a>', 'wplab-recover'),
												'images_only' => false,
											),
											'file_svg' => array(
												'type'  => 'upload',
												'label' => esc_html__('Font file in SVG format', 'wplab-recover'),
												'desc'  => esc_html__('TIP: this file can be generated through <a href="http://www.fontsquirrel.com/" target="_blank">FontSquirrel</a>', 'wplab-recover'),
												'images_only' => false,
											),
										),
									),

									'font_subsets' => array(
									  'type'  => 'checkboxes',
									  'value' => array(
									    'latin' => true,
									    'latin-ext' => false,
									    'cyrillic' => false,
									    'cyrillic-ext' => false,
									    'greek' => false,
									    'greek-ext' => false,
									    'vietnamese' => false,
									  ),
									  'label' => esc_html__('Google Fonts Additional subsets', 'wplab-recover'),
									  'desc'  => esc_html__('Here you can load additional subsets for Google Fonts', 'wplab-recover'),
									  'choices' => array(
									    'latin' => esc_html__('Latin', 'wplab-recover'),
									    'latin-ext' => esc_html__('Latin Extended', 'wplab-recover'),
									    'cyrillic' => esc_html__('Cyrillic', 'wplab-recover'),
									    'cyrillic-ext' => esc_html__('Cyrillic Extended', 'wplab-recover'),
									    'greek' => esc_html__('Greek', 'wplab-recover'),
									    'greek-ext' => esc_html__('Greek Extended', 'wplab-recover'),
									    'vietnamese' => esc_html__('Vietnamese', 'wplab-recover'),
									  ),
									),

									'font_styles' => array(
									  'type'  => 'checkboxes',
									  'value' => array(
									    '100' => true,
									    '100italic' => false,
									    '300' => false,
									    '300italic' => false,
									    '400' => true,
									    '400italic' => false,
									    '600' => false,
									    '600italic' => false,
									    '700' => true,
									    '700italic' => false,
									    '800' => false,
									    '800italic' => false,
									  ),
									  'label' => esc_html__('Google Fonts Additional styles', 'wplab-recover'),
									  'desc'  => esc_html__('Here you can load additional font styles for Google Fonts', 'wplab-recover'),
									  'choices' => array(
									    '100' => esc_html__('Thin 100', 'wplab-recover'),
									    '100italic' => esc_html__('Thin 100 Italic', 'wplab-recover'),
									    '300' => esc_html__('Light 300', 'wplab-recover'),
									    '300italic' => esc_html__('Light 300 Italic', 'wplab-recover'),
									    '400' => esc_html__('Normal 400', 'wplab-recover'),
									    '400italic' => esc_html__('Normal 400 Italic', 'wplab-recover'),
									    '600' => esc_html__('Semi-bold 600', 'wplab-recover'),
									    '600italic' => esc_html__('Semi-bold 600 Italic', 'wplab-recover'),
									    '700' => esc_html__('Bold 700', 'wplab-recover'),
									    '700italic' => esc_html__('Bold 700 Italic', 'wplab-recover'),
									    '800' => esc_html__('Extra-bold 800', 'wplab-recover'),
									    '800italic' => esc_html__('Extra-bold 800 Italic', 'wplab-recover'),
									  ),
									),

								)
							)

						)
					),

					'blog' => array(
						'title' => esc_html__( 'Blog', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'blog_title-box' => array(
								'title' => esc_html__( 'Custom titles', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'blog_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Blog title', 'wplab-recover'),
										'value' => esc_html__('Our News', 'wplab-recover')
									),
									'read_more_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Read more text', 'wplab-recover'),
										'value' => esc_html__('Read more', 'wplab-recover')
									),
									'load_more_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Load more text', 'wplab-recover'),
										'desc' => esc_html__('Used in AJAX pagination', 'wplab-recover'),
										'value' => esc_html__('Load More Posts', 'wplab-recover')
									),

								)
							),

							'blog_tpls-box' => array(
								'title' => esc_html__( 'Default blog category / tag / archive template', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'blog_template' => array(
										'label' => esc_html__( 'Choose default blog template', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'cols_1',
										'choices' => array(
											'cols_1' => esc_html__('1 column', 'wplab-recover'),
											'cols_2' => esc_html__('2 columns', 'wplab-recover'),
											'masonry' => esc_html__('Masonry', 'wplab-recover'),
										),
									),

								)
							),

							'blog_dates-box' => array(
								'title' => esc_html__( 'Posts date styling', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'dates_style' => array(
										'label' => esc_html__( 'Dates style', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'default',
										'choices' => array(
											'default' => esc_html__('Use global WordPress date settings', 'wplab-recover'),
											'day_month' => esc_html__('Use Day + Month style', 'wplab-recover'),
										),
									),

								)
							),

							'blog_settings-box' => array(
								'title' => esc_html__( 'Single post options', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'display_thumbnail_on_single' => array(
										'label' => esc_html__( 'Display featured image on a single post page', 'wplab-recover' ),
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

									'display_share_links' => array(
										'label' => esc_html__( 'Display share links', 'wplab-recover' ),
										'type' => 'switch',
										'desc' => esc_html__( 'this settings will show or hide social share links on a single post', 'wplab-recover' ),
										'right-choice' => array(
											'value' => 'true',
											'label' => esc_html__( 'Yes', 'wplab-recover' )
										),
										'left-choice' => array(
											'value' => 'false',
											'color' => '#ccc',
											'label' => esc_html__( 'No', 'wplab-recover' )
										),
										'value' => 'false',
									),

									'display_tags_after_post' => array(
										'label' => esc_html__( 'Display tags list after post content', 'wplab-recover' ),
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

									'display_author_after_post' => array(
										'label' => esc_html__( 'Display author information after post content', 'wplab-recover' ),
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

									'display_prev_next_blog_links' => array(
										'label' => esc_html__( 'Display Previous / Next post links', 'wplab-recover' ),
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
										'value' => 'false',
									),

								)
							),

							'rss_settings-box' => array(
								'title' => esc_html__( 'RSS Feed', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'rss_feed' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'RSS Feed', 'wplab-recover' ),
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
												'value' => 'true',
											)
										),
										'choices' => array(
											'true' => array(

												'display_thumbnails_in_rss' => array(
													'label' => esc_html__( 'Add post thumbnails to the RSS Feed', 'wplab-recover' ),
													'type' => 'switch',
													'desc' => esc_html__( 'If enabled, post thumbnail will be added for each post in your RSS feed', 'wplab-recover' ),
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
										'show_borders' => false,
									),

								)
							)

						)
					),

					'portfolio' => array(
						'title' => esc_html__( 'Portfolio', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'portfolio_title-box' => array(
								'title' => esc_html__( 'Custom titles', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'portfolio_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Portfolio title', 'wplab-recover'),
										'value' => esc_html__('Our Projects', 'wplab-recover')
									),
									'portfolio_archive_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Archive title', 'wplab-recover'),
										'value' => esc_html__('Our projects in % category', 'wplab-recover'),
										'desc' => esc_html__('% will be replaced with current query', 'wplab-recover'),
									),
									'portfolio_load_more_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Load more text', 'wplab-recover'),
										'desc' => esc_html__('Used in AJAX pagination', 'wplab-recover'),
										'value' => esc_html__('Load More Projects', 'wplab-recover')
									),

								)
							),

							'portfolio_single-box' => array(
								'title' => esc_html__( 'Single project options', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'display_prev_next_portfolio_links' => array(
										'label' => esc_html__( 'Display Previous / Next project links', 'wplab-recover' ),
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
										'value' => 'false',
									),

								)
							),

							'portfolio_archive-box' => array(
								'title' => esc_html__( 'Archive / Category page settings', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'portfolio_archive_style' => array(
										'label' => esc_html__( 'Output style', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'cols_3',
										'choices' => array(
											'cols_3' => esc_html__('3 columns', 'wplab-recover'),
											'cols_3_no_spaces' => esc_html__('3 columns, no spaces', 'wplab-recover'),
											'cols_3_desc' => esc_html__('3 columns with a short description', 'wplab-recover'),
											//'cols_3_modern' => esc_html__('3 columns with animated preview', 'wplab-recover'),
										),
									),

									'portfolio_archive_display_preview' => array(
										'label' => esc_html__( 'Display preview link', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'false',
										'choices' => array(
											'true' => esc_html__('Yes', 'wplab-recover'),
											'false' => esc_html__('No', 'wplab-recover'),
										),
									),

									'portfolio_archive_hover_effect' => array(
										'label' => esc_html__( 'Hover effect', 'wplab-recover' ),
										'type' => 'select',
										'value' => 'fade',
										'choices' => array(
											'fade' => esc_html__('Fade', 'wplab-recover'),
											'slide_top' => esc_html__('Slide from top', 'wplab-recover'),
											'slide_right' => esc_html__('Slide from right', 'wplab-recover'),
											'zoom' => esc_html__('Zoom', 'wplab-recover'),
											'clap_1' => esc_html__('Clap #1', 'wplab-recover'),
											'clap_2' => esc_html__('Clap #2', 'wplab-recover'),
											'burn' => esc_html__('Burn', 'wplab-recover'),
										),
									),

								)
							),

							'portfolio_imgs-box' => array(
								'title' => esc_html__( 'Image sizes', 'wplab-recover' ),
								'type' => 'box',
						    'attr' => array(
					        'class' => 'prevent-auto-close'
						    ),
								'options' => array(

									'portfolio_3cols_thumb_width' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns preview image width', 'wplab-recover'),
										'desc' => esc_html__('thumbnail width', 'wplab-recover'),
										'value' => 370
									),
									'portfolio_3cols_thumb_height' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns preview image height', 'wplab-recover'),
										'desc' => esc_html__('thumbnail height', 'wplab-recover'),
										'value' => 270
									),

									'portfolio_3cols_desc_thumb_width' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns (with description) preview image width', 'wplab-recover'),
										'desc' => esc_html__('thumbnail width', 'wplab-recover'),
										'value' => 370
									),
									'portfolio_3cols_desc_thumb_height' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns (with description) preview image height', 'wplab-recover'),
										'desc' => esc_html__('thumbnail height', 'wplab-recover'),
										'value' => 250
									),

									'portfolio_3cols_nospace_thumb_width' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns (no space) preview image width', 'wplab-recover'),
										'desc' => esc_html__('thumbnail width', 'wplab-recover'),
										'value' => 390
									),
									'portfolio_3cols_nospace_thumb_height' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio 3 columns (no space) preview image height', 'wplab-recover'),
										'desc' => esc_html__('thumbnail height', 'wplab-recover'),
										'value' => 390
									),

									'portfolio_alt_thumb_width' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio Alt preview image width', 'wplab-recover'),
										'desc' => esc_html__('thumbnail width', 'wplab-recover'),
										'value' => 480
									),
									'portfolio_alt_thumb_height' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio Alt preview image height', 'wplab-recover'),
										'desc' => esc_html__('thumbnail height', 'wplab-recover'),
										'value' => 330
									),

									'portfolio_dark_carousel_thumb_width' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio Dark Carousel preview image width', 'wplab-recover'),
										'desc' => esc_html__('thumbnail width', 'wplab-recover'),
										'value' => 480
									),
									'portfolio_dark_carousel_thumb_height' => array(
										'type'  => 'short-text',
										'label' => esc_html__('Portfolio Dark Carousel preview image height', 'wplab-recover'),
										'desc' => esc_html__('thumbnail height', 'wplab-recover'),
										'value' => 480
									),

								)
							),

						)
					),

					'page_404' => array(
						'title' => esc_html__( 'Page 404', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'page_404_settings-box' => array(
								'title' => esc_html__( 'Page 404 Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'page_404_content' => array(
								    'type'  => 'wp-editor',
								    'label' => esc_html__('Page 404 content', 'wplab-recover'),
								    'value'  => '<h1 style="text-align: center;"><strong>404</strong> Page Not Found</h1><p style="text-align: center;">The page you are looking for does not appear to exist.<br/>Please go back or head on over our homepage to choose a new direction.</p>',
								    'tinymce' => true,
								    'media_buttons' => false,
								    'teeny' => true,
								    'wpautop' => true,
								    'reinit' => true,
								    'size' => 'large',
								    'editor_type' => 'tinymce',
								    'editor_height' => 200
									),
									'page_404_search_form' => array(
										'label' => esc_html__( 'Display search form', 'wplab-recover' ),
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
									'page_404_buttons' => array(
										'label' => esc_html__( 'Display back / home buttons', 'wplab-recover' ),
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

								)
							)

						)
					),

					'social' => array(
						'title' => esc_html__( 'Social Icons', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'social_icons-box' => array(
								'title' => esc_html__( 'Social Icons', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'facebook_url' => array(
										'label' => esc_html__( 'Facebook URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your Facebook profile URL', 'wplab-recover' ),
									),
									'twitter_url' => array(
										'label' => esc_html__( 'Twitter URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your Twitter profile URL', 'wplab-recover' ),
									),
									'linkedin_url' => array(
										'label' => esc_html__( 'LinkedIn URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your LinkedIn profile URL', 'wplab-recover' ),
									),
									'foursquare_url' => array(
										'label' => esc_html__( 'Foursquare URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your Foursquare profile URL', 'wplab-recover' ),
									),
									'google_plus_url' => array(
										'label' => esc_html__( 'Google Plus URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your Google Plus profile URL', 'wplab-recover' ),
									),
									'youtube_url' => array(
										'label' => esc_html__( 'YouTube URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your YouTube profile URL', 'wplab-recover' ),
									),
									'instagram_url' => array(
										'label' => esc_html__( 'Instagram URL', 'wplab-recover' ),
										'type'  => 'text',
										'value' => '',
										'desc'  => esc_html__( 'Paste here your Instagram profile URL', 'wplab-recover' ),
									),
									'rss_icon' => array(
										'label' => esc_html__( 'Display RSS icon', 'wplab-recover' ),
										'desc' => esc_html__( 'if RSS enabled in theme options', 'wplab-recover' ),
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

						),
					),

					'extra' => array(
						'title' => esc_html__( 'Extra Settings', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'extra-settings-box' => array(
								'title' => esc_html__( 'Extra Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'hide_admin_bar' => array(
										'label' => esc_html__( 'Hide Admin Bar', 'wplab-recover' ),
										'type' => 'switch',
										'desc' => esc_html__( 'for logged non-admins at front-end part', 'wplab-recover' ),
										'right-choice' => array(
											'value' => 'true',
											'label' => esc_html__( 'Yes', 'wplab-recover' )
										),
										'left-choice' => array(
											'value' => 'false',
											'color' => '#ccc',
											'label' => esc_html__( 'No', 'wplab-recover' )
										),
										'value' => 'false',
									),

									'logout_non_admins' => array(
										'label' => esc_html__( 'Disable access to WP admin for logged non-admin users', 'wplab-recover' ),
										'type' => 'switch',
										'desc' => esc_html__( 'If enabled, registered non-admins will be redirected to the website home if they try to access the admin panel', 'wplab-recover' ),
										'right-choice' => array(
											'value' => 'true',
											'label' => esc_html__( 'Yes', 'wplab-recover' )
										),
										'left-choice' => array(
											'value' => 'false',
											'color' => '#ccc',
											'label' => esc_html__( 'No', 'wplab-recover' )
										),
										'value' => 'false',
									),

								)
							),

						),
					),
					'maintenance' => array(
						'title' => esc_html__( 'Maintenance / Coming Soon', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(

							'maintenance-box' => array(
								'title' => esc_html__( 'Maintenance / Coming Soon', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(

									'maintenance_mode' => array(
										'type' => 'multi-picker',
										'label' => false,
										'desc' => false,
										'picker' => array(
											'enabled' => array(
												'label' => esc_html__( 'Maintenace / Coming Soon', 'wplab-recover' ),
												'desc' => esc_html__( 'Temporary dsable your webste for visitors', 'wplab-recover' ),
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

												'title' => array(
													'type'  => 'text',
													'label' => esc_html__('Page title', 'wplab-recover'),
													'value' => esc_html__('Under Construction', 'wplab-recover')
												),
												'subtitle' => array(
													'type'  => 'text',
													'label' => esc_html__('Page sub-title', 'wplab-recover'),
													'value' => esc_html__('Coming Soon... To Place Near You!', 'wplab-recover')
												),
												'content' => array(
													'type'  => 'textarea',
													'label' => esc_html__('Free HTML / text', 'wplab-recover'),
													'desc' => esc_html__('Here you can paste any content that will appear on Maintenance page, e.g. subscribe form', 'wplab-recover')
												),
												'countdown' => array(
													'type' => 'multi-picker',
													'label' => false,
													'desc' => false,
													'picker' => array(
														'enabled' => array(
															'label' => esc_html__( 'Display Countdown', 'wplab-recover' ),
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
															'date' => array(
																'type'  => 'date-picker',
																'label' => esc_html__('Planned opening date', 'wplab-recover'),
															),
														)
													)
												),
												'background' => array(
													'label' => esc_html__( 'Background image', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload background image', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'logo' => array(
													'label' => esc_html__( 'Logo', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload custom logo', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),
												'logo_2x' => array(
													'label' => esc_html__( 'Logo for Retina Displays', 'wplab-recover' ),
													'desc' => esc_html__( 'Upload custom logo for Retina Displays', 'wplab-recover' ),
													'type' => 'upload',
													'images_only' => true,
												),

											)
										)
									)

								)
							)

						)
					)

				)
			)
		),
	);
