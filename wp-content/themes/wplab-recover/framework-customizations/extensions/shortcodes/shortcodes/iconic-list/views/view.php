<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$items = $atts['items'];
if( is_array( $items ) && count( $items ) > 0 ):

?>
<dl class="iconic-list-shortcode style-<?php echo esc_attr( $atts['style'] ); ?>">
	<?php foreach( $items as $item ): ?>
	
	<?php
		$icon = '';
		if( $item['icon_type']['type'] == 'library' ) {
			$icon = '<span class="icon"><i class="' . esc_attr( $item['icon_type']['library']['icon'] ) . '"></i></span>';
		} elseif( $item['icon_type']['type'] == 'custom' ) {
			$icon = '<span class="icon"><img src="' . esc_attr( $item['icon_type']['custom']['icon']['url'] ) . '" class="image-svg" alt="" /></span>';
		}
	?>
	
	<dt><?php print $icon; ?><?php echo wp_kses_post( $item['title'] ); ?></dt>
	<dd><?php echo wp_kses_post( $item['description'] ); ?></dd>
	<?php endforeach; ?>
</dl>
<?php
endif;