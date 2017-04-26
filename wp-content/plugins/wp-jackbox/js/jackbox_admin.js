(function($) {
	
	$(document).ready(function() {
	
		//only numbers allowed for numerical values
		$(".jackbox-small").keyup(function checkKey() {
	
			this.value = this.value.replace(/[^0-9\.|#|-]/g, "");
	
		});
		
	});

})(jQuery);