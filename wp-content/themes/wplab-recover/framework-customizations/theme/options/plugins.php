<?php

	if ( ! defined( 'FW' ) ) {
		die( 'Forbidden' );
	}

	$options = array(
		array(
			'plugins' => array(
				'title' => esc_html__( 'Plugins', 'wplab-recover' ),
				'type' => 'tab',
				'options' => array(
	
					'woocommerce_options' => array(
						'title' => esc_html__( 'WooCommerce', 'wplab-recover' ),
						'type' => 'tab',
						'options' => array(
						
							'woocommerce_options-box' => array(
								'title' => esc_html__( 'WooCommerce Settings', 'wplab-recover' ),
								'type' => 'box',
								'options' => array(
									
									'shop_title' => array(
										'type'  => 'text',
										'label' => esc_html__('Shop title', 'wplab-recover'),
										'value' => esc_html__('Shop', 'wplab-recover'),
										'desc' => esc_html__('used in a page header', 'wplab-recover'),
									),
									'woo_posts_count' => array(
										'type'  => 'text',
										'label' => esc_html__('Posts per page', 'wplab-recover'),
										'value' => 9
									),
									'woo_products_per_row' => array(
										'type'  => 'text',
										'label' => esc_html__('Products per row', 'wplab-recover'),
										'value' => 3
									),
									'woo_share_links' => array(
										'label' => esc_html__( 'Display share links', 'wplab-recover' ),
										'desc' => esc_html__( 'in a single product page', 'wplab-recover' ),
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
									'woo_ordering_boxes' => array(
										'label' => esc_html__( 'Ordering boxes', 'wplab-recover' ),
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
										'desc' => esc_html__( 'If disabled, your shop will work as a simple Catalog', 'wplab-recover' ),
									),
								
								)
							),
						
						)
					),
	
				)
			)
		),
	);