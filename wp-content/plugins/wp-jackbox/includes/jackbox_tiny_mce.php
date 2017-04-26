<?php

	function jackbox_button() {

		if(current_user_can("edit_posts") && current_user_can("edit_pages")) {

			add_filter("mce_external_plugins", "add_jackbox_button");
			add_filter("mce_buttons", "register_jackbox_button");

		}

	}

	function register_jackbox_button($buttons) {

		array_push($buttons, "jackbox");
		array_push($buttons, "jackbox_remove");

		return $buttons;

	}

	function add_jackbox_button($plugins) {

		$plugins["jackbox"] = plugins_url("wp-jackbox/js/jackbox_tinymce.min.js");

		return $plugins;

	}

	function jackbox_tinymce_code() {

		 $plugins_array["code"] = plugins_url("wp-jackbox/js/tinymce_edit_html_plugin/plugin.min.js");

		 return $plugins_array;

	}

	function jackbox_localize() {

		wp_enqueue_script("jackbox_admin_js", plugins_url("wp-jackbox/js/jackbox_admin.js"));
		wp_localize_script("jackbox_admin_js", "jackboxTranslate", array(

			"jb_btn" => home_url("wp-admin/images/media-button.png"),
			"jb_1" => __("JackBox Options", "jackbox_domain"),
			"jb_2" => __("Required Fields", "jackbox_domain"),
			"jb_3" => __("Group Name", "jackbox_domain"),
			"jb_4" => __("The group name your item belongs to (required for even a single item)", "jackbox_domain"),
			"jb_5" => __("Media URL", "jackbox_domain"),
			"jb_6" => __("The url of the image, video, song or iframe to load", "jackbox_domain"),
			"jb_7" => __("or HTML Content", "jackbox_domain"),
			"jb_8" => __("Enter custom HTML to load inside the lightbox", "jackbox_domain"),
			"jb_9" => __("Optional Fields", "jackbox_domain"),
			"jb_10" => __("Title", "jackbox_domain"),
			"jb_11" => __("Optional title to be shown inside the lightbox (accepts html)", "jackbox_domain"),
			"jb_12" => __("Description", "jackbox_domain"),
			"jb_13" => __("Optional description for item to be shown when the info button is clicked (accepts html)", "jackbox_domain"),
			"jb_14" => __("Optional Width", "jackbox_domain"),
			"jb_15" => __("Overrides the default width (not needed for images)", "jackbox_domain"),
			"jb_16" => __("Optional Height", "jackbox_domain"),
			"jb_17" => __("Overrides the default height (not needed for images)", "jackbox_domain"),
			"jb_18" => __("Scale Media Up", "jackbox_domain"),
			"jb_19" => __("Allow the item&#39;s content to be scaled up on larger screens", "jackbox_domain"),
			"jb_20" => __("Main Thumbnail Hover", "jackbox_domain"),
			"jb_21" => __("Set the default thumbnail hover effect (overrides default)", "jackbox_domain"),
			"jb_22" => __("no hover", "jackbox_domain"),
			"jb_23" => __("black-magnify", "jackbox_domain"),
			"jb_24" => __("black-play", "jackbox_domain"),
			"jb_25" => __("black-document", "jackbox_domain"),
			"jb_26" => __("white-magnify", "jackbox_domain"),
			"jb_27" => __("white-play", "jackbox_domain"),
			"jb_28" => __("white-document", "jackbox_domain"),
			"jb_29" => __("blur-magnify", "jackbox_domain"),
			"jb_30" => __("blur-play", "jackbox_domain"),
			"jb_31" => __("blur-document", "jackbox_domain"),
			"jb_32" => __("Small Thumbnail URL", "jackbox_domain"),
			"jb_33" => __("Optional url for the small thumbnail to be shown inside the lightbox", "jackbox_domain"),
			"jb_34" => __("Small Thumb Tooltip", "jackbox_domain"),
			"jb_35" => __("Set tooltip text for the small thumbnail (leave blank to use the item&#39;s title instead)", "jackbox_domain"),
			"jb_36" => __("Autoplay Video/Audio", "jackbox_domain"),
			"jb_37" => __("Video/Audio autoplay behaviour", "jackbox_domain"),
			"jb_38" => __("Flash Video has Priority", "jackbox_domain"),
			"jb_39" => __("YES for Flash w/ HTML5 fallback, NO for HTML5 w/ Flash fallback", "jackbox_domain"),
			"jb_40" => __("Local Video Poster", "jackbox_domain"),
			"jb_41" => __("Choose a video poster to be shown on mobile for local video", "jackbox_domain"),
			"jb_42" => __("Audio Title", "jackbox_domain"),
			"jb_43" => __("Set the audio title that will be shown in the music player", "jackbox_domain"),
			"jb_44" => __("Is Hidden Item?", "jackbox_domain"),
			"jb_45" => __("Should this item only be shown inside the lightbox?", "jackbox_domain"),
			"jb_46" => __("Submit Changes", "jackbox_domain"),
			"jb_47" => __("Edit Raw HTML", "jackbox_domain"),
			"jb_default" => __("default", "jackbox_domain"),
			"jb_yes" => __("yes", "jackbox_domain"),
			"jb_no" => __("no", "jackbox_domain")

		));

	}

	add_action("init", "jackbox_button");
	add_action("admin_enqueue_scripts", "jackbox_localize");

	global $wp_version;

	if((float)$wp_version >= 3.9) {

		add_filter('mce_external_plugins', 'jackbox_tinymce_code');

	}

?>