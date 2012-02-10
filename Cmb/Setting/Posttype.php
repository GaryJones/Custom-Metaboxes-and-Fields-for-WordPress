<?php

class Cmb_Setting_Posttype extends Cmb_Setting_Decorator implements Cmb_Setting_Interface {

	public function __construct( $field ) {

		$args = isset( $field['args'] ) ? $field['args'] : array();
		unset( $field['args'] );

		$post_types = get_post_types( $args, 'objects' );

		foreach ( $post_types as $post_type )
			$field['options'][] = array(
				'name' => $post_type->label,
				'value' => $post_type->name,
			);

		switch ( $field['type'] ) {
			case 'post_type_radio':
			case 'post_type_radio_inline':
				$this->setting = new Cmb_Setting_Radio( $field );
				break;
			case 'post_type_select':
				$this->setting = new Cmb_Setting_Select( $field );
				break;
			case 'post_type_checkbox':
			case 'post_type_checkbox_inline':
				$this->setting = new Cmb_Setting_Checkbox( $field );
				break;
		}

		$this->assign_properties();

		return $this->setting;

	}

}