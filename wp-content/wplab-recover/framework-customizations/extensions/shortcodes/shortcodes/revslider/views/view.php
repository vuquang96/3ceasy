<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */

$alias = $atts['slider_alias'];

echo '<div class="wproto-slider-container">';
echo do_shortcode( '[rev_slider alias="' . $alias . '"]' );
echo '</div>';