<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

	<div class="container">
		<div class="row">
		
			<!--
				WooCommerce Content
			-->
		
			<div id="content" class="<?php echo wplab_recover_utils::get_content_classes(); ?>">
			
				<?php woocommerce_content(); ?>

			</div>
				
			<?php get_sidebar(); ?>
				
		</div><!-- end of row -->
	</div><!-- end of container -->
	
<?php get_footer(); 