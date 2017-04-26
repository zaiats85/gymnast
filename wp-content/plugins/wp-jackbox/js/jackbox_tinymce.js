;(function($) {

	var itm,
		win,
		cats,
		node,
		func,
		path,
		form,
		hover,
		cover,
		modal,
		media,
		multi,
		titles,
		extras,
		editor,
		inputs,
		poster,
		autoNo,
		header,
		legacy,
		rawDesc,
		checker,
		content,
		grouped,
		itmType,
		flashNo,
		scaleNo,
		autoYes,
		autoDef,
		manager,
		htmlAud,
		htmlVid,
		editRaw,
		category,
		scaleYes,
		scaleDef,
		flashYes,
		flashDef,
		htmlTiny,
		tinyHtml,
		tinyDesc,
		hiddenNo,
		hiddenYes,
		isChecked,
		selection,
		thumbnail,
		textareas,
		htmlFrame,
		buttonAdd,
		legacyTiny,
		mediaHolder,
		thumbHolder,
		buttonRemove,
		posterHolder,
		tinyChecked = 0,
		keyNumbers = /[^0-9\.|#|-]/g,
		matches = /none|black-magnify|black-play|black-document|white-magnify|white-play|white-document|blur-magnify|blur-play|blur-document/g,

		datas = [

			"href", 
			"data-jbgroup", 
			"data-jbhref", 
			"data-jbtitle", 
			"data-jbdescription", 
			"data-jbwidth", 
			"data-jbheight", 
			"data-jbthumbnail", 
			"data-jbthumbtooltip", 
			"data-jbhover", 
			"data-jbscaleup", 
			"data-jbautoplay", 
			"data-jbflashhaspriority", 
			"data-jbposter", 
			"data-jbaudiotitle",
			"data-jbhiddenitem",
			"data-jbhtml"

		],

		container = '<div class="jackbox-modal">' +

			'<div class="jackbox-cover">' +
			
				'<div class="jackbox-container">' +
				
					'<span class="jackbox-close button">x</span>' +
					
					'<div class="jackbox-content">' + 
					
						'<h2>' + jackboxTranslate["jb_1"] + '</h2><hr />' +
						
						'<form class="jackbox-form" method="post" enctype="text/plain">' +
						
							'<h3>' + jackboxTranslate["jb_2"] + '</h3><hr />' +
							
							'<p class="jb-category">' + jackboxTranslate["jb_3"] +
							
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_4"] + '">?</span>' +
								'<br /><input class="jackbox-medium" name="data-jbgroup" type="text" />' +
								
							'</p>' +
							
							'<p class="jb-extras"></p>' +
							
							'<hr /><p><span class="jb-multimedia">' + jackboxTranslate["jb_5"] +
							
								' <img class="jackbox-addmedia" src="' + jackboxTranslate["jb_btn"] + '" /> ' +
								'<span class="jackbox-question" data-title="' + jackboxTranslate["jb_6"] + '">?</span></span>' +
								'<span class="jackbox-edit-raw button">' + jackboxTranslate["jb_47"] + '</span>' +
								'<span class="jb-inline">' + jackboxTranslate["jb_7"] +
								'<span class="jackbox-question jb-q1" data-title="' + jackboxTranslate["jb_8"] + '">?</span>' +
								'<input type="checkbox" name="data-jbcontent" /></span>' +
								'<input name="data-jbhref" type="text" />' +
								'<textarea id="jb-tiny-html" name="data-jbhtml"></textarea>' +
								'<span class="jb-media jb-media-holder"></span>' +
							'</p>' +
							
							'<hr /><h3>' + jackboxTranslate["jb_9"] + '</h3><hr />' +
							'<p>' + jackboxTranslate["jb_10"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_11"] + '">?</span>' +
								'<br /><input class="jackbox-medium" name="data-jbtitle" type="text" />' +
							'</p>' +
							
							'<hr /><p><span class="jackbox-edit-raw-desc button">' + jackboxTranslate["jb_47"] + '</span>' + jackboxTranslate["jb_12"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_13"] + '">?</span>' +
								'<br /><textarea id="jb-tiny-desc" name="data-jbdescription"></textarea>' +
							'</p>' +
							
							'<hr /><div>' +
								'<p>' + jackboxTranslate["jb_14"] +
									' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_15"] + '">?</span>' +
									'<br /><input class="jackbox-small" name="data-jbwidth" type="text" />' +
								'</p>' +
								'<p>' + jackboxTranslate["jb_16"] +
									' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_17"] + '">?</span>' +
									'<br /><input class="jackbox-small" name="data-jbheight" type="text" />' +
								'</p>' + 
							'</div>' + 
							
							'<hr /><p>' + jackboxTranslate["jb_18"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_19"] + '">?</span>' +
								'<br /><span class="jackbox-box">' +
								'<input class="jackbox-scale-yes" name="data-jbscaleup" type="radio" value="true" /> ' +  jackboxTranslate["jb_yes"] +
								' <input class="jackbox-scale-no" name="data-jbscaleup" type="radio" value="false" /> ' +  jackboxTranslate["jb_no"] +
								' <input class="jackbox-scale-default" name="data-jbscaleup" type="radio" value="default" /> ' +  jackboxTranslate["jb_default"] + '</span>' +
							'</p>' + 

							'<hr /><p>' + jackboxTranslate["jb_20"] + ' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_21"] + '">?</span><br />' + 
								'<select name="data-jbhover">' +
									'<option value="default" selected>' + jackboxTranslate["jb_default"] + '</option>' +
									'<option value="none">' + jackboxTranslate["jb_22"] + '</option>' +
									'<option value="black-magnify">' + jackboxTranslate["jb_23"] + '</option>' +
									'<option value="black-play">' + jackboxTranslate["jb_24"] + '</option>' +
									'<option value="black-document">' + jackboxTranslate["jb_25"] + '</option>' +
									'<option value="white-magnify">' + jackboxTranslate["jb_26"] + '</option>' +
									'<option value="white-play">' + jackboxTranslate["jb_27"] + '</option>' +
									'<option value="white-document">' + jackboxTranslate["jb_28"] + '</option>' +
									'<option value="blur-magnify">' + jackboxTranslate["jb_29"] + '</option>' +
									'<option value="blur-play">' + jackboxTranslate["jb_30"] + '</option>' +
									'<option value="blur-document">' + jackboxTranslate["jb_31"] + '</option>' +
								'</select>' +
							'</p>' +
							
							'<hr /><p>' + jackboxTranslate["jb_32"] +
								' <img class="jackbox-addmedia" src="' + jackboxTranslate["jb_btn"] + '" />' +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_33"] + '">?</span>' +
								'<br /><input name="data-jbthumbnail" type="text" />' +
								'<br /><span class="jb-media jb-thumb-holder"></span>' +
							'</p>' +
							
							'<hr /><p>' + jackboxTranslate["jb_34"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_35"] + '">?</span>' +
								'<br /><input class="jackbox-medium" name="data-jbthumbtooltip" type="text" />' +
							'</p>' + 
							
							'<hr /><div>' +
								'<p>' + jackboxTranslate["jb_36"] +
									' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_37"] + '">?</span>' +
									'<br /><span class="jackbox-box">' +
									'<input class="jackbox-autoplay-yes" name="data-jbautoplay" type="radio" value="true" /> ' + jackboxTranslate["jb_yes"] +
									' <input class="jackbox-autoplay-no" name="data-jbautoplay" type="radio" value="false" /> ' + jackboxTranslate["jb_no"] +
									' <input class="jackbox-autoplay-default" name="data-jbautoplay" type="radio" value="default" /> ' + jackboxTranslate["jb_default"] + '</span>' +
								'</p>' + 
								'<p>' + jackboxTranslate["jb_38"] +
									' <span class="jackbox-question jb-q1" data-title="' + jackboxTranslate["jb_39"] + '">?</span>' +
									'<br /><span class="jackbox-box">' +
									'<input class="jackbox-flash-yes" name="data-jbflashhaspriority" type="radio" value="false" /> ' + jackboxTranslate["jb_yes"] +
									' <input class="jackbox-flash-no" name="data-jbflashhaspriority" type="radio" value="true" /> ' + jackboxTranslate["jb_no"] +
									' <input class="jackbox-flash-default" name="data-jbflashhaspriority" type="radio" value="default" /> ' + jackboxTranslate["jb_default"] + 
								'</p>' + 
							'</div>' +
							
							'<hr /><p>' + jackboxTranslate["jb_40"] +
								' <img class="jackbox-addmedia" src="' + jackboxTranslate["jb_btn"] + '" /> ' +
								'<span class="jackbox-question" data-title="' + jackboxTranslate["jb_41"] + '">?</span>' +
								'<br /><input name="data-jbposter" type="text" />' +
								'<br /><span class="jb-media jb-poster-holder"></span>' +
							'</p>' +
							
							'<hr /><p>' + jackboxTranslate["jb_42"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_43"] + '">?</span>' +
								'<br /><input class="jackbox-medium" name="data-jbaudiotitle" type="text" />' +
							'</p>' + 
							
							'<hr /><p>' + jackboxTranslate["jb_44"] +
								' <span class="jackbox-question" data-title="' + jackboxTranslate["jb_45"] + '">?</span>' +
								'<br /><span class="jackbox-box">' +
								'<input class="jackbox-hidden-yes" name="data-jbhiddenitem" type="radio" value="false" /> ' + jackboxTranslate["jb_yes"] +
								' <input class="jackbox-hidden-no" name="data-jbhiddenitem" type="radio" value="true" /> ' + jackboxTranslate["jb_no"] + '</span>' +
							'</p>' + 
							
							'<hr /><p class="submit_jb"><input type="submit" class="button-primary" value="' + jackboxTranslate["jb_46"] + '" /></p>' +
							
						'</form>' +
						
					'</div>' +
					
				'</div>' +
				
			'</div>' +
			
		'</div>';

	function startIt(ed, url) {
		
		editor = ed;
		path = url + "/";
		legacyTiny = 'getInstanceById' in tinyMCE;
		
		var checkOne, checkTwo, called,
		objOne = {title: "Add/Edit JackBox", image: path + "../img/jackbox.png", onclick: openModal},
		objTwo = {title: "Remove JackBox", image: path + "../img/jackbox_remove.png", onclick: removeJackbox};
		
		if(!legacyTiny) {
			
			objOne.onPostRender = function() {
				
				buttonAdd = this;
				checkOne = true;
				
				if(checkTwo && !called) {
					
					called = true;	
					ready();
					
				}
				
			}
			
			objTwo.onPostRender = function() {
				
				buttonRemove = this;
				checkTwo = true;
				
				if(checkOne && !called) {
					
					called = true;	
					ready();
					
				}
				
			}
			
		}
		
		editor.addButton("jackbox", objOne);
		editor.addButton("jackbox_remove", objTwo);
		
		if(legacyTiny) ready(true);

	}
	
	function ready(legacy) {
	
		checkTiny();
		
		if(!legacy) {
			
			editor.on('NodeChange', checkNode);
				
		}
		else {
			
			editor.onNodeChange.add(checkNode);
			
		}
		
	}

	function checkTiny() {

		var iframe = $("#content_ifr");

		if(!iframe.length) {

			tinyChecked++;	
			if(tinyChecked < 25) setTimeout(checkTiny, 50);
			return;

		}

		iframe.one("load.jackbox", tinyLoaded);

	}

	function tinyLoaded() {

		var iframe = $(this);
		iframe = iframe.contents();

		if(!iframe.length) return;
		iframe = iframe.find("head");

		if(!iframe.length) return;
		$("<style />").html("a.jackbox, a.jackbox:visited {background-color: #e5e5e5} .jackbox img {padding: 6px; margin: 0; background-color: #e5e5e5}").appendTo(iframe);

	}

	function checkNode(ed, cm, e) {
		
		if(!legacyTiny) {
			
			ed = ed.target;
			e = ed.selection.getNode();
			cm = ed.controlManager;
			
		}
		
		var $this = $(e), nodeName = e.nodeName.toLowerCase();
		manager = cm;
		
		if(nodeName === "a" || nodeName === "img") {
			
			if(!legacyTiny) {
				
				buttonAdd.disabled(false);
				
			}
			else {
			
				cm.setDisabled("jackbox", false);
				
			}
			
			if(nodeName === "img") $this = $this.closest("a");

		}
		else {
			
			if(!legacyTiny) {
				
				buttonAdd.disabled(true);
				
			}
			else {
			
				cm.setDisabled("jackbox", true);
				
			}

		}

		if(!$this.attr("class")) {
			
			if(!legacyTiny) {
				
				buttonRemove.disabled(true);
				
			}
			else {
			
				cm.setDisabled("jackbox_remove", true);
				
			}
			
			return;

		}

		if($this.attr("class").search("jackbox") !== -1) {
			
			if(!legacyTiny) {
				
				buttonRemove.disabled(false);
				
			}
			else {
			
				cm.setDisabled("jackbox_remove", false);
				
			}

		}
		else {
			
			if(!legacyTiny) {
				
				buttonRemove.disabled(true);
				
			}
			else {
			
				cm.setDisabled("jackbox_remove", true);
				
			}

		}

	}

	function addModal() {

		modal = $(container).appendTo($("body"));
		if(!legacyTiny) modal.addClass('jb-modern-tiny');
		
		cover = $(".jackbox-cover").click(closeModal);
		form = $(cover.find("form")).submit(submitData);
		textareas = form.find("input[type=text], textarea");
		inputs = form.find("input[type=text], input[type=radio], textarea, select");

		win = $(window);
		extras = form.find(".jb-extras");
		category = form.find(".jb-category");
		hover = form.find("select[name=data-jbhover]");
		
		header = cover.find("h2")[0];
		multi = form.find(".jb-multimedia");
		titles = form.find("input[name=data-jbtitle]");
		content = form.find("textarea[name=data-jbhtml]");
		mediaHolder = form.find(".jb-media-holder").hide();
		thumbHolder = form.find(".jb-thumb-holder").hide();
		posterHolder = form.find(".jb-poster-holder").hide();
		container = $(".jackbox-container").click(stopBubble);
		rawDesc = $(".jackbox-edit-raw-desc").click(openRawDesc);
		editRaw = $(".jackbox-edit-raw").click(openRawHtml).hide();
		checker = $(".jb-inline").children("input").change(toggleContent);
		grouped = form.find("input[name=data-jbgroup]").keyup(checkGroup);
		poster = form.find("input[name=data-jbposter]").focusin(inFocus).focusout(outFocus);
		media = form.find("input[name=data-jbhref]").data("jbType", 1).focusin(inFocus).focusout(outFocus);
		thumbnail = form.find("input[name=data-jbthumbnail]").data("jbType", 2).focusin(inFocus).focusout(outFocus);

		htmlAud = !!document.createElement("video").canPlayType;
		htmlVid = navigator.userAgent.toLowerCase().search("msie") === -1 && !!document.createElement("video").canPlayType;
		cats = [];

		$(".jackbox-addmedia").click(showUploader);
		$(".jackbox-close").click(closeModal);
		$(".jackbox-small").keyup(checkKey);

		scaleNo = form.find(".jackbox-scale-no");
		scaleYes = form.find(".jackbox-scale-yes");
		scaleDef = form.find(".jackbox-scale-default");

		autoNo = form.find(".jackbox-autoplay-no");
		autoYes = form.find(".jackbox-autoplay-yes");
		autoDef = form.find(".jackbox-autoplay-default");

		flashNo = form.find(".jackbox-flash-no");
		flashYes = form.find(".jackbox-flash-yes");
		flashDef = form.find(".jackbox-flash-default");

		hiddenYes = form.find(".jackbox-hidden-yes");
		hiddenNo = form.find(".jackbox-hidden-no");
		
		if(!legacyTiny) {
			
			tinyDesc = new tinyMCE.Editor("jb-tiny-desc", {plugins: "code"}, tinyMCE.EditorManager);
			tinyHtml = new tinyMCE.Editor("jb-tiny-html", {plugins: "code"}, tinyMCE.EditorManager);
			
			tinyDesc.render();
			tinyHtml.render();
			
		}
		else {
			
			tinyMCE.execCommand("mceAddControl", false, "jb-tiny-desc");
			tinyMCE.execCommand("mceAddControl", false, "jb-tiny-html");
			
			tinyDesc = tinyMCE.getInstanceById("jb-tiny-desc");
			tinyHtml = tinyMCE.getInstanceById("jb-tiny-html");
			
		}

		$("#jb-tiny-desc_ifr").css("background-color", "#FFF");
		htmlFrame = $("#jb-tiny-html_ifr").css({backgroundColor: "#FFF", height: 215}).hide();
		
		if(!legacyTiny) {
			
			rawDesc.parent().find('.mce-tinymce').css({display: "block", top: 12, clear: 'both'}).find(".mce_jackbox, .mce_jackbox_remove").remove();
			htmlTiny = checker.parent().parent().find('.mce-tinymce');
			
		}
		else {
			
			$("#jb-tiny-desc_parent").css({display: "block", top: 12, clear: 'both'}).find(".mce_jackbox, .mce_jackbox_remove").remove();
			htmlTiny = $("#jb-tiny-html_parent");
			
		}
		
		htmlTiny.css({display: "block", top: 12, clear: "both"}).hide().find(".mce_jackbox, .mce_jackbox_remove").remove();

		if(!Array.prototype.indexOf) Array.prototype.indexOf = getIndex;
		if(typeof legacy === 'undefined') {
		
			legacy = !(wp && wp.media && wp.media.editor && wp.media.editor.send && wp.media.editor.send.attachment);
			
		}

	}
	
	function openRawHtml() {
		
		tinyHtml.execCommand("mceCodeEditor");
		
	}
	
	function openRawDesc() {
		
		tinyDesc.execCommand("mceCodeEditor");
		
	}

	function openModal() {

		if(!modal) addModal();
		
		if(!legacy) {
			
			func = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = updateMedia;
			
		}
		else {
		
			func = window.send_to_editor;
			window.send_to_editor = updateMedia;
			
		}
		
		if(!legacyTiny) {
			
			editor = tinyMCE.get("content");
			
		}
		else {
		
			editor = tinyMCE.getInstanceById("content");
			
		}
		
		selection = editor.selection;
		
		if(!legacyTiny) {
			
			buttonAdd.disabled(true);
			buttonRemove.disabled(true);
			
		}
		else {
			
			manager = editor.controlManager;
			manager.setDisabled("jackbox", true);
			manager.setDisabled("jackbox_remove", true);
			
		}

		var el = selection.select(selection.getNode()), at, i, im;
		node = $(el);

		if(node.is("img")) {

			var nde = node.closest("a");
			if(nde.is("a")) node = nde;
			im = true;

		}

		autoDef.attr("checked", "checked");
		scaleDef.attr("checked", "checked");
		flashDef.attr("checked", "checked");
		hiddenNo.attr("checked", "checked");
		
		hover[0].selectedIndex = 0;
		
		try {
			tinyDesc.setContent("");
		}
		catch(e){};

		$("#wp_editbtns").hide();

		if(node.is("a")) {

			if(node.hasClass("jackbox")) {

				i = datas.length;

				while(i--) {

					at = datas[i];
					if(node.attr(at)) checkAttribute(at, node.attr(at)); 

				}

			}
			else {

				var lnk = node.attr("href");

				if(lnk) {

					media.val(lnk);
					loadMedia(lnk, mediaHolder);

				}

				if(node.attr("title")) titles.val(node.attr("title"));

			}
			
			var ims = node.children("img");
			if(ims.length && ims.attr("alt")) titles.val(ims.attr("alt"));

		}
		else if(!im) {

			im = node.children("img");

			if(im.length && im.attr("alt")) {

				titles.val(im.attr("alt"));
				node = im;	

			}

		}
		else if(im) {
			
			if(node.attr("alt")) titles.val(node.attr("alt"));

		}

		var st = editor.getContent({format: "raw"}), 
		ar = st.match(/data-jbgroup="/g),
		leg = ar ? ar.length : 0,
		start,
		end,
		str;

		for(i = 0; i < leg; i++) {

			start = st.indexOf('data-jbgroup="');
			end = start + 15;

			while(st.charAt(end) !== '"') end++;
			str = st.substring(start + 14, end);

			if(cats.indexOf(unescape(str)) === -1) cats[cats.length] = unescape(str);
			st = st.substr(end, st.length);

		}

		if(cats.length) {

			leg = cats.length;
			ar = {type: "checkbox"};

			for(i = 0; i < leg; i++) {
			
				st = unescape(cats[i]);
				ar.name = "jb-" + st.split(" ").join("-");

				$("<input />").attr(ar).change(checked).appendTo(extras);
				$("<span />").text(" " + st).appendTo(extras);
				$("<br />").appendTo(extras);

			}

			extras.show();
			category.addClass("jb-noborder");

			if(grouped.val()) {
				
				i = cats.indexOf(grouped.val());
				if(i !== -1) extras.children("input[name=jb-" + unescape(cats[i]).split(" ").join("-") + "]").attr("checked", "checked");

			}
			else {
				
				grouped.val(unescape(cats[0]));
				extras.children("input[name=jb-" + unescape(cats[0]).split(" ").join("-") + "]").attr("checked", "checked");

			}

		}

		modal.stop(true, true).fadeIn(300);
		container.scrollTop(0);
		selection.collapse();

	}

	function checked() {

		if(this.checked) {

			var children = extras.children("input"), 
			i = children.length,
			child;

			while(i--) {

				child = $(children[i]);

				if(child[0] !== this) {

					child.removeAttr("checked");

				}
				else {

					child.attr("checked", "checked");
					
					var txt = child.next().text();
					grouped.val(txt.substring(1, txt.length));

				}

			}

		}
		else {

			grouped.val("");

		}

	}

	function checkGroup() {

		var i = cats.indexOf(this.value);
		
		if(i === -1) {

			extras.children("input").each(removeCheck);

		}
		else {

			extras.children("input[name=jb-" + cats[i].split(" ").join("-") + "]").attr("checked", "checked");

		}

	}

	function removeCheck() {

		$(this).removeAttr("checked");

	}

	function checkAttribute(name, value) {

		var itm, namer;

		if(name.search("data-jb") !== -1) {

			namer = name.split("data-jb")[1];

			switch(namer) {

				case "title":
					
					form.find("input[name=" + name + "]").val(unescape(value));
					return;

				break;

				case "description":

					tinyDesc.setContent(unescape(value));
					return;

				break;

				case "hover":

					itm = form.find("select[name=" + name + "]");

				break;

				case "html":

					checker[0].checked = true;
					checker.trigger("change");
					tinyHtml.setContent(unescape(value));
					return;

				break;

				default:

					itm = form.find("input[name=" + name + "]");

				// end default

			}

			if(!itm.length) return;
			if(itm.attr("type") !== "radio") {

				switch(namer) {

					case "thumbnail":

						itm.val(value);
						loadMedia(value, thumbHolder);

					break;

					case "hover":

						var matched = value.match(matches);
						if(matched) hover[0].selectedIndex = hover.find("option[value=" + matched + "]").index();

					break;

					case "poster":

						itm.val(value);
						loadMedia(value, posterHolder);

					break;
					
					case "group":
					
						itm.val(unescape(value));
					
					break;

					default:

						itm.val(value);

					// end default

				}

				return;

			}

			switch(namer) {

				case "scaleup":

					if(value === "no") {

						scaleYes.removeAttr("checked");
						scaleDef.removeAttr("checked");
						scaleNo.attr("checked", "checked");

					}
					else if(value === "yes") {

						scaleNo.removeAttr("checked");
						scaleDef.removeAttr("checked");
						scaleYes.attr("checked", "checked");

					}

				break;

				case "autoplay":

					if(value === "no") {

						autoYes.removeAttr("checked");
						autoDef.removeAttr("checked");
						autoNo.attr("checked", "checked");

					}
					else if(value === "yes") {

						autoNo.removeAttr("checked");
						autoDef.removeAttr("checked");
						autoYes.attr("checked", "checked");

					}

				break;

				case "hiddenitem":

					if(value === "no") {

						hiddenYes.removeAttr("checked");
						hiddenNo.attr("checked", "checked");

					}
					else if(value === "yes") {

						hiddenNo.removeAttr("checked");
						hiddenYes.attr("checked", "checked");

					}

				break;

				case "flashhaspriority":

					if(value === "no") {

						flashYes.removeAttr("checked");
						flashDef.removeAttr("checked");
						flashNo.attr("checked", "checked");

					}
					else if(value === "yes") {

						flashNo.removeAttr("checked");
						flashDef.removeAttr("checked");
						flashYes.attr("checked", "checked");

					}

				break;

			}

		}
		else if(name === "href") {

			media.val(value);
			loadMedia(value, mediaHolder);

		}

	}

	function submitData(event) {

		event.preventDefault();
		if(!window.confirm("Submit Changes?")) return;

		var passed = true;
		isChecked = checker[0].checked;

		if(!grouped.val()) {

			grouped.addClass("jb-error").one("focusin", removeError);
			passed = false;

		}

		if(!isChecked) {

			var val = media.val();

			if(!val || val === "#") {

				media.addClass("jb-error").one("focusin", removeError);
				passed = false;

			}

		}
		else if(!tinyHtml.getContent()) {

			htmlFrame.addClass("jb-error").one("click", removeError);
			passed = false;

		}

		if(!passed) {

			header.scrollIntoView();	
			return;

		}

		itm = $("<a />");
		if(node.attr("class")) itm.attr("class", node.attr("class"));
		itm.removeClass("jackbox-hidden-item").addClass("jackbox");

		if(node.is("a")) {
			
			var im = node.children("img");
			
			if(im.length) {
			
				im.unwrap();
				itm.append(im);
				
			}
			else {
			
				itm.html(node.html());
				selection.select(node[0]);
				
			}
				
		}
		else {
			
			itm.append(node);
			
		}
		
		inputs.each(writeAttributes);
		
		selection.setNode(itm[0]);
		closeModal();

	}

	function writeAttributes() {

		var $this = $(this), attr = $this.attr("name"), type = $this.attr("type"),
		value = $this.val(), namer = attr.split("data-jb")[1];

		if(namer === "href") {

			if(isChecked || !value) value = "#";
			itm.attr("href", value);
			return;			

		}
		else {

			var des = namer === "description", htm = namer === "html";

			if(des || htm) {

				if(des) {

					value = tinyDesc.getContent();

				}
				else {
					
					if(isChecked) {
						value = tinyHtml.getContent();
					}
					else {
						return;
					}

				}


				if(value) itm.attr(attr, escape(value));
				return;

			}

		}

		if(!value || type === "checkbox") return;
		if(type !== "radio") {

			if(namer === "hover" && value === "default") return;
			if(namer === "title" || namer === "group") value = escape(value);

			itm.attr(attr, value);
			return;

		}

		if(!$this.attr("checked")) return;
		var cl = $this.attr("class").split("jackbox-").join("");

		switch(namer) {

			case "scaleup":

				if(cl === "scale-yes") {

					itm.attr(attr, "yes");

				}
				else if(cl === "scale-no") {

					itm.attr(attr, "no");			

				}
				else {

					itm.removeAttr(attr);

				}

			break;

			case "autoplay":

				if(cl === "autoplay-yes") {

					itm.attr(attr, "yes");

				}
				else if(cl === "autoplay-no") {

					itm.attr(attr, "no");			

				}
				else {

					itm.removeAttr(attr);
					
				}

			break;

			case "hiddenitem":

				if(cl === "hidden-yes") {

					itm.attr(attr, "yes");
					itm.addClass("jackbox-hidden-item");

				}

			break;

			case "flashhaspriority":

				if(cl === "flash-yes") {

					itm.attr(attr, "yes");

				}
				else if(cl === "flash-no") {

					itm.attr(attr, "no");			

				}
				else {

					itm.removeAttr(attr);

				}

			break;

		}

	}

	function closeModal(event) {

		if(event && !window.confirm("Exit without Saving?")) return;

		modal.stop(true, true).fadeOut(300);
		form.find("input[type=text], textarea").val("");
		category.removeClass("jb-noborder");

		cats = [];
		isChecked = false;
		extras.empty().hide();
		mediaHolder.empty().hide();
		thumbHolder.empty().hide();
		posterHolder.empty().hide();

		poster.removeData("jborig");
		checker.removeAttr("checked");
		thumbnail.removeData("jborig");
		grouped.removeClass("jb-error");
		multi.removeClass("jb-loading");
		checker.removeData("jbhasmedia");
		media.removeData("jborig").removeClass("jb-error").show();

		htmlFrame.removeClass("jb-error").hide();
		tinyDesc.setContent("");
		tinyHtml.setContent("");
		htmlTiny.hide();
		multi.show();

		if(!legacy) {
			
			wp.media.editor.send.attachment = func;
			
		}
		else {
		
			window.send_to_editor = func;
			
		}

		win.scrollTop(0);

	}

	function stopBubble(event) {

		event.stopImmediatePropagation();

	}

	function showUploader() {

		var $this = $(this), itm;
		
		if(!$this.hasClass("jackbox-addmedia") && $this.is("img")) {
			
			$this = $this.parent().parent().find(".jackbox-addmedia");
			
		}
		
		itm = $this.parent();
		if(itm.hasClass("jb-multimedia")) itm = itm.parent();

		itmType = itm.find("input[type=text]").data("jbType");
		
		if(!legacy) {
			
			wp.media.editor.open($this);	
			$(".media-menu").children(":eq(1)").hide();
		
		}
		else {
			
			tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
			
		}

	}

	function updateMedia(html, attachment) {
	
		var url, holder;
		
		if(!legacy) {
		
			url = attachment.url;
			
		}
		else {
			
			url = $(html);
			url = url.attr("src") || url.attr("href");
			
			tb_remove();
			
		}
		
		switch(itmType) {

			case 1:

				input = media;
				holder = mediaHolder;

			break;

			case 2:

				input = thumbnail;
				holder = thumbHolder;

			break;

			default:

				input = poster;
				holder = posterHolder;

			// end default

		}

		input.val(url);
		loadMedia(url, holder);
		
	}

	function inFocus() {

		var $this = $(this), value = $this.val();
		
		if(!value) return;
		
		$this.data("jborig", value);

	}	

	function outFocus() {

		var $this = $(this), value = $this.val();

		if(value === $this.data("jborig")) return;

		loadMedia(value, $(this).parent().children(".jb-media"));

	}

	function loadMedia(url, holder) {

		var file = getType(url);
		holder.empty().hide();

		if(!file) return;
		var el;

		if(file !== "vimeo") {

			if(file.search("mp4") !== -1) {

				if(htmlVid) {

					el = $("<video />").attr("controls", "controls").appendTo(holder.show());
					$("<source />").attr({type: "video/webm", src: file.split("mp4").join("webm")}).appendTo(el);
					$("<source />").attr({type: "video/mp4", src: file}).appendTo(el);

				}
				else {

					el = $("<img />").one("load.jackbox", mediaLoaded).appendTo(holder);
					el.attr("src", path + "../img/video.jpg");

				}

			}
			else if(file.search("mp3") !== -1) {

				if(htmlAud) {

					el = $("<audio />").attr("controls", "controls").appendTo(holder.show());
					$("<source />").attr({type: "audio/ogg", src: file.split("mp3").join("ogg")}).appendTo(el);
					$("<source />").attr({type: "audio/mpeg", src: file}).appendTo(el);

				}
				else {

					el = $("<img />").one("load.jackbox", mediaLoaded).appendTo(holder);
					el.attr("src", path + "../img/audio.jpg");

				}

			}
			else {

				multi.addClass("jb-loading");
				el = $("<img />").one("load.jackbox", mediaLoaded).one("error.jackbox", mediaError).appendTo(holder);
				el.attr("src", file);

			}

		}
		else {

			el = $("<img />").one("load.jackbox", mediaLoaded).appendTo(holder);

			$.getJSON("http://vimeo.com/api/v2/video/" + url.split("https").join("http").split("http://vimeo.com/")[1] + ".json?callback=?", {format: "json"}, function(data) {

				el.attr("src", data[0].thumbnail_small);

			});

		}

	}

	function mediaError() {

		multi.removeClass("jb-loading");
		$(this).unbind("load.jackbox");

	}
	
	function getType(url) {

		if(url.search("youtube") !== -1) {

			return "http://img.youtube.com/vi/" + url.split("http://www.youtube.com/watch?v=")[1] + "/1.jpg";

		}
		else if(url.search("vimeo") !== -1) {

			return "vimeo";

		}
		else {

			var spliced = url.split(".");
			if(!spliced.length) return null;

			spliced = spliced[spliced.length - 1];

			if(spliced === "jpg" || spliced === "png" || spliced === "gif" || spliced === "mp4" || spliced === "mp3") {

				return url;

			}
			else {

				return null;

			}

		}

	}

	function mediaLoaded() {

		var $this = $(this).unbind("error.jackbox");
		multi.removeClass("jb-loading");
		$this.parent().show();

		var w = this.width || $this.width(),
		h = this.height || $this.height(),
		perc = h > 75 ? 75 / h : 1;

		if(w * perc > 223) perc = 223 / w;
		$this.attr({width: w * perc, height: h * perc}).click(showUploader);

	}

	function toggleContent() {

		var $this = $(this);

		if(this.checked) {

			if(mediaHolder.html() !== "") {

				$this.data("jbhasmedia", true);
				mediaHolder.hide();

			}

			multi.hide();
			media.hide();
			htmlTiny.show();
			htmlFrame.show();
			editRaw.show();

		}

		else {

			htmlFrame.hide();
			htmlTiny.hide();
			editRaw.hide();
			multi.show();
			media.show();

			if($this.data("jbhasmedia")) {

				$this.removeData("jbhasmedia");
				mediaHolder.show();

			}

		}

		media.removeClass("jb-error");
		htmlFrame.removeClass("jb-error");

	}

	function getIndex(st) {

		var i = this.length;

		while(i--) {

			if(this[i] === st) return i;

		}

		return -1;

	}

	function checkKey() {

    	this.value = this.value.replace(keyNumbers, "");

	}

	function removeError() {

		$(this).removeClass("jb-error");

	}

	function removeJackbox() {

		selection = $(editor.selection.getNode());

		if(selection.is("img")) selection = selection.parent();
		selection.removeClass("jackbox jackbox-hidden-item");
		
		if(!legacyTiny) {
			
			buttonRemove.disabled(true);
		
		}
		else {
			
			manager.setDisabled("jackbox_remove", true);
				
		}
		
		var attr = selection[0].attributes, i = attr.length, name;

		while(i--) {

			name = attr[i].name;
			if(name.search("data-jb") !== -1) selection.removeAttr(name);

		}

	}	

	tinymce.create("tinymce.plugins.jackbox", {init: startIt});
	tinymce.PluginManager.add("jackbox", tinymce.plugins.jackbox);


})(jQuery);