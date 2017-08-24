<?php

	add_action( 'widgets_init', 'register_wplab_recover_brochures_widget' );
	
	function register_wplab_recover_brochures_widget() {
		register_widget( 'wplab_recover_brochures_widget' );
	}
	
	class wplab_recover_brochures_widget extends WP_Widget {
		
		function __construct() {
			$widget_ops = array( 'classname' => 'wproto_brochures_widget', 'description' => esc_html__('A widget that displays brochures to download. ', 'wplab-recover') );
		
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'wproto_brochures_widget' );
		
			parent::__construct( 'wproto_brochures_widget', esc_html__( '[THEME] Brochures', 'wplab-recover' ), $widget_ops, $control_ops );
		}
		
		function widget( $args, $instance ) {
			global $wplab_recover_core;
			
			$data = array();
			$data['title'] = apply_filters( 'widget_title', $instance['title'] );			
			$data['instance'] = $instance;
			$data['args'] = $args;

			$wplab_recover_core->view->load_partial( 'widgets/brochures', $data );

		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			//Strip tags from title and name to remove HTML 
			$instance['title'] = strip_tags( str_replace( '\'', "&#39;", $new_instance['title'] ) );
			$instance['file_pdf'] = isset( $new_instance['file_pdf'] ) ? wplab_recover_utils::sanitize_link( $new_instance['file_pdf'] ) : '';
			$instance['file_pdf_size'] = isset( $new_instance['file_pdf_size'] ) ? $new_instance['file_pdf_size'] : '';
			$instance['file_doc'] = isset( $new_instance['file_doc'] ) ? wplab_recover_utils::sanitize_link( $new_instance['file_doc'] ) : '';
			$instance['file_doc_size'] = isset( $new_instance['file_doc_size'] ) ? $new_instance['file_doc_size'] : '';
			$instance['file_ppt'] = isset( $new_instance['file_ppt'] ) ? wplab_recover_utils::sanitize_link( $new_instance['file_ppt'] ) : '';
			$instance['file_ppt_size'] = isset( $new_instance['file_ppt_size'] ) ? $new_instance['file_ppt_size'] : '';

			return $instance;
		}
		
		function form( $instance ) {
			
			//Set up some default widget settings.
			$defaults = array(
				'title' => esc_html__( 'Brochures', 'wplab-recover' ),
				'file_pdf' => '',
				'file_pdf_size' => '',
				'file_doc' => '',
				'file_doc_size' => '',
				'file_ppt' => '',
				'file_ppt_size' => '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget title:', 'wplab-recover'); ?></label>
				<input style="width: 97%;" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_pdf' ) ); ?>"><?php esc_html_e('PDF File', 'wplab-recover'); ?></label>
				<input type="text" style="width: 100%" name="<?php echo esc_attr( $this->get_field_name( 'file_pdf' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_pdf' ) ); ?>" value="<?php echo esc_attr( $instance['file_pdf'] ); ?>" />
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_pdf_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_pdf' ); ?>" class="button wproto-file-selector"><?php _e( 'Choose file', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_pdf_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_pdf' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_pdf_size' ) ); ?>"><?php esc_html_e('PDF File Size', 'wplab-recover'); ?></label>
				<input type="text" style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'file_pdf_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_pdf_size' ) ); ?>" value="<?php echo esc_attr( $instance['file_pdf_size'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_doc' ) ); ?>"><?php esc_html_e('DOC File', 'wplab-recover'); ?></label>
				<input type="text" style="width: 100%" name="<?php echo esc_attr( $this->get_field_name( 'file_doc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_doc' ) ); ?>" value="<?php echo esc_attr( $instance['file_doc'] ); ?>" />
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_doc_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_doc' ); ?>" class="button wproto-file-selector"><?php _e( 'Choose file', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_doc_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_doc' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_doc_size' ) ); ?>"><?php esc_html_e('DOC File Size', 'wplab-recover'); ?></label>
				<input type="text" style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'file_doc_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_doc_size' ) ); ?>" value="<?php echo esc_attr( $instance['file_doc_size'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_ppt' ) ); ?>"><?php esc_html_e('PPT File', 'wplab-recover'); ?></label>
				<input type="text" style="width: 100%" name="<?php echo esc_attr( $this->get_field_name( 'file_ppt' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_ppt' ) ); ?>" value="<?php echo esc_attr( $instance['file_ppt'] ); ?>" />
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_ppt_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_ppt' ); ?>" class="button wproto-file-selector"><?php _e( 'Choose file', 'wplab-recover' ); ?></a> 
				<a href="javascript:;" data-size-target="#<?php echo esc_attr( $this->get_field_id( 'file_ppt_size' ) ); ?>" data-url-input="#<?php echo $this->get_field_id( 'file_ppt' ); ?>" class="button wproto-image-remover"><?php _e( 'Remove', 'wplab-recover' ); ?></a>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'file_ppt_size' ) ); ?>"><?php esc_html_e('PPT File Size', 'wplab-recover'); ?></label>
				<input type="text" style="width: 45px;" name="<?php echo esc_attr( $this->get_field_name( 'file_ppt_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'file_ppt_size' ) ); ?>" value="<?php echo esc_attr( $instance['file_ppt_size'] ); ?>" />
			</p>
			<?php
		}
		
	}