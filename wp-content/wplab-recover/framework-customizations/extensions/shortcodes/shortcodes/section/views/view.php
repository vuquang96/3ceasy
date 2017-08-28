<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$css_classes = $atttibutes = array();

$main_row_id = 'shortcode-' . $atts['id'];

/**
 * Custom ID
 **/
if( isset( $atts['section_id'] ) && $atts['section_id'] <> '' ) {
	$main_row_id = $atts['section_id'];
}

/**
 * Custom CSS Classes
 **/
if( isset( $atts['section_class'] ) && $atts['section_class'] <> '' ) {
	$css_classes[] = esc_attr( $atts['section_class'] );
}

if( isset( $atts['full_height'] ) && filter_var( $atts['full_height'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'full-height-section';
}

if( isset( $atts['hide_bg_large_screens'] ) && filter_var( $atts['hide_bg_large_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-lg';
}

if( isset( $atts['hide_bg_medium_screens'] ) && filter_var( $atts['hide_bg_medium_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-md';
}

if( isset( $atts['hide_bg_small_screens'] ) && filter_var( $atts['hide_bg_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-sm';
}

if( isset( $atts['hide_bg_estra_small_screens'] ) && filter_var( $atts['hide_bg_estra_small_screens'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'bgimage-hidden-xs';
}

if( isset( $atts['hide_lg'] ) && filter_var( $atts['hide_lg'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-lg';
}

if( isset( $atts['hide_md'] ) && filter_var( $atts['hide_md'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-md';
}

if( isset( $atts['hide_sm'] ) && filter_var( $atts['hide_sm'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-sm';
}

if( isset( $atts['hide_xs'] ) && filter_var( $atts['hide_xs'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'hidden-xs';
}

/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'wow';
	$css_classes[] = $atts['animation']['true']['effect'];
	$atttibutes[] = 'data-wow-delay="' . esc_attr( $atts['animation']['true']['animation_delay'] ) . '"';
}

/**
 * 	Stretch class
 **/
if( isset( $atts['container_stretch'] ) && $atts['container_stretch'] <> '' ) {
	$css_classes[] = $atts['container_stretch'];
}

/**
 * Is Full-width container
 **/
$sidebar_position = function_exists('fw_ext_sidebars_get_current_position') ? fw_ext_sidebars_get_current_position() : 'right';
$p_tpl = basename( get_page_template() );
if( $p_tpl == 'page-template-custom.php' || $p_tpl == 'page-template-no-header-footer.php' ) {
	$sidebar_position = 'full';
}
$container_stretch = ( isset( $atts['container_stretch'] ) && ( $atts['container_stretch'] == 'stretch_row_content' || $atts['container_stretch'] == 'stretch_row_content_no_paddings' ) );
$container_class = $container_stretch || ( !is_null( $sidebar_position ) && $sidebar_position !== 'full' ) ? 'container-fluid' : 'container';

if( $p_tpl == 'page.php' && isset( $atts['container_stretch'] ) && $atts['container_stretch'] == 'stretch_row' ) {
	$container_class = 'container';
} elseif( $p_tpl == 'page.php' && isset( $atts['container_stretch'] ) && $atts['container_stretch'] == 'stretch_row_content' ) {
	$container_class = 'container-fluid';
}

/**
 * Section effects
 **/
if( isset( $atts['section_effects']['effect'] ) && $atts['section_effects']['effect'] <> '' ) {
	
	/**
	 * Parallax Background Effect
	 **/
	if( $atts['section_effects']['effect'] == 'parallax' ) {
		$parallax_speed = $atts['section_effects']['parallax']['parallax_speed'] <> '' ? $atts['section_effects']['parallax']['parallax_speed'] : '0.2';
		$parallax_bg = isset( $atts['background_image']['data']['icon'] ) ? $atts['background_image']['data']['icon'] : '';
		
		if( $parallax_bg <> '' ) {
			$css_classes[] = 'parallax-section';
			//$atttibutes[] = 'data-parallax="scroll"';
			$atttibutes[] = 'data-speed="' . esc_attr( $parallax_speed ) . '"';
			$atttibutes[] = 'data-image-src="' . esc_attr( $parallax_bg ) . '"';
		}
	}
	
	/**
	 * YouTube Video Background Effect
	 **/
	if( $atts['section_effects']['effect'] == 'video' ) {
		$css_classes[] = 'video-bg-section';
		$atttibutes[] = 'data-video-id="' . esc_attr( wplab_recover_media::getYouTubeVideoId( $atts['section_effects']['video']['video'] ) ) . '"';
		$atttibutes[] = 'data-video-pause-scroll="' . esc_attr( $atts['section_effects']['video']['video_pause_on_scroll'] ) . '"';
		$atttibutes[] = 'data-video-mute="' . esc_attr( $atts['section_effects']['video']['video_mute'] ) . '"';
	}
	
}

/**
 * Lazy load bg image
 **/
if( filter_var( $atts['background_lazy'], FILTER_VALIDATE_BOOLEAN ) && !empty( $atts['background_image']['data']['css'] ) ) {
	$css_classes[] = 'b-lazy';
	$atttibutes[] = 'data-src="' . esc_attr( $atts['background_image']['data']['icon'] ) . '"';
}

?>
<div id="<?php echo esc_attr( $main_row_id ); ?>" class="fw-main-row <?php echo implode( ' ', $css_classes ); ?>" <?php echo implode( ' ', $atttibutes ); ?>>
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
<?php if( $container_stretch || $atts['container_stretch'] == 'stretch_row' ): ?><div class="row-full-width"></div><?php endif; ?>