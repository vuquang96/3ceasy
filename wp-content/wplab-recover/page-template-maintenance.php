<!doctype html>
<html class="no-js" <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="wrap">

	<i class="icon"></i>
	
	<?php
		/**
		 * Title
		 ***/
		$allowed_tags = wp_kses_allowed_html( 'post' );
		$title = fw_get_db_settings_option( 'maintenance_mode/true/title' );
		if( $title <> '' ):
	?>
	<h1><?php echo wp_kses( $title, $allowed_tags ); ?></h1>
	<?php endif; ?>
	
	<?php
		/**
		 * Sub-Title
		 ***/
		$subtitle = fw_get_db_settings_option( 'maintenance_mode/true/subtitle' );
		if( $subtitle <> '' ):
	?>
	<div class="subtitle"><?php echo wp_kses( $subtitle, $allowed_tags ); ?></div>
	<?php endif; ?>
	
	<?php
		/**
		 * Countdown
		 **/
		if( filter_var( fw_get_db_settings_option( 'maintenance_mode/true/countdown/enabled' ), FILTER_VALIDATE_BOOLEAN ) ):
	?>
	
		<div id="countdown" class="countdown">
		
			<div class="time">
				<span class="days">00</span>
				<span class="hours">00</span>
				<span class="minutes">00</span>
				<span class="seconds">00</span>
			</div>
		
		</div>
	
	<?php endif; ?>
	
	<?php
		/**
		 * Custom HTML
		 **/
		$content = fw_get_db_settings_option( 'maintenance_mode/true/content' );
		if( $content <> '' ):
	?>
	
		<div class="content">
			<?php echo balanceTags( $content ); ?>
		</div>
	
	<?php endif; ?>
	
	<?php
		/**
		 * Logo
		 **/
		$logo = fw_get_db_settings_option( 'maintenance_mode/true/logo' );
		if( is_array( $logo ) && !empty( $logo ) ):
			// logo for retina
			$logo_2x = fw_get_db_settings_option( 'maintenance_mode/true/logo_2x' );
			$logo_2x = is_array( $logo_2x ) && !empty( $logo_2x ) ? 'data-at2x="' . esc_attr( $logo_2x['url'] ) . '"' : 'data-no-retina';
	?>
	<div class="logo">
		<img src="<?php echo esc_attr( $logo['url'] ); ?>" <?php echo $logo_2x; ?> alt="" />
	</div>
	<?php endif; ?>
	
</div>

<?php wp_footer(); ?>
</body>
</html>