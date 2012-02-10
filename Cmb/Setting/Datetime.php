<?php

class Cmb_Setting_Datetime extends Cmb_Setting_Input implements Cmb_Setting_Interface {

	public function field() {
		echo '<input class="cmb_text_small cmb_datepicker" name="' . esc_attr( $this->id ) . '[date]" id="' . esc_attr( $this->id ) . '_date" type="text" value="" />';
		echo '<input class="cmb_text_time cmb_timepicker" name="' . esc_attr( $this->id ) . '[time]" id="' . esc_attr( $this->id ) . '_time" type="text" value="" />';
	}

}