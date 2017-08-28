<?php
	/**
	 * Template name: Service
	 **/
	get_header('menu-only');
?>
	<!--
		Content section area
	-->
	<div id="content-wrapper" >
<?php

	$args = array(
       'taxonomy' => 'service_category',
       'parent' => 0,
    );

	$cats = get_terms($args);
//echo get_site_url();
?>

	<div class="nws-service">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="title">Please select</div>
				<div class="nws-brand">
					<?php
						foreach ($cats as $value) {
							$img  = "";
							if(function_exists("taxonomy_image_plugin_get_associations")){
								$associations = taxonomy_image_plugin_get_associations();
								if ( isset( $associations[ $value->term_id ] ) ) {
									$attachment_id = (int) $associations[ $value->term_id ];
									$src = taxonomy_image_plugin_get_image_src( $attachment_id );
									$img = '<img src="'. $src .'" />';
								}
							}

							echo '<div class="item" data-idterm="'. $value->term_id .'" >'
						 		. '<span class="text">' .  $value->name . '</span>'
						 		. $img
						 		. '</div>';
						}

					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="nws-model"> </div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="nws-model-error"> </div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="nws-model-service"> </div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>