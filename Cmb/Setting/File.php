<?php

class Cmb_Setting_File extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	private $options;
	public $save_id;

//	public function __construct( array $field ) {
//		$this->options = isset( $field['options'] ) ? $field['options'] : null;
//		unset( $field['options'] );
//		parent::__construct( $field );
//	}

	public function field() {
//		$class   = strpos( $this->field_type, 'inline' ) !== false ? 'cmb-checkbox cmb-checkbox-inline' : 'cmb-checkbox';
//		$markup  = '<fieldset><legend class="screen-reader-text">' . $this->label_text . '</legend>';
//		$markup .= '<ul class="' . $class . '">' . $this->options() . '</ul></fieldset>';
//		return $markup;
	}

	public function prepare_save_value( $posted_value, $post_id ) {
		if ( isset( $this->save_id ) && $this->save_id )
			return isset( $_POST[$this->id . '_id'] ) ? $_POST[$this->id . '_id'] : null;
		return '';
	}

}