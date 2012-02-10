<?php

class Cmb_Setting_Taxonomy extends Cmb_Setting_Decorator implements Cmb_Setting_Interface {

	public $taxonomy;

	public function __construct( $field ) {

		$this->taxonomy = ( isset( $field['taxonomy'] ) && $field['taxonomy'] ) ? $field['taxonomy'] : 'category';
		unset( $field['taxonomy'] );
		$field['args'] = isset( $field['args'] ) ? $field['args'] : array();

		$args = wp_parse_args( $field['args'], array( 'hide_empty' => '0' ) );

		$terms = get_terms( $this->taxonomy, $args );
		//$names = wp_get_object_terms( 'page', $this->taxonomy );
		//if ( is_wp_error( $names ) || empty( $names ) || strcmp( $term->slug, $names[0]->slug ) )
		//	wp_die( sprintf( __( 'Custom Metaboxes: There was a taxonomy issue with the %s type with ID %s.', Cmb::domain() ), $field['type'], $field['id'] ) );

		foreach ( $terms as $term )
			$field['options'][] = array(
				'name' => $term->name,
				'value' => $term->slug,
			);

		switch ( $field['type'] ) {
			case 'taxonomy_radio':
			case 'taxonomy_radio_inline':
				$this->setting = new Cmb_Setting_Radio( $field );
				break;
			case 'taxonomy_select':
				$this->setting = new Cmb_Setting_Select( $field );
				break;
			case 'taxonomy_checkbox':
			case 'taxonomy_checkbox_inline':
				$this->setting = new Cmb_Setting_Checkbox( $field );
				break;
		}

		$this->assign_properties();

		return $this->setting;

	}

	public function prepare_save_value( $posted_value, $post_id ) {
		return wp_set_object_terms( $post_id, $posted_value, $this->taxonomy );
	}

}