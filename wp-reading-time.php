<?php
/*
Plugin Name: WP Reading Time
Plugin URI: https://github.com/themeskult/wp-reading-time
Description: It's a simple plugin that calculates the remaining reading time as you scroll down.
Version: 1.0
Author: Ricardo Rauch
Author URI: http://themeskult.com
Author Email: store@themeskult.com
License:

  Copyright 2013 WP Reading Time (store@themeskult.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

class WPReadingTime {
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		// Register site styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
		add_action('wp_footer', array( $this, 'my_custom_js'));

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );

	} // end constructor
	
	/**
	 * Registers and enqueues plugin-specific scripts.
	 */
	public function register_plugin_scripts() {

		wp_enqueue_script( 'jquery-reading-time', plugins_url("wp-reading-time/js/jquery.readingTime.js"), array('jquery'));
	
	} // end register_plugin_scripts


	public function my_custom_js() {
		echo "
		<script type='text/javascript' charset='utf-8'>
		(function($) {
		    $('body.single .post').readingTime();
		})( jQuery );
		</script>
		";
	}  
} // end class

// WPReadingTime:	Update the instantiation call of your plugin to the name given at the class definition
$plugin_name = new WPReadingTime();
