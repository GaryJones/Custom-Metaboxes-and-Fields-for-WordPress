<?php

class Cmb_Metabox_Tabs extends Cmb_Metabox_Abstract implements Cmb_Metabox_Interface {

	public function show() {
		echo $this->nonce_field();
		// show tabs
		// show tab panels

		foreach ( $this->tabs as $tabID => $tab )
			if ( ! $tab['settings'] )
				$echo = '<p>' . __( 'Custom Metaboxes: No settings for this metabox!', Cmb::domain() ) . '</p>';

		if ( isset( $echo ) ) {
			echo $echo;
			return;
		}

		echo '<div class="cmb-tabs"><ul class="cmb-tabs-tabs">';
		foreach ( $this->tabs as $tabID => $tab )
			echo '<li><a href="#' . $tabID . '">' . $tab['title'] . '</a></li>';
		echo '</ul>';

		foreach ( $this->tabs as $tabID => $tab ) {
			echo '<div class="cmb-tab" id="' . $tabID . '">';
			$this->table( $tab['settings'] );
			echo '</div>';
		}
		echo '</div>';
	}

}