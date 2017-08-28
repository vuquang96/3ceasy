<?php $allowed_tags = wp_kses_allowed_html( 'post' ); ?>
<div id="wproto-first-activation-notice" class="updated">

	<?php $theme_name = wp_get_theme(); ?>

	<h3><?php esc_html_e('Dear friend!', 'wplab-recover'); ?></h3>
	<p><?php printf( wp_kses( __( 'Thank you for purchasing and activating <strong>&laquo;%s&raquo;</strong> theme!', 'wplab-recover' ), $allowed_tags ), $theme_name ); ?></p>
	
	<p><?php printf( wp_kses( __('We responsible for the quality of our products, so we have a dedicated support team that will help you to resolve possible problems with our themes as soon as possible in conformity with the <a href="%s">rules</a> of Envato Market / ThemeForest. To open support ticket, please follow <a href="%s">this link</a>.', 'wplab-recover'), $allowed_tags ), 'http://themeforest.net/page/item_support_policy', 'http://wplab.pro' ); ?></p>
	
	<p><?php echo wp_kses( __('We wish you a good luck with Your Business. Best regards, <strong>WPlab</strong> team.', 'wplab-recover'), $allowed_tags ); ?></p>
	
	<p><strong><?php echo wp_kses( sprintf( __( '<a href="%s" id="wproto-hide-activation-notice">Hide this message</a>', 'wplab-recover' ), esc_url( add_query_arg( 'wproto_hide_activation_notice', 'true', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ) ), $allowed_tags ); ?></strong></p>
</div>