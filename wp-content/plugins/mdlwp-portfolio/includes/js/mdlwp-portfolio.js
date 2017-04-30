
jQuery.noConflict();

jQuery(document).ready(function($){

	mixer = mixitup($('.fanat-portfolio'), {
		pagination: {
			limit: 4,
			maintainActivePage: false,
			loop: true,
			hidePageListIfSinglePage: true
		},
		load: {
			page: 1 // load page 1 on instantiation
		},
		multifilter: {
			enable: true
		}
	});

});

