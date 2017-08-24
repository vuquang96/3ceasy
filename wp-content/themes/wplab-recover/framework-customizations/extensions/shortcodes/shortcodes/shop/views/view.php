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
	'posts_per_page' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? absint( $atts['posts_per_page'] ) : 9,
	'category' => $cats,
	'term_field' => 'slug',
	'post_type' => 'product',
	'tax_name' => 'product_cat',
	'paged' => $paged,
	'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
	'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
);

$posts = $wplab_recover_core->model('post')->get( $args );
?>

<div class="shop-products-shortcode-<?php echo esc_attr( $atts['style'] ); ?>">

<ul class="products" id="shop-products-id-<?php echo esc_attr( $atts['id'] ); ?>">

<?php if( $posts->have_posts() ): ?>

	<?php while ( $posts->have_posts() ): $posts->the_post(); ?>

		<?php if( $atts['style'] == 'list' ): ?>
		
			<?php get_template_part( 'template-parts/shop-list' ); ?>
		
		<?php elseif( $atts['style'] == 'grid' ): ?>

			<?php wc_get_template_part( 'content', 'product' ); ?>
		
		<?php endif; ?>
	
	<?php endwhile; ?>

</ul>

</div>
<?php
	/**
	 * Pagination
	 **/
?>

<?php if( isset( $atts['pagination']['enabled'] ) && filter_var( $atts['pagination']['enabled'], FILTER_VALIDATE_BOOLEAN ) && $posts->max_num_pages > 1 ): ?>

	<div class="ajax-pagination">
		<a
			href="javascript:;"
			data-target-id="#shop-products-id-<?php echo esc_attr( $atts['id'] ); ?>"
			data-current-page="<?php echo esc_attr( $paged ); ?>"
			data-next-page="<?php echo esc_attr( $paged + 1 ); ?>"
			data-max-pages="<?php echo isset( $posts->max_num_pages ) ? esc_attr( $posts->max_num_pages ) : 1; ?>" 
			data-posts-per-page="<?php echo esc_attr( $atts['posts_per_page'] );?>"  
			data-order-by="<?php echo esc_attr( $atts['order_by'] );?>" 
			data-sort-by="<?php echo esc_attr( $atts['sort_by'] );?>"
			data-thumbs-only="0"  
			data-q-type="<?php echo esc_attr( $tax_query_type );?>" 
			data-q-categories="<?php echo esc_attr( $cats_str );?>"
			data-style="<?php echo esc_attr( $atts['style'] );?>" 
			data-masonry="no"
			data-action="theme_load_more_shop_posts"  
			class="ajax-pagination-link">
				<?php echo wp_kses_post( $atts['pagination']['true']['load_more_text'] ); ?>
		</a>
	</div>

<?php endif; ?>

<?php wp_reset_postdata(); else: ?>
	
	<?php wc_get_template( 'loop/no-products-found.php' ); ?>
	
<?php
endif;