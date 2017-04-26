<?php

	/*
	Plugin Name: JackBox
	Plugin URI: http://www.codingjack.com/jackbox_wp/
	Description: Responsive lightbox with real social sharing &nbsp;|&nbsp; <a href="options-general.php?page=jackbox_admin">Edit Settings</a> &nbsp;|&nbsp; <a href="http://www.youtube.com/playlist?list=PLN8tXRxQci2ZFMg7Y1kNiWLDV9YwawlcM&feature=view_all">Watch Videos</a>
	Version: 2.2
	Author: CodingJack
	Author URI: http://www.codingjack.com/
	*/

	$jackbox_options = get_option("jackbox_settings");

	if(!$jackbox_options) {

		$jackbox_options["hover"] = "none";
		$jackbox_options["custom-css"] = "";
		$jackbox_options["click-next"] = "no";
		$jackbox_options["full-scale"] = "yes";
		$jackbox_options["flash-video"] = "no";
		$jackbox_options["use-thumbs"] = "yes";
		$jackbox_options["thumb-width"] = "75";
		$jackbox_options["thumb-height"] = "50";
		$jackbox_options["video-width"] = "958";
		$jackbox_options["video-height"] = "538";
		$jackbox_options["deep-linking"] = "yes";
		$jackbox_options["use-tooltips"] = "yes";
		$jackbox_options["thumbs-hidden"] = "no";
		$jackbox_options["show-scrollbar"] = "no";
		$jackbox_options["autoplay-video"] = "no";
		$jackbox_options["show-description"] = "no";
		$jackbox_options["minified-scripts"] = "yes";
		$jackbox_options["remove-canonical"] = "yes";
		$jackbox_options["keyboard-shortcuts"] = "yes";

		add_option("jackbox_settings", $jackbox_options);

	}
	
	if(!array_key_exists("domain", $jackbox_options)) {
		
		$jackbox_options["domain"] = plugins_url("wp-jackbox/");
		update_option("jackbox_settings", $jackbox_options);
		
	}

	if(!array_key_exists("wordpress-gallery", $jackbox_options)) {

		$jackbox_options["skin"] = "yes";
		$jackbox_options["wordpress-gallery"] = "";
		update_option("jackbox_settings", $jackbox_options);

	}

	if(!array_key_exists("ajax-compatible", $jackbox_options)) {

		$jackbox_options["ajax-compatible"] = "no";
		update_option("jackbox_settings", $jackbox_options);

	}
	
	if(!array_key_exists("social-facebook", $jackbox_options)) {
		
		$jackbox_options["social-google"] = "yes";
		$jackbox_options["social-twitter"] = "yes";
		$jackbox_options["social-facebook"] = "yes";
		$jackbox_options["social-pinterest"] = "yes";
		update_option("jackbox_settings", $jackbox_options);
		
	}
	
	if(!array_key_exists("essential", $jackbox_options)) {
		
		$jackbox_options["essential"] = "no";
		update_option("jackbox_settings", $jackbox_options);
		
	}

	function jackbox_admin_link($links) {
		
		array_unshift($links, '<a href="' . get_admin_url() . 'options-general.php?page=jackbox_admin">Admin</a>');

		return $links;

	}

	function deactivate_jackbox() {
		
		global $jackbox_options;
		unset($jackbox_options["domain"]);
		update_option("jackbox_settings", $jackbox_options);
		
		// uncomment line below to delete JackBox settings from WP database upon deactivation
		// delete_option("jackbox_settings");

	}

	if(!is_admin()) {

		include("includes/noerror.php");
		include("includes/jackbox_scripts.php");

	}

	else {

		include("includes/jackbox_tiny_mce.php");
		include("includes/jackbox_admin.php");
		include_once(ABSPATH . "wp-admin/includes/plugin.php");

		if(is_plugin_active("wp-jackbox/wp-jackbox.php")) {

			add_filter("plugin_action_links_" . plugin_basename(__FILE__), "jackbox_admin_link");

		}

		register_deactivation_hook( __FILE__, "deactivate_jackbox");

	}

?>