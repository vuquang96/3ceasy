<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>
<!-- widget content -->

<?php $bg = isset( $data['instance']['image'] ) && $data['instance']['image'] <> '' ? 'background-image: url(' . $data['instance']['image'] . ');' : '';  ?>

<div class="widget-inside" style="<?php echo esc_attr( $bg ); ?>">

	<div class="digit wow animationNuminate" data-to="<?php echo esc_attr( absint( $data['instance']['number'] ) ); ?>">0</div>

</div>

<?php echo $data['args']['after_widget']; 