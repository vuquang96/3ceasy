		</div><!-- End of content wrapper -->

		<?php $custom_page_footer = false; ?>

		<?php if( wplab_recover_utils::is_unyson() ): ?>

		<?php
			$custom_page_footer = is_page() && filter_var( fw_get_db_post_option( get_the_ID(), 'customize_page_footer/enabled' ), FILTER_VALIDATE_BOOLEAN );

			if( $custom_page_footer ) {
				$footer_bar_style = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/style' );
			} else {
				$footer_bar_style = fw_get_db_settings_option( 'footer_bar/style' );
			}
			$footer_bar_style = 'hidden' ;
			if( $footer_bar_style != 'hidden' ):
		?>
		<!--
			Footer bar
		-->

		<footer id="footer-bar" class="style-<?php echo esc_attr( $footer_bar_style ); ?>">

			<svg style="display: block;" xmlns="http://www.w3.org/2000/svg" width="0" height="0">
				<defs><clipPath id="footer-cta-svg" clipPathUnits="objectBoundingBox"><polygon points="0 0, 0 1, 1 0.5" /></clipPath></defs>
			</svg>
			<?php if( $footer_bar_style == 'cta' ): ?>

			<!--
				Call to action Footer Bar
			-->

			<?php

				if( $custom_page_footer ) {
					$cta_text = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/cta/footer_cta_text' );
					$link_text = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/cta/footer_cta_link_text' );
					$link_url = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/cta/footer_cta_link_url' );
				} else {
					$cta_text = fw_get_db_settings_option( 'footer_bar/cta/footer_cta_text' );
					$link_text = fw_get_db_settings_option( 'footer_bar/cta/footer_cta_link_text' );
					$link_url = fw_get_db_settings_option( 'footer_bar/cta/footer_cta_link_url' );
				}

			?>

			<div class="container">
				<div class="row">
					<div class="col col-text col-md-8">
						<div class="text">
							<?php echo nl2br( $cta_text ); ?>
						</div>
					</div>
					<div class="col col-link col-md-4">
						<?php if( $link_text <> '' ): ?>
						<a href="<?php echo esc_attr( $link_url ); ?>" class="button style-black link size-medium"><?php echo strip_tags( $link_text ); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php elseif( $footer_bar_style == 'tweets' ): ?>

			<!--
				Latest Tweets Footer Bar
			-->

			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="tweets-container"><i class="fa fa-twitter"></i> <?php esc_html_e( 'Loading latest tweets...', 'wplab-recover' ); ?></div>

					</div>
				</div>
			</div>

			<?php elseif( $footer_bar_style == 'tweets_icons' ): ?>

			<!--
				Latest Tweets and Social Icons Footer Bar
			-->

			<div class="container">
				<div class="row">
					<div class="col col-title col-md-2">
						<div class="tweets-title"><?php esc_html_e( 'Twitter Stream:', 'wplab-recover' ); ?></div>
					</div>
					<div class="col col-tweets col-md-6">

						<div class="tweets-container"><i class="fa fa-twitter"></i> <?php esc_html_e( 'Loading latest tweets...', 'wplab-recover' ); ?></div>

					</div>
					<div class="col col-social col-md-4">

						<?php wplab_recover_front::social_icons(); ?>

					</datalist>
				</div>
			</div>

			<?php elseif( $footer_bar_style == 'contacts' ): ?>

			<!--
				Contacts Footer Bar
			-->

			<?php
				if( $custom_page_footer ) {

					$icon_phone = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_phone_icon' );
					$icon_map = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_address_icon' );
					$icon_email = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_email_icon' );

					$footer_contacts_phones = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_phones' );
					$footer_contacts_address = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_address' );
					$footer_contacts_emails = fw_get_db_post_option( get_the_ID(), 'customize_page_footer/true/footer_bar/contacts/footer_contacts_emails' );

				} else {

					$icon_phone = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_phone_icon' );
					$icon_map = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_address_icon' );
					$icon_email = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_email_icon' );

					$footer_contacts_phones = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_phones' );
					$footer_contacts_address = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_address' );
					$footer_contacts_emails = fw_get_db_settings_option( 'footer_bar/contacts/footer_contacts_emails' );

				}
			?>

			<div class="container-fluid">
				<div class="row">
					<div class="col col-md-4">
						<div class="icon">
							<?php wplab_recover_media::image_src( $icon_phone, get_template_directory_uri() . '/images/svg/phone.svg' ); ?>
						</div>

						<div class="text">
							<?php echo nl2br( $footer_contacts_phones ); ?>
						</div>

					</div>
					<div class="col second col-md-4">
						<div class="icon">
							<?php wplab_recover_media::image_src( $icon_map, get_template_directory_uri() . '/images/svg/location.svg' ); ?>
						</div>

						<div class="text">
							<?php echo nl2br( $footer_contacts_address ); ?>
						</div>

					</div>
					<div class="col col-md-4">
						<div class="icon">
							<?php wplab_recover_media::image_src( $icon_email, get_template_directory_uri() . '/images/svg/plane.svg' ); ?>
						</div>

						<div class="text">
							<?php echo nl2br( wplab_recover_utils::emailize( $footer_contacts_emails ) ); ?>
						</div>

					</div>
				</div>
			</div>
			<?php endif; ?>

		</footer>
		<?php endif; endif; ?>


		<!--
			Footer
		-->
		<footer id="footer">

			<?php
				/**
				 * Display footer widgets
				 * this function located at /wproto/helper/front.php
				 **/
				wplab_recover_front::footer_widgets();
			?>

			<?php
				/**
				 * Display bottom bar
				 * this function located at /wproto/helper/front.php
				 **/
				wplab_recover_front::bottom_bar();
			?>

		</footer>

	</div><!-- End of primary wrapper -->

	

	<?php
		/**
		 * Information for developers, DB queries count, page loading speed
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_recover_front::dev_info();
	?>
	<?php wp_footer(); ?>
</body>
</html>
