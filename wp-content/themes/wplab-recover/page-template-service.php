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
	
$dataApi = file_get_contents('http://localhost/3ceasy/wp-admin/admin-ajax.php?action=store_search&lat=21.0277644&lng=105.8341598&max_results=25&search_radius=100', true);
$dataApi = json_decode($dataApi);

	/*echo "<pre>";
		print_r(json_decode($response));
		echo "<pre>";*/
			
			
$data = [];
		if(is_array($dataApi)){
	    		$i = 0;
	    		foreach ($dataApi as $value) {
		    		$data[$i]['store'] = $value->store;
		    		$data[$i]['email'] = $value->email;
		    		$i++;
		    	}
	    	}
	    		echo "<pre>";
	    	    print_r($data);
	    	    echo "</pre>";



?>

	<div class="nws-service">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="title">Please select</div>
				<div class="nws-brand">
					<?php
						foreach ($cats as $value) {
							$img  = "";
							$associations = taxonomy_image_plugin_get_associations();
							if ( isset( $associations[ $value->term_id ] ) ) {
								$attachment_id = (int) $associations[ $value->term_id ];
								$src = taxonomy_image_plugin_get_image_src( $attachment_id );
								$img = '<img src="'. $src .'" />';
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