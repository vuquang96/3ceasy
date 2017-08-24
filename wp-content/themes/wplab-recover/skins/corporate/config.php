<?php

	$skin_options = array(
		'basic_colors' => array(
			'title' => esc_html__('Basic Colors', 'wplab-recover'),
			'options' => array(
			
				'bg_body' => array(
					'label' => esc_html__('Body background color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fff'
				),
				'bg_wrap' => array(
					'label' => esc_html__('Wrapper background color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fff'
				),
				'bg_alter' => array(
					'label' => esc_html__('Alternate background color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#f3f3f3'
				),
				'text_color' => array(
					'label' => esc_html__('Text color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#7d7d7d'
				),
				'light_text' => array(
					'label' => esc_html__('Light text color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#c2c2c2'
				),
				'inverted_text_color' => array(
					'label' => esc_html__('Inverted text color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#7d7d7d'
				),
				'header_black' => array(
					'label' => esc_html__('Black text header color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#111'
				),
				'header_yellow' => array(
					'label' => esc_html__('Yellow text header color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fecb16'
				),
			
			)
		),
		'accent_colors' => array(
			'title' => esc_html__('Accent Colors', 'wplab-recover'),
			'options' => array(
			
				'color_accent_yellow' => array(
					'label' => esc_html__('Yellow accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fecb16'
				),
				'color_accent_grey' => array(
					'label' => esc_html__('Grey accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#f3f3f3'
				),
				'color_accent_green' => array(
					'label' => esc_html__('Green accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#8dc63f'
				),
				'color_accent_black' => array(
					'label' => esc_html__('Black accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#111'
				),
				'color_accent_blue' => array(
					'label' => esc_html__('Blue accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#55acee'
				),
				'color_accent_orange' => array(
					'label' => esc_html__('Orange accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#ff9700'
				),
				'color_accent_red' => array(
					'label' => esc_html__('Red accent color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#f05252'
				),
				'color_accent_inner' => array(
					'label' => esc_html__('Accent inner color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#111'
				),
				'color_accent_inner_inverted' => array(
					'label' => esc_html__('Accent inner inverted color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fff'
				),
				
			)
		),
		'dark_colors' => array(
			'title' => esc_html__('Dark Colors', 'wplab-recover'),
			'options' => array(
			
				'bg_footer' => array(
					'label' => esc_html__('Footer backround color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#0e0e0e'
				),
				'bg_footer2' => array(
					'label' => esc_html__('Second footer backround color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#111'
				),
				'bg_bottom_bar' => array(
					'label' => esc_html__('Bottom bar backround color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#0b0b0b'
				),
				'footer_text_color' => array(
					'label' => esc_html__('Footer text color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#555'
				),
				'footer_alt_text_color' => array(
					'label' => esc_html__('Footer alt text color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#363636'
				),
				'footer_heading_color' => array(
					'label' => esc_html__('Footer heading & links color', 'wplab-recover'),
					'type' => 'color_picker',
					'value' => '#fff'
				),
				
			)
		),
		'fonts' => array(
			'title' => esc_html__('Fonts', 'wplab-recover'),
			'options' => array(
			
				'primary_font' => array(
					'label' => esc_html__('Primary font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '16',
						'font_size_mobile' => '14',
						'line_height' => '30',
						'line_height_mobile' => '28',
						'font_style' => 'normal',
						'font_weight' => '300',
						'text_transform' => 'none',
						'font_variant' => 'normal',
						'font_family' => 'montserrat',
					)
				),
				
				'secondary_font' => array(
					'label' => esc_html__('Secondary font', 'wplab-recover'),
					'type' => 'font_family_picker',
					'value' => array(
						'font_family' => 'crimson_textroman',
					)
				),
				
				'h1_font' => array(
					'label' => esc_html__('Header 1 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '60',
						'font_size_mobile' => '38',
						'line_height' => '60',
						'line_height_mobile' => '38',
						'font_style' => 'normal',
						'font_weight' => '300',
						'text_transform' => 'none',
						'font_variant' => 'normal',
						'font_family' => 'montserrat',
					)
				),
				
				'h2_font' => array(
					'label' => esc_html__('Header 2 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '48',
						'font_size_mobile' => '28',
						'line_height' => '48',
						'line_height_mobile' => '28',
						'font_style' => 'normal',
						'font_weight' => '300',
						'text_transform' => 'none',
						'font_variant' => 'normal',
						'font_family' => 'montserrat',
					)
				),
				
				'h3_font' => array(
					'label' => esc_html__('Header 3 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '38',
						'font_size_mobile' => '26',
						'line_height' => '44',
						'line_height_mobile' => '30',
						'font_style' => 'normal',
						'font_weight' => '300',
						'text_transform' => 'none',
						'font_variant' => 'normal',
						'font_family' => 'montserrat',
					)
				),
				
				'h4_font' => array(
					'label' => esc_html__('Header 4 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '36',
						'font_size_mobile' => '26',
						'line_height' => '36',
						'line_height_mobile' => '26',
						'font_style' => 'normal',
						'font_weight' => '700',
						'text_transform' => 'none',
						'font_variant' => 'normal',
						'font_family' => 'montserrat',
					)
				),
				
				'h5_font' => array(
					'label' => esc_html__('Header 5 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '30',
						'font_size_mobile' => '25',
						'line_height' => '35',
						'line_height_mobile' => '30',
						'font_style' => 'normal',
						'font_weight' => '700',
						'text_transform' => 'none',
						'font_variant' => 'small-caps',
						'font_family' => 'montserrat',
					)
				),
				
				'h6_font' => array(
					'label' => esc_html__('Header 6 font', 'wplab-recover'),
					'type' => 'font_picker',
					'value' => array(
						'font_size' => '24',
						'font_size_mobile' => '20',
						'line_height' => '30',
						'line_height_mobile' => '25',
						'font_style' => 'normal',
						'font_weight' => '700',
						'text_transform' => 'none',
						'font_variant' => 'small-caps',
						'font_family' => 'montserrat',
					)
				),
			
			)
		),
		'bg_images' => array(
			'title' => esc_html__('Background Images', 'wplab-recover'),
			'options' => array(
			
				'content_bg_image' => array(
					'label' => esc_html__('Body background image', 'wplab-recover'),
					'type' => 'bg_picker',
					'value' => array(
						'background_image' => '',
						'background_repeat' => '',
						'background_position' => '',
						'background_size' => '',
						'background_fixed' => ''
					)
				),
				'wrap_bg_image' => array(
					'label' => esc_html__('Wrapper background image', 'wplab-recover'),
					'type' => 'bg_picker',
					'value' => array(
						'background_image' => '',
						'background_repeat' => '',
						'background_position' => '',
						'background_size' => '',
						'background_fixed' => ''
					)
				),
				'footer_bg1_image' => array(
					'label' => esc_html__('Footer (first widget area) background image', 'wplab-recover'),
					'type' => 'bg_picker',
					'value' => array(
						'background_image' => '',
						'background_repeat' => '',
						'background_position' => '',
						'background_size' => '',
						'background_fixed' => ''
					)
				),
				'footer_bg2_image' => array(
					'label' => esc_html__('Footer (second widget area) background image', 'wplab-recover'),
					'type' => 'bg_picker',
					'value' => array(
						'background_image' => '',
						'background_repeat' => '',
						'background_position' => '',
						'background_size' => '',
						'background_fixed' => ''
					)
				),
			
			)
		)
	);