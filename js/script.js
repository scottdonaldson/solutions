$(document).ready(function(){

	// Declare variables
	var html = $('html'),
		body = $('body'),
		menuItem = $('header nav a');

	// Make menu items hoverable and their parents boxes
	menuItem.addClass('hoverable');

	// Hover effects
	var hoverable =	$('.hoverable'),
		hover,
		z;

	hoverable.each(function(){
		$this = $(this);
		var left = 10, 
			top = -10;
		
		z = $this.css('z-index') ? $this.css('z-index') + 1 : 1;
		// Create the hover div
		hover = $('<div>', { class: 'hover' });

		// What sort of hover is this?
		if ($this.hasClass('round')) {
			// left = 25;
		}

		$this.css({
			'z-index': z
		}).after( hover
				    .width($this.outerWidth())
				    .height($this.outerHeight())
				    .css({
				    	'left': left,
				    	'top': top
				    })
				);
	});


});