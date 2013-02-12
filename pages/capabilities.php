<?php 
/*
Template Name: Capabilities
*/
get_header(); 
the_post(); ?>

<?php 
// Include capabilities
include( MAIN . 'caps.php'); ?>

<h1 class="visuallyhidden">Contact</h1>

<section id="full_capabilities" class="clearfix">
	<?php
	foreach ($capabilities as $cap=>$name) { ?>
		<div class="content" id="<?php echo $cap; ?>">
			<h3 class="central"><?php echo $name; ?></h3>
			<?php while (has_sub_field($cap)) { ?>
				<div class="clearfix">
					<p class="point"><?php the_sub_field('point'); ?></p>
					<p class="description"><?php the_sub_field('description'); ?></p>
				</div>
			<?php } ?>
		</div>
	<?php } 
	// Icons go after capabilities so that they bump to the bottom
	// at our breakpoint
	?>
	<div class="icons">
		<?php 
		$c = 0;
		foreach ($capabilities as $cap=>$name) { ?>
			<a class="round" href="#<?php echo $cap; ?>">
				<span class="sol-hoverable icon-<?php echo $cap; ?>"></span>
			</a>
			<?php if ($c == 2) { echo '<div class="clearfix"></div>'; } ?>
		<?php 
		$c++;
		} ?> 
	</div>	
</section>

<div class="border">
	<a class="blacklink sol-hoverable sans" href="<?php echo home_url(); ?>/process">Learn about our process</a>
</div>

<script>
jQuery(document).ready(function($){
	if (window.location.hash.length == 0) {
		// If we're not coming to a specific capability,
		// assume that we're here to check out pre-project support
		window.history.pushState('', document.title, '#support');
	} 
	$(window.location.hash).addClass('shown');
	
	$('html, body').animate({
		'scrollTop': 0
	}, 1);

	var container = $('#full_capabilities'),
		content = container.find('.content'),
		height = 0,
		icons = $('.icons a');
	
	// Set the right one to active
	icons.each(function(){
		$this = $(this);
		if ($this.attr('href') == window.location.hash) {
			$this.addClass('active');
		}
	});
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

		window.history.pushState('', document.title, $this.attr('href'));
	});
});
</script>

<?php get_footer(); ?>