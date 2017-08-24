<?php
// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>
<div id="<?php echo esc_attr( $atts['id'] ); ?>" class="shortcode-fid">

	<?php if( $atts['icon_type']['fid_icon'] == 'custom' && is_array( $atts['icon_type']['custom']['icon'] ) && !empty( $atts['icon_type']['custom']['icon'] ) ): ?>
		<div class="icon">
			<?php echo wplab_recover_media::image( $atts['icon_type']['custom']['icon']['url'], 370, 250, true, true, $atts['icon_type']['custom']['icon']['url'], false, array('image-svg') ); ?>
		</div>
	<?php elseif( $atts['icon_type']['fid_icon'] == 'fontawesome' ): ?>
		<div class="icon">
			<i class="<?php echo esc_attr( $atts['icon_type']['fontawesome']['icon'] ); ?>"></i>
		</div>
	<?php endif; ?>

	<?php if( $atts['number'] <> '' ): ?>
	<div class="number wow animationNuminate" data-to="<?php echo esc_attr( $atts['number'] ); ?>">0</div>
	<?php endif; ?>
	
	<?php if( $atts['title'] <> '' ): ?>
	<div class="title">
		<?php echo wp_kses_post( $atts['title'] ); ?>
	</div>
	<?php endif; ?>

</div>