<?php
	$product = wc_get_product( get_the_ID() );
?>
<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( $product->is_on_sale() ) : ?>
		<?php echo '<span class="onsale">' . esc_html__( 'Sale!', 'wplab-recover' ) . '</span>'; ?>
	<?php endif; ?>

	<div class="thumb">
		<a href="<?php the_permalink(); ?>"><?php echo woocommerce_get_product_thumbnail('full'); ?></a>
	</div>

	<div class="desc">
		<header>
			<div class="product-price">
				<?php echo $product->get_price_html(); ?>
			</div>
			<div class="product-rating">
				<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
			</div>
			<div class="clearfix"></div>
		</header>
		<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="excerpt">
			<?php echo apply_filters( 'woocommerce_short_description', get_the_excerpt() ); ?>
		</div>
		<?php echo do_shortcode('[add_to_cart id="' . get_the_ID() . '"]'); ?>
	</div>

</li>
