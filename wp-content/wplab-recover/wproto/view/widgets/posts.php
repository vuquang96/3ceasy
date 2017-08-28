<?php
	global $wplab_recover_core;

	switch( $data['instance']['query_type'] ) {
		default:
		case('recent'):
		
			$posts = $wplab_recover_core->model('post')->get( array(
				'posts_per_page' 	=> $data['instance']['count'],
				'order' 					=> 'date',
				'sort' 						=> 'DESC',
				'post_type' 			=> 'post',
				'with_thumbnail_only' => true
			));
			
		break;
		case('most_commented'):
		
			$posts = $wplab_recover_core->model('post')->get( array(
				'posts_per_page' 	=> $data['instance']['count'],
				'order' 					=> 'comment_count',
				'sort' 						=> 'DESC',
				'post_type' 			=> 'post',
				'with_thumbnail_only' => true
			));

		break;
		case('random'):
		
			$posts = $wplab_recover_core->model('post')->get( array(
				'posts_per_page' 	=> $data['instance']['count'],
				'order' 					=> 'rand',
				'sort' 						=> 'DESC',
				'post_type' 			=> 'post',
				'with_thumbnail_only' => true
			));

		break;
	}

?>

<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->

<?php if( $posts->have_posts() ): ?>
<ul>
	<?php while( $posts->have_posts() ): $posts->the_post(); ?>
	<li class="<?php echo has_post_thumbnail() ? 'with-thumb' : ''; ?>">
	
		<?php if( has_post_thumbnail() ): ?>
		<a href="<?php the_permalink(); ?>" class="post-thumb">
			<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 80, 80, true, true, '', true ); ?>
		</a>
		<?php endif; ?>
	
		<div class="time"><?php the_time( get_option('date_format') ); ?></div>
		<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
	</li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
<?php endif; ?>

<?php echo $data['args']['after_widget']; 