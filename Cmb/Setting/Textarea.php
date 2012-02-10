<?php

class Cmb_Setting_Textarea extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	public function __construct( array $field ) {
		parent::__construct( $field );
		$this->set_attributes();
	}

	public function field() {
		return '<textarea' . $this->attributes() . '>' . esc_textarea( $this->value() ) . '</textarea>';
	}

	protected function set_attributes() {
		$this->add_classes( 'cmb-textarea' );
	}

	public function prepare_save_value( $posted_value, $post_id ) {
		switch ( $this->field_type ) {
			case 'textarea':
			case 'textarea_small':
				return htmlspecialchars( $posted_value );
			case 'textarea_code':
				return htmlspecialchars_decode( $posted_value );
			default:
				return $posted_value;
		}
	}

}