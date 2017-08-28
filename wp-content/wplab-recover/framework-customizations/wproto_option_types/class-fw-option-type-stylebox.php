<?php

class FW_Option_Type_Stylebox extends FW_Option_Type {
	
  public function get_type() {
    return 'stylebox';
  }

  /**
   * @internal
   */
  protected function _enqueue_static( $id, $option, $data) {
  	
    $uri = get_template_directory_uri() . '/framework-customizations/wproto_option_types/static';

    wp_enqueue_style(
      'fw-option-'. $this->get_type(),
      $uri .'/stylebox.css'
    );

  }

  /**
   * @internal
   */
  protected function _render( $id, $option, $data ) {

    $wrapper_attr = array(
      'id'    => $option['attr']['id'],
      'class' => $option['attr']['class'],
    );

		$top = isset( $data['value']['top'] ) ? $data['value']['top'] : '';
		$right = isset( $data['value']['right'] ) ? $data['value']['right'] : '';
		$bottom = isset( $data['value']['bottom'] ) ? $data['value']['bottom'] : '';
		$left = isset( $data['value']['left'] ) ? $data['value']['left'] : '';

    $html  = '<div '. fw_attr_to_html($wrapper_attr) .'>';
    $html .= '<input name="'. esc_attr( $option['attr']['name'] ) .'[top]" placeholder="' . esc_attr( esc_html__( 'Top', 'wplab-recover') ) . '" value="' . esc_attr( $top ) . '" type="text" />';
		$html .= '<input name="'. esc_attr( $option['attr']['name'] ) .'[right]" placeholder="' . esc_attr( esc_html__( 'Right', 'wplab-recover') ) . '" value="' . esc_attr( $right ) . '" type="text" />';
		$html .= '<input name="'. esc_attr( $option['attr']['name'] ) .'[bottom]" placeholder="' . esc_attr( esc_html__( 'Bottom', 'wplab-recover') ) . '" value="' . esc_attr( $bottom ) . '" type="text" />';
		$html .= '<input name="'. esc_attr( $option['attr']['name'] ) .'[left]" placeholder="' . esc_attr( esc_html__( 'Left', 'wplab-recover') ) . '" value="' . esc_attr( $left ) . '" type="text" />';
    $html .= '</div>';

    return $html;
  }

  /**
   * @internal
   */
  protected function _get_value_from_input( $option, $input_value ) {

    if ( is_null( $input_value ) ) {
      $input_value = $option['value'];
    }

    return (array)$input_value;
  }

  /**
   * @internal
   */
  protected function _get_defaults() {

    return array(
      'value' => array( 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' )
    );
    
  }
}

FW_Option_Type::register('FW_Option_Type_Stylebox');