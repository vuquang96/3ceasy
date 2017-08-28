<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
	$archive_style = fw_get_db_settings_option( 'portfolio_archive_style' );
?>

	<!--
		List of posts
	-->
	<div class="container">
		<div class="row">
		
			<div id="content" class="<?php echo wplab_recover_utils::get_content_classes(); ?>">

				<h1>
				<?php
					echo str_replace( '%', ucfirst( get_query_var('term') ), fw_get_db_settings_option( 'portfolio_archive_title' ));
				?>
				</h1>

				<!--
					Posts
				-->

				<div id="portfolio-posts-archive" class="portfolio-posts-shortcode <?php echo filter_var( fw_get_db_settings_option( 'portfolio_archive_display_preview' ), FILTER_VALIDATE_BOOLEAN ) ? 'with-preview' : 'no-preview'; ?> style-<?php echo esc_attr( $archive_style ); ?> hover-style-<?php echo esc_attr( fw_get_db_settings_option( 'portfolio_archive_hover_effect' ) ); ?>">

					<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
		
						<?php if( $archive_style == 'cols_3' ): ?>
						
							<?php get_template_part( 'template-parts/portfolio-3cols' ); ?>
						
						<?php elseif( $archive_style == 'cols_3_no_spaces' ): ?>
						
							<?php get_template_part( 'template-parts/portfolio-3cols-no-spaces' ); ?>
						
						<?php elseif( $archive_style == 'cols_3_desc' ): ?>
						
							<?php get_template_part( 'template-parts/portfolio-3cols-desc' ); ?>
						
						<?php endif; ?>
					
					<?php endwhile; ?>
					
					</div>
					
					<!--
						Pagination
					-->
					<div class="pagination">
					
						<div class="alignleft"><?php previous_posts_link( esc_html__('Previous', 'wplab-recover') ); ?></div>
						<div class="alignright"><?php next_posts_link( esc_html__('Next', 'wplab-recover' ) ); ?></div>
						<div class="clearfix"></div>
					</div>
				
				<?php else: ?>
				
					<div class="container">
						<div class="row">
							<div class="col-md-12">
							<h4><?php esc_html_e( 'No posts were found', 'wplab-recover' ); ?></h4>
							</div>
						</div>
					</div>
					
					</div>
				<?php endif; ?>
				
			</div>
				
			<?php get_sidebar(); ?>
				
		</div><!-- end of row -->
	</div><!-- end of container -->

<?php get_footer(); 