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

	wp_enqueue_script( 'mdlwp-portfolio-mixitup', $js_dir . 'mixitup.min.js', array('jquery'), 'false', false );
	wp_enqueue_script( 'mdlwp-portfolio-mixitup', $js_dir . 'mixitup-multifilter.js', array('jquery'), 'false', false );
	wp_enqueue_script( 'mdlwp-portfolio-mixitup', $js_dir . 'mixitup-pagination.js', array('jquery'), 'false', false );
	wp_enqueue_script( 'mdlwp-portfolio', $js_dir . 'mdlwp-portfolio.js', array('jquery'), '1.0.0', false );

}
add_action( 'wp_enqueue_scripts', 'mdlwp_portfolio_load_scripts' );

// register our form css
function mdlwp_portfolio_register_css() {
//	wp_register_style('mdlwp-portfolio-css',  MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/css/style.min.css', array(), MDLWP_PORTFOLIO_VERSION );
	wp_register_style('mdlwp-portfolio-css',  MDLWP_PORTFOLIO_PLUGIN_URL . 'includes/css/style.css', array(), MDLWP_PORTFOLIO_VERSION );
	wp_enqueue_style( 'mdlwp-portfolio-css' );
}
add_action('wp_enqueue_scripts', 'mdlwp_portfolio_register_css');