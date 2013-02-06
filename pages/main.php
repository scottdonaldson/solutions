<?php 
/*
Template Name: Main
*/
get_header(); 
the_post(); ?>

<section id="capabilities" class="clearfix">
	<?php
	if (get_field('content')) { 
		$i = 0;
		while (has_sub_field('content')) { ?>
			<div id="<?php echo sanitize_title(get_sub_field('name')); ?>" <?php if ($i == 0) { echo 'class="initial shown"'; } ?>>
				<h2><?php the_sub_field('tagline'); ?></h2>
				<div class="left">
					<img src="<?php the_sub_field('illustration'); ?>" alt="<?php the_sub_field('name'); ?>">
				</div>
				<div class="right">
					<p><?php the_sub_field('description'); ?></p>
					<a class="more hoverable sans" href="<?php echo home_url(); ?>/capabilities/#<?php echo sanitize_title(get_sub_field('name')); ?>">Learn more</a>
				</div>
			</div>
		<?php 
		$i++;
		}
	} ?>
</section>

<div class="capabilities clearfix">
	<?php
	if (get_field('content')) {
		while (has_sub_field('content')) { ?>
			<div class="capability" data-capability="<?php echo sanitize_title(get_sub_field('name')); ?>">
				<div>	
					<img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('name'); ?>">
				</div>
				<h3><?php the_sub_field('name'); ?></h3>
			</div>
		<?php }
	} ?>
</div>

<?php 
if (get_field('products')) { 
	$p = 0; ?>
	<section id="featured" class="clearfix">
		<h2 class="header">Featured Products</h2>
		<?php 
		// Full images with titles and descriptions
		while (has_sub_field('products')) { ?>
			<div class="product clearfix <?php if ($p > 0) { echo 'transparent'; } ?>">
				<img src="<?php the_sub_field('image'); ?>">
				<h3><?php the_sub_field('name'); ?></h3>
				<p><?php the_sub_field('description'); ?></p>
			</div>
			<?php $p++;
		} 
		// Reset for sample images
		$p = 0; ?>
		<div id="samples">
		<?php while (has_sub_field('products')) {
			if ($p > 0) { ?>
				<div class="sample sample-<?php echo $p; ?>">
					<img src="<?php the_sub_field('image'); ?>">
				</div>
		<?php } 
		$p++;
		} ?>
		</div>
	</section>
<?php } ?>

<script>
jQuery(document).ready(function($){
	var capability = $('.capability'),
		container = $('#capabilities'),
		capabilities = $('#capabilities > div'),
		shown = $('.shown');

	container.height(container.outerHeight());	

	capability.click(function(){
		$this = $(this);
		shown = $('.shown');
		shownHeight = shown.outerHeight();
		if (!capabilities.eq($this.index()).hasClass('shown')) {
			// fade out and remove shown class from the one that's being shown
			$('.shown').fadeOut(500).removeClass('shown');
			// find the new one, fade it in, and add the shown class
			capabilities.eq($this.index()).delay(505).fadeIn().addClass('shown');
		}
	});

	var products = $('.product').not(':first'),
		samples = $('.sample img'),
		sample,
		counter = 1,
		target, targetHeight;

	samples.click(function(){
		sample = $(this);
		// Fade out the image
		sample.fadeOut(300);
		// Slide all the containing 'sample' divs to the left
		samples.closest('.sample').each(function(){
			$(this).animate({
				'left': -counter * sample.closest('.sample').outerWidth()
			});
		});
		// increment the counter so we know how far to be moving them
		counter++;

		// Time to show the featured product
		target = products.eq(sample.closest('.sample').index());
		targetHeight = target.find('img').outerHeight() > target.find('h3').height() + target.find('p').height() ? target.find('img').outerHeight() : target.find('h3').height() + target.find('p').height()
		target.delay(300).animate({
			'height': targetHeight
		}, 600);
	});
});
</script>

<?php get_footer(); ?>