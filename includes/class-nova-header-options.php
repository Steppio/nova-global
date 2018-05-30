<?php
/**
 * Nova Global Header Options Class
 * 
 * @package Nova Globals
 * @since 1.0.0
 */

class Nova_Global_Header_Options {

	public $options;

	public $filename;

	public function __construct() {

		$this->options = get_option('nova_header_options');

		$this->filename = __FILE__;

	}
	
	public function register_header_settings_and_fields() {

		register_setting('nova_header_options', 'nova_header_options', array($this, 'nova_header_validate_options')); // 3rd optional callback
		add_settings_section('nova_header_section', 'Header Settings', array($this, 'nova_main_section_init'), __FILE__); // id, title of section, cb, page
		add_settings_field('nova_header_colour', 'Header Colour', array($this, 'nova_header_colour_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_menu_colour', 'Header Menu Colour', array($this, 'nova_header_menu_colour_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_menu_hover_colour', 'Header Menu Hover Colour', array($this, 'nova_header_menu_hover_colour_setting'), __FILE__, 'nova_header_section');		
		add_settings_field('nova_header_logo', 'Header Logo', array($this, 'nova_header_logo_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nhttps://code.tutsplus.com/tutorials/object-oriented-programming-in-wordpress-classes--cms-20021ova_header_mobile_logo', 'Mobile Header Logo', array($this, 'nova_header_mobile_logo_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_mobile_padding', 'Header Mobile Padding', array($this, 'nova_header_mobile_padding_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_tablet_padding', 'Header Tablet Padding', array($this, 'nova_header_tablet_padding_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_desktop_padding', 'Header Desktop Padding', array($this, 'nova_header_desktop_padding_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_mobile_menu_background_colour', 'Header Mobile Menu Background Colour', array($this, 'nova_header_mobile_menu_background_colour_setting'), __FILE__, 'nova_header_section');
		add_settings_field('nova_header_mobile_menu_text_colour', 'Header Mobile Menu Text Colour', array($this, 'nova_header_mobile_menu_text_colour_setting'), __FILE__, 'nova_header_section');
	}

	public function get_filename() {
		return $this->filename;
	}

	public function nova_main_section_init() {

	}

	public function nova_header_validate_options($plugin_options) {
		if(!empty($_FILES['nova_logo_upload']['tmp_name'])) {
			$override = array('test_form' => false);
			$file = wp_handle_upload($_FILES['nova_logo_upload'], $override);
			$plugin_options['nova_logo'] = $file['url'];
		} else {
			$plugin_options['nova_logo'] = $this->options['nova_logo'];
		}

		if(!empty($_FILES['nova_mobile_logo_upload']['tmp_name'])) {
			$override = array('test_form' => false);
			$file = wp_handle_upload($_FILES['nova_mobile_logo_upload'], $override);
			$plugin_options['nova_mobile_logo'] = $file['url'];
		} else {
			$plugin_options['nova_mobile_logo'] = $this->options['nova_mobile_logo'];
		}

		return $plugin_options;
		// print_r($_FILES);
	}

	/*
	* INPUTS
	*/
	// header colour settings
	public function nova_header_colour_setting() {
		echo "<input name='nova_header_options[nova_header_colour]' placeholder='#303030' type='text' value='{$this->options['nova_header_colour']}' />";
	}

	public function nova_header_menu_colour_setting() {
		echo "<input name='nova_header_options[nova_header_menu_colour]' placeholder='#ffffff' type='text' value='{$this->options['nova_header_menu_colour']}' />";	
	}

	public function nova_header_menu_hover_colour_setting() {
		echo "<input name='nova_header_options[nova_header_menu_hover_colour]' placeholder='#000000' type='text' value='{$this->options['nova_header_menu_hover_colour']}' />";	
	}

	// header logo settings
	public function nova_header_logo_setting() {
		echo '<input type="file" name="nova_logo_upload" /><br /><br />';
		if( isset($this->options['nova_logo'])) {
			echo "<img src='{$this->options['nova_logo']}' alt='' />";
		}
	}

	public function nova_header_mobile_logo_setting() {
		echo '<input type="file" name="nova_mobile_logo_upload" /><br /><br />';
		if( isset($this->options['nova_mobile_logo'])) {
			echo "<img src='{$this->options['nova_mobile_logo']}' alt='' />";
		}
	}

	// header padding settings
	public function nova_header_mobile_padding_setting() {
		echo "<input name='nova_header_options[nova_header_mobile_padding]' placeholder='10px 0 10px 0' type='text' value='{$this->options['nova_header_mobile_padding']}' />";
	}

	public function nova_header_tablet_padding_setting() {
		echo "<input name='nova_header_options[nova_header_tablet_padding]' placeholder='20px 0 20px 0' type='text' value='{$this->options['nova_header_tablet_padding']}' />";
	}

	public function nova_header_desktop_padding_setting() {
		echo "<input name='nova_header_options[nova_header_desktop_padding]' placeholder='30px 0 30px 0' type='text' value='{$this->options['nova_header_desktop_padding']}' />";
	}

	// burgermenu options
	public function nova_header_mobile_menu_background_colour_setting() {
		echo "<input name='nova_header_options[nova_header_mobile_menu_background_colour]' placeholder='#000000' type='text' value='{$this->options['nova_header_mobile_menu_background_colour']}' />";
	}

	public function nova_header_mobile_menu_text_colour_setting() {
		echo "<input name='nova_header_options[nova_header_mobile_menu_text_colour]' placeholder='#ffffff' type='text' value='{$this->options['nova_header_mobile_menu_text_colour']}' />";
	}

};