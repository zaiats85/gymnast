<?php

/**
 * Install Function
 *
 * @package     MDLWP_Portfolio
 * @subpackage  Functions/Install
 * @copyright   Copyright (c) 2015
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Install
 *
 * Runs on plugin install by setting up the post types, custom taxonomies,
 * flushing rewrite rules to initiate the new 'portfolio' slug.
 *
 * @since 1.0.0
 * @return void
 */
function mdlwp_portfolio_install() {

	// Setup the Portfolio Custom Post Type
	mdlwp_portfolio_setup_post_types();

	// Setup the Portfolio Taxonomies
	mdlwp_portfolio_setup_taxonomies();

	// Clear the permalinks
	flush_rewrite_rules( false );
}

register_activation_hook( MDLWP_PORTFOLIO_PLUGIN_FILE, 'mdlwp_portfolio_install' );
