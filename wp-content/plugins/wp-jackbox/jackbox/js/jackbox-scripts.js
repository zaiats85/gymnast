/* --------------------------------------------- */
/* Author: http://codecanyon.net/user/CodingJack */
/* --------------------------------------------- */

;var jackbox, 
jackboxWP = jackboxOptions["wordpress-gallery"],
jackboxAjax = jackboxOptions["ajax-compatible"];

(function($) {
	
	var domain = jackboxOptions.domain, scripts, count, total;
	
	function init() {
		
		var header = $("head"),
		url = document.URL, splits = url.split("?url=");
		if(splits.length === 2) window.location = splits[0] + "#/" + splits[1];
		
		if(url.search("https") === -1 && domain.search("https") !== -1) {
			domain = jackboxOptions.domain = domain.split("https").join("http");	
		}
	
		var custom = jackboxOptions["custom-css"],
		minified = jackboxOptions["minified-scripts"] === "yes",
		style = $("<link />").attr("rel", "stylesheet").attr("type", "text/css").appendTo(header);
		
		style.attr("href", domain + (minified ? "jackbox/css/jackbox.min.css" : "jackbox/css/jackbox.css"));
		if(custom) $("<style />").attr("type", "text/css").html(custom).appendTo(header);
		
		if(minified) {
			
			$.getScript(domain + "jackbox/js/jackbox-packed.js");
			
		}
		else {
			
			scripts = [
				
				"jackbox/js/libs/jquery.address-1.5.min.js",
				"jackbox/js/libs/Jacked.js",
				"jackbox/js/jackbox-swipe.js",
				"jackbox/js/libs/StackBlur.js",
				"jackbox/js/jackbox.js"
			
			]
			
			count = 0;
			total = 5;
			loadScript();	
			
		}
		
		var img1 = new Image(),
		img2 = new Image();
		img1.src = domain + "jackbox/img/graphics/panel_left_over.png";
		img2.src = domain + "jackbox/img/graphics/panel_right_over.png";
		
	}
	
	function loadScript() {
		
		if(count < 5) {
			
			$.getScript(domain + scripts[count], loadScript);
			count++;
			
		}
		
	}
	
	$(document).ready(function() {
		
		jackboxCheckGallery();
		jackbox = $(".jackbox");
	
		// scripts and css loaded asynchronously only if page contains a jackbox item
		if(jackbox.length || jackboxAjax) init();
	
	});
	
})(jQuery);

// new for v2.0 "GalleryToConnect" option
function jackboxCheckGallery() {
	
	if(!jackboxWP) return;
		
	var groupName,
	itemTitle,
	hyperlink,
	$this,
	itm,
	img,
	len,
	rel,
	i;
	
	items = jackboxWP.split(',');
	len = items.length;
	
	for(i = 0; i < len; i++) {
		
		groupName = "gallery-" + (i + 1);
		
		jQuery(jQuery.trim(items[i])).each(function() {
			
			hyperlink = true;
			$this = jQuery(this);
			
			if(!$this.is('a')) {
					
				$this = $this.find('a');
				hyperlink = false;
				
			}
				
			$this.each(function() {
				
				itm = jQuery(this);
				img = itm.find('img');
				
				if(!hyperlink && !img.length) return;
				if(img.length) hyperlink = false;
				
				rel = itm.attr('rel');
				
				if(rel === '') {
					groupName = 'item-' + Math.floor(Math.random() * 9999);
				}
				else if(rel) {
					rel = rel.split(' ').join('').toLowerCase().replace(/\//g, '-');
				}
				
				itm.addClass('jackbox').attr({
					
					'data-jbgallery': true,
					'data-jbhyperlink': hyperlink,
					'data-jbgroup': rel || groupName, 
					'data-jbtitle': itm.attr('lbtitle') || itm.attr('title') || img.attr('alt') || itm.attr('data-jbtitle') || ''
					
				});
				
			});
			
		});	
		
	}
	
}