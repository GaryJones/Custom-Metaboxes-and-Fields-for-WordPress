<?php

class Cmb_Setting_Checkbox extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	private $options;

	public function __construct( array $field ) {
		$this->options = isset( $field['options'] ) ? $field['options'] : null;
		unset( $field['options'] );
		parent::__construct( $field );
	}

	public function field() {
		$class   = strpos( $this->field_type, 'inline' ) !== false ? 'cmb-checkbox cmb-checkbox-inline' : 'cmb-checkbox';
		$markup  = '<fieldset><legend class="screen-reader-text">' . $this->label_text . '</legend>';
		$markup .= '<ul class="' . $class . '">' . $this->options() . '</ul></fieldset>';
		return $markup;
	}

	public function options() {

		if ( is_null( $this->options ) )
			$this->options[] = array( 'name' => $this->label_text, 'value' => $this->value(), );

		$i = 1;
		foreach ( $this->options as $option ) {
			//$value = isset( $option['value'] ) ? ' value="' . $option['value'] . '"' : '';
			//unset( $option['value'] );
			$label_text = isset( $option['name'] ) ? $option['name'] : '';
			$option['name'] = 'checkbox' === $this->field_type ? $this->id : $this->id . '[]'; // Consider just $this->id . '_' . sanitize_html_class( $option['value'] )
			$option['id']   = $this->id . $i;
			$option['type'] = 'checkbox';
			$option['value'] = 'checkbox' === $this->field_type ? '1' : $option['value'];
			//$option['checked'] = ... ? 'checked' : null;
			$options[] = '<li><input' . $this->attributes( $option, false ) . ' /><label for="' . $option['id'] . '">' . $label_text . '</label></li>';
			$i++;
		}
		return implode( "\n", $options );
	}

}