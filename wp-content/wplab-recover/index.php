<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

	<!--
		List of posts
	-->
	<div class="container">
		<div class="row">
		
			<div id="content" class="<?php echo wplab_recover_utils::get_content_classes(); ?>">

				<?php
					/**
					 * Information about author
					 **/
					if( is_author() && wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_author_after_post' ), FILTER_VALIDATE_BOOLEAN ) ) {
						wplab_recover_front::about_author();
					}
				?>

				<!--
					Posts
				-->

				<?php if( wplab_recover_utils::is_unyson() ): ?>
				
				<?php $template = fw_get_db_settings_option( 'blog_template' ); ?>

					<div id="blog-posts-id-blog" class="blog-posts-shortcode-<?php echo esc_attr( $template ); ?>">

					<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
						
						<?php if( $template == 'cols_1' ): ?>
						
							<?php get_template_part( 'template-parts/post-format', get_post_format() ); ?>
						
						<?php elseif( $template == 'masonry' ): ?>
						
							<?php get_template_part( 'template-parts/post-format-masonry', get_post_format() ); ?>
						
						<?php elseif( $template == 'cols_2' ): ?>
						
							<?php get_template_part( 'template-parts/post-format-2cols', get_post_format() ); ?>
						
						<?php elseif( $template == 'grid_cols_3' ): ?>
						
							<?php get_template_part( 'template-parts/post-format-3cols-grid', get_post_format() ); ?>
						
						<?php endif; ?>
					
					<?php endwhile; ?>
					
					<?php else: ?>
					
						<h4><?php esc_html_e( 'No posts were found', 'wplab-recover' ); ?></h4>
					
					<?php endif; ?>
					
					</div>
				
				<?php else: ?>
				
					<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'template-parts/post-format', get_post_format() ); ?>
					
					<?php endwhile; else: ?>
					
						<h4><?php esc_html_e( 'No posts were found', 'wplab-recover' ); ?></h4>
					
					<?php endif; ?>
					
				<?php endif; ?>
				
				<?php if( have_posts() ): ?>
				<!--
					Pagination
				-->
				<div class="pagination">
				
					<div class="alignleft"><?php previous_posts_link( esc_html__('Previous', 'wplab-recover') ); ?></div>
					<div class="alignright"><?php next_posts_link( esc_html__('Next', 'wplab-recover' ) ); ?></div>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>
				
			</div>
				
			<?php get_sidebar(); ?>
				
		</div><!-- end of row -->
	</div><!-- end of container -->

<?php get_footer(); 