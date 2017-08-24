<form class="search-form" action="<?php echo get_site_url(); ?>" method="get">
	<input type="search" name="s" value="" placeholder="<?php echo is_404() ? esc_html__( 'What are you looking for?', 'wplab-recover' ) : esc_html__( 'Type and hit enter...', 'wplab-recover' ); ?>" />
</form>