<?php

class Cmb_Setting_Wysiwyg extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	protected $args;

	public function __construct( array $field ) {
		$this->tag = 'wysiwyg';
		$this->args = isset( $field['args'] ) ? $field['args'] : array();
		unset( $field['options'] );
		parent::__construct( $field );
	}

	public function field() {
		ob_start();
		wp_editor( $this->value(), $this->id, $this->args );
		return ob_get_clean();
	}

}