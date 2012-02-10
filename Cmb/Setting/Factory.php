<?php

class Cmb_Setting_Factory implements Cmb_Setting_Factory_Interface {

	public function build( array $field ) {
		switch ( $field['type'] ) {
			case 'text':
			case 'text_small':
			case 'text_medium':
			case 'text_date':
			case 'text_date_timestamp':
			case 'text_datetime': // Wasn't in init.php!
			case 'text_time':
			case 'text_money':
			case 'colorpicker':
				return new Cmb_Setting_Input( $field );
			case 'text_datetime_timestamp':
				return new Cmb_Setting_Datetime( $field );
			case 'textarea':
			case 'textarea_small':
			case 'textarea_code':
				return new Cmb_Setting_Textarea( $field );
			case 'select':
				return new Cmb_Setting_Select( $field );
			case 'title':
				return new Cmb_Setting_Title( $field );
			case 'radio':
			case 'radio_inline':
				return new Cmb_Setting_Radio( $field );
			case 'checkbox':
			case 'multicheck':
			case 'multicheck_inline':
				return new Cmb_Setting_Checkbox( $field );
			case 'wysiwyg':
				return new Cmb_Setting_Wysiwyg( $field );
			case 'taxonomy_radio':
			case 'taxonomy_select':
			case 'taxonomy_checkbox':
			case 'taxonomy_radio_inline':
			case 'taxonomy_checkbox_inline':
				return new Cmb_Setting_Taxonomy( $field );
			case 'post_type_radio':
			case 'post_type_select':
			case 'post_type_checkbox':
			case 'post_type_radio_inline':
			case 'post_type_checkbox_inline':
				return new Cmb_Setting_Posttype( $field );
			default:
				return apply_filters( 'cmb_setting_handler', $field['type'], $field );
				wp_die( 'Custom Metaboxes: Setting type ' . $field['type'] . ' is not recognised.' );
		}
	}

}