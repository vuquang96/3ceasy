<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
global $wplab_recover_core;

$cats = array();
$cats_str = '';

$tax_query_type = isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';

if( $tax_query_type == 'only' ) {
	$cats_str = $atts['taxonomy_query']['only']['cats_include'];
	$cats = explode(',', $cats_str );
} elseif( $tax_query_type == 'except' ) {
	$cats_str = $atts['taxonomy_query']['except']['cats_exclude'];
	$cats = explode(',', $cats_str );
}

$paged = get_query_var( 'paged' );
$paged = $paged == 0 ? 1 : $paged;

/**
 * Get posts
 **/
$args = array(
	'type' => $tax_query_type <> '' ? $tax_query_type : 'all',
	'posts_per_page' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? absint( $atts['posts_per_page'] ) : 7,
	'category' => $cats,
	'term_field' => 'slug',
	'post_type' => 'fw-portfolio',
	'tax_name' => 'fw-portfolio-category',
	'paged' => $paged,
	'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
	'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
);

$posts = $wplab_recover_core->model('post')->get( $args );
?>

<?php if( $posts->have_posts() ): ?>

<div id="shortcode-<?php echo esc_attr( $atts['id'] ); ?>" class="portfolio-showcase">
	<div class="items swiper-container">
		<div class="swiper-wrapper">
			<?php $i=0; $j=1; while ( $posts->have_posts() ): $posts->the_post(); $i++; $j++; ?>
			
				<?php if( $i == 1 || $i == 4 ): ?>
				<div class="swiper-slide">
				<?php endif; ?>
				
				<div class="item-inside item-num-<?php echo $i; ?>">
					<?php
						$thumb_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) );
						if( $i == 1 ) {
							echo wplab_recover_media::image( $thumb_url, 640, 420, true, true, $thumb_url, false );
						} elseif( $i == 2 || $i == 3 ) {
							echo wplab_recover_media::image( $thumb_url, 320, 230, true, true, $thumb_url, false );
						} elseif( $i == 4 ) {
							echo wplab_recover_media::image( $thumb_url, 640, 650, true, true, $thumb_url, false );
						}
					?>
					<div class="overlay"></div>
					<div class="caption">
						<div class="caption-table">
							<div class="caption-cell">
								<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
								
								<div class="cats">
									<?php
										$terms = wp_get_post_terms( get_the_ID(), 'fw-portfolio-category' );
										$terms_list = array();
										foreach( $terms as $term ):
											$terms_list[] = '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>'; 
										endforeach;
										
										echo implode( ', ', $terms_list );
									?>
								</div>
								
								<div class="links">
								
									<a href="<?php echo esc_attr( $thumb_url ); ?>" class="view lightbox" title="<?php echo esc_attr( get_the_title() ); ?>" data-lightbox-gallery="portolio-carousel-gallery"></a>
									
									<a href="<?php the_permalink(); ?>" class="link-project"></a>
								
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<?php if( $i == 3 || $i ==4 || $j == $atts['posts_per_page'] ): ?>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>
				
			<?php if( $i == 4 ) $i = 0; endwhile; ?>
		</div>
	</div>
</div>
	
<?php endif; wp_reset_postdata(); 