<?php
	/**
	 * Video post format
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
	
		<?php
			$youtube_video = wplab_recover_media::getYouTubeVideoId( get_the_content() );
			if( $youtube_video <> '' ) {
				?>
				<header>
					<div class="lazy-video" id="<?php echo uniqid('youtube-video-'); ?>" data-params="modestbranding=1&showinfo=0&controls=0&vq=hd720" data-youtube-id="<?php echo esc_attr( $youtube_video ); ?>"></div>
				</header>
				<?php
			} else {
				?>
				<header>
					<?php echo wplab_recover_utils::get_media( 'video' ); ?>
				</header>
				<?php
			}
		?>
		
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