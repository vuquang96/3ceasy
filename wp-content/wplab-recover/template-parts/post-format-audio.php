<?php
	/**
	 * Audio post format
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
	
		<?php $post_audio = wplab_recover_utils::get_media( 'audio' ); ?>

		<header>
			<?php echo trim( $post_audio ) <> '' ? $post_audio : ''; ?>
		</header>
		
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