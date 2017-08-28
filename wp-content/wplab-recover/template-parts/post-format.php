<?php
	/**
	 * Simple post content
	 **/
	 $post_date_style = wplab_recover_utils::is_unyson() ? fw_get_db_settings_option( 'dates_style' ) : 'default';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'date-style-' . $post_date_style ); ?>>

	<?php
		if( $post_date_style == 'day_month' ) {
			get_template_part('template-parts/post-date');
		}
	?>

	<div class="post-content">
	
		<?php if( has_post_thumbnail() ): ?>
			<header class="post-thumbnail">
				<div class="overlay"></div>
				<a href="<?php the_permalink(); ?>">
					<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 1070, 600, true, true, '', true ); ?>
				</a>
				<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ); ?>" class="zoom lightbox"></a>
				<a href="<?php the_permalink(); ?>" class="link"></a>
			</header>
			<div class="clearfix"></div>
		<?php endif; ?>
		
		<?php
			if( $post_date_style == 'default' ) {
				get_template_part('template-parts/post-date-default');
			}
		?>
		
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<?php get_template_part('template-parts/post-data'); ?>
		
		<div class="text">
			<?php the_excerpt(); ?>
			<div class="clearfix"></div>
			<a href="<?php the_permalink(); ?>" class="button style-black link left size-large read-more"><?php echo wplab_recover_front::read_more_link(); ?></a>
		</div>
	
	</div>

</article>