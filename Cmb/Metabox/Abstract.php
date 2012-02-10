<?php

abstract class Cmb_Metabox_Abstract implements Cmb_Metabox_Interface {

	public $settings = array();
	protected $id;
	protected $title;
	protected $context;
	protected $priority;
	protected $screens;
	protected $tabs;
	protected $fields;
	private $setting_factory;

	public function __construct( array $metabox_args, Cmb_Setting_Factory_Interface $setting_factory ) {
		$this->setting_factory = $setting_factory;

		$this->id = $metabox_args['id']; // Check for non-existent id
		$this->title = $metabox_args['title']; // Check for non-existent title
		$this->context = isset( $metabox_args['context'] ) ? $metabox_args['context'] : 'normal';
		$this->priority = isset( $metabox_args['priority'] ) ? $metabox_args['priority'] : 'high';
		$this->screens = isset( $metabox_args['pages'] ) ? (array) $metabox_args['pages'] : array();
		$this->fields = isset( $metabox_args['fields'] ) ? (array) $metabox_args['fields'] : array();
		$this->tabs = isset( $metabox_args['tabs'] ) ? (array) $metabox_args['tabs'] : null;

		add_action( 'add_meta_boxes', array( $this, 'register' ) );
		$this->set_settings();
	}

	public function register() {
		foreach ( $this->screens as $screen )
			add_meta_box( $this->id, $this->title, array( &$this, 'show' ), $screen, $this->context, $this->priority );
	}

	public function set_settings() {
		if ( $this->tabs )
			foreach ( $this->tabs as $tabID => $tab )
				for( $i = 0; $i < count( $tab['fields'] ); $i++ )
					$this->tabs[$tabID]['settings'][] = $this->setting_factory->build( $tab['fields'][$i] );
		else
			foreach ( $this->fields as $field )
				$this->settings[] = $this->setting_factory->build( $field );
	}

	public function table( array $settings = null ) {
		$settings = is_null( $settings ) ? $this->settings : $settings;
		$settings = is_null( $settings ) ? $this->tabs['settings'] : $settings;

		echo '<table class="cmb-table form-table"><tbody>';
		foreach( $settings as $setting )
			if ( 'title' === $setting->field_type )
				echo '<tr><td colspan="2">' . $setting->label() . $setting->before_field . $setting->field() . $setting->after_field . $setting->description() . '</td></tr>';
			else
				echo '<tr><th>' . $setting->label() . '</th><td>' .$setting->before_field . $setting->field() . $setting->after_field . $setting->description() . '</td></tr>';
		echo '</tbody></table>';
	}

	public function nonce_field_value() {
		return dirname( dirname( dirname( __FILE__ ) ) ) . '/Cmb.php';
	}

	public function nonce_field() {
		return wp_nonce_field( $this->nonce_field_value(), 'cmb_nonce', true, false );
	}

	public function show() {
		wp_die( 'Custom Metaboxes: The <code>show()</code> method of <code>Cmb_Metabox_Abstract</code> must be re-defined in an a concrete class.' );
	}

}