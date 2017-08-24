<?php if (!defined('FW')) die('Forbidden');

global $wplab_recover_core;

$id = $atts['id'];
$tabs = $posts = array();
$limit = $cols = absint( $atts['columns'] );
$column = 12/$cols;

if( filter_var( $atts['featured_tab']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$tabs['featured'] = $atts['featured_tab']['true']['featured_tab_title'];
	$posts['featured'] = $wplab_recover_core->model('post')->get_featured_products( $limit );
}

if( filter_var( $atts['new_arrivals_tab']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$tabs['new_arrivals'] = $atts['new_arrivals_tab']['true']['new_arrivals_tab_title'];
	$posts['new_arrivals'] = $wplab_recover_core->model('post')->get_recent_posts( 'product', $limit );
}

if( filter_var( $atts['popular_tab']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$tabs['popular'] = $atts['popular_tab']['true']['popular_tab_title'];
	$posts['popular'] = $wplab_recover_core->model('post')->get_best_sellers( $limit );
}

if( filter_var( $atts['top_rated_tab']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$tabs['top_rated'] = $atts['top_rated_tab']['true']['top_rated_tab_title'];
	$posts['top_rated'] = $wplab_recover_core->model('post')->get_top_rated_products( $limit );
}

if( filter_var( $atts['onsale_tab']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$tabs['onsale'] = $atts['onsale_tab']['true']['onsale_tab_title'];
	$posts['onsale'] = $wplab_recover_core->model('post')->get_onsale_products( $limit );
}

if( count( $tabs ) > 0 ):
?>
<div class="theme-tabs theme-shop-tabs" data-responsive-break="<?php echo esc_attr( $atts['responsive_break'] ); ?>" id="<?php echo esc_attr( $id ); ?>">
	<nav>
		<?php $i=0; foreach ($tabs as $key => $tab): ?>
			<a href="#<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>" class="theme-tab" data-tabs-group="tab-group-<?php echo esc_attr( $id ); ?>"><?php echo $tab; ?></a>
		<?php $i++; endforeach; ?>
	</nav>
	<?php $i=0; foreach ( $tabs as $key => $tab ): ?>
		<div id="<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>" class="tab_content">

			<?php if( $posts[$key]->have_posts() ): ?>
			<div class="tab-grid">
				<?php $counter = 0; while ( $posts[$key]->have_posts() ) : $posts[$key]->the_post(); $product = wc_get_product( get_the_ID() ); ?>
				
				<?php if( $counter % $cols == 0 ): ?>
				<div class="row">
				<?php endif; $counter++; ?>
				
				<div class="col col-md-<?php echo $column; ?>">
					<div class="product-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php echo woocommerce_get_product_thumbnail('full'); ?>
						</a>
					</div>
					<div class="product-price">
						<?php echo $product->get_price_html(); ?>
					</div>
					<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
				</div>
				
				<?php if( $counter % $cols == 0 ): ?>
				</div>
				<?php endif; ?>
				
				<?php endwhile; wp_reset_postdata(); ?>
				
				<?php if( $counter%$cols != 0 ): ?>
				</div>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>
		
		</div>
	<?php $i++; endforeach; ?>
</div>
<?php
endif;