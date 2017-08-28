<?php
	/**
	 * Audio post format
	 **/
	$post_date_style = wplab_recover_utils::is_unyson() ? fw_get_db_settings_option( 'dates_style' ) : 'default';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inside">

		<?php
			if( $post_date_style == 'day_month' ) {
				get_template_part('template-parts/post-masonry-date');
			} else {
				get_template_part('template-parts/post-date-default');
			}
		?>
	
		<div class="post-content">
		
			<?php $post_audio = wplab_recover_utils::get_media( 'audio' ); ?>
	
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
			<header>
				<?php echo trim( $post_audio ) <> '' ? $post_audio : ''; ?>
			</header>
			
			<div class="text">
				<?php echo '<p>' . wp_trim_words( get_the_excerpt(), 15 ) . '</p>'; ?>
				<div class="clearfix"></div>
				<a href="<?php the_permalink(); ?>" class="button style-black link left size-large read-more"><?php echo wplab_recover_front::read_more_link(); ?></a>
			</div>
		
		</div>
	</div>
</article>