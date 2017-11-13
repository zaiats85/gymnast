
jQuery.noConflict();

jQuery(document).ready(function($){

	mixer = mixitup($('.sport-portfolio'), {
		pagination: {
			limit: 4,
			maintainActivePage: false,
			loop: true,
			hidePageListIfSinglePage: true
		},
		templates: {
			pager: '<button class="mdl-button mdl-js-button ${classNames}" data-page="${pageNumber}">${pageNumber}</button>',
			pagerPrev: '<button class="mdl-button mdl-js-button ${classNames}" data-page="prev"><i class="material-icons">keyboard_arrow_left</i></button>',
			pagerNext: '<button class="mdl-button mdl-js-button ${classNames}" data-page="next"><i class="material-icons">keyboard_arrow_right</i></button>',
		},
		load: {
			page: 1 // load page 1 on instantiation
		},
		multifilter: {
			enable: true
		}
	});

});

