<?php

	add_action( 'widgets_init', 'register_wplab_recover_contact_info_widget' );
	
	function register_wplab_recover_contact_info_widget() {
		register_widget( 'wplab_recover_contact_info_widget' );
	}
	
	class wplab_recover_contact_info_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_contact_info_widget', 'description' => esc_html__('A widget that displays contact information.', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_contact_info_widget' );
		
			parent::__construct( 'wproto_contact_info_widget', esc_html__( '[THEME] Contact Information', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/contact_info', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['free_text'] = $new_instance['free_text'];
			$instance['phones'] = $new_instance['phones'];
			$instance['address'] = $new_instance['address'];
			$instance['emails'] = $new_instance['emails'];

			return $new_instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Contact Info', 'wplab-recover' ),
				'free_text' => '',
				'phones' => '',
				'address' => '',
				'emails' => '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'free_text' ) ); ?>"><?php esc_html_e('Free text:', 'wplab-recover'); ?></label>
				<textarea style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'free_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'free_text' ) ); ?>"><?php echo esc_textarea( $instance['free_text'] ); ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'phones' ) ); ?>"><?php esc_html_e('Phones:', 'wplab-recover'); ?></label>
				<textarea style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'phones' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phones' ) ); ?>"><?php echo esc_textarea( $instance['phones'] ); ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e('Address:', 'wplab-recover'); ?></label>
				<textarea style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"><?php echo esc_textarea( $instance['address'] ); ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'emails' ) ); ?>"><?php esc_html_e('Emails:', 'wplab-recover'); ?></label>
				<textarea style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'emails' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'emails' ) ); ?>"><?php echo esc_textarea( $instance['emails'] ); ?></textarea>
			</p>
			<?php
		}
		
	}