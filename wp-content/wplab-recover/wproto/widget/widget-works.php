<?php

	add_action( 'widgets_init', 'register_wplab_recover_works_widget' );
	
	function register_wplab_recover_works_widget() {
		register_widget( 'wplab_recover_works_widget' );
	}
	
	class wplab_recover_works_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_works_widget', 'description' => esc_html__('A widget that displays portfolio works. ', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_works_widget' );
		
			parent::__construct( 'wproto_works_widget', esc_html__( '[THEME] Portfolio', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/works', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['count'] = isset( $new_instance['count'] ) ? absint( $new_instance['count'] ) : 6;
			$instance['all_works'] = isset( $new_instance['all_works'] ) ? absint( $new_instance['all_works'] ) : 1;
			$instance['all_works_title'] = isset( $new_instance['all_works_title'] ) ? $new_instance['all_works_title'] : esc_html__( 'All Projects', 'wplab-recover' );
			$instance['all_works_link'] = isset( $new_instance['all_works_link'] ) ? $new_instance['all_works_link'] : wplab_recover_utils::sanitize_link( get_post_type_archive_link('fw-portfolio') );

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Latest Projects', 'wplab-recover' ),
				'count' => 6,
				'all_works' => 1,
				'all_works_title' => esc_html__( 'All Projects', 'wplab-recover' ),
				'all_works_link' => wplab_recover_utils::sanitize_link( get_post_type_archive_link('fw-portfolio') ),
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e('Posts count:', 'wplab-recover'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" class="widefat">
					<?php for( $i=1; $i<11; $i++ ): ?>
					<option <?php echo $instance['count'] == $i ? 'selected="selected"' : ''; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php endfor; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_works' ) ); ?>"><?php esc_html_e('Display "All works" link:', 'wplab-recover'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'all_works' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'all_works' ) ); ?>" class="widefat">
					<option <?php selected( $instance['all_works'], 1 ); ?> value="1"><?php esc_html_e('Yes', 'wplab-recover'); ?></option>
					<option <?php selected( $instance['all_works'], 0 ); ?> value="0"><?php esc_html_e('No', 'wplab-recover'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_works_title' ) ); ?>"><?php esc_html_e('"All works" link text:', 'wplab-recover'); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'all_works_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['all_works_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_works_link' ) ); ?>"><?php esc_html_e('"All works" link URL:', 'wplab-recover'); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'all_works_link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['all_works_link'] ); ?>" />
			</p>
			<?php
		}
		
	}