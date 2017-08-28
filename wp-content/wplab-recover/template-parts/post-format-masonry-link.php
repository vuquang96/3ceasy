<?php
	/**
	 * Link post format
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
		
			<header class="link-content">
				<h5><?php the_title(); ?></h5>
				<a href="<?php echo strip_tags( get_the_content() ); ?>"><?php echo strip_tags( str_replace( 'https://', '', str_replace( 'http://', '', get_the_content() ) ) ); ?></a>
			</header>
		
		</div>
	</div>
</article>