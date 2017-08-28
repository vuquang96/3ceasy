<?php
	if (!defined('FW')) die('Forbidden');
	global $wplab_recover_core;
	
	$cats = $attributes = array();
	$cats_str = '';
	
	if( $atts['carousel_type']['style'] == 'default' ) {
		$attributes[] = 'data-items="' . esc_attr( $atts['carousel_type']['default']['visible_posts'] ) . '"';
		$attributes[] = 'data-items-small="' . esc_attr( $atts['carousel_type']['default']['visible_posts_small'] ) . '"';
		$attributes[] = 'data-items-phone="' . esc_attr( $atts['carousel_type']['default']['visible_posts_phone'] ) . '"';
		
		if( isset( $atts['carousel_type']['default']['autoplay'] ) && filter_var( $atts['carousel_type']['default']['autoplay']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
			$attributes[] = 'data-autoplay="1"';
			$attributes[] = 'data-autoplay-time="' . $atts['carousel_type']['default']['autoplay']['true']['autoplay_speed'] . '"';
		}
		
	}
	
	$tax_query_type = isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';
	
	if( $tax_query_type == 'only' ) {
		$cats_str = $atts['taxonomy_query']['only']['cats_include'];
		$cats = explode(',', $cats_str );
	} elseif( $tax_query_type == 'except' ) {
		$cats_str = $atts['taxonomy_query']['except']['cats_exclude'];
		$cats = explode(',', $cats_str );
	}
	
	$tax_name = 'category';
	
	if( $atts['post_type'] == 'fw-portfolio' ) {
		$tax_name = 'fw-portfolio-category';
	}
	
	$paged = get_query_var( 'paged' );
	$paged = $paged == 0 ? 1 : $paged;
	
	/**
	 * Get posts
	 **/
	$args = array(
		'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
		'posts_per_page' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? absint( $atts['posts_per_page'] ) : 9,
		'category' => $cats,
		'term_field' => 'slug',
		'post_type' => $atts['post_type'],
		'tax_name' => $tax_name,
		'paged' => $paged,
		'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
		'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
	);
	
	$posts = $wplab_recover_core->model('post')->get( $args );
	
?>

<?php if( $posts->have_posts() ): ?>

	<div id="shortcode-<?php echo esc_attr( $atts['id'] ); ?>" class="shortcode-theme-posts-carousel style-<?php echo esc_attr( $atts['carousel_type']['style'] ); ?>" <?php echo implode( ' ', $attributes ); ?>>

	<?php if( $atts['carousel_type']['style'] == 'default' ): ?>
	
		<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
		<div class="item">
			<div class="inside">
				<div class="img">
					<?php
						$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
						echo wplab_recover_media::image( $thumb_url, 370, 230, true, true, $thumb_url, false );
					?>
					<div class="overlay"></div>
					<div class="title"><?php the_title(); ?></div>
				</div>
				<div class="more">
					<a href="<?php the_permalink(); ?>" class="button style-black link left size-medium"><?php echo wp_kses_post( $atts['carousel_type']['default']['read_more_text'] ); ?></a>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
	
	<?php elseif( $atts['carousel_type']['style'] == 'infinite' ): ?>
	
		<div class="items swiper-container">
			<div class="swiper-wrapper">
				<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
					<div class="swiper-slide">
						<article class="item">
							<div class="inside">
								<div class="element">
									<?php
										$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
										echo wplab_recover_media::image( $thumb_url, 385, 250, true, true, $thumb_url, false );
									?>
								  <div class="overlay overlay-1 overlay-top"></div>
								  <div class="overlay overlay-2 overlay-bottom"></div>
									<div class="caption">
										<div class="caption-table">
											<div class="caption-cell">
												<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
												
												<?php if( filter_var( $atts['carousel_type']['infinite']['display_categories'], FILTER_VALIDATE_BOOLEAN ) ): ?>
												<div class="cats">
													<?php
														$terms = wp_get_post_terms( get_the_ID(), $tax_name );
														$terms_list = array();
														foreach( $terms as $term ):
															$terms_list[] = '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>'; 
														endforeach;
														
														echo implode( ', ', $terms_list );
													?>
												</div>
												<?php endif; ?>
												
												<div class="links">
												
													<?php if( filter_var( $atts['carousel_type']['infinite']['display_lightbox_link'], FILTER_VALIDATE_BOOLEAN ) ): ?>
													<a href="<?php echo esc_attr( $thumb_url ); ?>" class="view lightbox" title="<?php echo esc_attr( get_the_title() ); ?>" data-lightbox-gallery="portolio-carousel-gallery"></a>
													<?php endif; ?>
													
													<?php if( filter_var( $atts['carousel_type']['infinite']['display_project_link'], FILTER_VALIDATE_BOOLEAN ) ): ?>
													<a href="<?php the_permalink(); ?>" class="link-project"></a>
													<?php endif; ?>
												
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</article>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	
	<?php endif; ?>
	
	</div>
	
<?php endif; wp_reset_postdata(); 