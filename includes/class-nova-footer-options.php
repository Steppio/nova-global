<?php
/**
 * Nova Global Footer Options Class
 * 
 * @package Nova Globals
 * @since 1.0.0
 */

class Nova_Global_Footer_Options {

	public $options;

	public function __construct() {

		$this->options = get_option('nova_header_options');
		$this->register_header_settings_and_fields();

	}

}