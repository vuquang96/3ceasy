<?php
	if (!defined('FW')) die('Forbidden');
	$animate = isset( $atts['animate'] ) && $atts['animate'];
	
?>

<?php foreach( $atts['items'] as $item ): ?>

	<div class="progress-bar <?php echo $animate ? 'animated' : ''; ?>">
		<div class="progress-bar-title">
			<span class="num"><?php echo wp_kses_post( $item['value'] ); ?>%</span>
			<span class="title"><?php echo wp_kses_post( $item['title'] ); ?></span>
		</div>
		<div class="progress-bar-value">
			<div class="progress-bar-value-inner">
				<div class="value wow animationProgressBar" data-wow-delay="0.1s" data-width="<?php echo esc_attr( $item['value'] ); ?>%" style="width: 0%"></div>
			</div>
		</div>
	</div>

<?php endforeach; 