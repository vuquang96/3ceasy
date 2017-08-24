<?php if (!defined('FW')) die('Forbidden'); ?>

<div class="team-members style-<?php echo esc_attr( $atts['display']['type'] ); ?>">

	<?php if( $atts['display']['type'] == 'grid' || $atts['display']['type'] == 'grid_corporate' ): ?>
	<div class="container-fluid">
		<div class="row">
		<?php foreach ( $atts['items'] as $member ) : ?>
		
		<div class="item <?php echo esc_attr( $atts['columns'] ); ?>">
			<div class="inside">
				<div class="photo">
					<?php
						if( isset( $member['avatar_photo']['data'] ) && is_array( $member['avatar_photo']['data'] ) && !empty( $member['avatar_photo']['data'] ) ):
							echo '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="' . esc_attr( $member['avatar_photo']['data']['icon'] ) . '" alt="" />';
						endif;
					?>
					
					<?php if( $atts['display']['type'] == 'grid_corporate' ): ?>
					<div class="overlay">
						<div class="social">
							<?php wplab_recover_front::print_fa_icons( $member ); ?>
						</div>
					</div>
					<?php endif; ?>
					
					<div class="clearfix"></div>
				</div>
				<div class="inside-text">
					<div class="name">
						<h4><?php echo wp_kses_post( $member['name'] ); ?></h4>
						<?php if( $atts['display']['type'] == 'grid' ): ?>
						<div class="position"><?php echo wp_kses_post( $member['position'] ); ?></div>
						<?php endif; ?>
					</div>
					<div class="description">
						<?php echo wp_kses_post( $member['free_text'] ); ?>
						
						<?php if( $atts['display']['type'] == 'grid' ): ?>
						<div class="social">
							<?php wplab_recover_front::print_fa_icons( $member ); ?>
						</div>
						<?php endif; ?>
						
					</div>
					<?php if( $atts['display']['type'] == 'grid_corporate' ): ?>
					<div class="position"><?php echo wp_kses_post( $member['position'] ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<?php endforeach; ?>
		</div>
	</div>
	<?php else: ?>
		<?php foreach ( $atts['items'] as $member ) : ?>
		<div class="item">
		
			<?php
				$with_photo = isset( $member['avatar_photo']['data'] ) && is_array( $member['avatar_photo']['data'] ) && !empty( $member['avatar_photo']['data'] );
			?>
		
			<div class="inside <?php echo $with_photo ? 'with-photo' : ''; ?>">
			
				<?php if( $with_photo ): ?>
				<div class="photo">
					<?php echo wplab_recover_media::image( $member['avatar_photo']['data']['icon'], 270, 215, true, true, $member['avatar_photo']['data']['icon'], true ); ?>
					<div class="social">
					<?php wplab_recover_front::print_fa_icons( $member ); ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="description">
					<header>
						<h4><?php echo wp_kses_post( $member['name'] ); ?></h4>
						<div class="position"><?php echo wp_kses_post( $member['position'] ); ?></div>
					</header>
					<?php $collapse = filter_var( $atts['display']['list']['text_toggle'], FILTER_VALIDATE_BOOLEAN ); ?>
					<div class="text <?php echo $collapse ? 'theme-collapse-text' : ''; ?>" data-more-text="<?php esc_html_e( 'View more', 'wplab-recover' ); ?>" data-less-text="<?php esc_html_e( 'Roll up', 'wplab-recover' ); ?>">					
						<?php echo wp_kses_post( $member['free_text'] ); ?>
					</div>
				</div>
			
			</div>
		</div>
		<?php endforeach; ?>
	<?php endif; ?>

</div>