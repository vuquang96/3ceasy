<?php
	/**
	 * Front helper
	 **/
	class wplab_recover_front {
		
		/**
		 * Get header style
		 **/
		public static function get_header_style() {
			$style = '';
			if( wplab_recover_utils::is_unyson() ) {
				if( is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_header/enabled' ), FILTER_VALIDATE_BOOLEAN ) ) {
					$style = fw_get_db_post_option( get_the_ID(), 'customize_page_header/true/header_style' );
				} else {
					$style = fw_get_db_settings_option( 'header_style/style' );
				}
				if( $style == 'modern' ) {
					$style = '';
				}
			}
			return $style;
		}
		
		/**
		 * Get cached menu HTML
		 **/
		public static function get_menu() {
			global $wplab_recover_core;
			return $wplab_recover_core->menu_html;
		}
		
		/**
		 * Get header background image
		 **/
 		public static function get_header_bg_image() {
			// Page header image
			$header_bg_image = '';

			if( wplab_recover_utils::is_unyson() ) {
				$header_style = wplab_recover_utils::is_unyson() ? fw_get_db_settings_option( 'header_style/style' ) : 'modern';
				$header_bg = array();
				
				if( wplab_recover_utils::is_woocommerce() && is_shop() && fw_get_db_post_option( get_option( 'woocommerce_shop_page_id' ), 'header_bg_img/source' ) == 'custom' ) {
					$header_bg = fw_get_db_post_option( get_option( 'woocommerce_shop_page_id' ), 'header_bg_img/custom/page_header_bg' );
				} elseif( is_singular() && fw_get_db_post_option( get_the_ID(), 'header_bg_img/source' ) == 'bg' ) {
					$header_bg = fw_get_db_post_option( get_the_ID(), 'header_style/bg/page_header_bg' );								
				} elseif( is_singular() && fw_get_db_post_option( get_the_ID(), 'header_bg_img/source' ) == 'custom' ) {
					$header_bg = fw_get_db_post_option( get_the_ID(), 'header_bg_img/custom/page_header_bg' );
				} elseif( is_singular() && fw_get_db_post_option( get_the_ID(), 'header_style/style' ) == 'bg' ) {					
					$header_bg = fw_get_db_post_option( get_the_ID(), 'header_style/bg/page_header_bg' );			
				} elseif( is_page() && fw_get_db_post_option( get_the_ID(), 'header_bg_img/source' ) == 'custom' ) {
					$header_bg = fw_get_db_post_option( get_the_ID(), 'header_bg_img/custom/page_header_bg' );
				} elseif( ((is_front_page() && is_home()) || is_home()) && fw_get_db_post_option( get_option( 'page_for_posts'), 'header_bg_img/source' ) == 'custom' ) {
					$header_bg = fw_get_db_post_option( get_option( 'page_for_posts'), 'header_bg_img/custom/page_header_bg' );
				} else {
					$header_bg = fw_get_db_settings_option( 'header_style/' . $header_style . '/' . $header_style . '_header_bg' );
				}
				$header_bg_image = is_array( $header_bg ) && !empty( $header_bg ) ? $header_bg['url'] : '';
			}
			return $header_bg_image;
 		}
		
		/**
		 * Print page title
		 **/
		public static function print_page_title() {
			?>
			<h1>
			<?php if( is_post_type_archive( 'fw-portfolio') || is_singular('fw-portfolio') || is_tax('fw-portfolio-category') ): ?>
			
				<?php
					$portfolio_title = esc_html__( 'Our Projects', 'wplab-recover' );
					if( wplab_recover_utils::is_unyson() ) {
						$portfolio_title = fw_get_db_settings_option( 'portfolio_title' );
					}
					echo wp_kses_post( $portfolio_title );
				?>
			
			<?php elseif( wplab_recover_utils::is_woocommerce() && ( is_shop() || is_product_category() || is_product_tag() || is_singular('product') ) ): ?>
			
				<?php
					$shop_title = esc_html__( 'Shop', 'wplab-recover' );
					if( wplab_recover_utils::is_unyson() ) {
						$shop_title = fw_get_db_settings_option( 'shop_title' );
					}
					echo wp_kses_post( $shop_title );
				?>
			
			<?php elseif( is_single() || (is_front_page() && is_home()) || is_home() || is_category() || is_tag() || is_archive() || is_author() ): ?>
			
				<?php
					$blog_title = esc_html__( 'Blog', 'wplab-recover' );
					if( wplab_recover_utils::is_unyson() ) {
						$blog_title = fw_get_db_settings_option( 'blog_title' );
					}
					echo wp_kses_post( $blog_title );
				?>
			
			<?php elseif( is_404() ): ?>
			
				<?php esc_html_e( 'Page not found', 'wplab-recover' ); ?>
				
			<?php elseif( is_search() ): ?>
			
				<?php esc_html_e( 'Search results', 'wplab-recover' ); ?>
				
			<?php elseif( is_singular() ): ?>
			
				<?php the_title(); ?>
			
			<?php endif; ?>
			</h1>
			<?php
		}
		
		/**
		 * Page preloader
		 **/
		public static function preloader() {
			$preloader_style = 'hidden';
			
			// If Unyson Framework is enabled
			if( wplab_recover_utils::is_unyson() ) {
				$preloader_style = fw_get_db_settings_option( 'page_preloader/style' );
				$css_preloader_style = fw_get_db_settings_option( 'page_preloader/css/css_preloader_style' );
			}
			
			if( $preloader_style == 'css' && $css_preloader_style <> '' ):
			?>
			<div id="preloader">
				<div id="preloader-inner" class="loader-inner <?php echo esc_attr( $css_preloader_style ); ?>"></div>
			</div>
			<?php
			elseif( $preloader_style == 'custom' ):
			
				$preloader_img 				= esc_attr( fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image/url' ) );
				$preloader_img_retina = esc_attr( fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_2x/url' ) );
				$preloader_img_retina = $preloader_img_retina == '' ? 'data-no-retina' : 'data-at2x="' . $preloader_img_retina . '"';
				
				$preloader_width = fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_width' );
				$preloader_height = fw_get_db_settings_option( 'page_preloader/custom/custom_preloader_image_height' );
				
				$preloader_style = wplab_recover_utils::get_styles( array(
					'width'				=> esc_attr( $preloader_width ),
					'height'			=> esc_attr( $preloader_height ),
					'top_margin' 	=> '-' . $preloader_height / 2,
					'left_margin' => '-' . $preloader_width / 2,
				));
				
			?>
			<div id="preloader" class="custom">
				<img src="<?php echo $preloader_img; ?>" <?php echo $preloader_img_retina; ?> style="<?php echo esc_attr( $preloader_style ); ?>" alt="" />
			</div>
			<?php
			endif;
		}
		
		/**
		 * Get read more text
		 **/
		public static function read_more_link() {
			$read_more_text = esc_html__( 'Read more', 'wplab-recover' );
			if( wplab_recover_utils::is_unyson() ) {
				$read_more_text = fw_get_db_settings_option( 'read_more_title' );
			}
			return $read_more_text;
		}
		
		/**
		 * Website menu
		 **/
		public static function menu() {
			
			$menu_id = '';
			$logo_style = 'title';
			
			// If Unyson Framework is enabled			
			if( wplab_recover_utils::is_unyson() ) {
				$logo_style = fw_get_db_settings_option( 'header_logo_type/logo_type' );
				
				if( is_page() ) {
					$menu_id = fw_get_db_post_option( get_the_ID(), 'page_menu' );
				}
				
			}
			
			?>
			<!--
				Navigation
			-->
			<nav id="header-nav" class="dl-menuwrapper logo-style-<?php echo esc_attr( $logo_style ); ?>" data-back-label="<?php esc_html_e( 'Back', 'wplab-recover'); ?>">
			
				<!--
					Toggle menu for mobile devices
					this element is hidden for desktop and large monitors
				-->
				<a href="javascript:;" id="mobile-menu-toggler" class="dl-trigger"><span><?php esc_html_e( 'Toggle Menu', 'wplab-recover'); ?></span></a>
			
				<?php
					wp_nav_menu( array(
						'menu' => $menu_id,
						'theme_location' => 'header_menu',
						'walker' => new wplab_recover_front_nav_menu_walker,
						'menu_id' => 'header-menu',
						'fallback_cb' => false,
						'menu_class' => 'dl-menu',
						'container' => false						
					));
				?>
			
			</nav>
			<?php
		}
		
		/**
		 * Print social icons
		 **/
		public static function social_icons( $target = '_blank' ) {
			
			// If Unyson Framework is active and Footer Widgets Area is enabled
			if( wplab_recover_utils::is_unyson() ) {
				
				$fb_url = fw_get_db_settings_option( 'facebook_url' );
				$twitter_url = fw_get_db_settings_option( 'twitter_url' );
				$linkedin_url = fw_get_db_settings_option( 'linkedin_url' );
				$foursquare_url = fw_get_db_settings_option( 'foursquare_url' );
				$gp_url = fw_get_db_settings_option( 'google_plus_url' );
				$youtube_url = fw_get_db_settings_option( 'youtube_url' );
				$instagram_url = fw_get_db_settings_option( 'instagram_url' );
				$rss_url = get_bloginfo( 'rss2_url' );
				
				?>
				<div class="share-links">
					<?php
						echo $fb_url <> '' ? '<a href="' . esc_attr( $fb_url ) . '" title="Facebook" class="facebook" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $twitter_url <> '' ? '<a href="' . esc_attr( $twitter_url ) . '" title="Twitter" class="twitter" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $linkedin_url <> '' ? '<a href="' . esc_attr( $linkedin_url ) . '" title="LinkedIn" class="linkedin" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $foursquare_url <> '' ? '<a href="' . esc_attr( $foursquare_url ) . '" title="FourSquare" class="foursquare" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $gp_url <> '' ? '<a href="' . esc_attr( $gp_url ) . '" title="Google Plus" class="google-plus" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $youtube_url <> '' ? '<a href="' . esc_attr( $youtube_url ) . '" title="YouTube" class="youtube" target="' . esc_attr( $target ) . '"></a>' : '';
						echo $instagram_url <> '' ? '<a href="' . esc_attr( $instagram_url ) . '" title="Instagram" class="instagram" target="' . esc_attr( $target ) . '"></a>' : '';
						echo filter_var( fw_get_db_settings_option( 'rss_feed/enabled' ), FILTER_VALIDATE_BOOLEAN ) && filter_var( fw_get_db_settings_option( 'rss_icon' ), FILTER_VALIDATE_BOOLEAN ) ? '<a href="' . esc_attr( $rss_url ) . '" title="RSS" class="rss" target="' . esc_attr( $target ) . '"></a>' : '';
					?>
				</div>
				<?php
				
			} else {
				esc_html_e( 'Please, activate Unyson Framework before using this widget', 'wplab-recover' );
			}
			
		}
		
		/**
		 * Print FontAwesome social icons
		 **/
		public static function social_fa_icons( $target = '_blank' ) {
			
			// If Unyson Framework is active and Footer Widgets Area is enabled
			if( wplab_recover_utils::is_unyson() ) {
				
				$fb_url = fw_get_db_settings_option( 'facebook_url' );
				$twitter_url = fw_get_db_settings_option( 'twitter_url' );
				$linkedin_url = fw_get_db_settings_option( 'linkedin_url' );
				$foursquare_url = fw_get_db_settings_option( 'foursquare_url' );
				$gp_url = fw_get_db_settings_option( 'google_plus_url' );
				$youtube_url = fw_get_db_settings_option( 'youtube_url' );
				$instagram_url = fw_get_db_settings_option( 'instagram_url' );
				$rss_url = get_bloginfo( 'rss2_url' );
				
				?>
				<div class="share-links">
					<?php
						echo $fb_url <> '' ? '<a href="' . esc_attr( $fb_url ) . '" title="Facebook" target="' . esc_attr( $target ) . '"><i class="fa fa-facebook-square"></i></a>' : '';
						echo $twitter_url <> '' ? '<a href="' . esc_attr( $twitter_url ) . '" title="Twitter" target="' . esc_attr( $target ) . '"><i class="fa fa-twitter-square"></i></a>' : '';
						echo $linkedin_url <> '' ? '<a href="' . esc_attr( $linkedin_url ) . '" title="LinkedIn" target="' . esc_attr( $target ) . '"><i class="fa fa-linkedin-square"></i></a>' : '';
						echo $foursquare_url <> '' ? '<a href="' . esc_attr( $foursquare_url ) . '" title="FourSquare" target="' . esc_attr( $target ) . '"><i class="fa fa-foursquare"></i></a>' : '';
						echo $gp_url <> '' ? '<a href="' . esc_attr( $gp_url ) . '" title="Google Plus" target="' . esc_attr( $target ) . '"><i class="fa fa-google-plus-square"></i></a>' : '';
						echo $youtube_url <> '' ? '<a href="' . esc_attr( $youtube_url ) . '" title="YouTube" target="' . esc_attr( $target ) . '"><i class="fa fa-youtube-play"></i></a>' : '';
						echo $instagram_url <> '' ? '<a href="' . esc_attr( $instagram_url ) . '" title="Instagram" target="' . esc_attr( $target ) . '"><i class="fa fa-instagram"></i></a>' : '';
						echo filter_var( fw_get_db_settings_option( 'rss_icon' ), FILTER_VALIDATE_BOOLEAN ) ? '<a href="' . esc_attr( $rss_url ) . '" title="RSS" target="' . esc_attr( $target ) . '"><i class="fa fa-rss-square"></i></a>' : '';
					?>
				</div>
				<?php
				
			} 
			
		}
		
		/**
		 * Print FontAwesome social icons
		 **/
		public static function print_fa_icons( $links ) {
			
			$atts = 'target="_blank" rel="nofollow"';
			
			if( isset( $links['facebook_url'] ) && $links['facebook_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['facebook_url'] ) . '" ' . $atts . '><i class="fa fa-facebook"></i></a>';
			}
			if( isset( $links['twitter_url'] ) && $links['twitter_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['twitter_url'] ) . '" ' . $atts . '><i class="fa fa-twitter"></i></a>';
			}
			if( isset( $links['linkedin_url'] ) && $links['linkedin_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['linkedin_url'] ) . '" ' . $atts . '><i class="fa fa-linkedin"></i></a>';
			}
			if( isset( $links['google_plus_url'] ) && $links['google_plus_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['google_plus_url'] ) . '" ' . $atts . '><i class="fa fa-google-plus"></i></a>';
			}
			if( isset( $links['youtube_url'] ) && $links['youtube_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['youtube_url'] ) . '" ' . $atts . '><i class="fa fa-youtube-play"></i></a>';
			}
			if( isset( $links['vimeo_url'] ) && $links['vimeo_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['vimeo_url'] ) . '" ' . $atts . '><i class="fa fa-vimeo"></i></a>';
			}
			if( isset( $links['instagram_url'] ) && $links['instagram_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['instagram_url'] ) . '" ' . $atts . '><i class="fa fa-instagram"></i></a>';
			}
			if( isset( $links['flickr_url'] ) && $links['flickr_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['flickr_url'] ) . '" ' . $atts . '><i class="fa fa-flickr"></i></a>';
			}
			if( isset( $links['behance_url'] ) && $links['behance_url'] <> '' ) {
				echo '<a href="' . esc_attr( $links['behance_url'] ) . '" ' . $atts . '><i class="fa fa-behance"></i></a>';
			}
			
		}
		
		/**
		 * Display share / like links
		 **/
		public static function share_links() {	
			$title = urlencode( get_the_title( get_the_ID() ) );
			$permalink = urlencode( get_permalink( get_the_ID() ) );
			$post_thumb = has_post_thumbnail() ? urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ) : '';
			?>
			<div class="share-links">
				<a rel="nofollow" class="facebook" title="<?php esc_html_e('Share on Facebook', 'wplab-recover'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?display=popup&amp;u=<?php echo $permalink; ?>"></a>
				<a rel="nofollow" class="twitter" title="<?php esc_html_e('Share on Twitter', 'wplab-recover'); ?>" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $permalink; ?>"></a>
				<a rel="nofollow" class="linkedin" title="<?php esc_html_e('Share on LinkedIn', 'wplab-recover'); ?>" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $title; ?>&summary=&source="></a>
				<a rel="nofollow" class="google-plus" title="<?php esc_html_e('Share on Google Plus', 'wplab-recover'); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo $permalink; ?>"></a>
				<a rel="nofollow" class="email" title="<?php esc_html_e('Share by Email', 'wplab-recover'); ?>" target="_blank" href="mailto:?subject=<?php echo urlencode( esc_html__('I wanted you to see this site', 'wplab-recover') ); ?>&amp;body=<?php echo urlencode( esc_html__('Check out this site:', 'wplab-recover') ); ?>+<?php echo urlencode( $permalink ); ?>."></a>
			</div>
			<?php
		}
		
		/**
		 * About author
		 **/
		public static function about_author( $author_id = 0 ) {
			global $wp_query;
			
			if( $author_id == 0 ) {
				$current_author = $wp_query->get_queried_object();
				$author_metadata = get_metadata( 'user', $current_author->ID );			
			} else {
				$current_author = get_user_by( 'id', $author_id );
				$author_metadata = get_metadata( 'user', $current_author->ID );	
			}
			
			?>
			
			<div itemscope itemtype="http://schema.org/Person" class="about-author">
				
				<div class="author_image">
					<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_attr( self::get_avatar_url( get_avatar( $current_author->ID, 100 )) ); ?>" data-at2x="<?php echo esc_attr( self::get_avatar_url( get_avatar( $current_author->ID, 200 )) ); ?>" class="b-lazy" width="100" alt="" itemprop="image" />
				</div>
				
				<div class="author_text">
					<a itemprop="name" class="name" href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo esc_html( $current_author->display_name ); ?></a>
					
					<?php if( isset( $current_author->description ) && $current_author->description <> '' ): ?>
					<div itemprop="description"><?php echo nl2br( $current_author->description ); ?></div>
					<?php endif; ?>
				</div>
				
			</div>
			
			<?php
			
		}
		
		/**
		 * Print portfolio gallery
		 ***/	
		public static function print_portfolio_gallery() {
			if( function_exists('fw_ext_portfolio_get_gallery_images') ) {
				$portfolio_images = fw_ext_portfolio_get_gallery_images();
				if( !empty( $portfolio_images ) ):
					?>
					
					<div class="post-gallery carousel_fade">
						<?php foreach ( $portfolio_images as $thumbnail ): ?>
						<div class="item">
							<img src="<?php echo esc_attr( $thumbnail['url'] ); ?>" alt="" />
						</div>
						<?php endforeach; ?>
					</div>
	
					<?php
				endif;	
			}
		}
		
		public static function get_avatar_url( $get_avatar ){
			preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	    return $matches[1];
		}
		
		/**
		 * Display tags list
		 **/
		public static function tags_links() {
			$tags_list = self::get_valid_tags_list(' ');
			if( $tags_list <> '' ):
			?>
			<div class="tags-list">
				<?php echo $tags_list; ?>
			</div>
			<?php
			endif;
		}
		
		public static function get_valid_tags_list( $separator = ', ' ) {
			$s = str_replace( ' rel="tag"', '', get_the_tag_list( '', $separator, '' ) );
			return $s;
		}
		
		/**
		 * Display categories
		 **/
		public static function get_categories( $separator = ', ' ) {
			$post_type = get_post_type();
			
			switch( $post_type ) {
				default:
				case 'post':
					return self::get_valid_category_list( $separator );
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

		
		/**
		 * Footer widgets
		 **/
		public static function footer_widgets() {
			
			// If Unyson Framework is active and Footer Widgets Area is enabled
			if( wplab_recover_utils::is_unyson() ) {
				
				$custom_page_footer = is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/enabled' ), FILTER_VALIDATE_BOOLEAN );
				
				if( $custom_page_footer ) {
					$footer_side_display_widgets = filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side_display_widgets/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$footer_columns = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side_display_widgets/true/footer_side_columns' );
					$footer_side_widget_area = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side_display_widgets/true/footer_side_area' );
					
					$footer_side2_display_widgets = filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side2_display_widgets/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$footer2_columns = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side2_display_widgets/true/footer_side2_columns' );
					$footer_side2_widget_area = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_side2_display_widgets/true/footer_side2_area' );
				} else {
					$footer_side_display_widgets = filter_var( fw_get_db_settings_option( 'footer_side_display_widgets/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$footer_columns = fw_get_db_settings_option( 'footer_side_display_widgets/true/footer_side_columns' );
					$footer_side_widget_area = fw_get_db_settings_option( 'footer_side_display_widgets/true/footer_side_area' );
					
					$footer_side2_display_widgets = filter_var( fw_get_db_settings_option( 'footer_side2_display_widgets/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$footer2_columns = fw_get_db_settings_option( 'footer_side2_display_widgets/true/footer_side2_columns' );
					$footer_side2_widget_area = fw_get_db_settings_option( 'footer_side2_display_widgets/true/footer_side2_area' );
				}

				$footer_side_display_widgets = "";
				$footer_columns = 2 ;
				$footer_side_widget_area = "sidebar-footer-primary";
				$footer_side2_display_widgets = 1;
				$footer2_columns = 4;
				$footer_side2_widget_area = "sidebar-footer-third";
				if( $footer_side_display_widgets ) {
					?>
					<div id="footer-widgets-2" class="footer-widgets footer-widget-area-2">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="widgets columns-<?php echo esc_attr( $footer_columns ); ?>">
										<?php dynamic_sidebar( $footer_side_widget_area ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				
				if( $footer_side2_display_widgets ) {
					?>
					<div id="footer-widgets" class="footer-widgets footer-widget-area">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="widgets columns-<?php echo esc_attr( $footer2_columns ); ?>">
										<?php dynamic_sidebar( $footer_side2_widget_area ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				
			}
			
		}
		
		/**
		 * Bottom bar at footer
		 **/
		public static function bottom_bar() {
			
			$custom_page_footer = is_page() && wplab_recover_utils::is_unyson() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/enabled' ), FILTER_VALIDATE_BOOLEAN );
			
			if( wplab_recover_utils::is_unyson() ):
				if( $custom_page_footer ) {
					$display_bottom_bar = filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/display_bottom_bar/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$bottom_bar_style = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/display_bottom_bar/true/bottom_bar_style/style' );	
					$menu = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/display_bottom_bar/true/bottom_bar_style/text_menu/bottom_bar_menu' );
					$gotop = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/go_top' );
				} else {
					$display_bottom_bar = filter_var( fw_get_db_settings_option( 'display_bottom_bar/enabled' ), FILTER_VALIDATE_BOOLEAN );
					$bottom_bar_style = fw_get_db_settings_option( 'display_bottom_bar/true/bottom_bar_style/style' );	
					$menu = fw_get_db_settings_option( 'display_bottom_bar/true/bottom_bar_style/text_menu/bottom_bar_menu' );
					$gotop = fw_get_db_settings_option( 'go_top' );
				}
				$custom_page_footer = 1;
				$display_bottom_bar = 1;
				$bottom_bar_style = 'text';
				$menu = "";
				$gotop = "bottom_center";

				if( $display_bottom_bar ):
			?>
			<div id="bottom-bar">
				<div class="container">
					<div class="row">
						<div class="<?php echo $bottom_bar_style == 'text' ? 'col-md-12' : 'col-md-8'; ?>">
							<?php
								if( $custom_page_footer ) {
									$bottom_bar =  fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/display_bottom_bar/true/bottom_bar_content' );
									if($bottom_bar){
										echo $bottom_bar;
									}else{
										echo '<p style="text-align: center;">&copy;2017&nbsp;<a href="https://3ceasy.newwave.vn/" target="_blank" rel="noopener"><strong>3C easy Vietnam</strong></a>
											    	</p><p style="text-align: center;">Developed by &nbsp;<a href="http://newwave.vn/">newwave.vn</a></p>';
									}
									
								} else {
									echo fw_get_db_settings_option( 'display_bottom_bar/true/bottom_bar_content' );
								}
							?>
						</div>
						<?php if( $bottom_bar_style == 'text_menu' ): ?>
						<div class="col-menu col-md-4">
						
							<?php
								if( $menu ) {
									wp_nav_menu( array(
										'menu' => $menu,
										'menu_id' => 'bottom-bar-menu',
										'fallback_cb' => false,
										'container' => false						
									));	
								}
							?>
						
						</div>
						<?php endif; ?>
						
						<?php if( in_array( $gotop, array( 'bottom_right', 'bottom_center' ) ) ): ?>
						<a href="javascript:;" id="go-top" class="go-top wow bounce <?php echo esc_attr( $gotop ); ?>" data-wow-delay="0.1s"></a>
						<?php endif; ?>
						
					</div>
				</div>
			
			</div>
			<?php
				endif;
			elseif( ! wplab_recover_utils::is_unyson() ):
			?>
			
			<div id="bottom-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>&copy;<?php echo date('Y'); ?> <?php echo esc_html( get_bloginfo('name') ); ?></p>
							
						</div>
					</div>
				</div>
			</div>
			
			<?php
			endif;
			
			if( wplab_recover_utils::is_unyson() ):
				if( $custom_page_footer ) {
					$is_rocket = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/go_top' ) == 'rocket';
				} else {
					$is_rocket = fw_get_db_settings_option( 'go_top' ) == 'rocket';
				}
				if( $is_rocket ):
				?>
				<a href="javascript:;" id="go-top" class="go-top wow fadeIn style-rocket" data-wow-delay="0.1s"><?php esc_html_e( 'Take off to Top', 'wplab-recover' ); ?></a>
				<?php
				endif;
			endif;
			
		}
		
		/**
		 * Information for developers
		 **/		
		public static function dev_info() {
			if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'dev_info' ), FILTER_VALIDATE_BOOLEAN ) ):
			?>
<!--
===============================================================================================
Generated with <?php echo get_num_queries(); ?> SQL queries in <?php timer_stop(1); ?> seconds.
===============================================================================================
-->
			<?php
			endif;
		}
		
	}