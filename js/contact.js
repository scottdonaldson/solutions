jQuery(document).ready(function($){

	console.log('contact page js');

	// "Get in touch!"
	$('h2.huge a').click(function(e){
		e.preventDefault();

		$('html, body').animate({
			'scrollTop': $('#contact').offset().top
		}, 1200);
	})

	// The map - spotlight follows mouse
	var map = $('.map'),
		container = map.find('.container'),
		x, y;

	$('.map').mousemove(function(e){
		$this = $(this);
		x = e.pageX - $this.offset().left;
		y = e.pageY - $this.offset().top;
		container.css({
			'left': x,
			'top': y
		});
	}).mouseleave(function(){
		container.animate({
			'left': '47%',
			'top': '43%'
		}, 500);
	}); 

	// Team members
	var fulls = $('#fulls'),
		products = $('.product').not(':first'),
		samples = $('.sample'),
		sample,
		target, targetHeight,
		n;

	products.find('.left, h3, p').hide();

	products.append('<div class="close">'+
					    '<div class="bg-hover"></div>'+
					    '<div class="icon-close"></div>'+
					    '<div class="border-clone"></div>'+
					'</div>');
	$('.product').first().find('p:last-child').addClass('last');
	products.find('.close').prev('p').addClass('last');

	$('.close').click(function(){
		$this = $(this);
		target = $this.closest('.product');
		target.fadeOut({queue: false}).slideUp(800, function(){
			target.find('.left, h3, p').hide();
			target.addClass('gone');
		});

		n = target.attr('data-n');
		samples.filter(function(index){ // find the corresponding sample and show it again
			return $(this).attr('data-n') === n;
		}).animate({
			'margin-right': '2%',
			'opacity': 1
		}, function(){
			$(this).removeAttr('style');
		});

		// in case there were 0 visible samples left, this resets the height of container
		$this.closest('#featured').removeAttr('style');
	});

	samples.click(function(){
		$this = $(this);
		// Fade out the image
		$this.animate({
			'opacity': 0,
			'margin-right': '-100%'
		}, 300, function(){
			$this.hide();
		});

		// Time to show the featured product
		target = products.eq($this.index());
		setTimeout(function(){
			target.appendTo(fulls).find('.left, h3, p').fadeIn();
			target.slideDown().animate({
				'height': '100%'
			}, function(){
				target.removeClass('gone').fadeIn();
			});
		}, 300);

	});
});