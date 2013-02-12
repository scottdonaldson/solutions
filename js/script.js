$(document).ready(function(){

	// Declare variables
	var html = $('html'),
		body = $('body'),
		menuItem = $('header nav a');

	// Make menu items hoverable and their parents boxes
	menuItem.addClass('sol-hoverable');

	// News page needs to add in hoverables here also
	if (body.hasClass('blog')) {
		$('.pagination a').wrap('<div class="wrapper">').addClass('sol-hoverable');
	}

	// Hover effects
	var hoverable =	$('.sol-hoverable'),
		hover,
		z;

	$(window).load(function(){ // wait for window load so we can get images in there too
		hoverable.each(function(){
			$this = $(this);
			
			z = $this.css('z-index') ? $this.css('z-index') + 1 : 1;
			// Create the hover div
			hover = $('<div>', { class: 'sol-hover' });

			if ($this.closest('.sample').length > 0) { // special case for home page samples
				$this.css({
					'z-index': z
				}).after( hover
						    .width($this.outerWidth() + 10)
						    .height($this.outerHeight() + 10)
						);
			} else {
				$this.css({
					'z-index': z
				}).after( hover
						    .width($this.outerWidth())
						    .height($this.outerHeight())
						);
			}
		});
	});
	$(window).resize(function(){
		$('.sol-hover').each(function(){
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