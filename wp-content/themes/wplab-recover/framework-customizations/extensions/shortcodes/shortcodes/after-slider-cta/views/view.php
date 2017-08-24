<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
?>
<div class="after-slider-cta" id="shortcode-<?php echo esc_attr( $atts['id'] ); ?>" data-svg-id="svg-shortcode-<?php echo esc_attr( $atts['id'] ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col col-img" <?php if( isset( $atts['bg_image'] ) && !empty( $atts['bg_image'] ) ): ?>style="background-image: url(<?php echo esc_attr( $atts['bg_image']['url'] ); ?>);"<?php endif; ?>>
			
				<div class="projects-num wow animationNuminate" data-to="<?php echo absint( $atts['projects_num'] ); ?>">0</div>
			
			</div>
			<div class="col-md-5 col col-text">
			
				<?php if( isset( $atts['title'] ) && $atts['title'] <> '' ): ?>
				<h4><?php echo wp_kses_post( $atts['title'] ); ?></h4>
				<?php endif; ?>
				
				<?php if( isset( $atts['text'] ) && $atts['text'] <> '' ): ?>
				<div class="desc"><?php echo wp_kses_post( nl2br( $atts['text'] ) ); ?></div>
				<?php endif; ?>
			
			</div>
			<div class="col-md-3 col col-btn">
			
				<div class="cta-btn">
				
					<?php if( isset( $atts['cta_text'] ) && $atts['cta_text'] <> '' ): ?>
					<div class="cta-text"><?php echo wp_kses_post( nl2br( $atts['cta_text'] ) ); ?></div>
					<?php endif; ?>
					
					<?php if( isset( $atts['cta_button_url'] ) && $atts['cta_button_url'] <> '' ): ?>
					<a href="<?php echo esc_attr( $atts['cta_button_url'] ); ?>"><?php echo wp_kses_post( $atts['cta_button_title'] ); ?></a>
					<?php endif; ?>
				
				</div>
			
			</div>
			
		</div>
	</div>
</div>

<svg xmlns="http://www.w3.org/2000/svg" width="0" height="0">
	<defs><clipPath id="svg-shortcode-<?php echo esc_attr( $atts['id'] ); ?>" clipPathUnits="objectBoundingBox"><polygon points="0 0, 0.5 0.1, 1 0" /></clipPath></defs>
</svg>
