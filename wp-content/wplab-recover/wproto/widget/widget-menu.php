<?php

	add_action( 'widgets_init', 'register_wplab_recover_menu_widget' );
	
	function register_wplab_recover_menu_widget() {
		register_widget( 'wplab_recover_menu_widget' );
	}
	
	class wplab_recover_menu_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_menu_widget', 'description' => esc_html__('A widget that displays menu links in two columns.', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_menu_widget' );
		
			parent::__construct( 'wproto_menu_widget', esc_html__( '[THEME] Two columns menu', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/menu', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['menu'] = isset( $new_instance['menu'] ) ? $new_instance['menu'] : '';

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Userful Links', 'wplab-recover' ),
				'menu' => ''
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>"><?php esc_html_e('Choose menu:', 'wplab-recover'); ?></label>
				<?php
					$theme_menus = get_terms('nav_menu');
				?>
				<select id="<?php echo esc_attr( $this->get_field_id( 'menu' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'menu' ) ); ?>">
					<?php if( count( $theme_menus ) > 0 ): foreach( $theme_menus as $menu ): ?>
					<option <?php selected( $menu->slug, $instance['menu'] ); ?> value="<?php echo esc_attr( $menu->slug ); ?>"><?php echo strip_tags( $menu->name ); ?></option>
					<?php endforeach; endif; ?>
				</select>
			</p>
			<?php
		}
		
	}