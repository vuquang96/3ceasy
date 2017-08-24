<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

	<div class="container">
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
				
					<?php the_content(); ?>
					
					<?php
						/**
						 * Post pagination
						 **/
						wp_link_pages( array(
							'before' => '<div class="pagination post-pagination">',
							'after' => '</div>',
							'next_or_number' => 'next',
							'nextpagelink' => esc_html__('Next', 'wplab-recover'),
							'previouspagelink' => esc_html__('Previous', 'wplab-recover'),
						));
					?>
					
					<div class="clearfix"></div>
				
					<!--
						Comments block
					-->
					<?php if( !post_password_required() && comments_open() ): ?>
					
						<?php comments_template( '', true ); ?>
					
					<?php endif; ?>
					
					<?php endwhile; endif; ?>
				
				</article>
				
			</div>
				
			<?php get_sidebar(); ?>
				
		</div><!-- end of row -->
	</div><!-- end of container -->
	
<?php get_footer(); 