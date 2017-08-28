<?php

	add_action( 'widgets_init', 'register_wplab_recover_contact_us_widget' );
	
	function register_wplab_recover_contact_us_widget() {
		register_widget( 'wplab_recover_contact_us_widget' );
	}
	
	class wplab_recover_contact_us_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_contact_us_widget', 'description' => esc_html__('A widget that displays contact information.', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_contact_us_widget' );
		
			parent::__construct( 'wproto_contact_us_widget', esc_html__( '[THEME] Contact Us', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = $instance['title'];			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/contact_us', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = str_replace( '\'', "&#39;", $new_instance['title'] );
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
				'title' => esc_html__( 'Do you have any questions?', 'wplab-recover' ),
				'image' => '',
				'subtitle' => esc_html__( 'Contact Us Now', 'wplab-recover' ),
				'phone' => '+123 456 7890',
				'phone_desc' => esc_html__( 'Central Office', 'wplab-recover' ),
				'email' => 'info@yourwebsite.com',
				'email_desc' => esc_html__( 'Support Team', 'wplab-recover' ),
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e('Image File', 'wplab-recover'); ?></label>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-selector"><?php _e( 'Choose an image', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e('Subtitle text:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" value="<?php echo esc_attr( $instance['subtitle'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e('Phone number:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'phone_desc' ) ); ?>"><?php esc_html_e('Phone description:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_desc' ) ); ?>" value="<?php echo esc_attr( $instance['phone_desc'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e('Email:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" value="<?php echo esc_attr( $instance['email'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'email_desc' ) ); ?>"><?php esc_html_e('Email description:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email_desc' ) ); ?>" value="<?php echo esc_attr( $instance['email_desc'] ); ?>" />
			</p>
			<?php
		}
		
	}