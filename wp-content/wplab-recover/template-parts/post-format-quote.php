<?php
	/**
	 * Quote post format
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
			if( $post_date_style == 'default' ) {
				get_template_part('template-parts/post-date-default');
			}
		?>
	
		<header>
			<?php the_content(); ?>
		</header>
		
		<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<?php get_template_part('template-parts/post-data'); ?>
	
	</div>

</article>