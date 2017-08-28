<?php
	if (!defined('FW')) die('Forbidden');
	global $wplab_recover_core;
	
	$cats = $attributes = array();
	$cats_str = '';
	
	$attributes[] = 'data-items="' . esc_attr( $atts['visible_posts'] ) . '"';
	$attributes[] = 'data-items-small="' . esc_attr( $atts['visible_posts_medium'] ) . '"';
	$attributes[] = 'data-items-phone="' . esc_attr( $atts['visible_posts_small'] ) . '"';
	
	if( isset( $atts['autoplay'] ) && filter_var( $atts['autoplay']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
		$attributes[] = 'data-autoplay="1"';
		$attributes[] = 'data-autoplay-time="' . $atts['autoplay']['true']['autoplay_speed'] . '"';
	}
	
	if( isset( $atts['display_dots'] ) && filter_var( $atts['display_dots'], FILTER_VALIDATE_BOOLEAN ) ) {
		$attributes[] = 'data-pagination-dots="1"';
	} else {
		$attributes[] = 'data-pagination-dots="0"';
	}
	
	$tax_query_type = isset( $atts['taxonomy_query']['tax_query_type'] ) ? $atts['taxonomy_query']['tax_query_type'] : '';
	
	if( $tax_query_type == 'only' ) {
		$cats_str = $atts['taxonomy_query']['only']['cats_include'];
		$cats = explode(',', $cats_str );
	} elseif( $tax_query_type == 'except' ) {
		$cats_str = $atts['taxonomy_query']['except']['cats_exclude'];
		$cats = explode(',', $cats_str );
	}
	
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
		'paged' => 1,
		'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
		'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
	);
	
	$posts = $wplab_recover_core->model('post')->get( $args );
	
?>

<?php if( $posts->have_posts() ): ?>

	<div id="shortcode-<?php echo esc_attr( $atts['id'] ); ?>" class="products-carousel" <?php echo implode( ' ', $attributes ); ?>>
	
		<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
		<div class="item">
			<div class="inside">
				<ul class="product-ul">
					<?php wc_get_template_part( 'content', 'product' ); ?>
				</ul>
			</div>
			<div class="after"></div>
		</div>
		<?php endwhile; ?>
	
	</div>
	
<?php endif; wp_reset_postdata(); 