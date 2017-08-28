<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

<div class="container">
	<?php if( filter_var( fw_get_db_post_option( get_the_ID(), 'gallery_before' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
	<div class="row primary-portfolio-gallery">
		<div class="col-md-12">
			<?php wplab_recover_front::print_portfolio_gallery(); ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="row">
	
		<!--
			Article
		-->
	
		<div id="content" class="<?php echo wplab_recover_utils::get_content_classes(); ?>">
		
			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!--
				Article content
			-->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!--
					Portfolio content
				-->
				<?php the_content(); ?>
				
				<?php if( filter_var( fw_get_db_settings_option( 'display_prev_next_portfolio_links' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
				<div class="clearfix"></div>
				
				<div class="prev-next-links">
					<div class="prev-post"><?php previous_post_link( '<span class="arrow">&#8592;</span> %link' ); ?></div> 
					<div class="next-post"><?php next_post_link( '%link <span class="arrow">&#8594;</span>' ); ?></div>
				</div>
				
				<div class="clearfix"></div>
				<?php endif; ?>

			</article>
			
			<?php endwhile; endif; ?>

		</div>

		<?php get_sidebar(); ?>
	
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 