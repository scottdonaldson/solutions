<?php 
/*
Template Name: Capabilities
*/
get_header(); 
the_post(); ?>

<?php 
// Include capabilities
include( MAIN . 'caps.php'); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<section id="full_capabilities" class="clearfix">
	<?php
	foreach ($capabilities as $cap=>$name) { ?>
		<div class="content" id="<?php echo $cap; ?>">
			<h3 class="central"><?php echo $name; ?></h3>
			<strong class="aligncenter">
				<?php echo get_field($cap.'_tagline', get_page_by_title('Main')->ID); ?>
			</strong>

			<?php while (has_sub_field($cap)) { ?>
				<div class="clearfix">
					<p class="point"><?php the_sub_field('point'); ?></p>
					<p class="description"><?php the_sub_field('description'); ?></p>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="border-clone"></div>
	
</section>

<?php
// Icons go after capabilities so that they bump to the bottom at our breakpoint ?>
<div class="icons clearfix">
	<?php 
	$c = 0;
	foreach ($capabilities as $cap=>$name) { ?>
		<a class="round" href="#<?php echo $cap; ?>">
			<div class="sol-hoverable"></div>
			<div class="border-clone icon-<?php echo $cap; ?>"></div>
		</a>
	<?php 
	$c++;
	} ?> 
</div>

<div class="learn">
	<a class="border blacklink sol-hoverable sans" href="<?php echo home_url(); ?>/process">Learn about our process</a>
</div>

<script>
jQuery(document).ready(function($){
	if (window.location.hash.length == 0) {
		// If we're not coming to a specific capability,
		// assume that we're here to check out pre-project support
		if (window.history && window.history.pushState) {
			window.history.pushState('', document.title, '#support');
		} else {
			window.location.hash = '#support';
		}
		$('#support').fadeIn();
	}

	// IE8 doesn't support CSS :target selector for displaying the right content.
	// jQuery fallback here
	if ($('html').hasClass('lt-ie9')) {
		$(window.location.hash).fadeIn();
	}

	$('html, body').animate({
		'scrollTop': 0
	}, 1);

	var container = $('#full_capabilities'),
		content = container.find('.content'),
		height = 0,
		icons = $('.icons a'),
		oldActive;

	// Put some FitText on the icons
	icons.find('.border-clone').fitText(0.17);	
	
	// Set the right one to active and set indicator
	icons.each(function(){
		$this = $(this);
		if ($this.attr('href') == window.location.hash) {
			$this.addClass('active').prepend('<div class="indicator"></div>');
		}
	});
	var indicator = $('.indicator');

	// Function to find biggest height, given all content,
	// and set the container equal to this biggest height
	var findHeight = function(){
		height = 0;
		content.each(function(){
			$this = $(this);
			// Find the tallest of the bunch
			if ($this.outerHeight() > height) {
				height = $this.outerHeight();
			}
		});	
		// factor in the height of the icons
		if (parseInt(icons.closest('.icons').css('top')) + 6 * (icons.height() + parseInt(icons.css('margin-bottom'))) > height) {
			height = parseInt(icons.closest('.icons').css('top')) + 6 * (icons.height() + parseInt(icons.css('margin-bottom')));
		}
		// Set height of container equal to the height of the tallest content
		container.height(height);
	}
	findHeight();
	$(window).resize(function(){
		findHeight();
	});
	

	// When clicking on icons, we want to fade in and out, so we need to override
	// default anchor behavior
	icons.click(function(e){
		e.preventDefault();
		$this = $(this);
		oldActive = $('.active');

		// Move the indicator
		indicator.animate({
			'left': $this.offset().left - oldActive.offset().left + 5,
			'top': $this.offset().top - oldActive.offset().top - 5
		}, 400, 'linear', function(){
			indicator.prependTo($this).removeAttr('style');
		});

		$this.addClass('active').siblings().removeClass('active');

		if (!content.filter($this.attr('href')).hasClass('shown')) {
			content.fadeOut(400).removeClass('shown');
			setTimeout(function(){
				content.filter($this.attr('href')).fadeIn().addClass('shown');
			}, 405);
			if ($(window).scrollTop() > container.offset().top - 40) {
				$('html, body').animate({
					'scrollTop': container.offset().top - 40
				}, 800);
			}
		}

		if (window.history && window.history.pushState) {
		 	window.history.pushState('', document.title, $this.attr('href'));
		} else {
			window.location.hash = $this.attr('href');
		}
	});
});
</script>

<?php get_footer(); ?>