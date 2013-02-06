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
				<img src="<?php the_sub_field('icon'); ?>">
			<?php 
			} ?> 
	</div>
		<?php
		while (has_sub_field('capability')) { ?>
			<div class="content">
				<h3><?php the_sub_field('name'); ?></h3>
				<?php while (has_sub_field('info')) { ?>
					<strong><?php the_sub_field('point'); ?></strong>
					<p><?php the_sub_field('description'); ?></p>
				<?php } ?>
			</div>
		<?php }
		} ?>
		
	</div>
</div>

<?php get_footer(); ?>