<?php
	
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
class FL_Custom_Modules_Example_Loader {
	
	/**
	 * Initializes the class once all plugins have loaded.
	 */
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	
	/**
	 * Setup hooks if the builder is installed and activated.
	 */
	static public function setup_hooks() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}
		
		// Load custom modules.
		add_action( 'init', __CLASS__ . '::load_modules' );
		
		// Register custom fields.
		add_filter( 'fl_builder_custom_fields', __CLASS__ . '::register_fields' );
		
		// Enqueue custom field assets.
		add_action( 'init', __CLASS__ . '::enqueue_field_assets' );
		add_action( 'wp_ajax_wppx_search', __CLASS__ . '::wppx_search_ajax' );
		add_action( 'wp_ajax_nopriv_wppx_search', __CLASS__ . '::wppx_search_ajax' );
	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		require_once FL_MODULE_EXAMPLES_DIR . 'modules/basic-example/basic-example.php';
		// require_once FL_MODULE_EXAMPLES_DIR . 'modules/example/example.php';
	}
	
	/**
	 * Registers our custom fields.
	 */
	static public function register_fields( $fields ) {
		$fields['my-custom-field'] = FL_MODULE_EXAMPLES_DIR . 'fields/my-custom-field.php';
		return $fields;
	}
	
	/**
	 * Enqueues our custom field assets only if the builder UI is active.
	 */
	static public function enqueue_field_assets() {
		/*if ( ! FLBuilderModel::is_builder_active() ) {
			return;
		}*/
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'my-custom-fields', FL_MODULE_EXAMPLES_URL . 'assets/css/fields.css', array(), '' );
		wp_enqueue_script( 'my-custom-fields', FL_MODULE_EXAMPLES_URL . 'assets/js/fields.js', array(), '', true );
		wp_localize_script( 'my-custom-fields', 'wppx_vars', array(
				'wppx_username'  => get_option( 'wppx_username' ) ? get_option( 'wppx_username' ) : 'baby2j',
				'wppx_key'       => get_option( 'wppx_key' ) ? get_option( 'wppx_key' ) : '1485725-fcbfa6badf33d350b5eb4670a',
				'wppx_ajax_url'  => admin_url( 'admin-ajax.php' ),
				'wppx_media_url' => admin_url( 'upload.php' ),
				'wppx_nonce'     => wp_create_nonce( 'wppx_nonce' )
			) );
	}

	/**
	 * Search Photo Ajax Request Handling Code
	 */
	static public function wppx_search_ajax() {
		if ( ! isset( $_POST['wppx_nonce'] ) || ! wp_verify_nonce( $_POST['wppx_nonce'], 'wppx_nonce' ) ) {
			die( esc_html__( 'Permissions check failed', 'wppx' ) );
		}
		$ch   = curl_init();
		$page = isset( $_POST['page'] ) ? $_POST['page'] : 1;
		if ( isset( $_POST['key'] ) ) {
			curl_setopt( $ch, CURLOPT_URL, 'http://api.pexels.com/v1/search?query=' . esc_attr( $_POST['key'] ) . '&per_page=12&page=' . $page );
		} else {
			curl_setopt( $ch, CURLOPT_URL, 'http://api.pexels.com/v1/popular?per_page=8&page=1' );
		}
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
			'Authorization: 563492ad6f91700001000001f27710937a744dc14b607b8c6d8d72d5',
			'Content-Type: application/json'
		) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		echo curl_exec( $ch );
		curl_close( $ch );
		die();
	}
}

FL_Custom_Modules_Example_Loader::init();