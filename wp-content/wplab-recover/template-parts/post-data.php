<?php
	/**
	 * Post data part
	 **/
?>
<div class="post-data">
	<?php
		/**
		 * Get post categories
		 **/
		$cats_string = '';
		$post_categories = wplab_recover_utils::get_categories();
		$cats_string = $post_categories <> '' ? esc_html__( 'In', 'wplab-recover') . ' ' . $post_categories : ''; 
	?>
	<span><?php esc_html_e('By', 'wplab-recover'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
	<span><?php echo $cats_string; ?></span> 
	<span class="comments-num"><?php comments_number( esc_html__('No comments', 'wplab-recover'), esc_html__('1 Comment', 'wplab-recover'), esc_html__('% Comments', 'wplab-recover') ); ?></span>
</div>