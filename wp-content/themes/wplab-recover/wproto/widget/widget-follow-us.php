<?php

	add_action( 'widgets_init', 'register_wplab_recover_follow_us_widget' );
	
	function register_wplab_recover_follow_us_widget() {
		register_widget( 'wplab_recover_follow_us_widget' );
	}
	
	class wplab_recover_follow_us_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_follow_us_widget', 'description' => esc_html__('A widget that displays links to your social profiles. ', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_follow_us_widget' );
		
			parent::__construct( 'wproto_follow_us_widget', esc_html__( '[THEME] Follow Us', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/follow_us', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['display_facebook'] = isset( $new_instance['display_facebook'] ) && (bool)$new_instance['display_facebook'];
			$instance['display_twitter'] = isset( $new_instance['display_twitter'] ) && (bool)$new_instance['display_twitter'];
			$instance['display_linkedin'] = isset( $new_instance['display_linkedin'] ) && (bool)$new_instance['display_linkedin'];
			$instance['display_foursquare'] = isset( $new_instance['display_foursquare'] ) && (bool)$new_instance['display_foursquare'];
			$instance['display_google_plus'] = isset( $new_instance['display_google_plus'] ) && (bool)$new_instance['display_google_plus'];
			$instance['display_youtube'] = isset( $new_instance['display_youtube'] ) && (bool)$new_instance['display_youtube'];
			$instance['display_instagram'] = isset( $new_instance['display_instagram'] ) && (bool)$new_instance['display_instagram'];
			$instance['display_rss'] = isset( $new_instance['display_rss'] ) && (bool)$new_instance['display_rss'];

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Follow Us', 'wplab-recover' ),
				'display_facebook' => true,
				'display_twitter' => true,
				'display_linkedin' => false,
				'display_foursquare' => false,
				'display_google_plus' => true,
				'display_youtube' => true,
				'display_instagram' => false,
				'display_rss' => true,
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_facebook'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_facebook' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_facebook' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_facebook' ) ); ?>"><?php esc_html_e('Display Facebook icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_twitter'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_twitter' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_twitter' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_twitter' ) ); ?>"><?php esc_html_e('Display Twitter icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_linkedin'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_linkedin' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_linkedin' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_linkedin' ) ); ?>"><?php esc_html_e('Display LinkedIn icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_foursquare'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_foursquare' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_foursquare' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_foursquare' ) ); ?>"><?php esc_html_e('Display Foursquare icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_google_plus'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_google_plus' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_google_plus' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_google_plus' ) ); ?>"><?php esc_html_e('Display Google Plus icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_youtube'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_youtube' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_youtube' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_youtube' ) ); ?>"><?php esc_html_e('Display YouTube icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_instagram'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_instagram' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_instagram' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_instagram' ) ); ?>"><?php esc_html_e('Display Instagram icon', 'wplab-recover'); ?></label>
			</p>
			<p>
				<input type="checkbox" <?php checked( $instance['display_rss'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'display_rss' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'display_rss' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'display_rss' ) ); ?>"><?php esc_html_e('Display RSS icon', 'wplab-recover'); ?></label>
			</p>
			<?php
		}
		
	}