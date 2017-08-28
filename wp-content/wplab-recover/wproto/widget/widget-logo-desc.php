<?php

	add_action( 'widgets_init', 'register_wplab_recover_logo_desc_widget' );
	
	function register_wplab_recover_logo_desc_widget() {
		register_widget( 'wplab_recover_logo_desc_widget' );
	}
	
	class wplab_recover_logo_desc_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_logo_desc_widget', 'description' => esc_html__('A widget that displays website logo, description and social icons. ', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_logo_desc_widget' );
		
			parent::__construct( 'wproto_logo_desc_widget', esc_html__( '[THEME] Logo & Description', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/logo_description', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['logo'] = isset( $new_instance['logo'] ) ? wplab_recover_utils::sanitize_link( $new_instance['logo'] ) : '';
			$instance['logo_2x'] = isset( $new_instance['logo_2x'] ) ? wplab_recover_utils::sanitize_link( $new_instance['logo_2x'] ) : '';
			$instance['description'] = isset( $new_instance['description'] ) ? $new_instance['description'] : '';
			$instance['display_social_icons'] = isset( $new_instance['display_social_icons'] ) ? absint( $new_instance['display_social_icons'] ) : 0;

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Modern Building Company', 'wplab-recover' ),
				'logo' => '',
				'logo_2x' => '',
				'description' => '',
				'display_social_icons' => 0
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title after logo:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>"><?php esc_html_e('Website Logo', 'wplab-recover'); ?></label>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'logo' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>" value="<?php echo esc_attr( $instance['logo'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'logo' ); ?>" class="button wproto-image-selector"><?php _e( 'Choose an image', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'logo' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'logo_2x' ) ); ?>"><?php esc_html_e('Website Logo for Retina Displays', 'wplab-recover'); ?></label>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'logo_2x' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'logo_2x' ) ); ?>" value="<?php echo esc_attr( $instance['logo_2x'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'logo_2x' ); ?>" class="button wproto-image-selector"><?php _e( 'Choose an image', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'logo_2x' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e('Free text:', 'wplab-recover'); ?></label>
				<textarea style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_social_icons'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_social_icons' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_social_icons' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_social_icons' ) ); ?>"><?php esc_html_e('Display Social Icons', 'wplab-recover'); ?></label>
			</p>
			<?php
		}
		
	}