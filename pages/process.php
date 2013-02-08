<?php 
/*
Template Name: Process
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden">Process</h1>

<div id="process" class="clearfix">
	<div class="step step-1">
		<div class="bar"></div>
		<div class="line"></div>
		<h3 class="active">1</h3>
		<section>
			<h4 class="header">Project Initiation</h4>
			<p>Proposal, feasibility assessment customer purchase order</p>
		</section>
	</div>
	<div class="step step-2">
		<div class="bar"></div>
		<div class="line"></div>
		<h3>2</h3>
		<section>
			<h4 class="header">Planning Phase</h4>
			<p>Develop plan and design inputs (requirements)</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-3">
		<div class="bar"></div>
		<div class="line"></div>
		<h3>3</h3>
		<section>
			<h4 class="header">Design Phase</h4>
			<p>System, electronic, software and mechanical design descriptions</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-4">
		<div class="bar"></div>
		<div class="line"></div>
		<h3>4</h3>
		<section>
			<h4 class="header">Implementation Phase</h4>
			<p>Schematics, drawings, software code, manufacturing procedures, part specifications, vendor selection, etc.</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-5">
		<div class="bar"></div>
		<div class="line"></div>
		<h3>5</h3>
		<section>
			<h4 class="header">Verification Phase</h4>
			<p>Electronic, software, mechanical and integration testing</p>
		</section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-6">
		<div class="bar"></div>
		<div class="line"></div>
		<h3>6</h3>
		<section><h4 class="header">Validation</h4></section>
	</div>
	<div class="step design">
		<div class="bar"></div>
		<div class="line"></div>
		<h3></h3>
		<section><h4 class="header">Design Review</h4></section>
	</div>
	<div class="step step-7">
		<div class="bar"></div>
		<h3>7</h3>
		<section>
			<h4 class="header">Release to Production</h4>
			<p>Design transfer to customer</p>
		</section>
	</div>
</div>

<script>
jQuery(document).ready(function($){
	var sections = $('#process section');

	sections.each(function(){
		$this = $(this);
		$this.css({
			'top': -$this.height()/2 + 30
		});
	});
});
</script>

<?php get_footer(); ?>