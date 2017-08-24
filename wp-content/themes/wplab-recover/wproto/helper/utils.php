<?php
	/**
	 * Utils helper
	 **/
	class wplab_recover_utils {
		
		/**
		 * Locate path, child themes support
		 **/
 		public static function locate_path( $path ) {
 			
 			$base = get_stylesheet_directory();
 			
			if( is_child_theme() ) {
				$full_path = $base . $path;
				if( ! file_exists( $full_path ) ) {
					$base = get_template_directory();
					$full_path = $base . $path;
				}
			} else {
				$full_path = $base . $path;
			}
			
			return $full_path;
			
 		}
 		
 		/**
 		 * Sanitize link
 		 **/
		public static function sanitize_link( $text ) {
			return str_replace( 'http:', '', str_replace( 'https:', '', $text ) );
		}
		
		/**
		 * Make sure that Unyson is active
		 **/
		public static function is_unyson() {
			return defined('FW') && function_exists('fw_get_db_settings_option');
		}
		
		/**
		 * If Visual Editor was used
		 **/
		public static function is_custom_template( $for = 'all' ) {
			if( $for == 'all' ) {
				return self::is_unyson() && fw_ext_page_builder_is_builder_post( get_the_ID() );
			} elseif( $for = 'page' ) {
				return is_page() && self::is_unyson() && fw_ext_page_builder_is_builder_post( get_the_ID() );
			}
		}
		
		/**
		 * Make sure that WooCommerce is active
		 **/
		public static function is_woocommerce() {
			return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
		}
		
		/**
		 * Make a CSS style string from params
		 * @param array
		 **/
		public static function get_styles( $styles, $unit = 'px' ) {
			
			$css_string = '';
			
			if( isset( $styles['width'] ) && $styles['width'] <> '' ) {
				$css_string .= is_numeric( $styles['width'] ) ? 'width: ' . $styles['width'] . $unit . '; ' : 'width: ' . $styles['width'] . ';';
			}
			
			if( isset( $styles['height'] ) && $styles['height'] <> '' ) {
				$css_string .= is_numeric( $styles['height'] ) ? 'height: ' . $styles['height'] . $unit . '; ' : 'height: ' . $styles['height'] . ';';
			}
			
			if( isset( $styles['top_margin'] ) && $styles['top_margin'] <> '' ) {
				$css_string .= is_numeric( $styles['top_margin'] ) ? 'margin-top: ' . $styles['top_margin'] . $unit . '; ' : 'margin-top: ' . $styles['top_margin'] . ';';
			}
			
			if( isset( $styles['right_margin'] ) && $styles['right_margin'] <> '' ) {
				$css_string .= is_numeric( $styles['right_margin'] ) ? 'margin-right: ' . $styles['right_margin'] . $unit . '; ' : 'margin-right: ' . $styles['right_margin'] . ';';
			}
			
			if( isset( $styles['bottom_margin'] ) && $styles['bottom_margin'] <> '' ) {
				$css_string .= is_numeric( $styles['bottom_margin'] ) ? 'margin-bottom: ' . $styles['bottom_margin'] . $unit . '; ' : 'margin-bottom: ' . $styles['bottom_margin'] . ';';
			}
			
			if( isset( $styles['left_margin'] ) && $styles['left_margin'] <> '' ) {
				$css_string .= is_numeric( $styles['left_margin'] ) ? 'margin-left: ' . $styles['left_margin'] . $unit . '; ' : 'margin-left: ' . $styles['left_margin'] . ';';
			}
			
			if( isset( $styles['top_padding'] ) && $styles['top_padding'] <> '' ) {
				$css_string .= is_numeric( $styles['top_padding'] ) ? 'padding-top: ' . $styles['top_padding'] . $unit . '; ' : 'padding-top: ' . $styles['top_padding'] . ';';
			}
			
			if( isset( $styles['right_padding'] ) && $styles['right_padding'] <> '' ) {
				$css_string .= is_numeric( $styles['right_padding'] ) ? 'padding-right: ' . $styles['right_padding'] . $unit . '; ' : 'padding-right: ' . $styles['right_padding'] . ';';
			}
			
			if( isset( $styles['bottom_padding'] ) && $styles['bottom_padding'] <> '' ) {
				$css_string .= is_numeric( $styles['bottom_padding'] ) ? 'padding-bottom: ' . $styles['bottom_padding'] . $unit . '; ' : 'padding-bottom: ' . $styles['bottom_padding'] . ';';
			}
			
			if( isset( $styles['left_padding'] ) && $styles['left_padding'] <> '' ) {
				$css_string .= is_numeric( $styles['left_padding'] ) ? 'padding-left: ' . $styles['left_padding'] . $unit . '; ' : 'padding-left: ' . $styles['left_padding'] . ';';
			}
			
			if( isset( $styles['top_border'] ) && $styles['top_border'] <> '' ) {
				$css_string .= is_numeric( $styles['top_border'] ) ? 'border-top-width: ' . $styles['top_border'] . $unit . '; ' : 'border-top-width: ' . $styles['top_border'] . ';';
			}
			
			if( isset( $styles['right_border'] ) && $styles['right_border'] <> '' ) {
				$css_string .= is_numeric( $styles['right_border'] ) ? 'border-right-width: ' . $styles['right_border'] . $unit . '; ' : 'border-right-width: ' . $styles['right_border'] . ';';
			}
			
			if( isset( $styles['bottom_border'] ) && $styles['bottom_border'] <> '' ) {
				$css_string .= is_numeric( $styles['bottom_border'] ) ? 'border-bottom-width: ' . $styles['bottom_border'] . $unit . '; ' : 'border-bottom-width: ' . $styles['bottom_border'] . ';';
			}
			
			if( isset( $styles['left_border'] ) && $styles['left_border'] <> '' ) {
				$css_string .= is_numeric( $styles['left_border'] ) ? 'border-left-width: ' . $styles['left_border'] . $unit . '; ' : 'border-left-width: ' . $styles['left_border'] . ';';
			}
			
			if( isset( $styles['top_border_radius'] ) && $styles['top_border_radius'] <> '' ) {
				$css_string .= is_numeric( $styles['top_border_radius'] ) ? 'border-top-left-radius: ' . $styles['top_border_radius'] . $unit . '; ' : 'border-top-left-radius: ' . $styles['top_border_radius'] . ';';
			}
			
			if( isset( $styles['right_border_radius'] ) && $styles['right_border_radius'] <> '' ) {
				$css_string .= is_numeric( $styles['right_border_radius'] ) ? 'border-top-right-radius: ' . $styles['right_border_radius'] . $unit . '; ' : 'border-top-right-radius: ' . $styles['right_border_radius'] . ';';
			}
			
			if( isset( $styles['bottom_border_radius'] ) && $styles['bottom_border_radius'] <> '' ) {
				$css_string .= is_numeric( $styles['bottom_border_radius'] ) ? 'border-bottom-right-radius: ' . $styles['bottom_border_radius'] . $unit . '; ' : 'border-bottom-right-radius: ' . $styles['bottom_border_radius'] . ';';
			}
			
			if( isset( $styles['left_border_radius'] ) && $styles['left_border_radius'] <> '' ) {
				$css_string .= is_numeric( $styles['left_border_radius'] ) ? 'border-bottom-left-radius: ' . $styles['left_border_radius'] . $unit . '; ' : 'border-bottom-left-radius: ' . $styles['left_border_radius'] . ';';
			}
			
			return $css_string;
			
		}
		
		/**
		 * Get post categories list
		 **/
		public static function get_categories( $separator = ', ' ) {
			
			$post_type = get_post_type();
			
			switch( $post_type ) {
				default:
				case 'post':
					return wplab_recover_utils::get_valid_category_list( $separator );
				break;
				case 'fw-portfolio':
					return get_the_term_list( get_the_ID(), 'fw-portfolio-category', '', $separator, '' );
				break;
			}
			
		}
		
		public static function get_valid_category_list( $separator = ', ' ) {
			$s = str_replace( ' rel="category"', '', get_the_category_list( $separator ) );
			$s = str_replace( ' rel="category tag"', '', $s );
			return $s;
		}
		
		public static function get_valid_tags_list( $separator = ', ' ) {
			$s = str_replace( ' rel="tag"', '', get_the_tag_list( '', $separator, '' ) );
			return $s;
		}
		
		/**
		 * Get post / page content classes
		 **/
		public static function get_content_classes() {
			
			$classes_string = '';
			
			// If Unyson Framework plugin is active
			if( self::is_unyson() && function_exists('fw_ext_sidebars_get_current_position') ) {
				
				$current_sidebar_position = fw_ext_sidebars_get_current_position();
				
				$sidebar_size = fw_get_db_settings_option( 'sidebar_size' );
				$sidebar_size = absint( $sidebar_size );
				
				if( $sidebar_size <=0 || $sidebar_size > 5 ) {
					$sidebar_size = 3;
				}
				
				$content_size = 12 - $sidebar_size;
				
				if( $current_sidebar_position == 'full' ) {
					$classes_string = 'col-md-12';
				} elseif( $current_sidebar_position == 'left' ) {
					$classes_string = 'col-md-' . $content_size;
				} else {
					$classes_string = 'col-md-' . $content_size;
				}
				
			} else {
				$classes_string = 'col-md-9';
			}
			
			return $classes_string;
			
		}
		
		/**
		 * Remove shortcode from string
		 **/
		public static function strip_shortcode( $code, $content ) {
	    global $shortcode_tags;
	
	    $stack = $shortcode_tags;
	    $shortcode_tags = array( $code => 1 );
	
	    $content = strip_shortcodes( $content );
	
	    $shortcode_tags = $stack;
	    return $content;
		}
		
		/**
		 * Get post media from content
		 **/
		public static function get_media( $post_format ) {
			$header_media = '';
			if( in_array( $post_format, array( 'video', 'audio' ) )) {
				$post_content = get_post_field( 'post_content', get_the_ID() );
				
				$media = get_media_embedded_in_content( $post_content );
				if( isset( $media[0] ) && $media[0] <> '' ) {
					$header_media = $media[0];
				} else {
					$media_arr = preg_match('~\[vc_video\s+link\s*=\s*("|\')(?<url>.*?)\1\s*\]~i', $post_content, $matches );
					if( isset( $matches['url'] ) && $matches['url'] <> '' ) {
						$header_media = do_shortcode('[vc_video link="' . $matches['url'] . '"]');
					}
				}
		
			}
			return $header_media;
		}
		
		/**
		 * Get post gallery shortcode
		 **/
		public static function get_gallery() {
			$post_gallery = '';
			$content = get_post_field( 'post_content', get_the_ID() );
			if( has_shortcode( $content, 'gallery') ) {
				$post_gallery_arr = preg_match('/\[gallery ids=[^\]]+\]/', $content, $matches);
				$post_gallery = isset( $matches[0] ) ? $matches[0] : '';
				
			}
			return $post_gallery;
		}
		
		/**
		 * Do Gallery shortcode for AJAX requests
		 **/
		public static function gallery_shortcode() {
			global $wplab_recover_core;
			
			preg_match('/\[gallery.*ids=.(.*).\]/', get_post_field( 'post_content', get_the_ID() ), $ids );
			if( isset( $ids[1] ) && $ids[1] <> '' ) {
				
				$data = array();
				
				$gallery_ids = explode( ',', $ids[1] );
				
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null
				); 
				
				if( is_array( $gallery_ids ) && count( $gallery_ids ) > 0 ) {
					$args['include'] = $gallery_ids;
				} else {
					$args['post_parent'] = get_the_ID();
				}
				
				$data['items'] = get_posts( $args );
				
				if( count( $data['items'] ) > 0 && is_array( $data['items'] ) ) {
					
					ob_start();
					$wplab_recover_core->view->load_partial( 'shortcodes/gallery', $data );
					return ob_get_clean();
					
				}
				
			}

		}
		
		/**
		 * Get portfolio gallery
		 **/
		public static function get_portfolio_images() {
			$portfolio_images = fw_ext_portfolio_get_gallery_images();
			if( !empty( $portfolio_images ) ):
				?>
				<div class="post-gallery">
					<div class="owl-carousel">
					<?php
					foreach ( $portfolio_images as $thumbnail ) {
						?>
						<div class="item">
							<img src="<?php echo esc_attr( $thumbnail['url'] ); ?>" alt="" />
						</div>
						<?php
					}
					?>
					</div>
				</div>
				<?php
			endif;
			
		}
		
		/**
		 * Get first photo from content
		 **/
		public static function get_photo( $content ) {
			preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $content, $matches );
			$image = false;
			if ( isset( $matches ) ) {
				$image = $matches[1][0];
			}
			return $image;
		}
		
		/**
		 * String email into link
		 **/
		public static function emailize( $str ) {
	    //Detect and create email
	    $mail_pattern = "/([\.A-z0-9_-]+\@[A-z0-9_-]+\.)([A-z0-9\_\-\.]{1,}[A-z])/";
	    $str = preg_replace( $mail_pattern, '<a href="mailto:$1$2">$1$2</a>', $str );
	    return $str;
		}
		
		/**
		 * Sanitize HTML output
		 **/
		public static function sanitize_html( $html ) {
			$allowed_tags = wp_kses_allowed_html( 'post' );
			return wp_kses( $html, $allowed_tags );
		}
		
		/**
		 * Get all custom fonts from config
		 **/
		public static function get_all_custom_theme_fonts() {
			
			$custom_styles = get_option('wplab_recover_theme_styles');
			
			$fonts = array();
			
			if( isset( $custom_styles['font_picker'] ) && is_array( $custom_styles['font_picker'] ) && count( $custom_styles['font_picker'] ) > 0 ) {
				
				foreach( $custom_styles['font_picker'] as $k=>$picker ) {
					if( $picker['font_family'] <> '' ) {
						$fonts[] = $picker['font_family'];
					}
				}
				
			}
			
			return array_unique( $fonts );
			
		}
		
	}