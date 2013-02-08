<?php 
/*
Template Name: Capabilities
*/
get_header(); 
the_post(); ?>

<h1 class="visuallyhidden">Contact</h1>

<div id="full_capabilities" class="clearfix">
	<div class="icons">
		<?php 
		if (get_field('capability')) { 
			while (has_sub_field('capability')) { ?>
				<a href="#<?php echo sanitize_title(get_sub_field('name')); ?>">	
					<img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('name'); ?>">
				</a>
			<?php 
			} ?> 
	</div>
		<?php
		while (has_sub_field('capability')) { ?>
			<div class="content" id="<?php echo sanitize_title(get_sub_field('name')); ?>">
				<h3 class="big"><?php the_sub_field('name'); ?></h3>
				<?php while (has_sub_field('info')) { ?>
					<div class="clearfix">
						<p class="point"><?php the_sub_field('point'); ?></p>
						<p class="description"><?php the_sub_field('description'); ?></p>
					</div>
				<?php } ?>
			</div>
		<?php }
		} ?>
		
	</div>
</div>

<script>
jQuery(document).ready(function($){
	if (window.location.hash.length == 0) {
		window.history.pushState('', document.title, '#pre-project-support');
	}
	var container = $('#full_capabilities'),
		content = container.find('.content'),
		height = 0,
		icons = $('.icons a');
	content.each(function(){
		$this = $(this);
		// Find the tallest of the bunch
		if ($this.outerHeight() > height) {
			height = $this.outerHeight();
		}
	});
	// Set height of container equal to the height of the tallest content
	container.height(height);

	// When clicking on icons, we want to fade in and out, so we need to override
	// default anchor behavior
	icons.click(function(e){
		e.preventDefault();
		$this = $(this);
		// console.log(content.filter($this.attr('href')));
		content.filter($this.attr('href')).fadeIn().siblings('.content').fadeOut();

		window.history.pushState('', document.title, $this.attr('href'));
	});
});
</script>

<?php get_footer(); ?>