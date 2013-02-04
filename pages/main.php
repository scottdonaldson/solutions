<?php 
/*
Template Name: Main
*/
get_header(); 
the_post(); ?>

<section id="capabilities" class="clearfix">
	<?php
	if (get_field('content')) { 
		while (has_sub_field('content')) { ?>
			<div id="<?php echo sanitize_title(get_sub_field('name')); ?>">
				<h2><?php the_sub_field('tagline'); ?></h2>
				<div class="left">
					<img src="<?php the_sub_field('illustration'); ?>" alt="<?php the_sub_field('name'); ?>">
				</div>
				<div class="right">
					<p><?php the_sub_field('description'); ?></p>
					<a class="more hoverable sans" href="<?php echo home_url(); ?>/capabilities/#<?php echo sanitize_title(get_sub_field('name')); ?>">Learn more</a>
				</div>
			</div>
		<?php }
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
		<?php while (has_sub_field('products')) { ?>
			<div class="product clearfix <?php if ($p > 0) { echo 'sample'; } ?>">
				<img src="<?php the_sub_field('image'); ?>">
				<h3><?php the_sub_field('name'); ?></h3>
				<p><?php the_sub_field('description'); ?></p>
			</div>
			<?php $p++;
		} ?>
	</section>
<?php } ?>

<script>
jQuery(document).ready(function($){
	var browsing = false,
		capability = $('.capability'),
		capabilities = $('#capabilities > div');

	capability.click(function(){
		$this = $(this);
		capabilities.eq($this.index()).show().siblings().hide();
	});

	var products = $('.product').not(':first'),
		i = 0;
	products.click(function(){
		$this = $(this);
		if (i%2 === 0) {
			$this.removeClass('sample');
		}
		i++;
	});
});
</script>

<?php get_footer(); ?>