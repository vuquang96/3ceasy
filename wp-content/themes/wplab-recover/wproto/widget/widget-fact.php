<?php

	add_action( 'widgets_init', 'register_wplab_recover_fact_widget' );
	
	function register_wplab_recover_fact_widget() {
		register_widget( 'wplab_recover_fact_widget' );
	}
	
	class wplab_recover_fact_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_fact_widget', 'description' => esc_html__('A widget that displays some fact in digits (e.g. number of completed projects).', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_fact_widget' );
		
			parent::__construct( 'wproto_fact_widget', esc_html__( '[THEME] Fact in digits', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/fact_in_digits', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['image'] = isset( $new_instance['image'] ) ? wplab_recover_utils::sanitize_link( $new_instance['image'] ) : '';
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['number'] = $new_instance['number'];

			return $new_instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__('Completed Projects', 'wplab-recover'),
				'image' => '',
				'number' => '3570'
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e('Background image', 'wplab-recover'); ?></label>
				<input type="text" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>" />
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-selector"><?php _e( 'Choose an image', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-url-input="#<?php echo $this->get_field_id( 'image' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number:', 'wplab-recover'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>" />
			</p>
			<?php
		}
		
	}