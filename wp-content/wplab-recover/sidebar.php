<?php

	// If Unyson Framework plugin is active
	if( wplab_recover_utils::is_unyson() && function_exists('fw_ext_sidebars_get_current_position') ) {
		
		$current_position = fw_ext_sidebars_get_current_position();
		$side_preset = fw_ext_sidebars_get_current_preset();
		
		$sidebar_size = fw_get_db_settings_option( 'sidebar_size' );
		$sidebar_size = absint( $sidebar_size );
		
		if( $sidebar_size <=0 || $sidebar_size > 5 ) {
			$sidebar_size = 3;
		}
		
		if ( $current_position !== 'full' ) {
			
			echo '<aside id="sidebar" class="col-md-' . $sidebar_size . '">';
			
			if( is_null( $side_preset ) || ! $side_preset ) {
				
				if( wplab_recover_utils::is_woocommerce() && is_woocommerce() ) {
					dynamic_sidebar( 'sidebar-shop' );
					
				} else {
					
					if( $current_position === 'left' ) {
						dynamic_sidebar( 'sidebar-left' );
					} else {
						dynamic_sidebar( 'sidebar-right' );
					}
					
				}
				
			} else {
				
				if( wplab_recover_utils::is_woocommerce() && is_woocommerce() ) {
					dynamic_sidebar( 'sidebar-shop' );
				} else {
					dynamic_sidebar( $side_preset['sidebars']['blue'] );
				}

			}
			echo '</aside>';
			
		}
	
	// If Unyson Framework is not active, just show a right sidebar
	} else {
		
		?>
		<aside id="sidebar" class="col-md-3">
			<?php dynamic_sidebar( 'sidebar-right' ); ?>
		</aside>
		<?php
		
	}