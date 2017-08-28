<?php
	/**
	 * Template name: Custom Template
	 **/
	get_header('menu-only');
?>
	<!--
		Content section area
	-->
	<div id="content-wrapper" class="custom-tpl">
<?php
	if( have_posts() ): while ( have_posts() ) : the_post();

		the_content();

	endwhile; endif;

get_footer(); 