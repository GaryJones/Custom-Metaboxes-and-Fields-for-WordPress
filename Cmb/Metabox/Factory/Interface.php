<?php

interface Cmb_Metabox_Factory_Interface {
	public function build( array $metabox, Cmb_Setting_Factory_Interface $setting_factory );
}