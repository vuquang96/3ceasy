<?php
// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>
<div class="theme-intro-block">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
			
				<?php if( !empty( $atts['photo'] ) ): ?>
				<img data-src="<?php echo esc_attr( $atts['photo']['url'] ); ?>" class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="" />
				<?php endif; ?>
			
			</div>
			<div class="col-md-6">
			
				<div class="text-block">
					<?php if( $atts['title'] <> '' ): ?>
						<h4><?php echo $atts['title']; ?></h4>
					<?php endif; ?>
					
					<?php if( $atts['text'] <> '' ): ?>
						<div class="text"><?php echo $atts['text']; ?></div>
					<?php endif; ?>
				</div>
			
			</div>
		</div>
	</div>
	
</div>