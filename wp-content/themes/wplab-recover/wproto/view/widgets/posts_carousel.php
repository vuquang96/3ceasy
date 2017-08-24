<?php
	global $wplab_recover_core;

	$posts = $wplab_recover_core->model('post')->get( array(
		'posts_per_page' 	=> $data['instance']['count'],
		'order' 					=> 'date',
		'sort' 						=> 'DESC',
		'post_type' 			=> 'post',
		'with_thumbnail_only' => $data['instance']['with_thumbs_only']
	));

?>

<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
		<a href="javascript:;" class="c-prev"></a>
		<a href="javascript:;" class="c-next"></a>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->

<?php if( $posts->have_posts() ): ?>
<div class="post-gallery carousel_fade">
	<?php while( $posts->have_posts() ): $posts->the_post(); ?>
	<div class="item <?php echo has_post_thumbnail() ? 'with-thumb' : ''; ?>">
	
		<?php $post_has_thumb = has_post_thumbnail(); ?>
	
		<div class="container-fluid">
			<div class="row">
				<?php if( $post_has_thumb ): ?>
				<div class="col-md-6 img-col">
					<a href="<?php the_permalink(); ?>" class="post-thumb">
						<div>
							<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 270, 170, true, true, '', true ); ?>
						</div>
					</a>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>
				
				<div class="col-md-<?php echo $post_has_thumb ? 6 : 12; ?>">
				
					<div class="time"><?php the_time( get_option('date_format') ); ?></div>
					<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
				
				</div>
				
			</div>
		</div>

	</div>
	<?php endwhile; wp_reset_postdata(); ?>
</div>

	<?php if( isset( $data['instance']['all_posts'] ) && $data['instance']['all_posts'] ): ?>
	<a class="button style-black link left size-medium" href="<?php echo esc_attr( $data['instance']['all_posts_carousel_link'] ); ?>"><?php echo strip_tags( $data['instance']['all_posts_carousel_title'] ); ?></a>
	<?php endif; ?>

<?php endif; ?>

<?php echo $data['args']['after_widget']; 