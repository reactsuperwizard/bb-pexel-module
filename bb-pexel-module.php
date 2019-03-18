<?php
/**
 * Plugin Name: Beaver Builder Pexels Photo
 * Plugin URI: mindsparkwebdesign.com
 * Description: Plugin for adding pexels photo.
 * Version: 1.0
 * Author: rsm0128
 * Author URI: mindsparkwebdesign.com
 */
define( 'FL_MODULE_PEXELS_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_MODULE_PEXELS_URL', plugins_url( '/', __FILE__ ) );

require_once FL_MODULE_PEXELS_DIR . 'classes/class-fl-pexels-loader.php';