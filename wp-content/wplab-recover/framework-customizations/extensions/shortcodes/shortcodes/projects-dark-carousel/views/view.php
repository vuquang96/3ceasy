<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
global $wplab_recover_core;

$cats = array();
$cats_str = '';

$tax_query_type = isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';

$terms_params = array(
	'hide_empty' => false
);

if( $tax_query_type == 'only' ) {
	$cats_str = $atts['taxonomy_query']['only']['cats_include'];
	$cats = explode(',', $cats_str );
	
	if( is_array( $cats ) && count( $cats ) > 0 ) {
		foreach( $cats as $cat ) {
			$temp_term = get_term_by('slug', $cat, 'fw-portfolio-category');
			$terms_params['include'][] = $temp_term->term_id;
		}
	}
	
} elseif( $tax_query_type == 'except' ) {
	$cats_str = $atts['taxonomy_query']['except']['cats_exclude'];
	$cats = explode(',', $cats_str );

	if( is_array( $cats ) && count( $cats ) > 0 ) {
		foreach( $cats as $cat ) {
			$temp_term = get_term_by('slug', $cat, 'fw-portfolio-category');
			$terms_params['exclude'][] = $temp_term->term_id;
		}
	}

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
	'post_type' => 'fw-portfolio',
	'tax_name' => 'fw-portfolio-category',
	'paged' => $paged,
	'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
	'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
);

$posts = $wplab_recover_core->model('post')->get( $args );

?>

<?php if( $posts->have_posts() ): ?>

<?php if( filter_var( $atts['display_filters'], FILTER_VALIDATE_BOOLEAN ) ): ?>
<div id="wproto-posts-carousel-shortcode-nav-<?php echo esc_attr( $atts['id'] ); ?>" class="portfolio-carousel-filters portfolio-dark-carousel-filters" data-target-id="portfolio-posts-id-<?php echo esc_attr( $atts['id'] ); ?>">
	<div class="links">
	<?php	
		$terms = get_terms( 'fw-portfolio-category', $terms_params);
		if( count( $terms ) > 0 ) {
				echo '<a href="javascript:;" class="current" data-term=".swiper-slide">' . esc_html__('All', 'wplab-recover') . '</a>';
			foreach( $terms as $term ) {
				echo '<a href="javascript:;" data-term=".' . $term->slug . '">' . $term->name . '</a>';
			}
		}
	?>
	</div>
</div>
<?php endif; ?>

<div id="portfolio-posts-id-<?php echo esc_attr( $atts['id'] ); ?>" data-id="<?php echo esc_attr( $atts['id'] ); ?>" class="portfolio-carousel-shortcode portfolio-dark-carousel <?php echo filter_var( $atts['display_project_link'], FILTER_VALIDATE_BOOLEAN ) ? 'with-project-link' : 'no-project-link'; ?> <?php echo filter_var( $atts['display_lightbox_link'], FILTER_VALIDATE_BOOLEAN ) ? 'with-lightbox-link' : 'no-lightbox-link'; ?> grid hover-style-<?php echo esc_attr( $atts['hover_effect'] ); ?>">

	<div class="items swiper-container">
		<div class="swiper-wrapper">
		<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
	
			<?php get_template_part( 'template-parts/portfolio-dark-carousel' ); ?>
		
		<?php endwhile; ?>
		</div>
	</div>
	
	<div class="pagination-row container">
		<div class="row">
			<div class="col-md-12">
			
				<?php if( filter_var( $atts['all_projects_link']['enabled'], FILTER_VALIDATE_BOOLEAN ) ): ?>
				
				<a href="<?php echo esc_attr( $atts['all_projects_link']['true']['all_projects_link_href'] ); ?>" class="button style-white link left size-medium"><?php echo wp_kses_post( $atts['all_projects_link']['true']['all_projects_title'] ); ?></a>
				
				<?php endif; ?>
				
				<?php if( filter_var( $atts['display_pagination'], FILTER_VALIDATE_BOOLEAN ) ): ?>
				
				<a href="javascript:;" class="nav-left"></a>
				<a href="javascript:;" class="nav-right"></a>
				
				<?php endif; ?>
			
			</div>
		</div>
	</div>

</div>

<div id="wproto-posts-carousel-temp-holder-<?php echo esc_attr( $atts['id'] ); ?>" style="display: none"></div>

<?php endif; ?>

<?php wp_reset_postdata(); 