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
	'posts_per_page' => isset( $atts['posts_per_page'] ) && $atts['posts_per_page'] <> '' ? absint( $atts['posts_per_page'] ) : 10,
	'category' => $cats,
	'term_field' => 'slug',
	'post_type' => 'post',
	'tax_name' => 'category',
	'with_thumbnail_only' => isset( $atts['with_thumbs_only'] ) ? filter_var( $atts['with_thumbs_only'], FILTER_VALIDATE_BOOLEAN ) : false,
	'paged' => $paged,
	'order' => isset( $atts['order_by'] ) && $atts['order_by'] <> '' ? $atts['order_by'] : 'date',
	'sort' => isset( $atts['sort_by'] ) && $atts['sort_by'] <> '' ? $atts['sort_by'] : 'DESC',
);

$posts = $wplab_recover_core->model('post')->get( $args );

/**
 * Posts style
 **/
?>
<div id="blog-posts-id-<?php echo esc_attr( $atts['id'] ); ?>" class="blog-posts-shortcode-<?php echo esc_attr( $atts['style'] ); ?>">
<?php

if( $posts->have_posts() ): ?>

	<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
	
		<?php if( $atts['style'] == 'cols_1' ): ?>
		
			<?php get_template_part( 'template-parts/post-format', get_post_format() ); ?>
		
		<?php elseif( $atts['style'] == 'masonry' ): ?>
		
			<?php get_template_part( 'template-parts/post-format-masonry', get_post_format() ); ?>
		
		<?php elseif( $atts['style'] == 'cols_2' ): ?>
		
			<?php get_template_part( 'template-parts/post-format-2cols', get_post_format() ); ?>
		
		<?php elseif( $atts['style'] == 'grid_cols_3' ): ?>
		
			<?php get_template_part( 'template-parts/post-format-3cols-grid', get_post_format() ); ?>
		
		<?php endif; ?>
	
	<?php endwhile; ?>
	
</div>
	
<?php
	/**
	 * Pagination
	 **/
?>

<?php if( isset( $atts['pagination']['enabled'] ) && filter_var( $atts['pagination']['enabled'], FILTER_VALIDATE_BOOLEAN ) && $posts->max_num_pages > 1 ): ?>

	<?php if( $atts['pagination']['true']['pagination_style'] == 'ajax' ): ?>

		<div class="ajax-pagination">
			<a
				href="javascript:;"
				data-target-id="#blog-posts-id-<?php echo esc_attr( $atts['id'] ); ?>"
				data-current-page="<?php echo esc_attr( $paged ); ?>"
				data-next-page="<?php echo esc_attr( $paged + 1 ); ?>"
				data-max-pages="<?php echo isset( $posts->max_num_pages ) ? esc_attr( $posts->max_num_pages ) : 1; ?>" 
				data-posts-per-page="<?php echo esc_attr( $atts['posts_per_page'] );?>"  
				data-order-by="<?php echo esc_attr( $atts['order_by'] );?>" 
				data-sort-by="<?php echo esc_attr( $atts['sort_by'] );?>"
				data-thumbs-only="<?php echo esc_attr( $atts['with_thumbs_only'] );?>"  
				data-q-type="<?php echo esc_attr( $tax_query_type );?>" 
				data-q-categories="<?php echo esc_attr( $cats_str );?>"
				data-style="<?php echo esc_attr( $atts['style'] );?>" 
				data-masonry="yes"
				data-action="theme_load_more_blog_posts"  
				class="ajax-pagination-link">
					<?php echo fw_get_db_settings_option( 'load_more_title' ); ?>
			</a>
		</div>

	<?php elseif( $atts['pagination']['true']['pagination_style'] == 'prev_next' ): ?>
	
		<div class="pagination">
			<div class="alignleft"><?php previous_posts_link( esc_html__('Previous', 'wplab-recover'), $posts->max_num_pages ); ?></div>
			<div class="alignright"><?php next_posts_link( esc_html__('Next', 'wplab-recover' ), $posts->max_num_pages ); ?></div>
			<div class="clearfix"></div>
		</div>
	
	<?php elseif( $atts['pagination']['true']['pagination_style'] == 'number' ): ?>
	
		<div class="pagination">
		<?php
			$permalinks_enabled = get_option('permalink_structure') != '';
			$format = $permalinks_enabled ? 'page/%#%/' : '&paged=%#%';
			$base = $permalinks_enabled && !is_search() ? get_pagenum_link(1) .'%_%' : str_replace( 9999999, '%#%', esc_url( get_pagenum_link( 9999999 ) ) );
		
			echo paginate_links( array(
				'format' => $format,
				'base' => $base,
				'current' => max( 1, get_query_var('paged') ),
				'total' => $posts->max_num_pages,
				'prev_text' => esc_html__( '&#8592; Previous', 'wplab-recover'),
				'next_text' => esc_html__( 'Next &#8594;', 'wplab-recover'),
				'mid_size' => 1
			));
		?>
		</div>
	
	<?php endif; ?>

<?php endif; ?>

<?php wp_reset_postdata(); else: ?>
	<h4><?php esc_html_e( 'No posts were found', 'wplab-recover' ); ?></h4>
<?php
endif;