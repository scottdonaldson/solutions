<?php 
/*
Template Name: Process
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden">Process</h1>

<section id="process" class="clearfix">
	<div class="step step-1">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>1</span></h3>
		<section>
			<h4 class="header">Project Initiation</h4>
			<p>Proposal, feasibility assessment customer purchase order</p>
		</section>
	</div>
	<div class="step step-2">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>2</span></h3>
		<section>
			<h4 class="header">Planning Phase</h4>
			<p>Develop plan and design inputs (requirements)</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-3">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>3</span></h3>
		<section>
			<h4 class="header">Design Phase</h4>
			<p>System, electronic, software and mechanical design descriptions</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-4">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>4</span></h3>
		<section>
			<h4 class="header">Implementation Phase</h4>
			<p>Schematics, drawings, software code, manufacturing procedures, part specifications, vendor selection, etc.</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-5">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>5</span></h3>
		<section>
			<h4 class="header">Verification Phase</h4>
			<p>Electronic, software, mechanical and integration testing</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-6">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span>6</span></h3>
		<section><h4 class="header">Validation</h4></section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3><span class="icon-pencil"></span></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-7 final">
		<div class="bar"></div>
		<h3><span>7</span></h3>
		<section>
			<h4 class="header">Release to Production</h4>
			<p>Design transfer to customer</p>
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
				}, 350, 'linear', function(){
					current.find('.indicator').prependTo(next.find('h3')).removeAttr('style');
				});

				// animate the line and show content
				current.removeClass('active').find('.line').animate({
					'height': '100%'
				}, 200, function(){
					next.find('h3').fadeIn(200, function(){
						next.addClass('active').find('.bar').stop().animate({
							'margin-left': 0,
							'width': barWidth
						}, 200, function(){
							next.find('section').fadeIn(200).css({
								'top': -next.find('section').height/2 + 30
							});
							isShowing = false;

							// If scrolled all the way to bottom of page, keep movin' on
							if ($(window).scrollTop() + $(window).height() == $(document).height()) {
								nextStep(next);
							}
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