<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
 
$lazy_load = isset( $atts['lazy_load'] ) && filter_var( $atts['lazy_load'], FILTER_VALIDATE_BOOLEAN );

global $wp_embed;
$iframe = $wp_embed->run_shortcode( '[embed]' . esc_attr( trim( $atts['url'] ) ) . '[/embed]' );

if( $lazy_load ) {
	$youtube_id = wplab_recover_media::getYouTubeVideoId( $atts['url'] );
	if( $youtube_id <> '' ):
	
	$preview_img = isset( $atts['preview_img'] ) && is_array( $atts['preview_img'] ) && !empty( $atts['preview_img'] ) ? $atts['preview_img']['url'] : '';
	$preview_title = isset( $atts['video_title'] ) ? $atts['video_title'] : '';	
?>
	<div class="lazy-video shortcode-lazy-video <?php echo $preview_img <> '' ? 'custom-bg' : ''; ?>" style="<?php echo $preview_img <> '' ? 'background-image: url(' . esc_attr( $preview_img ) . ');' : ''; ?>" id="<?php echo uniqid('lazy-video-'); ?>" data-youtube-id="<?php echo esc_attr( $youtube_id ); ?>" data-ratio="16:9"><?php if( $preview_title <> '' ): echo '<div class="prev-title">' . wp_kses_post( $preview_title ) . '</div>'; endif; ?></div>
	<?php else: ?>
	<p><?php esc_html_e('Can not find YouTube video ID', 'wplab-recover'); ?></p>
	<?php endif; ?>

<?php } else { ?>
<div class="responsive-video-wrapper">
	<?php echo do_shortcode( $iframe ); ?>
</div>
<?php }