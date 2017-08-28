<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var string $form_id
 * @var string $form_html
 * @var array $extra_data
 */
 
 $redirect_url = isset( $extra_data['redirect_on_success'] ) ? $extra_data['redirect_on_success'] : '';
?>
<div data-redirect-url="<?php echo esc_attr( $redirect_url ); ?>" class="form-wrapper contact-form">
	<?php echo $form_html; ?>
</div>