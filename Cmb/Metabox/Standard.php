<?php

class Cmb_Metabox_Standard extends Cmb_Metabox_Abstract implements Cmb_Metabox_Interface {

	public function show() {
		echo $this->nonce_field();

		if ( ! $this->settings ) {
			echo '<p>' . __( 'Custom Metaboxes: No settings for this metabox!', Cmb::domain() ) . '</p>';
			return;
		}

		$this->table();
	}

}