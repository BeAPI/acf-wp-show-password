<?php
/*
  Plugin Name: ACF - WP Show Password
  Description: Very simple WordPress plugin to add a checkbox show password when it's an ACF input type password - it also adds this functionnality on login screen WordPress
  Author: BE API
  Author URI: http://www.beapi.fr
  Version: 0.2
*/

if ( ! function_exists( 'add_action' ) ) {
	die( 'No direct load !' );
}

// useful constants
define( 'ACF_SHOW_PASSWD_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACF_SHOW_PASSWD_URL', plugin_dir_url( __FILE__ ) );
define( 'ACF_SHOW_PASSWD_VERSION', '0.2' );

// When all plugins WP are loaded
add_action( 'plugins_loaded', 'bea_acf_show_passwd_init' );
function bea_acf_show_passwd_init() {

	// i18n
	load_plugin_textdomain( 'acf-wp-show-password', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

	$instance = BEA_Show_Passwd::getInstance();
	$instance->hooks();
}

class BEA_Show_Passwd {

	/**
	 * @var self
	 */
	protected static $instance;

	protected function __construct() {
	}

	public function hooks() {
		// hooks
		add_action( 'acf/input/admin_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
		add_action( 'login_enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
		add_action( 'acf/render_field/type=password', [ __CLASS__, 'render_field_password' ], 99 );
		add_action( 'acf/prepare_field/type=password', [ __CLASS__, 'prepare_field_password' ] );
		add_action( 'login_form', [ __CLASS__, 'render_field_password' ] );
	}

	/**
	 * @return self
	 */
	final public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new static;
		}
		return self::$instance;
	}

	/**
	 * Enqueue
	 * @author Julien Maury
	 */
	public static function enqueue_scripts() {

		$prefix = ( 'wp-login.php' === $GLOBALS['pagenow'] ) ? 'login-' : '';

		wp_register_script( 'acf-wp-show-passwd', ACF_SHOW_PASSWD_URL . 'js/' . $prefix . 'passwd-visibility.js', ['jquery'], ACF_SHOW_PASSWD_VERSION, true );
		wp_enqueue_script( 'acf-wp-show-passwd' );

		// we could look for [type="password"]
		// don't like this kinda of selectors ^^
		$class = apply_filters( 'acf_wp_show_passwd/class/register_scripts', 'acf-wp-show-passwd' );
		wp_localize_script( 'acf-wp-show-passwdd', 'input_class', sanitize_html_class( $class ) );
	}

	/**
	 * Prepare field type passwd with our custom ID
	 * @author Julien Maury
	 * @return array
	 */
	public static function prepare_field_password( $field ) {

		$class          = apply_filters( 'acf_wp_show_passwd/class/prepare_field', 'acf-wp-show-passwd', $field );
		$field['class'] = sanitize_html_class( $class );
		return $field;
		
	}


	/**
	 * Add necessary markup to show checkbox
	 * @author Julien Maury
	 * @return array
	 */
	public static function render_field_password( $field ) {

		ob_start();
		require_once( ACF_SHOW_PASSWD_DIR . 'views/markup.php' );
		$markup = ob_get_clean();
		echo apply_filters( 'acf_wp_show_passwd/prepare_field/markup', $markup, $field );
		
	}

}
