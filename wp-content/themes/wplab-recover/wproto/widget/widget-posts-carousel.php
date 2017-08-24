<?php

	add_action( 'widgets_init', 'register_wplab_recover_posts_carousel_widget' );
	
	function register_wplab_recover_posts_carousel_widget() {
		register_widget( 'wplab_recover_posts_carousel_widget' );
	}
	
	class wplab_recover_posts_carousel_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_posts_carousel_widget', 'description' => esc_html__('A widget that displays blog posts carousel. ', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_posts_carousel_widget' );
		
			parent::__construct( 'wproto_posts_carousel_widget', esc_html__( '[THEME] Posts Carousel', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/posts_carousel', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['count'] = isset( $new_instance['count'] ) ? absint( $new_instance['count'] ) : 5;
			$instance['all_posts'] = isset( $new_instance['all_posts'] ) ? absint( $new_instance['all_posts'] ) : 1;
			$instance['with_thumbs_only'] = isset( $new_instance['with_thumbs_only'] ) ? absint( $new_instance['with_thumbs_only'] ) : 0;
			$instance['all_posts_carousel_title'] = isset( $new_instance['all_posts_carousel_title'] ) ? $new_instance['all_posts_carousel_title'] : esc_html__( 'All News', 'wplab-recover' );
			$instance['all_posts_carousel_link'] = isset( $new_instance['all_posts_carousel_link'] ) ? $new_instance['all_posts_carousel_link'] : wplab_recover_utils::sanitize_link( get_post_type_archive_link('post') );

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Recent News', 'wplab-recover' ),
				'count' => 5,
				'all_posts' => 1,
				'with_thumbs_only' => 0,
				'all_posts_carousel_title' => esc_html__( 'All News', 'wplab-recover' ),
				'all_posts_carousel_link' => wplab_recover_utils::sanitize_link( get_post_type_archive_link('post') ),
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
				<input type="checkbox" <?php checked( $instance['with_thumbs_only'], 1 ); ?> name="<?php echo esc_attr( $this->get_field_name( 'with_thumbs_only' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'with_thumbs_only' ) ); ?>" value="1" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'with_thumbs_only' ) ); ?>"><?php esc_html_e('Posts with thumbnails only', 'wplab-recover'); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_posts' ) ); ?>"><?php esc_html_e('Display "All news" link:', 'wplab-recover'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'all_posts' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'all_posts' ) ); ?>" class="widefat">
					<option <?php selected( $instance['all_posts'], 1 ); ?> value="1"><?php esc_html_e('Yes', 'wplab-recover'); ?></option>
					<option <?php selected( $instance['all_posts'], 0 ); ?> value="0"><?php esc_html_e('No', 'wplab-recover'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_posts_carousel_title' ) ); ?>"><?php esc_html_e('"All news" link text:', 'wplab-recover'); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'all_posts_carousel_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['all_posts_carousel_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'all_posts_carousel_link' ) ); ?>"><?php esc_html_e('"All news" link URL:', 'wplab-recover'); ?></label>
				<input name="<?php echo esc_attr( $this->get_field_name( 'all_posts_carousel_link' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['all_posts_carousel_link'] ); ?>" />
			</p>
			<?php
		}
		
	}