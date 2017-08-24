<?php
	/**
	 * Template name: No Header, No Footer
	 **/
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	/**
	 * Display page preloader
	 * this function located at /wproto/helper/front.php
	 **/
	wplab_recover_front::preloader();
?>
<div id="wrap" <?php if( wplab_recover_utils::is_unyson() && fw_get_db_settings_option( 'page_preloader/style' ) != 'hidden' ): ?>style="opacity: 0"<?php endif; ?>>
	<!--
		Content section area
	-->
	<div id="content-wrapper" class="custom-tpl">
	<?php
		if( have_posts() ): while ( have_posts() ) : the_post();
			the_content();
		endwhile; endif;
	?>
	</div><!-- End of content wrapper -->
</div>
<?php wp_footer(); ?>
</body>
</html>