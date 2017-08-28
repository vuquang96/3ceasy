<?php echo $data['args']['before_widget']; ?>

<!-- widget content -->

<?php $bg = isset( $data['instance']['image'] ) && $data['instance']['image'] <> '' ? 'background-image: url(' . $data['instance']['image'] . ');' : '';  ?>

<div class="widget-content" style="<?php echo esc_attr( $bg ); ?>">

	<div class="text">
		<?php echo isset( $data['instance']['text'] ) ? wp_kses( $data['instance']['text'], wp_kses_allowed_html('post') ) : ''; ?>
	</div>

	<?php if( isset( $data['instance']['link_text'] ) && $data['instance']['link_text'] ): ?>
	<a class="button style-black link center size-medium" href="<?php echo esc_attr( $data['instance']['link_url'] ); ?>"><?php echo strip_tags( $data['instance']['link_text'] ); ?></a>
	<?php endif; ?>

</div>

<?php echo $data['args']['after_widget']; 