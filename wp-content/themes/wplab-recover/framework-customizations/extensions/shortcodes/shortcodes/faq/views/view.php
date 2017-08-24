<?php if (!defined('FW')) die('Forbidden'); ?>

<div class="faq style-<?php echo esc_attr($atts['style']); ?>">
	<?php foreach( $atts['items'] as $item ): ?>
	<div class="item">
		<div class="qa">
			<span class="question">
				<?php if( isset( $atts['question_abbr'] ) && $atts['question_abbr'] <> '' ): ?>
					<?php echo wp_kses_post( $atts['question_abbr'] ); ?>
				<?php else: ?>
					<?php esc_html_e( 'Q', 'wplab-recover' ); ?>
				<?php endif; ?>
			</span>
			<span class="answer">
				<?php if( isset( $atts['answer_abbr'] ) && $atts['answer_abbr'] <> '' ): ?>
					<?php echo wp_kses_post( $atts['answer_abbr'] ); ?>
				<?php else: ?>
					<?php esc_html_e( 'A', 'wplab-recover' ); ?>
				<?php endif; ?>
			</span>
		</div>
		<div class="text">
			<h4><?php echo wp_kses_post( $item['question'] ); ?></h4>
			<?php echo $item['answer']; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>