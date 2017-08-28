<?php
	if (!defined('FW')) die( 'Forbidden' );
	$id = uniqid('theme-tabs-');
	$tabs_type = isset( $atts['tabs_type'] ) && $atts['tabs_type'] <> '' ? $atts['tabs_type'] : 'horizontal';
?>
<div class="theme-tabs tabs-type-<?php echo esc_attr( $tabs_type ); ?>" data-responsive-break="<?php echo esc_attr( $atts['responsive_break'] ); ?>" id="<?php echo esc_attr( $id ); ?>">
	<nav>
		<?php $i=0; foreach ($atts['tabs'] as $key => $tab): ?>
			<a href="#<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>" class="theme-tab" data-tabs-group="tab-group-<?php echo esc_attr( $id ); ?>"><?php echo $tab['tab_title']; ?></a>
		<?php $i++; endforeach; ?>
	</nav>
	<?php $i=0; foreach ( $atts['tabs'] as $key => $tab ): ?>
		<div id="<?php echo esc_attr( $id ); ?>-<?php echo $i; ?>" class="tab_content">
			<?php echo do_shortcode( $tab['tab_content'] ) ?>
		</div>
	<?php $i++; endforeach; ?>
</div>