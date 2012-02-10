<?php

class Cmb_Setting_Button extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	public function __construct( array $field ) {
		parent::__construct( $field );
		$this->set_attributes();
	}

	public function field() {
		return '<button' . $this->attributes() . '>' . esc_textarea( $this->value() ) . '</button>';
	}

	protected function set_attributes() {
		$this->add_classes( 'cmb-button' );
	}

}