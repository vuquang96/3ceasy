<?php

	add_action( 'widgets_init', 'register_wplab_recover_cta_widget' );
	
	function register_wplab_recover_cta_widget() {
		register_widget( 'wplab_recover_cta_widget' );
	}
	
	class wplab_recover_cta_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_cta_widget', 'description' => esc_html__('A widget that displays some call to action.', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_cta_widget' );
		
			parent::__construct( 'wproto_cta_widget', esc_html__( '[THEME] Call to action', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/cta', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['image'] = isset( $new_instance['image'] ) ? wplab_recover_utils::sanitize_link( $new_instance['image'] ) : '';
			$instance['subtitle'] = $new_instance['subtitle'];
			$instance['phone'] = $new_instance['phone'];
			$instance['phone_desc'] = $new_instance['phone_desc'];
			$instance['email'] = $new_instance['email'];
			$instance['email_desc'] = $new_instance['email_desc'];

			return $new_instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'image' => '',
				'text' => '',
				'link_text' => '',
				'link_url' => ''
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e('Background image', 'wplab-recover'); ?></label>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-selector"><?php _e( 'Choose an image', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e('Call to action text:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" value="<?php echo esc_attr( $instance['text'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"><?php esc_html_e('Link text:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" value="<?php echo esc_attr( $instance['link_text'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>"><?php esc_html_e('Link URL:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url' ) ); ?>" value="<?php echo esc_attr( $instance['link_url'] ); ?>" />
			</p>
			<?php
		}
		
	}