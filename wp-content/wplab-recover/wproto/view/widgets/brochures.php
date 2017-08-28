<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->

<div class="items">

	<?php if( isset( $data['instance']['file_pdf'] ) && $data['instance']['file_pdf'] <> '' ): ?>
	<a class="file_pdf" href="<?php echo esc_attr( $data['instance']['file_pdf'] ); ?>" target="_blank"><span class="size"><?php echo strip_tags( $data['instance']['file_pdf_size'] ); ?></span> <?php esc_html_e( 'Download', 'wplab-recover' ); ?> <strong>.PDF</strong></a>
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['file_doc'] ) && $data['instance']['file_doc'] <> '' ): ?>
	<a class="file_doc" href="<?php echo esc_attr( $data['instance']['file_doc'] ); ?>" target="_blank"><span class="size"><?php echo strip_tags( $data['instance']['file_doc_size'] ); ?></span> <?php esc_html_e( 'Download', 'wplab-recover' ); ?> <strong>.DOC</strong></a>
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['file_ppt'] ) && $data['instance']['file_ppt'] <> '' ): ?>
	<a class="file_ppt" href="<?php echo esc_attr( $data['instance']['file_ppt'] ); ?>" target="_blank"><span class="size"><?php echo strip_tags( $data['instance']['file_ppt_size'] ); ?></span> <?php esc_html_e( 'Download', 'wplab-recover' ); ?> <strong>.PPT</strong></a>
	<?php endif; ?>

</div>

<?php echo $data['args']['after_widget']; 