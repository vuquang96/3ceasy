<?php
	/**
	 * Simple post content
	 **/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-content">
	
		<?php if( has_post_thumbnail() ): ?>
		
			<?php get_template_part('template-parts/post-date'); ?>
		
			<header class="post-thumbnail">
				<div class="overlay"></div>
				<a href="<?php the_permalink(); ?>">
					<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 740, 460, true, true, '', true ); ?>
				</a>
				<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ); ?>" class="zoom lightbox"></a>
				<a href="<?php the_permalink(); ?>" class="link"></a>
			</header>
			<div class="clearfix"></div>
		<?php endif; ?>
		
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<div class="text">
			<?php the_excerpt(); ?>
			<div class="clearfix"></div>
			<a href="<?php the_permalink(); ?>" class="button style-black link left size-large read-more"><?php echo wplab_recover_front::read_more_link(); ?></a>
		</div>
	
	</div>

</article>