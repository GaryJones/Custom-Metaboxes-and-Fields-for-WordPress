<?php

class Cmb_Setting_Input extends Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	public function __construct( array $field ) {

		parent::__construct( $field );
		$this->set_attributes();
	}

	public function field() {
		return '<input' . $this->attributes() . ' />';
	}

	protected function set_attributes() {
		$this->attributes['type'] = isset( $this->attributes['input_type'] ) ? $this->attributes['input_type'] : 'text';
		unset( $this->attributes['input_type'] );
		$this->add_classes( 'cmb-text' );

		switch( $this->field_type ) {
			case 'text_small':
				$this->add_classes( 'cmb-text-small' );
				break;
			case 'text_medium':
				$this->add_classes( 'cmb-text-medium' );
				break;
			case 'text_date':
				$this->add_classes( 'cmb-text-small cmb-datepicker' );
				break;
			case 'text_time':
				$this->add_classes( 'cmb-text-small cmb-timepicker' );
				break;
			case 'text_timestamp':
				$this->add_classes( 'cmb-text-medium cmb-datepicker' );
				break;
			case 'text_money':
				$this->add_classes( 'cmb-text-small cmb-money' );
				break;
			case 'colorpicker':
				$this->add_classes( 'cmb-text-small cmb-colorpicker'  );
				break;
		}
	}

	public function prepare_save_value( $posted_value, $post_id ) {
		switch ( $this->field_type ) {
			case 'text_date_timestamp':
				return strtotime( $posted_value );
			case 'text_datetime_timestamp':
				return strtotime( $posted_value['date'] . ' ' . $posted_value['time'] );
			default:
				return $posted_value;
		}
	}
}