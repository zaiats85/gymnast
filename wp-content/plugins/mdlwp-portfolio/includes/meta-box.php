<?php

function mdlwp_portfolio_add_meta_box($screens) {	
 	// Add portfolio custom post type to the $screens array
	$add_portfolio = array(
		'portfolio',
	);
 
	// combine the two arrays
	$screens = array_merge($add_portfolio, $screens);
 
	return $screens;
}
add_filter('mdlwp_include_metabox_post_types', 'mdlwp_portfolio_add_meta_box');