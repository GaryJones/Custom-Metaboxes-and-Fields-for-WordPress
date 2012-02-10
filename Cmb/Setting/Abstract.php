<?php

abstract class Cmb_Setting_Abstract implements Cmb_Setting_Interface {

	protected $attributes = array();
	protected $label_text;
	protected $description;
	protected $default_value;
	protected $args;
	public $id;
	public $field_type;
	public $before_field;
	public $after_field;

	public function __construct( array $field ) {
		$this->label_text    = isset( $field['name'] ) ? $field['name'] : '';
		$this->description   = isset( $field['desc'] ) ? $field['desc'] : '';
		$this->id            = $field['id']; /** @todo Handle missing setting ID */
		$this->field_type    = isset( $field['type'] ) ? $field['type'] : 'text';
		$this->default_value = isset( $field['std'] ) ? $field['std'] : '';
		$this->default_value = isset( $field['default'] ) ? $field['default'] : '';
		$this->args          = isset( $field['args'] ) ? $field['args'] : array();
		$this->before_field  = isset( $field['before'] ) ? $field['before'] : '';
		$this->after_field  = isset( $field['after'] ) ? $field['after'] : '';
		unset( $field['name'] );
		unset( $field['desc'] );
		unset( $field['id'] );
		unset( $field['type'] );
		unset( $field['std'] );
		unset( $field['args'] );
		unset( $field['before'] );
		unset( $field['after'] );

		$this->attributes['id'] = $this->id;
		$this->attributes['name'] = $this->id;
		foreach( $field as $attribute => $value )
			$this->attributes[$attribute] = $value;
	}

	protected function attributes( $the_attributes = null, $echo = false ) {
		$the_attributes = is_null( $the_attributes ) ? $this->attributes : $the_attributes;

		foreach( $the_attributes as $attribute => $value )
			$attributes[] = $attribute . '="' . esc_attr( $value ) . '"';

		sort( $attributes );

		if ( $echo )
			echo ' ' . implode( ' ', $attributes );
		return ' ' . implode( ' ', $attributes );
	}

	protected function add_classes( $classes ) {
		if ( ! is_array( $classes ) )
			$classes = explode( ' ', $classes );

		foreach ( $classes as $class )
			$safe_classes[] = sanitize_html_class( $class );

		$this->attributes['class'] = isset( $this->attributes['class'] ) ? $this->attributes['class'] . ' ' . implode( ' ', $safe_classes ) : implode( ' ', $safe_classes );
	}

	public function value() {

	}

	public function field() {
		wp_die( 'Custom Metaboxes: The <code>field()</code> method of <code>Cmb_Setting_Abstract</code> must be re-defined in an a concrete class.' );
	}

	public function prepare_save_value( $value, $post_id ) {
		return $value;
	}

	public function description() {
		if ( $this->description )
			return '<span class="description">' . $this->description . '</span>';
	}

	public function label( $echo = false ) {
		if ( 'title' == $this->field_type )
			return '<h4' . $this->attributes() . '>' . $this->label_text . '</h4>';
		return '<label for="' . esc_attr( $this->id ) . '" id="' . esc_attr( $this->id . '-label' ) . '">' . $this->label_text . '</label>';

	}

}