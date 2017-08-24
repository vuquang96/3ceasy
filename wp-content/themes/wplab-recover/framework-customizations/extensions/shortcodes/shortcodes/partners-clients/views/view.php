<?php if (!defined('FW')) die('Forbidden'); ?>

<div class="partners-clients">
	<?php foreach( $atts['items'] as $item ): ?>
	<div class="item">
		<?php
			$logo = is_array( $item['logo'] ) && !empty( $item['logo'] ) ? $item['logo']['url'] : '';
			$logo_2x = is_array( $item['logo_2x'] ) && !empty( $item['logo_2x'] ) ? $item['logo_2x']['url'] : '';
		?>
		<div class="logo">
			<img src="<?php echo esc_attr( $logo ); ?>" <?php echo $logo_2x <> '' ? 'data-at2x="' . esc_attr( $logo_2x ) . '"' : 'data-no-retina'; ?> alt="" />
		</div>
		<div class="text">
			<h4><?php echo wp_kses_post( $item['title'] ); ?></h4>
			<div class="desc">
				<?php echo wp_kses_post( nl2br( $item['text'] ) ); ?>
			</div>
			<div class="url">
				<a rel="nofollow" target="_blank" href="<?php echo esc_attr( $item['url'] ); ?>"><?php echo wp_kses_post( str_replace( 'https://', '', str_replace( 'http://', '', $item['url'] ) ) ); ?></a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
