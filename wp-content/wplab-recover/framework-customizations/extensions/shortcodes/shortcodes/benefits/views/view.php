<?php if (!defined('FW')) die( 'Forbidden' ); $id = isset( $atts['id'] ) ? $atts['id'] : uniqid(); ?>

<?php
	/**
	 * Images style
	 **/
	if( $atts['style'] == '3cols_photos' || $atts['style'] == '3cols_corporate_third' ):
?>
<div class="benefits style-<?php echo esc_attr( $atts['style'] ); ?>">
	<?php foreach ($atts['items'] as $key => $item ): ?>
	<div class="item <?php echo $item['icon_type']['benefit_icon'] == '' ? 'no-icon' : ''; ?>">

		<?php if( $item['icon_type']['benefit_icon'] == 'custom' && is_array( $item['icon_type']['custom']['icon'] ) && !empty( $item['icon_type']['custom']['icon'] ) ): ?>
			<div class="photo">
				<div class="overlay"></div>
				<div class="title"><?php if( $item['link'] <> '' ): ?><a <?php if( isset( $atts['links_target'] ) && filter_var( $atts['links_target'], FILTER_VALIDATE_BOOLEAN)): ?>target="_blank"<?php endif; ?> href="<?php echo esc_attr( $item['link'] ); ?>"><?php endif; ?><span><?php echo wp_kses_post( $item['title'] ); ?></span><?php if( $item['link'] <> '' ): ?></a><?php endif; ?></div>
				<?php echo wplab_recover_media::image( $item['icon_type']['custom']['icon']['url'], 370, 250, true, true, $item['icon_type']['custom']['icon']['url'], true ); ?>
			</div>
		<?php endif; ?>

		<?php if( $item['title'] <> '' ): ?>
		<h4>
		<?php if( $item['link'] <> '' ): ?>
		<a <?php if( isset( $atts['links_target'] ) && filter_var( $atts['links_target'], FILTER_VALIDATE_BOOLEAN)): ?>target="_blank"<?php endif; ?> href="<?php echo esc_attr( $item['link'] ); ?>">
		<?php endif; ?>
			<?php echo wp_kses_post( $item['title'] ); ?>
		<?php if( $item['link'] <> '' ): ?>
		</a>
		<?php endif; ?>
		</h4>
		<?php endif; ?>

		<?php if( $item['desc'] <> '' ): ?>
		<div class="desc"><?php echo wp_kses_post( $item['desc'] ); ?></div>
		<?php endif; ?>

	</div>
	<?php endforeach; ?>
</div>
<?php
	/**
	 * 3 columns full width style
	 **/
	elseif( $atts['style'] == '3cols_fullwidth' ):
?>
<div class="benefits style-3cols_fullwidth">
	<div class="container-fluid">
		<?php $i=0; foreach ($atts['items'] as $key => $item ): $i++; ?>

			<?php if( $i == 1 ): ?>
			<div class="row">
			<?php endif; ?>

			<div class="col col-num-<?php echo $i; ?> col-md-4 <?php echo $item['icon_type']['benefit_icon'] == '' ? 'no-icon' : ''; ?>" data-mh="benefits-<?php echo esc_attr( $id ); ?>">

				<?php if( $item['link'] <> '' ): ?>
				<a <?php if( isset( $atts['links_target'] ) && filter_var( $atts['links_target'], FILTER_VALIDATE_BOOLEAN)): ?>target="_blank"<?php endif; ?> href="<?php echo esc_attr( $item['link'] ); ?>">
				<?php endif; ?>

				<?php if( $item['icon_type']['benefit_icon'] == 'fontawesome' ): ?>

				<div class="icon">
					<i class="fa <?php echo esc_attr( $item['icon_type']['fontawesome']['icon'] ); ?>"></i>
				</div>

				<?php elseif( $item['icon_type']['benefit_icon'] == 'custom' ): ?>

				<div class="icon">
					<?php wplab_recover_media::image_src( $item['icon_type']['custom']['icon'] ); ?>
				</div>

				<?php endif; ?>

				<div class="text">
					<?php if( $item['title'] <> '' ): ?>
					<h4><?php echo wp_kses_post( $item['title'] ); ?></h4>
					<?php endif; ?>

					<?php if( $item['desc'] <> '' ): ?>
					<div class="desc"><?php echo wp_kses_post( $item['desc'] ); ?></div>
					<?php endif; ?>
				</div>

				<?php if( $item['link'] <> '' ): ?>
				</a>
				<?php endif; ?>

			</div>

			<?php if( $i == 3 ): ?>
			</div>
			<?php endif; ?>

		<?php if( $i == 3 ) { $i = 0; } endforeach; ?>
	</div>
</div>
<?php
	/**
	 * All another styles
	 **/
	else:

?>

<div class="benefits style-<?php echo esc_attr( $atts['style'] ); ?>" id="shortcode-<?php echo esc_attr( $id ); ?>" data-svg-id="svg-shortcode-<?php echo esc_attr( $id ); ?>">
	<?php foreach ($atts['items'] as $key => $item ): ?>

		<div class="item match-height <?php echo $item['icon_type']['benefit_icon'] == '' ? 'no-icon' : ''; ?>" data-mh="benefits-<?php echo esc_attr( $id ); ?>">
			<div class="item-inside">
				<?php if( $item['link'] <> '' ): ?>
				<a <?php if( isset( $atts['links_target'] ) && filter_var( $atts['links_target'], FILTER_VALIDATE_BOOLEAN)): ?>target="_blank"<?php endif; ?> href="<?php echo esc_attr( $item['link'] ); ?>">
				<?php endif; ?>

					<?php if( $item['icon_type']['benefit_icon'] == 'fontawesome' ): ?>

					<div class="icon">
						<i class="fa <?php echo esc_attr( $item['icon_type']['fontawesome']['icon'] ); ?>"></i>
					</div>

					<?php elseif( $item['icon_type']['benefit_icon'] == 'custom' ): ?>

					<div class="icon">
						<?php wplab_recover_media::image_src( $item['icon_type']['custom']['icon'] ); ?>
					</div>

					<?php endif; ?>

					<?php if( $item['title'] <> '' ): ?>
					<h4><?php echo wp_kses_post( $item['title'] ); ?></h4>
					<?php endif; ?>

					<?php if( $item['desc'] <> '' ): ?>
					<div class="desc"><?php echo wp_kses_post( $item['desc'] ); ?></div>
					<?php endif; ?>

				<?php if( $item['link'] <> '' ): ?>
				</a>
				<?php endif; ?>
			</div>
		</div>

	<?php endforeach; ?>

	<svg style="display: block;" xmlns="http://www.w3.org/2000/svg" width="0" height="0">
		<defs><clipPath id="svg-shortcode-<?php echo esc_attr( $id ); ?>" clipPathUnits="objectBoundingBox"><polygon points="0.5 0.85, 0 1, 1 1" /></clipPath></defs>
	</svg>

</div>

<?php endif;
