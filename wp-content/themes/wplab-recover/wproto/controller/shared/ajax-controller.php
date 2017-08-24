<?php
/**
 *	AJAX actions controller
 **/
class wplab_recover_ajax_controller extends wplab_recover_core_controller {

	function __construct() {

		// Get latest tweets
		add_action( 'wp_ajax_theme_get_latest_tweets', array( $this, 'theme_get_latest_tweets' ) );
		add_action( 'wp_ajax_nopriv_theme_get_latest_tweets', array( $this, 'theme_get_latest_tweets' ) );

		// Load blog posts
		add_action( 'wp_ajax_theme_load_more_blog_posts', array( $this, 'load_more_blog_posts' ) );
		add_action( 'wp_ajax_nopriv_theme_load_more_blog_posts', array( $this, 'load_more_blog_posts' ) );

		// Load portfolio posts
		add_action( 'wp_ajax_theme_load_more_portfolio_posts', array( $this, 'load_more_portfolio_posts' ) );
		add_action( 'wp_ajax_nopriv_theme_load_more_portfolio_posts', array( $this, 'load_more_portfolio_posts' ) );

		// Load shop posts
		add_action( 'wp_ajax_theme_load_more_shop_posts', array( $this, 'load_more_shop_posts' ) );
		add_action( 'wp_ajax_nopriv_theme_load_more_shop_posts', array( $this, 'load_more_shop_posts' ) );

		// Load menu carousel posts
		add_action( 'wp_ajax_theme_load_menu_posts_carousel', array( $this, 'load_menu_posts_carousel' ) );
		add_action( 'wp_ajax_nopriv_theme_load_menu_posts_carousel', array( $this, 'load_menu_posts_carousel' ) );

		// Load Service template service
		add_action( 'wp_ajax_nopriv_load_category_service', array( $this, 'load_category_service' ) );

		// Load Store service
		add_action( 'wp_ajax_nopriv_load_store_service', array( $this, 'load_store_service' ) );

	}

	/**
	 * Load latest tweets
	 **/
	function theme_get_latest_tweets() {

			if( wplab_recover_utils::is_unyson() ) {

				$twitter = fw_ext_social_twitter_get_connection();

				if( false === get_transient( 'wplab_recover_latest_tweets' ) ) {
					$tweets = $twitter->get('statuses/user_timeline', array( 'count' => 10 ) );
					delete_transient( 'wplab_recover_latest_tweets' );
					set_transient( 'wplab_recover_latest_tweets', $tweets, HOUR_IN_SECONDS );
				} else {
					$tweets = get_transient( 'wplab_recover_latest_tweets' );
				}

				if( is_array( $tweets ) && count( $tweets ) > 0 ) {

					if( isset( $_POST['type'] ) && $_POST['type'] == 'carousel' ) {
						echo '<div class="tweets-carousel carousel_fade">';
					} else {
						echo '<div class="tweets">';
					}

						$limit = isset( $_POST['count'] ) ? absint( $_POST['count'] ) : 10;
						$i=0;
						foreach( $tweets as $tweet ) {
							$i++;

							if( $i > $limit ) {
								break;
							} else {
								echo '<div class="item"><i class="fa fa-twitter"></i>' . str_replace( '<a', '<a target="_blank"', make_clickable( $tweet->text ) ) . '<span class="time">' . human_time_diff( strtotime( $tweet->created_at ) ) . ' ' . esc_html__('ago', 'wplab-recover') . '</span>' . '</div>';
							}

						}

					echo '</div>';

				} else {
					esc_html_e( 'Can not load latest tweets', 'wplab-recover' );
				}

			}


		exit;
	}

	/**
	 * Load more blog posts
	 **/
	function load_more_blog_posts() {
		global $wplab_recover_core;

		if( ! isset( $_POST['data'] ) || ! is_array( $_POST['data'] ) ) die( esc_html__('Wrong AJAX Request', 'wplab-recover'));

		$data = $_POST['data'];
		$response = $cats = array();
		$cats_str = '';

		$next_page = isset( $data['nextPage'] ) ? absint( $data['nextPage'] ) : 1;
		$max_pages = isset( $data['maxPages'] ) ? absint( $data['maxPages'] ) : 0;

		$tax_query_type = isset( $data['qType'] ) ? $data['qType'] : '';
		$cats_str = $data['qCategories'];
		$cats = explode(',', $cats_str );

		/**
		 * Get posts
		 **/
		$args = array(
			'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
			'posts_per_page' => isset( $data['postsPerPage'] ) && $data['postsPerPage'] <> '' ? absint( $data['postsPerPage'] ) : 10,
			'category' => $cats,
			'term_field' => 'slug',
			'post_type' => 'post',
			'tax_name' => 'category',
			'with_thumbnail_only' => isset( $data['thumbsOnly'] ) ? filter_var( $data['thumbsOnly'], FILTER_VALIDATE_BOOLEAN ) : false,
			'paged' => $next_page,
			'order' => isset( $data['orderBy'] ) && $data['orderBy'] <> '' ? $data['orderBy'] : 'date',
			'sort' => isset( $data['sortBy'] ) && $data['sortBy'] <> '' ? $data['sortBy'] : 'DESC',
		);

		$posts = $wplab_recover_core->model('post')->get( $args );

		ob_start();

		if( $posts->have_posts() ) {

			while ( $posts->have_posts() ) {
				$posts->the_post();

				$post_format = get_post_format();
				if( $post_format != false ) {
					$post_format = '-' . $post_format;
				}

				if( $data['style'] == 'cols_1' ) {
					require wplab_recover_utils::locate_path( '/template-parts/post-format' . $post_format . '.php' );
				} elseif( $data['style'] == 'cols_2' ) {
					require wplab_recover_utils::locate_path( '/template-parts/post-format-2cols' . $post_format . '.php' );
				} elseif( $data['style'] == 'masonry' ) {
					require wplab_recover_utils::locate_path( '/template-parts/post-format-masonry' . $post_format . '.php' );
				} elseif( $data['style'] == 'grid_cols_3' ) {
					require wplab_recover_utils::locate_path( '/template-parts/post-format-3cols-grid.php' );
				}

			}

		}

		$response['html'] = ob_get_clean();

		$response['next_page'] = $next_page + 1;
		$response['current_page'] = $next_page;

		if( $response['next_page'] > $max_pages ) {
			$response['hide_link'] = true;
		}

		die( json_encode( $response ) );

	}

	/**
	 * Load more portfolio posts
	 **/
	function load_more_portfolio_posts() {
		global $wplab_recover_core;

		if( ! isset( $_POST['data'] ) || ! is_array( $_POST['data'] ) ) die( esc_html__('Wrong AJAX Request', 'wplab-recover'));

		$data = $_POST['data'];
		$response = $cats = array();
		$cats_str = '';

		$next_page = isset( $data['nextPage'] ) ? absint( $data['nextPage'] ) : 1;
		$max_pages = isset( $data['maxPages'] ) ? absint( $data['maxPages'] ) : 0;

		$tax_query_type = isset( $data['qType'] ) ? $data['qType'] : '';
		$cats_str = $data['qCategories'];
		$cats = explode(',', $cats_str );

		/**
		 * Get posts
		 **/
		$args = array(
			'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
			'posts_per_page' => isset( $data['postsPerPage'] ) && $data['postsPerPage'] <> '' ? absint( $data['postsPerPage'] ) : 9,
			'category' => $cats,
			'term_field' => 'slug',
			'post_type' => 'fw-portfolio',
			'tax_name' => 'fw-portfolio-category',
			'paged' => $next_page,
			'order' => isset( $data['orderBy'] ) && $data['orderBy'] <> '' ? $data['orderBy'] : 'date',
			'sort' => isset( $data['sortBy'] ) && $data['sortBy'] <> '' ? $data['sortBy'] : 'DESC',
		);

		$posts = $wplab_recover_core->model('post')->get( $args );

		ob_start();

		if( $posts->have_posts() ) {

			while ( $posts->have_posts() ) {
				$posts->the_post();

				if( $data['style'] == 'cols_3' ) {
					require wplab_recover_utils::locate_path( '/template-parts/portfolio-3cols.php' );
				} elseif( $data['style'] == 'cols_3_no_spaces' ) {
					require wplab_recover_utils::locate_path( '/template-parts/portfolio-3cols-no-spaces.php' );
				} elseif( $data['style'] == 'cols_3_desc' ) {
					require wplab_recover_utils::locate_path( '/template-parts/portfolio-3cols-desc.php' );
				} elseif( $data['style'] == 'portfolio_alt' ) {
					require wplab_recover_utils::locate_path( '/template-parts/portfolio-alt.php' );
				}

			}

		}

		$response['html'] = ob_get_clean();

		$response['next_page'] = $next_page + 1;
		$response['current_page'] = $next_page;

		if( $response['next_page'] > $max_pages ) {
			$response['hide_link'] = true;
		}

		die( json_encode( $response ) );
	}

	/**
	 * Load more shop posts
	 **/
	function load_more_shop_posts() {
		global $wplab_recover_core;

		if( ! isset( $_POST['data'] ) || ! is_array( $_POST['data'] ) ) die( esc_html__('Wrong AJAX Request', 'wplab-recover'));

		$data = $_POST['data'];
		$response = $cats = array();
		$cats_str = '';

		$next_page = isset( $data['nextPage'] ) ? absint( $data['nextPage'] ) : 1;
		$max_pages = isset( $data['maxPages'] ) ? absint( $data['maxPages'] ) : 0;

		$tax_query_type = isset( $data['qType'] ) ? $data['qType'] : '';
		$cats_str = $data['qCategories'];
		$cats = explode(',', $cats_str );

		/**
		 * Get posts
		 **/
		$args = array(
			'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
			'posts_per_page' => isset( $data['postsPerPage'] ) && $data['postsPerPage'] <> '' ? absint( $data['postsPerPage'] ) : 9,
			'category' => $cats,
			'term_field' => 'slug',
			'post_type' => 'product',
			'tax_name' => 'product_cat',
			'paged' => $next_page,
			'order' => isset( $data['orderBy'] ) && $data['orderBy'] <> '' ? $data['orderBy'] : 'date',
			'sort' => isset( $data['sortBy'] ) && $data['sortBy'] <> '' ? $data['sortBy'] : 'DESC',
		);

		$posts = $wplab_recover_core->model('post')->get( $args );

		ob_start();

		if( $posts->have_posts() ) {

			while ( $posts->have_posts() ) {
				$posts->the_post();

				if( $data['style'] == 'list' ) {
					require wplab_recover_utils::locate_path( '/template-parts/shop-list.php' );
				} elseif( $data['style'] == 'grid' ) {
					wc_get_template_part( 'content', 'product' );
				}

			}

		}

		$response['html'] = ob_get_clean();

		$response['next_page'] = $next_page + 1;
		$response['current_page'] = $next_page;

		if( $response['next_page'] > $max_pages ) {
			$response['hide_link'] = true;
		}

		die( json_encode( $response ) );
	}

	/**
	 * Posts carousel in header menu
	 **/
	function load_menu_posts_carousel() {
		global $wplab_recover_core;

		$q_cat = '';
		$refresh = false;
		$post_type = 'fw-portfolio';
		$tax_type = 'fw-portfolio-category';
		$latest_posts_title = esc_html__('Recent projects', 'wplab-recover');

		if( isset( $_POST['category'] ) ) {

			if( $_POST['category'] == 'shop_carousel' ) {

				$post_type = 'product';
				$tax_type = 'product_cat';
				$latest_posts_title = esc_html__('Recent products', 'wplab-recover');

			} elseif( $_POST['category'] == 'blog_carousel' ) {

				$post_type = 'post';
				$tax_type = 'category';
				$latest_posts_title = esc_html__('Recent posts', 'wplab-recover');

			}

		}

		if( isset( $_POST['cat'] ) && $_POST['cat'] <> '' ) {
			$q_cat = $_POST['cat'];
			$refresh = true;
			if( $q_cat == '*' ) {
				$q_cat = '';
			}
		}

		/**
		 * Get categories
		 **/
		$terms = get_terms( $tax_type, array( 'hide_empty' => false ) );

		/**
		 * Get posts
		 **/
		$args = array(
			'type' => $q_cat <> '' ? 'only' : 'all',
			'posts_per_page' => 4,
			'post_type' => $post_type,
			'tax_name' => $tax_type,
			'category' => $q_cat,
			'term_field' => 'slug',
			'order' => 'date',
			'sort' => 'DESC',
			'with_thumbnail_only' => true
		);

		$posts = $wplab_recover_core->model('post')->get( $args );
		$id = uniqid();

		if( $posts->have_posts() ):
			?>

			<?php if( !$refresh ): ?>
			<div id="menu-posts-carousel-<?php echo esc_attr( $id ); ?>" class="menu-posts-carousel container-fluid">
				<div class="row">
					<div class="posts">
			<?php endif; ?>
				<?php
				while ( $posts->have_posts() ):
					$posts->the_post();
					?>
					<div class="col-md-3 col">
						<div class="thumb">
							<a href="<?php the_permalink(); ?>">
								<div class="overlay"></div>
								<?php
									$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
									echo wplab_recover_media::image( $thumb_url, 320, 200, true, true, $thumb_url, true );
								?>
							</a>
						</div>
						<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<?php
				endwhile;
				?>
				<?php if( !$refresh ): ?>
					</div>
					<div class="col-md-12 filters">

						<a href="javascript:;" class="current" data-filter="*"><?php echo wp_kses_post( $latest_posts_title ); ?></a>

						<?php if( count( $terms ) > 0 ): foreach( $terms as $term ): ?>
						<a href="javascript:;" data-filter="<?php echo esc_attr( $term->slug ); ?>"><?php echo wp_kses_post( $term->name ); ?></a>
						<?php endforeach; endif; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php
		endif;

		die;
	}


	/**
	 * Load Category Service
	 **/
	function load_category_service() {
		$xhtml = '';
		if(isset($_POST['id_term'])){
			if(isset($_POST['service'])){
				$query = array( 
	                'post_type' => 'service', 
	                'tax_query' => array(
	                    array(
	                        'taxonomy' => 'service_category',
	                        'field'    => 'id',
	                        'terms'    => $_POST['id_term'],

	                    )
	                ),
	            );
	                
	            $service = new \WP_Query( $query );
	            foreach ($service->posts as  $value) {
	            	$price = get_post_meta($value->ID, 'service-price', true);
					$xhtml .= '<a  class="col-lg-4 messinfo" href="'. $value->guid .'">'
					 		. '<span class="text">' .  $value->post_title . '</span>'
					 		. '<span class="price">' .  $price . '</span>'
					 		. '</a>';
	            }
			}else{
				$args = array(
		           'taxonomy' => 'service_category',
		           'parent' => $_POST['id_term'],
		        );
				$cats = get_terms($args);
		        foreach ($cats as $value) {
					$xhtml .= '<div class="item" data-idterm="'. $value->term_id .'" >'
					 		. '<span class="text">' .  $value->name . '</span>'
					 		. '</div>';
				}
			}
		}
		echo $xhtml;
		wp_die();
	}

	/**
	 * Load Store Service
	 **/
	function load_store_service() {
		$xhtml = '';
		if(isset($_POST['local'])){
			 $address = urlencode ($_POST['local']);
		    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=India";
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    $response = curl_exec($ch);
		    curl_close($ch);
		    $response_a = json_decode($response);

		    $lat = $response_a->results[0]->geometry->location->lat;
		    $lng = $response_a->results[0]->geometry->location->lng;
		    	

	    	echo $urlApiStore = get_site_url() . "/wp-admin/admin-ajax.php?action=store_search&lat=$lat&lng=$lng&max_results=25&search_radius=100";

	    	$dataApi = json_decode(file_get_contents($urlApiStore), true);
	    		
		}
		echo $xhtml;
		wp_die();
	}
}
