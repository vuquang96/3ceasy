<?php
	$allowed_tags = wp_kses_allowed_html( 'post' );
	echo $data['args']['before_widget'];
?>

<!-- widget content -->
<div class="widget-content">

	<?php if( isset( $data['instance']['image'] ) && $data['instance']['image'] <> '' ): ?>
		<?php echo wplab_recover_media::image( $data['instance']['image'], 170, 170, true, true, '', true ); ?>
	<?php endif; ?>

	<?php if( isset( $data['title'] ) && $data['title'] <> '' ): ?>
	<h4><?php echo wp_kses( $data['title'], $allowed_tags ); ?></h4>
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['subtitle'] ) && $data['instance']['subtitle'] <> '' ): ?>
		<div class="subtitle"><?php echo wp_kses( $data['instance']['subtitle'], $allowed_tags ); ?></div>
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['phone'] ) && $data['instance']['phone'] <> '' ): ?>
		<div class="phone">
			<?php $phone = wp_kses( $data['instance']['phone'], $allowed_tags ); ?>
			<a href="tel:<?php echo str_replace(' ', '', $phone); ?>"><?php echo $phone; ?></a>
			<div class="phone-desc"><?php echo wp_kses( $data['instance']['phone_desc'], $allowed_tags ); ?></div>
		</div>
	<?php endif; ?>
	
	<?php if( isset( $data['instance']['email'] ) && $data['instance']['email'] <> '' ): ?>
		<div class="email">
			<?php echo wplab_recover_utils::emailize( $data['instance']['email'] ); ?>
			<div class="email-desc"><?php echo wp_kses( $data['instance']['email_desc'], $allowed_tags ); ?></div>
		</div>
	<?php endif; ?>

</div>

<?php echo $data['args']['after_widget']; 