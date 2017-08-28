<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id = uniqid();

/**
 * @var array $atts
 */

$class_width = 'fw-col-sm-' . ceil(12 / count($atts['table']['cols']));

?>
<div id="shortcode-table-<?php echo esc_attr( $id ); ?>" data-svg-id="svg-shortcode-<?php echo esc_attr( $id ); ?>" class="fw-pricing">
	<?php foreach ($atts['table']['cols'] as $col_key => $col): ?>
		<div class="fw-package-wrap <?php echo esc_attr($class_width . ' ' . $col['name']); ?> ">
			<div class="fw-package">
				<?php foreach ($atts['table']['rows'] as $row_key => $row): ?>
					<?php if( $col['name'] == 'desc-col' ) : ?>
						<div class="fw-default-row">
							<?php $value = $atts['table']['content'][$row_key][$col_key]['textarea']; ?>
							<?php echo $value ?>
						</div>
					<?php continue; endif; ?>
					<?php if ($row['name'] === 'heading-row'): ?>
						<div class="fw-heading-row">
							<?php $value = $atts['table']['content'][$row_key][$col_key]['textarea']; ?>
							<span>
								<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : $value; ?>
							</span>
						</div>
					<?php elseif ($row['name'] === 'desc-row'): ?>
						<div class="fw-desc-row">
							<?php $value = $atts['table']['content'][$row_key][$col_key]['textarea']; ?>
							<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : $value; ?>
						</div>
					<?php elseif ($row['name'] === 'pricing-row'): ?>
						<div class="fw-pricing-row">
							<?php $amount = $atts['table']['content'][$row_key][$col_key]['amount'] ?>
							<?php $desc   = $atts['table']['content'][$row_key][$col_key]['description']; ?>
							<span>
								<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : $amount; ?>
							</span>
							<small>
								<?php echo (empty($value) && $col['name'] === 'desc-col') ? '&nbps;' : $desc; ?>
							</small>
						</div>
					<?php elseif ( $row['name'] == 'button-row' ) : ?>
						<?php $button = fw_ext( 'shortcodes' )->get_shortcode( 'button' ); ?>
							<div class="fw-button-row">
								<?php if ( false === empty( $atts['table']['content'][ $row_key ][ $col_key ]['button'] ) and false === empty($button) ) : ?>
									<?php echo $button->render($atts['table']['content'][ $row_key ][ $col_key ]['button']); ?>
								<?php else : ?>
									<span>&nbsp;</span>
								<?php endif; ?>
							</div>
					<?php elseif ($row['name'] === 'default-row') : ?>
						<div class="fw-default-row">
							<?php $value = $atts['table']['content'][$row_key][$col_key]['textarea']; ?>
							<div class="text"><?php echo $value ?></div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<svg style="display: block;" xmlns="http://www.w3.org/2000/svg" width="0" height="0">
	<defs><clipPath id="svg-shortcode-<?php echo esc_attr( $id ); ?>" clipPathUnits="objectBoundingBox"><polygon points="0 0, 1 0, 0.5 1" /></clipPath></defs>
</svg>