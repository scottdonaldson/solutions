<?php 
/*
Template Name: Process
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden"><?php the_title(); ?></h1>

<section id="process" class="clearfix">
	<div class="step step-1">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>1</span></h3>
		<section>
			<h4 class="header">Project Initiation</h4>
			<?php if (get_field('initiation')) { 
				echo '<p>';
				the_field('initiation');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-2">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>2</span></h3>
		<section>
			<h4 class="header">Planning Phase</h4>
			<?php if (get_field('planning')) { 
				echo '<p>';
				the_field('planning');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section>
			<h4 class="header">Design Review</h4>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-3">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>3</span></h3>
		<section>
			<h4 class="header">Design Phase</h4>
			<?php if (get_field('design')) { 
				echo '<p>';
				the_field('design');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section>
			<h4 class="header">Design Review</h4>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-4">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>4</span></h3>
		<section>
			<h4 class="header">Implementation Phase</h4>
			<?php if (get_field('implementation')) { 
				echo '<p>';
				the_field('implementation');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section>
			<h4 class="header">Design Review</h4>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-5">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>5</span></h3>
		<section>
			<h4 class="header">Verification Phase</h4>
			<?php if (get_field('verification')) { 
				echo '<p>';
				the_field('verification');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section>
			<h4 class="header">Design Review</h4>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-6">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>6</span></h3>
		<section>
			<h4 class="header">Validation</h4>
			<?php if (get_field('validation')) { 
				echo '<p>';
				the_field('validation');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section>
			<h4 class="header">Design Review</h4>
			<div class="border-clone ie7"></div>
		</section>
	</div>
	<div class="step step-7 final">
		<div class="bar"></div>
		<h3><span>7</span></h3>
		<section>
			<h4 class="header">Release to Production</h4>
			<?php if (get_field('release')) { 
				echo '<p>';
				the_field('release');
				echo '</p>';
			} ?>
			<div class="border-clone ie7"></div>
		</section>
	</div>
</section>

<script>
jQuery(document).ready(function($){
	var steps = $('#process .step'),
		sections = steps.find('section'),
		bar = steps.find('.bar'),
		line = steps.find('.line'),
		next,
		isShowing = false;

	line.height(0);
	var barWidth = bar.first().width();
	bar.not(':first').width(0);
	steps.not(':eq(0)').find('h3, section').hide();
	steps.first().addClass('active shown').find('h3').prepend('<div class="indicator"></div>');

	steps.find('h3').prepend('<div class="border-clone"></div>');

	var nextStep = function(current){
		if (!isShowing) {
			isShowing = true;
			next = current.next('.step');
			
			if (next.length > 0) {
				next.addClass('shown');

				// move the indicator
				current.find('.indicator').animate({
					'top': current.height()
				}, 300, 'linear', function(){
					current.find('.indicator').prependTo(next.find('h3')).removeAttr('style');
				});

				// animate the line and show content
				current.removeClass('active').find('.line').animate({
					'height': '100%'
				}, 150, function(){
					next.find('h3').fadeIn(150, function(){
						next.addClass('active').find('.bar').animate({
							'margin-left': 0,
							'width': barWidth
						}, 150, function(){
							next.find('section').fadeIn(150);
							next.find('.bar').show(); // for IE8
							isShowing = false;

							setTimeout(function(){
								nextStep(next);
							}, 500);
						});
					});
				});
			} 
			if (next.hasClass('final')) {
				$('.indicator').animate({
					'backgroundColor': 'rgba(64,136,199,0.5)'
				}, 800);
			}
		}
	};
	setTimeout(function(){
		nextStep(steps.first());
	}, 1000);

	var step;
	$(window).scroll(function(){
		// If the mid-point of our window is below the last shown step,
		// then show the next step
		step = $('.shown:last');
		if ($(window).scrollTop() + $(window).height()/2 > step.offset().top) {
			nextStep(step);
		}
	});

	$(window).resize(function(){
		barWidth = bar.first().width();
		$('.shown .bar').not(':first').width(barWidth);
	});
});
</script>

<?php get_footer(); ?>