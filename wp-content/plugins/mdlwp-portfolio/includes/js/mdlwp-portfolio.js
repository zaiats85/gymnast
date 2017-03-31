jQuery(document).ready(function($){
	// initialize filtering

	containerEl = $('.fanat-portfolio');

	mixer = mixitup(containerEl, {
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

