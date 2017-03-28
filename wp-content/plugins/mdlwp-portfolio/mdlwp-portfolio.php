<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://mdlwp.com
 * @since             1.0.0
 * @package           MDLWP_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       MDLWP Portfolio
 * Plugin URI:        http://mdlwp.com/mdlwp-portfolio-uri/
 * Description:       Custom layout plugin
 * Version:           1.0.0
 * Author:            Brad Williams
 * Author URI:        http://braginteractive.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mdlwp-portfolio
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

final class MDLWP_Portfolio {

	/**
	 * @var MDLWP_Portfolio.
	 * @since 1.4
	 */
	private static $instance;


	/**
	 * Main MDLWP_Portfolio Instance
	 *
	 * Insures that only one instance of MDLWP_Portfolio exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.4
	 * @static
	 * @staticvar array $instance
	 * @uses MDLWP_Portfolio::setup_constants() Setup the constants needed
	 * @uses MDLWP_Portfolio::includes() Include the required files
	 * @uses MDLWP_Portfolio::load_textdomain() load the language files
	 * @see MDLWP_Portfolio()
	 * @return The one true MDLWP_Portfolio
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof MDLWP_Portfolio ) ) {
			self::$instance = new MDLWP_Portfolio;
			self::$instance->setup_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version
		if ( ! defined( 'MDLWP_PORTFOLIO_VERSION' ) ) {
			define( 'MDLWP_PORTFOLIO_VERSION', '1.0.0' );
		}

		// Plugin Folder Path
		if ( ! defined( 'MDLWP_PORTFOLIO_PLUGIN_DIR' ) ) {
			define( 'MDLWP_PORTFOLIO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL
		if ( ! defined( 'MDLWP_PORTFOLIO_PLUGIN_URL' ) ) {
			define( 'MDLWP_PORTFOLIO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'MDLWP_PORTFOLIO_PLUGIN_FILE' ) ) {
			define( 'MDLWP_PORTFOLIO_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files
	 *
	 * @access private
	 * @since 1.0.0
	 * @return void
	 */
	private function includes() {

		require_once MDLWP_PORTFOLIO_PLUGIN_DIR . 'includes/scripts.php';
		require_once MDLWP_PORTFOLIO_PLUGIN_DIR . 'includes/meta-box.php';
		require_once MDLWP_PORTFOLIO_PLUGIN_DIR . 'includes/customizer.php';
		require_once MDLWP_PORTFOLIO_PLUGIN_DIR . 'includes/post-types.php';
		require_once MDLWP_PORTFOLIO_PLUGIN_DIR . 'includes/install.php';

	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$mdlwp_portfolio_lang_dir = dirname( plugin_basename( MDLWP_PORTFOLIO_PLUGIN_FILE ) ) . '/languages/';
		$mdlwp_portfolio_lang_dir = apply_filters( 'mdlwp_portfolio_languages_directory', $mdlwp_portfolio_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'mdlwp-portfolio' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'mdlwp-portfolio', $locale );

		// Setup paths to current locale file
		$mofile_local  = $mdlwp_portfolio_lang_dir . $mofile;

		if ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/mdlwp-portfolio/languages/ folder
			load_textdomain( 'mdlwp-portfolio', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'mdlwp-portfolio', false, $mdlwp_portfolio_lang_dir );
		}
	}
}


/**
 * The main function responsible for returning the one true MDLWP_Portfolio
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 *
 * @since 1.0.0
 * @return object The one true MDLWP_Portfolio Instance
 */

function MDLWP_Portfolio() {
	return MDLWP_Portfolio::instance();
}

// Get MDLWP_Portfolio Running
MDLWP_Portfolio();
