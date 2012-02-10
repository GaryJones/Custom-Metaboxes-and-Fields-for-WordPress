<?php

class Cmb_Metabox_Factory implements Cmb_Metabox_Factory_Interface {

	public function build( array $metabox, Cmb_Setting_Factory_Interface $setting_factory ) {
		if ( isset( $metabox['tabs'] ) )
			return new Cmb_Metabox_Tabs( $metabox, $setting_factory );

		return new Cmb_Metabox_Standard( $metabox, $setting_factory );
	}

}