<?php 
/*
Template Name: Main
*/
get_header(); 
the_post(); ?>

<section id="capabilities" class="clearfix">
	<h2>Physical results you can touch, test, and&nbsp;tweak.</h2>
	
	<img src="<?php echo bloginfo('template_url'); ?>/images/prototyping.png" alt="Quick-Turn Prototyping">
	
	<div class="right">
		<p>Solutions Engineering has developed an expertise in knowing when and how to prototype critical phases of the engineering design in order to rapidly and inexpensively test key technical parts of the design to lower risk, save you money and get results faster.</p>

		<a class="more hoverable sans" href="">Learn More</a>
	</div>
</section>

<div class="capabilities clearfix">
	<div class="capability support">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/support-icon.png" alt="Pre-Project Support"></a>
		<h3>Pre-Project Support</h3></div>
	<div class="capability design">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/design-icon.png" alt="Electronics Design"></a>
		<h3>Electronics Design</h3></div>
	<div class="capability prototyping">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/prototyping-icon.png" alt="Quick-Turn Prototyping"></a>
		<h3>Quick-Turn Prototyping</h3></div>
	<div class="capability validation">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/validation-icon.png" alt="Design Validation"></a>
		<h3>Design Validation</h3></div>
	<div class="capability compliance">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/compliance-icon.png" alt="FDA/MDD Compliance"></a>
		<h3>FDA/MDD Compliance</h3></div>
	<div class="capability management">
		<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/management-icon.png" alt="Project Management"></a>
		<h3>Project Management</h3></div>
</div>

<section id="featured">
	<h2 class="header">Featured Products</h2>
</section>

<?php get_footer(); ?>