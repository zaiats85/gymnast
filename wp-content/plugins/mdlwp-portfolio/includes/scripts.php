<?php

/**
 * Load Scripts
 *
 * Enqueues the required scripts.
 *
 * @since 1.0.0
 */
function mdlwp_portfolio_load_scripts() {

	$js_dir = MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/js/';

	wp_enqueue_script( 'mdlwp-portfolio-mixitup', $js_dir . 'jquery.mixitup.min.js', array('jquery'), '2.1.9', true );
	wp_enqueue_script( 'mdlwp-portfolio', $js_dir . 'mdlwp-portfolio.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'mdlwp_portfolio_load_scripts' );

// register our form css
function mdlwp_portfolio_register_css() {
	wp_register_style('mdlwp-portfolio-css',  MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/css/style.min.css', array(), MDLWP_PORTFOLIO_VERSION );
	wp_enqueue_style( 'mdlwp-portfolio-css' );
}
add_action('wp_enqueue_scripts', 'mdlwp_portfolio_register_css');