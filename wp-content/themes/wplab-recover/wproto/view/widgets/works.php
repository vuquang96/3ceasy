<?php
	global $wplab_recover_core;

	$posts = $wplab_recover_core->model('post')->get( array(
		'posts_per_page' 			=> $data['instance']['count'],
		'order' 							=> 'date',
		'sort' 								=> 'DESC',
		'post_type' 					=> 'fw-portfolio',
		'with_thumbnail_only' => true
	));

?>

<?php if( $posts->have_posts() ): ?>

<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->
<ul>
	<?php while( $posts->have_posts() ): $posts->the_post(); ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 87, 87, true, true, '', true ); ?>
		</a>
	</li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
<div class="clearfix"></div>

	<?php if( isset( $data['instance']['all_works'] ) && $data['instance']['all_works'] ): ?>
	
	<a class="button style-black link left size-medium" href="<?php echo esc_attr( $data['instance']['all_works_link'] ); ?>"><?php echo strip_tags( $data['instance']['all_works_title'] ); ?></a>
	
	<?php endif; ?>

<?php echo $data['args']['after_widget']; ?>

<?php endif;  