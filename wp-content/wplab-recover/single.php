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
		
			<?php $post_date_style = wplab_recover_utils::is_unyson() ? fw_get_db_settings_option( 'dates_style' ) : 'default'; ?>						
						
			<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!--
				Article content
			-->
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'date-style-' . $post_date_style ); ?>>

				<?php
					if( $post_date_style == 'day_month' ) {
						get_template_part('template-parts/post-date');
					}

					$share_links_enabled = false;
					
					if( wplab_recover_utils::is_unyson() ) {
						$share_enabled = filter_var( fw_get_db_settings_option( 'display_share_links' ), FILTER_VALIDATE_BOOLEAN );
						
						/**
						 * Social share links
						 * this function located at /wproto/helper/front.php
						 **/
						
						if( $share_enabled ) {
							wplab_recover_front::share_links();
						}
					}
				?>
				
				<div class="post-content <?php echo isset( $share_enabled ) && $share_enabled ? 'with-share-block' : ''; ?>">
				
					<?php if( has_post_thumbnail() && ( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_thumbnail_on_single' ), FILTER_VALIDATE_BOOLEAN ) ) ): ?>
						<header class="post-thumbnail">
							<div class="overlay"></div>
							<?php echo wplab_recover_media::image( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ), 1070, 600, true, true, '', true ); ?>
							<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID()) ); ?>" class="zoom lightbox"></a>
						</header>
						<div class="clearfix"></div>
					<?php endif; ?>
					
					<?php
						if( $post_date_style == 'default' ) {
							get_template_part('template-parts/post-date-default');
						}
					?>
				
					<?php if( get_post_format() == 'link' ): ?>
					
						<div class="link-content">
							<h5><?php the_title(); ?></h5>
							<a href="<?php echo strip_tags( get_the_content() ); ?>"><?php echo strip_tags( get_the_content() ); ?></a>
						</div>
					
					<?php else: ?>
				
						<h1 class="post-title"><?php the_title(); ?></h1>
						
						<?php get_template_part('template-parts/post-data'); ?>
	
						<div class="text">
							<?php the_content(); ?>
						</div>
					
					<?php endif; ?>
					
					<?php
					/**
					 * Tags list
					 * this function located at /wproto/helper/front.php
					 **/
					
					if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_share_links' ), FILTER_VALIDATE_BOOLEAN ) ) {
						wplab_recover_front::tags_links();
					}
					?>
				
				</div>

			</article>
			
			<?php
				/**
				 * Information about author
				 **/
				if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_author_after_post' ), FILTER_VALIDATE_BOOLEAN ) ) {
					wplab_recover_front::about_author( get_the_author_meta('ID') );
				}
			?>
			
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
			
			<?php if( wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'display_prev_next_blog_links' ), FILTER_VALIDATE_BOOLEAN ) ): ?>
			<div class="clearfix"></div>
			
			<div class="prev-next-links">
				<div class="prev-post"><?php previous_post_link( '<span class="arrow">&#8592;</span> %link' ); ?></div> 
				<div class="next-post"><?php next_post_link( '%link <span class="arrow">&#8594;</span>' ); ?></div>
			</div>
			
			<div class="clearfix"></div>
			<?php endif; ?>
			
			<!--
				Comments block
			-->
			<?php if( !post_password_required() && comments_open() ): ?>
			
				<?php comments_template( '', true ); ?>
			
			<?php endif; ?>
			
			<?php endwhile; endif; ?>
		</div>

		<?php get_sidebar(); ?>
	
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 