
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
		},
		templates: {
			pager: '<button type="button" class="${classNames} mdl-button mdl-js-button mdl-js-ripple-effect" data-page="${pageNumber}">${pageNumber}</button>',
			pagerNext: '<button type="button" class="${classNames} mdl-button mdl-js-button mdl-js-ripple-effect" data-page="next"><i class="material-icons">keyboard_arrow_right</i></button>',
			pagerPrev:'<button type="button" class="${classNames} mdl-button mdl-js-button mdl-js-ripple-effect" data-page="prev"><i class="material-icons">keyboard_arrow_left</i></button>'
		}
	});

});

