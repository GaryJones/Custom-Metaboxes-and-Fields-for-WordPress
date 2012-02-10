<?php

class Cmb_Setting_Radio extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	private $options;

	public function __construct( array $field ) {
		$this->options = isset( $field['options'] ) ? $field['options'] : null;
		unset( $field['options'] );
		parent::__construct( $field );
	}

	public function field() {
		$class   = strpos( $this->field_type, 'inline' ) !== false ? 'cmb-radio cmb-radio-inline' : 'cmb-radio';
		$markup  = '<fieldset><legend class="screen-reader-text">' . $this->label_text . '</legend>';
		$markup .= '<ul class="' . $class . '">' . $this->options() . '</ul></fieldset>';
		return $markup;
	}

	public function options() {
		$i = 1;
		foreach ( $this->options as $option ) {
			//$value = isset( $option['value'] ) ? ' value="' . $option['value'] . '"' : '';
			//unset( $option['value'] );
			$label_text = isset( $option['name'] ) ? $option['name'] : '';
			$option['name'] = $this->id;
			$option['id']   = $this->id . $i;
			$option['type'] = 'radio';
			$options[] = '<li><input' . $this->attributes( $option, false ) . ' /><label for="' . $option['id'] . '">' . $label_text . '</label></li>';
			$i++;
		}
		return implode( "\n", $options );
	}

}