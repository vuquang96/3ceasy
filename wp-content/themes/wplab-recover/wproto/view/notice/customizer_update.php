<div id="wproto-style-update-notice" class="updated">

	<h3><?php esc_html_e( 'Theme compiled stylesheet should be updated', 'wplab-recover'); ?></h3>

	<p><?php echo wp_kses_post( sprintf( __( 'Base CSS styles were improved in this theme update. Please re-compile your custom styles via <a href="%s"><strong>&laquo;Appearance -> Fonts and Colors&raquo;</strong></a> screen to keep them up to date.', 'wplab-recover'), esc_url( add_query_arg( 'page', 'theme_customizer', admin_url('themes.php') ) ) ) ); ?></p>

	<p><strong><?php echo wp_kses_post( sprintf( __( '<a href="%s" id="wproto-hide-style-update-notice">Hide this message</a>', 'wplab-recover' ), esc_url( add_query_arg( 'wproto_hide_style_update_notice', 'true', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ) ) ); ?></strong></p>
</div>