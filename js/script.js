$(document).ready(function(){

	// Declare variables
	var html = $('html'),
		body = $('body'),
		menuItem = $('header nav a');

	// Make menu items hoverable and their parents boxes
	menuItem.addClass('hoverable');

	// News page needs to add in hoverables here also
	if (body.hasClass('blog')) {
		$('.pagination a').wrap('<div class="wrapper">').addClass('hoverable');
	}

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

		// Special cases
		if ($this.closest('#process').length > 0) {
			left = 5;
			top = -8;
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
	$(window).resize(function(){
		$('.hover').each(function(){
			$this = $(this);
			$this.css({
				'height': $this.prev().outerHeight(),
				'width': $this.prev().outerWidth()
			});
		});
	});


	// News in the footer - normalize height (only at large size)
	/* var footerNews = $('.footer-news'),
		biggestNews = 0;
	var getBiggestNews = function(){
		footerNews.each(function(){
			biggestNews = 0;
			$this = $(this);
			$this.removeAttr('style');
			if ($this.height() > biggestNews) {
				biggestNews = $this.height();
			}
			footerNews.height(biggestNews);
		});
	};
	getBiggestNews();
	$(window).resize(function(){
		getBiggestNews();
	});
	*/
});