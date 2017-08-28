<?php if (!defined('FW')) die('Forbidden'); ?>

<div class="history-timeline">
	<?php foreach( $atts['items'] as $item ): ?>
	<div class="item">
		<div class="time">
			<?php echo wp_kses_post( $item['year'] ); ?>
		</div>
		<div class="text">
			<h4><?php echo wp_kses_post( $item['title'] ); ?></h4>
			<div>
				<?php echo wp_kses_post( nl2br( $item['text'] ) ); ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>