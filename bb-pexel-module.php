<?php
/**
 * Plugin Name: Beaver Builder Custom Modules
 * Plugin URI: http://www.wpbeaverbuilder.com
 * Description: An example plugin for creating custom builder modules.
 * Version: 2.0
 * Author: The Beaver Builder Team
 * Author URI: http://www.wpbeaverbuilder.com
 */
define( 'FL_MODULE_EXAMPLES_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_MODULE_EXAMPLES_URL', plugins_url( '/', __FILE__ ) );

require_once FL_MODULE_EXAMPLES_DIR . 'classes/class-fl-custom-modules-example-loader.php';