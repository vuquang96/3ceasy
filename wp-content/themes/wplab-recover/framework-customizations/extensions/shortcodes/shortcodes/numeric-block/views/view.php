<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<div class="numeric-block">
	<div class="number"><?php echo wp_kses_post( $atts['number'] ); ?></div>
	<div class="text">
		<h4><?php echo wp_kses_post( $atts['title'] ); ?></h4>
		<div class="desc"><?php echo wp_kses_post( $atts['text'] ); ?></div>
	</div>
</div>