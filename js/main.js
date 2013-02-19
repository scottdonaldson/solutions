jQuery(document).ready(function($){

	var capability = $('.capability'),
		container = $('#capabilities'),
		capabilities = $('#capabilities > div'),
		shown = $('.shown'),
		fading = false,
		target, oldActive;

	capabilities.first().fadeIn();			// show the first capability...
	capability.first().addClass('active');	// highlight the first icon...
	$(window).load(function(){
		container.height(shown.height());	// set the height of the container equal to its content
	});	
		$(window).resize(function(){
			container.height($('.shown').height());
		});

	if (!$('html').hasClass('lt-ie9')) {
		// Set height and width for 'Learn More' hovers
		// used in sizing the hover on switching capabilities
		var hovH = $('.sol-hoverable:first').outerHeight(),
			hovW = $('.sol-hoverable:first').outerWidth();
		$('.sol-hover').css({
			'height': hovH,
			'width': hovW
		});
	}

	// indicator
	capability.first().find('.round').prepend('<div class="indicator"></div>');
	var indicator = $('.indicator');

	capability.click(function(){
		if (!fading) {
			fading = true;
			
			$this = $(this);
			target = capabilities.eq($this.index());
			oldActive = $('.active');

			// move the indicator
			indicator.animate({
				'left': $this.offset().left - oldActive.offset().left + 4,
				'top': $this.offset().top - oldActive.offset().top - 10
			}, 500, 'linear', function(){
				indicator.prependTo($this.find('.round')).removeAttr('style');
			});

			$this.addClass('active').siblings('.capability').removeClass('active');
			if (!target.hasClass('shown')) {
				// fade out and remove shown class from the one that's being shown
				$('.shown').fadeOut(400).removeClass('shown');
				// find the new one, fade it in, and add the shown class
				target.delay(400).fadeIn().addClass('shown')
					// size hover
					.find('.sol-hover').css({
						'height': hovH,
						'width': hovW
					});
			}

			shown = $('.shown');
			// resize container
			container.height(shown.height());

			if ($(window).scrollTop() > container.offset().top - 50) {
				$('html, body').animate({
					'scrollTop': container.offset().top - 50
				}, 800);
			}

			setTimeout(function(){
				fading = false;
			}, 910);
		}
	});

	// Put some FitText on the icons
	var icons = $('.capabilities span');
	icons.fitText(0.17);

	// Featured products
	var fulls = $('#fulls'),
		products = $('.product').not(':first'),
		samples = $('.sample'),
		sample,
		target, targetHeight,
		n;

	products.find('img, .right').hide();

	// Colorbox
	var colorbox = $('.colorbox');
	if (colorbox.length > 0) {
		colorbox.colorbox({
			scrolling: false,
			maxHeight: '90%',
			previous: '<span class="sol-hover"></span><span class="border-clone"></span><span class="icon-prev"></span>',
			next: '<span class="sol-hover"></span><span class="border-clone"></span><span class="icon-next"></span>',
			close: '<span class="sol-hover"></span><span class="border-clone"></span><span class="icon-close"></span>'
		});
	}

	products.append('<div class="close">'+
					    '<div class="bg-hover"></div>'+
					    '<div class="icon-close"></div>'+
					    '<div class="border-clone"></div>'+
					'</div>');
	$('.close').click(function(){
		$this = $(this);
		target = $this.closest('.product');
		target.fadeOut({queue: false}).slideUp(800, function(){
			target.find('img, .right').hide();
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

	var pointer = $('.pointers');
	var pointerPos = function(){
		pointer.each(function(){
			$this = $(this);
			$this.css({
				'top': $this.closest('.product').find('.colorbox img').height() - 32
			});
		});
	}
	if (pointer) {
		$(window).load(function(){
			pointerPos();
		}).resize(function(){
			pointerPos();
		});
	}

	samples.click(function(){
		$this = $(this);
		// Fade out the image
		$this.animate({
			'opacity': 0,
			'margin-right': '-100%'
		}, 300);

		// Time to show the featured product
		target = products.eq($this.index());
		setTimeout(function(){
			target.appendTo(fulls).find('img').fadeIn();
			target.slideDown().animate({
				'height': '100%',
				'margin-bottom': '1.667%'
			}, function(){
				target.removeClass('gone').fadeIn();
			});
		}, 300);

		// If this is the last visible sample, set the height of the container to 0
		// (set back to normal whenever closing a featured product)
		if ($this.siblings().filter(function(){
			return $(this).css('opacity') != 0
		}).length == 0) {
			console.log(samples.height());
			setTimeout(function(){
				$('#featured').animate({
					'margin-bottom': -samples.height()
				});
			}, 300);
		}
	});
});