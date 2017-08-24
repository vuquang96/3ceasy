<?php

	if (!defined('FW')) die( 'Forbidden' );
	
	$count = isset( $atts['items'] ) ? count( $atts['items'] ) : 0;
	
	if( $count > 0 ):
?>
<div id="shortcode-<?php echo $atts['id']; ?>" class="shortcode-welcome cols-<?php echo esc_attr( $count ); ?>">
	<?php $i=0; foreach( $atts['items'] as $item ): $i++; ?>
		<div class="col col-<?php echo $i; ?> <?php echo $item['icon_type']['welcome_icon'] == '' ? 'no-icon' : ''; ?>">
		
		<?php if( $item['icon_type']['welcome_icon'] == 'custom' && is_array( $item['icon_type']['custom']['icon'] ) && !empty( $item['icon_type']['custom']['icon'] ) ): ?>
		<div class="icon">
			<?php echo wplab_recover_media::image( $item['icon_type']['custom']['icon']['url'], 70, 70, true, true, $item['icon_type']['custom']['icon']['url'], false, array('image-svg') ); ?>
		</div>
		<?php elseif( $item['icon_type']['welcome_icon'] == 'fontawesome' ): ?>
		<div class="icon">
			<i class="<?php echo esc_attr( $item['icon_type']['fontawesome']['icon'] ); ?>"></i>
		</div>
		<?php endif; ?>
		
		<?php if( $item['title'] <> '' ): ?>
		<h4><?php echo wp_kses_post( $item['title'] ); ?></h4>
		<?php endif; ?>
		
		<?php if( $item['desc'] <> '' ): ?>
		<div class="desc"><?php echo wp_kses_post( $item['desc'] ); ?></div>
		<?php endif; ?>
		
		</div>
	<?php endforeach; ?>
</div>
<?php
	endif;