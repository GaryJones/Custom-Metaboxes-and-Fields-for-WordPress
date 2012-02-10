<?php

class Cmb {

	private $metabox_registrations = array();
	private $metaboxes = array();
	private $metabox_factory;
	private $setting_factory;

	public function __construct( array $metaboxes = array(), $metabox_factory = null, $setting_factory = null ) {
		// Allow classes to load as needed
		spl_autoload_register( array( $this, 'autoload' ) );

		// Metabox config can either be set when creating new Cmb(), or via filter.
		$this->metaboxes_registrations = apply_filters( 'cmb_meta_boxes', $metaboxes );

		// Instantiate, validate and assign factory classes
		$this->init_metabox_factory( $metabox_factory );
		$this->init_setting_factory( $setting_factory );

		// Loop through and create all metaboxes
		foreach ( $this->metaboxes_registrations as $metabox_registration )
			$this->metaboxes[] = $this->metabox_factory->build( $metabox_registration, $this->setting_factory );

		// Hook in scripts and styles
		//add_action( 'admin_enqueue_scripts', 'cmb_scripts', 10 );

		add_action( 'save_post', array( &$this, 'save' ) );
	}

	public function autoload( $classname ) {
		if ( 'Cmb' !== substr( $classname, 0, 3 ) )
			return;

		$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_replace( '_', DIRECTORY_SEPARATOR, $classname ) . '.php';
		require $filename;
	}

	public static function domain() {
		return apply_filters( 'cmb_domain', 'Cmb' );
	}

	public function save( $post_id )  {
		// verify nonce
		if ( ! isset( $_POST['cmb_nonce'] ) || ! wp_verify_nonce( $_POST['cmb_nonce'], __FILE__ ) )
			return $post_id;

		// check autosave
		if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		// check permissions
		if ( 'page' == $_POST['post_type'] )
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		elseif ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
$msg = '';
		foreach ( $this->metaboxes as $metabox ) {
			foreach ( $metabox->settings as $setting ) {
				$meta_key = $setting->id;

				if ( 'file' === $setting->field_type )
					$meta_key = $setting->id . '_id';

				/* Multicheck settings save as an array of values */
				$setting->single = strpos( $setting->field_type, 'multicheck' ) !== false ? false : true;

				$old = get_post_meta( $post_id, $meta_key, $setting->single );

				$posted_value = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : null;

				$new = $setting->prepare_save_value( $posted_value, $post_id );

				$new = apply_filters( 'cmb_validate_' . $setting->field_type, $new, $post_id, $setting );

				if ( ! $setting->single ) {
#					delete_post_meta( $post_id, $meta_key );
					if ( ! empty( $new ) )
						foreach ( $new as $add_new ){}
#							add_post_meta( $post_id, $meta_key, $add_new, false );
				} elseif ( '' !== $new && $new != $old  ) {
#					update_post_meta( $post_id, $meta_key, $new );
				} elseif ( '' == $new ) {
#					delete_post_meta( $post_id, $meta_key );
				}
$debug_value = is_array( $new ) ? print_r( $new, true ) : $new;
$msg .= '<p>' . $post_id . ' : ' . $meta_key . ' : ' . $debug_value;
			}
		}
wp_die($msg);
	}

	private function init_metabox_factory( $metabox_factory ) {
		// State default metabox factory name
		if ( ! $metabox_factory )
			$metabox_factory = 'Cmb_Metabox_Factory';

		// Create the metabox factory class
		$this->metabox_factory = new $metabox_factory;

		// Check the metabox factory class implements the required interface
		$reflection = new ReflectionObject( $this->metabox_factory );
		if ( ! $reflection->implementsInterface( 'Cmb_Metabox_Factory_Interface' ) )
			wp_die( __( 'Custom Metaboxes: metabox factory <code>' . $metabox_factory . '</code> does not implement <code>Cmb_Metabox_Factory_Interface</code>.', $this->domain() ) );

	}

	private function init_setting_factory( $setting_factory ) {
		// State default setting factory name
		if ( ! $setting_factory )
			$setting_factory = 'Cmb_Setting_Factory';

		// Create the setting factory class
		$this->setting_factory = new $setting_factory;

		// Check the setting factory class implements the required interface
		$reflection = new ReflectionObject( $this->setting_factory );
		if ( ! $reflection->implementsInterface( 'Cmb_Setting_Factory_Interface' ) )
			wp_die( __( 'Custom Metaboxes: setting factory <code>' . $setting_factory . '</code> does not implement <code>Cmb_Setting_Factory_Interface</code>.', $this->domain() ) );
	}


}
