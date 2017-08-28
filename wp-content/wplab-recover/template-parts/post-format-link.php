<?php
	/**
	 * Link post format
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
	
		<header class="link-content">
			<h5><?php the_title(); ?></h5>
			<a href="<?php echo strip_tags( get_the_content() ); ?>"><?php echo strip_tags( get_the_content() ); ?></a>
		</header>
		
		<?php get_template_part('template-parts/post-data'); ?>
	
	</div>

</article>