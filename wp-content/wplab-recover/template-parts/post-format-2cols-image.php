<?php
	/**
	 * Image post format
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
	
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
	
					<?php if( has_post_thumbnail() ): ?>
						<header>
							<?php the_content(); ?>
						</header>
					<?php endif; ?>
		
				</div>
				<div class="col-md-6">
		
					<?php
						if( $post_date_style == 'default' ) {
							get_template_part('template-parts/post-date-default');
						}
					?>
		
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
					<?php get_template_part('template-parts/post-data'); ?>
					
					<div class="text">
						<a href="<?php the_permalink(); ?>" class="button style-black link left size-large read-more"><?php echo wplab_recover_front::read_more_link(); ?></a>
					</div>
		
				</div>
			</div>
		</div>
	
	</div>

</article>