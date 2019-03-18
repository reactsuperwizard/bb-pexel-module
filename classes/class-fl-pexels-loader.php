<?php
	
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
class FL_Pexels_Loader {
	
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
		add_action( 'wp_ajax_bbpx_search', __CLASS__ . '::bbpx_search_ajax' );
		add_action( 'wp_ajax_nopriv_bbpx_search', __CLASS__ . '::bbpx_search_ajax' );
	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		require_once FL_MODULE_PEXELS_DIR . 'modules/pexels/pexels.php';
	}
	
	/**
	 * Registers our custom fields.
	 */
	static public function register_fields( $fields ) {
		$fields['pexel-picker'] = FL_MODULE_PEXELS_DIR . 'fields/pexel-picker.php';
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
		wp_enqueue_style( 'pexel-pickers', FL_MODULE_PEXELS_URL . 'assets/css/fields.css', array(), '' );
		wp_enqueue_script( 'pexel-pickers', FL_MODULE_PEXELS_URL . 'assets/js/fields.js', array(), '', true );
		wp_localize_script( 'pexel-pickers', 'bbpx_vars', array(
				'bbpx_ajax_url'  => admin_url( 'admin-ajax.php' ),
				'bbpx_nonce'     => wp_create_nonce( 'bbpx_nonce' )
			) );
	}

	/**
	 * Search Photo Ajax Request Handling Code
	 */
	static public function bbpx_search_ajax() {
		if ( ! isset( $_POST['bbpx_nonce'] ) || ! wp_verify_nonce( $_POST['bbpx_nonce'], 'bbpx_nonce' ) ) {
			die( esc_html__( 'Permissions check failed', 'bbpx' ) );
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

FL_Pexels_Loader::init();