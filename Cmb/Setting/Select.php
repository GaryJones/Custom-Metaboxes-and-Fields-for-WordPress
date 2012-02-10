<?php

class Cmb_Setting_Select extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	protected $options;

	public function __construct( array $field ) {
		$this->options = $field['options'];
		unset( $field['options'] );
		parent::__construct( $field );
		$this->set_attributes();
	}

	public function field() {
		return '<select' . $this->attributes() . '>' . $this->options() . '</select>';
	}

	public function options() {
		foreach ( $this->options as $option ) {
			//$value = isset( $option['value'] ) ? ' value="' . $option['value'] . '"' : '';
			//unset( $option['value'] );
			$name = isset( $option['name'] ) ? $option['name'] : '';
			unset( $option['name'] );
			$options[] = '<option' . $this->attributes( $option, false ) . '>' . $name . '</option>';
		}
		return implode( "\n", $options );
	}

	protected function set_attributes() {
		$this->add_classes( 'cmb-select' );
	}

}