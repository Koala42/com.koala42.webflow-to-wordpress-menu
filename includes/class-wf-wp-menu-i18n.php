<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://koala42.com
 * @since      1.0.0
 *
 * @package    Wf_Wp_Menu
 * @subpackage Wf_Wp_Menu/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wf_Wp_Menu
 * @subpackage Wf_Wp_Menu/includes
 * @author     KOALA42 <info@koala42.com>
 */
class Wf_Wp_Menu_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wf-wp-menu',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
